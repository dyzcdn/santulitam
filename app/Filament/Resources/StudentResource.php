<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Forms\Form;
use Actions\CreateAction;
use Filament\Tables\Table;
use App\Imports\MyStudentImport;
use Filament\Resources\Resource;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'fas-people-group';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nim')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\FileUpload::make('image')
                //     ->image(),
                Forms\Components\Select::make('major_id')
                    ->relationship('major', 'name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('peleton_id')
                ->relationship('peleton', 'name')
                ->required(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->slideOver()
                ->color("primary")
                ->use(MyStudentImport::class),
            CreateAction::make(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('qr')
                    ->defaultImageUrl(fn(Student $record) => url('/qr/student\/') . $record->nim),
                Tables\Columns\TextColumn::make('major.name')
                    ->description(fn(Student $record) => $record->major->faculty->name)
                    ->label('Major')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('peleton.nama')
                    ->label('Peleton')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
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
                    ]),                
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
            // ActionGroup::make([
            //     'QR' => Pages\QR::route('/qr'),
            // ])
            //     ->label('More actions')
            //     ->icon('heroicon-m-ellipsis-vertical')
            //     ->size(ActionSize::Small)
            //     ->color('primary')
            //     ->button()
        ];
    }
}
