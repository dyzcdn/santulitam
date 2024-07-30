<?php

namespace App\Filament\Resources\PeletonResource\Pages;

use App\Filament\Resources\PeletonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeletons extends ListRecords
{
    protected static string $resource = PeletonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Peleton'),
        ];
    }
}
