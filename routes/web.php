<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function(){
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/home', function () {
        $user = Auth::user();
        $tasksQuery = Task::select(
            'tasks.*',
            DB::raw("
                CEIL(DATEDIFF(NOW(), created_at)) + 1 AS hariberlalu_MySQL,
                DATEDIFF(tenggat, created_at) + 1 AS selangharitugas_MySQL,
                CEIL(volume / (DATEDIFF(tenggat, created_at) + 1)) AS targetperhari_MySQL,
                LEAST(volume, CEIL((DATEDIFF(NOW(), created_at)+1) * (volume / (DATEDIFF(tenggat, created_at) + 1)))) AS targetharustercapai_MySQL,
                
                FLOOR((progress / volume) * 100) AS percentage_progress,

                CASE 
                WHEN tenggat < CURDATE() THEN 1
                WHEN progress < CEIL((DATEDIFF(NOW(), created_at)+1) * (volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 2
                WHEN progress = CEIL((DATEDIFF(NOW(), created_at)+1) * (volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 3
                WHEN progress > CEIL((DATEDIFF(NOW(), created_at)+1) * (volume / (DATEDIFF(tenggat, created_at) + 1))) THEN 4  
                END AS kodekategori
            ")
        )->where('active', true)->filter(request(['search']));
    
        $filter = request('filter');

        if ($filter) {
            switch ($filter) {
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

        if ($user->role === 'anggotatim') {
            $tasksQuery->where('penerimatugas_id', $user->id);
        } elseif ($user->role === 'ketuatim') {
            $tasksQuery->where('pemberitugas_id', $user->id);
        }
    
        $sort = request('sort', 'priority'); 
    
        if (in_array($sort, ['id', 'tenggat'])) {
            $tasksQuery->orderBy($sort);
        } elseif ($sort === 'priority'){
            $tasksQuery->orderBy('kodekategori')->orderBy('tenggat','ASC')->orderBy('percentage_progress','ASC');            
        }
    
        $tasks = $tasksQuery->paginate(5)->withQueryString();
    
        return view('home', [
            'anggotatim' => User::where('role', 'anggotatim')->get(),
            'tasks' => $tasks,
        ]);
    })->name('home');
    
    Route::post('/home', [TaskController::class, 'create']);

    Route::get('/home/{task:slug}', function(Task $task){
        return view('task', ['task' => $task]);
    });
    
    Route::get('/arsip', function () {
        $user = Auth::user();
        $tasks = Task::where('penerimatugas_id', $user->id)->where('active',false)->get();
        return view('arsip', ['tasks' => $tasks]);
    });

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::post('/tasks/{id}/complete', [TaskController::class, 'markAsDone'])->name('tasks.complete');

    Route::get('/file/{filename}', function ($filename) {
        $path = "attachments/{$filename}";
    
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
    
        return response()->file(storage_path("app/public/{$path}"));
    })->where('filename', '.*');

    Route::get('/monitoring', function(){
        return view('monitoring');
    });

    Route::get('/monitoring/active', [TaskController::class, 'getActiveTasks'])->name('tasks.active');
});