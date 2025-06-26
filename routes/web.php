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
use App\Http\Controllers\ObjectionController;

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
        Route::get('{user:user_role}/profil', [DataflowController::class, 'profile'])->name('profile');
        Route::put('/profile/updatepassword/{user}', [UserController::class, 'updatepassword'])->name('updatepassword');

        // Calendar
        Route::get('/api/tasks/calendar', function () {
            $user = Auth::user();

            if ($user->user_role === 'anggotatim') {
                $tasks = Task::with('activity')
                    ->where('user_member_id', $user->id)
                    ->get()
                    ->map(function ($task) {
                        return [
                            'title' => $task->activity->activity_name ?? '-',
                            'start' => $task->activity->activity_start ?? $task->created_at,
                            'end'   => $task->activity->activity_end ?? $task->created_at,
                        ];
                    });
                return response()->json($tasks);
            }

            if ($user->user_role === 'ketuatim') {
                $activities = Activity::where('user_leader_id', $user->id)->get()
                    ->map(function ($activity) {
                        return [
                            'title' => $activity->activity_name,
                            'start' => $activity->activity_start,
                            'end'   => $activity->activity_end,
                        ];
                    });
                return response()->json($activities);
            }

            if ($user->user_role === 'kepalabps') {
                $activities = Activity::all()
                    ->map(function ($activity) {
                        return [
                            'title' => $activity->activity_name,
                            'start' => $activity->activity_start,
                            'end'   => $activity->activity_end,
                        ];
                    });
                return response()->json($activities);
            }

            return response()->json([]);
        })->middleware('auth');

        // view evaluation
        Route::get('/arsip/penilaian/{task:task_slug}', [DataflowController::class, 'evaluation'])->name('evaluation');
    
    // kepalaBPS
        // view employeelist
        Route::get('/kepalabps/daftarpegawai', [DataflowController::class, 'employeelist'])->name('employeelist');
        Route::put('/kepalabps/updateuser/{user}', [UserController::class, 'update'])->name('updateuser');
        Route::delete('/kepalabps/deleteuser/{user}', [UserController::class, 'delete'])->name('deleteuser');

        // view createuser
        Route::get('/kepalabps/tambahpegawai', [DataflowController::class, 'createemployee']);
        Route::post('/kepalabps/tambahpegawai', [UserController::class, 'create'])->name('createemployee');

        // view activitiesmonitoring
        Route::get('/kepalabps/monitoringkegiatan', [DataflowController::class, 'activitiesmonitoring'])->name('activitiesmonitoring');

        // view activity
        Route::get('/kepalabps/monitoringkegiatan/{activity:activity_slug}', [DataflowController::class, 'activity'])->name('activity');

        // view task
        Route::get('/kepalabps/monitoringkegiatan/{activity_slug}/{slug}', [DataflowController::class, 'taskmonitoring'])->name('taskmonitoring_kepalabps');

        // view employeemonitoring
        Route::get('/kepalabps/monitoringpegawai', [DataflowController::class, 'employeemonitoring'])->name('employeemonitoring');
        
        // view arsipkegiatan
        Route::get('/kepalabps/arsipkegiatan', [DataflowController::class, 'activitiesarchive'])->name('activitiesarchive');

        // view calendar
        Route::get('/kepalabps/kalender', [DataflowController::class, 'calendar'])->name('calendar');

    // ketua tim

        // view activitiesmonitoring
        Route::get('/ketuatim/monitoringkegiatan', [DataflowController::class, 'activitiesmonitoring'])->name('activitiesmonitoring_ketuatim');
        
        // view activity
        Route::get('/ketuatim/monitoringkegiatan/{activity:activity_slug}', [DataflowController::class, 'activity'])->name('activity');
        Route::post('/ketuatim/monitoringkegiatan/{activity:activity_slug}/{id}', [TaskController::class, 'markkegiatanasdone'])->name('markkegiatanasdone');
        Route::put('/ketuatim/monitoringkegiatan/{activity}', [ActivityController::class, 'update'])->name('updatekegiatan');

        // view task
        Route::get('/ketuatim/monitoringkegiatan/{activity_slug}/{slug}', [DataflowController::class, 'taskmonitoring'])->name('taskmonitoring_ketuatim');
        Route::put('/ketuatim/tasks/{task}', [TaskController::class, 'update'])->name('updatetask');
        Route::delete('/ketuatim/tasks/{task}', [TaskController::class, 'destroy'])->name('deletetask');

        // view monitoringpegawai
        Route::get('/ketuatim/monitoringpegawai', [DataflowController::class, 'employeemonitoring'])->name('tasks.active');

        // view arsipkegiatan
        Route::get('/ketuatim/arsipkegiatan', [DataflowController::class, 'activitiesarchive'])->name('activitiesarchive');

        // view tambahkegiatan
        Route::get('/ketuatim/tambahkegiatan', [DataflowController::class, 'createtask']);
        Route::post('/ketuatim/monitoringkegiatan', [TaskController::class, 'create'])->name('task.create');

        // view calendar
        Route::get('/ketuatim/kalender', [DataflowController::class, 'calendar'])->name('calendar');

        // view verification
        Route::get('/ketuatim/verifikasi', [DataflowController::class, 'verification'])->name('verification');

        // view home
        Route::get('/ketuatim/home', [DataflowController::class, 'home_leader'])->name('home_leader');

    // anggota tim

        // view home
        Route::get('/anggotatim/beranda', [DataflowController::class, 'home'])->name('home');

        // view tasklist
        Route::get('/anggotatim/daftartugas', [DataflowController::class, 'tasklist'])->name('tasklist');

        // view task
        Route::get('/anggotatim/daftartugas/{task:task_slug}', [DataflowController::class, 'task']);
        Route::post('/anggotatim/daftartugas/{task:task_slug}/{id}', [TaskController::class, 'updateprogress'])->name('updateprogress');
        Route::post('{user:user_role}/daftartugas/{task:task_slug}/keberatan/{id}', [ObjectionController::class, 'create'])->name('createobjection');
        
        // view taskarchive
        Route::get('/anggotatim/arsiptugas', [DataflowController::class, 'taskarchive'])->name('taskarchive');

        // view nilai
        Route::get('/anggotatim/arsip/penilaian/{task:task_slug}', [DataflowController::class, 'penilaian'])->name('penilaian');

        // view calendar
        Route::get('/anggotatim/kalender', [DataflowController::class, 'calendar'])->name('calendar');
});