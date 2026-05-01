<?php

namespace App\Filament\Resources\LitterResource\Pages;

use App\Filament\Resources\LitterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLitters extends ListRecords
{
    protected static string $resource = LitterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('+ New Litter'),
        ];
    }
}
