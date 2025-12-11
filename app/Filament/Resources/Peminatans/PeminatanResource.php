<?php

namespace App\Filament\Resources\Peminatans;

use App\Filament\Resources\Peminatans\Pages\CreatePeminatan;
use App\Filament\Resources\Peminatans\Pages\EditPeminatan;
use App\Filament\Resources\Peminatans\Pages\ListPeminatans;
use App\Filament\Resources\Peminatans\Schemas\PeminatanForm;
use App\Filament\Resources\Peminatans\Tables\PeminatansTable;
use App\Models\Peminatan;
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

class PeminatanResource extends Resource
{
    protected static ?string $model = Peminatan::class;

    // Tambahkan deklarasi tipe data yang ketat: UnitEnum|string|null
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Data'; 

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library'; 
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return PeminatanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeminatansTable::configure($table);
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
            'index' => ListPeminatans::route('/'),
            'create' => CreatePeminatan::route('/create'),
            'edit' => EditPeminatan::route('/{record}/edit'),
        ];
    }
}
