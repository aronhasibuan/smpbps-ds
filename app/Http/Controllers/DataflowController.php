<?php

namespace App\Http\Controllers;

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

    // data view('home')
    public function home(Request $request)
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

        $tasks = $tasksQuery->paginate(5)->withQueryString();

        return view('home', ['tasks' => $tasks]);
    }

    // data view('arsip')
    public function arsip()
    {
        $user = Auth::user();
        $tasks = Task::where('penerimatugas_id', $user->id)
            ->where('active', false)
            ->get();

        return view('arsip', ['tasks' => $tasks]);
    }

    // data view('monitoringkegiatan')
    public function monitoringkegiatan()
    {
        $user = Auth::user();

        $groups = Task::selectRaw('tasks.grouptask_slug, tasks.namakegiatan, SUM(tasks.volume) as total_volume, MAX(tasks.tenggat) as tenggat, COALESCE(SUM(progress.progress), 0) as total_progress')
            ->leftJoin('progress','tasks.id','=','progress.task_id')
            ->where('pemberitugas_id', $user->id)
            ->groupBy('grouptask_slug', 'namakegiatan')
            ->paginate(5);

        $groups->getCollection()->transform(function($group){
            $group->percentage = $group->total_volume > 0 ? ($group->total_progress/$group->total_volume)*100 : 0;
            return $group;
        });

        $anggotatim = User::where('role', 'anggotatim')->get();

        return view('monitoringkegiatan', ['groups' => $groups, 'anggotatim' => $anggotatim]);
    }

    // data view('kegiatan')
    public function kegiatan($grouptask_slug)
    {
        $tasks = Task::where('grouptask_slug', $grouptask_slug)->paginate(5);
        if ($tasks->isEmpty()) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('kegiatan', ['tasks' => $tasks]);
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
}
