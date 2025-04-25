<x-layout>

    <div class="flex justify-between">
        {{-- Nama dan Sidebar --}}
        <div class="mr-20">
            <h2 class="mb-5">{{ $user->username }}</h2>    
            <x-sidebar></x-sidebar>
        </div>
        
        {{-- Konten --}}
        <div class="w-full">
            {{-- Tab General --}}
            <div id="generalTab">
                <div class="border rounded-lg p-4 bg-gray-50">
        
                    <p class="text-base">Umum</p>
                    <p class="text-sm text-gray-500">Pengaturan umum yang terkait dengan profil anda.</p>
        
                    <form action="{{ route('updategeneral', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')   
                        <div class="bg-white border rounded-t-lg p-4 mt-2">
                            <div class="flex mb-4 justify-between">
                                <div>
                                    <p class="text-base">Nama</p>
                                    <p class="text-sm text-gray-500">Nama lengkap anda.</p>
                                </div>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 pr-10" autocomplete="off">                
                            </div>
            
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-base">Email</p>
                                    <p class="text-sm text-gray-500">Alamat email yang digunakan untuk otentikasi.</p>
                                </div>
                                <input type="text" id="email" name="email" value="{{ $user->email }}" class="text-sm text-gray-900 border border-gray-300 rounded-md p-2 pr-10">
                            </div>
                        </div>
                        
                        <div class="border bg-white p-4 rounded-b-lg h-12 flex items-center justify-end">
                            <button id="resetButton" class="bg-gray-500 text-white px-2 py-1 rounded-md hover:bg-gray-600 transition hidden m-4">
                                Reset
                            </button>
                            <button type="submit" id="saveButton" class="bg-blue-600 text-white px-2 py-1 rounded-md hover:bg-blue-700 transition hidden">
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