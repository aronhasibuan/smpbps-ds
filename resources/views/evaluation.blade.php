<x-layout>
     <h1 class="text-center font-bold mb-10 text-xl">Nilai Hasil Tugas: {{ $task->activity->activity_name }}</h1>
    
     <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
            <span>Progress Pengerjaan</span>
        </h2>
        
        <div class="overflow-x-auto">
            <table class="w-full border-separate border-spacing-y-2">
                <tbody>
                    @forelse ($tasksbydate as $task)   
                        @php
                            $color = $task->spi_data['color'];
                            $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black';
                        @endphp 
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </span>
                                    <span>Pada Tanggal: {{ \Carbon\Carbon::parse($task->task_date)->locale('id')->translatedFormat('d F') }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">Progress: {{ $task->latest_progress }}</td>
                            <td class="w-1/4 {{ $backgroundColor }} text-center text-white rounded-md">{{ $task->spi_data['status']}}</td>
                            <td class="py-3 px-4 text-center">Poin: {{ number_format($taskItem->spi_data['poin'] ?? 0, 2) }}</td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Tidak ada data progress</td>
                    </tr>
                    @endforelse

                    @if(!empty($tasksbydate))
                        <tr class="font-semibold">
                            <td colspan="4" class="pt-4">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <img class="w-5 h-5 text-blue-800 dark:text-blue-300" src="{{ asset('img/quantity.svg') }}" alt="Detail">
                                    </span>
                                     <span class="text-lg">Rata-rata nilai progress: {{ number_format($task->average_progress_point ?? 0, 0) }}</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4">Evaluasi Kualitas</h2>

        <div class="overflow-x-auto">
            <table class="w-full border-separate border-spacing-y-2">
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 w-1/2">
                            <div class="flex items-center gap-2">
                                <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <span>Kelengkapan Isian</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-center border border-gray-300 rounded">{{ $task->evaluation->evaluation_comprehensiveness }}</td>
                        <td class="py-3 px-4 text-center">Poin: {{ $task->comprehensiveness_point }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 w-1/2">
                            <div class="flex items-center gap-2">
                                <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <span>Kerapian</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-center border border-gray-300 rounded">{{ $task->evaluation->evaluation_tidiness }}</td>
                        <td class="py-3 px-4 text-center">Poin: {{ $task->tidiness_point }}</td>
                    </tr>
                    <tr class="font-semibold">
                        <td colspan="3" class="pt-4">
                            <div class="flex items-center justify-center gap-2">
                                <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <img class="w-5 h-5 text-blue-800 dark:text-blue-300" src="{{ asset('img/quality.svg') }}" alt="Detail">
                                </span>
                                <span class="text-lg">Rata-rata nilai dari sisi Kualitas: {{ $task->average_quality_point }}</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="border-2 border-gray-800 rounded-lg w-fit mx-auto my-6 px-8 py-4 bg-white shadow-lg">
        <p class="text-center font-bold text-xl">Nilai Final: {{ number_format($task->final_point ?? 0, 2) }}</p>
    </div>

</x-layout>