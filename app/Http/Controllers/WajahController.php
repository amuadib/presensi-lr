<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class WajahController extends Controller
{
    private $python;

    private $face_py_error_code = [
        0 => 'Wajah tidak cocok',
        1 => 'Data wajah tidak ditemukan. Daftarkan data wajah Anda di menu Profil',
        2 => 'Tidak dapat menemukan lokasi wajah. Pastikan wajah Anda terlihat jelas',
        3 => 'Tidak dapat mendeteksi wajah. Pastikan wajah Anda terlihat jelas',
        4 => 'Berkas tidak ditemukan',
        5 => 'Kesalahan lain',
    ];

    public function __construct()
    {
        $this->python = env('PYTHON', 'python');
    }

    public function view(String $file, String $option = '')
    {
        $storage = \Storage::disk('upload');
        $fullpath = 'wajah/' . $file;

        if ($option != '') {
            $options = explode(':', $option);
            $path = explode('.', $file);

            if ($options[0] == 'test') {
                $testpath = 'wajah/' . $path[0] . '_test_' . $options[1] . '_' . $options[2] . '.' . $path[1];
                if ($storage->exists($testpath)) {
                    $fullpath = $testpath;
                }
            }
        }

        $mime = class_exists('finfo') ? $storage->mimeType($fullpath) : 'Image/PNG';

        if (!$storage->exists($fullpath)) {
            $file = $storage->get('wajah/not-found.jpg');
        } else {
            $file = $storage->get($fullpath);
        }

        $response = \Response::make($file, 200);
        $response->header('Content-type', $mime);

        return $response;
    }
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'id' => 'required',
            'foto' => 'required',
            'mode' => 'required'
        ]);

        if ($data['mode'] == 'base64') {
            $img =  imageCreateFromString(base64_decode(str_replace(' ', '+', str_replace('data:image/jpeg;base64,', '', $data['foto']))));
            if (!$img) {
                return [
                    'code' => '01',
                    'message' => 'Terjadi kesalahan'
                ];
            }
        }

        $path = storage_path('app/upload/wajah');
        $filename = "wajah_" . ($data['id'] == 0 ? \Illuminate\Support\Str::random(5) : $data['id']);

        if ($data['mode'] == 'base64') {
            imagejpeg($img, $path . '/' . $filename . '_new.jpg');
        } else {
            Image::make($data['foto'])
                ->resize(300, 225, function ($c) {
                    $c->aspectratio();
                })
                ->save($path . '/' . $filename . '_new.jpg');
        }

        if (env('FR_LIB') == 'face_recognition') {
            if ($this->encodeFace($path . '/' . $filename . '_new.jpg', $path . '/' . $filename . '.pickle') == 0) {
                @unlink($path . '/' . $filename . '_new.jpg');
                return [
                    'code' => '03',
                    'message' => 'Error: Wajah tidak terdeteksi.'
                ];
            }
        } elseif (env('FR_LIB') == 'deepface') {
            if ($this->analyzeFace($path . '/' . $filename . '_new.jpg') == 0) {
                @unlink($path . '/' . $filename . '_new.jpg');
                return [
                    'code' => '03',
                    'message' => 'Terjadi kesalahan. Pastikan wajah Anda terlihat jelas, lepas masker / penutup wajah bila perlu.'
                ];
            }
        }

        rename($path . '/' . $filename . '_new.jpg', $path . '/' . $filename . '.jpg');

        if ($data['id'] > 0) {
            User::find($data['id'])->authable->update(['foto' => $filename . '.jpg']);
        }

        \Cache::set('foto_tmp', $filename . '.jpg', 3000);

        return [
            'code' => '00',
            'data' => $filename . '.jpg',
            'timestamp' => time()
        ];
    }

    private function analyzeFace(String $image_path)
    {
        $command = $this->python . ' ' . base_path('scripts/df.py') . ' analyze ' . $image_path;
        exec($command, $out);
        return $out[0];
    }

    private function encodeFace(String $image_path, String $pickle_path)
    {
        $command = $this->python . ' ' . base_path('scripts/face.py') . ' encode ' . $image_path . ' ' . $pickle_path;
        exec($command, $out);
        return $out[0];
    }
}
