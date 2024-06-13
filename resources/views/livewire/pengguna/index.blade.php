<div>
    @if ($mode == '')
        <div class="md:w-5/6 m-auto my-3 md:my-8 shadow-lg">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-gray-800 text-2xl">Pengguna</h3>
                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                            @can('Admin')
                                <select wire:model="unit_id" name="unit_id"
                                    class="px-2 py-1 placeholder-gray-400 text-gray-700 bg-white rounded shadow focus:outline-none focus:ring focus:border-blue-300 ease-linear transition-all duration-150">
                                    <option value='0'>-- Semua --</option>
                                    @foreach ($unit_kerja as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            @endcan
                            <button type="button" wire:click="create()"
                                class="cursor-pointer bg-indigo-500 text-white active:bg-indigo-600 hover:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                TAMBAH
                            </button>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <td
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    No
                                </td>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Nama
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    &nbsp;
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Alamat
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    HP
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Unit Kerja
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Jabatan
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Jam Kerja
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Kode pulang
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Aktif
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Foto
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data->count())
                                <tr>
                                    <td colspan="4"
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-center">
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
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            {{ $c }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left font-bold">
                                            {{ $u->authable->nama }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            <div
                                                class="
                      relative
                      w-8
                      h-8
                      mr-3
                      md:block
                    ">
                                                <img class="object-cover w-full h-full"
                                                    src="{{ url('/wajah/' . $u->authable->foto) }}"
                                                    alt="Foto {{ $u->authable->nama }}" />
                                                <div class="absolute inset-0 shadow-inner" aria-hidden="true">
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            {{ $u->authable->alamat }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            {{ $u->authable->hp }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                {{ $u->authable->unit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                {{ $u->authable->jabatan }}
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                {!! formatJamKerja($u->authable->pembagian) !!}
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->kode_pulang != '')
                                                    {{ $u->authable->kode_pulang }}
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="getKodePulang({{ $u->id }},'n')"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-magic"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->aktif == 'y')
                                                    <button type="button"
                                                        wire:click.prevent="setAktif({{ $u->id }},'n')"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="setAktif({{ $u->id }},'y')"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-ban"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            @if ($u->hasUnitKerja())
                                                @if ($u->authable->kunci_foto == 'n')
                                                    <button type="button"
                                                        wire:click.prevent="setKunci({{ $u->id }},'y')"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-unlock"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="setKunci({{ $u->id }},'n')"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-lock"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 flex flex-row space-x-1">
                                            @can('Admin')
                                                @if ($u->id == $user->id or !$u->isAdmin())
                                                    <button type="button" title="Edit"
                                                        wire:click.prevent="edit({{ $u->id }})"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-gray-700 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" title="Ganti Password"
                                                        wire:click.prevent="editPassword({{ $u->id }})"
                                                        class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fa fa-key"></i>
                                                    </button>
                                                    @if ($u->id != $user->id)
                                                        <a href="{{ url('/loginas/' . $u->id) }}"
                                                            title="Login sebagai {{ $u->authable->nama }}"
                                                            class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                            <i class="fa fa-sign-in-alt"></i>
                                                        </a>
                                                        <button type="button" title="Hapus"
                                                            wire:click="$emit('confirmDelete', {{ $u->id }})"
                                                            class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
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
