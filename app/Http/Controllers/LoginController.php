<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    // public function postLogin(Request $request): RedirectResponse
    // {

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            session([
                'username' => $user->username,
                'nama'  => $user->nama,
                'role'     => $user->role,
                'userid' => $user->user_id,
                'bidang'   => $user->bidang_id,
            ]);
            // print_r(session()->all());

            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        // return redirect("login")->withError('Oppes! You have entered invalid credentials');
        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah atau akun tidak ditemukan.',
        ])->withInput();
        // print_r($credentials);
    }

    public function logout(Request $request)
    {
        Auth::logout();                         // hapus auth user
        $request->session()->invalidate();      // hapus semua session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect('/login')->withSuccess('Anda berhasil logout');
    }
}
