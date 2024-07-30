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
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
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
                // ->uniqueField('name')
                // ->fields([
                //     ImportField::make('id')
                //         ->label('ID')
                //         ->required(),
                //     ImportField::make('name')
                //         ->required(),
                //     ImportField::make('nim')
                //         ->required(),
                //         // ->label('Category name'),
                //     ImportField::make('image')
                //         ->required(),
                //     ImportField::make('major.id')
                //         ->label('Major ID')
                //         ->required(),
                //     ImportField::make('email')
                //         ->required(),
                //     ImportField::make('phone')
                //         ->required(),
                //     ImportField::make('peleton.id')
                //         ->label('Peleton ID')
                //         ->required(),
                // ]),
                // ->handleRecordCreation(function(array $data) { 
                //     if ($category = StudentResource::getEloquentQuery()->where('name', $data['category']['name'])->first()) {
                //         return Item::create([
                //             'name' => $data['name'],
                //             'current_stock' => $data['stock'],
                //             'category_id' => $category->id,
                //         ]);
                //     }
 
                //     return new Item();
                // }),
                ExportAction::make() 
                ->exports([
                    ExcelExport::make()
                        // ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withColumns([
                            Column::make('id')
                                ->heading('ID'),
                            Column::make('name')
                                ->heading('Name'),
                            Column::make('nim')
                                ->heading('NIM'),
                            Column::make('image')
                                ->heading('Image'),
                            Column::make('major_id')
                                ->heading('Major ID'),
                            Column::make('email')
                                ->heading('Email'),
                            Column::make('phone')
                                // ->format(DataType::TYPE_STRING)
                                ->heading('Phone'),
                            Column::make('peleton_id')
                                ->heading('Peleton ID'),
                        ])
                ]),
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
