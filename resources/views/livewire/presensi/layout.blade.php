{{-- <x-app-layout> --}}
<div class="w-5/6 m-auto my-8">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            @include('livewire.presensi.' . $jenis)
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/datepicker.js') }}"></script>
    @endpush
    @prepend('scripts')
        <script>
            function isCameraOn(state = true) {
                if (state) {
                    $('#sav-wajah').removeClass('hidden')
                    $('#box-wajah').removeClass('hidden')

                    $('#wajah').addClass('hidden')
                    $('#kmr-wajah').addClass('hidden')
                    $('#fl-wajah').addClass('hidden')
                } else {
                    $('#wajah').removeClass('hidden')
                    $('#kmr-wajah').removeClass('hidden')
                    $('#fl-wajah').removeClass('hidden')

                    $('#sav-wajah').addClass('hidden')
                    $('#box-wajah').addClass('hidden')
                }
            }
        </script>
    @endprepend
</div>
{{-- </x-app-layout> --}}
