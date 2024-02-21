<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">DETAIL DATA
                PENGUNJUNG 
                @if ($category == 1)
                    PENGUJIAN
                @elseif ($category == 2)
                    LAYANAN INFORMASI
                @else
                    UMUM
                @endif
            </label></h2>
        </header>
        <form enctype="multipart/form-data">
            <div class="p-3">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="name" value="Nama Lengkap" />
                            <x-jet-input id="name" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                                wire:model="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-2">
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="jam" value="Tanggal / Waktu" />
                                <x-jet-input id="jam" disabled type="datetime"
                                class="bg-gray-200 mt-1 block w-full" wire:model="tgl" />
                                <x-jet-input-error for="jam" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="origin" value="Asal Pengunjung" />
                            <x-jet-input id="origin" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                            wire:model="origin" />
                        <x-jet-input-error for="origin" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="telp" value="No. Telp" />
                            <x-jet-input id="telp" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                            wire:model="telp" />
                            <x-jet-input-error for="telp" class="mt-2" />
                        </div>
                        @if ($category==2)
                            <div class="col-span-6 sm:col-span-6">
                                <x-jet-label for="email" value="Email" />
                                <x-jet-input id="email" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                                wire:model="email" />
                                <x-jet-input-error for="email" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-6 gap-6 mt-2">
                                <div class="col-span-6 sm:col-span-2">
                                    <x-jet-label for="gender" value="Jenis Kelamin*" />
                                    <div class="mt-1">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" class="form-radio" name="gender" value="L"
                                                    wire:model="gender" disabled>
                                                <span class="ml-2">Laki-Laki</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" class="form-radio" name="gender" value="P"
                                                    wire:model="gender" disabled>
                                                <span class="ml-2">Perempuan</span>
                                            </label>
                                        </div>
                                    </div>
                                    <x-jet-input-error for="gender" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <x-jet-label for="age" value="Usia (Tahun)" />
                                    <x-jet-input id="age" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                                wire:model="age" />
                                    <x-jet-input-error for="age" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6 mt-2">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="school" value="Pendidikan Terakhir" />
                                    <x-jet-input id="school" disabled type="text"
                                        class="bg-gray-200 mt-1 block w-full" wire:model="school" />
                                    <x-jet-input-error for="school" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="education" value="Jurusan" />
                                    <x-jet-input id="education" disabled type="text"
                                        class="bg-gray-200 mt-1 block w-full" wire:model="education" />
                                    <x-jet-input-error for="education" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <x-jet-label for="work" value="Pekerjaan" />
                                <x-jet-input id="work" type="text" disabled class="bg-gray-200 mt-1 block w-full"
                                wire:model="work" />
                                <x-jet-input-error for="work" class="mt-2" />
                            </div>
                        @endif
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <div class="col-span-6 sm:col-span-6 mt-2 mb-10">
                            <x-jet-label for="name" value="Foto" />
                            <img src="{{ $visitors->foto}}" alt="" width="200px">
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="purpose" value="Tujuan" />
                            <textarea id="purpose" type="text" class="bg-gray-200 rounded mt-1 block w-full" wire:model="purpose" disabled></textarea>
                            <x-jet-input-error for="purpose" class="mt-2" />
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </form>
    </div>
</div>