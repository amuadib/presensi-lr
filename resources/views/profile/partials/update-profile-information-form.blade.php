<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="foto" :value="__('Photo')" />
            @if (!$user->isAdmin() && $user->authable->isPhotoLocked())
                <div class="mb-2 w-full">
                    <div class="mb-2">
                        <div>
                            <img id="wajah" class="mx-auto border border-gray-300 p-2"
                                src="{{ url('/wajah/' . ($user->authable->foto ?? 'not-found.jpg')) }}" />
                            <div class="-mt-9 text-red-500 text-center">Foto tidak bisa
                                diubah
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('profile.partials.foto', ['user_id' => $user->id])
                @include('profile.partials.foto_lib')
                <x-input-error class="mt-2" :messages="$errors->get('foto')" />
            @endif
        </div>
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full" :value="old('nik', $user->authable->nik)"
                required autocomplete="nik" />
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>
        <div>
            <x-input-label for="nama" :value="__('Name')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->authable->nama)"
                required autocomplete="nama" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>
        <div class="flex">
            <div class="lg:mr-3">
                <x-input-label for="tempat_lahir" :value="__('Place of Birth')" />
                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 w-full" :value="old('tempat_lahir', $user->authable->tempat_lahir)"
                    autocomplete="tempat_lahir" />
                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
            </div>
            <div>
                <x-input-label for="tanggal_lahir" :value="__('Date of Birth')" />
                <x-text-input id="tanggal_lahir" name="tanggal_lahir" class="date mt-1 w-full" type="text"
                    :value="old('tanggal_lahir', $user->authable->tanggal_lahir)" autocomplete="tanggal_lahir" />
                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
            </div>
        </div>
        <div>
            <x-input-label for="jenis_kelamin_l" :value="__('Gender')" />
            <div class="flex justify-start">
                <div class="w-32 mr-2 form-check form-check-inline">
                    <label class="inline-block text-gray-800 form-check-label cursor-pointer" for="jenis_kelamin_l">
                        <input
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-full appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none"
                            type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="l"
                            @if ($user->authable->jenis_kelamin == 'l') checked @endif>Laki-laki</label>
                </div>
                <div class="w-32 mr-2 form-check form-check-inline">
                    <label class="inline-block text-gray-800 form-check-label cursor-pointer" for="jenis_kelamin_p">
                        <input
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-full appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none"
                            type="radio" name="jenis_kelamin" value="p" id="jenis_kelamin_p"
                            @if ($user->authable->jenis_kelamin == 'p') checked @endif>Perempuan</label>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
        </div>
        <div>
            <x-input-label for="alamat" :value="__('Address')" />
            <textarea name="alamat"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                id="alamat" cols="30" rows="3">{{ old('hp', $user->authable->alamat) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>
        <div>
            <x-input-label for="status" :value="__('Civilian Status')" />

            <div class="flex justify-start">
                @foreach (config('custom.status_sipil') as $k => $v)
                    <div class="mr-2 form-check form-check-inline">
                        <label class="inline-block text-gray-800 form-check-label cursor-pointer"
                            for="status_{{ $k }}">
                            <input
                                class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-full appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none"
                                type="radio" name="status" id="status_{{ $k }}"
                                value="{{ $k }}"
                                @if ($user->authable->status == $k) checked @endif>{{ $v }}</label>
                    </div>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
        <div>
            <x-input-label for="hp" :value="__('Phone Number')" />
            <x-text-input id="hp" name="hp" type="text" class="mt-1 block w-full" :value="old('hp', $user->authable->hp)"
                autocomplete="hp" />
            <x-input-error class="mt-2" :messages="$errors->get('hp')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->authable->email)"
                autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/datepicker.js') }}"></script>
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
        })
    </script>
@endpush
