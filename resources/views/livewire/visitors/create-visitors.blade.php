<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- TABLE -->
    <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">KUNJUNGAN ANDA
                {{ strtoupper(auth()->user()->name) }}
                <div>
                    <span class="text-xs text-gray-400">Tanggal : {{ date('d-m-Y') }}
                        <span id="jam"></span>
                    </span>
                </div>
            </h2>
        </header>
        <div class="p-3">
            <div class="p-3">
                <div class="grid grid-cols-6 gap-6">
                    
                    
                    <div class="col-span-6 sm:col-span-3">
                        <div class="col-span-6 sm:col-span-2">
                            <x-jet-label for="gender" value="Jenis Tamu*" />
                            <div class="mt-1">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="category" value="3"
                                            wire:model="category" >
                                        <span class="ml-2">Umum</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="category" value="1"
                                            wire:model="category" >
                                        <span class="ml-2">Pengujian</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="category" value="2"
                                            wire:model="category" >
                                        <span class="ml-2">Layanan Informasi</span>
                                    </label>
                                </div>
                            </div>
                            <x-jet-input-error for="category" class="mt-2" />
                        </div>
    
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="name" value="Nama Lengkap" />
                            <x-jet-input id="name" type="text" class="bg-white mt-1 block w-full"
                                wire:model="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="tgl" value="Tanggal Kunjungan" />
                            <x-jet-input id="tgl"  type="datetime"
                                class="bg-white mt-1 block w-full" wire:model="tgl" />
                            <x-jet-input-error for="tgl" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="origin" value="Asal Instansi" />
                            <x-jet-input id="origin" type="text"  class="bg-white mt-1 block w-full"
                            wire:model="origin" />
                        <x-jet-input-error for="origin" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="purpose" value="Tujuan" />
                            <textarea id="purpose" type="text" class="bg-white rounded mt-1 block w-full" wire:model="purpose"></textarea>
                            <x-jet-input-error for="purpose" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="telp" value="No. Telp" />
                            <x-jet-input id="telp" type="number"  class="bg-white mt-1 block w-full"
                            wire:model="telp" />
                            <x-jet-input-error for="telp" class="mt-2" />
                        </div>

                        @if ($category==2)
                            
                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="email" value="Email" />
                            <x-jet-input id="email" type="email"  class="bg-white mt-1 block w-full"
                            wire:model="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-2">

                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="gender" value="Jenis Kelamin*" />
                                <div class="mt-1">
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio" name="gender" value="L"
                                                wire:model="gender" >
                                            <span class="ml-2">Laki-Laki</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio" name="gender" value="P"
                                                wire:model="gender" >
                                            <span class="ml-2">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                                <x-jet-input-error for="gender" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="age" value="Usia (Tahun)" />
                                <x-jet-input id="age" type="text"  class="bg-white mt-1 block w-full"
                            wire:model="age" />
                                <x-jet-input-error for="age" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-6 mt-2">
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="school" value="Pendidikan Terakhir" />
                                <select wire:model="origin" id="origin" name="origin"
                                    class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="">PILIH PENDIDIKAN</option>
                                    <option value="TS">TIDAK SEKOLAH</option>
                                    <option value="SD">SEKOLAH DASAR</option>
                                    <option value="SMP">SMP / SEDERAJAT</option>
                                    <option value="SMA">SMA / SEDERAJAT</option>
                                    <option value="D3">DIPLOMA 3</option>
                                    <option value="D4">DIPLOMA 4</option>
                                    <option value="S1">STRATA 1</option>
                                    <option value="S2">STRATA 2</option>
                                    <option value="S3">STRATA 3</option>
                                </select>
                                <x-jet-input-error for="school" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="education" value="Jurusan" />
                                <x-jet-input id="education"  type="text"
                                    class="bg-white mt-1 block w-full" wire:model="education" />
                                <x-jet-input-error for="education" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <x-jet-label for="work" value="Pekerjaan" />
                            <x-jet-input id="work" type="text"  class="bg-white mt-1 block w-full"
                            wire:model="work" />
                            <x-jet-input-error for="work" class="mt-2" />
                        </div>

                        @endif
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <div class="col-span-6 sm:col-span-6 mt-2 mb-10">
                            <div class="col-span-6 sm:col-span-3">
                                <div id="my_camera"></div>
                                <button class="mt-5  btn w-full bg-blue-500 hover:bg-blue-600 text-white" onClick="take_snapshot()">
                                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                        <path
                                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                    </svg>
                                    <span class=" ml-2">AMBIL GAMBAR </span>
                                </button>
                            </div>
            
                            {{-- <form enctype="multipart/form-data"> --}}
            
                            <input type="hidden" name="image" class="image-tag">
            
                            <div class="col-span-6 sm:col-span-3">
                                @if ($image)
                                    <img src="{{ $image }}" width="100%" height="100%" alt="Gambar"
                                        class="rounded-md" />
                                @else
                                    <div id="results" class="w-full">Your captured image will appear here...</div>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>

            <div class="grid grid-cols-6 gap-6">
                




            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    @if ($button_enable)
                        <button wire:click.prevent="store" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent
                         px-4 py-2 bg-green-700 text-base leading-6 font-medium text-white shadow-sm
                          hover:bg-green-500 focus:outline-none focus:border-green-700 
                          focus:shadow-outline-green transition ease-in-out duration-150
                           sm:text-sm sm:leading-5">
                            {{ $display_check }}
                        </button>
                    @else
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent
                         px-4 py-2 text-base leading-6 font-medium text-black shadow-sm
                          hover:bg-red-500 focus:outline-none focus:border-red-700 
                          focus:shadow-outline-green transition ease-in-out duration-150
                           sm:text-sm sm:leading-5 {{ $button_enable ? 'bg-green-700' : 'bg-red-400' }}}}"
                            >
                            {{ $display_check }}
                        </button>
                    @endif

                </span>
                {{-- </form> --}}

                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                    <button type="button" wire:click.prevent="refresh"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        REFRESH
                    </button>
                </span>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script language="JavaScript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
        Webcam.set({


            height: 350,

            image_format: 'jpeg',

            jpeg_quality: 90

        });



        Webcam.attach('#my_camera');



        function take_snapshot() {

            Webcam.snap(function(data_uri) {

                $(".image-tag").val(data_uri);
                // how to push model livewire


                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';

                window.livewire.emit('imageUpload', data_uri);


            });

        }
    </script>
@endpush
