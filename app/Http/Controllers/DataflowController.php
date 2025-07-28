<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Activity;
use App\Models\Progress;
use App\Models\Objection;
use App\Services\EVMService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\Evaluation_EVMService;
use App\Services\TaskSuggestionService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class DataflowController extends Controller
{

    // redirect to login page
    public function landing_page()
    {
        return redirect('/login');
    }

    // data view('login')
    public function login(){
        return view('login');
    }

    // data view('profile')
    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    // data view('task')
    public function task(Task $task)
    {
        $user = Auth::user();
        $EVMService = new EVMService();
        $progressByDate = [];
        $today = Carbon::today();

        $task->spi_data = $EVMService->calculateSPI($task);
        $start = Carbon::parse($task->activity->activity_start);
        $end = Carbon::parse($task->activity->activity_end);
        $progresses = Progress::where('task_id', $task->id)->get();
        $lastProgress = $progresses->sortByDesc('progress_date')->first();
        
        if ($today->lessThan($end)) {
            $lastDate = $today;
        } elseif ($lastProgress && Carbon::parse($lastProgress->progress_date)->greaterThan($end)) {
            $lastDate = Carbon::parse($lastProgress->progress_date);
        } else {
            $lastDate = $end;
        }

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

    // open attachment
    public function openAttachment($filename)
    {
        $path = "attachments/{$filename}";

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path("app/public/{$path}"));
    }

    // data view ('evaluation')
    public function evaluation(Task $task)
    {
        $user = Auth::user();
        $evaluation_evmservice = new Evaluation_EVMService();
        $taskbydate = [];
        $progressbydate = [];
        $lastProgress = null;
        $totalPoint = 0;
        $count = 0;
        $task = Task::with('evaluation')->findOrFail($task->id);
        $start = Carbon::parse($task->activity->activity_start);
        $end = Carbon::parse($task->activity->activity_end);
        $progresses = Progress::where('task_id', $task->id)->get();
        foreach ($progresses as $progress){
            $progressbydate[$progress->progress_date] = $progress;
        }
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
        foreach($taskbydate as $task){
            $totalPoint += $task->spi_data['poin'];
            $count++;
        }
        $task->average_progress_point = $totalPoint / $count;
        $task->comprehensiveness_point = Evaluation_EVMService::comprehensivenessPoint($task->evaluation->evaluation_comprehensiveness);
        $task->tidiness_point = Evaluation_EVMService::tidinessPoint($task->evaluation->evaluation_tidiness);
        $task->average_quality_point = ($task->comprehensiveness_point + $task->tidiness_point) / 2;
        $task->final_point = ($task->average_progress_point * 0.6) + ($task->average_quality_point * 0.4);
 
        return view('evaluation', [
                    'task' => $task, 
                    'tasksbydate' => $taskbydate,
                    'user' => $user,
                ]);
    }

    // data view('activities_monitoring')
    public function activities_monitoring(Request $request)
    {
        $EVMService = new EVMService();
        $user = Auth::user();
        
        $search = $request->input('search');
        $filter = $request->get('filter', '');
        $perPage = $request->get('perPage', 5);
        $currentPage = $request->get('page', 1);
        $sort = $request->get('sort', 'priority');

        // Base Query
        if ($user->user_role === 'kepalabps') {
            $activities = Activity::where('activity_active_status', true)
                ->with(['tasks' => function ($query) {
                    $query->select('activity_id', 'task_latest_progress', 'task_volume');
                }]);
        } elseif ($user->user_role === 'ketuatim') {
            $activities = Activity::where('user_leader_id', $user->id)
                ->where('activity_active_status', true)
                ->with(['tasks' => function ($query) {
                    $query->select('activity_id', 'task_latest_progress', 'task_volume');
                }]);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Filter Search
        if ($search) {
            $activities->where(function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%')
                    ->orWhere('activity_unit', 'like', '%' . $search . '%');
            });
        }
        
        // Ambil data
        $activities = $activities->get();

        // Hitung SPI tiap activity
        foreach ($activities as $activity) {
            $activity->spi_data = $EVMService->calculateActivitySPI($activity);
        }

        // Filter berdasarkan status SPI
        if ($filter) {
            $activities = $activities->filter(function ($activity) use ($filter) {
                return isset($activity->spi_data['status']) && $activity->spi_data['status'] === $filter;
            })->values();
        }

        // Sorting
        
        if ($sort == 'priority') {
            $statusOrder = [
                'Terlambat'        => 1,
                'Progress Lambat'  => 2,
                'Progress On Time' => 3,
                'Progress Cepat'   => 4,
                'Selesai'          => 5,
            ];
            $activities = $activities->sort(function ($a, $b) use ($statusOrder) {
                $statusA = $statusOrder[$a->spi_data['status']] ?? 99;
                $statusB = $statusOrder[$b->spi_data['status']] ?? 99;
                return $statusA <=> $statusB;
            })->values();
        } elseif ($sort == 'tenggat') {
            $activities = $activities->sortBy(function ($activity) {
                return $activity->activity_end;
            })->values();
        } elseif ($sort == 'id') {
            $activities = $activities->sortBy(function ($activity) {
                return $activity->id;
            })->values();
        } elseif ($sort == 'progress') {
            $activities = $activities->sortBy(function ($activity) {
                return $activity->spi_data['progressPercentage'] ?? 0;
            })->values();
        }

        // Pagination Manual
        $pagedActivities = $activities->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $activities = new LengthAwarePaginator(
            $pagedActivities,
            $activities->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('activities_monitoring', ['activities' => $activities]);
    }

    // data view('activity')
    public function activity(Activity $activity)
    {
        $teams = Team::with(['users' => function($query) {
                $query->where('user_role', '!=', 'ketuatim');
            }])->where('id', '!=', 1)->orderBy('team_name')->get();

        $anggotatim = User::where('user_role', 'anggotatim')
            ->withCount(['tasks' => function ($query) {
                $query->where('status_id', 2);
            }])->get();

        $EVMService = new EVMService;
        $tasks = Task::where('activity_id', $activity->id)->paginate(5);
        foreach ($tasks as $task){
            $task->spi_data = $EVMService->calculateSPI($task);
        }
        return view('activity', ['tasks' => $tasks, 'activity' => $activity, 'anggotatim' => $anggotatim, 'teams' => $teams]);
    }

    // data view('employee_monitoring')
    public function employee_monitoring(Request $request)
    {
        $auth = Auth::user();
        $chartData = [];
        $userNames = [];
        $chartDataProgress = [];
        $EVMService = new EVMService();
        $teamId = null;
        $teams = Team::where('id', '!=', 1)->get();
        $monthYear = $request->get('month_year');
        
        if ($auth->user_role === 'ketuatim') {
            $teamId = $auth->team_id;
        } elseif ($auth->user_role === 'kepalabps') {
            $teamId = $request->get('team_id', 2);
        } else {
            abort(403, 'Tidak memiliki akses ke halaman ini.');
        }

        $activityDates = Task::with('activity')->whereHas('user', function ($q) use ($teamId) {
            $q->where('team_id', $teamId);
        });

        $activityDates = $activityDates->get()->pluck('activity.activity_start')->filter()
        ->map(function($date) {return \Carbon\Carbon::parse($date)->format('Y-m');})
        ->unique()->sort()->values();
    
        $tasksQuery = Task::with(['user', 'status', 'user.team'])
            ->whereHas('user', function ($q) use ($teamId) {$q->where('team_id', $teamId);
        });

        $taskProgressQuery = Task::with(['user', 'status', 'activity', 'user.team'])
            ->where('status_id', 2)->whereHas('user', function($q) use ($teamId) {
                $q->where('team_id', $teamId);
            });

        if ($monthYear) {
            $tasksQuery->whereHas('activity', function($query) use ($monthYear) {
                $query->whereRaw("DATE_FORMAT(activity_start, '%Y-%m') = ?", [$monthYear]);
            });

            $taskProgressQuery->whereHas('activity', function($query) use ($monthYear) {
                $query->whereRaw("DATE_FORMAT(activity_start, '%Y-%m') = ?", [$monthYear]);
            });
        }

        $tasks = $tasksQuery->get();
        $statusDescriptions = $tasks->pluck('status.status_description')->unique()->values();
        foreach ($tasks->groupBy('user.id') as $userId => $userTasks) {
            $user = $userTasks->first()->user;
            $userName = $user->user_full_name ?? 'Tidak diketahui';
            $userNames[] = $userName;

            foreach ($statusDescriptions as $desc) {
                $chartData[$desc][] = $userTasks->where('status.status_description', $desc)->count();
            }
        }

        $taskProgress = $taskProgressQuery->get();
        foreach($taskProgress as $task) {
            $task->spi_data = $EVMService->calculateSPI($task);
        }
        $spiStatuses = $taskProgress->pluck('spi_data.status')->unique()->values();
        foreach ($taskProgress->groupBy('user.id') as $userId => $userTasks) {
            $user = $userTasks->first()->user;
            $userName = $user->user_full_name ?? 'Tidak diketahui';
            foreach ($spiStatuses as $status) {
                $chartDataProgress[$status][] = $userTasks->filter(function ($task) use ($status) {
                    return $task->spi_data['status'] === $status;
                })->count();
            }
        }

        return view('employee_monitoring', [
            'teams' => $teams,
            'selectedTeam' => $teamId,
            'userNames' => $userNames, 
            'statusDescriptions' => $statusDescriptions,
            'chartData' => $chartData,
            'activityDates' => $activityDates,
            'chartDataProgress' => $chartDataProgress,
            'spiStatuses' => $spiStatuses,
            'auth' => $auth,
        ]);
    }

    // data view('activities_archive')
    public function activities_archive(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        $user = Auth::user();        
        
        $search = $request->input('search');
        $monthYear = $request->get('month_year');
        $perPage = $request->get('perPage', 5);
        
        if ($user->user_role === 'kepalabps') {
            $activitiesQuery = Activity::where('activity_active_status', false);
        } elseif ($user->user_role === 'ketuatim') {
            $activitiesQuery = Activity::where('user_leader_id', $user->id)->where('activity_active_status', false);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $activityDates = (clone $activitiesQuery)
            ->pluck('activity_start')->filter()
            ->map(function($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m');
            })
            ->unique()->sort()->values();

        $activities = $activitiesQuery->with('tasks');

        if ($monthYear) {
            $activities->whereRaw("DATE_FORMAT(activity_start, '%Y-%m') = ?", [$monthYear]);
        }

        if ($search) {
            $activities->where(function ($query) use ($search) {
                $query->where('activity_name', 'like', '%' . $search . '%')
                    ->orWhere('activity_unit', 'like', '%' . $search . '%');
            });
        }

        $activities = $activities->paginate($perPage)->withQueryString();

        foreach ($activities as $activity) {
            $activity->total_volume = $activity->tasks->sum('task_volume');
        }

        return view('activities_archive', [
            'activities' => $activities,
            'activityDates' => $activityDates,
        ]);
    }

    // data view('head_bps_home_page')
    public function head_bps_home_page()
    {
        $user = Auth::user();

        if ($user->user_role !== 'kepalabps') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $recentcompletedActivities = Activity::with('user')->where('activity_active_status', false)
                ->orderBy('updated_at', 'desc')->take(5)->get();
    
            return view('home_of_head_bps', [
                'totalPegawai' => User::count(),
                'totalTim' => Team::count(),
                'totalKegiatanAktif' => Activity::where('activity_active_status', true)->count(),
                'totalKegiatanSelesai' => Activity::where('activity_active_status', false)->count(),
                'recentcompletedActivities' => $recentcompletedActivities,
            ]);
        }

    }

    // data view('team_list')
    public function team_list(Request $request)
    {
        $user = Auth::user();
        if ($user->user_role !== 'kepalabps') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $teamsQuery = Team::with('users')->distinct();
            $search = $request->input('search');
            $perPage = $request->get('perPage', 5);
            if ($search) {
                $teamsQuery->where('team_name', 'like', '%' . $search . '%');
            }
            $teams = $teamsQuery->paginate($perPage)->appends($request->query());
            return view('team_list', ['teams' => $teams]);
        }
    }

    // data view ('create_team')
    public function create_team()
    {
        $user = Auth::user();
        if ($user->user_role !== 'kepalabps') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            return view('create_team');
        }
    }
    
    // data view('employee_list')
    public function employee_list(Request $request)
    {
        $user = Auth::user();
        if ($user->user_role !== 'kepalabps') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }        
        $usersQuery = User::query();
        $search = $request->input('search');
        $perPage = $request->get('perPage', 5);
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
        $users = $usersQuery->paginate($perPage)->appends($request->query());
        $teams = DB::table('teams')->where('team_name', '!=', 'Kepala BPS')->get();

        return view('employee_list', ['users' => $users, 'teams' => $teams]);
    }

    // data view ('create_employee')
    public function create_employee()
    {
        $user = Auth::user();
        if ($user->user_role !== 'kepalabps'){
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $teams = DB::table('teams')->where('team_name', '!=', 'Kepala BPS')->get();
            return view('create_employee', ['teams' => $teams]);
        }
    }

    // data view('home_leader')
    public function team_leader_home_page()
    {
        $user = Auth::user();        
        if ($user->user_role !== 'ketuatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $today = Carbon::today()->toDateString();
            $EVMService = new EVMService();  
            $activities = Activity::with('tasks')->where('user_leader_id', $user->id)->where('activity_active_status', true)->get();
            $runningactivity = $activities->count();
            $lateActivitiesFiltered = $activities->filter(function ($activity) use ($today) {
                return $activity->activity_end < $today && $activity->total_progress != 100;
            });
            $lateactivity = $lateActivitiesFiltered->count();
            $completedactivity = Activity::where('activity_active_status', false)->where('user_leader_id', $user->id)->count();
            $objection_task = Objection::with(['task.user'])
                ->where('objection_status', 'tertunda')
                ->whereHas('task.user', function($query) use ($user) {
                    $query->where('team_id', $user->team_id);
                })->get();
            $progress_need_verification = Progress::with('task.activity')
                ->where('progress_acceptance', 0)
                ->whereHas('task.activity', function ($query) use ($user) {
                    $query->where('user_leader_id', $user->id);
                })->get();
            $cross_team_task = Task::where('status_id', 3)
                ->whereHas('user', function($query) use ($user) {
                    $query->where('team_id',  $user->team_id);
                })->get();
            $verifiedtask = $objection_task->count() + $progress_need_verification->count() + $cross_team_task->count();
            foreach($activities as $activity){
                $activity->spi_data = $EVMService->calculateActivitySPI($activity);
            }
            $pieData = $activities->groupBy(fn($a) => $a->spi_data['status'] ?? 'Unknown')->map->count();
            $activityStats = [
                'running'   => $runningactivity,
                'late'      => $lateactivity,
                'verify'    => $verifiedtask,
                'completed' => $completedactivity,
            ];
            $memberProgress = Progress::with(['task.activity'])
                ->where('progress_date', $today)
                ->where('progress_amount', '!=', 0)
                ->whereHas('task.activity', function($query) use ($user) {
                    $query->where('user_leader_id', $user->id);
                })->get();
            return view('home_of_team_leader', [
                        'user' => $user, 
                        'activityStats' => $activityStats, 
                        'memberProgress' => $memberProgress, 
                        'pieData' => $pieData
                    ]);
        }     
    }

    // data view ('create_task')
    public function create_task()
    {
        $auth = Auth::user();
        if($auth->user_role !== 'ketuatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $chartDataProgress = [];
            $EVMService = new EVMService();
            $taskProgressQuery = Task::with(['user', 'status', 'activity'])->where('status_id', 2)
                ->whereHas('user', function($query) use ($auth) {
                    $query->where('team_id', $auth->team_id);
                });
            $taskProgress = $taskProgressQuery->get();
            foreach($taskProgress as $task) {$task->spi_data = $EVMService->calculateSPI($task);}
            $groupedByUserProgress = $taskProgress->groupBy(function ($task) {
                return $task->user->user_full_name ?? 'Tidak diketahui';});
            $spiStatuses = $taskProgress->pluck('spi_data.status')->unique()->values();
            foreach ($spiStatuses as $status) {$chartDataProgress[$status] = [];}
            foreach ($groupedByUserProgress as $userName => $userTasks) {
                foreach ($spiStatuses as $status) {
                    $count = $userTasks->filter(function ($task) use ($status) {
                        return $task->spi_data['status'] === $status;})->count();
                    $chartDataProgress[$status][] = $count;
                }}
            $teams = Team::with(['users' => function($query) {
                    $query->where('user_role', '!=', 'ketuatim');
                }])
                ->where('id', '!=', 1)->orderBy('team_name')->get();
            $anggotatim = User::where('user_role', 'anggotatim')
                ->withCount(['tasks' => function ($query) {$query->where('status_id', 2);}])->get();
            $busiestUser = $anggotatim->sortByDesc('tasks_count')->first();
            $maxTasks = $busiestUser ? $busiestUser->tasks_count : 0;
            return view('create_task', [
                        'anggotatim' => $anggotatim, 
                        'busiestUser' => $busiestUser, 
                        'maxTasks' => $maxTasks, 
                        'teams' => $teams,
                        'chartDataProgress' => $chartDataProgress,
                        'spiStatuses' => $spiStatuses,
                        'userNames' => $groupedByUserProgress->keys(),
                    ]);
        }
    }

     // data view('verification)
    public function verification()
    {
        $user = Auth::user();
        if($user->user_role !== 'ketuatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $objection_task = Objection::with(['task.user'])
                ->where('objection_status', 'tertunda')
                ->whereHas('task.user', function($query) use ($user) {
                    $query->where('team_id', $user->team_id);
                })->get();
            $progress_need_verification = Progress::with('task.activity')
                ->where('progress_acceptance', 0)
                ->whereHas('task.activity', function ($query) use ($user) {
                    $query->where('user_leader_id', $user->id);
                })->get();
            $cross_team_task = Task::where('status_id', 3)
                ->whereHas('user', function($query) use ($user) {
                    $query->where('team_id',  $user->team_id);
                })->get(); 
            return view('verification', ['user' => $user, 'objection_task' => $objection_task, 'progress_need_verification' => $progress_need_verification, 'cross_team_task' => $cross_team_task]);
        }
    }

    // data view ('home')
    public function team_member_home_page()
    {
        $user = Auth::user();
        if($user->user_role !== 'anggotatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $today = Carbon::today()->toDateString();
            $tasksuggestionservice = new TaskSuggestionService(10);
            $EVMService = new EVMService();
            $suggestions = $tasksuggestionservice->getTaskSuggestion($user);
            $todayProgress = Progress::with('task')
                ->where('progress_date', $today)
                ->where('progress_amount', '!=', 0)
                ->whereHas('task', function($query) use ($user){
                    $query->where('user_member_id', $user->id);
                })->get();
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
                })->count();
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
                })->where('user_member_id', $user->id)->get();
            return view('home_of_team_member', ['user' => $user, 'suggestions' => $suggestions, 'todayProgress' => $todayProgress, 'taskStats' => $taskStats, 'pieData' => $pieData, 'newtasks' => $newtasks]);
        }
    }

    // data view('task_list')
    public function task_list(Request $request)
    {
        $user = Auth::user();
        if($user->user_role !== 'anggotatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            $EVMService = new EVMService(); 
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
            return view('task_list', ['tasks' => $tasks]);
        }
    }

    // data view('task_archive')
    public function task_archive(Request $request)
    {
        $user = Auth::user();
        if($user->user_role !== 'anggotatim') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        } else {
            \Carbon\Carbon::setLocale('id');
            $search = $request->input('search');
            $perPage = $request->get('perPage', 5);
            $monthYear = $request->get('month_year');
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
            $tasks = $tasks->paginate($perPage)->withQueryString();
            return view('task_archive', [
                'tasks' => $tasks,
                'activityDates' => $activityDates,
            ]);
        }
    }
}