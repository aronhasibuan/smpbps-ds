<x-layout>
    <div>
        <h2 class="mb-5 text-lg lg:text-xl">{{ $user->username }}</h2>    
         
        {{-- Konten --}}
        <div class="w-full p-4">
            {{-- Tab General --}}
            <div id="generalTab">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <p class="text-base lg:text-lg">Umum</p>
                    <p class="text-sm text-gray-500">Pengaturan umum yang terkait dengan profil anda.</p>

                    <div class="bg-white border rounded-t-lg p-4 mt-2">
                        <div class="flex flex-col lg:flex-row mb-4 justify-between">
                            <div class="mb-2 lg:mb-0">
                                <p class="text-base lg:text-lg">Nama</p>
                                <p class="text-sm text-gray-500">Nama lengkap anda.</p>
                            </div>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full lg:w-auto" autocomplete="off" readonly>                
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            <div class="mb-2 lg:mb-0">
                                <p class="text-base lg:text-lg">Email</p>
                                <p class="text-sm text-gray-500">Alamat email yang digunakan untuk otentikasi.</p>
                            </div>
                            <input type="text" id="email" name="email" value="{{ $user->email }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full lg:w-auto" readonly>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Password --}}
            <div id="passwordTab">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <p class="text-base lg:text-lg">Kata Sandi</p>
                    <p class="text-sm text-gray-500">Anda dapat mengubah kata sandi anda di sini.</p>
                    <form action="{{ route('updatepassword', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="bg-white border rounded-t-lg p-4 mt-2">
                            <div class="flex flex-col lg:flex-row mb-4 justify-between">
                                <div class="mb-2 lg:mb-0">
                                    <p class="text-base lg:text-lg">Kata sandi saat ini</p>
                                    <p class="text-sm text-gray-500">Anda harus mengonfirmasi kata sandi Anda saat ini untuk membuat perubahan</p>
                                </div>
                                <div class="relative w-full lg:w-auto">
                                    <input type="password" name="currentpassword" id="currentpassword" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full">
                                    <button type="button" id="toggleCurrentPassword" class="absolute inset-y-0 end-0 flex items-center pr-3">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row mb-4 justify-between">
                                <div class="mb-2 lg:mb-0">
                                    <p class="text-base lg:text-lg">Kata sandi baru</p>
                                    <p class="text-sm text-gray-500">Kata sandi harus minimal 8 karakter</p>
                                </div>
                                <div class="relative w-full lg:w-auto">
                                    <input type="password" name="newpassword" id="newpassword" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full">
                                    <button type="button" id="toggleNewPassword" class="absolute inset-y-0 end-0 flex items-center pr-3">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row justify-between">
                                <div class="mb-2 lg:mb-0">
                                    <p class="text-base lg:text-lg">Konfirmasi kata sandi baru</p>
                                    <p class="text-sm text-gray-500">Masukkan kembali kata sandi baru Anda.</p>
                                </div>
                                <div class="relative w-full lg:w-auto">
                                    <input type="password" name="confirmnewpassword" id="confirmnewpassword" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full">
                                    <button type="button" id="toggleConfirmNewPassword" class="absolute inset-y-0 end-0 flex items-center pr-3">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.857-.684 1.662-1.208 2.382" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="border bg-white p-4 rounded-b-lg h-auto flex flex-col lg:flex-row items-center justify-end gap-2">
                            <button id="resetpasswordButton" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition hidden">
                                Reset
                            </button>
                            <button id="savepasswordButton" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition hidden">
                                Save
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

            function checkPasswordChanges() {
                if (currentPasswordInput.value || newPasswordInput.value || confirmNewPasswordInput.value) {
                    savePasswordButton.classList.remove("hidden");
                    resetPasswordButton.classList.remove("hidden");
                } else {
                    savePasswordButton.classList.add("hidden");
                    resetPasswordButton.classList.add("hidden");
                }
            }

            function resetPasswordInputs() {
                currentPasswordInput.value = "";
                newPasswordInput.value = "";
                confirmNewPasswordInput.value = "";
                savePasswordButton.classList.add("hidden");
                resetPasswordButton.classList.add("hidden");
            }

            currentPasswordInput.addEventListener("input", checkPasswordChanges);
            newPasswordInput.addEventListener("input", checkPasswordChanges);
            confirmNewPasswordInput.addEventListener("input", checkPasswordChanges);
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