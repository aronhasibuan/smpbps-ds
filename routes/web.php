<?php

use App\Models\Task;
use App\Models\User;
use App\Models\Importance;
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
        $tasks = Task::where('penerimatugas_id', $user->id)
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('home', ['headercontent' => 'Dashboard', 'tasks' => $tasks]);
    });

    Route::get('/home/{task:slug}', function(Task $task){
        return view('task', ['headercontent' => 'Detail Tugas', 'task' => $task]);
    });

    Route::get('/AnggotaTim/{user:username}', function(User $user){
        return view('home', ['headercontent' => count($user->menerimatugas).' Tugas Dimiliki Oleh '.$user->name, 'tasks' => $user->menerimatugas]);
    });

    Route::get('/KetuaTim/{user:username}', function(User $user){
        return view('home', ['headercontent' => count($user->memberitugas).' Tugas Diberikan Oleh '.$user->name, 'tasks' => $user->memberitugas]);
    });
    
    Route::get('/recapitulation', function () {
        return view('recapitulation', ['headercontent' => 'Rekapitulasi Pekerjaan']);
    });

    Route::get('/monitoring', function () {
        $groupedTasks = Task::groupedByKemajuan();
        return view('monitoring', [ 'headercontent' => 'Monitoring Pekerjaan', 
                                    'anggotatim'=>User::where('role','anggotatim')->get(), 
                                    'groupedtasks' => $groupedTasks,
                                ]);
    })->name('monitoring')->middleware('is_ketuatim');

    Route::post('/monitoring', [TaskController::class, 'create']);

    Route::get('/monitoring/{task:slug}', function(Task $task){
        return view('task', ['headercontent' => 'Detail Tugas', 'task' => $task]);
    });

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});