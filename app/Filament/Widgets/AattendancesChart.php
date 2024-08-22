<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class AattendancesChart extends ChartWidget
{
    protected static ?string $heading = 'Attendances Statistic\'s';

    protected function getData(): array
    {
        // Tanggal 7 hari terakhir
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays(6); // 6 hari sebelum hari ini

        // Mengambil jumlah kehadiran per hari selama 7 hari terakhir
        $data = [];
        $labels = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $count = Attendance::whereDate('check_in', $formattedDate)->count();
            $labels[] = $date->format('D'); // Format hari singkat (Sun, Mon, Tue, ...)
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Attendances',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Jenis grafik: garis
    }
}
