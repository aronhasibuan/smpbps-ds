<x-layout>
  <x-slot:headercontent>{{ $headercontent }}</x-slot:headercontent>
  
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">

      <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
          <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
              <header class="mb-4 lg:mb-6 not-format">
                <a href="/home" class="font-medium text-sm text-blue-600 hover:underline">&laquo; Back to Home</a>
                <div class="flex justify-between items-center mb-5 text-gray-500 mt-2">
                  <span class="bg-{{ $task->kemajuan['color'] }}-500 text-white text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                      Tingkat Kemajuan: {{ $task->kemajuan['status'] }}
                  </span>
                </div>
                  <address class="flex items-center my-6 not-italic justify-between">
                      <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                          <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $task->pemberitugas->name }}">
                          <div>
                              <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $task->pemberitugas->name }}</a>
                              <p class="text-base text-gray-500 dark:text-gray-400">{{ $task->created_at->format('F d') }}</p>
                          </div>
                      </div>
                      <p class="text-base font-bold text-black">Batas waktu {{ $task->formatted_tenggat }} ( {{ $task->waktu_tersisa }} tersisa )</p>
                  </address>
                  <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $task->namakegiatan }}</h1>
              </header>
              <p>{{ $task->deskripsi }}</p>
              <p>{{ $task->volume }} {{ $task->satuan }}</p>
              <div class="mb-4">
                <label class="text-gray-700 font-bold mb-2 block">Progress:</label>
                <div class="relative w-full bg-gray-300 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $task->percentage_progress }}%;"></div>
                    <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $task->percentage_progress }}%</span>
                </div>
              </div>
          </article>
      </div>

      @if (Auth::check() && Auth::user()->role == 'ketuatim')
        <div class="flex justify-center gap-4 mt-20">
          <button class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
            Perbarui Tugas
          </button>
          <button class="bg-red-600 text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
            Hapus Tugas
          </button>
        </div>
      @endif
    </main>

</x-layout>
