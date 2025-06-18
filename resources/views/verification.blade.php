<x-layout>
    <h1>Daftar Tugas yang harus diverifikasi:</h1>

    @foreach ($objections as $objection)
        <div class="flex">
            <p>{{ $objection->task->activity->activity_name }}</p>
            <p>{{ $objection->objection_reason }}</p>
            <button class="border">Terima</button>
            <button class="border">Tolak</button>
        </div>    
    @endforeach
</x-layout>