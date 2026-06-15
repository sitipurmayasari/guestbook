<x-app-layout>
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <svg class="shrink-0 h-8 w-8 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.849L.073 23.51a.75.75 0 00.918.918l5.662-1.459A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.716 9.716 0 01-4.964-1.358l-.356-.212-3.693.951.968-3.583-.232-.368A9.715 9.715 0 012.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75z"/>
            </svg>
            <h2 class="font-bold text-slate-800 dark:text-slate-100 text-2xl">Kontak WA Blast</h2>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 ml-11">Kelola kontak permanen untuk pengiriman WA Blast.</p>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <x-alert-success />
    @endif
    @if (session('error'))
        <x-alert-danger />
    @endif

    {{-- Tabel --}}
    <div class="col-span-full bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 dark:text-slate-100">Daftar Kontak</h3>
            <a href="{{ route('wa-blast.contacts.create') }}"
               class="btn bg-blue-500 hover:bg-blue-600 text-white flex items-center gap-2">
                <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                    <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"/>
                </svg>
                <span>Tambah Kontak</span>
            </a>
        </header>

        <div class="p-3">
            <div class="overflow-x-auto">
                <table class="table-auto w-full dark:text-slate-300">
                    <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2"><div class="font-semibold text-center">No</div></th>
                            <th class="p-2"><div class="font-semibold text-left">Nama</div></th>
                            <th class="p-2"><div class="font-semibold text-left">Asal</div></th>
                            <th class="p-2"><div class="font-semibold text-left">No. Telepon</div></th>
                            <th class="p-2"><div class="font-semibold text-center">Kategori</div></th>
                            <th class="p-2"><div class="font-semibold text-center">Status</div></th>
                            <th class="p-2"><div class="font-semibold text-center">Aksi</div></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse ($contacts as $key => $contact)
                        <tr>
                            <td class="p-2">
                                <div class="text-center text-slate-500">{{ $contacts->firstItem() + $key }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-slate-800 dark:text-slate-100 font-semibold">{{ $contact->name }}</div>
                                @if ($contact->note)
                                    <div class="text-xs text-slate-400">{{ $contact->note }}</div>
                                @endif
                            </td>
                            <td class="p-2">
                                <div class="text-slate-600 dark:text-slate-300">{{ $contact->origin ?? '-' }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-slate-600 dark:text-slate-300">{{ $contact->telp }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">
                                    @php
                                        $kategoriMap = [1 => 'Pengujian', 2 => 'Informasi', 3 => 'Umum'];
                                        $kategoriColor = [1 => 'bg-blue-100 text-blue-700', 2 => 'bg-purple-100 text-purple-700', 3 => 'bg-yellow-100 text-yellow-700'];
                                    @endphp
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold {{ $kategoriColor[$contact->category] ?? 'bg-slate-100 text-slate-600' }}">
                                        {{ $kategoriMap[$contact->category] ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">
                                    @if ($contact->is_active)
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                                    @else
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Nonaktif</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('wa-blast.contacts.edit', $contact) }}"
                                       class="btn bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('wa-blast.contacts.destroy', $contact) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kontak ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn bg-red-500 hover:bg-red-600 text-white text-xs py-1 px-3">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-slate-400 dark:text-slate-500">
                                Belum ada kontak. <a href="{{ route('wa-blast.contacts.create') }}" class="text-blue-500 hover:underline">Tambah kontak baru</a>.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($contacts->hasPages())
            <div class="px-2 py-3">
                {{ $contacts->links() }}
            </div>
            @endif
        </div>
    </div>

</div>
</x-app-layout>
