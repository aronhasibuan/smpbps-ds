<x-layout>
    <div class="text-center">
        <h1>Hello {{ $user->name }}</h1>
        <p>Saran tugas untuk dikerjakan hari ini:</p>
        <table class="mx-auto text-left">
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="border">
                        <td class="p-3">{{ $task->namakegiatan }}</td>
                        <td class="p-3"> - </td>
                        <td class="p-3">{{ $task->sarantugas }} {{ $task->satuan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="app" class="text-center mt-5">
        
    </div>
</x-layout>