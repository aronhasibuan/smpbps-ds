<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataflowController extends Controller
{
    // data view('administrator')
    public function administrator(Request $request)
    {        
        $usersQuery = User::query();
        
        $search = $request->input('search');
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%') 
                    ->orWhere('email', 'like', '%' . $search . '%') 
                    ->orWhere('role', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->get('perPage', 10);
        $users = $usersQuery->paginate($perPage)->appends($request->query());

        return view('administrator', ['users' => $users]);
    }

    // data view ('home')
    public function home(Request $request)
    {
        $user = Auth::user();
        $tasks = Task::where('penerimatugas_id', $user->id)->where('active', true)->get();

        foreach ($tasks as $task) {
            $today = Carbon::now()->startOfDay();
            $tenggat = Carbon::parse($task->tenggat)->startOfDay();
            $task->hari_tersisa = $today->diffInDays($tenggat, false) + 1;
            $task->progress_tersisa = ceil($task->volume - $task->latestprogress);
            $task->sarantugas = ceil($task->progress_tersisa/$task->hari_tersisa);
    }
        return view('home', ['user' => $user, 'tasks' => $tasks]);
    }

    // data view('daftartugas')
    public function daftartugas(Request $request)
    {
        $user = Auth::user();

        $tasksQuery = Task::where('penerimatugas_id', $user->id)
            ->where('active', true)
            ->select(
                'tasks.*',
                DB::raw("
                    CEIL(DATEDIFF(NOW(), created_at)) + 1 AS hariberlalu_MySQL,
                    DATEDIFF(tenggat, created_at) + 1 AS selangharitugas_MySQL,
                    CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)) AS targetperhari_MySQL,
                    LEAST(volume, (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)))) AS targetharustercapai_MySQL,
                    
                    FLOOR((latestprogress / volume) * 100) AS percentage_progress,

                    CASE 
                        WHEN tenggat < CURDATE() THEN 1
                        WHEN latestprogress < (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 2
                        WHEN latestprogress = (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 3
                        WHEN latestprogress > (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 4  
                    END AS kodekategori
                ")
            )
        ->filter($request->only(['search']));

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'terlambat':
                    $tasksQuery->having('kodekategori', 1);
                    break;
                case 'progress_lambat':
                    $tasksQuery->having('kodekategori', 2);
                    break;
                case 'progress_ontime':
                    $tasksQuery->having('kodekategori', 3);
                    break;
                case 'progress_cepat':
                    $tasksQuery->having('kodekategori', 4);
                    break;
            }
        }

        $sort = $request->get('sort', 'priority');

        if (in_array($sort, ['id', 'tenggat'])) {
            $tasksQuery->orderBy($sort);
        } elseif ($sort === 'priority') {
            $tasksQuery->orderBy('kodekategori')->orderBy('tenggat', 'ASC')->orderBy('percentage_progress', 'ASC');
        }

        $perPage = $request->get('perPage', 10);
        $tasks = $tasksQuery->paginate($perPage)->withQueryString();

        return view('daftartugas', ['tasks' => $tasks]);
    }

    // data view('arsip')
    public function arsip(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        $tasksQuery = Task::where('penerimatugas_id', $user->id)->where('active', false);

        if ($search) {
            $tasksQuery->where(function ($query) use ($search) {
                $query->where('namakegiatan', 'like', '%' . $search . '%') 
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('satuan', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->get('perPage', 10);
        $tasks = $tasksQuery->paginate($perPage)->withQueryString();

        return view('arsip', ['tasks' => $tasks]);
    }

    // data view('arsipkegiatan')
    public function arsipkegiatan(Request $request)
    {
        $user = Auth::user();

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10); 

        if ($user->role === 'kepalakantor'){
            $kegiatanQuery = Kegiatan::where('active', false);
        } elseif ($user->role === 'ketuatim'){
            $kegiatanQuery = Kegiatan::where('pemberitugas_id', $user->id)->where('active', false);
        }else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        };

        if ($search) {
            $kegiatanQuery->where(function ($query) use ($search) {
                $query->where('namakegiatan', 'like', '%' . $search . '%');
            });
        }

        $kegiatan = $kegiatanQuery->paginate($perPage)->withQueryString();

        $kegiatan->each(function ($keg) {
            if ($keg->tasks->isNotEmpty()) {
                $keg->totalvolume = $keg->tasks->sum('volume');
                $keg->satuan = $keg->tasks->first()->satuan;
            } else {
                $keg->totalvolume = 0;
                $keg->satuan = '';
            }
        });

        return view('arsipkegiatan', ['kegiatan' => $kegiatan]);
    }

    // data view('monitoringkegiatan')
    public function monitoringkegiatan(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->get('perPage', 10);

        if ($user->role === 'kepalakantor') {
            $kegiatan = Kegiatan::where('active', true)
                ->with(['tasks' => function ($query) {
                    $query->select('kegiatan_id', 'latestprogress', 'volume');
                }]);
        } elseif ($user->role === 'ketuatim') {
            $kegiatan = Kegiatan::where('pemberitugas_id', $user->id)
                ->where('active', true)
                ->with(['tasks' => function ($query) {
                    $query->select('kegiatan_id', 'latestprogress', 'volume');
                }]);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $search = $request->input('search');
        if ($search) {
            $kegiatan->where(function ($query) use ($search) {
                $query->where('namakegiatan', 'like', '%' . $search . '%');
            });
        }

        $kegiatan = $kegiatan->paginate($perPage)->withQueryString();

        $kegiatan->each(function ($keg) {
            if ($keg->tasks->isNotEmpty()) {
                $totalVolume = $keg->tasks->sum('volume');
                $totalProgress = $keg->tasks->sum('latestprogress');
                
                $keg->progressPercentage = $totalVolume > 0 
                    ? round(($totalProgress / $totalVolume) * 100, 2)
                    : 0;
            } else {
                $keg->progressPercentage = 0;
            }
        });

        return view('monitoringkegiatan', ['kegiatan' => $kegiatan]);
    }

    // data view('monitoringpegawai')
    public function monitoringpegawai()
    {
        $tasksPerUser = User::where('role','anggotatim')->withCount(['menerimatugas' => function ($query) {
            $query->where('active', true);
        }])->get();

        $tasksDonePerUser = User::where('role', 'anggotatim')
        ->withCount([
            'menerimatugas as tugas_selesai' => function ($query) {
                $query->where('active', false); 
            },
            'menerimatugas as tugas_terlambat' => function ($query) {
                $query->where('active', false)->whereColumn('updated_at', '>', 'tenggat');
            }
        ])
        ->get();
    
        return view('monitoringpegawai', ['tasksPerUser' => $tasksPerUser, 'tasksDonePerUser' => $tasksDonePerUser]);
    }

    // data view ('createtask')
    public function createtask()
    {
        $anggotatim = User::where('role', 'anggotatim')
            ->withCount(['menerimatugas' => function ($query) {
                $query->where('active', true);
            }])
            ->get();

        $busiestUser = $anggotatim->sortByDesc('menerimatugas_count')->first();
        $maxTasks = $busiestUser ? $busiestUser->menerimatugas_count : 0;

        return view('createtask', ['anggotatim' => $anggotatim, 'busiestUser' => $busiestUser, 'maxTasks' => $maxTasks]);
    }

    // data view ('createuser')
    public function createuser()
    {
        return view('createuser');
    }

    // data view('kegiatan')
    public function kegiatan(Kegiatan $kegiatan)
    {
        $tasks = Task::where('kegiatan_id', $kegiatan->id)->paginate(5);
        if ($tasks->isEmpty()) {
            abort(404, 'Data tidak ditemukan');
        }
        $totalProgress = $tasks->sum('latestprogress');
        $totalVolume = $tasks->sum('volume');
        $persentaseProgress = $totalVolume > 0 ? round(($totalProgress / $totalVolume) * 100, 2) : 0;
        return view('kegiatan', ['tasks' => $tasks, 'persentaseprogress' => $persentaseProgress, 'kegiatan' => $kegiatan]);
    }

    // data view('task')
    public function task(Task $task)
    {
        $progress = Progress::where('task_id', $task->id)->get();
        return view('task', ['task' => $task, 'progresses'=>$progress]);
    }

    public function taskmonitoring($grouptask_slug, $slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
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