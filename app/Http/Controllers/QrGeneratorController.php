<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrGeneratorController extends Controller
{
    public function student($value)
    {
        // Path ke file logo di storage
        $file_path = 'logo/santulitam-logo-qr.png';

        // Dapatkan path lengkap ke file logo
        // $path_logo = storage_path(assets($file_path));

        // Decode value dari URL
        $value = urldecode($value);

        // Generate QR code dengan logo yang di-merge
        $generate = QrCode::format('png')
            ->merge($file_path, 0.2, true)
            // ->merge($path_logo, 0.2, true)
            ->size(800)
            ->margin(1)
            ->generate($value);

        // Kembalikan QR code sebagai response gambar PNG
        return response($generate)->header('Content-Type', 'image/png');
    }
}
