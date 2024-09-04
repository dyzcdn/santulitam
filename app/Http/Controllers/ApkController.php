<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApkController extends Controller
{
    public function index()
    {
        return view('apk');
    }

    public function download(Request $request)
    {
        $filePath1 = 'android/Sakaritam-Mobile-v1.0.0.apk';
        $filePath2 = 'android/Sakaritam-Lite-v.1.0.0.apk';

        // Cek apakah file ada di storage (disk 'public')
        if ($request->info == 1) {
            $filePath = $filePath1;
        } elseif($request->info == 0) {
            $filePath = $filePath2;
        } else {
            return redirect()->route('download-qr.index')->with('danger', 'QR dengan NIM tersebut tidak ditemukan.');
        }

        $fileName = basename($filePath); // Mendapatkan nama file dengan ekstensi
        $headers = [
            'Content-Type' => 'application/vnd.android.package-archive', // Menetapkan Content-Type khusus APK
        ];

        return Storage::disk('public')->download($filePath, $fileName, $headers);
    }
}
