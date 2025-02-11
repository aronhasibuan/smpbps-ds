<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        $tasksQuery = Task::where('active', true)->filter(request(['search']));
    
        if ($user->role === 'anggotatim') {
            $tasksQuery->where('penerimatugas_id', $user->id);
        } elseif ($user->role === 'ketuatim') {
            $tasksQuery->where('pemberitugas_id', $user->id);
        }
    
        $sort = request('sort', 'id'); 
    
        if (in_array($sort, ['id', 'tenggat', 'priority'])) {
            $tasksQuery->orderBy($sort);
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
    
    Route::get('/recapitulation', function () {
        $user = Auth::user();
        $tasks = Task::where('penerimatugas_id', $user->id)->where('active',false)->get();
        return view('recapitulation', ['headercontent' => 'Rekapitulasi Pekerjaan', 'tasks' => $tasks]);
    });

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::post('/tasks/{id}/complete', [TaskController::class, 'markAsDone'])->name('tasks.complete');

});