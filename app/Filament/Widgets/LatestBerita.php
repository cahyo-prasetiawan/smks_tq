<?php

namespace App\Filament\Widgets;


use App\Models\Berita;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ToggleColumn;


class LatestBerita extends TableWidget
{
    protected static ?string $heading = 'Berita Terbaru';
    protected static ?int $sort = 4; // Tampil paling bawah
    // Agar tabel memenuhi lebar layar
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Berita::query()->latest()->limit(5) // Ambil 5 berita terakhir
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Cover')
                    ->disk('public')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Berita')
                    ->limit(15)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y'),
                    
                ToggleColumn::make('is_active')
                    ->label('Aktif'),

            ])->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
