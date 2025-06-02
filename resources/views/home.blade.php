<x-layout>
    <div class="text-center">
        <h1>Hello {{ $user->name }}</h1>
        <p>Saran tugas untuk dikerjakan hari ini:</p>
        @foreach ($tasks as $task)
            <p>{{ $task->namakegiatan }} - {{ $task->sarantugas }} {{ $task->satuan }}</p>
        @endforeach
    </div>

    <div>
        
    </div>
</x-layout>