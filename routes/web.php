<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
        return view('home', ['headercontent' => 'Dashboard', 'tasks' => Task::filter(request(['search']))->paginate(5)->withQueryString()]);
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
        return view('monitoring', ['headercontent' => 'Monitoring Pekerjaan', 'anggotatim'=>User::where('role','anggotatim')->get()]);
    })->middleware('is_ketuatim');
});