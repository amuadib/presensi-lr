<div class="mb-2 w-full">
    <div class="mb-2">
        <div>
            <img id="wajah" class="mx-auto border border-gray-300 p-2"
                src="{{ url('/wajah/' . ($foto ?? 'not-found.jpg')) }}" />
        </div>
        <div class="bg-orange-200 p-2 text-orange-700 rounded hidden" id="isProcessing">
            <i class="fa fa-hourglass"></i>
            Sedang memproses ....
        </div>

        <div class="bg-red-700 p-2 text-white rounded flex flex-row content-center hidden" id="isError">
            <div class="mr-3">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div id="isErrorMessage">
            </div>
        </div>

        <input type="file" class="hidden" id="upload" onchange="prosesUpload({{ $user_id }})"
            accept="image/png, image/jpeg" />
        <video autoplay="true" id="box-wajah" class="hidden" style="width: 225px; height: 300px"></video>
        <canvas id="cnv-wajah" style="display: none"></canvas>
    </div>
    <div class="flex gap-2 w-full justify-center">
        <button type="button" id="fl-wajah"
            class="rounded-sm cursor-pointer text-white focus:outline-none text-center flex flex-col justify-center items-center h-12 w-16 bg-orange-500 hover:bg-orange-600"
            onclick="pilihFile()">
            <i class="fa fa-upload"></i>
            <span class="text-xs">Upload</span>
        </button>
        <button type="button" id="kmr-wajah"
            class="rounded-sm cursor-pointer text-white focus:outline-none text-center flex flex-col justify-center items-center h-12 w-16 bg-green-500 hover:bg-green-600"
            onclick="bukaKamera()">
            <i class="fa fa-camera"></i>
            <span class="text-xs">Kamera</span>
        </button>
        <button type="button" id="sav-wajah"
            class="hidden rounded-sm cursor-pointer text-white focus:outline-none text-center flex flex-col justify-center items-center h-12 w-16 bg-purple-500 hover:bg-purple-600"
            onclick="simpan(225, 300, {{ $user_id }})">
            <i class="fa fa-bolt"></i>
            <span class="text-xs">Simpan</span>
        </button>
    </div>
</div>
