<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Evaluation;
use App\Models\Objection;
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
        $user_leader = User::find(Auth::id());

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
                'progress_acceptance' => 1,
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
        return redirect()->route('activities-monitoring-page');
    }

    // update task
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'task_volume' => ['required','integer', function ($value, $fail) use ($task) {
                                if ($value <= $task->task_latest_progress) {
                                    $fail('Volume harus lebih besar dari progress saat ini');
                                }
                            }
                        ],
            'task_description' => 'required|string',
            'attachment.*' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120'
        ]);

        $task->task_volume = $validatedData['task_volume'];
        $task->task_description = $validatedData['task_description'];

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
    }

    // delete task
    public function destroy(Task $task)
    {
        $task->progress()->delete();
        $task->objection()->delete();
        $task->evaluation()->delete(); 
        
        if ($task->attachment) {
            Storage::delete($task->attachment);
        }
        $task->delete();   
        return redirect(Route('activities-monitoring-page'))->with('deleted', 'Tugas berhasil dihapus');
    }

    // update progress
    public function update_progress(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'progress_amount' => 'required|integer|min:' . ($task->task_latest_progress + 1) . '|max:' . $task->task_volume,
            'progress_notes' => 'required|string|max:1000',
            'progress_documentation' => 'nullable|file|mimes:jpg,png|max:5120'
        ]);

        $attachmentPath = $request->hasFile('progress_documentation') ? $request->file('progress_documentation')->store('attachments', 'public') : null;

        $latestProgress = Progress::where('task_id', $task->id)
            ->orderBy('progress_date', 'desc')
            ->first();

        if ($latestProgress->progress_date == Carbon::now()->format('Y-m-d')) {
            $latestProgress->progress_date = Carbon::now()->format('Y-m-d');
            $latestProgress->progress_amount = $request->progress_amount;
            $latestProgress->progress_notes = $request->progress_notes;
            $latestProgress->progress_documentation = $attachmentPath;
            $latestProgress->progress_acceptance = 0;
            $latestProgress->save();
            return redirect()->back()->with('updated', 'Progress berhasil diperbarui!');
        }else {
            Progress::create([
                'task_id' => $task->id,
                'progress_date' => Carbon::now()->format('Y-m-d'),
                'progress_amount' => $request->progress_amount,
                'progress_notes' => $request->progress_notes,
                'progress_documentation' => $attachmentPath,
                'progress_acceptance' => 0,
            ]);
            return redirect()->back()->with('updated', 'Progress Berhasil Diperbarui! Menunggu Persetujuan dari ketua tim.');
        }
    }

    // update volume
    public function update_volume(Request $request, $id)
    {
        $objection = Objection::findOrFail($id);
        $task = $objection->task;

        $request->validate([
            'new_volume' => 'required|integer|min:' . ($task->task_latest_progress + 1) . '|max:' . ($task->task_volume - 1),
        ]);

        $task->task_volume = $request->new_volume;
        $task->save();

        $objection->objection_status = 'diterima';
        $objection->save();
        return redirect()->back()->with('updated', 'Volume pekerjaan berhasil diperbarui!');
    }

    // mark task as done from objection
    public function mark_done(Request $request, $id){

        $request->validate([
            'evaluation_tidiness' => 'required',
            'evaluation_comprehensiveness' => 'required',
        ]);

        $objection = Objection::findOrFail($id);
        $task = $objection->task;

        $task->task_volume = $task->task_latest_progress;
        $task->status_id = 1;
        $task->save();

        $objection->objection_status = 'diterima';
        $objection->save();

        Evaluation::create([
            'task_id' => $task->id,
            'evaluation_tidiness' => $request->evaluation_tidiness,
            'evaluation_comprehensiveness' => $request->evaluation_comprehensiveness,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditandai sebagai selesai!');
    }

    // delete task from objection
    public function delete_task($id){
        $objection = Objection::findOrFail($id);
        $task = $objection->task;
        $task->progress()->delete();
        $task->objection()->delete();
        if ($task->task_attachment) {
            Storage::delete($task->task_attachment);
        }
        $task->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }

    public function cross_team_approve($id)
    {
        $task = Task::findOrFail($id);
        $task->status_id = 2;
        $task->save();
        return redirect()->back()->with('success', 'Tugas berhasil disetujui!');
    }

    public function cross_team_reject($id)
    {
        $task = Task::findOrFail($id);
        $task->progress()->delete();
        $task->delete();
        return redirect()->back()->with('success', 'Tugas berhasil ditolak!');
    }

    public function add_assignee(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $validatedData = $request->validate([
            'user_member_id' => 'required|exists:users,id',
            'task_description' => 'required|string|max:1000',
            'task_volume' => 'required|integer|min:1',
            'task_attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
        ]);

        $member = User::find($validatedData['user_member_id']);
        $team_leader = User::find(Auth::id());
        
        $status_id = ($member->team_id == $team_leader->team_id) ? 2 : 3;

        $file = $request->file('task_attachment');
        $path = $file ? $file->store('attachments', 'public') : null;

        $task = Task::create([
            'activity_id' => $activity->id,
            'user_member_id' => $validatedData['user_member_id'],
            'status_id' => $status_id,
            'task_slug' => '-',
            'task_description' => $validatedData['task_description'],
            'task_volume' => $validatedData['task_volume'],
            'task_attachment' => $path ? Storage::url($path) : null,
        ]);

        $task->task_slug = "{$task->id}_{$member->user_nickname}";
        $task->save();

        if ($member && $member->user_whatsapp_number) {
            $massage = "Halo {$member->user_full_name} 👋\n";
            $massage .= "Anda telah menerima *tugas baru* dari {$team_leader->user_full_name}.\n\n";
            $massage .= "📌 *Nama Kegiatan*: {$activity->activity_name}\n";
            $massage .= "📝 *Deskripsi Pekerjaan*: {$validatedData['task_description']}\n";
            $massage .= "📆 *Tenggat Waktu*: {$activity->activity_end}\n";
            $massage .= "📦 *Jumlah Pekerjaan*: {$validatedData['task_volume']} {$activity->activity_unit}\n\n";
            $massage .= "Silakan cek detail tugas dan mulai pengerjaan melalui sistem:\n";
            $massage .= "🌐 http://smpbps-ds.test/login\n\n";
            $massage .= "Jika ada pertanyaan, silakan hubungi pemberi tugas.\n";
            $massage .= "Semangat menjalankan tugas! 💪";
            $this->notifyService->sendFonnteNotification($member->user_whatsapp_number, $massage);
        }

        return redirect()->back()->with('success', 'Penerima tugas berhasil ditambahkan.');
    }
}