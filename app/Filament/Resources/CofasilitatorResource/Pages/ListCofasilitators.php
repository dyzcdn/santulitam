<?php

namespace App\Filament\Resources\CofasilitatorResource\Pages;

use App\Filament\Resources\CofasilitatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCofasilitators extends ListRecords
{
    protected static string $resource = CofasilitatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
