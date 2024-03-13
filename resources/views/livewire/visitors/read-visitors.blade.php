<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- TABLE -->
    <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">DATA PENGUNJUNG</h2>
        </header>
        <div class="p-3">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <a href="{{ route('visitors.create') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Tambah Pengunjung </span>
                    </a>

                </div>

                <div class="col-span-4 sm:col-span-1">
                    <select wire:model="paginate" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="5">5 Per Page</option>
                        <option value="10">10 Per Page</option>
                        <option value="15">15 Per Page</option>
                        <option value="20">20 Per Page</option>
                        <option value="25">25 Per Page</option>
                        <option value="50">50 Per Page</option>
                        <option value="100">100 Per Page</option>
                    </select>
                </div>
                <div class="col-span-4 sm:col-span-1">
                    <select wire:model="filter_status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="">Semua tamu</option>
                        <option value="3">Umum</option>
                        <option value="1">Pengunjian</option>
                        <option value="2">Layanan Informasi</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-2 float: right">
                    <input wire:model="search" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        placeholder="Search...">
                </div>

            </div>
            <br>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full dark:text-slate-300">
                    <!-- Table header -->
                    <thead
                        class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-left">NO</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">TANGGAL</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">NAMA LENGKAP</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">ASAL</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">TUJUAN</div>
                            </th>
                            {{-- <th class="p-2">
                                <div class="font-semibold text-center">FOTO</div>
                            </th> --}}
                            <th class="p-2">
                                <div class="font-semibold text-center">DETAIL</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($visitors as $key => $row)
                            <tr>
                                <td class="p-2">
                                    <div class="text-center">
                                        {{ $visitors->firstItem() + $key }}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        {{ Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">{{ $row->name }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">{{ $row->origin }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">{{ $row->purpose }}</div>
                                </td>
                                {{-- <td class="p-2">
                                    <div class="text-center">
                                        <a href="{{ $row->foto }}" target="__blank">
                                            <img src="{{ $row->foto}}" alt="" width="50px"
                                                height="50px"></a>
                                    </div>
                                </td> --}}
                                <td class="p-2">
                                    <div class="text-right py-2">
                                        <a href="{{ route('visitors.detail', $row->id) }}" type="button"
                                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md">
                                            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="p-2">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                        <!-- Row -->


                    </tbody>
                </table>
                {{ $visitors->links() }}

            </div>
        </div>
    </div>

</div>
