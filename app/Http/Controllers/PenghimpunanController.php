<?php

namespace App\Http\Controllers;

use App\Imports\PenghimpunanImportCsv;
use App\Imports\PenghimpunanImportExel;
use App\Models\Penghimpunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenghimpunanController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Penghimpunan::class, 'penghimpunan');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return view('penghimpunan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penghimpunan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function parseRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp.\s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }

    /**
     * Display the specified resource.
     */
    public function show(Penghimpunan $penghimpunan)
    {
        return view('penghimpunan.view', compact('penghimpunan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penghimpunan $penghimpunan)
    {
        return view('penghimpunan.edit', compact('penghimpunan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghimpunan $penghimpunan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghimpunan $penghimpunan)
    {
        $penghimpunan->delete();

        return redirect()
            ->route('penghimpunan.index')
            ->with('success', 'Penghimpunan deleted successfully!');
    }

    public function importExel()
    {
        $this->authorize('create', Penghimpunan::class);

        return view('penghimpunan.import-exel');
    }

    public function importCsv()
    {
        $this->authorize('create', Penghimpunan::class);

        return view('penghimpunan.import-csv');
    }

    public function export()
    {
        $this->authorize('create', Penghimpunan::class);

        return view('penghimpunan.export');
    }

    public function importFileExel(Request $request)
    {
        $this->authorize('create', Penghimpunan::class);

        $request->validate([
            'doc' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('doc');

        $filename = $file->getClientOriginalName();
        $path = 'penghimpunan/'.$filename;
        Storage::put($path, file_get_contents($file));

        // Excel::import(new PenghimpunanImportExel, $path);

        $import = new PenghimpunanImportExel;

        try {
            $import->import($path, 'local', \Maatwebsite\Excel\Excel::XLSX);

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $errors[] = [
                    'row' => $failure->row(), // Baris yang bermasalah
                    'attribute' => $failure->attribute(), // Kolom yang gagal
                    'messages' => $failure->errors(), // Pesan error
                    'values' => $failure->values(), // Nilai dari baris yang gagal
                ];
            }

            // Redirect dengan pesan error
            // return redirect()->back()->withErrors(['import_errors' => $errors])->withInput();

            return redirect()->back()->withErrors([
                'import_errors' => collect($errors)->map(function ($error) {
                    return json_encode($error);
                }),
            ])->withInput();
        } catch (\Exception $e) {
            // Tangkap error lain selain ValidationException
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }

    }

    public function importFileCsv(Request $request)
    {
        $this->authorize('create', Penghimpunan::class);

        $request->validate([
            'doc' => 'required|file|mimes:csv|max:2048',
        ]);

        $file = $request->file('doc');

        $filename = $file->getClientOriginalName();
        $path = 'penghimpunan/'.$filename;
        Storage::put($path, file_get_contents($file));

        // Excel::import(new PenghimpunanImportCsv, $path);

        $import = new PenghimpunanImportCsv;

        try {
            $import->import($path, 'local', \Maatwebsite\Excel\Excel::CSV);

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $errors[] = [
                    'row' => $failure->row(), // Baris yang bermasalah
                    'attribute' => $failure->attribute(), // Kolom yang gagal
                    'messages' => $failure->errors(), // Pesan error
                    'values' => $failure->values(), // Nilai dari baris yang gagal
                ];
            }

            // Redirect dengan pesan error
            // return redirect()->back()->withErrors(['import_errors' => $errors])->withInput();

            return redirect()->back()->withErrors([
                'import_errors' => collect($errors)->map(function ($error) {
                    return json_encode($error);
                }),
            ])->withInput();

        } catch (\Exception $e) {
            // Tangkap error lain selain ValidationException
            return redirect()->back()->with('error', 'An unexpected error occurred: '.$e->getMessage());
        }
    }
}
