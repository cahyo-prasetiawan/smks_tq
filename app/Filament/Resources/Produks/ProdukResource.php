<?php

namespace App\Filament\Resources\Produks;

use App\Filament\Resources\Produks\Pages\CreateProduk;
use App\Filament\Resources\Produks\Pages\EditProduk;
use App\Filament\Resources\Produks\Pages\ListProduks;
use App\Filament\Resources\Produks\Schemas\ProdukForm;
use App\Filament\Resources\Produks\Tables\ProduksTable;
use App\Models\Produk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem; 
use Filament\Navigation\NavigationLabel;
use Filament\Navigation\NavigationSection;
use Filament\Navigation\NavigationBuilder;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // Tambahkan deklarasi tipe data yang ketat: UnitEnum|string|null
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Data'; 

    // Opsi yang lebih sederhana (dan seringkali berfungsi):
    // protected static ?string $navigationGroup = 'Manajemen Konten'; 

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box-arrow-down'; 
    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ProdukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProduks::route('/'),
            'create' => CreateProduk::route('/create'),
            'edit' => EditProduk::route('/{record}/edit'),
        ];
    }
}
