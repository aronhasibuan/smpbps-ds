<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DataflowController;

// GET, POST, PUT, PATCH, DELETE

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['guest'])->group(function(){
    // login
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function(){
    // logout
    Route::post('/logout', LogoutController::class)->name('logout');

    // home
    Route::get('/home', [DataflowController::class, 'home'])->name('home');
    Route::post('/home', [TaskController::class, 'create']);

    // task
    Route::get('/home/{task:slug}', [DataflowController::class, 'task']);
    Route::get('/monitoringkegiatan/{grouptask_slug}/{slug}', [DataflowController::class, 'taskmonitoring'])->name('dataflow.taskmonitoring');
    Route::post('/tasks/{id}/complete', [TaskController::class, 'updateprogress'])->name('tasks.updateprogress');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
    // task (attachment)
    Route::get('/file/{filename}', function ($filename) {
        $path = "attachments/{$filename}";
    
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
    
        return response()->file(storage_path("app/public/{$path}"));
    })->where('filename', '.*');

    // arsip
    Route::get('/arsip', [DataflowController::class, 'arsip'])->name('arsip');

    // monitoringkegiatan
    Route::get('/monitoringkegiatan', [DataflowController::class, 'monitoringkegiatan']);

    // monitoringpegawai
    Route::get('/monitoringpegawai', function(){
        return view('monitoringpegawai');
    });

    // tambahkegiatan
    Route::get('/tambahkegiatan', [DataflowController::class, 'createtask']);

    // kegiatan
    Route::get('/monitoringkegiatan/{grouptask_slug}', [DataflowController::class, 'kegiatan']);

    Route::get('/monitoring/active', [TaskController::class, 'getActiveTasks'])->name('tasks.active');
});