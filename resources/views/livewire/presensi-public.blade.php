<table class="w-full whitespace-no-wrap" wire:poll>
    <thead>
        <tr
            class="
                                text-white
                    text-xs
                    font-semibold
                    tracking-wide
                    text-left text-gray-100
                    uppercase
                    border-b border-gray-700
                    bg-gray-900
                  ">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3 text-center" colspan="2" style="width: 142px">
                Status
            </th>
            <th class="px-4 py-3 text-center" colspan="2" style="width: 162px">
                Waktu
            </th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @if (count($presensi) < 1)
            <tr>
                <td colspan="6"
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
            @foreach ($presensi as $p)
                @php
                    $jenis = $p['jenis2'] == 'p' ? 'p' : 'd';
                @endphp
                <tr class="text-gray-700 divide-y divide-x divide-gray-400">
                    <td class="px-4 py-1 text-sm">{{ $c }}</td>
                    <td class="px-4 py-1">
                        <div class="flex items-center text-sm">
                            <div
                                class="
                          relative
                          hidden
                          w-8
                          h-8
                          mr-3
                          rounded-full
                          md:block
                        ">
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ url('/wajah/' . $p['foto'] . '/test:' . $jenis . ':' . $p['tanggal']) }}"
                                    alt="Foto {{ $p['nama'] }}" />
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold">
                                    {{ $p['nama'] }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ $p['hp'] }}
                                </p>
                            </div>
                        </div>
                    </td>
                    @if ($p['jenis'] == 'h' || $p['jenis'] == 't')
                        <td class="px-1 py-1 text-center cursor-default" style="width: 70px">
                            @if ($p['jenis2'] == '')
                                {!! setTooltip('Masuk', $p['keterangan']) !!}
                            @endif
                        </td>
                        <td class="px-1 py-1 text-center cursor-default" style="width: 70px">
                            @if ($p['jenis2'] == 'p')
                                {!! setTooltip('Pulang', $p['keterangan2']) !!}
                            @endif
                        </td>
                    @else
                        <td class="px-4 py-1 text-center cursor-default" colspan="2">
                            @if ($p['jenis'] == 'i')
                                {!! setTooltip('Izin', $p['keterangan']) !!}
                            @elseif($p['jenis'] == 's')
                                {!! setTooltip('Sakit', $p['keterangan']) !!}
                            @elseif($p['jenis'] == 't')
                                {!! setTooltip('Terlambat', $p['keterangan']) !!}
                            @elseif($p['jenis'] == 'c')
                                {!! setTooltip('Cuti', $p['keterangan']) !!}
                            @elseif($p['jenis'] == 'd')
                                {!! setTooltip('SPPD', $p['keterangan']) !!}
                            @else
                                {!! setTooltip($p['jenis'], $p['keterangan']) !!}
                            @endif
                        </td>
                    @endif
                    @if ($p['jenis'] == 'h' || $p['jenis'] == 't')
                        <td class="px-1 py-1 text-sm text-center" style="width: 80px">
                            {{ $p['waktu'] }}
                        </td>
                        <td class="px-1 py-1 text-sm text-center" style="width: 80px">
                            {{ $p['waktu2'] }}
                        </td>
                    @else
                        <td class="px-4 py-1 text-sm text-center" colspan="2">
                            {{ $p['waktu'] }}
                        </td>
                    @endif
                </tr>
                @php
                    $c++;
                @endphp
            @endforeach
        @endif
    </tbody>
</table>
