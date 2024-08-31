<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SearchQRController extends Controller
{
    public function index()
    {
        // Ambil semua data student jika diperlukan di view
        $students = Student::all();
        return view('searchqr', compact('students'));
    }

    public function download(Request $request)
    {
        // Validasi input NIM
        $request->validate([
            'nim' => 'required|string'
        ]);

        // Tentukan path file QR berdasarkan NIM
        $filePath = 'qr-codes/QR-' . $request->nim . '.png';

        // Cek apakah file ada di storage (disk 'public')
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return redirect()->route('download-qr.index')->with('danger', 'QR dengan NIM tersebut tidak ditemukan.');
        }
    }

    public function idcard()
    {
        // Ambil semua data student jika diperlukan di view
        $students = Student::all();
        return view('idcard', compact('students'));
    }

    public function idcarddownload(Request $request)
    {
        // Validasi input NIM
        $request->validate([
            'nim' => 'required|string'
        ]);

        // Cek apakah NIM terdaftar di database Student
        $student = Student::where('nim', $request->nim)->first();

        if (!$student) {
            return redirect()->route('download-idcard.index')->with('danger', 'Download ID Card gagal. Silahkan registrasi peserta terlebih dahulu.');
        }

        // Tentukan path file ID Card berdasarkan NIM
        $filePath1 = 'idcard/depan.png';
        $filePath2 = 'idcard/belakang.png';
        $filePath3 = 'qr-codes/QR-' . $request->nim . '.png';
        $filePath4 = 'images/' . $request->nim . '.jpeg';

        // Tentukan nama file zip yang akan diunduh
        $zipFileName = 'idcard_' . $request->nim . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        // Buat file ZIP dan masukkan kedua file ID Card
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            if (Storage::disk('public')->exists($filePath1)) {
                $zip->addFile(storage_path('app/public/' . $filePath1), 'depan.png');
            }

            if (Storage::disk('public')->exists($filePath2)) {
                $zip->addFile(storage_path('app/public/' . $filePath2), 'belakang.png');
            }

            if (Storage::disk('public')->exists($filePath3)) {
                $zip->addFile(storage_path('app/public/' . $filePath3), 'QR-'.$request->nim.'.png');
            }

            if (Storage::disk('public')->exists($filePath4)) {
                $zip->addFile(storage_path('app/public/' . $filePath4), 'ImageID-'.$request->nim.'.jpeg');
            }

            $zip->close();

            // Unduh file ZIP
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->route('download-idcard.index')->with('danger', 'Download ID Card gagal.');
        }
    }
}
