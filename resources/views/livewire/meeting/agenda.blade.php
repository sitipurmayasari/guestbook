<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- TABLE -->
    <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">ABSENSI KEGIATAN</h2>
        </header>
        <div class="p-3">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <button wire:click="create()" class="btn bg-blue-500 hover:bg-blue-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Tambah Kegiatan </span>
                    </button>
                </div>

                <div class="col-span-6 sm:col-span-1">
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

                <div class="col-span-6 sm:col-span-3 float: right">
                    <input wire:model="search" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        placeholder="Search...">
                </div>

            </div>
            <br>

            @if ($openModalDelete)
                @include('livewire.common.modal-delete')
            @endif


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
                                <div class="font-semibold text-center">NAMA KEGIATAN</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">TANGGAL KEGIATAN</div>
                            </th>
                            <th>
                                <div class="font-semibold text-center">LINK ABSENSI</div>
                            </th>
                            <th>
                                <div class="font-semibold text-center">LAPORAN KEGIATAN</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">AKSI</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($data as $key => $row)
                            <tr>

                                <td class="p-2">
                                    <div class="text-center">
                                        {{ $data->firstItem() + $key }}
                                    </div>
                                </td>

                                <td class="p-2">
                                    <div class="text-left">{{ $row->name }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center">{{ $row->datefrom }} s/d {{ $row->dateto }}</div>
                                </td>

                                <td class="p-2">
                                    <div class="text-center">
                                        <a href="{{route('agenda.qr',$row->slug)}}" target="__blank"
                                            @if ($now->toDateString() > $row->datefrom)
                                                onclick="return false;"
                                                class="inline-flex items-center px-4 py-2 bg-gray-400 hover:bg-gray-600"
                                            @endif
                                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md">
                                            <svg class="h-5 w-5 text-white-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="6" height="6" rx="1" />  <line x1="7" y1="17" x2="7" y2="17.01" />  <rect x="14" y="4" width="6" height="6" rx="1" />  <line x1="7" y1="7" x2="7" y2="7.01" />  <rect x="4" y="14" width="6" height="6" rx="1" />  <line x1="17" y1="7" x2="17" y2="7.01" />  <line x1="14" y1="14" x2="17" y2="14" />  <line x1="20" y1="14" x2="20" y2="14.01" />  <line x1="14" y1="14" x2="14" y2="17" />  <line x1="14" y1="20" x2="17" y2="20" />  <line x1="17" y1="17" x2="20" y2="17" />  <line x1="20" y1="17" x2="20" y2="20" /></svg>
                                        </a>
                                    </div>
                                </td>

                                <td class="p-2">
                                    <div class="text-center">
                                        <button wire:click="cetak('{{ $row->id }}')" type="button"
                                            class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md">
                                            <svg class="h-5 w-5 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />  <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />  <rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                                        </button>
                                    </div>
                                </td>

                                <td class="p-2">
                                    <div class="text-right py-2">
                                        <button wire:click="edit('{{ $row->id }}')" type="button"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete('{{ $row->id }}','{{ $row->name }}')"
                                            type="button"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                            <svg class="h-5 w-5 text-white" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
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
                {{ $data->links() }}

            </div>
        </div>
    </div>

    @if ($isOpen)
        @include('livewire.meeting.modal-agenda')
    @endif
    @if ($isReady)
        @include('livewire.meeting.modal-cetak')
    @endif

</div>
