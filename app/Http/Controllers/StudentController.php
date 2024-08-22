<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Peleton;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $majors = Major::all();
        $peletons = Peleton::all();
        return view('student', compact('majors', 'peletons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $majors = Major::all();
        $peletons = Peleton::all();
        return view('student', compact('majors', 'peletons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $this->validate($request, [
            'name'          => 'required',
            'nim'           => 'required|min:5',
            'major_id'      => 'required',
            'peleton_id'    => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file foto
        ]);

        // Mengunggah file foto
        if ($request->file('image')) {
            $image = $request->file('image');
            $fileName = $request->nim . '.jpeg'; // Simpan sebagai JPEG
            $directory = 'public/images';
            $filePath = storage_path('app/' . $directory . '/' . $fileName);

            // Cek apakah direktori ada, jika tidak maka buat direktori tersebut
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Mengubah dan menyimpan gambar
            try {
                $imageResource = $this->createImageResource($image);
                if ($imageResource === false) {
                    return redirect()->back()->with('danger', 'Gagal memproses gambar, data tidak disimpan.');
                }

                // Simpan gambar sebagai JPEG
                imagejpeg($imageResource, $filePath, 90); // Kualitas 90
                imagedestroy($imageResource); // Hapus resource gambar dari memori
            } catch (\Exception $e) {
                return redirect()->back()->with('danger', 'Gagal menyimpan foto, data tidak disimpan. Kesalahan: ' . $e->getMessage());
            }
        }

        // Menyimpan data ke database
        $student = Student::create([
            'name'          => Str::title($request->name),
            'nim'           => $request->nim,
            'major_id'      => $request->major_id,
            'peleton_id'    => $request->peleton_id,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'image'         => $fileName ?? null, // Menyimpan nama file foto jika ada
        ]);

        if ($student) {
            return redirect('/qr/student/' . $student->nim)->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('pendataan-peserta-karisma.index')->with('danger', 'Data Gagal Disimpan!');
        }
    }


    /**
     * Membuat resource gambar dari file input.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return resource|false
     */
    private function createImageResource($file)
    {
        $image = null;
        $extension = $file->getClientOriginalExtension();

        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($file->getPathname());
                break;
            case 'png':
                $image = imagecreatefrompng($file->getPathname());
                break;
            case 'gif':
                $image = imagecreatefromgif($file->getPathname());
                break;
            default:
                return false;
        }

        return $image;
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
