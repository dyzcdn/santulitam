<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        $decodeQueryString = urldecode(request()->getQueryString());

        return [
            Actions\Action::make('export')
                ->url(url('/attendances-export?' . $decodeQueryString)),
            Actions\CreateAction::make()->label('New Attendance'),
        ];
    }
}
