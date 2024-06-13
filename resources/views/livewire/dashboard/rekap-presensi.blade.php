<div>
    <hr />
    <div class="flex justify-around bg-white">
        <div class="text-center p-4">
            Hadir
            <div class="text-gray-400 text-sm">
                {{ $rekap->hadir ?? 0 }}
            </div>
        </div>
        <div class="text-center p-4">
            Sakit
            <div class="text-gray-400 text-sm">
                {{ $rekap->sakit ?? 0 }}
            </div>
        </div>
        <div class="text-center p-4">
            Izin
            <div class="text-gray-400 text-sm">
                {{ $rekap->izin ?? 0 }}
            </div>
        </div>
        <div class="text-center p-4">
            Terlambat
            <div class="text-gray-400 text-sm">
                {{ $rekap->terlambat ?? 0 }}
            </div>
        </div>
    </div>
</div>
