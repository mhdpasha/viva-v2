<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailBuku;
use App\Models\Buku;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counts['buku'] = Buku::all()->count();
        $counts['stok'] = DetailBuku::all()->count();
        $counts['tersedia'] = DetailBuku::where('status', 'Tersedia')->count();
        $counts['pinjam'] = DetailBuku::where('status', 'Tidak Tersedia')->count();

        return view('pages.dashboard', ['data' => $counts]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
