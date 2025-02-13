<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $provinsis = Provinsi::query()->get();
        $kabupatens = Kabupaten::query()
            ->when($request->provinsi, function ($query, $provinsi) {
                $query->where('provinsi_id', '=', $provinsi);
            })
            ->paginate(10);

        return view('kabupaten.index', compact('kabupatens', 'provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsis = Provinsi::query()->get();
        $kabupaten = Kabupaten::query()->get();

        return view('kabupaten.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'provinsi_id' => 'required|max:40',
            'name' => 'required|max:40',

        ]);
        //dd($request);

        Kabupaten::create([
            'provinsi_id' => $request->provinsi_id,
            'name' => $request->name,
        ]);

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        $provinsis = Provinsi::query()->get();

        //dd($kabupaten);
        return view('kabupaten.edit', compact('kabupaten', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'provinsi_id' => 'required|max:40',
            'name' => 'required|max:40'

        ]);
        //dd($request);

        $kabupaten->update([
            'provinsi_id' => $request->provinsi_id,
            'name' =>$request->name,

        ]);

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();

        return redirect()
           ->route('kabupaten.index')
           ->with('success', 'Kabupaten deleted successfully!');
    }
}
