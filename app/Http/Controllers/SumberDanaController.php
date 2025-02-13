<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumberDanas = SumberDana::query()->get();

        return view('sumberdana.index', compact('sumberDanas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sumberdana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:35',
            'norek' => 'nullable',
        ]);

        SumberDana::create([
            'name' => $request->name,
            'rekening_sumda' => $request->norek,
        ]);

        return redirect()->route('sumberdana.index')->with('success', 'Sumber dana created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SumberDana $sumberDana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SumberDana $sumberdana)
    {
        return view('sumberdana.edit', compact('sumberdana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDana $sumberdana)
    {
        $request->validate([
            'name' => 'required|max:35',
            'norek' => 'nullable',
        ]);

        $sumberdana->update([
            'name' => $request->name,
            'rekening_sumda' => $request->norek,
        ]);

        return redirect()->route('sumberdana.index')->with('success', 'Sumber dana edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDana $sumberdana)
    {
        $sumberdana->delete();

        return redirect()->route('sumberdana.index')->with('success', 'Sumber dana deleted successfully!');
    }
}
