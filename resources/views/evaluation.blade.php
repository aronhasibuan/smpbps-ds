<x-layout>
    <p class="text-center font-bold mb-10">Nilai Hasil Tugas {{ $task->activity->activity_name }}</p>
    
    <table class="w-full table-fixed border-separate border-spacing-y-4  border border-black pt-2 pl-2 pr-2 mb-5">
        <tbody>
            @foreach ($tasksbydate as $task)   
            @php
                $color = $task->spi_data['color'];
                $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black';
            @endphp 
            <tr>
                <td class="w-1/4 text-left">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <span>Pada Tanggal: {{ \Carbon\Carbon::parse($task->task_date)->locale('id')->translatedFormat('d F') }}</span>
                    </div>
                </td>
                <td class="w-1/4 text-left">Progress Dikerjakan: {{ $task->latest_progress }}</td>
                <td class="w-1/4 {{ $backgroundColor }} text-center text-white rounded-md">{{ $task->spi_data['status']}}</td>
                <td class="w-1/4 text-center">Poin: {{ number_format($task->spi_data['poin'], 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="w-3/4 font-bold">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <img class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" src="{{ asset('img/quantity.svg') }}" alt="Detail">
                        </span>
                        <span class="underline">Rata-rata nilai dari sisi progress</span>
                    </div>
                </td>
                <td class="w-1/4 text-center font-bold">Rata-Rata: {{ number_format($task->average_progress_point, 2) }}</td>
            </tr>
        </tbody>
    </table>
    
    <table class="w-full table-fixed border-separate border-spacing-y-4 border border-black p-4">
        <tbody>
            <tr>
                <td colspan="2" class="w-2/4 text-left">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <span>Kelengkapan Isian:</span>
                    </div>
                </td>
                <td class="w-1/4 text-center text-black border border-black rounded-md">Cukup Lengkap</td>
                <td class="w-1/4 text-center">Poin: 0.50</td>
            </tr>
            <tr>
                <td colspan="2" class="w-2/4 text-left">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <span>Kerapian: </span>
                    </div>
                </td>
                <td class="w-1/4 text-center text-black border border-black rounded-md">Tidak Rapi</td>
                <td class="w-1/4 text-center">Poin: 0.25</td>
            </tr>
            <tr>
                <td colspan="2" class="w-2/4 text-left">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </span>
                        <span>Moda yang digunakan:</span>
                    </div>
                </td>
                <td class="w-1/4 text-center text-black border border-black rounded-md">PAPI</td>
                <td class="w-1/4 text-center"></td>
            </tr>
            <tr>
                <td colspan="3" class="w-3/4 font-bold">
                    <div class="flex items-start justify-start gap-2">
                        <span class="flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <img class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" src="{{ asset('img/quality.svg') }}" alt="Detail">
                        </span>
                        <span>Rata-rata nilai dari sisi Kualitas:</span>
                    </div>
                </td>
                <td class="w-1/4 text-center font-bold">Poin: 60</td>
            </tr>
        </tbody>
    </table>

</x-layout>