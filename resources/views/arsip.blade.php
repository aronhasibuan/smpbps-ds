<x-layout>
  <p class="text-sm text-gray-600 mb-4">Arsip Tugas</p>
  <table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead>
      <tr>
          <th class="p-2 w-1/4 border border-gray-300">Nama Kegiatan</th>
          <th class="w-1/4 border border-gray-300">Volume/Satuan</th>
          <th class="w-1/4 border border-gray-300">Tenggat</th>
          <th class="w-1/4 border border-gray-300">Detail</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($tasks as $task)  
      <tr>
        <td class="p-2 pl-5 border border-gray-300">{{ $task->namakegiatan }}</td>
        <td class="p-2 pl-5 border border-gray-300">{{ $task->volume }} {{ $task->satuan }}</td>
        <td class="p-2 pl-5 border border-gray-300">{{ $task->tenggat }}</td>
        <td class="p-2 border border-gray-300">
            <a href="/home/{{ $task->slug }}">
                <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
            </a>
        </td>
    </tr>
    @endforeach
  </tbody>
  </table>
</x-layout>
