<div class="md:w-5/6 m-auto my-3 md:my-8">
    <div
        class="
        relative
        flex flex-col
        min-w-0
        break-words
        bg-white
        w-full
        mb-6
        shadow-lg
        rounded
      ">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-xl text-gray-800">Presensi Hari Ini</h3>
                </div>
                <div
                    class="
          relative
          w-full
          px-4
          max-w-full
          flex-grow flex-1
          text-right
        ">
                    <a href="{{ route('riwayat') }}"
                        class="
            bg-indigo-500
            text-white
            active:bg-indigo-600
            text-sm
            font-bold
            uppercase
            px-3
            py-1
            rounded
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          ">
                        Semua
                    </a>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                        <th
                            class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Nama
                        </th>
                        <th
                            class="
              px-6
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
              px-6
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
              px-6
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
                    </tr>
                </thead>
                <tbody>
                    @if (!$presensi->count())
                        <tr>
                            <td colspan="4"
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
                            <tr>
                                <td
                                    class="
              border-t-0
              px-6
              align-middle
              border-l-0 border-r-0
              text-sm
              whitespace-no-wrap
              p-4
              text-left
            ">
                                    {!! $p->absenable->nama ?? '<span class="text-red-500">Tidak terdaftar</span>' !!}
                                </td>
                                <td
                                    class="
              border-t-0
              px-6
              align-middle
              border-l-0 border-r-0
              text-sm
              whitespace-no-wrap
              p-4
            ">
                                    {!! jenis($p->jenis) !!}</td>
                                <td
                                    class="
              border-t-0
              px-6
              align-middle
              border-l-0 border-r-0
              text-sm
              whitespace-no-wrap
              p-4
            ">
                                    {{ $p->waktu }}
                                </td>
                                <td
                                    class="
              border-t-0
              px-6
              align-middle
              border-l-0 border-r-0
              text-sm
              whitespace-no-wrap
              p-4
            ">
                                    {{ $p->keterangan }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
