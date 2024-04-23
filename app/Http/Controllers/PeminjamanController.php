<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use Illuminate\Support\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.peminjaman', [
            'data' => Peminjaman::where('history', null)->get(),
            'Sbuku' => Buku::where('stok', '>', 0)
                            ->whereHas('kategori', function ($query) {
                                $query->where('status', 'aktif');
                            })->get(),
            'Suser' => User::where('role', 'user')->where('status', 'aktif')->get()
        ]);
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
    public function store(StorePeminjamanRequest $request)
    {
        $validated = $request->validated();
        $validated['admin_id'] = auth()->user()->id;
        $validated['detail_buku_id'] = $request->buku_id;
        $validated['tanggal_peminjaman'] = Carbon::now();

        Peminjaman::create($validated);

        $detailBuku = DetailBuku::where('buku_id', $request->buku_id)
                                ->where('status', 'Tersedia')
                                ->first();
        $detailBuku->update(['status' => 'Tidak Tersedia']);

        return redirect()->back()->with('added', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        return view('pages.peminjaman-show', [
            'pinjam' => $peminjaman
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeminjamanRequest $request, Peminjaman $peminjaman)
    {
        $detailBuku = DetailBuku::where('buku_id', $peminjaman->buku->id)
                                ->where('status', 'Tidak Tersedia')
                                ->first();
        $detailBuku->update(['status' => 'Tersedia']);

        $peminjaman->update([
            'history' => 1,
            'tanggal_pengembalian' => Carbon::now()
        ]);
        
        return redirect()->back()->with('saved', "Peminjaman {$peminjaman->user->nama} telah selesai");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->back()->with('deleted', 'Data arsip berhasil dihapus');
    }

    public function history()
    {
        $user = (auth()->user()->role == "user") ? 'user' : '';

        if($user) {
            $data = Peminjaman::where('user_id', auth()->user()->id)
                                ->orderBy('id', 'desc')
                                ->get();
        }
        else {
            $data = Peminjaman::all();
        }

        return view('pages.history', [
            'data' => $data
        ]);
    }
}
