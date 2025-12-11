<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ToggleColumn;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
         return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public') // Mengambil dari storage/app/public
                    ->circular()
                    ->label('Preview'),
                    
                TextColumn::make('title')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('badge'),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            // PERBAIKAN 1: Gunakan 'actions' untuk tombol View/Edit per baris
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            // PERBAIKAN 2: Gunakan 'bulkActions' untuk aksi massal (checkbox)
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
