<?php

namespace App\Filament\Resources\Galeries\Tables;

use App\Models\Peminatan;
// --- PERHATIKAN BAGIAN USE INI ---
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction; // Hapus baris ini jika tidak ada tombol delete per baris
use Filament\Actions\EditAction;   // Gunakan namespace Tables
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\SelectColumn; // Import yang benar untuk Tabe
use Illuminate\Support\Facades\Storage;

class GaleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public') // Pastikan disk sesuai dengan yang digunakan di Form
                    ->label('Foto')
                    ->square(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                // Badge Warna Warni Kategori
             TextColumn::make('category')
    ->label('Kategori')
    ->badge() // Mengubah text jadi badge
    ->color(fn (string $state): string => match ($state) {
        'Kegiatan' => 'gray',
        'Akademis' => 'info',
        default    => 'primary',
    })
    ->searchable(),

                // Badge Layout Grid
                TextColumn::make('grid_size')
                    ->label('Layout')
                    ->badge()
                    ->colors([
                        'success' => 'large',
                        'warning' => 'wide',
                        'gray'    => 'medium',
                    ]),

                TextColumn::make('event_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
               SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options(function () {
                        // Ambil kolom 'title' dari tabel peminatans
                        $jurusan = Peminatan::query()->pluck('title', 'title')->toArray();
                        
                        $defaults = ['Kegiatan' => 'Kegiatan', 'Akademik' => 'Akademik'];
                        return $defaults + $jurusan;
                    }),
            ])
            ->actions([
                // Pastikan EditAction & DeleteAction diambil dari Filament\Tables\Actions
               EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}