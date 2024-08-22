<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            return redirect()->route('download-qr.index')->with('danger', 'File QR dengan NIM tersebut tidak ditemukan.');
        }
    }
}
