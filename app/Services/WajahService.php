<?php

namespace App\Services;

class WajahService
{
    private $face_py_error_code = [
        0 => 'Wajah tidak cocok',
        1 => 'Data wajah tidak ditemukan. Daftarkan data wajah Anda di menu Profil',
        2 => 'Tidak dapat menemukan lokasi wajah. Pastikan wajah Anda terlihat jelas',
        3 => 'Tidak dapat mendeteksi wajah. Pastikan wajah Anda terlihat jelas',
        4 => 'Berkas tidak ditemukan',
        5 => 'Kesalahan lain',
    ];

    public function match($foto, $data)
    {
        $python = env('PYTHON', 'python');
        $path = storage_path('app/upload/wajah');
        $foto = explode('.', $foto)[0];

        $img =  imageCreateFromString(
            base64_decode(
                str_replace(' ', '+', str_replace('data:image/jpeg;base64,', '', $data))
            )
        );
        if (!$img) {
            return [
                'code' => '5',
                'message' => 'Terjadi kesalahan'
            ];
        }
        $test_file = $foto . '_test_' . date('Y-m-d') . '.jpg';
        imagejpeg($img, $path . '/' . $test_file);

        //Python
        if (env('FR_LIB') == 'face_recognition') {
            $command = $python . ' ' . base_path('scripts/face.py') . ' match ' . $path . '/' . $test_file . ' ' . $path . '/' . $foto . '.pickle';
        } elseif (env('FR_LIB') == 'deepface') {
            $command = $python . ' ' . base_path('scripts/df.py') . ' verify ' . $path . '/' . $foto . '.jpg ' . $path . '/' . $test_file;
        }
        exec($command, $out);
        //OUT
        //[
        //   0 => "verified:        True"
        //   1 => "distance:          0.276722237187342"
        //   2 => "threshold:         0.4"
        //   3 => "model:             VGG-Face"
        //   4 => "detector_backend:  opencv"
        //   5 => "similarity_metric: cosine"
        //   6 => "facial_areas:      {"img1": {"x": 30, "y": 87, "w": 102, "h": 102}, "img2": {"x": 24, "y": 34, "w": 109, "h": 109}}"
        //   7 => "time:              2.14"
        // ]

        if (isset($out[0])) {
            $coord = explode(',', $out[0]);
        } else {
            \Illuminate\Support\Facades\Log::error('Command error: {command}', ['command' => $command]);
            return [
                'code' => '5',
                'message' => 'Command error. Please check Log file'
            ];
        }
        // @unlink($path . '/' . $test_file);
        if (count($coord) < 4) {
            if (in_array($out[0],  array_keys($this->face_py_error_code))) {
                return [
                    'code' => '' . $out[0],
                    'message' => $this->face_py_error_code[$out[0]]
                ];
            } else {
                return [
                    'code' => '5',
                    'message' => 'Unknown error'
                ];
            }
        }
        //kotaaaakkk
        $color = imagecolorallocate($img, 255, 20, 28);
        imagerectangle($img, $coord[3],  $coord[0],  $coord[1],  $coord[2], $color);
        imagejpeg($img, $path . '/' . $foto . '_verified.jpg');
        imagedestroy($img);

        return [
            'code' => '99',
            'message' => 'Wajah cocok',
            'file' => $foto . '_verified.jpg',
            'coord' => $coord
        ];
    }
}
