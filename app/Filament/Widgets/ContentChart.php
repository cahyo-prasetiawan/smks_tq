<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Berita;
use App\Models\Produk;
use App\Models\Galery;

class ContentChart extends ChartWidget
{
    protected ?string $heading = 'Komposisi Konten Website';
    protected static ?int $sort = 3; // Urutan widget
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Data',
                    'data' => [
                        Berita::count(), 
                        Produk::count(), 
                        Galery::count()
                    ],
                    'backgroundColor' => [
                        '#10B981', // Hijau (Berita)
                        '#F59E0B', // Orange (Produk)
                        '#3B82F6', // Biru (Galeri)
                    ],
                ],
            ],
            'labels' => ['Berita Sekolah', 'Produk TEFA', 'Galeri Foto'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
