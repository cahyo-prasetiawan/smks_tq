<?php

namespace App\Filament\Resources\Peminatans\Pages;

use App\Filament\Resources\Peminatans\PeminatanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePeminatan extends CreateRecord
{
    protected static string $resource = PeminatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
