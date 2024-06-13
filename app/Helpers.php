<?php
// https: //stackoverflow.com/a/41769505/6934844
function getIp()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return request()->ip(); // it will return the server IP if the client IP is not found using this method.
}
// https://gist.github.com/tott/7684443
function ip_in_range($ip, $range)
{
    if (strpos($range, '/') == false) {
        $range .= '/32';
    }
    // $range is in IP/CIDR format eg 127.0.0.1/24
    list($range, $netmask) = explode('/', $range, 2);
    $range_decimal = ip2long($range);
    $ip_decimal = ip2long($ip);
    $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
    $netmask_decimal = ~$wildcard_decimal;
    return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
}

function timeDiff($t1, $t2)
{
    $waktu = '';
    $sec = $t1 > $t2 ? $t1 - $t2 : $t2 - $t1;
    $min = floor($sec / 60);
    $hr = floor($min / 60);
    $min = $min % 60;
    if ($hr > 0) $waktu .= $hr . ' jam ';
    if ($min > 0) $waktu .= $min . ' menit';

    return $waktu;
}
function setTooltip($header, $body)
{
    $str = '<div class="tooltip">';
    $str .= $header;
    if ($body != '') {
        $str .= '<span class="tooltiptext tooltip-top">';
        $str .= $body;
        $str .= '</span>';
    }
    $str .= '</div>';
    return $str;
}
function formatJamKerja($pembagian)
{
    if (!$pembagian) {
        return '';
    }
    $ret = '<ul class="list-disc">';
    foreach ($pembagian as $p) {
        $ret .= '<li>' . $p->jam->nama . '</li>';
    }
    $ret .= '</ul>';
    return $ret;
}
function formatRupiah($angka, $show_rp = true)
{
    $formatted = number_format($angka, 0, ',', '.');
    if ($show_rp) return 'Rp ' . $formatted;
    return $formatted;
}
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function formatTanggal($Ymd, $hari = false)
{
    if (!validateDate($Ymd, 'Y-m-d')) return '-';
    $time = strtotime($Ymd);
    $date = explode('-', $Ymd);

    $r = $hari ? config('custom.hari')[date('w', $time)] . ', ' : '';
    $bln = $date[1];
    return $r . $date[2] . ' ' . config('custom.bulan')[$bln] . ' ' . $date[0];
}
function persenan($bl)
{
    $arah = '';
    if ($bl['a'] == 'n' && $bl['p'] > 0) {
        $arah =
            '<span class="mr-2 text-green-500"><i class="fa fa-arrow-up"></i>&nbsp;' .
            $bl['p'] .
            '%</span><span class="whitespace-no-wrap">Dari bulan lalu</span>';
    } else if ($bl['a'] == 't' && $bl['p'] > 0) {
        $arah =
            '<span class="mr-2 text-red-500"><i class="fa fa-arrow-down"></i>&nbsp;' .
            $bl['p'] .
            '%</span><span class="whitespace-no-wrap">Dari bulan lalu</span>';
    } else if ($bl['a'] == 's') {
        return '<span class="whitespace-no-wrap">Tidak ada perubahan</span>';
    }

    if ($arah != '') {
        return $arah;
    }

    return '<span class="whitespace-no-wrap">Tidak dapat diterapkan</span>';
}
function jenis($j)
{
    $status = '';
    if ($j == 'h')
        $status =
            '<span class="bg-green-500 px-2 text-white rounded-md text-medium shadow text-xs">Hadir</span>';
    else if ($j == 'i')
        $status =
            '<span class="bg-blue-500 px-2 text-white rounded-md text-medium shadow text-xs">Izin</span>';
    else if ($j == 's')
        $status =
            '<span class="bg-orange-500 px-2 text-white rounded-md text-medium shadow text-xs">Sakit</span>';
    else if ($j == 't')
        $status =
            '<span class="bg-red-500 px-2 text-white rounded-md text-medium shadow text-xs" >Terlambat</span>';
    else if ($j == 'p')
        $status =
            '<span class="border-gray-600 border px-2 text-gray-600 rounded-md text-medium shadow-md text-xs">Pulang</span>';
    else if ($j == 'c')
        $status =
            '<span class="bg-blue-600 px-2 text-white rounded-md text-medium shadow text-xs">Cuti</span>';
    else
        $status =
            '<span class="bg-gray-500 px-2 text-white rounded-md text-medium shadow text-xs" >' . $j .
            '</span>';

    return $status;
}
