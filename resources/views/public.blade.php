<x-base-layout>
    <div class="h-full pb-16 overflow-y-auto">
        <div>
            <div id="header-bg" class="w-full h-full bg-cover"></div>
        </div>
        <div class="container grid px-6 mx-auto -mt-24 w-5/6">
            <h4 class="my-2 text-lg font-semibold text-gray-200" style="text-shadow: 0 2px 4px rgba(0, 0, 0, 5)">
                <span id="hari"></span> <span id="jam"></span>
            </h4>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    @livewire('presensi-public')
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/waktu.js') }}"></script>
    @endpush
    @push('styles')
        <style>
            #header-bg {
                background-image: url('/header_epresensi.png');
                min-height: 20vh;
            }

            tr:nth-child(even) {
                background-color: #c6f6d5;
            }

            .tooltip {
                position: relative;
                display: inline-block;
                border-bottom: 1px dotted #ccc;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                position: absolute;
                /* width: 120px; */
                background-color: #555;
                color: #fff;
                text-align: center;
                padding: 1px 5px;
                border-radius: 6px;
                z-index: 1;
                opacity: 0;
                transition: opacity 0.6s;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }

            .tooltip-top {
                bottom: 125%;
                left: 50%;
                margin-left: -60px;
            }

            .tooltip-top::after {
                content: '';
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
            }
        </style>
    @endpush
</x-base-layout>
