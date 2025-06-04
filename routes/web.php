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
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserController;

// GET, POST, PUT, PATCH, DELETE

Route::middleware(['guest'])->group(function(){
    // login
    Route::get('/', function () {return redirect('/login');});
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function(){

    // all role
        // logout
        Route::post('/logout', LogoutController::class)->name('logout');

        // attachment
        Route::get('/file/{filename}', function ($filename) {
            $path = "attachments/{$filename}";
        
            if (!Storage::disk('public')->exists($path)) {
                abort(404);
            } else{
                return response()->file(storage_path("app/public/{$path}"));
            }

        })->where('filename', '.*');

        // view profile
        Route::get('/profile', [DataflowController::class, 'profile'])->name('profile');
        Route::put('/profile/updatepassword/{user}', [UserController::class, 'updatepassword'])->name('updatepassword');

        // Kalender
        Route::get('/api/tasks/calendar', function () {
            $user = Auth::user();
            return Task::where('penerimatugas_id', $user->id)->select([
                'namakegiatan as title',
                'created_at as start',
                'tenggat as end'
            ])->get();
        })->middleware('auth');

        Route::get('/kalender', [DataflowController::class, 'kalender'])->name('kalender');

    // administrator
        // view administrator
        Route::get('/administrator', [DataflowController::class, 'administrator'])->name('administrator');
        Route::put('/administrator/updateuser/{user}', [UserController::class, 'update'])->name('updateuser');
        Route::delete('/administrator/deleteuser/{user}', [UserController::class, 'delete'])->name('deleteuser');

        // view createuser
        Route::get('/administrator/createuser', [DataflowController::class, 'createuser']);
        Route::post('/administrator/createuser', [UserController::class, 'create'])->name('createuser');


    // anggota tim

        // view home
        Route::get('/home', [DataflowController::class, 'home'])->name('home');

        // view daftartugas
        Route::get('/daftartugas', [DataflowController::class, 'daftartugas'])->name('daftartugas');

        // view task
        Route::get('/daftartugas/{task:slug}', [DataflowController::class, 'task']);
        Route::post('/daftartugas/{task:slug}/{id}', [TaskController::class, 'updateprogress'])->name('updateprogress');
        
        // view arsip
        Route::get('/arsip', [DataflowController::class, 'arsip'])->name('arsip');

        // view nilai
        Route::get('/arsip/penilaian/{task:slug}', [DataflowController::class, 'penilaian'])->name('penilaian');

    // ketua tim

        // view monitoringkegiatan
        Route::get('/monitoringkegiatan', [DataflowController::class, 'monitoringkegiatan'])->name('monitoringkegiatan');
        
        // view kegiatan
        Route::get('/monitoringkegiatan/{kegiatan:slug}', [DataflowController::class, 'kegiatan'])->name('kegiatan');
        Route::post('/monitoringkegiatan/{kegiatan:slug}/{id}', [TaskController::class, 'markkegiatanasdone'])->name('markkegiatanasdone');
        Route::put('/monitoringkegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('updatekegiatan');

        // view task
        Route::get('/monitoringkegiatan/{kegiatan_slug}/{slug}', [DataflowController::class, 'taskmonitoring'])->name('taskmonitoring');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('updatetask');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('deletetask');

        // view monitoringpegawai
        Route::get('/monitoringpegawai', [DataflowController::class, 'monitoringpegawai'])->name('tasks.active');

        // view arsipkegiatan
        Route::get('/arsipkegiatan', [DataflowController::class, 'arsipkegiatan'])->name('arsipkegiatan');

        // view tambahkegiatan
        Route::get('/tambahkegiatan', [DataflowController::class, 'createtask']);
        Route::post('/monitoringkegiatan', [TaskController::class, 'create'])->name('task.create');
});