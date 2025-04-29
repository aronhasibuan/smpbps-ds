<x-layout>
    <div class="flex flex-col lg:flex-row justify-between">
        {{-- Nama dan Sidebar --}}
        <div class="mr-0 lg:mr-20 mb-5 lg:mb-0">
            <h2 class="mb-5 text-lg lg:text-xl">{{ $user->username }}</h2>    
            <x-sidebar></x-sidebar>
        </div>
        
        {{-- Konten --}}
        <div class="w-full p-4">
            {{-- Tab General --}}
            <div id="generalTab">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <p class="text-base lg:text-lg">Umum</p>
                    <p class="text-sm text-gray-500">Pengaturan umum yang terkait dengan profil anda.</p>
                    <form action="{{ route('updategeneral', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')   
                        <div class="bg-white border rounded-t-lg p-4 mt-2">
                            <div class="flex flex-col lg:flex-row mb-4 justify-between">
                                <div class="mb-2 lg:mb-0">
                                    <p class="text-base lg:text-lg">Nama</p>
                                    <p class="text-sm text-gray-500">Nama lengkap anda.</p>
                                </div>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full lg:w-auto" autocomplete="off">                
                            </div>
                            <div class="flex flex-col lg:flex-row justify-between">
                                <div class="mb-2 lg:mb-0">
                                    <p class="text-base lg:text-lg">Email</p>
                                    <p class="text-sm text-gray-500">Alamat email yang digunakan untuk otentikasi.</p>
                                </div>
                                <input type="text" id="email" name="email" value="{{ $user->email }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 w-full lg:w-auto">
                            </div>
                        </div>
                        <div class="border bg-white p-4 rounded-b-lg h-auto flex flex-col lg:flex-row items-center justify-end gap-2">
                            <button id="resetButton" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition hidden">
                                Reset
                            </button>
                            <button type="submit" id="saveButton" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition hidden">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // script untuk mengelola tombol reset dan save General
        document.addEventListener("DOMContentLoaded", function () {
            const nameInput = document.querySelector('input[value="{{ $user->name }}"]');
            const emailInput = document.querySelector('input[value="{{ $user->email }}"]');
            const saveButton = document.getElementById("saveButton");
            const resetButton = document.getElementById("resetButton");

            const originalName = nameInput.value;
            const originalEmail = emailInput.value;

            function checkChanges() {
                if (nameInput.value !== originalName || emailInput.value !== originalEmail) {
                    saveButton.classList.remove("hidden");
                    resetButton.classList.remove("hidden");
                } else {
                    saveButton.classList.add("hidden");
                    resetButton.classList.add("hidden");
                }
            }

            function resetInputs() {
                nameInput.value = originalName;
                emailInput.value = originalEmail;
                saveButton.classList.add("hidden");
                resetButton.classList.add("hidden");
            }

            nameInput.addEventListener("input", checkChanges);
            emailInput.addEventListener("input", checkChanges);
            resetButton.addEventListener("click", resetInputs);
        });
    </script>
    
</x-layout>