<div class="md:w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                        Pengguna > {{ $pengguna->nama }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Ganti Password</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-2 bg-white sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="password"
                                    class="block font-medium text-gray-700">{{ __('New Password') }}</label>
                                <input type="password" id="password" wire:model.defer="password" autofocus
                                    placeholder="{{ __('New Password') }}"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                @error('password')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-white sm:px-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="password_confirmation"
                                    class="block font-medium text-gray-700">{{ __('New Password Confirmation') }}</label>
                                <input type="password" id="password_confirmation"
                                    wire:model.defer="password_confirmation"
                                    placeholder="{{ __('New Password Confirmation') }}"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 w-full ease-linear transition-all duration-150" />
                                @error('password_confirmation')
                                    <small class="text-red-800">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button wire:click.prevent="$set('mode', '')" type="button"
                            class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </button>
                        <button type="button" wire:click.prevent="updatePassword()"
                            class="inline-flex justify-center py-1 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
