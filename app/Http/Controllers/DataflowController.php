<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Activity;
use App\Models\Progress;
use Illuminate\Support\Str;
use App\Services\EVMService;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskSuggestionService;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $tasksuggestionservice = new TaskSuggestionService(10);
        $user = Auth::user();

        $suggestions = $tasksuggestionservice->getTaskSuggestion($user);

        return view('home', ['user' => $user, 'suggestions' => $suggestions]);
    }

    // data view('tasklist')
    public function tasklist(Request $request)
    {
        $EVMService = new EVMService();
        $user = Auth::user();
        
        $search = $request->input('search');
        $perPage = $request->get('perPage', 5);
        $sort = $request->get('sort', 'priority');
        $filter = $request->get('filter', '');
        
        $tasks = Task::where('user_member_id', $user->id)->where('status_id', 2);

        if ($search) {
            $tasks->where(function ($query) use ($search) {
                $query->where('task_description', 'like', '%' . $search . '%')
                ->orWhereHas('activity', function ($query) use ($search) {
                    $query->where('activity_name', 'like', '%' . $search . '%')
                    ->orWhere('activity_unit', 'like', '%' . $search . '%');
                });
            });
        }

        $tasks = $tasks->get();

        foreach ($tasks as $task){
            $task->spi_data = $EVMService->calculateSPI($task);
        }

        if($filter){
            $tasks = $tasks->filter(function ($task) use ($filter){
                return isset($task->spi_data['status']) && $task->spi_data['status'] === $filter;
            })->values();
        }

        if ($sort == 'priority') {
            $tasks = $tasks->sortBy(function($task) {
                return $task->spi_data['spi'];
            })->values();
        } elseif ($sort == 'tenggat') {
            $tasks = $tasks->sortBy(function($task) {
                return $task->activity->activity_end;
            })->values();
        } elseif ($sort == 'id') {
            $tasks = $tasks->sortBy(function($task) {
                return $task->id;
            })->values();
        }

        $currentPage = $request->get('page', 1);
        $pagedTasks = $tasks->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $tasks = new LengthAwarePaginator(
            $pagedTasks,
            $tasks->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('tasklist', ['tasks' => $tasks]);
    }

    // data view('taskarchive')
    public function taskarchive(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        $tasks = Task::where('user_member_id', $user->id)->where('status_id', 1);

        if ($search) {
            $tasks->where(function ($query) use ($search) {
                $query->where('task_description', 'like', '%' . $search . '%')
                ->orWhereHas('activity', function ($query) use ($search) {
                    $query->where('activity_name', 'like', '%' . $search . '%')
                    ->orWhere('activity_unit', 'like', '%' . $search . '%');
                });
            });
        }

        $perPage = $request->get('perPage', 5);
        $tasks = $tasks->paginate($perPage)->withQueryString();

        return view('taskarchive', ['tasks' => $tasks]);
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
            $activities = Activity::with('tasks')->where('activity_active_status', false);
        } elseif ($user->user_role === 'ketuatim'){
            $activities = Activity::with('tasks')->where('user_leader_id', $user->id)->where('activity_active_status', false);
        }else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        };

        if ($search) {
            $activities->where(function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%');
            });
        }
        
        $activities = $activities->paginate($perPage)->appends($request->query());

        foreach ($activities as $activity){
            $activity->total_volume = $activity->tasks->sum('task_volume');
        }
        
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

        $actionUrl = Auth::user()->user_role === 'kepalabps'? '/kepalabps/monitoringkegiatan/': (Auth::user()->user_role === 'ketuatim'? '/ketuatim/monitoringkegiatan/': '#');

        return view('activitiesmonitoring', ['activities' => $activities, 'actionUrl' => $actionUrl]);
    }

    // data view('employeemonitoring')
    public function employeemonitoring()
    {
        $tasksPerUser = User::where('user_role','anggotatim')->withCount(['tasks' => function ($query) {
            $query->where('status_id', 2);
        }])->get();
    
        return view('employeemonitoring', ['tasksPerUser' => $tasksPerUser]);
    }

    // data view ('createtask')
    public function createtask()
    {
        $anggotatim = User::where('user_role', 'anggotatim')
            ->withCount(['tasks' => function ($query) {
                $query->where('status_id', 2);
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
        $role = Auth::user()->user_role;
        $tasks = Task::where('activity_id', $activity->id)->paginate(5);
        $actionUrl = Auth::user()->user_role === 'kepalabps'? '/kepalabps/monitoringkegiatan': (Auth::user()->user_role === 'ketuatim'? '/ketuatim/monitoringkegiatan': '#');
        return view('activity', ['tasks' => $tasks, 'actionUrl' => $actionUrl, 'activity' => $activity, 'role' => $role]);
    }

    // data view('task')
    public function task(Task $task)
    {
        $EVMService = new EVMService();
        $progress = Progress::where('task_id', $task->id)->get();
        $task->spi_data = $EVMService->calculateSPI($task);
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