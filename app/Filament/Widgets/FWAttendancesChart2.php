<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class FWAttendancesChart2 extends ChartWidget
{
    protected static ?string $heading = 'Late and Absent Status Chart';

    protected function getData(): array
    {
        // Tanggal 7 hari terakhir
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays(6);

        // Inisialisasi data
        $labels = [];
        $terlambatData = [];
        $sangatTerlambatData = [];
        $tidakHadirData = [];

        // Ambil data setiap hari untuk 7 hari terakhir
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $labels[] = $date->format('D'); // Hari singkat

            // Hitung jumlah status
            $terlambatData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Terlambat')->count();
            $sangatTerlambatData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Sangat Terlambat')->count();
            $tidakHadirData[] = Attendance::whereDate('check_in', $formattedDate)->where('status', 'Tidak Hadir')->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Terlambat',
                    'data' => $terlambatData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Sangat Terlambat',
                    'data' => $sangatTerlambatData,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Tidak Hadir',
                    'data' => $tidakHadirData,
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
        return 'line';
    }
}
