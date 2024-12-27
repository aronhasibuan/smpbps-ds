<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::get('/home', function () {
    return view('home', ['headercontent' => 'Dashboard', 'tasks' => Task::filter(request(['search']))->paginate(5)->withQueryString()]);
})->middleware('auth');

Route::get('/home/{task:slug}', function(Task $task){
    return view('task', ['headercontent' => 'Detail Tugas', 'task' => $task]);
})->middleware('auth');

Route::get('/AnggotaTim/{user:username}', function(User $user){
    // $tasks = $user->menerimatugas->load('penerimatugas');
    return view('home', ['headercontent' => count($user->menerimatugas).' Tugas Dimiliki Oleh '.$user->name, 'tasks' => $user->menerimatugas]);
})->middleware('auth');

Route::get('/KetuaTim/{user:username}', function(User $user){
    // $tasks = $user->memberitugas->load('pemberitugas');
    return view('home', ['headercontent' => count($user->memberitugas).' Tugas Diberikan Oleh '.$user->name, 'tasks' => $user->memberitugas]);
})->middleware('auth');

Route::get('/recapitulation', function () {
    return view('recapitulation', ['headercontent' => 'Rekapitulasi Pekerjaan']);
})->middleware('auth');

Route::get('/monitoring', function () {
    return view('monitoring', ['headercontent' => 'Monitoring Pekerjaan', 'pegawai1' => 'Aron Hasibuan']);
})->middleware('auth');