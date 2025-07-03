<x-layout>
    <div>

        <div class="mb-6">
            <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 dark:text-white">{{ $user->user_nickname }}</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi profil Anda</p>
        </div>    
         
        {{-- Konten --}}
        <div class="w-full">
            {{-- Tab General --}}
            <div id="generalTab" class="border rounded-lg overflow-hidden shadow-sm my-4">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <p class="text-base lg:text-lg">Umum</p>
                    <p class="text-sm text-gray-500">Pengaturan umum yang terkait dengan profil anda.</p>

                    <div class="bg-white border rounded-t-lg p-4 mt-2">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4">
                            <div class="mb-2 lg:mb-0 lg:w-1/3">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <p class="text-xs text-gray-500 mt-1">Nama lengkap Anda</p>
                            </div>
                            <div class="w-full lg:w-2/3">
                                <input type="text" id="name" name="name" value="{{ $user->user_full_name }}" 
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    readonly>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4">
                            <div class="mb-2 lg:mb-0 lg:w-1/3">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <p class="text-xs text-gray-500 mt-1">Alamat email yang digunakan untuk otentikasi.</p>
                            </div>
                            <div class="w-full lg:w-2/3">
                                <input type="text" id="email" name="email" value="{{ $user->email }}" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="my-4 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat {{ count($errors) }} kesalahan
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tab Password --}}
            <div id="passwordTab" class="border rounded-lg overflow-hidden shadow-sm">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <p class="text-base lg:text-lg">Kata Sandi</p>
                    <p class="text-sm text-gray-500">Anda dapat mengubah kata sandi anda di sini.</p>
                    <form action="{{ route('update-password', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="bg-white border rounded-t-lg p-4 mt-2">
                            <div class="mb-4">
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                    <div class="w-full lg:w-1/3">
                                        <label for="currentpassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Kata sandi saat ini
                                        </label>
                                        <p class="text-xs text-gray-500 mt-1">Anda harus mengonfirmasi kata sandi saat ini</p>
                                    </div>
                                    <div class="relative w-full lg:w-2/3">
                                        <input 
                                            type="password" 
                                            id="currentpassword" 
                                            name="currentpassword" 
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Masukkan kata sandi saat ini"
                                            required>
                                        <button 
                                            type="button" 
                                            id="toggleCurrentPassword" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            aria-label="Toggle password visibility">
                                            <!-- Eye icon SVG -->
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                    <div class="w-full lg:w-1/3">
                                        <label for="newpassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Kata sandi baru
                                        </label>
                                        <p class="text-xs text-gray-500 mt-1">Kata sandi harus minimal 8 karakter</p>
                                    </div>
                                    <div class="relative w-full lg:w-2/3">
                                        <input 
                                            type="password" 
                                            name="newpassword" 
                                            id="newpassword" 
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Masukkan kata sandi baru"
                                            required>
                                        <button 
                                            type="button" 
                                            id="toggleNewPassword" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                    <div class="w-full lg:w-1/3">
                                        <label for="confirmnewpassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Konfirmasi kata sandi baru
                                        </label>
                                        <p class="text-xs text-gray-500 mt-1">Masukkan kembali kata sandi baru Anda.</p>
                                    </div>
                                    <div class="relative w-full lg:w-2/3">
                                        <input 
                                            type="password" 
                                            name="confirmnewpassword" 
                                            id="confirmnewpassword" 
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Masukkan kembali kata sandi baru"
                                            required>
                                        <button 
                                            type="button" 
                                            id="toggleConfirmNewPassword" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-b-lg border-t flex justify-end gap-3">
                            <button type="button" id="resetpasswordButton" 
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                                Reset
                            </button>
                            <button type="submit" id="savepasswordButton" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>    
        // script untuk mengelola tombol reset dan save Password
        document.addEventListener("DOMContentLoaded", function(){
            const currentPasswordInput = document.getElementById("currentpassword");
            const newPasswordInput = document.getElementById("newpassword");
            const confirmNewPasswordInput = document.getElementById("confirmnewpassword");
            const savePasswordButton = document.getElementById("savepasswordButton");
            const resetPasswordButton = document.getElementById("resetpasswordButton");

            function resetPasswordInputs() {
                currentPasswordInput.value = "";
                newPasswordInput.value = "";
                confirmNewPasswordInput.value = "";
            }

            resetPasswordButton.addEventListener("click", resetPasswordInputs);
        });

        // script untuk mengelola toggle current password visibility
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("toggleCurrentPassword");
            const passwordInput = document.getElementById("currentpassword");
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

        // script untuk mengelola toggle new password visibility
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("toggleNewPassword");
            const passwordInput = document.getElementById("newpassword");
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

        // script untuk mengelola toggle confirm new password visibility
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("toggleConfirmNewPassword");
            const passwordInput = document.getElementById("confirmnewpassword");
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
    
</x-layout>