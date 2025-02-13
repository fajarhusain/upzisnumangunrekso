<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\TargetTahunan;
use Illuminate\Http\Request;

class TargetTahunanController extends Controller
{
    protected $types;
    public function __construct() {
        // Define $types as a collection of objects
        $this->types = collect([
            (object) ['name' => 'Penghimpunan', 'value' => 'penghimpunan'],
            (object) ['name' => 'Penyaluran', 'value' => 'penyaluran'],
        ]);

        // Share $types with all views rendered by this controller
        view()->share('types', $this->types);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahuns = Tahun::query()->get();
        $targetTahunans = TargetTahunan::query()->get();

        return view('targettahunan.index', compact('tahuns', 'targetTahunans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahuns = Tahun::query()->get();

        return view('targettahunan.create', compact('tahuns'));
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

        $intnominal = $this->ubahRupiah($request->input('nominal'));

        TargetTahunan::create([
            'nominal' => $intnominal,
            'jenis' => $request->jenis,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()
            ->route('targettahunan.index')
            ->with('success', 'Target berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show(TargetTahunan $targetTahunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetTahunan $targettahunan)
    {
        $tahuns = Tahun::query()->get();

        return view('targettahunan.edit', compact('tahuns', 'targettahunan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetTahunan $targettahunan)
    {
        $request->validate([
            'jenis' => 'required',
            'nominal' => 'required',
            'tahun_id' => 'required|exists:tahuns,id',
        ]);

        // Remove any non-numeric characters for safe storage as integer
        $intnominal = $this->ubahRupiah($request->input('nominal'));

        $targettahunan->update([
            'jenis' => $request->jenis,
            'nominal' => $intnominal,
            'tahun_id' => $request->tahun_id,
        ]);

        return redirect()->route('targettahunan.index')
            ->with('success', 'Target berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetTahunan $targettahunan)
    {
        $targettahunan->delete();

        return redirect()
            ->route('targettahunan.index')
            ->with('success', 'Target Tahunan Berhasil dihapus');
    }

    public function ubahRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp.\s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }
}
