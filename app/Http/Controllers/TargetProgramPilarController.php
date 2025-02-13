<?php

namespace App\Http\Controllers;

use App\Models\ProgramPilar;
use App\Models\Tahun;
use App\Models\TargetProgramPilar;
use Illuminate\Http\Request;

class TargetProgramPilarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetProgramPilars = TargetProgramPilar::query()->get();

        return view('targetprogrampilar.index', compact('targetProgramPilars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programPilars = ProgramPilar::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetprogrampilar.create', compact('programPilars', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_pilar_id' => 'required|exists:program_pilars,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);
        // dd($request->all());
        TargetProgramPilar::create([
            'nominal' => $request->nominal,
            'program_pilar_id' => $request->program_pilar_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetprogrampilar.index')
            ->with('success', 'Target Program Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetProgramPilar $targetProgramPilar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetProgramPilar $targetprogrampilar)
    {
        $programPilars = ProgramPilar::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetprogrampilar.edit', compact('programPilars', 'tahuns', 'targetprogrampilar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetProgramPilar $targetprogrampilar)
    {
        $request->validate([
            'program_pilar_id' => 'required|exists:program_pilars,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        $targetprogrampilar->update([
            'nominal' => $request->nominal,
            'program_pilar_id' => $request->program_pilar_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetprogrampilar.index')
            ->with('success', 'Target Program Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetProgramPilar $targetprogrampilar)
    {
        $targetprogrampilar->delete();

        return redirect()
            ->route('targetprogrampilar.index')
            ->with('success', 'Target Program Berhasil dihapus');
    }
}
