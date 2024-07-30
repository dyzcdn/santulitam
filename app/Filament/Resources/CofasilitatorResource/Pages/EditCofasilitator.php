<?php

namespace App\Filament\Resources\CofasilitatorResource\Pages;

use App\Filament\Resources\CofasilitatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCofasilitator extends EditRecord
{
    protected static string $resource = CofasilitatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
