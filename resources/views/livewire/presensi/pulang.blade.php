<div class="md:col-span-1">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Presensi Pulang
        </h3>
        <p class="mt-1 text-sm text-gray-600">Diisi ketika pulang</p>
    </div>
</div>
<div class="mt-5 md:col-span-2 md:mt-0">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-3">
                    <label for="tanggal" class="block font-medium text-gray-700">Tanggal</label>
                    <input type="text" name="tanggal" wire:model.defer="tanggal" disabled
                        class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div class="col-span-3">
                    <label for="jam" class="block font-medium text-gray-700">Jam Pulang</label>
                    <input type="text" name="jam" wire:model.defer="jam" disabled
                        class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div class="col-span-3">
                    <label for="nama" class="block font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" wire:model.defer="nama" disabled
                        class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                <div class="col-span-3">
                    <label for="unit" class="block font-medium text-gray-700">Unit Kerja</label>
                    <input type="text" name="unit" wire:model.defer="unit" disabled
                        class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                {{-- @if (strtotime($form['waktu']) < strtotime(date('Y-m-d ' . $jam_kerja[$jam_kerja_id]['selesai']))) --}}
                @php
                    $ps = new App\Services\PresensiService($jam_kerja_id);
                @endphp
                @if (
                    $ps->isJamKerjaAktif($jam_kerja[$jam_kerja_id]) or
                        $ps->isTerlambat('pulang', $form['waktu'], $jam_kerja[$jam_kerja_id]))
                    <div class="col-span-3">
                        <label for="kode" class="block font-medium text-gray-700">Kode Unik <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="kode_pulang" wire:model.defer="kode_pulang" required
                            placeholder="Hubungi Admin untuk mendapatkan Kode"
                            class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('kode_pulang')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="lokasi" class="block font-medium text-gray-700">Keterangan <span
                                class="text-red-600">*</span></label>
                        <textarea wire:model.defer="form.keterangan" rows="5" placeholder="Keterangan pulang Awal / Terlambat" required
                            class="block w-full rounded-md border border-gray-300 p-2 focus:ring-indigo-500"></textarea>
                        @error('form.keterangan')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="col-span-6">
                    <label for="lokasi" class="block font-medium text-gray-700">Lokasi</label>
                    @if ($isLoadingGPS)
                        <img src="{{ asset('loader.gif') }}" alt="loading ...">
                    @endif
                    @if ($isOutOfRange)
                        <div class="flex flex-row content-center rounded rounded bg-red-200 p-2 text-red-700">
                            <div class="mr-3">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                Posisi Anda diluar batas yang telah ditentukan
                            </div>
                        </div>
                    @endif

                    @if ($isLocationCheckPassed)
                        <div class="rounded bg-green-200 p-2 text-green-700">
                            <font-awesome-icon icon="check" />
                            OK
                            {{-- <span v-if="this.isIPAllowed">
                            <font-awesome-icon icon="check" />
                            OK
                        </span> --}}
                        </div>
                    @endif
                </div>

                <!-- Camera Start -->
                <div class="col-span-6">
                    <label for="foto" class="block font-medium text-gray-700">Foto</label>
                    <div class="flex flex-col content-center justify-center">
                        <video autoplay="true" id="box-wajah" style="width: 225px; height: 300px"
                            class="mx-auto hidden"></video>
                        <canvas id="cnv-wajah" style="display: none"></canvas>

                        @if ($isFaceCheckPassed)
                            <img src="{{ $foto }}" style="width: 225px; height: 300px" class="mx-auto"
                                id="wajah" />
                            <div class="rounded bg-green-200 p-2 text-green-700">
                                <i class="fa fa-check"></i>
                                OK
                            </div>
                        @endif

                        @if ($isFaceCheckProcessing)
                            <div class="rounded bg-orange-200 p-2 text-orange-700">
                                <i class="fa fa-hourglass"></i>
                                Sedang melakukan verifikasi ...
                            </div>
                        @endif

                        @if ($isFaceCheckError)
                            <div class="flex flex-row content-center rounded bg-red-700 p-2 text-white">
                                <div class="mr-3">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    {{ $faceCheckErrorMessage }}
                                </div>
                            </div>
                        @endif

                        <div class="mx-auto py-2">
                            <button id="kmr-wajah"
                                class="inline-flex justify-center rounded border border-transparent bg-orange-500 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                onclick="bukaKamera()" type="button">
                                <i class="fa fa-camera"></i>
                            </button>
                            <button id="sav-wajah" type="button"
                                class="inline-flex hidden justify-center rounded border border-transparent bg-green-500 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                onclick="simpan(225, 300)">
                                <i class="fa fa-bolt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Camera End -->
            </div>
            @if (strtotime($form['waktu']) < strtotime(date('Y-m-d ' . $jam_kerja[$jam_kerja_id]['selesai'])))
                <span class="text-xs text-red-600">*: Harus diisi jika Pulang lebih awal.</span>
            @endif
        </div>
        <div class="px-4 py-3 sm:px-6">
            <button wire:click.prevent="store()" type="button"
                style="@if ($isAllCheckPassed) {{ '' }} @else {{ 'display:none;' }} @endif"
                class="mx-auto block rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mr-0">
                SIMPAN
            </button>
            <button style="@if (!$isAllCheckPassed) {{ '' }} @else {{ 'display:none;' }} @endif"
                type="button" disabled="disabled"
                class="mx-auto block cursor-not-allowed rounded-md border border-transparent bg-gray-600 px-4 py-2 text-sm font-medium text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mr-0">
                SIMPAN
            </button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        getLocation();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(checkCoord)
            } else {
                console.error('Fitur Geolocation tidak didukung oleh browser.');
            }
        }

        function checkCoord(position) {
            @this.call('checkCoord', [position.coords.latitude, position.coords.longitude])
        }

        function bukaKamera() {
            isCameraOn()
            const video = document.querySelector('#box-wajah')

            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices
                    .getUserMedia({
                        video: true
                    })
                    .then(function(stream) {
                        video.srcObject = stream
                    })
                    .catch(function(err) {
                        console.log('Error: ' + err)
                    })
            }
        }

        function simpan(w, h) {
            const video = document.querySelector('#box-wajah')
            const canvas = document.querySelector('#cnv-wajah')
            const context = canvas.getContext('2d')
            if (w && h) {
                canvas.width = w
                canvas.height = h
                context.drawImage(video, 0, 0, w, h)
                @this.call('verifikasiWajah', canvas.toDataURL('image/jpeg'))
            }
        }
    </script>
@endpush
