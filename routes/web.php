<?php

use App\Http\Controllers\AshnafController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PenghimpunanController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\PilarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramPilarController;
use App\Http\Controllers\ProgramSumberController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\SumberDonasiController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\TargetPilarController;
use App\Http\Controllers\TargetProgramPilarController;
use App\Http\Controllers\TargetProgramSumberController;
use App\Http\Controllers\TargetSubInfaqController;
use App\Http\Controllers\TargetSumberDonasiController;
use App\Http\Controllers\TargetTahunanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('penghimpunan/export', [PenghimpunanController::class, 'export'])->name('penghimpunan.export');
    // Route::get('penghimpunan/exportexel', [PenghimpunanController::class, 'exportExel'])->name('penghimpunan.exportexel');
    // Route::get('penghimpunan/exportcsv', [PenghimpunanController::class, 'exportCsv'])->name('penghimpunan.exportcsv');
    Route::get('penghimpunan/importexel', [PenghimpunanController::class, 'importExel'])->name('penghimpunan.importexel');
    Route::get('penghimpunan/importcsv', [PenghimpunanController::class, 'importCsv'])->name('penghimpunan.importcsv');
    Route::patch('penghimpunan/importfileexel', [PenghimpunanController::class, 'importFileExel'])->name('penghimpunan.importfileexel');
    Route::patch('penghimpunan/importfilecsv', [PenghimpunanController::class, 'importFileCsv'])->name('penghimpunan.importfilecsv');
    Route::resource('penghimpunan', PenghimpunanController::class);

    Route::patch('penyaluran/importfilecsv', [PenyaluranController::class, 'importFileCsv'])->name('penyaluran.importfilecsv');
    Route::patch('penyaluran/importfileexel', [PenyaluranController::class, 'importFileExel'])->name('penyaluran.importfileexel');
    Route::get('penyaluran/importcsv', [PenyaluranController::class, 'importCsv'])->name('penyaluran.importcsv');
    Route::get('penyaluran/importexel', [PenyaluranController::class, 'importExel'])->name('penyaluran.importexel');
    Route::get('penyaluran/exportcsv', [PenyaluranController::class, 'exportCsv'])->name('penyaluran.exportcsv');
    Route::get('penyaluran/export', [PenyaluranController::class, 'export'])->name('penyaluran.export');
    Route::resource('penyaluran', PenyaluranController::class);

    Route::resource('ashnaf', AshnafController::class)->except('show');
    Route::resource('pilar', PilarController::class);
    Route::resource('programpilar', ProgramPilarController::class)->except('show');
    Route::resource('provinsi', ProvinsiController::class)->except('show');
    Route::resource('kabupaten', KabupatenController::class)->except('show');
    Route::resource('sumberdonasi', SumberDonasiController::class)->except('show');
    Route::resource('programsumber', ProgramSumberController::class)->except('show');
    Route::resource('sumberdana', SumberDanaController::class)->except('show');
    Route::resource('tahun', TahunController::class)->except('show');
    Route::resource('user', UserController::class)->except('show');

    Route::resource('targettahunan', TargetTahunanController::class)->except('show');
    Route::resource('targetsumberdonasi', TargetSumberDonasiController::class)->except('show');
    Route::resource('targetprogramsumber', TargetProgramSumberController::class)->except('show');
    Route::resource('targetsubinfaq', TargetSubInfaqController::class)->except('show');
    Route::resource('targetpilar', TargetPilarController::class)->except('show');
    Route::resource('targetprogrampilar', TargetProgramPilarController::class)->except('show');

    Route::view('/target', 'target.index')->name('target.index');


});

// Route::view('/', 'public.home')->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'public.about')->name('about');
Route::view('/sejarah', 'public.sejarah')->name('sejarah');
Route::view('/visimisi', 'public.visimisi')->name('visimisi');
Route::view('/program', 'public.program')->name('program');

require __DIR__.'/auth.php';
