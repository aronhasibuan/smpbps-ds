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

class TaskController extends Controller
{
    
    protected $notifyService;

    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    public function home(Request $request)
    {
        $user = Auth::user();

        $tasksQuery = Task::where('penerimatugas_id', $user->id)
        ->where('active', true)
        ->select(
            'tasks.*',
            DB::raw("
                (SELECT p.progress FROM progress p WHERE p.task_id = tasks.id ORDER BY p.created_at DESC LIMIT 1) AS progress_terbaru"),
            DB::raw("
                CEIL(DATEDIFF(NOW(), created_at)) + 1 AS hariberlalu_MySQL,
                DATEDIFF(tenggat, created_at) + 1 AS selangharitugas_MySQL,
                CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)) AS targetperhari_MySQL,
                LEAST(volume, (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)))) AS targetharustercapai_MySQL,

                FLOOR((IFNULL((SELECT p.progress FROM progress p WHERE p.task_id = tasks.id ORDER BY p.created_at DESC LIMIT 1), 0) / volume) * 100) AS percentage_progress,

                CASE 
                    WHEN tenggat < CURDATE() THEN 1
                    WHEN IFNULL((SELECT p.progress 
                     FROM progress p 
                     WHERE p.task_id = tasks.id 
                     ORDER BY p.created_at DESC 
                     LIMIT 1), 0) 
                    < (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 2
                    WHEN IFNULL((SELECT p.progress 
                     FROM progress p 
                     WHERE p.task_id = tasks.id 
                     ORDER BY p.created_at DESC 
                     LIMIT 1), 0) 
                    = (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 3
                    WHEN IFNULL((SELECT p.progress 
                     FROM progress p 
                     WHERE p.task_id = tasks.id 
                     ORDER BY p.created_at DESC 
                     LIMIT 1), 0) 
                    > (CEIL(DATEDIFF(NOW(), created_at)+1) * CEIL(volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 4  
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

    public function arsip()
    {
        $user = Auth::user();
        $tasks = Task::where('penerimatugas_id', $user->id)
            ->where('active', false)
            ->get();

        return view('arsip', ['tasks' => $tasks]);
    }

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

    public function kegiatan($grouptask_slug)
    {
        $tasks = Task::where('grouptask_slug', $grouptask_slug)->paginate(5);
        if ($tasks->isEmpty()) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('kegiatan', ['tasks' => $tasks]);
    }

    public function task(Task $task)
    {
        $progress = Progress::where('task_id', $task->id)->get();
        return view('task', ['task' => $task, 'progresses'=>$progress]);
    }

    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'namakegiatan' => 'required|string|max:255',
                'deskripsi' => 'required|array',
                'deskripsi.*' => 'string|max:1000',
                'volume' => 'required|array',
                'volume.*' => 'numeric',
                'satuan' => 'required|string|max:255',
                'tenggat' => 'required|date',
                'penerimatugas_id' => 'required|array',
                'penerimatugas_id.*' => 'exists:users,id',
                'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
            ]);

            $attachmentPath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;

            $lastGroupTaskId = Task::latest('grouptask_id')->first()->grouptask_id ?? 0;
            $newGroupTaskId = $lastGroupTaskId + 1;
            $judulSlug = Str::slug($validatedData['namakegiatan']);
            $grouptask_slug = "{$newGroupTaskId}_{$judulSlug}";

            foreach ($validatedData['penerimatugas_id'] as $index => $penerimaId) {
                $lastTaskId = Task::latest('id')->first()->id ?? 0;
                $newTaskId = $lastTaskId + 1;

                $penerima = User::find($penerimaId);
                $slug = "{$newTaskId}_{$penerima->username}";

            
                Task::create([
                    'namakegiatan' => $validatedData['namakegiatan'],
                    'slug' => $slug,
                    'deskripsi' => $validatedData['deskripsi'][$index],
                    'volume' => $validatedData['volume'][$index],
                    'satuan' => $validatedData['satuan'],
                    'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                    'pemberitugas_id' => Auth::id(),
                    'penerimatugas_id' => $penerimaId,
                    'grouptask_id' => $newGroupTaskId,
                    'grouptask_slug' => $grouptask_slug,
                    'attachment' => $attachmentPath,
                ]);

                Progress::create([
                    'task_id' => $newTaskId,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'progress' => 0,
                    'dokumentasi' => null,
                ]);

                if ($penerima && $penerima->no_hp) {
                    $pesanNotifikasi = "Halo {$penerima->name}. Anda telah menerima tugas baru dalam kegiatan {$validatedData['namakegiatan']}. Silakan cek http://smpbps-ds.test/login untuk info lebih lanjut.";
                    $this->notifyService->sendFonnteNotification($penerima->no_hp, $pesanNotifikasi);
                }
            }
            session()->flash('success', 'Kegiatan dan tugas berhasil ditambahkan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
        return redirect()->back();
    }

    public function update(Request $request, Task $task){
        $validatedData = $request->validate([
            'namakegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'volume' => 'required|integer|min:1',
            'tenggat' => 'required|date',
        ]);

        $task->update($validatedData);

        session()->flash('updated', 'Tugas Berhasil Diperbarui');
        return redirect()->back();
    }


    public function destroy(Task $task){
        $task->delete();
        return redirect('/monitoring')->with('deleted', 'Tugas berhasil dihapus');
    }

    public function updateprogress(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:' . ($task->latest_progress + 1) . '|max:' . $task->volume,
            'dokumentasi' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120'
        ]);

        $attachmentPath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;

        Progress::create([
            'task_id' => $id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'progress' => $request->quantity,
            'dokumentasi' => $attachmentPath,
        ]);
    
        if ($task->volume == $request->quantity) {
            $task->active = false;
            $task->save();
            return redirect('home')->with('success', 'Tugas berhasil ditandai selesai!'); 
        }

        $task->save();

        return redirect('home')->with('success', 'Progress berhasil diperbarui!');
    }


    public function getActiveTasks()
    {
        $tasks = User::where('role', 'anggotatim')
            ->leftJoin('tasks', 'users.id', '=', 'tasks.penerimatugas_id')
            ->select('users.name as nama', DB::raw('COUNT(tasks.id) as jumlah_tugas'))
            ->where(function ($query) {
                $query->where('tasks.active', 1)
                      ->orWhereNull('tasks.active');
            })
            ->groupBy('users.id', 'users.name')
            ->get();

        return response()->json($tasks);
    }
}