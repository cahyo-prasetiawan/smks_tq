<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Berita;

class TopBeritaChart extends ChartWidget
{
    protected ?string $heading = 'Artikel Terpopuler (Top 5)';
    protected static ?int $sort = 3; // Sesuaikan urutan agar rapi

    protected function getData(): array
    {
        // 1. Ambil 5 berita dengan views terbanyak
        $data = Berita::query()
            ->orderBy('views', 'desc') // Urutkan dari yang terbanyak
            ->limit(5) // Batasi 5 saja agar grafik tidak sempit
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pembaca (Views)',
                    'data' => $data->pluck('views'), // Ambil data angka views
                    'backgroundColor' => [
                        '#3B82F6', // Biru
                        '#6366f1', // Indigo
                        '#8b5cf6', // Violet
                        '#a855f7', // Purple
                        '#d946ef', // Fuchsia
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'borderRadius' => 5, // Membuat ujung batang melengkung
                ],
            ],
            // 2. Ambil Judul Berita untuk Label di bawah
            // Kita potong judulnya biar tidak kepanjangan di grafik
            'labels' => $data->pluck('title')->map(fn ($title) => str($title)->limit(15))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Menggunakan Bar Chart (Batang Tegak)
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,    // Memaksa kelipatan 1 (Bilangan Bulat)
                        'precision' => 0,   // Menghilangkan koma desimal
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false, // (Opsional) Sembunyikan legenda jika hanya 1 warna
                ],
            ],
        ];
    }
}
