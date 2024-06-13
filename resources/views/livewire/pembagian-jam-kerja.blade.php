{{-- <div class="md:w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                        Pembagian
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Pengaturan pembagian jam kerja
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="radius" class="block font-medium text-gray-700">Unit Kerja</label>
                                <select wire:change="updateList('u')" placeholder="Pilih unit kerja"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded-t-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150">
                                    @foreach ($unit_kerja as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="p-2 text-gray-600 rounded-b-md border border-t-0 border-gray-300 h-64 overflow-y-auto overflow-x-hidden">
                                    <div wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    @if ($data->count())
                                        @foreach ($data as $d)
                                            <div class="grid grid-cols-6 leading-none p-1 hover:bg-gray-200">
                                                <div class="col-span-5">
                                                    {{ $d->nama }}
                                                </div>
                                                <div class="col-span-1">
                                                    <button wire:click="pindah(1, {{ $u->id }})" type="button"
                                                        class="py-1 px-2 border border-transparent shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        ...
                                    @endif
                                </div>
                                <div class="flex justify-center">
                                    <button wire:click="pindah(1)" type="button"
                                        class="mt-2 inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        SEMUA &nbsp;
                                        <i class="fa fa-arrow-right text-xl"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="grid grid-cols-6 gap1">
                                    <div class="col-span-3">
                                        <label for="radius" class="block font-medium text-gray-700">Jam
                                            Kerja</label>
                                        <select wire:change="updateList('j')" placeholder="Pilih jam kerja"
                                            class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded-tl-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150">
                                            @foreach ($jam_kerja as $j)
                                                <option value="{{ $j->id }}">
                                                    {{ $j->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-3">
                                        <label for="radius" class="block font-medium text-gray-700">Lokasi</label>
                                        <select wire:change="updateList('l')" placeholder="Pilih lokasi"
                                            class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded-tr-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150">
                                            @foreach ($lokasi as $l)
                                                <option value="{{ $l->id }}">
                                                    {{ $l->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div
                                    class="p-2 text-gray-600 rounded-b-md border border-t-0 border-gray-300 h-64 overflow-y-auto overflow-x-hidden">
                                    <div wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    @if ($anggota->count())
                                        @foreach ($anggota as $a)
                                            <div class="grid grid-cols-6 leading-none p-1 hover:bg-gray-200">
                                                <div class="col-span-1">
                                                    <button wire:click="pindah(2, {{ $a->id }})" type="button"
                                                        class="py-1 px-2 border border-transparent shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-arrow-left"></i>
                                                    </button>
                                                </div>
                                                <div class="col-span-5">
                                                    {{ $a->nama }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        ...
                                    @endif
                                </div>
                                <div class="flex justify-center">
                                    <button wire:click="pindah(2)" type="button"
                                        class="mt-2 inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium text-white bg-red-600 hover:shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fa fa-arrow-left text-xl"></i>
                                        &nbsp; SEMUA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
