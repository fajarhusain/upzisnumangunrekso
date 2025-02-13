<?php

namespace App\Http\Controllers;

use App\Models\Pilar;
use App\Models\Tahun;
use App\Models\TargetPilar;
use Illuminate\Http\Request;

class TargetPilarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetpilars = TargetPilar::query()->get();

        return view('targetpilar.index', compact('targetpilars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pilars = Pilar::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetpilar.create', compact('pilars', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pilar_id' => 'required|exists:pilars,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        TargetPilar::create([
            'nominal' => $request->nominal,
            'pilar_id' => $request->pilar_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetpilar.index')
            ->with('success', 'Target Pilar berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetPilar $targetPilar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetPilar $targetpilar)
    {
        $pilars = Pilar::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetpilar.edit', compact('targetpilar', 'pilars', 'tahuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetPilar $targetpilar)
    {
        $request->validate([
            'pilar_id' => 'required|exists:pilars,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        $targetpilar->update([
            'nominal' => $request->nominal,
            'pilar_id' => $request->pilar_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetpilar.index')
            ->with('success', 'Target Pilar berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetPilar $targetpilar)
    {
        $targetpilar->delete();

        return redirect()
            ->route('targetpilar.index')
            ->with('success', 'Target Pilar berhasil dihapus');
    }
}
