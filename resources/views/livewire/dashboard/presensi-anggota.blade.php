<div class="w-5/6 m-auto grid mt-5 text-center gap-6 grid-cols-2">
    {{-- @if ($ada_jam_kerja and $jam['aktif'] == 'y') --}}
    @if ($ada_jam_kerja)
        @if ($status['datang'] == 'i')
            <div class="p-3 rounded-xl shadow col-span-2">
                <div class="rounded-full bg-blue-300 w-16 h-16 p-3 m-auto">
                    <span class="text-4xl text-blue-800">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
                <div class="text-2xl text-blue-500 font-semibold">IZIN</div>
                <div class="text-sm text-blue-500">{{ $status['keterangan'] }}</div>
            </div>
        @elseif($status['datang'] == 'c')
            <div class="p-3 rounded-xl shadow col-span-2">
                <div class="rounded-full bg-indigo-300 w-16 h-16 p-3 m-auto">
                    <span class="text-4xl text-indigo-800">
                        <i class="fa fa-check"></i>
                    </span>
                </div>
                <div class="text-2xl text-indigo-500 font-semibold">CUTI</div>
                <div class="text-sm text-indigo-500">
                    {{ $status['keterangan'] }}
                </div>
            </div>
        @elseif($status['datang'] == 'd')
            <div class="p-3 rounded-xl shadow col-span-2">
                <div class="rounded-full bg-indigo-300 w-16 h-16 p-3 m-auto">
                    <span class="text-4xl text-indigo-800">
                        <i class="fa fa-check"></i>
                    </span>
                </div>
                <div class="text-2xl text-indigo-500 font-semibold">SPPD</div>
                <div class="text-sm text-indigo-500">
                    {{ $status['keterangan'] }}
                </div>
            </div>
        @elseif($status['datang'] == 's')
            <div class="p-3 rounded-xl shadow col-span-2">
                <div class="rounded-full bg-orange-300 w-16 h-16 p-3 m-auto">
                    <span class="text-4xl text-orange-800">
                        <i class="fa fa-procedures"></i>
                    </span>
                </div>
                <div class="text-2xl text-orange-500 font-semibold">SAKIT</div>
                <div class="text-sm text-orange-500"></div>
            </div>
        @else
            <div class="p-3 rounded-xl shadow bg-white">
                @if ($status['datang'] == 'h' || $status['datang'] == 't')
                    <div class="rounded-full bg-green-300 w-16 h-16 p-3 m-auto">
                        <span class="text-4xl text-green-800">
                            <i class="fa fa-user-check"></i>
                        </span>
                    </div>
                    <div class="text-2xl text-green-500 font-semibold">DATANG</div>
                    <div class="text-sm text-green-500">Sudah Presensi</div>
                @else
                    <a href="{{ url('/presensi/datang') }}">
                        <div
                            class="
                  rounded-full
                  bg-indigo-300
                  w-16
                  h-16
                  p-3
                  m-auto
                  hover:bg-indigo-200
                ">
                            <span class="text-4xl text-indigo-800">
                                <i class="fa fa-id-badge"></i>
                            </span>
                        </div>
                        <div class="text-2xl text-indigo-800 font-semibold">DATANG</div>
                        <div class="text-sm text-gray-500">Form Presensi Masuk</div>
                    </a>
                @endif
            </div>
            <div class="p-3 rounded-xl shadow bg-white">
                @if ($status['pulang'] == 'p')
                    <div class="rounded-full bg-green-300 w-16 h-16 p-3 m-auto">
                        <span class="text-4xl text-green-800">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <div class="text-2xl text-green-500 font-semibold">PULANG</div>
                    <div class="text-sm text-green-500">Sudah Presensi</div>
                @elseif($status['datang'] == 'h' || $status['datang'] == 't')
                    <a href="{{ url('/presensi/pulang/' . $jam_id) }}">
                        <div
                            class="
                  rounded-full
                  bg-indigo-300
                  w-16
                  h-16
                  p-3
                  m-auto
                  hover:bg-indigo-200
                ">
                            <span class="text-4xl text-indigo-800">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        </div>
                        <div class="text-2xl text-indigo-800 font-semibold">PULANG</div>
                        <div class="text-sm text-gray-500">Form Presensi Pulang</div>
                    </a>
                @else
                    <div class="rounded-full bg-gray-300 w-16 h-16 p-3 m-auto">
                        <span class="text-4xl text-gray-800">
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                    <div class="text-2xl text-gray-500 font-semibold">PULANG</div>
                    <div class="text-sm text-gray-500">Belum presensi masuk</div>
                @endif
            </div>
        @endif
        {{-- @elseif($ada_jam_kerja and $jam['aktif'] == 'n')
        <div
            class="
            my-3
            border-radius
            shadow
            p-3
            text-xl bg-yellow-400 text-center text-gray-800
            col-span-2
          ">
            Shift Anda belum dimulai / sudah berakhir.
        </div>
    @elseif($ada_jam_kerja and $jam['aktif'] == '')
        <div
            class="
            my-3
            border-radius
            shadow
            p-3
            text-xl bg-purple-700 text-center text-white
            col-span-2
          ">
            Anda tidak mempunyai jam kerja hari ini.
        </div> --}}
    @else
        <div
            class="
            my-3
            border-radius
            shadow
            p-3
            text-xl bg-red-600 text-center text-white
            col-span-2
          ">
            Akun Anda <span class="font-bold">belum</span> mempunyai pengaturan jam kerja E-Presensi.<br /> Harap
            hubungi Administrator
        </div>
    @endif
    {{-- {{ json_encode($jam) }} --}}
</div>
