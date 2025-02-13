<?php

namespace App\Http\Controllers;

use App\Models\SumberDonasi;
use Illuminate\Http\Request;

class SumberDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumberdonasis = SumberDonasi::query()->get();

        return view('sumberdonasi.index', compact('sumberdonasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sumberdonasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sumberdonasi' => 'required',
        ]);

        SumberDonasi::create([
            'name' => $request->sumberdonasi,
        ]);

        return redirect()
            ->route('sumberdonasi.index')
            ->with('success', 'Sumber Donasi Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(SumberDonasi $sumberdonasi)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SumberDonasi $sumberdonasi)
    {
        return view('sumberdonasi.edit', compact('sumberdonasi'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDonasi $sumberdonasi)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sumberdonasi->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('sumberdonasi.index')
            ->with('success', 'Sumber Donasi Berhasil diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDonasi $sumberdonasi)
    {
        $sumberdonasi->delete();

        return redirect()
            ->route('sumberdonasi.index')
            ->with('success', 'Sumber Donasi Berhasil dihapus');
    }
}
