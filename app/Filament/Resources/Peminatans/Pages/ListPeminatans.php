<?php

namespace App\Filament\Resources\Peminatans\Pages;

use App\Filament\Resources\Peminatans\PeminatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeminatans extends ListRecords
{
    protected static string $resource = PeminatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
