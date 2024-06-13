<div class="md:w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                        Setup Tunjangan
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Edit setup tunjangan</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST" wire:submit.prevent="store()">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="ontime" class="block font-medium text-gray-700 font-bold">On-time
                                        presensi Datang</label>
                                    <input type="text" id="ontime" wire:model.defer="tunjangan.ontime" required
                                        placeholder="Nilai tunjangan presensi datang"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('tunjangan.ontime')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="terlambat" class="block font-medium text-gray-700 font-bold">Terlambat
                                        presensi datang</label>
                                    <input type="text" id="terlambat" wire:model.defer="tunjangan.terlambat" required
                                        placeholder="Potongan tunjangan jika presensi terlambat"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('tunjangan.terlambat')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lupa" class="block font-medium text-gray-700 font-bold">Lupa
                                        presensi pulang</label>
                                    <input type="text" id="lupa" wire:model.defer="tunjangan.lupa" required
                                        placeholder="Potongan tunjangan jika lupa presensi pulang"
                                        class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                    @error('tunjangan.lupa')
                                        <small class="text-red-800">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a href="/"
                                class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-400 hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
