<x-app-layout>
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('wa-blast.contacts.index') }}" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="font-bold text-slate-800 dark:text-slate-100 text-2xl">Tambah Kontak</h2>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-sm px-5 py-4">
        <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-slate-700 dark:text-slate-200">Informasi Kontak</h3>
        </header>

        <form action="{{ route('wa-blast.contacts.store') }}" method="POST" class="p-5 space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white @error('name') border-red-400 @enderror"
                       placeholder="Nama lengkap kontak" required>
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Asal --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Asal Instansi / Kota
                </label>
                <input type="text" name="origin" value="{{ old('origin') }}"
                       class="form-input rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                       placeholder="Contoh: BPOM Jakarta">
            </div>

            {{-- No. Telepon --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    No. Telepon / WhatsApp <span class="text-red-500">*</span>
                </label>
                <input type="text" name="telp" value="{{ old('telp') }}"
                       class="form-input rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white @error('telp') border-red-400 @enderror"
                       placeholder="628123456789" required>
                @error('telp')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category"
                        class="form-select rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white @error('category') border-red-400 @enderror"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Pengujian</option>
                    <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Informasi</option>
                    <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Umum</option>
                </select>
                @error('category')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       class="form-checkbox rounded dark:bg-slate-700"
                       {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">
                    Aktifkan kontak ini
                </label>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Catatan
                </label>
                <textarea name="note" rows="3"
                          class="form-textarea rounded-md shadow-sm block w-full dark:bg-slate-700 dark:border-slate-600 dark:text-white @error('note') border-red-400 @enderror"
                          placeholder="Catatan tambahan (opsional)">{{ old('note') }}</textarea>
                @error('note')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-3 pt-2 border-t border-slate-100 dark:border-slate-700">
                <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white">
                    Simpan Kontak
                </button>
                <a href="{{ route('wa-blast.contacts.index') }}"
                   class="btn border-slate-200 dark:border-slate-700 hover:border-slate-300 text-slate-600 dark:text-slate-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
</x-app-layout>
