<div class="md:w-5/6 m-auto my-3 md:my-8 shadow-lg">
    <div
        class="
        relative
        flex flex-col
        min-w-0
        break-words
        bg-white
        w-full
        mb-6
        rounded
      ">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-gray-800 text-2xl">
                        {{ __('Attendance History') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto">
            @include('livewire.riwayat.paging')
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            #
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Nama
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Status
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Jam Kerja
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Lokasi Presensi
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Waktu
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                            Keterangan
                        </th>
                        <th
                            class="
                        px-2
                        bg-gray-100
                        text-gray-600
                        align-middle
                        border border-solid border-gray-200
                        py-3
                        text-sm
                        uppercase
                        border-l-0 border-r-0
                        whitespace-no-wrap
                        font-semibold
                        text-left
                      ">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$presensi->count())
                        <tr>
                            <td colspan="7"
                                class="
                            border-t-0
                            px-6
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            p-4
                            text-center
                          ">
                                Belum ada data
                            </td>
                        </tr>
                    @else
                        @foreach ($presensi as $p)
                            @php
                                $tgl = substr($p->waktu, 0, 10);
                                $jenis = $p->jenis == 'p' ? 'p' : 'd';
                            @endphp
                            <tr>
                                <td
                                    class="
                            border-t-0
                            py-1
                            px-2
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-left text-gray-700
                          ">
                                    {{ $p->id }}
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-left text-gray-700
                          ">
                                    {{ $p->absenable->nama ?? '?' }}
                                    {{-- ({{ $p->absenable_id }}) --}}
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-left text-gray-700
                          ">
                                    <div class="avatar">
                                        <div class="
relative
w-8
h-8
mr-3
md:block
">
                                            <img class="object-cover w-full h-full"
                                                src="{{ url('/wajah/' . $p->absenable->foto) }}/test:{{ $jenis }}:{{ $tgl }}"
                                                alt="Foto {{ $p->absenable->nama }}" />
                                            <div class="absolute inset-0 shadow-inner" aria-hidden="true">
                                            </div>
                                        </div>
                                        <img class="zoom"
                                            src="{{ url('/wajah/' . $p->absenable->foto) }}/test:{{ $jenis }}:{{ $tgl }}"
                                            alt="Foto {{ $p->absenable->nama }}" />
                                    </div>
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-xs
                          ">
                                    @if ($p->jenis == 'h')
                                        <span
                                            class="
                              bg-green-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">Hadir</span>
                                    @elseif($p->jenis == 'i')
                                        <span
                                            class="
                              bg-indigo-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">Izin</span>
                                    @elseif($p->jenis == 's')
                                        <span
                                            class="
                              bg-yellow-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">Sakit</span>
                                    @elseif($p->jenis == 't')
                                        <span
                                            class="
                              bg-red-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">Terlambat</span>
                                    @elseif($p->jenis == 'p')
                                        <span
                                            class="
                              border-gray-600 border
                              px-2
                              text-gray-600
                              rounded-md
                              text-medium
                              shadow-md
                              text-xs
                            ">Pulang</span>
                                    @elseif($p->jenis == 'c')
                                        <span
                                            class="
                              bg-blue-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">Cuti</span>
                                    @elseif($p->jenis == 'd')
                                        <span
                                            class="
                              bg-blue-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">SPPD</span>
                                    @else
                                        <span
                                            class="
                              bg-gray-500
                              px-2
                              text-white
                              rounded-md
                              text-medium
                              shadow
                              text-xs
                            ">
                                            {{ strtoupper($p->jenis) }}
                                        </span>
                                    @endif
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-gray-700
                          ">
                                    {{ $p->jam_kerja->singkatan }}
                                    {{-- ({{ $p->jam_id }}) --}}
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-gray-700
                          ">
                                    @if ($p->lat != '' && $p->lon != '')
                                        <div>
                                            <a href="https://www.google.com/maps/place/{{ $p->lat }},{{ $p->lon }}"
                                                target="_blank" class="px-2 mb-1 py-1 hover:bg-green-200 rounded">
                                                <i class="fa fa-map-marker-alt text-red-700"></i>
                                                <span class="hover:text-green-700 text-gray-800">Lokasi</span>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-gray-700
                          ">
                                    {{ $p->waktu }}
                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                            text-gray-700
                          ">
                                    {{ $p->keterangan }}
                                    @if ($p->jenis == 'd')
                                        <span>&nbsp;({{ $p->no_surat }})</span>
                                    @endif
                                    @if ($p->jenis == 's' and $p->lampiran != '')
                                        <a href="{{ url('lampiran/' . $p->lampiran) }}" target="_blank"
                                            class="underline text-blue-700 hover:text-blue-500">Surat
                                            Dokter</a>
                                    @endif

                                </td>
                                <td
                                    class="
                            border-t-0
                            p-1
                            align-middle
                            border-l-0 border-r-0
                            text-sm
                            whitespace-no-wrap
                          ">
                                    @can('Admin')
                                        <button type="button" wire:click="$emit('confirmDelete', {{ $p->id }})"
                                            class="
                              inline-flex
                              items-center
                              md:px-2
                              border border-transparent
                              rounded
                              shadow-sm
                              text-xs
                              font-medium
                              text-white
                              bg-red-600
                              hover:bg-red-700
                              focus:outline-none
                              focus:ring-1
                              focus:ring-offset-2
                              focus:ring-indigo-500
                            ">
                                            Delete
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @include('livewire.riwayat.paging')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('confirmDelete', dataId => {
                if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
                    @this.call('destroy', dataId)
                }
            });
        });
    </script>

    @push('styles')
        <style>
            .zoom {
                cursor: pointer;
                visibility: hidden;
                position: absolute;
                z-index: 1;
                width: auto;
                transform: translate(50px, -150px)
            }

            .avatar:hover .zoom {
                visibility: visible;
            }
        </style>
    @endpush
</div>
