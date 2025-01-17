<x-layout>
    <x-slot:headercontent>{{ $headercontent }}</x-slot:headercontent>
    <table>
      <thead>
        <tr>
            <th class="p-2 w-1/3">Nama Kegiatan</th>
            <th class="w-1/3">Volume/Satuan</th>
            <th class="w-1/3">Tenggat</th>
            <th class="w-1/3">Detail</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)  
        <tr class="bg-white border-b">
          <td class="p-2">{{ $task->namakegiatan }}</td>
          <td>{{ $task->volume }} {{ $task->satuan }}</td>
          <td>{{ $task->tenggat }}</td>
          <td class="text-center">
              <a href="/monitoring/{{ $task->slug }}">
                  <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
              </a>
          </td>
      </tr>
      @endforeach
    </tbody>
    </table>
  </x-layout>