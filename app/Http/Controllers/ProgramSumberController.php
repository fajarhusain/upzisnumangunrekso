<?php

namespace App\Http\Controllers;

use App\Models\ProgramSumber;
use App\Models\SumberDonasi;
use Illuminate\Http\Request;

class ProgramSumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programSumbers = ProgramSumber::query()->get();

        return view('programsumber.index', compact('programSumbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sumberDonasis = SumberDonasi::query()->get();

        return view('programsumber.create', compact('sumberDonasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:35',
            'sumber_donasi_id' => 'required|exists:sumber_donasis,id',
        ]);

        ProgramSumber::create([
            'name' => $request->name,
            'sumber_donasi_id' => $request->sumber_donasi_id,
        ]);

        return redirect()->route('programsumber.index')->with('success', 'Program sumber created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramSumber $programSumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramSumber $programsumber)
    {
        $sumberDonasis = SumberDonasi::query()->get();

        return view('programsumber.edit', compact('programsumber', 'sumberDonasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramSumber $programsumber)
    {
        $request->validate([
            'name' => 'required|max:35',
            'sumber_donasi_id' => 'required|exists:sumber_donasis,id',
        ]);

        $programsumber->update([
            'name' => $request->name,
            'sumber_donasi_id' => $request->sumber_donasi_id,
        ]);

        return redirect()->route('programsumber.index')->with('success', 'Program sumber edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramSumber $programsumber)
    {
        $programsumber->delete();

        return redirect()->route('programsumber.index')->with('success', 'ProgramSumber deleted successfully!');
    }
}
