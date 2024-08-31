<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HWAttendancesOverview extends BaseWidget
{
    protected static ?string $heading = 'Attendances Statistic\'s';

    protected function getStats(): array
    {
        // Hitung jumlah dari setiap status kehadiran
        $statuses = [
            'Hadir' => Attendance::where('status', 'Hadir')->count(),
            'Izin' => Attendance::where('status', 'Izin')->count(),
            'Sakit' => Attendance::where('status', 'Sakit')->count(),
            'Terlambat' => Attendance::where('status', 'Terlambat')->count(),
            'Sangat Terlambat' => Attendance::where('status', 'Sangat Terlambat')->count(),
            'Tidak Hadir' => Attendance::where('status', 'Tidak Hadir')->count(),
        ];

        return [
            Stat::make('Present', $statuses['Hadir'])
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->description('Total Present'),
            Stat::make('Permissions', $statuses['Izin'])
                ->icon('heroicon-o-exclamation-circle')
                ->color('info')
                ->description('Total Permissions'),
            Stat::make('Pain', $statuses['Sakit'])
                ->icon('heroicon-o-face-frown') //heroicon-o-emoji-sad
                ->color('warning')
                ->description('Total Pain'),
            Stat::make('Late', $statuses['Terlambat'])
                ->icon('heroicon-o-clock')
                ->color('danger')
                ->description('Total Late'),
            Stat::make('Very Late', $statuses['Sangat Terlambat'])
                ->icon('heroicon-o-stop-circle') //heroicon-o-ban
                ->color('danger')
                ->description('Very Late Total'),
            Stat::make('Absent', $statuses['Tidak Hadir'])
                ->icon('heroicon-o-x-circle')
                ->color('gray')
                ->description('Total Absent'),
        ];
    }
}
