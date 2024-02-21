<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div class="sm:flex sm:justify-between sm:items-center mb-8">

        <!-- Right: Actions -->
        {{-- <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Datepicker built with flatpickr -->
            <x-datepicker />

        </div> --}}

    </div>
   <div class="grid grid-cols-12 gap-2">
        <div
            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 
            bg-gradient-to-r from-cyan-500 to-blue-500 dark:bg-slate-800 shadow-lg  dark:border-slate-700 rounded-md">
            <div class="px-5 pt-5 mb-5">

                <h2 class="text-lg font-semibold text-white dark:text-slate-100 mb-2">Tamu Pengujian Tahun 
                    <?php echo date("Y"); ?>
                </h2>
                <div class="text-xs font-semibold text-white dark:text-slate-500 uppercase mb-1">Jumlah</div>
                <div class="flex items-start">
                    <div class="text-3xl font-bold text-white dark:text-slate-100 mr-2">{{ $labCount }}</div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 
            bg-gradient-to-r from-blue-500 to-cyan-300 dark:bg-slate-800 shadow-lg  dark:border-slate-700 rounded-md">
            <div class="px-5 pt-5 mb-5">

                <h2 class="text-lg font-semibold text-white dark:text-slate-100 mb-2">Tamu Informasi Tahun 
                    <?php echo date("Y"); ?>
                </h2>
                <div class="text-xs font-semibold text-white dark:text-slate-500 uppercase mb-1">Jumlah</div>
                <div class="flex items-start">
                    <div class="text-3xl font-bold text-white dark:text-slate-100 mr-2">{{ $informationCount }}</div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 
            bg-gradient-to-r from-blue-500 to-cyan-300 dark:bg-slate-800 shadow-lg  dark:border-slate-700 rounded-md">
            <div class="px-5 pt-5 mb-5">

                <h2 class="text-lg font-semibold text-white dark:text-slate-100 mb-2">Tamu Umum Tahun 
                    <?php echo date("Y"); ?>
                </h2>
                <div class="text-xs font-semibold text-white dark:text-slate-500 uppercase mb-1">Jumlah</div>
                <div class="flex items-start">
                    <div class="text-3xl font-bold text-white dark:text-slate-100 mr-2">{{ $visitCount }}</div>
                </div>
            </div>
        </div>



    </div>



</div>
