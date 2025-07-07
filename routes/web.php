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
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ObjectionController;

// GET, POST, PUT, PATCH, DELETE

Route::middleware(['guest'])->group(function(){

    // Landing Page
    Route::get('/', function () {
        return redirect('/login');
    })->name('landing-page');

    // view ('login')
    Route::get('/login', [DataflowController::class, 'login'])->name('login-page');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

});

Route::middleware(['auth'])->group(function(){

    # all role

        // logout
        Route::post('/logout', LogoutController::class)->name('logout');

        // view ('profile')
        Route::get('profil', [DataflowController::class, 'profile'])->name('profile-page');
        Route::put('/profil/update-password/{user}', [UserController::class, 'update_password'])->name('update-password');
       
        // view('task')
        Route::get('tugas/{task:task_slug}', [DataflowController::class, 'task'])->name('task-page');

        // attachment
        Route::get('/file/{filename}', function ($filename) {
            $path = "attachments/{$filename}";
        
            if (!Storage::disk('public')->exists($path)) {
                abort(404);
            } else{
                return response()->file(storage_path("app/public/{$path}"));
            }
        })->where('filename', '.*');

        // view ('evaluation')
        Route::get('/penilaian/{task:task_slug}', [DataflowController::class, 'evaluation'])->name('evaluation-page');
    
        // view ('calendar')
        Route::get('/kalender', [DataflowController::class, 'calendar'])->name('calendar-page');
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
            }elseif ($user->user_role === 'ketuatim') {
                $activities = Activity::where('user_leader_id', $user->id)->get()
                    ->map(function ($activity) {
                        return [
                            'title' => $activity->activity_name,
                            'start' => $activity->activity_start,
                            'end'   => $activity->activity_end,
                        ];
                    });
                return response()->json($activities);
            }elseif ($user->user_role === 'kepalabps') {
                $activities = Activity::all()
                    ->map(function ($activity) {
                        return [
                            'title' => $activity->activity_name,
                            'start' => $activity->activity_start,
                            'end'   => $activity->activity_end,
                        ];
                    });
                return response()->json($activities);
            }else{
                return response()->json([]);
            }
        })->name('calendar-api');

    # Kepala BPS dan Ketua Tim

        // view ('activitiesmonitoring')
        Route::get('/monitoring-kegiatan', [DataflowController::class, 'activities_monitoring'])->name('activities-monitoring-page');
    
        // view ('activity')
        Route::get('kegiatan/{activity:activity_slug}', [DataflowController::class, 'activity'])->name('activity-page');

        // view ('employeemonitoring)
        Route::get('/monitoring-pegawai', [DataflowController::class, 'employee_monitoring'])->name('employee-monitoring-page');

        // view ('arsipkegiatan')
        Route::get('/arsip-kegiatan', [DataflowController::class, 'activities_archive'])->name('activities-archive-page');
    
    // kepalaBPS

        // view ('employeelist')
        Route::get('/daftar-pegawai', [DataflowController::class, 'employee_list'])->name('employee-list-page');
        Route::put('/update-user/{user}', [UserController::class, 'update'])->name('update-user');
        Route::delete('/delete-user/{user}', [UserController::class, 'delete'])->name('delete-user');

        // view createuser
        Route::get('/tambah-pegawai', [DataflowController::class, 'create_employee'])->name('create-employee-page');
        Route::post('/tambah-pegawai', [UserController::class, 'create'])->name('create-employee');

    // ketua tim
        
        // view home
        Route::get('/beranda-ketua-tim', [DataflowController::class, 'team_leader_home_page'])->name('team-leader-home-page');

        // view activity
        Route::put('kegiatan/{id}', [ActivityController::class, 'update'])->name('update-activity');
        Route::post('kegiatan/tandai-kegiatan-selesai/{id}', [ActivityController::class, 'mark_activity_as_done'])->name('mark-activity-as-done');
        Route::post('kegiatan/{id}', [TaskController::class, 'add_assignee'])->name('add-assignee');

        // view task
        Route::put('tugas/{task}', [TaskController::class, 'update'])->name('update-task');
        Route::delete('tugas/{task}', [TaskController::class, 'destroy'])->name('delete-task');

        // view tambahkegiatan
        Route::get('/tambah-kegiatan', [DataflowController::class, 'create_task'])->name('create-task-page');
        Route::post('/tambah-kegiatan', [TaskController::class, 'create'])->name('create-task');

        // view verification
        Route::get('/verifikasi', [DataflowController::class, 'verification'])->name('verification-page');
        Route::put('/verifikasi/perbarui-volume-pekerjaan/{id}', [TaskController::class, 'update_volume'])->name('update-volume');
        Route::post('/verifikasi/setuju-progress/{id}', [ProgressController::class, 'approve_progress'])->name('approve-progress');
        Route::delete('/verifikasi/tolak-progress/{id}', [ProgressController::class, 'reject_progress'])->name('reject-progress');
        Route::post('/verifikasi/tandai-tugas-selesai/{id}', [TaskController::class, 'mark_done'])->name('mark-done');
        Route::delete('/verifikasi/hapus-tugas/{id}', [TaskController::class, 'delete_task'])->name('delete-task-from-verification');
        Route::post('/verifikasi/tolak-sanggahan/{id}', [ObjectionController::class, 'reject_objection'])->name('reject-objection');
        Route::post('/verifikasi/tugas-selesai/{id}', [EvaluationController::class, 'create'])->name('create-evaluation');
        Route::post('/verifikasi/setujui-tugas-lintas-tim/{id}', [TaskController::class, 'cross_team_approve'])->name('cross-team-approve');
        Route::delete('/verifikasi/tolak-tugas-lintas-tim/{id}', [TaskController::class, 'cross_team_reject'])->name('cross-team-reject');

    // anggota tim

        // view home
        Route::get('/beranda-anggota-tim', [DataflowController::class, 'team_member_home_page'])->name('team-member-home-page');

        // view tasklist
        Route::get('/daftartugas', [DataflowController::class, 'task_list'])->name('task-list-page');

        // view task
        Route::post('tugas/{task:task_slug}/{id}', [TaskController::class, 'update_progress'])->name('update-progress');
        Route::post('tugas/{id}', [ObjectionController::class, 'create'])->name('create-objection');
        
        // view taskarchive
        Route::get('/arsip-tugas', [DataflowController::class, 'task_archive'])->name('task-archive-page');
});