<?php

namespace App\Http\Controllers;

use App\Exports\PenyaluransExport;
use App\Imports\PenyaluranImportCsv;
use App\Imports\PenyaluranImportExel;
use App\Models\Ashnaf;
use App\Models\Kabupaten;
use App\Models\Lokasi;
use App\Models\PenerimaManfaat;
use App\Models\Penyaluran;
use App\Models\Pilar;
use App\Models\ProgramPilar;
use App\Models\Provinsi;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenyaluranController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Penyaluran::class, 'penyaluran');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return view('penyaluran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ashnafs = Ashnaf::query()->get();
        // $penerimaManfaats = PenerimaManfaat::query()->get();
        $pilars = Pilar::query()->get();
        $programPilars = ProgramPilar::query()->get();
        $tahuns = Tahun::query()->get();
        $provinsis = Provinsi::query()->get();
        $kabupatens = Kabupaten::query()->get();

        return view('penyaluran.create', compact('ashnafs', 'pilars', 'programPilars', 'tahuns', 'provinsis', 'kabupatens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian' => 'required|max:255',
            'nominal' => 'required|numeric',
            'ashnaf_id' => 'nullable|exists:ashnafs,id',
            //'penerima_manfaat_id' => 'nullable|exists:penerima_manfaats,id',
            'lembaga' => 'nullable|numeric',
            'pria' => 'nullable|numeric',
            'wanita' => 'nullable|numeric',
            'pilar_id' => 'nullable|exists:pilars,id',
            'program_pilar_id' => 'nullable|exists:program_pilars,id',
            'tahun_id' => 'nullable|exists:tahuns,id',
            'provinsi_id' => 'nullable|exists:provinsis,id',
            'kabupaten_id' => 'nullable|exists:kabupatens,id',

        ]);
        //dd($request);

        Penyaluran::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'nominal' => $request->nominal,
            'ashnaf_id' => $request->ashnaf_id,
            //'penerima_manfaat_id' => $request->penerima_manfaat_id,
            'lembaga_count' => $request->lembaga,
            'male_count' => $request->pria,
            'female_count' => $request->wanita,
            'pilar_id' => $request->pilar_id,
            'program_pilar_id' => $request->program_pilar_id,
            'tahun_id' => $request->tahun_id,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,

            // 'user_id' => auth()->user()->id,
            // 'title' => $request->title,
        ]);

        return redirect()->route('penyaluran.index')->with('success', 'Penyaluran created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyaluran $penyaluran)
    {
        //$penyaluran->load('ashnaf', 'penerimaManfaat', 'pilar', 'programPilar', 'tahun');

        return view('penyaluran.view', compact('penyaluran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyaluran $penyaluran)
    {
        $ashnafs = Ashnaf::query()->get();
        // $penerimaManfaats = PenerimaManfaat::query()->get();
        $pilars = Pilar::query()->get();
        $programPilars = ProgramPilar::query()->get();
        $tahuns = Tahun::query()->get();
        // $lokasis = Lokasi::query()->get;
        $provinsis = Provinsi::query()->get();
        $kabupatens = Kabupaten::query()->get();

        //dd($penyaluran);
        return view('penyaluran.edit', compact('penyaluran', 'ashnafs', 'pilars', 'programPilars', 'tahuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyaluran $penyaluran)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian' => 'required|max:255',
            'nominal' => 'required|numeric',
            'ashnaf_id' => 'nullable|exists:ashnafs,id',
            //'penerima_manfaat_id' => 'nullable|exists:penerima_manfaats,id',
            'lembaga' => 'nullable|numeric',
            'pria' => 'nullable|numeric',
            'wanita' => 'nullable|numeric',
            'pilar_id' => 'nullable|exists:pilars,id',
            'program_pilar_id' => 'nullable|exists:program_pilars,id',
            'tahun_id' => 'nullable|exists:tahuns,id',
            // 'lokasi_id' => 'nullable|exists:lokasis,id',
            'provinsi_id' => 'nullable|exists:provinsis,id',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',

        ]);
        //dd($request);

        $penyaluran->update([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'nominal' => $request->nominal,
            'ashnaf_id' => $request->ashnaf_id,
            //'penerima_manfaat_id' => $request->penerima_manfaat_id,
            'lembaga_count' => $request->lembaga,
            'male_count' => $request->pria,
            'female_count' => $request->wanita,
            'pilar_id' => $request->pilar_id,
            'program_pilar_id' => $request->program_pilar_id,
            'tahun_id' => $request->tahun_id,
            // 'lokasi_id' => $request->lokasi_id,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,

            // 'user_id' => auth()->user()->id,
            // 'title' => $request->title,
        ]);

        return redirect()->route('penyaluran.index')->with('success', 'Penyaluran edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyaluran $penyaluran)
    {
        $penyaluran->delete();

        return redirect()
            ->route('penyaluran.index')
            ->with('success', 'Penyaluran delete successfully!');
    }

    public function export()
    {

        // return Excel::download(new PenyaluransExport, 'Penyaluran.xlsx');
        return view('penyaluran.export');
    }

    public function exportCsv()
    {

        // return Excel::download(new PenyaluransExport, 'Penyaluran.csv');
    }

    public function importExel()
    {
        return view('penyaluran.import-exel');
    }

    public function importCsv()
    {
        return view('penyaluran.import-csv');
    }

    public function importFileExel(Request $request)
    {
        $request->validate([
            'doc' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('doc');

        $filename = $file->getClientOriginalName();
        $path = 'penyaluran/'.$filename;
        Storage::put($path, file_get_contents($file));

        // Excel::import(new PenyaluranImportExel, $path);

        $import = new PenyaluranImportExel;

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
        $request->validate([
            'doc' => 'required|file|mimes:csv|max:2048',
        ]);

        $file = $request->file('doc');

        $filename = $file->getClientOriginalName();
        $path = 'penyaluran/'.$filename;
        Storage::put($path, file_get_contents($file));

        // Excel::import(new PenyaluranImportCsv, $path);

        $import = new PenyaluranImportCsv;

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
