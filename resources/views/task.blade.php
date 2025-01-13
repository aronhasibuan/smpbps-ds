<x-layout>
  <x-slot:headercontent>{{ $headercontent }}</x-slot:headercontent>
  
    {{-- <article class="py-8 max-w-screen-md">
      <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $task['namakegiatan'] }}</h2>
      <p>Ditugaskan Pada: {{ $task->created_at->format('d F Y') }}</p>
      <p>Ditugaskan Pada: {{ $task->created_at->diffForHumans() }}</p>
      <p>Tenggat: {{ $task->tenggat }}</p>
      <p>Pemberi tugas: <a href="/KetuaTim/{{ $task->pemberitugas->username }}">{{ $task->pemberitugas->name }}</a></p>
      <p>{{ $task['deskripsi'] }}</p>
      <p>Jumlah: {{ $task['volume'] }} {{ $task['satuan'] }}</p>
      <div class="mb-4">
        <label class="text-gray-700 font-bold mb-2 block">Progress:</label>
        <div class="relative w-full bg-gray-300 rounded-full h-6">
            <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $task['progress'] }}%;"></div>
            <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $task['progress'] }}%</span>
        </div>
      </div>
      <p>Status: {{ $task['status'] }}</p>
      <div class="mb-4">
        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Update Progress</button>
      </div>
      <a href="/home" class="font-medium text-blue-500 hover:underline"> &laquo; Back to Home</a>
    </article> --}}

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
      <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
          <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
              <header class="mb-4 lg:mb-6 not-format">
                <a href="/home" class="font-medium text-sm text-blue-600 hover:underline">&laquo; Back to Home</a>
                <div class="flex justify-between items-center mb-5 text-gray-500 mt-2">
                  {{-- <span class="bg-{{ $task->importance->color }}-500 text-white text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                      Tingkat Prioritas: {{ $task->importance->name }}
                  </span> --}}
                </div>
                  <address class="flex items-center my-6 not-italic justify-between">
                      <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                          <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $task->pemberitugas->name }}">
                          <div>
                              <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $task->pemberitugas->name }}</a>
                              <p class="text-base text-gray-500 dark:text-gray-400">{{ $task->created_at->format('F d') }}</p>
                          </div>
                      </div>
                      <p class="text-base font-bold text-black">Tenggat {{ $task->tenggat }}</p>
                  </address>
                  <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $task->namakegiatan }}</h1>
              </header>
              <p>{{ $task->deskripsi }}</p>
              <p>{{ $task->volume }} {{ $task->satuan }}</p>
              <div class="mb-4">
                <label class="text-gray-700 font-bold mb-2 block">Progress:</label>
                <div class="relative w-full bg-gray-300 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $task['progress'] }}%;"></div>
                    <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $task['progress'] }}%</span>
                </div>
              </div>
          </article>
      </div>
    </main>

</x-layout> 