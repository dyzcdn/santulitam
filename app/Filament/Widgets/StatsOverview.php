<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Cofasilitator;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?string $heading = 'Students Statistic\'s';

    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $cofasilitators = Cofasilitator::count();
        $students = Student::count();

        $today = Carbon::today();
        $attendances = Attendance::whereDate('check_in', $today)->count();
        return [
            Stat::make('Cofasilitators', $cofasilitators)
                ->icon('heroicon-o-users')
                ->color('success')
                ->description('Count Total'),
            Stat::make('Students', $students)
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->description('Count Total'),
            Stat::make('Attendances', $attendances)
                ->icon('heroicon-o-clock')
                ->color('warning')
                ->description('Today'),
        ];
    }
}
