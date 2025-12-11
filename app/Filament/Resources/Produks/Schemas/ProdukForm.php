<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use App\Models\Produk;
use App\Models\Peminatan; 
use Illuminate\Support\Str;
use Filament\Forms\Components\Select; // Tambahan untuk Dropdown

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
    TextInput::make('name')
        ->label('Nama Produk')
        ->required()
        ->maxLength(255)
        ->live(onBlur: true)
        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

    TextInput::make('slug')
        ->required()
        ->disabled()
        ->dehydrated()
        ->unique(Produk::class, 'slug', ignoreRecord: true),

    Select::make('category')
                    ->label('Kategori')
                    ->options(function () {
                       $peminatan = Peminatan::query()->pluck('title', 'title')->toArray();
                
                        return $peminatan;
                    })
                    ->searchable()
                    ->required()
                    ->native(false),

    TextInput::make('price')
        ->label('Harga')
        ->placeholder('-')
        ->numeric()
        ->prefix('Rp'),

  
         Select::make('unit')
            ->label('Satuan')
            ->options([
            '/pcs' => 'pcs',
            '/paket' => 'paket',
            '/meter' => 'meter',
            
        ])
        ->searchable()
        ->native(false),
                 

    FileUpload::make('image')
        ->label('Foto Produk')
        ->image()
        ->disk('public')
        ->directory('produk-foto')
        ->maxSize(2048)
        ->columnSpanFull(),

    Textarea::make('description')
        ->label('Deskripsi Singkat')
        ->rows(3)
        ->columnSpanFull(),

    Toggle::make('is_active')
        ->label('Tampilkan di Website?')
        ->default(true)
        ->required()
        ->onColor('success')
        ->offColor('danger'),
]);
    }
}
