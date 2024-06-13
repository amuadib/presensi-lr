<x-app-layout>
    <div class="md:w-5/6 m-auto mt-3 md:mt-8 flex flex-col rounded-xl shadow">
        <div
            class="
            pt-3
            pb-4
            px-3
            flex
            md:flex-row
            flex-col
            rounded-t-xl
            bg-gradient-to-l
            from-pink-600
            to-purple-700
          ">
            <div class="md:flex-shrink-0">
                <img src="{{ url('wajah/' . $user->authable->foto) }}"
                    class="w-16 h-16 rounded-full mx-auto bg-white p-0.5" />
            </div>
            <div class="flex-col md:ml-3 md:text-left text-center py-1">
                <div class="text-xl font-bold text-white leading-1">
                    {{ $user->authable->nama }}
                </div>
                <div class="text-gray-300 leading-none text-sm">
                    {{ $user->role() }} @if ($user->hasUnitKerja())
                        Unit {{ $user->authable->unit->nama }}
                    @endif
                </div>
                <div class="text-gray-300 leading-none text-sm">
                    IP Anda {{ $client_ip }}
                </div>
            </div>
        </div>

        <div class="rounded-lg -mt-1 bg-white p-3 md:text-left text-center">
            <div id="jam" class="text-4xl">...</div>
            <div class="text-gray-500" id="ucapan">...</div>
            @livewire('status-presensi')
        </div>
        @cannot('Administrator')
            @livewire('rekap-presensi')
        @endcannot
    </div>

    @can('Administrator')
        @livewire('rekap-presensi-admin')
        @livewire('grafik-presensi')
        @livewire('presensi-hari-ini')
    @endcan

    @cannot('Administrator')
        @livewire('presensi-anggota')
    @endcannot

    @push('scripts')
        <script src="{{ asset('js/waktu.js') }}"></script>
    @endpush
</x-app-layout>
