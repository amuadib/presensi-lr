<?php

namespace App\Http\Controllers;

use App\Models\User;

class LoginController extends Controller
{
    public function stopLoginAs()
    {
        $id = \Session::pull('orig_user');
        \Session::forget('orig_user_avatar');
        $orig_user = User::find($id);
        if ($orig_user) {
            \Auth::login($orig_user);
            return \Redirect::to('/dashboard')->with('success', 'Kembali Login sebagai ' . $orig_user->authable->nama);
        }
        return \Redirect::to('/')->withErrors(['ERROR' => 'User not recognized']);
    }

    public function loginAs($id)
    {
        if (!$id) {
            return \Redirect::back()->withErrors(['INVALID_ID' => 'ID Pengguna tidak ditemukan.']);
        }

        $user = User::find($id);

        if (!$user->authable) {
            return \Redirect::to('/')->withErrors(['INVALID_USER' => 'Data Pengguna tidak ditemukan.']);
        } else {

            if ($user->authable->aktif == 'n') {
                return \Redirect::to('/')->withErrors(['DISABLED_USER' => 'Akun dengan Username: ' . $user->username . ' telah di non-aktifkan oleh Admin.']);
            }

            if (\Illuminate\Support\Facades\Gate::allows('Admin')) {
                \Session::put('orig_user', \Auth::id());
                \Session::put('orig_user_avatar', \Auth::user()->authable->foto);
                \Auth::login($user);
            } else {
                return \Redirect::to('/')->withErrors(['NOT_ALLOWED' => 'Unauthorized action.']);
            }
            return \Redirect::to('/dashboard')->with('success', 'Login sebagai [' . $user->authable->nama . ']');
        }
    }
}
