<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Pages\Scan;
use App\Filament\Widgets\HWAttendancesOverview;

class Scaner extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.scan';

    protected function getFooterWidgets(): array
    {
        return [
            HWAttendancesOverview::class,
        ];
    }
}
