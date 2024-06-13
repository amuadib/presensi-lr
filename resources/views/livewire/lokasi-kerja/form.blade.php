<div class="md:w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                        Lokasi
                    </h3>
                    @if ($mode == 'create')
                        <p class="mt-1 text-sm text-gray-600">Tambah Lokasi baru</p>
                    @else
                        <p class="mt-1 text-sm text-gray-600">Edit Lokasi</p>
                    @endif
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST" @submit.prevent="onSubmit">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="nama" class="block font-medium text-gray-700">Nama</label>
                                    <input type="text" name="nama" wire:model.defer="form.nama" required autofocus
                                        placeholder="Masukkan nama lokasi"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('form.nama')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lat" class="block font-medium text-gray-700">Titik Koordinat
                                        <button type="button" wire:click.prevent="$emit('getLocation')"
                                            class="inline-flex justify-center px-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Gunakan koordinat perangkat
                                        </button></label>
                                    <input type="text" name="lat" wire:model.defer="form.lat" required
                                        placeholder="Garis lintang / latitude"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('form.lat')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lon" class="hidden md:block font-medium text-white">Lon</label>
                                    <input type="text" name="lon" wire:model.defer="form.lon" required
                                        placeholder="Garis bujur / longitude"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('form.lon')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="radius" class="block font-medium text-gray-700">Radius (meter)</label>
                                    <input type="text" name="radius" wire:model.defer="form.radius" required
                                        placeholder="Jarak maksimum dari titik koordinat"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('form.radius')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button wire:click.prevent="$set('mode', '')"
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
                </form>
            </div>
        </div>
    </div>
</div>
