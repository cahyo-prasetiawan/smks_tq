<?php

namespace App\Filament\Resources\Galeries;

use App\Filament\Resources\Galeries\Pages\CreateGalery;
use App\Filament\Resources\Galeries\Pages\EditGalery;
use App\Filament\Resources\Galeries\Pages\ListGaleries;
use App\Filament\Resources\Galeries\Schemas\GaleryForm;
use App\Filament\Resources\Galeries\Tables\GaleriesTable;
use App\Models\Galery;
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

class GaleryResource extends Resource
{
    protected static ?string $model = Galery::class;
    
    // Tambahkan deklarasi tipe data yang ketat: UnitEnum|string|null
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten'; 

    // Opsi yang lebih sederhana (dan seringkali berfungsi):
    // protected static ?string $navigationGroup = 'Manajemen Konten'; 

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo'; 
    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema
    {
        return GaleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GaleriesTable::configure($table);
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
            'index' => ListGaleries::route('/'),
            'create' => CreateGalery::route('/create'),
            'edit' => EditGalery::route('/{record}/edit'),
        ];
    }
}
