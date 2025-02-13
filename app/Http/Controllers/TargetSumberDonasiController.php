<?php

namespace App\Http\Controllers;

use App\Models\SumberDonasi;
use App\Models\Tahun;
use App\Models\TargetSumberDonasi;
use Illuminate\Http\Request;

class TargetSumberDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetSumberDonasis = TargetSumberDonasi::query()->get();

        return view('targetsumberdonasi.index', compact('targetSumberDonasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sumberDonasis = SumberDonasi::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetsumberdonasi.create', compact('sumberDonasis', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sumber_donasi_id' => 'required|exists:sumber_donasis,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        TargetSumberDonasi::create([
            'nominal' => $request->nominal,
            'sumber_donasi_id' => $request->sumber_donasi_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetsumberdonasi.index')
            ->with('success', 'Target Sumber Donasi berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetSumberDonasi $targetSumberDonasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetSumberDonasi $targetsumberdonasi)
    {
        $sumberDonasis = SumberDonasi::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetsumberdonasi.edit', compact('sumberDonasis', 'tahuns', 'targetsumberdonasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetSumberDonasi $targetsumberdonasi)
    {
        $request->validate([
            'sumber_donasi_id' => 'required|exists:sumber_donasis,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        $targetsumberdonasi->update([
            'nominal' => $request->nominal,
            'sumber_donasi_id' => $request->sumber_donasi_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetsumberdonasi.index')
            ->with('success', 'Target Sumber Donasi berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetSumberDonasi $targetsumberdonasi)
    {
        $targetsumberdonasi->delete();

        return redirect()
            ->route('targetsumberdonasi.index')
            ->with('succes', 'Target Sumber Donasi Berhasil dihapus');
    }
}
