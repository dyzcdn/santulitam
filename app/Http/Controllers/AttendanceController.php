<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\ExportAttendance;
use App\Models\Peleton;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'theme_id' => 'required',
        ]);

        // Cari mahasiswa berdasarkan NIM
        $student = Student::where('nim', $request->nim)->first();

        if (!$student) {
            // Jika NIM tidak ditemukan, tampilkan notifikasi
            Notification::make()
                ->title('NIM not available')
                ->danger()
                ->body('Sorry, the this NIM is not registered.')
                ->send();

            return redirect()->back();
        }

        // Cek apakah sudah ada kehadiran untuk NIM ini pada hari yang sama
        $existingAttendance = Attendance::where('student_id', $student->id)
            ->whereDate('check_in', now()->toDateString())
            ->exists();

        if ($existingAttendance) {
            Notification::make()
                ->title('Failed')
                ->body('Attendance data for this NIM was recorded today.')
                ->danger()
                ->send();

            return redirect()->route('filament..pages.scaner');
        }

        // Tentukan status berdasarkan waktu check-in
        $checkInTime = now();
        $status = $this->determineStatus($checkInTime);

        Attendance::create([
            'student_id' => $student->id,
            'theme_id' => $request->theme_id,
            'peleton_id' => $request->peleton_id,
            'check_in' => $checkInTime,
            'status' => $status,
        ]);

        Notification::make()
            ->title('Success')
            ->body('Attendance has check in successfully.')
            ->success()
            ->send();

        return redirect()->route('filament..pages.scaner');
    }

    /**
     * Tentukan status berdasarkan waktu check-in
     */
    private function determineStatus($checkInTime)
    {
        $checkInHour = $checkInTime->format('H');

        if ($checkInHour < 7) {
            return 'Hadir';
        } elseif ($checkInHour < 9) {
            return 'Terlambat';
        } else {
            return 'Sangat Terlambat';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function export()
    {
        $peletonId = request('tableFilters.peleton_id.value');
        $themeId = request('tableFilters.theme_id.value');
        $checkInFrom = request('tableFilters.check_in.check_in_from');
        $checkInUntil = request('tableFilters.check_in.check_in_until');

        // Ambil nama peleton, jika diperlukan untuk nama file
        $peleton = Peleton::find($peletonId);
        if (!$peleton && $peletonId) {
            // Tangani kasus jika peleton tidak ditemukan
            Notification::make()
                ->title('Peleton not found')
                ->danger()
                ->body('The specified Peleton ID does not exist.')
                ->send();

            return redirect()->back();
        }

        // Format nama file dengan nama peleton atau default
        $filename = 'Attendances-' . ($peleton ? $peleton->name : 'All') . '-' . date('ymdHis') . '.xlsx';

        return Excel::download(new ExportAttendance($peletonId, $themeId, $checkInFrom, $checkInUntil), $filename);
    }
}
