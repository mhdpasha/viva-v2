<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\Kategori;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.buku', [
            'data' => Buku::with('kategori')->get(),
            'select' => Kategori::all()
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
    public function store(StoreBukuRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = ($request->image) ? $request->image : 'https://cdn3d.iconscout.com/3d/premium/thumb/book-5596349-4665465.png';

        $buku = Buku::create($validated);


        $stok = $validated['stok'];
        $serial = strtoupper(substr($validated['judul'], 0, 1));
        $kategori = $validated['kategori_id'];

        for($i=0; $i < $stok; $i++ ) 
        {
            $data = [
                'buku_id' => $buku->id,
                'status' => 'Tersedia',
                'serial_num' => "AR-{$serial}" . "-{$kategori}-" . "BOOK-" . $i + 1 . "-" . Str::orderedUuid()
            ];
            DetailBuku::create($data);
        }

        return redirect()->back()->with('added', "Buku {$request->judul} berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        $stok = DetailBuku::where('buku_id', $buku->id)->get();

        return view('pages.buku-show', [
            'buku' => $buku,
            'stok' => $stok
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBukuRequest $request, Buku $buku)
    {
        $validated = $request->validated();
        $validated['image'] = ($request->image) ? $request->image : 'https://cdn3d.iconscout.com/3d/premium/thumb/book-5596349-4665465.png';

        $buku->update($validated);

    
        $stok = DetailBuku::where('buku_id', $buku->id)->count();
        $serial = strtoupper(substr($validated['judul'], 0, 1));
        $kategori = $validated['kategori_id'];

        if($request->stok > $stok) {
            $surplus = $request->stok - $stok;
            
            for ($i = 0; $i < $surplus; $i++) {
                DetailBuku::create([
                    'buku_id' => $buku->id,
                    'status' => 'Tersedia',
                    'serial_num' => "AR-{$serial}-{$kategori}-BOOK-" . ($stok + $i + 1) . "-" . Str::orderedUuid()
                ]);
            }

            return redirect()->back()->with('saved', 'Buku berhasil di-update, Stok telah ditambah');
        }
        else if($request->stok == $stok) {

            return redirect()->back()->with('saved', 'Buku berhasil di-update');
        }
        else {
            $surplus = $stok - $request->stok;
            $details = DetailBuku::where('buku_id', $buku->id)->orderBy('id', 'desc')->limit($surplus)->get();
            
            foreach($details as $detail) {
                $detail->delete();
            }
            
            return redirect()->back()->with('saved', 'Buku berhasil di-update, Stok telah dikurangi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        $detail = DetailBuku::where('buku_id', $buku->id)->get();

        foreach($detail as $buku) {
            $buku->delete();
        }

        return redirect()->back()->with('deleted', 'Buku telah di-delete');
    }
}
