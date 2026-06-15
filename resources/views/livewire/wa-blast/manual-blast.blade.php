<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    {{-- ===== HEADER ===== --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <svg class="shrink-0 h-8 w-8 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.849L.073 23.51a.75.75 0 00.918.918l5.662-1.459A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.716 9.716 0 01-4.964-1.358l-.356-.212-3.693.951.968-3.583-.232-.368A9.715 9.715 0 012.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75z"/>
            </svg>
            <div>
                <h2 class="font-bold text-slate-800 dark:text-slate-100 text-2xl">WA BLAST — Manual (Kontak)</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    Kirim WA Blast ke kontak permanen.
                    <a href="{{ route('wa-blast.contacts.index') }}" class="text-blue-500 hover:underline ml-1">Kelola Kontak &rarr;</a>
                </p>
            </div>
        </div>
    </div>

    {{-- ===== 1. JUDUL PESAN ===== --}}
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mb-6">
        <header class="px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white text-xs font-bold">1</span>
                Judul Pesan
            </h3>
        </header>
        <div class="p-5">
            <input wire:model="messageTitle" type="text"
                class="form-input rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white text-base font-medium"
                placeholder="Masukkan judul pesan...">
        </div>
    </div>

    {{-- ===== 2. ISI PESAN ===== --}}
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mb-6">
        <header class="px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white text-xs font-bold">2</span>
                Isi Pesan
                <span class="ml-2 text-xs text-blue-400 normal-case font-normal">(gunakan <code>{nama}</code> untuk nama kontak)</span>
            </h3>
        </header>
        <div class="p-5">
            <textarea wire:model="message" rows="4"
                class="form-textarea rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                placeholder="Tulis isi pesan WhatsApp di sini..."></textarea>
        </div>
    </div>

    {{-- ===== 3. FILTER ===== --}}
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mb-6">
        <header class="px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white text-xs font-bold">3</span>
                Filter Kontak
            </h3>
        </header>
        <div class="p-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase">Kategori</label>
                    <select wire:model="category" class="form-select rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        <option value="">Semua Kategori</option>
                        <option value="1">Pengujian</option>
                        <option value="2">Informasi</option>
                        <option value="3">Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase">Status</label>
                    <select wire:model="filterActive" class="form-select rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                        <option value="">Semua</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase">Tampilkan</label>
                    <select wire:model="paginate" class="form-select rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase">Cari</label>
                    <input wire:model.debounce.300ms="search" type="text"
                        class="form-input rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                        placeholder="Cari nama / HP / asal...">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== 4. DAFTAR KONTAK ===== --}}
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mb-6">
        <header class="px-5 py-3 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white text-xs font-bold">4</span>
                Daftar Kontak
            </h3>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <svg class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/>
                    </svg>
                    Total: <strong class="text-slate-700 dark:text-slate-200">{{ $contacts->total() }}</strong> &nbsp;|&nbsp;
                    Dipilih: <strong class="text-green-600 dark:text-green-400">{{ count($selected) }}</strong>
                </div>
                <button wire:click="sendBlast" wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-green-500 hover:bg-green-600 disabled:opacity-50 text-white text-sm font-semibold shadow transition">
                    <span wire:loading.remove wire:target="sendBlast">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.849L.073 23.51a.75.75 0 00.918.918l5.662-1.459A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.716 9.716 0 01-4.964-1.358l-.356-.212-3.693.951.968-3.583-.232-.368A9.715 9.715 0 012.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75z"/>
                        </svg>
                    </span>
                    <span wire:loading wire:target="sendBlast">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </span>
                    Kirim WA Blast ({{ count($selected) }})
                </button>
            </div>
        </header>

        <div class="p-3 overflow-x-auto">
            <table class="table-auto w-full dark:text-slate-300 text-sm">
                <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                    <tr>
                        <th class="p-2 text-center w-10">
                            <input type="checkbox"
                                wire:click="toggleSelectAll"
                                {{ $selectAll ? 'checked' : '' }}
                                class="rounded border-slate-400 text-green-500 focus:ring-green-400">
                        </th>
                        <th class="p-2 text-left">No</th>
                        <th class="p-2 text-left">Nama</th>
                        <th class="p-2 text-left">Asal</th>
                        <th class="p-2 text-center">Kategori</th>
                        <th class="p-2 text-center">Status</th>
                        <th class="p-2 text-left">No HP</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse ($contacts as $index => $contact)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition {{ in_array((string)$contact->id, $selectedStr) ? 'bg-green-50 dark:bg-green-900/20' : '' }}">
                            <td class="p-2 text-center">
                                <input type="checkbox"
                                    wire:click="toggleSelected({{ $contact->id }})"
                                    {{ in_array((string)$contact->id, $selectedStr) ? 'checked' : '' }}
                                    class="rounded border-slate-400 text-green-500 focus:ring-green-400">
                            </td>
                            <td class="p-2 text-slate-500 dark:text-slate-400">{{ $contacts->firstItem() + $index }}</td>
                            <td class="p-2 text-slate-800 dark:text-slate-100 font-semibold">
                                {{ $contact->name }}
                                @if ($contact->note)
                                    <div class="text-xs text-slate-400 font-normal">{{ $contact->note }}</div>
                                @endif
                            </td>
                            <td class="p-2 text-slate-500 dark:text-slate-400">{{ $contact->origin ?? '-' }}</td>
                            <td class="p-2 text-center">
                                @php
                                    $kategoriMap   = [1 => 'Pengujian', 2 => 'Informasi', 3 => 'Umum'];
                                    $kategoriColor = [1 => 'bg-blue-100 text-blue-700', 2 => 'bg-green-100 text-green-700', 3 => 'bg-yellow-100 text-yellow-700'];
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $kategoriColor[$contact->category] ?? 'bg-slate-100 text-slate-500' }}">
                                    {{ $kategoriMap[$contact->category] ?? '-' }}
                                </span>
                            </td>
                            <td class="p-2 text-center">
                                @if ($contact->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-2 text-slate-600 dark:text-slate-300 font-mono">{{ $contact->telp }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400 dark:text-slate-500">
                                Tidak ada kontak ditemukan.
                                <a href="{{ route('wa-blast.contacts.create') }}" class="text-blue-500 hover:underline ml-1">Tambah kontak baru</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($contacts->hasPages())
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

</div>

