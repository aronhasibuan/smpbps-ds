<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    
    protected $notifyService;

    // construct notifyservice
    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    // create task
    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'activity_name' => 'required|string|max:255',
                'activity_start' => 'required|date',
                'activity_end' => 'required|date',
                'user_member_id' => 'required|array',
                'user_member_id.*' => 'exists:users,id',
                'task_description' => 'required|array',
                'task_description.*' => 'string|max:1000',
                'task_volume' => 'required|array',
                'task_volume.*' => 'numeric',
                'task_attachment.*' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
                'activity_unit' => 'required|string|max:255',
            ]);

            $user_leader = User::find(Auth::id());
            
            $activity = Activity::create([
                'user_leader_id' => $user_leader->id,
                'activity_name' => $validatedData['activity_name'],
                'activity_slug' => '-',
                'activity_unit' => $validatedData['activity_unit'],
                'activity_start' => Carbon::parse($validatedData['activity_start'])->format('Y-m-d'),
                'activity_end' => Carbon::parse($validatedData['activity_end'])->format('Y-m-d'),
            ]);

            $activity_name_slug = Str::slug($validatedData['activity_name']);
            $activity->activity_slug = "{$activity->id}_{$activity_name_slug}";
            $activity->save();

            foreach ($validatedData['user_member_id'] as $index => $user_id) {
                $member = User::find($user_id);
                $path = null;

                if ($member->team_id == $user_leader->id){
                    $status_id = 2;
                } else {
                    $status_id = 3;
                }

                if ($request->hasFile('task_attachment') && isset($request->file('task_attachment')[$index])) {
                    $file = $request->file('task_attachment')[$index];
                    $path = $file->store('attachments', 'public');
                }
                
                $task = Task::create([
                    'activity_id' => $activity->id,
                    'user_member_id' => $user_id,
                    'status_id' => $status_id,
                    'task_slug' => '-',
                    'task_description' => $validatedData['task_description'][$index],
                    'task_volume' => $validatedData['task_volume'][$index],
                    'task_attachment' => $path ? Storage::url($path) : null,
                ]);

                $task->task_slug = "{$task->id}_{$member->user_nickname}";
                $task->save();

                Progress::create([
                    'task_id' => $task->id,
                    'progress_date' => Carbon::now()->format('Y-m-d'),
                    'progress_amount' => 0,
                    'progress_notes' => 'Tugas ditambahkan',
                    'progress_documentation' => null,
                ]);

                if ($member && $member->user_whatsapp_number) {
                    $massage = "Halo {$member->user_full_name} 👋\n";
                    $massage .= "Anda telah menerima *tugas baru* dari {$user_leader->user_full_name}.\n\n";
                    $massage .= "📌 *Nama Kegiatan*: {$validatedData['activity_name']}\n";
                    $massage .= "📝 *Deskripsi Pekerjaan*: {$validatedData['task_description'][$index]}\n";
                    $massage .= "📆 *Tenggat Waktu*: {$validatedData['activity_end']}\n";
                    $massage .= "📦 *Jumlah Pekerjaan*: {$validatedData['task_volume'][$index]} {$validatedData['activity_unit']}\n\n";
                    $massage .= "Silakan cek detail tugas dan mulai pengerjaan melalui sistem:\n";
                    $massage .= "🌐 http://smpbps-ds.test/login\n\n";
                    $massage .= "Jika ada pertanyaan, silakan hubungi pemberi tugas.\n";
                    $massage .= "Semangat menjalankan tugas! 💪";
                    $this->notifyService->sendFonnteNotification($member->user_whatsapp_number, $massage);
                }
            }
            session()->flash('success', 'Kegiatan dan tugas berhasil ditambahkan.');
            return redirect()->route('activitiesmonitoring');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
        return redirect()->back();
    }

    // update task
    public function update(Request $request, Task $task)
    {
        try{
            $validatedData = $request->validate([
                'deskripsi' => 'required|string',
                'volume' => ['required','integer', function ($attribute, $value, $fail) use ($task) {
                                    if ($value <= $task->progress) {
                                        $fail('Volume harus lebih besar dari progress saat ini');
                                    }
                                }
                            ],
                'attachment.*' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120'
            ]);

            $task->volume = $validatedData['volume'];
            $task->deskripsi = $validatedData['deskripsi'];

            if ($request->hasFile('attachment')) {
                if ($task->attachment) {
                    Storage::delete($task->attachment);
                }
                
                $path = $request->file('attachment')->store('public/task_attachments');
                $task->attachment = $path;
            }

            $task->save();
            session()->flash('updated', 'Tugas Berhasil Diperbarui');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error', 'Gagal memperbarui task: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // delete task
    public function destroy(Task $task)
    {
        $redirectUrl = route('kegiatan', $task->kegiatan);
        try {

            $task->progress()->delete();            
            if ($task->attachment) {
                Storage::delete($task->attachment);
            }
            $task->delete();
            
            return redirect($redirectUrl)->with('deleted', 'Tugas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus task: '.$e->getMessage());
        }
    }

    // update progress
    public function updateprogress(Request $request, $slug, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'progress_amount' => 'required|integer|min:' . ($task->task_latest_progress + 1) . '|max:' . $task->task_volume,
            'progress_notes' => 'required|string|max:1000',
            'progress_documentation' => 'nullable|file|mimes:jpg,png|max:5120'
        ]);

        $attachmentPath = $request->hasFile('progress_documentation') ? $request->file('progress_documentation')->store('attachments', 'public') : null;

        Progress::create([
            'task_id' => $id,
            'progress_date' => Carbon::now()->format('Y-m-d'),
            'progress_amount' => $request->progress_amount,
            'progress_notes' => $request->progress_notes,
            'progress_documentation' => $attachmentPath,
        ]);

        $task->task_latest_progress = $request->progress_amount;
    
        if ($task->task_volume == $request->progress_amount) {
            $task->status_id = 4;
            $task->save();
            return redirect('tasklist')->with('success', 'Tugas berhasil ditandai selesai!'); 
        } else{
            $task->save();
            return redirect()->back()->with('updated', 'Progress Berhasil Diperbarui!');
        }
    }

    // mark kegiatan as done
    public function markkegiatanasdone($id)
    {
        try {
            $kegiatan = Activity::findOrFail($id);

            if (!$kegiatan->active) {
                return redirect()->back()->with('error', 'Kegiatan ini sudah ditandai selesai sebelumnya.');
            }

            $unfinishedTasks = $kegiatan->tasks()->where('active', true)->count();
            if ($unfinishedTasks > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menandai kegiatan selesai karena masih ada tugas yang belum selesai.');
            }

            $kegiatan->active = false;
            $kegiatan->save();

            return redirect()->route('monitoringkegiatan')->with('success', 'Kegiatan berhasil ditandai selesai!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}