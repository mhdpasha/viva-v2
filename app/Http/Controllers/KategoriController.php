<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.kategori', [
            'data' => Kategori::where('deleted', null)->get()
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
    public function store(StoreKategoriRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = 'aktif';

        Kategori::create($validated);
        return redirect()->back()->with("added", "Kategori {$request->nama} berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $validated =$request->validated();
        $kategori->update($validated);
        
        return redirect()->back()->with('saved', 'Item berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->update([
            'status' => 'non-aktif',
            'deleted' => 1
        ]);
        return redirect()->back()->with('deleted', 'Item telah di-delete');
    }
}
