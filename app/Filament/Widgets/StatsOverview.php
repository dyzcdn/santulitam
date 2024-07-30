<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Cofasilitator;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $mentors = Cofasilitator::count();
        $students = Student::count();
        $averageTimeOnPage = '3:12';
        return [
            Stat::make('Mentors', $mentors)
                ->icon('heroicon-o-users')
                ->color('success')
                ->description('Last 30 days'),
            Stat::make('Students', $students)
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->description('Last 30 days'),
            Stat::make('Average time on page', '3:12')
                ->icon('heroicon-o-clock')
                ->color('warning')
                ->description('Last 30 days'),
        ];
    }
}
