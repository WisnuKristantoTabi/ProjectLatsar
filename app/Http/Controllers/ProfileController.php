<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BidangModel;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\String_;

class ProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $bidang = BidangModel::all();
        $user = User::find($id);
        return view('profile.edit', compact(['bidang', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'nama' => 'required',
            'password' => 'nullable',
        ]);

        $user->update([
            'nama' => $request->nama,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,

        ]);
        return redirect()->route('dashboard')->with('success', 'Profile berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
