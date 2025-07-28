<x-layout>
    <div class="flex items-center justify-center min-h-screen p-4 dark:bg-gray-900">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border dark:border-gray-700">
                <div class="p-6 space-y-6">
                    {{-- Logo --}}
                    <div class="flex justify-center">
                        <img src="{{ asset('img/Logo SM Raja.png') }}" 
                             alt="Logo Sistem Manajemen Pekerjaan BPS Kabupaten Deli Serdang" 
                             class="w-48 h-auto"
                             width="192"
                             height="192">
                    </div>

                    {{-- Form login --}}
                    <form class="space-y-4" action="{{ route('authenticate') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="space-y-4">
                            {{-- Email Field --}}
                            <div class="relative">
                                <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Email
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       class="w-full p-2.5 pr-10 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="nama@gmail.com" 
                                       required
                                       autocomplete="off">
                                <img src="{{ asset('img/person.svg') }}" 
                                     alt="" 
                                     class="absolute right-3 top-9 w-5 h-5 text-gray-400 pointer-events-none"
                                     aria-hidden="true">
                            </div>

                            {{-- Password Field --}}
                            <div>
                                <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Kata Sandi
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           placeholder="••••••••" 
                                           class="w-full p-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                           required
                                           autocomplete="current-password">
                                    <button type="button" 
                                            id="togglePassword" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3"
                                            aria-label="Toggle password visibility">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" 
                                id="loginButton"
                                class="w-full px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            <span id="buttonText">Masuk</span>
                            <span id="buttonLoading" class="hidden">
                                <svg class="w-5 h-5 mx-auto animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                    </form>

                    {{-- Info Button --}}
                    <button type="button" 
                            id="info-button" 
                            class="w-full text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 hover:underline bg-transparent border-0 p-0 text-center transition-colors">
                        Lupa Password atau Tidak Punya Akun?
                    </button>
                </div>
            </div>
        </div>

        {{-- Info Popup --}}
        <x-login-information-modal />
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            
            // Toggle password visibility
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (togglePassword && passwordInput && eyeIcon) {
                togglePassword.addEventListener("click", function() {
                    const isPassword = passwordInput.type === "password";
                    passwordInput.type = isPassword ? "text" : "password";
                    // Update icon
                    if (isPassword) {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                    } else {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
                    }
                });
            }

            // Form submission handling
            const loginForm = document.querySelector('form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const button = document.getElementById('loginButton');
                    const buttonText = document.getElementById('buttonText');
                    const buttonLoading = document.getElementById('buttonLoading');
                    
                    if (button && buttonText && buttonLoading) {
                        button.disabled = true;
                        buttonText.classList.add('hidden');
                        buttonLoading.classList.remove('hidden');
                        button.classList.add('cursor-not-allowed', 'opacity-75');
                    }
                });
            }
        });
    </script>
</x-layout>