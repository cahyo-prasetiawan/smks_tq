<?php

namespace App\Filament\Resources\Peminatans\Pages;

use App\Filament\Resources\Peminatans\PeminatanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPeminatan extends EditRecord
{
    protected static string $resource = PeminatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
