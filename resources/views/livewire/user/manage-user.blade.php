<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">DATA USER</h2>
        </header>
        <div class="p-3">

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">



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
                                <div class="font-semibold text-center">NIK</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">NAMA</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">EMAIL</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">ROLE</div>
                            </th>


                            <th class="p-2">
                                <div class="font-semibold text-center">AKSI</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">

                        @forelse ($users as $key => $row)
                            <tr>

                                <td class="p-2">
                                    <div class="text-center">
                                        {{ $users->firstItem() + $key }}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center">{{ $row->nik }}</div>
                                </td>

                                <td class="p-2">
                                    <div class="text-center">{{ $row->name }}</div>
                                </td>

                                <td class="p-2">
                                    <div class="text-center">{{ $row->email }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-center">{{ $row->isRole() }}</div>
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
                                        <button wire:click="delete('{{ $row->id }}')" type="button"
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
                {{ $users->links() }}

            </div>
        </div>
    </div>

<section>

        </section>

@if ($isOpen)
    @include('livewire.user.create')
@endif
    {{-- table --}}
</div>
