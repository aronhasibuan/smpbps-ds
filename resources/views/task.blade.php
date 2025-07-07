<x-layout>
    <main class="pb-16 bg-white dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">

            <div class="mb-4">
                @if (Auth::check() && Auth::user()->user_role == 'anggotatim')
                    <a href="{{ route('task-list-page') }}" class="font-medium text-base text-blue-600 hover:underline" aria-label="Kembali ke daftar tugas">
                        &laquo; Kembali ke Daftar Tugas
                    </a>
                @else
                    <a href="{{ route('activities-monitoring-page') }}" class="font-medium text-base text-blue-600 hover:underline" aria-label="Kembali ke beranda ketua tim">
                        &laquo; Kembali ke Monitoring Kegiatan
                    </a>
                @endif
            </div>

            <div class="flex justify-between items-center mb-5">
                @php
                    $color = $task->spi_data['color'];
                    $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black';
                @endphp
                <span class="{{ $backgroundColor }} text-white rounded-md px-4 py-1 text-sm">
                    {{ $task->spi_data['status'] }}
                </span>
            </div>

            <h1 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white" aria-label="Judul tugas">
                {{ $task->activity->activity_name }}
            </h1>

            <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                <div>
                    <p class="text-gray-900 dark:text-white">
                        <span class="font-semibold">Pemberi Tugas:</span> 
                        {{ $task->activity->user->user_full_name }} - {{ $task->formatted_createdat }}
                    </p>
                </div>
                <p class="text-gray-900 font-bold dark:text-white">
                    <span class="font-semibold">Tenggat:</span> {{ $task->formatted_tenggat }}
                </p>
            </div>

            <!-- Task Details -->
            <div class="border-y border-gray-300 py-5 space-y-2">
                <p class="text-gray-900 dark:text-white">
                    <span class="font-semibold">Deskripsi:</span> {{ $task->task_description }}
                </p>
                <p class="text-gray-900 dark:text-white">
                    <span class="font-semibold">Volume:</span> {{ $task->task_volume }} {{ $task->activity->activity_unit }}
                </p>
                
                @if($task->task_attachment)
                <div class="mt-3">
                    <a href="{{ url('/file/' . basename($task->task_attachment)) }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                       aria-label="Lihat lampiran tugas">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                        Lihat Lampiran
                    </a>
                </div>
                @endif
            </div>

            <label class="text-gray-700 font-bold mb-2 block dark:text-white text-center text-base">Progress Pekerjaan:</label>
                    
            @php
                $lastProgress = null;
            @endphp

            <ul class="relative border-s border-gray-200 dark:border-gray-700 list-none">     
                @for ($date = $start->copy(); $date->lte($end); $date->addDay())
                    @php
                        $progress = $progressByDate[$date->format('Y-m-d')] ?? $lastProgress;
                        if (isset($progressByDate[$date->format('Y-m-d')])) {
                            $lastProgress = $progressByDate[$date->format('Y-m-d')];
                        }
                    @endphp                                     
                    <li class="mb-10 ms-6">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $progress->progress_amount }} {{ $task->activity->activity_unit }}
                            @if($progress->progress_acceptance == 0)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium ms-3 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                Menunggu Persetujuan
                            </span>
                            @endif
                        </h3>
                        <time class="block mb-2 text-sm font-normal text-gray-400 dark:text-gray-500">
                            {{ $date->locale('id')->translatedFormat('d F Y') }}
                        </time>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ $progress->progress_notes }}
                        </p>
                        @if ($progress->progress_documentation)
                            <div class="cursor-pointer mb-10">
                                <a href="{{ url('/file/' . basename($progress->progress_documentation)) }}" target="_blank" class="no-underline inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Lihat Dokumentasi</a>
                            </div>
                        @endif
                    </li>
                @endfor
            </ul>

            <div class="relative w-full bg-gray-300 rounded-full h-6">
                <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-6 bg-blue-600 rounded-full dark:bg-blue-500 text-sm font-medium text-blue-100 text-center" style="width: {{ $task->progress_percentage }}%">{{ $task->progress_percentage }}%</div>
                </div>
            </div>
        </div>

            {{-- Update Progress --}}
            @if (Auth::check() && Auth::user()->user_role == 'anggotatim' && $task->status_id == 2)
                <div class="flex justify-center gap-4 mt-20">

                    <x-update-progress-modal :task="$task" />
                    <button type="submit" id="openModal" class="bg-blue-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                        <img class="w-5 h-5 mr-1 -ml-1" src="{{ asset('img/statistics.svg') }}" alt="Perbarui Progress">
                        Perbarui Progress
                    </button>

                    <x-create-objection-modal :task="$task" />
                    <button type="submit" id="openObjection" class="bg-red-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
                        <img class="w-5 h-5 mr-1 -ml-1" src="{{ asset('img/cross.svg') }}" alt="Ajukan Keberatan">
                        Ajukan Keberatan
                    </button>
                </div>
            @endif
        
            @if (Auth::check() && Auth::user()->user_role == 'ketuatim' && $task->status_id == 2)
                <div>
                    <div class="flex justify-center gap-4 mt-20">

                        <x-update-task-modal :task="$task" />
                        <button class="text-sm md:text-base bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200 inline-flex items-center gap-2" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button">
                            <img class="w-5 h-5" src="{{ asset('img/edit-document.svg') }}" alt="">
                            Perbarui Tugas
                        </button>

                        <x-delete-task-modal :task="$task" />
                        <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal"  class="text-sm md:text-base bg-red-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
                            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Hapus Tugas
                        </button>
                        
                    </div>
                </div>
            @endif
    
            @if (Auth::check() && Auth::user()->user_role == 'ketuatim')
                <script>
                    document.addEventListener("DOMContentLoaded", function(event) {
                        document.getElementById('defaultModalButton').click();
                    });
                </script>
            @endif

            @if (Auth::check() && Auth::user()->user_role == 'anggotatim' && $task->status_id == 2)
                <script>
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

                    document.addEventListener("DOMContentLoaded", function () {
                        const uploadCheckbox = document.getElementById("uploadCheckbox");
                        const uploadInputContainer = document.getElementById("uploadInputContainer");

                        uploadCheckbox.addEventListener("change", function () {
                            if (this.checked) {
                                uploadInputContainer.classList.remove("hidden");
                            } else {
                                uploadInputContainer.classList.add("hidden");
                            }
                        });
                    });
                </script>
                <script>
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
                    })
                </script>
            @endif

            <script>
                @if(session('updated'))
                    toastr.success("{{ session('updated') }}");
                @endif
                @if(session('error'))
                    toastr.error("{{ session('error') }}");
                @endif

            </script>
        </div>
    </main>
</x-layout>