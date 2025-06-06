<x-layout>
    <div>

        <a href="{{ $actionUrl }}" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
        
        <div class="flex items-center mt-5 mb-2">
            <p class="font-bold dark:text-white">{{ $activity->activity_name }}</p>
            <button href="" class="ml-2" type="button" id="updatemodalbutton" data-modal-target="updatemodal" data-modal-toggle="updatemodal">
                <img class="w-5 h-5" src="{{ asset('img/task-edit.svg') }}" alt="Detail">
            </button>
        </div>

        {{-- create modal - update kegiatan --}}
        <div id="updatemodal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Perbarui Kegiatan
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updatemodal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('updatekegiatan', $activity->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="activity_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                <input type="text" name="activity_name" id="activity_name" value="{{ $activity->activity_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                            <div>
                                <label for="tenggat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tenggat</label>
                                <input type="date" name="tenggat" id="tenggat" value="{{ $tasks->first()->tenggat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Perbarui Kegiatan
                        </button>
                    </form>
                </div>
            </div>
        </div>


        {{-- advanced table --}}    
        <div class="overflow-auto max-h-screen">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t"> 
                    <tr>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Nama Anggota Tim</th>
                        <th scope="col" class="px-4 py-3">Tugas Selesai</th>
                        <th scope="col" class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                    @foreach ($tasks as $task)
                    <tr class="border-t">
                        @php
                            $colorMap = [
                                'Selesai' => 'bg-blue-500',
                                'Terlambat' => 'bg-black',
                                'Progress Lambat' => 'bg-red-500',
                                'Progress On Time' => 'bg-yellow-500',
                                'Progress Cepat' => 'bg-green-500'
                                
                            ];
                            $backgroundColor = $colorMap[$task->kemajuan['status']] ?? 'bg-gray-500';
                        @endphp
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="{{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                        </th>
                        <td class="px-4 py-3">{{ $task->user->user_full_name }}</td>
                        <td class="px-4 py-3">{{ $task->task_latest_progress }} dari {{ $task->task_volume }} {{ $activity->activity_unit }}</td>
                        <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                            <a href="{{ route('taskmonitoring', ['kegiatan_slug' => $activity->activity_slug, 'slug'=>$task->task_slug])}}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none">
                                <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        {{-- progress --}}
        <div class="flex justify-between mb-2 mt-20">
            <span class="md:text-base text-sm font-bold text-gray-900 dark:text-white">Total Progress</span>
            <span class="md:text-base text-sm font-bold text-gray-900 dark:text-white">Tenggat Pekerjaan: {{ $tasks->first()->formatted_tenggat; }}</span>
        </div>
        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="h-6 bg-blue-600 rounded-full dark:bg-blue-500 text-sm font-medium text-blue-100 text-center" style="width: 100%">100%</div>
        </div>

        {{-- button - tandai kegiatan selesai --}}
        @if ( $activity->activity_active_status)    
            <div class="flex justify-center gap-4 mt-20">
                <button type="button" onclick="openModal()" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                Tandai Kegiatan Selesai
                </button>
            </div>
        @endif

        <div id="confirmationModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4 dark:text-white">Konfirmasi</h2>
                <p class="text-sm text-gray-700 mb-6 dark:text-gray-300">Apakah anda yakin menandai kegiatan ini selesai? Aksi ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 dark:text-black px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <form action="{{ route('markkegiatanasdone', ['kegiatan' => $activity->activity_slug, 'id' => $activity->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                            Ya, Tandai Selesai
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                const modal = document.getElementById('confirmationModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                const modal = document.getElementById('confirmationModal');
                modal.classList.remove('flex')
                modal.classList.add('hidden');
            }

            flatpickr("#tenggat", {
                dateFormat: "Y-m-d",  
                minDate: "today",      
                disableMobile: true 
            });
        </script>

        <script>
            @if(session('updated'))
                toastr.success("{{ session('updated') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>

    </div>
</x-layout> 