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
use App\Http\Controllers\UserController;

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

    // administrator
    Route::get('/administrator', [DataflowController::class, 'administrator'])->name('administrator');

    // home
    Route::get('/home', [DataflowController::class, 'home'])->name('home');

    // task
    Route::get('/home/{task:slug}', [DataflowController::class, 'task']);
    Route::get('/monitoringkegiatan/{kegiatan_slug}/{slug}', [DataflowController::class, 'taskmonitoring'])->name('dataflow.taskmonitoring');
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

    // arsipkegiatan
    Route::get('/arsipkegiatan', [DataflowController::class, 'arsipkegiatan'])->name('arsipkegiatan')->name('arsipkegiatan');

    // monitoringkegiatan
    Route::get('/monitoringkegiatan', [DataflowController::class, 'monitoringkegiatan'])->name('monitoringkegiatan');

    // monitoringpegawai
    Route::get('/monitoringpegawai', [DataflowController::class, 'monitoringpegawai'])->name('tasks.active');

    // tambahkegiatan
    Route::get('/tambahkegiatan', [DataflowController::class, 'createtask']);
    Route::post('/home', [TaskController::class, 'create'])->name('task.create');

    // tambahpengguna
    Route::get('/tambahpengguna', [DataflowController::class, 'createuser']);
    Route::post('/tambahpengguna', [UserController::class, 'create'])->name('user.create');

    // kegiatan
    Route::get('/monitoringkegiatan/{kegiatan:slug}', [DataflowController::class, 'kegiatan'])->name('kegiatan');
    Route::post('/monitoringkegiatan/{kegiatan:slug}/{id}/complete', [TaskController::class, 'markKegiatanAsDone'])->name('kegiatan.markAsDone');
});