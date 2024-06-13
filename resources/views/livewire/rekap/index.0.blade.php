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
        <div class="rounded-t mb-0 px-2 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-gray-800 text-2xl">
                        @if ($mode === '')
                            Rekap Presensi
                        @else
                            <a wire:click.prevent="$set('mode','')" href="/rekap"
                                class="text-indigo-500 hover:underline">Rekap Presensi</a>
                            &nbsp;&gt;&nbsp;{{ $detail['nama'] }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto px-2">
            <div class="bg-white py-3 flex flex-start border-t border-gray-200" wire:ignore>
                <input type="text" id="awal" wire:model.defer="awal"
                    class="date border border-gray-400 rounded-md py-1 px-2 mr-2" placeholder="Tanggal mulai" />
                <input type="text" id="akhir" wire:model.defer="akhir"
                    class="date border border-gray-400 rounded-md py-1 px-2 mr-2" placeholder="Tanggal selesai" />
            </div>
            @if ($mode == '')
                <table
                    class="
              items-center
              w-full
              bg-transparent
              border-collapse
              mb-4
              border border-solid border-gray-200 border-l-1
            ">
                    <thead>
                        <tr>
                            <th rowspan="3"
                                class="
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                No
                            </th>
                            <th rowspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Nama
                            </th>
                            <th colspan="8"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Hadir
                            </th>
                            <th colspan="7"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Pulang
                            </th>
                            <th rowspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Sakit
                            </th>
                            <th rowspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Izin
                            </th>
                            <th rowspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Cuti
                            </th>
                            <th rowspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                SPPD
                            </th>
                            <th rowspan="3" colspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Total
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" rowspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                On-Time
                            </th>
                            <th colspan="2" rowspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Terlambat
                            </th>
                            <th rowspan="2"
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                1-10</th>
                            <th rowspan="2"
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                11-30</th>
                            <th rowspan="2"
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                >30</th>
                            <th rowspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Jumlah
                            </th>
                            <th colspan="3"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Awal
                            </th>
                            <th rowspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                On-time
                            </th>
                            <th rowspan="2" colspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Lupa Presensi
                            </th>
                            <th rowspan="2"
                                class="
                    text-center
                    px-2
                    bg-gray-100
                    text-gray-600
                    align-middle
                    border border-solid border-gray-200
                    py-3
                    text-sm
                    uppercase
                    border-l-0 border-r-1
                    whitespace-no-wrap
                    font-semibold
                    text-left
                  ">
                                Jumlah
                            </th>
                        </tr>
                        <tr>
                            <th
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                1-10</th>
                            <th
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                11-30</th>
                            <th
                                class="
                            text-center
                            px-2
                            bg-gray-100
                            text-gray-600
                            align-middle
                            border border-solid border-gray-200
                            py-0
                            text-sm
                            uppercase
                            border-l-0 border-r-1
                            whitespace-no-wrap
                            font-semibold
                            text-left
                          ">
                                >30</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr wire:loading>
                            <td colspan="17"
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
                                loading ....
                            </td>
                        </tr> --}}
                        @if (count($rekap) < 1)
                            <tr>
                                <td colspan="23"
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
                            @php
                                $c = 1;
                            @endphp
                            @foreach ($rekap as $k => $r)
                                <tr>
                                    <td
                                        class="
                      border-t-0
                      py-1
                      px-2
                      align-middle
                      border-l-0
                      border-r-1
                      border
                      border-solid
                      border-gray-200
                      text-sm
                      whitespace-no-wrap
                      text-left text-gray-700
                    ">
                                        {{ $c++ }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border-r-1
                      border
                      border-solid
                      border-gray-200
                      text-sm
                      whitespace-no-wrap
                      text-left text-gray-700
                    ">
                                        <span wire:click.prevent="show({{ $k }})"
                                            class="cursor-pointer hover:underline">
                                            {{ $r['nama'] }}
                                        </span>
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['hadir'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['t_hadir'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['terlambat'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-red-700
                    ">
                                        {{ $r['t_terlambat'] }}
                                    </td>
                                    <td
                                        class="
                  border-t-0
                  p-1
                  align-middle
                  border-l-0
                  border
                  border-solid
                  border-gray-200
                  border-r-1
                  text-sm
                  whitespace-no-wrap
                  text-gray-700
                ">
                                        {{ $terlambat[$k]['t1'] ?? 0 }}
                                    </td>
                                    <td
                                        class="
                  border-t-0
                  p-1
                  align-middle
                  border-l-0
                  border
                  border-solid
                  border-gray-200
                  border-r-1
                  text-sm
                  whitespace-no-wrap
                  text-gray-700
                ">
                                        {{ $terlambat[$k]['t2'] ?? 0 }}
                                    </td>
                                    <td
                                        class="
                  border-t-0
                  p-1
                  align-middle
                  border-l-0
                  border
                  border-solid
                  border-gray-200
                  border-r-1
                  text-sm
                  whitespace-no-wrap
                  text-gray-700
                ">
                                        {{ $terlambat[$k]['t3'] ?? 0 }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['total'] }}
                                    </td>

                                    <td
                                        class="
                                    border-t-0
                                    p-1
                                    align-middle
                                    border-l-0
                                    border
                                    border-solid
                                    border-gray-200
                                    border-r-1
                                    text-sm
                                    whitespace-no-wrap
                                    text-gray-700
                                  ">
                                        {{ $pulang_awal[$k]['a1'] ?? 0 }}</td>
                                    <td
                                        class="
                                    border-t-0
                                    p-1
                                    align-middle
                                    border-l-0
                                    border
                                    border-solid
                                    border-gray-200
                                    border-r-1
                                    text-sm
                                    whitespace-no-wrap
                                    text-gray-700
                                  ">
                                        {{ $pulang_awal[$k]['a2'] ?? 0 }}</td>
                                    <td
                                        class="
                                    border-t-0
                                    p-1
                                    align-middle
                                    border-l-0
                                    border
                                    border-solid
                                    border-gray-200
                                    border-r-1
                                    text-sm
                                    whitespace-no-wrap
                                    text-gray-700
                                  ">
                                        {{ $pulang_awal[$k]['a3'] ?? 0 }}
                                    </td>

                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{-- {{ $r['pulang']  }} --}}
                                        {{ $pulang_awal[$k]['a0'] ?? 0 }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['lp_pulang'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-red-700
                    ">
                                        {{ $r['t_lp_pulang'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['total'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['sakit'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['izin'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['cuti'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['sppd'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['total_presensi'] }}
                                    </td>
                                    <td
                                        class="
                      border-t-0
                      p-1
                      align-middle
                      border-l-0
                      border
                      border-solid
                      border-gray-200
                      border-r-1
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                                        {{ $r['total_tunjangan'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            @elseif($mode == 'detail')
                @include('livewire.rekap.detail')
            @endif
        </div>
    </div>
</div>

@push('styles')
    <style>
        tr:nth-child(even) {
            background-color: #c6f6d5;
        }
    </style>
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
            $('#awal').on('change', function(e) {
                @this.set('awal', e.target.value);
            });
            $('#akhir').on('change', function(e) {
                @this.set('akhir', e.target.value);
            });
        })
    </script>
@endpush
