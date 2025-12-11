<?php

namespace App\Filament\Resources\Beritas\Tables;

use App\Models\Peminatan;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ToggleColumn;


class BeritasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto Utama')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('title')
                    ->limit(20)
                    ->tooltip(fn ($state): string => $state) // Munculkan teks asli saat di-hover
                    ->searchable(),
                TextColumn::make('slug')
                    ->limit(20)
                    ->searchable(),
                
                TextColumn::make('views')
                    ->searchable(),
                
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge() // Mengubah text jadi badge
                    ->color(fn (string $state): string => match ($state) {
                         'Kegiatan' => 'gray',
                         'Akademis' => 'info',
                         default    => 'primary',
                        })
                      ->searchable(),
                TextColumn::make('published_at')
                    ->dateTime('d M Y ') // Format tanggal
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
               ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('created_at')
                    ->dateTime('d M Y ') // Format tanggal
                ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y ') // Format tanggal
                ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                 DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
