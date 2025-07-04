<x-layout>
    
    <div>
        <h1 class="text-center text-2xl font-bold mb-8">Verifikasi Pengajuan Keberatan Tugas</h1>
        @if($objection_task->isEmpty())
            <div class="text-center py-8 bg-gray-100 rounded-lg">
                <p class="text-gray-600">Tidak ada tugas yang perlu diverifikasi saat ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($objection_task as $task)
                <div class="border border-gray-300 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold">
                                {{ $task->user->user_full_name ?? 'N/A' }}
                                <span class="font-normal">Mengajukan Keberatan Pada Tugas</span>
                                {{ $task->activity->activity_name ?? 'aktivitas' }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Diajukan pada: 
                                @if($task->updated_at)
                                    {{ \Carbon\Carbon::parse($task->updated_at)->format('d M Y H:i') }}
                                @else
                                    Waktu tidak tersedia
                                @endif
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button 
                                onclick="verifyTask({{ $task->id }}, 'approved')"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Setuju
                            </button>
                            <button 
                                onclick="verifyTask({{ $task->id }}, 'rejected')"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-12">
        <h1 class="text-center text-2xl font-bold mb-8">Verifikasi Progress Tugas Anggota Tim</h1>

        @if($progress_need_verification->isEmpty())
            <div class="text-center py-8 bg-gray-100 rounded-lg">
                <p class="text-gray-600">Tidak ada tugas yang perlu diverifikasi saat ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($progress_need_verification as $progress)
                <div class="border border-gray-300 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold">
                                {{ $progress->task->user->user_full_name ?? 'N/A' }}
                                <span class="font-normal">Mengajukan Progress Pada Tugas</span>
                                {{ $progress->task->activity->activity_name ?? 'aktivitas' }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Jumlah Progress yang diajukan: {{ $progress->progress_amount ?? 'N/A' }} dari {{ $progress->task->task_volume ?? 'N/A' }}
                            </p>
                            <p class="text-gray-600 mt-1">
                                Diajukan pada: 
                                @if($progress->progress_date)
                                    {{ \Carbon\Carbon::parse($progress->progress_date)->format('d M Y') }}
                                @else
                                    Waktu tidak tersedia
                                @endif
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button 
                                onclick="verifyTask({{ $progress->id }}, 'approved')"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Setuju
                            </button>
                            <button 
                                onclick="verifyTask({{ $progress->id }}, 'rejected')"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-12">
        <h1 class="text-center text-2xl font-bold mb-8">Verifikasi Penugasan Anggota Tim Dari Tim Lain</h1>

        @if($cross_team_task->isEmpty())
            <div class="text-center py-8 bg-gray-100 rounded-lg">
                <p class="text-gray-600">Tidak ada tugas yang perlu diverifikasi saat ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($cross_team_task as $task)
                <div class="border border-gray-300 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold">
                                {{ $task->activity->user->user_full_name ?? 'N/A' }}
                                <span class="font-normal">Ingin memberikan Tugas</span>
                                {{ $task->activity->activity_name ?? 'aktivitas' }}
                                <span class="font-normal"> kepada </span>
                                {{ $task->user->user_full_name ?? 'N/A' }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Diajukan pada: 
                                @if($task->created_at)
                                    {{ \Carbon\Carbon::parse($task->created_at)->format('d M Y H:i') }} 
                                @else
                                    Waktu tidak tersedia
                                @endif
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button 
                                onclick="verifyTask({{ $task->id }}, 'approved')"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Setuju
                            </button>
                            <button 
                                onclick="verifyTask({{ $task->id }}, 'rejected')"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</x-layout>