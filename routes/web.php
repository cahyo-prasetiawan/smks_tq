<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\PeminatanDetail;
use App\Livewire\PeminatanIndex;
use App\Livewire\Galeri;
use App\Livewire\BeritaPage;
use App\Livewire\ShowBerita;
use App\Livewire\ProdukIndex;
use App\Livewire\ShowProduk; 
use App\Livewire\ProfilPage;
use App\Livewire\VisiPage;
use Filament\Middleware;
use App\Http\Middleware\TrackVisitor;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('home');

Route::get('/peminatan/{slug}', PeminatanDetail::class)->name('peminatan.detail');
Route::get('/peminatan', PeminatanIndex::class)->name('peminatan.index');

Route::get('/galeri', Galeri::class)->name('galeri.index');

// Route Halaman Berita Full
Route::get('/berita', BeritaPage::class)->name('berita.index');

// Route untuk detail berita
Route::get('/berita/{slug}', ShowBerita::class)->name('berita.show');

Route::get('/produk', ProdukIndex::class)->name('produk.index');
Route::get('/produk/{slug}', ShowProduk::class)->name('produk.show');

Route::get('/profil', ProfilPage::class)->name('profil.index');

Route::get('/visi-misi', VisiPage::class)->name('visi-misi.index');

Route::get('/buat-admin-darurat', function () {
    try {
        $user = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@smk.com',
            'password' => bcrypt('password'), // Passwordnya: password
        ]);
        return 'Sukses! Admin berhasil dibuat. Silakan login.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});

Route::get('/perbaiki-storage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Sukses! Storage berhasil di-link. Coba upload gambar sekarang.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});