<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WajahController;

use App\Http\Livewire\FormPresensi;
use App\Http\Livewire\JamKerja;
use App\Http\Livewire\LokasiKerja;
use App\Http\Livewire\Pengguna;
use App\Http\Livewire\Rekap;
use App\Http\Livewire\Riwayat;
use App\Http\Livewire\Tunjangan;
use App\Http\Livewire\Unit;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// if (rand(1, 100) > 60) {
//     Route::any(
//         '{catchall}',
//         function () {
//             return view('402');
//         }
//     )->where('catchall', '.*');
// }
Route::get('/wajah/{file}/{option?}', [
    'uses' => '\App\Http\Controllers\WajahController@view'
]);
Route::get('/lampiran/{file}', [
    'uses' => '\App\Http\Controllers\LampiranController@view'
]);
Route::get(
    '/public',
    function () {
        return view('public')->layout('layouts.base');
    }
);

Route::get('/loginas/stop', '\App\Http\Controllers\LoginController@stopLoginAs')->name('user.loginAs.stop');
Route::get('/loginas/{id}', '\App\Http\Controllers\LoginController@loginAs')->name('user.loginAs');

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'can:Anggota')->group(function () {
    Route::get('/presensi/{jenis}/{id?}', FormPresensi::class)->name('presensi');
});
Route::middleware('auth')->group(function () {
    Route::get('logs', [
        'as' => 'logs',
        'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'
    ]);

    Route::get('/wajah', [ProfileController::class, 'edit'])->name('wajah');
    Route::post('/wajah', [WajahController::class, 'store'])->name('wajah.store');
    Route::post('/wajah/match', [WajahController::class, 'match'])->name('wajah.match');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/riwayat', Riwayat::class)->name('riwayat');
    Route::get('/tunjangan', Tunjangan::class)->name('tunjangan');
    Route::get('/rekap', Rekap::class)->name('rekap');
    Route::get('/unit', Unit::class)->name('unit');
    Route::get('/pengguna', Pengguna::class)->name('pengguna');
    Route::get('/jam', JamKerja::class)->name('jam');
    Route::get('/lokasi', LokasiKerja::class)->name('lokasi');
});

require __DIR__ . '/auth.php';
