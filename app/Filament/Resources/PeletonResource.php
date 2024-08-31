<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Peleton;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cofasilitator;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\PeletonResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PeletonResource\RelationManagers;

class PeletonResource extends Resource
{
    protected static ?string $model = Peleton::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('cofasilitator_id')
                    ->options(Cofasilitator::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cofasilitator_id')
                    ->label('Cofasilitator')
                    ->getStateUsing(function (Peleton $record) {
                        $cofasilitatorIds = explode(',', $record->cofasilitator_id);
                        return Cofasilitator::whereIn('id', $cofasilitatorIds)->pluck('name')->join(', ');
                    })
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPeletons::route('/'),
            'create' => Pages\CreatePeleton::route('/create'),
            'edit' => Pages\EditPeleton::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name')
                    ->label('Nama'),
                TextEntry::make('cofasiitator_id')
                    ->label('Cofasilitator')
                    ->getStateUsing(function (Peleton $record) {
                        $cofasilitatorIds = explode(',', $record->cofasilitator_id);
                        return Cofasilitator::whereIn('id', $cofasilitatorIds)->pluck('name')->join(', ');
                    })
            ]);
    }
}
