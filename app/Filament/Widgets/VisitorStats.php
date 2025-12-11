<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use App\Models\Visitor;

class VisitorStats extends StatsOverviewWidget
{
   // Agar widget ini update otomatis (realtime)
    protected ?string $pollingInterval = '30s';
    
    // Urutan widget di dashboard
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // Hitung Harian (Hari Ini)
        $daily = Visitor::whereDate('visit_date', Carbon::today())->count();
        
        // Hitung Bulanan (Bulan Ini)
        $monthly = Visitor::whereYear('visit_date', Carbon::now()->year)
            ->whereMonth('visit_date', Carbon::now()->month)
            ->count();
            
        // Hitung Tahunan (Tahun Ini)
        $yearly = Visitor::whereYear('visit_date', Carbon::now()->year)->count();

        return [
            // KARTU 1: HARIAN
            Stat::make('Pengunjung Hari Ini', number_format($daily))
                ->description('Total unik IP hari ini')
                ->descriptionIcon('heroicon-m-user')
                ->color('success') // Hijau
                ->chart([$daily, $daily + 5, $daily + 2, $daily]), // Dummy chart hiasan

            // KARTU 2: BULANAN
            Stat::make('Pengunjung Bulan Ini', number_format($monthly))
                ->description(Carbon::now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'), // Kuning

            // KARTU 3: TAHUNAN
            Stat::make('Pengunjung Tahun Ini', number_format($yearly))
                ->description('Tahun ' . Carbon::now()->year)
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'), // Biru
        ];
    }
}

