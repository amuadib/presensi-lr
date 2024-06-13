@push('scripts')
    <script>
        var url = "{{ url('/wajah') }}"
        var wajah = url + "/{{ $user->authable->foto ?? 'not-found.jpg' }}#{{ time() }}"
        // var user_id = "{{ $user->id ?? 0 }}"
    </script>
    <script>
        $(function() {
            $("#wajah").attr("src", wajah)
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

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

        function isProcessing(state = true) {
            if (state) {
                $('#isProcessing').removeClass('hidden')
            } else {
                $('#isProcessing').addClass('hidden')
            }
        }

        function isError(state = true, message = '') {
            if (state) {
                $('#isError').removeClass('hidden')
                $('#isErrorMessage').text(message)
            } else {
                $('#isError').addClass('hidden')
            }
        }

        function bukaKamera() {
            isCameraOn()
            const video = document.querySelector('#box-wajah')

            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices
                    .getUserMedia({
                        video: true
                    })
                    .then(function(stream) {
                        video.srcObject = stream
                    })
                    .catch(function(err) {
                        console.log('Error: ' + err)
                    })
            }
        }

        function simpan(w, h, user_id) {
            isProcessing()
            isError(false)
            var data = ''
            const video = document.querySelector('#box-wajah')
            const canvas = document.querySelector('#cnv-wajah')
            const context = canvas.getContext('2d')
            if (w && h) {
                canvas.width = w
                canvas.height = h
                context.drawImage(video, 0, 0, w, h)
                data = canvas.toDataURL('image/jpeg')
            }

            try {
                $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            id: user_id,
                            foto: data,
                            mode: "base64"
                        },
                        datatype: "json"
                    }).done(function(response) {
                        if (response.code == '00') {
                            $('#wajah').attr("src", url + '/' + response.data + '#' + response.timestamp)
                        } else {
                            isError(true, response.message)
                        }
                        isCameraOn(false)
                        isProcessing(false)
                    })
                    .fail(function(response) {
                        alert(response.responseJSON.message)
                    })
            } catch (e) {
                alert("URL back-end tidak dapat diakses")
            }
        }

        function prosesUpload(user_id) {
            isProcessing()
            isError(false)

            var formData = new FormData()
            formData.append('id', user_id)
            formData.append('foto', $("#upload").prop('files')[0])
            formData.append('mode', 'binary')
            $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function(response) {
                    if (response.code == '00') {
                        $('#wajah').attr("src", url + '/' + response.data + '#' + response.timestamp)
                    } else {
                        isError(true, response.message)
                    }
                    isProcessing(false)
                })
                .fail(function(response) {
                    isProcessing(false)
                    alert(response.responseJSON.message)
                })
        }

        function pilihFile() {
            $("#upload").click()
        }
    </script>
@endpush
