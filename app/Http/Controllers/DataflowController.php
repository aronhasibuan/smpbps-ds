<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Activity;
use App\Models\Evaluation;
use App\Models\Progress;
use App\Models\Objection;
use App\Services\Evaluation_EVMService;
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
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $tasksuggestionservice = new TaskSuggestionService(10);
        $EVMService = new EVMService();

        $suggestions = $tasksuggestionservice->getTaskSuggestion($user);
        $todayProgress = Progress::with('task')
            ->where('progress_date', $today)
            ->where('progress_amount', '!=', 0)
            ->whereHas('task', function($query) use ($user){
                $query->where('user_member_id', $user->id);
            })
            ->get();
        
        $tasks = Task::with('activity')->where('status_id', 2)->where('user_member_id', $user->id)->get();   
        foreach($tasks as $task){
            $task->spi_data = $EVMService->calculateSPI($task);
        }
        $groupedTasks = $tasks->groupBy(fn($task) => $task->spi_data['status'] ?? 'Unknown');
        $pieData = $groupedTasks->map->count();

        $runningtask = Task::where('status_id', 2)->where('user_member_id', $user->id)->count();
        $latetasks = Task::where('status_id', 2)
            ->where('user_member_id', $user->id)
            ->whereHas('activity', function($query) use ($today) {
                $query->where('activity_end', '<', $today);
            })
            ->count();
        $ontimetask = $runningtask - $latetasks;
        $completedtask = Task::where('status_id', 1)->where('user_member_id', $user->id)->count(); 

        $taskStats = [
            'running'   => $runningtask,
            'late'      => $latetasks,
            'ontime'    => $ontimetask,
            'completed' => $completedtask,
        ];

        $newtasks = Task::with('activity')
            ->whereHas('activity', function($query) use ($today) {
                $query->whereDate('activity_start', $today);
            })
            ->where('user_member_id', $user->id)
            ->get();
        
        return view('home', ['user' => $user, 'suggestions' => $suggestions, 'todayProgress' => $todayProgress, 'taskStats' => $taskStats, 'pieData' => $pieData, 'newtasks' => $newtasks]);
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
            $statusOrder = [
                'Terlambat'        => 1,
                'Progress Lambat'  => 2,
                'Progress On Time' => 3,
                'Progress Cepat'   => 4,
            ];
            $tasks = $tasks->sort(function($a, $b) use ($statusOrder) {
                $statusA = $statusOrder[$a->spi_data['status']] ?? 99;
                $statusB = $statusOrder[$b->spi_data['status']] ?? 99;
            if ($statusA !== $statusB) {
                return $statusA <=> $statusB;
            }
            return $a->spi_data['spi'] <=> $b->spi_data['spi'];
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

        $activityDates = Task::where('user_member_id', $user->id)
            ->where('status_id', 1)
            ->with('activity')
            ->get()
            ->pluck('activity.activity_start')
            ->filter()
            ->map(function($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m');
            })
            ->unique()
            ->sort()
            ->values();

        $tasks = Task::where('user_member_id', $user->id)
            ->where('status_id', 1)
            ->with('activity');

        $monthYear = $request->get('month_year');
        if ($monthYear) {
            $tasks->whereHas('activity', function($query) use ($monthYear) {
                $query->whereRaw("DATE_FORMAT(activity_start, '%Y-%m') = ?", [$monthYear]);
            });
        }

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

        return view('taskarchive', [
            'tasks' => $tasks,
            'activityDates' => $activityDates,
        ]);
    }

    // data view ('evaluation')
    public function evaluation(Task $task)
    {
        $task = Task::with('evaluation')->findOrFail($task->id);
        $progresses = Progress::where('task_id', $task->id)->get();
        $evaluation_evmservice = new Evaluation_EVMService();

        $start = Carbon::parse($task->activity->activity_start);
        $end = Carbon::parse($task->activity->activity_end);
        
        $progressbydate = [];
        foreach ($progresses as $progress){
            $progressbydate[$progress->progress_date] = $progress;
        }
        
        $taskbydate = [];
        $lastProgress = null;

        for($date = $start->copy(); $date->lte($end); $date->addDay() ){
            $dateStr = $date->format('Y-m-d');
            $progress = $progressbydate[$dateStr] ?? $lastProgress;
            if (isset($progressbydate[$dateStr])) {
                $lastProgress = $progressbydate[$dateStr];
            }

            $taskClone = clone $task;
            $taskClone->task_date = $dateStr;
            $taskClone->latest_progress = $progress ? $progress->progress_amount : 0;
            $taskClone->spi_data = $evaluation_evmservice->calculateSPI($task, $date, $progress->progress_amount);
            $taskbydate[] = $taskClone;
        }

        $totalPoint = 0;
        $count = 0;
        foreach($taskbydate as $task){
            $totalPoint += $task->spi_data['poin'];
            $count++;
        }

        $task->average_progress_point = $totalPoint / $count;

        $task->comprehensiveness_point = Evaluation_EVMService::comprehensivenessPoint($task->evaluation->evaluation_comprehensiveness);
        $task->tidiness_point = Evaluation_EVMService::tidinessPoint($task->evaluation->evaluation_tidiness);
        $task->average_quality_point = ($task->comprehensiveness_point + $task->tidiness_point) / 2;

        $task->final_point = ($task->average_progress_point * 0.6) + ($task->average_quality_point * 0.4);
 
        return view('evaluation', ['task' => $task, 'tasksbydate' => $taskbydate]);
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
        $tasks = Task::with(['user', 'status'])->get();

        $groupedByUser = $tasks->groupBy(function ($task) {
            return $task->user->user_full_name ?? 'Tidak diketahui';
        });

        $statusDescriptions = $tasks->pluck('status.status_description')->unique()->values();

        $chartData = [];
        foreach ($statusDescriptions as $desc) {
            $chartData[$desc] = [];
        }

        foreach ($groupedByUser as $userName => $userTasks) {
            foreach ($statusDescriptions as $desc) {
                $count = $userTasks->filter(function ($task) use ($desc) {
                    return $task->status->status_description === $desc;
                })->count();

                $chartData[$desc][] = $count;
            }
        }

        return view('employeemonitoring', [
            'userNames' => $groupedByUser->keys(),
            'statusDescriptions' => $statusDescriptions,
            'chartData' => $chartData,
        ]);
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
        $actionUrl = Auth::user()->user_role === 'kepalabps'? '/kepalabps/monitoringkegiatan': (Auth::user()->user_role === 'ketuatim'? '/ketuatim/monitoringkegiatan': '#');
        
        $tasks = Task::where('activity_id', $activity->id)->paginate(5);

        $EVMService = new EVMService;
        foreach ($tasks as $task){
            $task->spi_data = $EVMService->calculateSPI($task);
        }

        return view('activity', ['tasks' => $tasks, 'actionUrl' => $actionUrl, 'activity' => $activity, 'role' => $role]);
    }

    // data view('task')
    public function task(Task $task)
    {
        $EVMService = new EVMService();
        $progresses = Progress::where('task_id', $task->id)->get();
        $task->spi_data = $EVMService->calculateSPI($task);
        $user = Auth::user();

        $start = Carbon::parse($task->activity->activity_start);
        $end = Carbon::parse($task->activity->activity_end);
        $today = Carbon::today();

        $lastDate = $today->lessThan($end) ? $today : $end;

        $lastProgress = $progresses->sortByDesc('progress_date')->first();
        if ($lastProgress && Carbon::parse($lastProgress->progress_date)->greaterThan($end)) {
            $lastDate = Carbon::parse($lastProgress->progress_date);
        }

        $progressByDate = [];
        foreach ($progresses as $progress) {
            $progressByDate[$progress->progress_date] = $progress;
        }

        return view('task', [
            'task' => $task,
            'progresses' => $progresses,
            'user' => $user,
            'start' => $start,
            'end' => $lastDate,
            'progressByDate' => $progressByDate,
        ]);
    }

    public function taskmonitoring($grouptask_slug, $slug)
    {
        $EVMService = new EVMService();
        $task = Task::where('task_slug', $slug)->firstOrFail();
        $progress = Progress::where('task_id', $task->id)->get();
        $task->spi_data = $EVMService->calculateSPI($task);
        return view('task', ['task' => $task, 'progresses'=>$progress]);
    }

    // data view('profile')
    public function profile($user_role)
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    // data view('verification)
    public function verification()
    {
        $objections = Objection::all();
        return view('verification', ['objections' => $objections] );
    }
}