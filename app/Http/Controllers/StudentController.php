<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Peleton;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        return view('student', compact('majors','peletons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $majors = Major::all();
        $peletons = Peleton::all();
        return view('student', compact('majors','peletons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'name'          => 'required',
            'nim'           => 'required|min:5',
            'major_id'      => 'required',
            'peleton_id'    => 'required',
            'email'         => 'required',
            'phone'         => 'required'
        ]);

        $student = Student::create([
            'name'          => Str::title($request->name),
            'nim'           => $request->nim,
            'major_id'      => $request->major_id,
            'peleton_id'    => $request->peleton_id,
            'email'         => $request->email,
            'phone'         => $request->phone
        ]);

        if ($student) {
            return redirect('/qr/student/' . $student->nim)->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('pendataan-peserta-karisma.index')->with('danger', 'Data Gagal Disimpan!');
        }

        // return redirect('/qr/student/' . $request->nim)->with(['success' => 'Data Berhasil Disimpan!']);
        // return redirect()->route('pendataan-peserta-karisma.create')->with(['success' => 'Data Berhasil Disimpan!']);
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
