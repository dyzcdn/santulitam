<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Peleton;
use App\Models\Theme;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAttendance implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Cek apakah ID peleton ada
        if (!$this->id) {
            // Jika tidak ada ID peleton, ambil semua data kehadiran
            return Attendance::with('student', 'peleton', 'theme')->get();
        } else {
            // Jika ID peleton ada, ambil data dengan filter berdasarkan ID
            return Attendance::with('student', 'peleton', 'theme')
                ->where('peleton_id', $this->id)
                ->get();
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Student Name',
            'Peleton Name',
            'Theme Name',
            'Check In',
            'Status',
        ];
    }

    /**
     * @param $attendance
     * @return array
     */
    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->student ? $attendance->student->name : 'N/A',
            $attendance->peleton ? $attendance->peleton->name : 'N/A',
            $attendance->theme ? $attendance->theme->name : 'N/A',
            $attendance->check_in,
            $attendance->status,
        ];
    }
}
