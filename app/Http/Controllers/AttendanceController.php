<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
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

        $student = Student::where('nim', $request->nim)->firstOrFail();

        // Cek apakah sudah ada kehadiran untuk NIM ini pada hari yang sama
        $existingAttendance = Attendance::where('student_id', $student->id)
            ->whereDate('check_in', now()->toDateString())
            ->exists();

        if ($existingAttendance) {
            Notification::make()
                ->title('Gagal')
                ->body('Data kehadiran untuk NIM ini sudah tercatat pada hari ini.')
                ->danger()
                ->send();

            return redirect()->back();
        }

        // Tentukan status berdasarkan waktu check-in
        $checkInTime = now();
        $status = $this->determineStatus($checkInTime);

        Attendance::create([
            'student_id' => $student->id,
            'theme_id' => $request->theme_id,
            'check_in' => $checkInTime,
            'status' => $status,
        ]);

        Notification::make()
            ->title('Berhasil')
            ->body('Attendance created successfully.')
            ->success()
            ->send();

        return redirect('/scaner');
    }

    /**
     * Tentukan status berdasarkan waktu check-in
     */
    private function determineStatus($checkInTime)
    {
        $checkInHour = $checkInTime->format('H');

        if ($checkInHour < 8) {
            return 'hadir';
        } elseif ($checkInHour < 9) {
            return 'terlambat';
        } else {
            return 'alfa';
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
}
