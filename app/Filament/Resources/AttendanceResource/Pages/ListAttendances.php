<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\FWAttendancesChart;
use App\Filament\Widgets\FWAttendancesChart2;
use App\Filament\Resources\AttendanceResource;
use App\Filament\Widgets\HWAttendancesOverview;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        $decodeQueryString = urldecode(request()->getQueryString());

        return [
            Actions\Action::make('export')
                ->url(url('/attendances-export?' . $decodeQueryString))
                ->color('warning')
                ->icon('heroicon-o-arrow-down-on-square'),
            Actions\CreateAction::make()->label('New Attendance')->icon('heroicon-o-squares-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            HWAttendancesOverview::class,
            FWAttendancesChart::class,
            FWAttendancesChart2::class,
        ];
    }
}
