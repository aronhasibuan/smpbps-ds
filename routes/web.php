<?php

use App\Models\Task;
use App\Models\User;
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

    Route::get('/home', [TaskController::class, 'home'])->name('home');
    
    Route::post('/home', [TaskController::class, 'create']);

    Route::get('/home/{task:slug}', function(Task $task){
        return view('task', ['task' => $task]);
    });
    
    Route::get('/arsip', [TaskController::class, 'arsip'])->name('arsip');

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

    Route::get('/monitoringkegiatan', [TaskController::class, 'monitoringkegiatan']);

    Route::get('/monitoringkegiatan/{grouptask_slug}', [TaskController::class, 'kegiatan']);

    Route::get('/monitoringpegawai', function(){
        return view('monitoringpegawai');
    });

    Route::get('/monitoring/active', [TaskController::class, 'getActiveTasks'])->name('tasks.active');
});