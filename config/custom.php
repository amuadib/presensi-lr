<?php
@include storage_path() . '/app/config.php';

return $config + [
    'hari' =>
    [
        0 => 'Ahad',
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu'
    ],
    'bulan' =>
    [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ],
    'status_sipil' =>
    [
        0 => 'Belum Menikah',
        1 => 'Menikah',
        2 => 'Janda',
        3 => 'Duda',
    ]
];
