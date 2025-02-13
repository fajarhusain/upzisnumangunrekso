<?php

namespace App\Http\Controllers;

use App\Models\ProgramSumber;
use App\Models\Tahun;
use App\Models\TargetProgramSumber;
use Illuminate\Http\Request;

class TargetProgramSumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetProgramSumbers = TargetProgramSumber::query()->get();

        return view('targetprogramsumber.index', compact('targetProgramSumbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programSumbers = ProgramSumber::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetprogramsumber.create', compact('programSumbers', 'tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_sumber_id' => 'required|exists:program_sumbers,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        TargetProgramSumber::create([
            'nominal' => $request->nominal,
            'program_sumber_id' => $request->program_sumber_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetprogramsumber.index')
            ->with('success', 'Target Program Sumber Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetProgramSumber $targetProgramSumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetProgramSumber $targetprogramsumber)
    {
        $programSumbers = ProgramSumber::query()->get();
        $tahuns = Tahun::query()->get();

        return view('targetprogramsumber.edit', compact('programSumbers', 'tahuns', 'targetprogramsumber'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetProgramSumber $targetprogramsumber)
    {
        $request->validate([
            'program_sumber_id' => 'required|exists:program_sumbers,id',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        $targetprogramsumber->update([
            'nominal' => $request->nominal,
            'program_sumber_id' => $request->program_sumber_id,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetprogramsumber.index')
            ->with('success', 'Target Program Sumber Berhasil diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetProgramSumber $targetprogramsumber)
    {
        $targetprogramsumber->delete();

        return redirect()
            ->route('targetprogramsumber.index')
            ->with('success', 'Target Program Sumber Berhasih dihapus');
    }
}
