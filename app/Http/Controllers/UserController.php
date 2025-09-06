<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BidangModel;
use Database\Seeders\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Soap\Url;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('bidang')->get();
        return view('user.index', compact('users'));
        // return User::with('bidang')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidang = BidangModel::all();
        return view('user.create', compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'bidang' => 'required',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            // print(bcrypt($request->password));
            'role' => $request->role,
            'bidang_id' => $request->bidang,

        ]);
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
        // echo $request->nama;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $bidang = BidangModel::all();
        return view('user.edit', compact(['bidang', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // print_r($user->user_id);
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $user->user_id . ',user_id',
            'password' => 'nullable',
            'role' => 'required',
            'bidang' => 'required',
        ]);

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
            // print(bcrypt($request->password));
            'role' => $request->role,
            'bidang_id' => $request->bidang,

        ]);
        return redirect()->route('user.index')->with('success', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User ' . $user->nama . ' berhasil di hapus!');
    }
}
