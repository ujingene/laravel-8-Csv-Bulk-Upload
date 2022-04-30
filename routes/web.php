<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CsvUploadController::class, 'index'])->name('csv_page');
Route::post('/import/custom', [CsvUploadController::class, 'import_custom'])->name('import_csv_custom');
Route::post('/import/maatwebsite', [CsvUploadController::class, 'import_maatwebsite'])->name('import_csv_maatwebsite');
