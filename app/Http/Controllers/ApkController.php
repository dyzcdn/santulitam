<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApkController extends Controller
{
    public function index()
    {
        // Ambil semua data student jika diperlukan di view
        // $students = Student::all();
        return view('apk');
    }

    public function download(Request $request)
    {

        $filePath1 = 'android/Sakaritam-Mobile-v1.0.0.apk';
        $filePath2 = 'android/Sakaritam-Lite-v.1.0.0.apk';

        // Cek apakah file ada di storage (disk 'public')
        if ($request->info == 1) {
            return Storage::disk('public')->download($filePath1);
        } elseif($request->info == 0) {
            return Storage::disk('public')->download($filePath2);
        } else {
            return redirect()->route('download-qr.index')->with('danger', 'QR dengan NIM tersebut tidak ditemukan.');
        }
    }
}
