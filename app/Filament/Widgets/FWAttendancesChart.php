<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class FWAttendancesChart extends ChartWidget
{
    protected static ?string $heading = 'Attendances Status Chart';

    protected function getData(): array
    {
        // Tanggal 7 hari terakhir
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays(6);

        // Inisialisasi data
        $labels = [];
        $hadirData = [];
        $izinData = [];
        $sakitData = [];

        // Ambil data setiap hari untuk 7 hari terakhir
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $labels[] = $date->format('D'); // Hari singkat

            // Hitung jumlah status
            $hadirData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Hadir')->count();
            $izinData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Izin')->count();
            $sakitData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Sakit')->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Hadir',
                    'data' => $hadirData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Izin',
                    'data' => $izinData,
                    'backgroundColor' => 'rgba(255, 206, 86, 0.2)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Sakit',
                    'data' => $sakitData,
                    'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
