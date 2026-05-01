<?php

namespace App\Filament\Resources\KittenResource\Pages;

use App\Filament\Resources\KittenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKitten extends EditRecord
{
    protected static string $resource = KittenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
