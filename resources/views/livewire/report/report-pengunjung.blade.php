<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- TABLE -->
    <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">LAPORAN DAFTAR PENGUJUNG</h2>
        </header>
        <div class="p-3">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-1">
                    <select wire:model="category" id="category"
                        class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                         focus:ring-blue-500 focus:border-blue-500 block w-full p-2.0 dark:bg-gray-700
                          dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                          dark:focus:border-blue-500">
                        <option selected>Pilih Kategori</option>
                        <option value="3">Umum</option>
                        <option value="1">Pengujian</option>
                        <option value="2">Informasi</option>
                    </select>

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <input type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        placeholder="Select dates" wire:model="startdate" />

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <input type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        placeholder="Select dates" wire:model="enddate" />

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <button wire:click="pdf" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-blue-500 px-4 py-2 bg-blue-500 text-base leading-6 font-medium text-white shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        CETAK
                    </button>
                </div>


            </div>
            <br>

        </div>
    </div>

    {{-- table --}}
</div>
