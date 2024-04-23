<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.user', [ 
            'data' => User::where('deleted', null)->get()
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
    public function store(StoreUser $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->password);
        $validated['status'] = 'aktif';

        User::create($validated);

        return redirect()->back()->with("added", "User {$request->nama} berhasil ditambahkan");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);
        return redirect()->back()->with('saved', 'User berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->update([
            'status' => 'non-aktif',
            'deleted' => 1
        ]);
        return redirect()->back()->with('deleted', 'User telah di-delete');
    }
}
