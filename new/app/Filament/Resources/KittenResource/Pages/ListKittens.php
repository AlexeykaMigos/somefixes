<?php

namespace App\Filament\Resources\KittenResource\Pages;

use App\Filament\Resources\KittenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKittens extends ListRecords
{
    protected static string $resource = KittenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
