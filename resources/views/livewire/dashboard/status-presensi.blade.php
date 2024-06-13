<div>
    @if ($datang != '')
        @if ($pulang == 'p')
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
        @elseif($datang == 'h')
            <span
                class="
                bg-green-500
                px-2
                text-white
                rounded-md
                text-medium
                shadow
                text-xs
              ">
                <i class="fa fa-user-check"></i> Hadir
            </span>
        @elseif($datang == 'i')
            <span
                class="
                bg-indigo-500
                px-2
                text-white
                rounded-md
                text-medium
                shadow
                text-xs
              ">
                <i class="fa fa-envelope"></i> Izin
            </span>
        @elseif($datang == 's')
            <span
                class="
                bg-yellow-500
                px-2
                text-white
                rounded-md
                text-medium
                shadow
                text-xs
              ">
                <i class="fa fa-procedures"></i> Sakit
            </span>
        @elseif($datang == 't')
            <span
                class="
                bg-red-500
                px-2
                text-white
                rounded-md
                text-medium
                shadow
                text-xs
              ">
                <i class="fa fa-running"></i> Terlambat
            </span>
        @elseif($datang == 'c')
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
        @elseif($datang == 'd')
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
              ">{{ $status->datang }}</span>
        @endif
    @endif
</div>
