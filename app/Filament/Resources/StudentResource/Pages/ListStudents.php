<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Filament\Actions;
use App\Models\Student;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\StudentResource;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Filament\Support\Enums\ActionSize;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Student'),
            ImportAction::make()
            ->handleRecordCreation(function($data){
                return Student::create($data);
            }),
            ActionGroup::make([
                // Array of actions
            ])
                ->label('More actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size(ActionSize::Small)
                ->color('primary')
                ->button()
        ];
    }
}
