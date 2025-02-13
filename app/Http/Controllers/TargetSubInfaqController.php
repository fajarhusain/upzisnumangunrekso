<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\TargetSubInfaq;
use Illuminate\Http\Request;

class TargetSubInfaqController extends Controller
{
    protected $types;

    public function __construct() {
        // Define $types as a collection of objects
        $this->types = collect([
            (object) ['name' => 'Infaq non-Rutin', 'value' => 'infaqnonrutin'],
            (object) ['name' => 'Infaq Rutin', 'value' => 'infaqrutin'],
        ]);

        // Share $types with all views rendered by this controller
        view()->share('types', $this->types);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetsubinfaqs = TargetSubInfaq::query()->get();

        return view('targetsubinfaq.index', compact('targetsubinfaqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahuns = Tahun::query()->get();

        return view('targetsubinfaq.create', compact('tahuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        TargetSubInfaq::create([
            'nominal' => $request->nominal,
            'jenis' => $request->jenis,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targetsubinfaq.index')
            ->with('success', 'Target berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetSubInfaq $targetsubinfaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetSubInfaq $targetsubinfaq)
    {
        $tahuns = Tahun::query()->get();
        return view('targetsubinfaq.edit', compact('targetsubinfaq','tahuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetSubInfaq $targetsubinfaq)
    {
        $request->validate([
            'jenis' => 'required',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        // Remove any non-numeric characters for safe storage as integer
        // $nominal = $this->ubahRupiah($request->input('nominal'));

        $targetsubinfaq->update([
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()->route('targetsubinfaq.index')
            ->with('success', 'Target berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetSubInfaq $targetsubinfaq)
    {
        $targetsubinfaq->delete();

        return redirect()->route('targetsubinfaq.index')
            ->with('success', 'Target berhasil diperbaharui');
    }
}
