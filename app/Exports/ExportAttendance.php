<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAttendance implements FromCollection, WithHeadings, WithMapping
{
    protected $peletonId;
    protected $themeId;
    protected $checkInFrom;
    protected $checkInUntil;

    public function __construct($peletonId = null, $themeId = null, $checkInFrom = null, $checkInUntil = null)
    {
        $this->peletonId = $peletonId;
        $this->themeId = $themeId;
        $this->checkInFrom = $checkInFrom;
        $this->checkInUntil = $checkInUntil;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Attendance::with('student', 'peleton', 'theme');

        if ($this->peletonId) {
            $query->where('peleton_id', $this->peletonId);
        }

        if ($this->themeId) {
            $query->where('theme_id', $this->themeId);
        }

        if ($this->checkInFrom) {
            $query->whereDate('check_in', '>=', $this->checkInFrom);
        }

        if ($this->checkInUntil) {
            $query->whereDate('check_in', '<=', $this->checkInUntil);
        }

        return $query->get();
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
