<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Berita;
use App\Models\Peminatan;
use App\Models\Galery;
use App\Models\Produk;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // KARTU 1: TOTAL BERITA
            Stat::make('Total Berita', Berita::count())
                ->description('Artikel Yang Diterbitkan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Grafik mini hiasan
                ->color('success'), // Warna Hijau

            // KARTU 2: TOTAL PRODUK TEFA
            Stat::make('Unit TEFA', Peminatan::count())
                ->description('Unit Produksi Siswa')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'), // Warna Kuning/Orange

             Stat::make('Produk TEFA', Produk::count())
                ->description('Produksi Siswa')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'), // Warna Kuning/Orange

            // KARTU 3: GALERI FOTO
            Stat::make('Dokumentasi', Galery::count())
                ->description('Foto Kegiatan Sekolah')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'), // Warna Biru
        ];
    }
}
