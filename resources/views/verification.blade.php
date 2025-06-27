<x-layout>
    <p class="text-center text-xl mb-10">Verifikasi Tugas</p>

    @foreach ($completed_task as $task)
        <div class="border-2 border-black p-4 rounded-xl mt-3">
            <p class="text-xl">{{ $task->user->user_full_name }} telah menyelesaikan {{ $task->activity->activity_name }}</p>
            <div class="flex justify-between mt-4">
                <p>Pekerjaan Telah Selesai</p>
                <div>
                    <button class="border bg-blue-500 py-2 px-4 rounded-lg text-lg text-white">Setuju</button>
                    <button class="border bg-red-500 py-2 px-4 ml-5 rounded-lg text-lg text-white">Tolak</button>
                </div>
            </div>
        </div>    
    @endforeach
</x-layout>