<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Verification Sections -->
        <div class="space-y-12">
            <!-- Objection Verification Section -->
            <section class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Verifikasi Pengajuan Keberatan Tugas
                    </h1>
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                        {{ $objection_task->count() }} perlu verifikasi
                    </span>
                </div>

                @if($objection_task->isEmpty())
                    <div class="text-center py-12 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Tidak ada keberatan</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Tidak ada tugas yang perlu diverifikasi saat ini</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($objection_task as $objection)
                        <div class="border border-gray-200 dark:border-gray-700 p-6 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                                {{ substr($objection->task->user->user_full_name ?? 'N/A', 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $objection->task->user->user_full_name ?? 'N/A' }}
                                            </h2>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Mengajukan keberatan pada tugas: 
                                                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $objection->task->activity->activity_name ?? 'aktivitas' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-13 pl-1">
                                        <div class="mt-3">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Alasan Keberatan:</span>
                                            <p class="text-gray-700 dark:text-gray-300">{{ $objection->objection_reason ?? 'N/A' }}</p>
                                        </div>
                                        
                                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Diajukan pada: {{ \Carbon\Carbon::parse($objection->updated_at)->format('d M Y H:i') ?? 'Waktu tidak tersedia' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <x-objection-action-modal :objection="$objection"/>
                                    <button 
                                        onclick="openObjectionModal({{ $objection->id }})"
                                        class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Aksi
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Progress Verification Section -->
            <section class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Verifikasi Progress Tugas Anggota Tim
                    </h1>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                        {{ $progress_need_verification->count() }} perlu verifikasi
                    </span>
                </div>

                @if($progress_need_verification->isEmpty())
                    <div class="text-center py-12 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Semua progress telah diverifikasi</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Tidak ada progress yang perlu diverifikasi saat ini</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($progress_need_verification as $progress)
                        <div class="border border-gray-200 dark:border-gray-700 p-6 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                                {{ substr($progress->task->user->user_full_name ?? 'N/A', 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $progress->task->user->user_full_name ?? 'N/A' }}
                                            </h2>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Mengajukan progress pada tugas: 
                                                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $progress->task->activity->activity_name ?? 'aktivitas' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-13 pl-1">
                                        <div class="mt-3">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Progress:</span>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mt-1">
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                    style="width: {{ ($progress->progress_amount / $progress->task->task_volume) * 100 }}%">
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                                {{ $progress->progress_amount ?? 'N/A' }} dari {{ $progress->task->task_volume ?? 'N/A' }} ({{ round(($progress->progress_amount / $progress->task->task_volume) * 100) }}%)
                                            </p>
                                        </div>
                                        
                                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Diajukan pada: {{ \Carbon\Carbon::parse($progress->progress_date)->format('d M Y') ?? 'Waktu tidak tersedia' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    @if ($progress->progress_amount == $progress->task->task_volume)
                                        <x-evaluation-modal :progress="$progress" />
                                        <button type="button"
                                            onclick="openEvaluationModal()"
                                            class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Setuju
                                        </button>
                                    @else    
                                        <form action="{{ route('approve-progress', $progress->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Setuju
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('reject-progress', $progress->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE') 
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Cross Team Task Verification Section -->
            <section class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Verifikasi Penugasan Antar Tim
                    </h1>
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">
                        {{ $cross_team_task->count() }} perlu verifikasi
                    </span>
                </div>

                @if($cross_team_task->isEmpty())
                    <div class="text-center py-12 bg-gray-50 dark:bg-gray-700/30 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Tidak ada penugasan antar tim</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Tidak ada tugas yang perlu diverifikasi saat ini</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($cross_team_task as $task)
                        <div class="border border-gray-200 dark:border-gray-700 p-6 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                                {{ substr($task->activity->user->user_full_name ?? 'N/A', 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $task->activity->user->user_full_name ?? 'N/A' }}
                                            </h2>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Ingin memberikan tugas kepada anggota tim anda
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-13 pl-1">
                                        <div class="mt-3">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Tugas:</span>
                                            <p class="text-gray-700 dark:text-gray-300">{{ $task->activity->activity_name ?? 'aktivitas' }}</p>
                                        </div>
                                        
                                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                            Penerima: {{ $task->user->user_full_name ?? 'N/A' }}
                                        </div>
                                        
                                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Diajukan pada: {{ \Carbon\Carbon::parse($task->created_at)->format('d M Y H:i') ?? 'Waktu tidak tersedia' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <form action="{{ route('cross-team-approve', $task->id) }}" method="POST">
                                    @csrf
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Setuju
                                        </button>
                                    </form>
                                    <form action="{{ route('cross-team-reject', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-layout>