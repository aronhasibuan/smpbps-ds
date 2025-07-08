<x-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            @if ($user->user_role === 'anggotatim')
                <a href="{{ route('task-archive-page') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4"/>
                    </svg>
                    Kembali
                </a>                
            @else
                <a href="{{ route('activities-archive-page') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4"/>
                    </svg>
                    Kembali
                </a>
            @endif
        </div>

        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Nilai Hasil Tugas</h1>
            <h2 class="text-xl text-blue-600 dark:text-blue-400 font-medium">{{ $task->activity->activity_name }}</h2>
            <div class="mt-6">
                <div class="inline-block border-2 border-blue-500 rounded-xl px-8 py-3 bg-white dark:bg-gray-800 shadow-lg">
                    <p class="text-center font-bold text-2xl text-gray-800 dark:text-white">Nilai Final: <span class="text-blue-600">{{ number_format($task->final_point ?? 0, 2) }}</span></p>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-10">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                    <span>Progress Pengerjaan</span>
                </h2>
            </div>
            
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($tasksbydate as $task)   
                    @php
                        $color = $task->spi_data['color'];
                        $colorClasses = [
                            'red' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                            'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                            'green' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                            'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                            'default' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                        ];
                        $statusClass = $colorClasses[$color] ?? $colorClasses['default'];
                    @endphp 
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">Tanggal: {{ \Carbon\Carbon::parse($task->task_date)->locale('id')->translatedFormat('d F') }}</span>
                            </div>
                            <div class="text-gray-600 dark:text-gray-400">Progress: {{ $task->latest_progress }}</div>
                            <div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                    {{ $task->spi_data['status'] }}
                                </span>
                            </div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">Poin: {{ number_format($task->spi_data['poin'] ?? 0, 2) }}</div>
                        </div>
                    </div>
                @empty
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    Tidak ada data progress
                </div>
                @endforelse

                @if(!empty($tasksbydate))
                    <div class="p-6 bg-gray-50 dark:bg-gray-700/30">
                        <div class="flex items-center justify-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <img class="w-5 h-5" src="{{ asset('img/quantity.svg') }}" alt="Detail">
                            </span>
                            <span class="text-lg font-semibold text-gray-800 dark:text-white">Rata-rata nilai progress: <span class="text-blue-600">{{ number_format($task->average_progress_point ?? 0, 0) }}</span></span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quality Evaluation Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-10">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Evaluasi Kualitas</h2>
            </div>

            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>
                            <span class="text-gray-700 dark:text-gray-300">Kelengkapan Isian</span>
                        </div>
                        <div class="text-center">
                            <span class="px-4 py-2 inline-block border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200">
                                {{ $task->evaluation->evaluation_comprehensiveness }}
                            </span>
                        </div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">Poin: {{ $task->comprehensiveness_point }}</div>
                    </div>
                </div>
                
                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>
                            <span class="text-gray-700 dark:text-gray-300">Kerapian</span>
                        </div>
                        <div class="text-center">
                            <span class="px-4 py-2 inline-block border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200">
                                {{ $task->evaluation->evaluation_tidiness }}
                            </span>
                        </div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">Poin: {{ $task->tidiness_point }}</div>
                    </div>
                </div>
                
                <div class="p-6 bg-gray-50 dark:bg-gray-700/30">
                    <div class="flex items-center justify-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                            <img class="w-5 h-5" src="{{ asset('img/quality.svg') }}" alt="Detail">
                        </span>
                        <span class="text-lg font-semibold text-gray-800 dark:text-white">Rata-rata nilai kualitas: <span class="text-blue-600">{{ $task->average_quality_point }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>