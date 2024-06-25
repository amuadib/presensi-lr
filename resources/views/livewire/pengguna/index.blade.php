<div>
    @if ($mode == '')
        <div class="m-auto my-3 shadow-lg md:my-8 md:w-5/6">
            <div class="relative mb-6 flex w-full min-w-0 flex-col break-words rounded bg-white">
                <div class="mb-0 rounded-t border-0 px-4 py-3">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex-1 flex-grow px-4">
                            <h3 class="text-2xl font-semibold text-gray-800">Pengguna</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-1 flex-grow px-4 text-right">
                            @can('Admin')
                                <select wire:model="unit_id" name="unit_id"
                                    class="rounded bg-white px-2 py-1 text-gray-700 placeholder-gray-400 shadow transition-all duration-150 ease-linear focus:border-blue-300 focus:outline-none focus:ring">
                                    <option value='0'>-- Semua --</option>
                                    @foreach ($unit_kerja as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            @endcan
                            <button type="button" wire:click="create()"
                                class="mb-1 mr-1 cursor-pointer rounded bg-indigo-500 px-3 py-1 text-xs font-bold uppercase text-white outline-none transition-all duration-150 ease-linear hover:bg-indigo-600 focus:outline-none active:bg-indigo-600">
                                TAMBAH
                            </button>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="w-full border-collapse items-center bg-transparent">
                        <thead>
                            <tr>
                                <td
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    No
                                </td>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Nama
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    &nbsp;
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Alamat
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    HP
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Unit Kerja
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Jabatan
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Jam Kerja
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Kode pulang
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Aktif
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                    Foto
                                </th>
                                <th
                                    class="whitespace-no-wrap border border-l-0 border-r-0 border-solid border-gray-200 bg-gray-100 px-6 py-3 text-left align-middle text-sm font-semibold uppercase text-gray-600">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data->count())
                                <tr>
                                    <td colspan="4"
                                        class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-center align-middle text-sm">
                                        Belum ada data
                                    </td>
                                </tr>
                            @else
                                @php
                                    $c = 1;
                                @endphp
                                @foreach ($data as $u)
                                    <tr>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            {{ $c }}
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm font-bold">
                                            {{ $u->authable->nama }}
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            <div class="relative mr-3 h-8 w-8 md:block">
                                                <img class="h-full w-full object-cover"
                                                    src="{{ url('/wajah/' . $u->authable->foto) }}"
                                                    alt="Foto {{ $u->authable->nama }}" />
                                                <div class="absolute inset-0 shadow-inner" aria-hidden="true">
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            {{ $u->authable->alamat }}
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            {{ $u->authable->hp }}
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                {{ $u->authable->unit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                {{ $u->authable->jabatan }}
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                {!! formatJamKerja($u->authable->pembagian) !!}
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->kode_pulang != '')
                                                    {{ $u->authable->kode_pulang }}
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="getKodePulang({{ $u->id }},'n')"
                                                        class="inline-flex items-center rounded border border-transparent bg-green-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-magic"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->aktif == 'y')
                                                    <button type="button"
                                                        wire:click.prevent="setAktif({{ $u->id }},'n')"
                                                        class="inline-flex items-center rounded border border-transparent bg-green-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="setAktif({{ $u->id }},'y')"
                                                        class="inline-flex items-center rounded border border-transparent bg-red-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-ban"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-l-0 border-r-0 border-t-0 p-4 px-6 text-left align-middle text-sm">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->kunci_foto == 'n')
                                                    <button type="button"
                                                        wire:click.prevent="setKunci({{ $u->id }},'y')"
                                                        class="inline-flex items-center rounded border border-transparent bg-green-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-unlock"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="setKunci({{ $u->id }},'n')"
                                                        class="inline-flex items-center rounded border border-transparent bg-red-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-lock"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="whitespace-no-wrap flex flex-row space-x-1 border-l-0 border-r-0 border-t-0 p-4 px-6 align-middle text-sm">
                                            @can('Admin')
                                                @if ($u->id == $user->id or !$u->isAdmin())
                                                    <button type="button" title="Edit"
                                                        wire:click.prevent="edit({{ $u->id }})"
                                                        class="inline-flex items-center rounded border border-transparent bg-yellow-400 px-1 text-xs font-medium text-gray-700 shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" title="Ganti Password"
                                                        wire:click.prevent="editPassword({{ $u->id }})"
                                                        class="inline-flex items-center rounded border border-transparent bg-green-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                        <i class="fa fa-key"></i>
                                                    </button>
                                                    @if ($u->id != $user->id)
                                                        <a href="{{ url('/loginas/' . $u->id) }}"
                                                            title="Login sebagai {{ $u->authable->nama }}"
                                                            class="inline-flex items-center rounded border border-transparent bg-blue-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                            <i class="fa fa-sign-in-alt"></i>
                                                        </a>
                                                        <button type="button" title="Hapus"
                                                            wire:click="$emit('confirmDelete', {{ $u->id }})"
                                                            class="inline-flex items-center rounded border border-transparent bg-red-600 px-1 text-xs font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-2 md:px-2 md:py-1">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                    @php
                                        $c++;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @elseif($mode == 'change')
        @include('livewire.pengguna.password')
    @else
        @include('livewire.pengguna.form')
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('confirmDelete', dataId => {
                if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
                    @this.call('destroy', dataId)
                }
            });
        });
    </script>
    @include('profile.partials.foto_lib')
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endpush
