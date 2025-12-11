<?php

namespace App\Filament\Resources\Galeries\Schemas;

use App\Models\Peminatan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set; // Diperlukan untuk auto-slug
use Filament\Schemas\Schema;
use Illuminate\Support\Str; // Diperlukan untuk auto-slug

class GaleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
           ->components([
                // Judul (Auto generate Slug)
             TextInput::make('title')
                    ->label('Judul Kegiatan')
                    ->required()
                    ->live(onBlur: true)
                    // --- PERBAIKAN DISINI ---
                    // Hapus "Set" sebelum "$set". Cukup tulis "fn ($set, $state)"
                    ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))), 
                    // ------------------------

                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                FileUpload::make('image')
                    ->label('Foto Kegiatan')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('galeri-foto') 
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']) // Kita tulis manual
                    ->maxSize(5120) // Maksimal 5MB// <--- WAJIB ADA: Agar file bisa diakses via URL browser
                    ->preserveFilenames() // Opsional: Agar nama file asli tidak diacak
                    ->imageEditor()
                    ->required(),
                

                // --- BAGIAN KATEGORI YANG DIUBAH ---
                Select::make('category')
                    ->label('Kategori')
                    ->options(function () {
                        // 1. Ambil data Peminatan (kolom title)
                        $peminatan = Peminatan::query()->pluck('title', 'title')->toArray();
                        
                        // 2. Opsi Manual
                        $manual = [
                            'Kegiatan' => 'Kegiatan', 
                            'Akademis' => 'Akademis'
                        ];
                        
                        // 3. Gabungkan
                        return $manual + $peminatan;
                    })
                    ->searchable()
                    ->required()
                    ->native(false),
                // -----------------------------------

                Select::make('grid_size')
                    ->label('Layout Grid')
                    ->options([
                        'medium' => 'Medium (Standar)',
                        'large'  => 'Large (Utama)',
                        'wide'   => 'Wide (Lebar)',
                    ])
                    ->default('medium')
                    ->required(),

                DatePicker::make('event_date')
                    ->label('Tanggal Kegiatan')
                    ->required()
                    ->default(now()),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktifkan')
                    ->required()
                    ->default(true),
            ]);
    }
}

