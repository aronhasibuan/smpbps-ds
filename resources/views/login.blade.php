<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Sistem Manajemen Rancangan Pekerjaan BPS Kabupaten Deli Serdang"</title>

        {{-- script untuk tailwind css --}}
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- link untuk toastr --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <section class="bg-white dark:bg-gray-900 h-screen flex items-center justify-center">

          <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                        {{-- logo --}}
                        <img src="{{ asset('img/Logo SM Raja - cutted.png') }}" alt="Sistem Manajemen Pekerjaan BPS Kabupaten Deli Serdang" class="">

                        {{-- form login --}}
                        <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                            <div class="relative">
                                <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="nama@gmail.com" required autocomplete="off">
                                <img src="{{ asset('img/person.svg') }}" alt="Person" class="absolute right-3 top-9 w-5 h-5 text-gray-400 pointer-events-none">
                            </div>
                            <div>
                                <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                                <div class="relative">
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" autocomplete="off">
                                <button type="button" id="togglePassword" class="absolute inset-y-0 end-0 flex items-center pr-3">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                              </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-[#002d57] hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Masuk</button>
                        </form>

                    </div>
                </div>
            </div>

        </section>

        {{-- script untuk toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>

        {{-- script untuk mengelola toggle password visibility --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const togglePassword = document.getElementById("togglePassword");
                const passwordInput = document.getElementById("password");
                const eyeIcon = document.getElementById("eyeIcon");
            
                togglePassword.addEventListener("click", function () {
                    const isPassword = passwordInput.type === "password";
                    passwordInput.type = isPassword ? "text" : "password";
            
                    if (isPassword) {
                        eyeIcon.setAttribute("d", "M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382");
                    } else {
                        eyeIcon.setAttribute("d", "M15 12a3 3 0 11-6 0 3 3 0 016 0z");
                    }
                });
            });
        </script>

    </body>  
</html>