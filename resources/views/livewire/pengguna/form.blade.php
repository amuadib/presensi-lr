<div class="m-auto my-8 md:w-5/6">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-2xl text-lg font-medium leading-6 text-gray-900">
                        @if ($mode == 'create')
                            Pengguna
                        @else
                            Pengguna > {{ $pengguna->nama }}
                        @endif
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        @if ($mode == 'create')
                            Tambah Pengguna
                        @else
                            Update Data
                        @endif
                    </p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="nik"
                                    class="block font-medium text-gray-700">{{ __('Photo') }}</label>
                                @include('profile.partials.foto', ['user_id' => $updated_id])
                                <input type="hidden" wire:model="pengguna.foto">
                                @error('pengguna.foto')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="nik" class="block font-medium text-gray-700">NIK</label>
                                <input type="text" id="nik" wire:model.defer="pengguna.nik" autofocus
                                    placeholder="NIK"
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.nik')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="nama"
                                    class="block font-medium text-gray-700">{{ __('Name') }}</label>
                                <input type="text" id="nama" wire:model.defer="pengguna.nama" required
                                    placeholder="Nama Lengkap"
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.nama')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-3">
                                <label for="tempat_lahir"
                                    class="block font-medium text-gray-700">{{ __('Place of Birth') }}</label>
                                <input type="text" id="tempat_lahir" wire:model.defer="pengguna.tempat_lahir"
                                    placeholder="{{ __('Place of Birth') }}"
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.tempat_lahir')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3" wire:ignore>
                                <label for="tanggal_lahir"
                                    class="block font-medium text-gray-700">{{ __('Date of Birth') }}</label>
                                <input type="text" id="tanggal_lahir" wire:model.defer="pengguna.tanggal_lahir"
                                    placeholder="{{ __('Date of Birth') }}"
                                    class="date w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.tanggal_lahir')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="jenis_kelamin"
                                    class="block font-medium text-gray-700">{{ __('Gender') }}</label>
                                <div class="flex">
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="jenis_kelamin_l">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="l"
                                                wire:model.defer="pengguna.jenis_kelamin"
                                                @if (isset($pengguna['jenis_kelamin']) and $pengguna['jenis_kelamin'] == 'l') checked @endif>Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="jenis_kelamin_p">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="jenis_kelamin" value="p" id="jenis_kelamin_p"
                                                wire:model.defer="pengguna.jenis_kelamin"
                                                @if (isset($pengguna['jenis_kelamin']) and $pengguna['jenis_kelamin'] == 'p') checked @endif>Perempuan</label>
                                    </div>
                                </div>
                                @error('pengguna.jenis_kelamin')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="alamat"
                                    class="block font-medium text-gray-700">{{ __('Address') }}</label>
                                <textarea id="alamat" wire:model.defer="pengguna.alamat" placeholder="{{ __('Address') }}" rows="3"
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring"></textarea>
                                @error('pengguna.alamat')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="status"
                                    class="block font-medium text-gray-700">{{ __('Status') }}</label>
                                <div class="flex">
                                    @foreach ($status as $k => $v)
                                        <div class="form-check form-check-inline mr-2">
                                            <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                                for="status_{{ $k }}">
                                                <input
                                                    class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                    type="radio" name="status" id="status_{{ $k }}"
                                                    wire:model.defer="pengguna.status"
                                                    value="{{ $k }}">{{ $v }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('pengguna.status')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="email"
                                    class="block font-medium text-gray-700">{{ __('Email') }}</label>
                                <input type="email" id="email" wire:model.defer="pengguna.email"
                                    placeholder="{{ __('Email') }}"
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.email')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="hp"
                                    class="block font-medium text-gray-700">{{ __('Phone Number') }}@if ($mode == 'create')
                                        *
                                    @endif
                                </label>
                                <input type="text" id="hp" wire:model.defer="pengguna.hp"
                                    placeholder="{{ __('Phone Number') }}" required
                                    class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                @error('pengguna.hp')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="jenis_akun"
                                    class="block font-medium text-gray-700">{{ __('Account Type') }}</label>
                                <div class="flex">
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="jenis_akun_a">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="jenis_akun" id="jenis_akun_a" value="a"
                                                wire:model="pengguna.jenis_akun">Administrator</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="jenis_akun_p">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="jenis_akun" id="jenis_akun_p" value="p"
                                                wire:model="pengguna.jenis_akun">Petugas</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="jenis_akun_b">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="jenis_akun" value="b" id="jenis_akun_b"
                                                wire:model="pengguna.jenis_akun">Anggota biasa</label>
                                    </div>
                                </div>
                                @error('pengguna.jenis_akun')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if (!isset($pengguna['jenis_akun']) or isset($pengguna['jenis_akun']) and $pengguna['jenis_akun'] != 'a')
                        <div class="bg-white px-4 py-2 sm:px-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="unit_kerja_id"
                                        class="block font-medium text-gray-700">{{ __('Department') }}</label>
                                    <select
                                        class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring"
                                        wire:model.defer="pengguna.unit_kerja_id">
                                        <option value="0">
                                            -- {{ __('Department') }} --
                                        </option>
                                        @foreach ($unit_kerja as $u)
                                            <option value="{{ $u->id }}">
                                                {{ $u->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengguna.unit_kerja_id')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!isset($pengguna['jenis_akun']) or isset($pengguna['jenis_akun']) and $pengguna['jenis_akun'] == 'b')
                        <div class="bg-white px-4 py-2 sm:px-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="jabatan"
                                        class="block font-medium text-gray-700">{{ __('Position') }}</label>
                                    <input type="text" id="jabatan" wire:model.defer="pengguna.jabatan" required
                                        placeholder="Jabatan"
                                        class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring" />
                                    @error('pengguna.jabatan')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 py-2 sm:px-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="jam_kerja_id"
                                        class="block font-medium text-gray-700">{{ __('Working Time') }}</label>
                                    @foreach ($jam_kerja as $j)
                                        <div class="form-check form-check-inline mr-2">
                                            <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                                for="jam_kerja_id_{{ $j->id }}">
                                                <input
                                                    class="rounded-m form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                    type="checkbox" name="jam_kerja_id"
                                                    id="jam_kerja_id_{{ $j->id }}"
                                                    value="{{ $j->id }}"
                                                    wire:model="jam_kerja_id.{{ $j->id }}">{{ $j->nama }}</label>
                                        </div>
                                    @endforeach
                                    @error('jam_kerja_id')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 py-2 sm:px-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="lokasi_id"
                                        class="block font-medium text-gray-700">{{ __('Location') }}</label>
                                    <select
                                        class="w-full rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring"
                                        wire:model.defer="pengguna.lokasi_id">
                                        <option value="0">
                                            -- {{ __('Location') }} --
                                        </option>
                                        @foreach ($lokasi as $u)
                                            <option value="{{ $u->id }}">
                                                {{ $u->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengguna.lokasi_id')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white px-4 py-2 sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="aktif"
                                    class="block font-medium text-gray-700">{{ __('Account Status') }}</label>
                                <div class="flex">
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="aktif_y">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="aktif" id="aktif_y" value="y"
                                                wire:model.defer="pengguna.aktif"
                                                @if (isset($pengguna['aktif']) and $pengguna['aktif'] == 'y') checked @endif>Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="aktif_n">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="aktif" value="n" id="aktif_n"
                                                wire:model.defer="pengguna.aktif"
                                                @if (isset($pengguna['aktif']) and $pengguna['aktif'] == 'n') checked @endif>Non-Aktif</label>
                                    </div>
                                </div>
                                @error('pengguna.aktif')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="bisa_membuat_kode" class="block font-medium text-gray-700">Pengguna bisa
                                    membuat kode?</label>
                                <div class="flex">
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="bisa_membuat_kode_y">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="bisa_membuat_kode" id="bisa_membuat_kode_y"
                                                value="y" wire:model.defer="pengguna.bisa_membuat_kode"
                                                @if (isset($pengguna['bisa_membuat_kode']) and $pengguna['bisa_membuat_kode'] == 'y') checked @endif>Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-2 w-32">
                                        <label class="form-check-label inline-block cursor-pointer text-gray-800"
                                            for="bisa_membuat_kode_n">
                                            <input
                                                class="form-check-input float-left mr-2 mt-1 h-4 w-4 cursor-pointer appearance-none rounded-full border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                                type="radio" name="bisa_membuat_kode" value="n"
                                                id="bisa_membuat_kode_n" wire:model.defer="pengguna.bisa_membuat_kode"
                                                @if (isset($pengguna['bisa_membuat_kode']) and $pengguna['bisa_membuat_kode'] == 'n') checked @endif>Tidak</label>
                                    </div>
                                </div>
                                @error('pengguna.bisa_membuat_kode')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        @if ($mode == 'create')
                            <small class="text-gray-600">*: {{ __('Phone Number') }} akan digunakan sebagai Username
                                dan
                                Password</small>
                        @endif
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button wire:click.prevent="$set('mode', '')" type="button"
                            class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 px-3 py-1 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Batal
                        </button>
                        @if ($mode == 'create')
                            <button type="button" wire:click.prevent="store()"
                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-3 py-1 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Simpan
                            </button>
                        @else
                            <button type="button" wire:click.prevent="update()"
                                class="inline-flex justify-center rounded-md border border-transparent bg-yellow-400 px-3 py-1 text-sm font-medium text-gray-700 shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Update
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var user_id = "{{ $updated_id }}"
    </script>
    <script>
        $(document).ready(function() {
            $(".date").datepicker({
                format: "yyyy-mm-dd",
                autoHide: true,
                daysMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sa'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                    'Des'
                ]
            });

            $('#tanggal_lahir').on('change', function(e) {
                @this.set('pengguna.tanggal_lahir', e.target.value);
            });
        })
    </script>
</div>
