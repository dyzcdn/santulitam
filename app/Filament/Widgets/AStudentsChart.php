<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class AStudentsChart extends ChartWidget
{
    protected static ?string $heading = 'Students Statistic\'s';

    protected function getData(): array
    {
        // Tanggal 7 hari terakhir
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays(6); // 6 hari sebelum hari ini

        // Mengambil jumlah mahasiswa per hari selama 7 hari terakhir
        $data = [];
        $labels = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $count = Student::whereDate('created_at', $formattedDate)->count();
            $labels[] = $date->format('D'); // Format hari singkat (Sun, Mon, Tue, ...)
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Students Registered',
                    'data' => $data,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
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