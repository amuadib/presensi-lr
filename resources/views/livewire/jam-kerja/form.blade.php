<div class="md:w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                        Jam Kerja
                    </h3>
                    @if ($mode == 'create')
                        <p class="mt-1 text-sm text-gray-600">Tambah jam kerja baru</p>
                    @else
                        <p class="mt-1 text-sm text-gray-600">Edit jam kerja</p>
                    @endif
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="nama" class="block font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" wire:model.defer="form.nama" required autofocus
                                    autocomplete="off" placeholder="Masukkan nama jam kerja"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                @error('form.nama')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="singkatan" class="block font-medium text-gray-700">Singkatan</label>
                                <input type="text" name="singkatan" wire:model.defer="form.singkatan"
                                    autocomplete="off" placeholder="Singkatan"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                @error('form.singkatan')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="batas_mulai_presensi" class="block font-medium text-gray-700">Mulai
                                    absen sebelum jam masuk</label>
                                <div class="px-2 py-1 flex rounded shadow">
                                    <input type="text" wire:model.defer="form.batas_mulai_presensi" required
                                        autocomplete="off"
                                        class="focus:outline-none flex-1 block w-full rounded-none rounded-l-md placeholder-gray-400 text-gray-700 bg-white"
                                        placeholder="Mulai presensi datang" />
                                    <span class="inline-flex items-center px-3 text-gray-500">
                                        menit
                                    </span>
                                </div>
                                @error('form.batas_mulai_presensi')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="batas_akhir_presensi" class="block font-medium text-gray-700">Batas
                                    absen setelah jam pulang</label>
                                <div class="px-2 py-1 flex rounded shadow">
                                    <input type="text" wire:model.defer="form.batas_akhir_presensi" required
                                        autocomplete="off"
                                        class="focus:outline-none flex-1 block w-full rounded-none rounded-l-md placeholder-gray-400 text-gray-700 bg-white"
                                        placeholder="Batas presensi pulang" />
                                    <span class="inline-flex items-center px-3 text-gray-500">
                                        menit
                                    </span>
                                </div>
                                @error('form.batas_akhir_presensi')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-6">
                                <label for="hari" class="block font-medium text-gray-700">Jam kerja</label>
                                @error('form.jam')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                            @foreach ($hari_list as $k => $v)
                                <div class="col-span-6 grid grid-cols-5" wire:ignore>
                                    <label for=""
                                        class="font-medium text-gray-700 col-span-1">{{ $v }}</label>
                                    <div class="col-span-2">
                                        <input type="hidden" id="hari-{{ $k }}"
                                            wire:model="form.jam.{{ $k }}.hari"
                                            value="{{ $k }}" />
                                        <input type="text" id="datang-{{ $k }}"
                                            class="time px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 ease-linear transition-all duration-150"
                                            wire:model="form.jam.{{ $k }}.datang" />
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" id="pulang-{{ $k }}"
                                            class="time px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 ease-linear transition-all duration-150"
                                            wire:model="form.jam.{{ $k }}.pulang" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button wire:click="$set('mode', '')"
                            class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </button>
                        @if ($mode == 'create')
                            <button type="button" wire:click.prevent="store()"
                                class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        @else
                            <button type="button" wire:click.prevent="update()"
                                class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.time').clockTimePicker({
            precision: 5,
        })
        $('.time').on('change', function(e) {
            var id = $(this).attr('id').split('-');
            @this.set('form.jam.' + id[1] + '.' + id[0], e.target.value);
        });
    </script>
</div>
@push('styles')
    <style>
        .clock-timepicker {
            width: 100% !important;
        }
    </style>
@endpush
