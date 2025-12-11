<?php

namespace App\Filament\Resources\Beritas;

use App\Filament\Resources\Beritas\Pages\CreateBerita;
use App\Filament\Resources\Beritas\Pages\EditBerita;
use App\Filament\Resources\Beritas\Pages\ListBeritas;
use App\Filament\Resources\Beritas\Pages\ViewBerita;
use App\Filament\Resources\Beritas\Schemas\BeritaForm;
use App\Filament\Resources\Beritas\Schemas\BeritaInfolist;
use App\Filament\Resources\Beritas\Tables\BeritasTable;
use App\Models\Berita;
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

class BeritaResource extends Resource
{
   protected static ?string $model = Berita::class;

    // Tambahkan deklarasi tipe data yang ketat: UnitEnum|string|null
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten'; 

    // Opsi yang lebih sederhana (dan seringkali berfungsi):
    // protected static ?string $navigationGroup = 'Manajemen Konten'; 

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper'; 
    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return BeritaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BeritaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeritasTable::configure($table);
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
            'index' => ListBeritas::route('/'),
            'create' => CreateBerita::route('/create'),
            'view' => ViewBerita::route('/{record}'),
            'edit' => EditBerita::route('/{record}/edit'),
        ];
    }
}
