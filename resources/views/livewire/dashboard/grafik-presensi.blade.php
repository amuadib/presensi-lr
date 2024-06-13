<div class="md:w-5/6 m-auto my-3 md:my-8 grid grid-cols-6 gap-2">
    <div class="col-span-6 md:col-span-4 bg-gray-700">
        <div class="flex flex-wrap items-center pt-3 pl-3">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h6 class="uppercase text-gray-200 mb-1 text-sm font-semibold">
                    Laporan
                </h6>
                <h2 class="text-white text-xl font-semibold">
                    Presensi Mingguan
                </h2>
            </div>
        </div>
        <canvas id="grafik1" height="100px"></canvas>
    </div>
    <div class="col-span-6 md:col-span-2">
        <div class="flex flex-wrap items-center pt-3 pl-3">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h6 class="uppercase text-gray-500 mb-1 text-sm font-semibold">
                    Laporan
                </h6>
                <h2 class="text-gray-800 text-xl font-semibold">
                    Presensi Harian
                </h2>
            </div>
        </div>
        <canvas id="grafik2" height="200px"></canvas>
    </div>
</div>
@push('scripts')
    <script>
        var linechartdata = {!! json_encode($lcdata['datasets']) !!}
        var labels = {!! json_encode($lcdata['labels']) ?? '' !!}

        var bcdata = {!! json_encode($bcdata['data']) !!}
        var bclabels = {!! json_encode($bcdata['labels']) !!}
        var bccolor = {!! json_encode($bcdata['color']) !!}
    </script>
    <script>
        var lcoptions = {
            maintainAspectRatio: true,
            responsive: true,
            title: {
                display: false,
                text: 'Grafik Presensi',
                fontColor: 'white',
            },
            legend: {
                labels: {
                    fontColor: 'white',
                },
                align: 'end',
                position: 'bottom',
            },
            hover: {
                mode: 'nearest',
                intersect: true,
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: 'rgba(255,255,255,.9)',
                    },
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Tanggal',
                        fontColor: 'white',
                    },
                    gridLines: {
                        display: false,
                        borderDash: [2],
                        borderDashOffset: [2],
                        color: 'rgba(33, 37, 41, 0.3)',
                        zeroLineColor: 'rgba(0, 0, 0, 0)',
                        zeroLineBorderDash: [2],
                        zeroLineBorderDashOffset: [2],
                    },
                }, ],
                yAxes: [{
                    ticks: {
                        fontColor: 'rgba(255,255,255,.9)',
                        // stepSize: 1,
                        beginAtZero: true,
                    },
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Value',
                        fontColor: 'red',
                    },
                    gridLines: {
                        borderDash: [3],
                        borderDashOffset: [3],
                        drawBorder: false,
                        color: 'rgba(255, 255, 255, 0.15)',
                        zeroLineColor: 'rgba(33, 37, 41, 0)',
                        zeroLineBorderDash: [2],
                        zeroLineBorderDashOffset: [2],
                    },
                }, ],
            },
        }

        var bcoptions = {
            maintainAspectRatio: true,
            responsive: true,
            title: {
                display: false,
            },
            legend: {
                display: false,
            },
            tooltips: {
                enabled: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        // stepSize: 1,
                        beginAtZero: true,
                    },
                }]
            },
            animation: {
                duration: 50,
                easing: 'easeOutQuart',
                onComplete: function() {
                    var ctx = this.chart.ctx
                    ctx.font = Chart.helpers.fontString(
                        Chart.defaults.global.defaultFontFamily,
                        'normal',
                        Chart.defaults.global.defaultFontFamily
                    )
                    ctx.textAlign = 'center'
                    ctx.textBaseline = 'bottom'

                    this.data.datasets.forEach(function(dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model =
                                dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                scale_max =
                                dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale
                                .maxHeight
                            ctx.fillStyle = '#444'
                            var y_pos = model.y - 5
                            if ((scale_max - model.y) / scale_max >= 0.93)
                                y_pos = model.y + 20
                            ctx.fillText(dataset.data[i], model.x, y_pos)
                        }
                    })
                },
            },
        }
    </script>

    <script src="{{ asset('js/Chart.js.2.9.3.min.js') }}"></script>
    <script>
        // GRAFIK MINGGUAN
        var data = []
        for (var j = 0; j < linechartdata.length; j++) {
            data.push({
                label: linechartdata[j].label,
                backgroundColor: '#' + linechartdata[j].color,
                borderColor: '#' + linechartdata[j].color,
                data: linechartdata[j].data,
                fill: false,
            })
        }
        new Chart(document.getElementById("grafik1"), {
            type: "line",
            data: {
                labels: labels,
                datasets: data
            },
            options: lcoptions
        });

        // GRAFIK HARIAN
        var data2 = []
        var color = []
        for (var j = 0; j < bcdata.length; j++) {
            data2.push(bcdata[j])
            color.push(bccolor[j])
        }
        new Chart(document.getElementById("grafik2"), {
            type: "bar",
            data: {
                labels: bclabels,
                datasets: [{
                    data: data2,
                    backgroundColor: color,
                    borderColor: color,
                }, ]
            },
            options: bcoptions
        })
    </script>
@endpush
