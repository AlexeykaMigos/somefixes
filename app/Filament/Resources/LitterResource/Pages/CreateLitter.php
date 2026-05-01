<?php

namespace App\Filament\Resources\LitterResource\Pages;

use App\Filament\Resources\LitterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLitter extends CreateRecord
{
    protected static string $resource = LitterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
