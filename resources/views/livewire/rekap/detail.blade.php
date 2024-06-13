<table class="items-center w-full bg-transparent border-l mb-4">
    <thead>
        <tr>
            <th
                class="
                  px-1
                  py-2
                  bg-gray-100
                  text-gray-600
                  align-middle
                  border border-solid border-gray-200
                  text-sm
                  uppercase
                  border-r
                  whitespace-no-wrap
                  font-semibold
                  text-left
                ">
                Tanggal
            </th>
            <th
                class="
                  px-1
                  py-2
                  bg-gray-100
                  text-gray-600
                  align-middle
                  border border-solid border-gray-200
                  text-sm
                  uppercase
                  border-r
                  whitespace-no-wrap
                  font-semibold
                  text-left
                ">
                Status
            </th>
            <th
                class="
                  px-1
                  py-2
                  bg-gray-100
                  text-gray-600
                  align-middle
                  border border-solid border-gray-200
                  text-sm
                  uppercase
                  border-r
                  whitespace-no-wrap
                  font-semibold
                  text-left
                ">
                Waktu
            </th>
        </tr>
    </thead>
    <tbody>
        {{-- <template v-if="loading">
            <tr>
                <td colspan="3"
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
            </tr>
        </template> --}}
        @if (!count($detail['data']))
            <tr>
                <td colspan="3"
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
            @foreach ($detail['data'] as $k => $d)
                <tr>
                    <td
                        class="
                      p-1
                      align-middle
                      border-r border-b
                      text-sm
                      whitespace-no-wrap
                      text-left text-gray-700
                    ">
                        {{ formatTanggal($k) }}
                    </td>
                    <td
                        class="
                      align-middle
                      border-r border-b
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                        @if ($d['jenis2'] != '')
                            <div class="px-1 border-b">
                                {{ $d['jenis'] }}
                            </div>
                            <div class="px-1">
                                {{ $d['jenis2'] }}
                            </div>
                        @else
                            <div class="col-span-2 px-1">
                                {{ $d['jenis'] }}
                            </div>
                        @endif
                    </td>
                    <td
                        class="
                      align-middle
                      border-b border-r
                      text-sm
                      whitespace-no-wrap
                      text-gray-700
                    ">
                        @if ($d['jenis2'] != '')
                            <div class="px-1 border-b">
                                {{ $d['waktu'] }}
                            </div>
                            <div class="px-1">
                                {{ $d['waktu2'] }}
                            </div>
                        @else
                            <div class="col-span-2 px-1" v-else>
                                {{ $d['waktu'] }}
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
