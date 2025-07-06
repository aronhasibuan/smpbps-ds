<x-layout>
    
    <div>
        <h1 class="text-center text-2xl font-bold mb-8">Verifikasi Pengajuan Keberatan Tugas</h1>
        @if($objection_task->isEmpty())
            <div class="text-center py-8 bg-gray-100 rounded-lg">
                <p class="text-gray-600">Tidak ada tugas yang perlu diverifikasi saat ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($objection_task as $objection)
                <div class="border border-gray-300 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold">
                                {{ $objection->task->user->user_full_name ?? 'N/A' }}
                                <span class="font-normal">Mengajukan Keberatan Pada Tugas</span>
                                {{ $objection->task->activity->activity_name ?? 'aktivitas' }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                Alasan Keberatan: {{ $objection->objection_reason ?? 'N/A' }}
                            </p>
                            <p class="text-gray-600 mt-1">
                                Diajukan pada: 
                                @if($objection->updated_at)
                                    {{ \Carbon\Carbon::parse($objection->updated_at)->format('d M Y H:i') }}
                                @else
                                    Waktu tidak tersedia
                                @endif
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <x-objection-action-modal :objection="$objection"/>
                            <button 
                                onclick="openObjectionModal({{ $objection->id }})"
                                class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition-colors">
                                Aksi
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
                            @if ($progress->progress_amount == $progress->task->task_volume)
                                <x-evaluation-modal :progress="$progress" />
                                <button type="button"
                                    onclick="openEvaluationModal()"
                                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                    Setuju
                                </button>
                            @else    
                                <form action="{{ route('approve-progress', $progress->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                        Setuju
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('reject-progress', $progress->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE') 
                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                                    Tolak
                                </button>
                            </form>
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
                            <form action="{{ route('cross-team-approve', $task->id) }}" method="POST">
                            @csrf
                                <button 
                                    type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                                    Setuju
                                </button>
                            </form>
                            <form action="{{ route('cross-team-reject', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>