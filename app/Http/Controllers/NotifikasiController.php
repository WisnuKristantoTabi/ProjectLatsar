<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notif = NotifikasiModel::where("user_id", $id)->get();
        return view("notifikasi.index", compact('notif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view("notifikasi.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user'       => 'required',
            'jenis'      => 'required',
            'pesan'      => 'required',
        ]);

        NotifikasiModel::create([
            'user_id'     => $request->user,
            'jenis'       => $request->jenis,
            'pesan'       => $request->pesan,
        ]);
        return redirect('/notif/' . $request->user . '/index')->with('success', 'Indikator berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notif = NotifikasiModel::where('notifikasi_id', $id)
            ->firstOrFail();

        if ($notif->status == 1) {
            $notif->update([
                'status' => 2
            ]);
        }
        return view("notifikasi.show", compact('notif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotifikasiModel $notifikasiModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotifikasiModel $notifikasiModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notif = NotifikasiModel::findOrFail($id);
        $notif->delete();
        // return redirect()->route('notif.index', $notif->notifikasi_id)->with('success', 'Data berhasil di hapus!');
        return redirect('/notif/' . $notif->user_id . '/index')->with('success', 'Data berhasil di hapus!');
    }

    public function baca($id)
    {
        $notifikasi = NotifikasiModel::where('notifikasi_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notifikasi->update([
            'status' => 2
        ]);

        // misalnya setelah klik diarahkan ke halaman tertentu
        return redirect()->route('notif.show', $id);
    }
}
