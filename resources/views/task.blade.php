<x-layout>
    <main class="pb-16 bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-xl">
            <!-- Back Button -->
            <div class="mb-6">
                @if (Auth::check() && Auth::user()->user_role == 'anggotatim')
                    <a href="{{ route('task-list-page') }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" aria-label="Kembali ke daftar tugas">
                        <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Tugas
                    </a>
                @else
                    <a href="{{ route('activities-monitoring-page') }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" aria-label="Kembali ke beranda ketua tim">
                        <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Monitoring Kegiatan
                    </a>
                @endif
            </div>

            <!-- Task Header -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6 border border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-start mb-4">
                    <div>
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
                        <span class="{{ $statusClass }} text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            {{ $task->spi_data['status'] }}
                        </span>
                        <h1 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white" aria-label="Judul tugas">
                            {{ $task->activity->activity_name }}
                        </h1>
                    </div>
                    
                    <!-- Progress Circle -->
                    <div class="relative w-16 h-16">
                        <svg class="w-full h-full" viewBox="0 0 36 36">
                            <path
                                d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#E5E7EB"
                                stroke-width="3"
                                stroke-dasharray="100, 100"
                            />
                            <path
                                d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#3B82F6"
                                stroke-width="3"
                                stroke-dasharray="{{ $task->progress_percentage }}, 100"
                                stroke-linecap="round"
                            />
                        </svg>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $task->progress_percentage }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Task Meta -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span><span class="font-semibold">Pemberi Tugas:</span> {{ $task->activity->user->user_full_name }}</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span><span class="font-semibold">Dibuat:</span> {{ $task->formatted_createdat }}</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><span class="font-semibold">Tenggat:</span> {{ $task->formatted_tenggat }}</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                            </svg>
                            <span><span class="font-semibold">Volume:</span> {{ $task->task_volume }} {{ $task->activity->activity_unit }}</span>
                        </div>
                    </div>
                </div>

                <!-- Task Description -->
                <div class="mt-4">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Deskripsi Tugas</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $task->task_description }}</p>
                </div>

                <!-- Attachment -->
                @if($task->task_attachment)
                <div class="mt-4">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Lampiran</h3>
                    <a href="{{ url('/file/' . basename($task->task_attachment)) }}" 
                       target="_blank"
                       class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                       aria-label="Lihat lampiran tugas">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                        Lihat Lampiran
                    </a>
                </div>
                @endif
            </div>

            <!-- Progress Timeline -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Progress Pekerjaan
                </h2>

                <div class="relative">
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-6">
                        <div class="bg-blue-600 h-2.5 rounded-full dark:bg-blue-500" style="width: {{ $task->progress_percentage }}%"></div>
                    </div>

                    <!-- Timeline -->
                    <ol class="relative border-s border-gray-200 dark:border-gray-700">     
                        @for ($date = $start->copy(); $date->lte($end); $date->addDay())
                            @php
                                $progress = $progressByDate[$date->format('Y-m-d')] ?? $lastProgress;
                                if (isset($progressByDate[$date->format('Y-m-d')])) {
                                    $lastProgress = $progressByDate[$date->format('Y-m-d')];
                                }
                            @endphp                                     
                            <li class="mb-8 ms-4">            
                                <div class="absolute w-3 h-3 bg-blue-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-blue-700"></div>
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $progress->progress_amount }} {{ $task->activity->activity_unit }}
                                        </span>
                                        <time class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ $date->locale('id')->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                    @if($progress->progress_acceptance == 0)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-2 inline-block">
                                        Menunggu Persetujuan
                                    </span>
                                    @endif
                                    <p class="text-gray-700 dark:text-gray-300 text-sm mb-2">
                                        {{ $progress->progress_notes }}
                                    </p>
                                    @if ($progress->progress_documentation)
                                        <a href="{{ url('/file/' . basename($progress->progress_documentation)) }}" 
                                           target="_blank"
                                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Dokumentasi
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endfor
                    </ol>
                </div>
            </div>

            <!-- Action Buttons -->
            @if (Auth::check() && Auth::user()->user_role == 'anggotatim' && $task->status_id == 2)
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                    <x-update-progress-modal :task="$task" />
                    <button type="submit" id="openModal" class="flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                        <img class="w-5 h-5" src="{{ asset('img/statistics.svg') }}" alt="Perbarui Progress">
                        <span>Perbarui Progress</span>
                    </button>

                    <x-create-objection-modal :task="$task" />
                    <button type="submit" id="openObjection" class="flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-200 shadow-md">
                        <img class="w-5 h-5" src="{{ asset('img/cross.svg') }}" alt="Ajukan Keberatan">
                        <span>Ajukan Keberatan</span>
                    </button>
                </div>
            @endif
        
            @if (Auth::check() && Auth::user()->user_role == 'ketuatim' && $task->status_id == 2)
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                    <x-update-task-modal :task="$task" />
                    <button class="flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button">
                        <img class="w-5 h-5" src="{{ asset('img/edit-document.svg') }}" alt="">
                        <span>Perbarui Tugas</span>
                    </button>

                    <x-delete-task-modal :task="$task" />
                    <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-200 shadow-md">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span>Hapus Tugas</span>
                    </button>
                </div>
            @endif
        </div>

        <!-- Scripts -->
        @if (Auth::check() && Auth::user()->user_role == 'ketuatim')
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    document.getElementById('defaultModalButton').click();
                });
            </script>
        @endif

        @if (Auth::check() && Auth::user()->user_role == 'anggotatim' && $task->status_id == 2)
            <script>
                // Modal handling scripts
                const modal = document.getElementById('popupModal');
                const openModal = document.getElementById('openModal');
                const closeModal = document.getElementById('closeModal');
                
                openModal.addEventListener('click', function () {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
                
                closeModal.addEventListener('click', function () {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });

                // Upload toggle
                document.addEventListener("DOMContentLoaded", function () {
                    const uploadCheckbox = document.getElementById("uploadCheckbox");
                    const uploadInputContainer = document.getElementById("uploadInputContainer");

                    uploadCheckbox.addEventListener("change", function () {
                        uploadInputContainer.classList.toggle("hidden", !this.checked);
                    });
                });

                // Objection modal
                const objectionModal = document.getElementById('objectionModal');
                const openObjection = document.getElementById('openObjection');
                const closeObjection = document.getElementById('closeObjection');
                
                openObjection.addEventListener('click', function(){
                    objectionModal.classList.remove('hidden');
                    objectionModal.classList.add('flex');
                });
                
                closeObjection.addEventListener('click', function(){
                    objectionModal.classList.remove('flex');
                    objectionModal.classList.add('hidden');
                });
            </script>
        @endif

        <!-- Toastr Notifications -->
        <script>
            @if(session('updated'))
                toastr.success("{{ session('updated') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>
    </main>
</x-layout>