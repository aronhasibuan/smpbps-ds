<!DOCTYPE html>
<html lang="en" class="h-full bg-white dark:bg-gray-900">
    <head>
        <meta charset="UTF-8">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistem Manajemen Pekerjaan BPS Kabupaten Deli Serdang</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        {{-- <style type="text/css">
            * {
                    outline: 1px solid red;
              }
        </style> --}}
    </head>
    <body class="h-full bg-white dark:bg-gray-900">
   
      <div class="min-h-full">
        <x-navbar></x-navbar>

        <main>
          <div class="mx-auto max-w-7xl px-2 py-6 sm:px-3">
            {{ $slot }}        
          </div>
        </main>
      </div>

    </body>

    <script type="text/javascript">
      @if(session('success'))
          toastr.success("{{ session('success') }}");
      @endif
      @if(session('error'))
          toastr.error("{{ session('error') }}");
      @endif
      @if(session('deleted'))
          toastr.info("{{ session('deleted') }}");
      @endif
    </script>

</html>