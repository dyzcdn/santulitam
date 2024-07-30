<?php

namespace App\Filament\Resources\PeletonResource\Pages;

use App\Filament\Resources\PeletonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeleton extends EditRecord
{
    protected static string $resource = PeletonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
