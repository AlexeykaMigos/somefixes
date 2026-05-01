<?php

namespace App\Filament\Resources\KittenResource\Pages;

use App\Filament\Resources\KittenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKitten extends CreateRecord
{
    protected static string $resource = KittenResource::class;
}
