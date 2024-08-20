<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrGeneratorController extends Controller
{
    public function student($value, $format)
    {
        if ($format==='eps') {
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
                ->style('round')
                ->size(800)
                ->margin(2.5)
                ->gradient(100,100,55,100,100,255,'horizontal')
                ->backgroundColor(255,255,255,25)
                ->errorCorrection('H')
                ->generate($value);

            // Kembalikan QR code sebagai response gambar PNG
            return response($generate)->header('Content-Type', 'image/eps');
        } elseif ($format==='svg') {
            // Path ke file logo di storage
            $file_path = 'logo/santulitam-logo-qr.png';

            // Dapatkan path lengkap ke file logo
            // $path_logo = storage_path(assets($file_path));

            // Decode value dari URL
            $value = urldecode($value);

            // Generate QR code dengan logo yang di-merge
            $generate = QrCode::format('svg')
                ->merge($file_path, 0.2, true)
                // ->merge($path_logo, 0.2, true)
                ->style('round')
                ->size(800)
                ->margin(2.5)
                ->gradient(100,100,55,100,100,255,'horizontal')
                // ->backgroundColor(255,255,255,0)
                ->errorCorrection('H')
                ->generate($value);

            // Kembalikan QR code sebagai response gambar PNG
            return response($generate)->header('Content-Type', 'image/svg+xml');
        } else {
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
                ->style('round')
                ->size(800)
                ->margin(2.5)
                ->gradient(100,100,55,100,100,255,'horizontal')
                // ->backgroundColor(255,255,255,25)
                ->errorCorrection('H')
                ->generate($value);

            // Kembalikan QR code sebagai response gambar PNG
            return response($generate)->header('Content-Type', 'image/png');
        }
        
    }

    public function save($value)
    {
        // Path ke file logo di storage
        $file_path = 'logo/santulitam-logo-qr.png';

        // Dapatkan path lengkap ke file logo
        // $path_logo = storage_path(assets($file_path));

        // Decode value dari URL
        $value = urldecode($value);
        $en_value = base64_encode($value);
        $de_value = base64_decode($value);

        // Generate QR code dengan logo yang di-merge
        $generate = QrCode::format('png')
            ->merge($file_path, 0.2, true)
            // ->merge($path_logo, 0.2, true)
            ->style('round')
            ->size(800)
            ->margin(2.5)
            ->gradient(100,100,55,100,100,255,'horizontal')
            // ->backgroundColor(255,255,255,25)
            ->errorCorrection('H')
            ->generate($en_value);

        $output_file = 'public/qr-codes/QR-' . $value . '.png';

        $info = Storage::disk('local')->put($output_file, $generate); //storage/app/public/qr-codes/img-$value.png

        if($info){
            return redirect('/pendataan-peserta-karisma');
        } else {
            return redirect('/pendataan-peserta-karisma/create');
        }
        // Kembalikan QR code sebagai response gambar PNG
        // redirect('/pendataan-peserta-karisma');
        // redirect()->route('pendataan-peserta-karisma.index')->with(['success' => 'Data Berhasil Disimpan!']);

        // return response($generate)->header('Content-Type', 'image/png');

        // return $de_value;
    }
}
