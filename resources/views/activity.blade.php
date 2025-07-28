<x-layout>
    <!-- Breadcrumb Navigation -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('activities-monitoring-page') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Kembali
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $activity->activity_name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Activity Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $activity->activity_name }}</h1>
            @can('update', $activity)
            <button type="button" id="updatemodalbutton" data-modal-target="updatemodal" data-modal-toggle="updatemodal" class="ml-2 p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                <img class="w-5 h-5" src="{{ asset('img/task-edit.svg') }}" alt="Edit Kegiatan">
            </button>
            @endcan
        </div>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
            Tenggat: {{ $activity->id_format_deadline }}
        </span>
    </div>

    <!-- Task Progress Summary -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold text-gray-900 dark:text-white">Total Progress Tim</h3>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $activity->total_completed }}/{{ $activity->total_volume }} tugas selesai
            </span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $activity->total_progress }}%"></div>
        </div>
        <div class="flex justify-between mt-1">
            <span class="text-xs text-gray-600 dark:text-gray-400">0%</span>
            <span class="text-xs text-gray-600 dark:text-gray-400">100%</span>
        </div>
    </div>

    <!-- Team Members Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Anggota Tim</th>
                    <th scope="col" class="px-6 py-3">Progress</th>
                    @if ($activity->activity_active_status == '0')
                        <th scope="col" class="px-6 py-3 text-center">Nilai Tugas</th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    
                    @php
                        $color = $task->spi_data['color'];
                        $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black'; 
                    @endphp
                    
                    <td class="px-6 py-4">
                        <p class="{{ $backgroundColor }} text-white text-xs font-medium px-2.5 py-0.5 rounded-full w-36 text-center">
                            {{ $task->spi_data['status'] ?? 'Belum Dimulai' }}
                        </p>
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <span class="text-xs font-medium text-gray-600">
                                    {{ substr($task->user->user_full_name, 0, 1) }}
                                </span>
                            </div>
                            {{ $task->user->user_full_name }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700 mr-2">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ ($task->task_latest_progress / $task->task_volume) * 100 }}%"></div>
                            </div>
                            <span class="text-xs font-medium">
                                {{ $task->task_latest_progress }}/{{ $task->task_volume }} {{ $activity->activity_unit }}
                            </span>
                        </div>
                    </td>
                    @if ($activity->activity_active_status == '0')    
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('evaluation-page', $task->task_slug) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Evaluasi
                            </a>
                        </td>
                    @endif
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('task-page', $task->task_slug) }}" 
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Belum ada anggota tim yang ditugaskan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">

        @if (Auth::user()->user_role == 'ketuatim' && $activity->activity_active_status == '1')
        
            <x-update-activity-modal :activity="$activity" />
            <button type="button" 
                    onclick="openactivityModal()" 
                    class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200">
                <img class="w-5 h-5 mr-2" src="{{ asset('img/task-edit.svg') }}" alt="Edit Kegiatan">
                Perbarui Kegiatan
            </button>

            <x-add-assignee-modal :activity="$activity" :teams="$teams" :anggotatim="$anggotatim" />
            <button type="button"
                    onclick="openaddassigneemodal()" 
                    class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200">
                <img class="w-5 h-5 mr-2" src="{{ asset('img/add-person.svg') }}" alt="Tambah Tugas">
                Tambah Penerima Tugas Baru
            </button>
                
            @if($activity->total_progress == 100)
                <x-mark-activity-as-done-modal :activity="$activity" />
                <button type="button" 
                        onclick="openModal()"
                        class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Tandai Kegiatan Selesai
                </button>
            @endif 

        @endif
    </div>

    <script>
        flatpickr("#tenggat", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disableMobile: true
        });

        function openModal() {
            document.getElementById('confirmationModal').classList.remove('hidden');
            document.getElementById('confirmationModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.remove('flex');
            document.getElementById('confirmationModal').classList.add('hidden');
        }
    </script>

</x-layout>