<?php

use App\Models\Task;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DataflowController;
use App\Http\Controllers\KegiatanController;

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

        // Calendar
        Route::get('/api/tasks/calendar', function () {
            $user = Auth::user();
            return Task::where('penerimatugas_id', $user->id)->select([
                'namakegiatan as title',
                'created_at as start',
                'tenggat as end'
            ])->get();
        })->middleware('auth');

        Route::get('/kalender', [DataflowController::class, 'kalender'])->name('kalender');

    // kepalaBPS
        // view employeelist
        Route::get('/kepalabps/daftarpegawai', [DataflowController::class, 'employeelist'])->name('employeelist');
        Route::put('/kepalabps/updateuser/{user}', [UserController::class, 'update'])->name('updateuser');
        Route::delete('/kepalabps/deleteuser/{user}', [UserController::class, 'delete'])->name('deleteuser');

        // view createuser
        Route::get('/kepalabps/createuser', [DataflowController::class, 'createuser']);
        Route::post('/kepalabps/createuser', [UserController::class, 'create'])->name('createuser');

        // view activitiesmonitoring
        Route::get('/kepalabps/monitoringkegiatan', [DataflowController::class, 'activitiesmonitoring'])->name('activitiesmonitoring');

        // view employeemonitoring
        Route::get('/kepalabps/monitoringpegawai', [DataflowController::class, 'employeemonitoring'])->name('employeemonitoring');
        
    // anggota tim

        // view home
        Route::get('/anggotatim/beranda', [DataflowController::class, 'home'])->name('home');

        // view tasklist
        Route::get('/anggotatim/daftartugas', [DataflowController::class, 'tasklist'])->name('tasklist');

        // view task
        Route::get('/daftartugas/{task:slug}', [DataflowController::class, 'task']);
        Route::post('/daftartugas/{task:slug}/{id}', [TaskController::class, 'updateprogress'])->name('updateprogress');
        
        // view taskarchive
        Route::get('/anggotatim/arsiptugas', [DataflowController::class, 'taskarchive'])->name('taskarchive');

        // view nilai
        Route::get('/arsip/penilaian/{task:slug}', [DataflowController::class, 'penilaian'])->name('penilaian');

        // view calendar
        Route::get('/anggotatim/kalender', [DataflowController::class, 'kalender'])->name('kalender');
        
    // ketua tim

        // view activitiesmonitoring
        Route::get('/ketuatim/monitoringkegiatan', [DataflowController::class, 'activitiesmonitoring'])->name('activitiesmonitoring');
        
        // view kegiatan
        Route::get('/monitoringkegiatan/{kegiatan:slug}', [DataflowController::class, 'kegiatan'])->name('kegiatan');
        Route::post('/monitoringkegiatan/{kegiatan:slug}/{id}', [TaskController::class, 'markkegiatanasdone'])->name('markkegiatanasdone');
        Route::put('/monitoringkegiatan/{kegiatan}', [ActivityController::class, 'update'])->name('updatekegiatan');

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