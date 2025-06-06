<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataflowController extends Controller
{
    // data view('employeelist')
    public function employeelist(Request $request)
    {        
        $usersQuery = User::query();
        
        $search = $request->input('search');
        
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('user_full_name', 'like', '%' . $search . '%') 
                    ->orWhere('email', 'like', '%' . $search . '%') 
                    ->orWhere('user_role', 'like', '%' . $search . '%');
            })
            ->orWhereHas('team', function ($query) use ($search) {
                $query->where('team_name', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->get('perPage', 10);
        $users = $usersQuery->paginate($perPage)->appends($request->query());

        $teams = DB::table('teams')->where('team_name', '!=', 'Kepala BPS')->get();

        return view('employeelist', ['users' => $users, 'teams' => $teams]);
    }

    // data view ('home')
    public function home(Request $request)
    {
        $user = Auth::user();
        $tasks = Task::where('user_member_id', $user->id)->where('task_active_status', true)->get();
        return view('home', ['user' => $user, 'tasks' => $tasks]);
    }

    // data view('tasklist')
    public function tasklist(Request $request)
    {
        $user = Auth::user();

        $tasksQuery = Task::where('user_member_id', $user->id)->where('task_active_status', true)->get();
            // ->select(
            //     'tasks.*',
            //     DB::raw("
            //         CEIL(DATEDIFF(NOW(), created_at)) + 1 AS hariberlalu_MySQL,
            //         DATEDIFF(tenggat, created_at) + 1 AS selangharitugas_MySQL,
            //         CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)) AS targetperhari_MySQL,
            //         LEAST(volume, (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)))) AS targetharustercapai_MySQL,
                    
            //         FLOOR((latestprogress / volume) * 100) AS percentage_progress,

            //         CASE 
            //             WHEN tenggat < CURDATE() THEN 1
            //             WHEN latestprogress < (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 2
            //             WHEN latestprogress = (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 3
            //             WHEN latestprogress > (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 4  
            //         END AS kodekategori
            //     ")
            // )
        // ->filter($request->only(['search']));

        // if ($request->has('filter')) {
        //     switch ($request->filter) {
        //         case 'terlambat':
        //             $tasksQuery->having('kodekategori', 1);
        //             break;
        //         case 'progress_lambat':
        //             $tasksQuery->having('kodekategori', 2);
        //             break;
        //         case 'progress_ontime':
        //             $tasksQuery->having('kodekategori', 3);
        //             break;
        //         case 'progress_cepat':
        //             $tasksQuery->having('kodekategori', 4);
        //             break;
        //     }
        // }

        // $sort = $request->get('sort', 'priority');

        // if (in_array($sort, ['id', 'tenggat'])) {
        //     $tasksQuery->orderBy($sort);
        // } elseif ($sort === 'priority') {
        //     $tasksQuery->orderBy('kodekategori')->orderBy('tenggat', 'ASC')->orderBy('percentage_progress', 'ASC');
        // }

        // $perPage = $request->get('perPage', 10);
        // $tasks = $tasksQuery->paginate($perPage)->withQueryString();

        return view('tasklist', ['tasks' => $tasksQuery]);
    }

    // data view('taskarchive')
    public function taskarchive(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        $tasksQuery = Task::where('user_member_id', $user->id)->where('task_active_status', false);

        if ($search) {
            $tasksQuery->where(function ($query) use ($search) {
                $query->where('satuan', 'like', '%' . $search . '%');
            })
            ->orWhereHas('team', function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%')
                      ->orWhere('task_description', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->get('perPage', 10);
        $tasks = $tasksQuery->paginate($perPage)->withQueryString();

        return view('taskarchive', ['tasks' => $tasksQuery]);
    }

    // data view ('evaluation')
    public function evaluation(Task $task)
    {
        $start = Carbon::parse($task->created_at)->startOfDay();
        $end = Carbon::parse($task->updated_at)->startOfDay();
        $progress = Progress::where('task_id', $task->id)->get();
        return view('evaluation', ['task' => $task, 'start' => $start, 'end' => $end]);
    }

    // data view('calendar')
    public function calendar()
    {
        return view('calendar');
    }

    // data view('activitiesarchive')
    public function activitiesarchive(Request $request)
    {
        $user = Auth::user();

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10); 

        if ($user->user_role === 'kepalabps'){
            $activityQuery = Activity::where('activity_active_status', false);
        } elseif ($user->user_role === 'ketuatim'){
            $activityQuery = Activity::where('user_leader_id', $user->id)->where('activity_active_status', false);
        }else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        };

        if ($search) {
            $activityQuery->where(function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%');
            });
        }

        $activities = $activityQuery->paginate($perPage)->withQueryString();

        $activities->each(function ($activity) {
            if ($activity->tasks->isNotEmpty()) {
                $activity->totalvolume = $activity->tasks->sum('task_volume');
                $activity->satuan = $activity->tasks->first()->satuan;
            } else {
                $activity->totalvolume = 0;
                $activity->satuan = '';
            }
        });

        return view('activitiesarchive', ['activities' => $activities]);
    }

    // data view('activitiesmonitoring')
    public function activitiesmonitoring(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->get('perPage', 10);

        if ($user->user_role === 'kepalabps') {
            $activities = Activity::where('activity_active_status', true)
                ->with(['tasks' => function ($query) {
                    $query->select('activity_id', 'task_latest_progress', 'task_volume');
                }]);
        } elseif ($user->user_role === 'ketuatim') {
            $activities = Activity::where('user_leader_id', $user->id)->where('activity_active_status', true)
                ->with(['tasks' => function ($query) {
                    $query->select('activity_id', 'task_latest_progress', 'task_volume');
                }]);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $search = $request->input('search');
        if ($search) {
            $activities->where(function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%');
            });
        }

        $activities = $activities->paginate($perPage)->withQueryString();

        $actionUrl = Auth::user()->user_role === 'kepalabps'? '/kepalabps/monitoringkegiatan': (Auth::user()->user_role === 'ketuatim'? '/ketuatim/monitoringkegiatan': '#');

        return view('activitiesmonitoring', ['activities' => $activities, 'actionUrl' => $actionUrl]);
    }

    // data view('employeemonitoring')
    public function employeemonitoring()
    {
        $tasksPerUser = User::where('user_role','anggotatim')->withCount(['tasks' => function ($query) {
            $query->where('task_active_status', true);
        }])->get();
    
        return view('employeemonitoring', ['tasksPerUser' => $tasksPerUser]);
    }

    // data view ('createtask')
    public function createtask()
    {
        $anggotatim = User::where('user_role', 'anggotatim')
            ->withCount(['tasks' => function ($query) {
                $query->where('task_active_status', true);
            }])
            ->get();

        $busiestUser = $anggotatim->sortByDesc('tasks_count')->first();
        $maxTasks = $busiestUser ? $busiestUser->tasks_count : 0;

        return view('createtask', ['anggotatim' => $anggotatim, 'busiestUser' => $busiestUser, 'maxTasks' => $maxTasks]);
    }

    // data view ('createemployee')
    public function createemployee()
    {
        $teams = DB::table('teams')->where('team_name', '!=', 'Kepala BPS')->get();
        return view('createemployee', ['teams' => $teams]);
    }

    // data view('activity')
    public function activity(Activity $activity)
    {
        $tasks = Task::where('activity_id', $activity->id)->paginate(5);
        // $totalProgress = $tasks->sum('task_latest_progress');
        // $totalVolume = $tasks->sum('task_volume');
        // $persentaseProgress = $totalVolume > 0 ? round(($totalProgress / $totalVolume) * 100, 2) : 0;
        $actionUrl = Auth::user()->user_role === 'kepalabps'? '/kepalabps/monitoringkegiatan': (Auth::user()->user_role === 'ketuatim'? '/ketuatim/monitoringkegiatan': '#');
        return view('activity', ['tasks' => $tasks, 'actionUrl' => $actionUrl, 'activity' => $activity
        // 'persentaseprogress' => $persentaseProgress, 'activites' => $activities
    ]);
    }

    // data view('task')
    public function task(Task $task)
    {
        $progress = Progress::where('task_id', $task->id)->get();
        return view('task', ['task' => $task, 'progresses'=>$progress]);
    }

    public function taskmonitoring($grouptask_slug, $slug)
    {
        $task = Task::where('task_slug', $slug)->firstOrFail();
        $progress = Progress::where('task_id', $task->id)->get();
        return view('task', ['task' => $task, 'progresses'=>$progress]);
    }

    // data view('profile')
    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }
}