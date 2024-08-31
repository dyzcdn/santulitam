<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Cofasilitator;
use App\Models\Peleton;
use Illuminate\Support\Facades\Hash;

class CofasilitatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $cofasilitators = Cofasilitator::all();
        return view('cofasilitator', compact('users','cofasilitators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $cofasilitators = Cofasilitator::all();
        return view('cofasilitator', compact('users','cofasilitators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,bail',
            'nim'           => 'required|min:8|unique:cofasilitators,nim,bail',
            'email'         => 'required|email|unique:users,email,bail',
            'password'      => 'required|string|min:8|',
            'peleton'       => 'required|string|max:255',
        ]);

        $user = User::create([
            'name'          => Str::title($request->name),
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        $cofasilitator = Cofasilitator::create([
            'name'          => Str::title($request->name),
            'nim'           => $request->nim,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'user_id'       => $user->id,
        ]);

        // Check if the peleton already exists
        $peleton = Peleton::where('name', $request->peleton)->first();

        if ($peleton) {
            // If peleton exists, update cofasilitator_id array
            $currentCofasilitatorIds = explode(',', $peleton->cofasilitator_id);
            $currentCofasilitatorIds[] = $cofasilitator->id;
            $peleton->cofasilitator_id = implode(',', $currentCofasilitatorIds);
            $peleton->save();
        } else {
            // If peleton does not exist, create a new one
            Peleton::create([
                'name'              => $request->peleton,
                'cofasilitator_id'  => $cofasilitator->id,
            ]);
        }

        $role = ['name' => 'Cofas'];
        $user->assignRole($role);

        if ($cofasilitator) {
            return redirect()->route('pendataan-cofasilitator.index')->with('success', 'Data cofasilitator berhasil disimpan.');
        } else {
            return redirect()->route('pendataan-cofasilitator.index')->with('danger', 'Data cofasilitator Gagal Disimpan!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Cofasilitator $cofasilitator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cofasilitator $cofasilitator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cofasilitator $cofasilitator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cofasilitator $cofasilitator)
    {
        //
    }
}
