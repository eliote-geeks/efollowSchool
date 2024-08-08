<?php

use App\Exports\StudentsExport;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\NiveauController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolInformationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::resource('schoolInformation',SchoolInformationController::class);
Route::resource('student',StudentController::class);
Route::resource('classe',ClasseController::class);
Route::resource('niveau',NiveauController::class);

Route::get('card-view',function(){
    return view('student.card-view');
});

Route::get('print/card/{student}/{schoolInformation}',[StudentController::class,'printCard'])->name('print.card');
Route::get('import-students', [StudentController::class, 'showImportForm'])->name('students-import');
Route::post('import-students', [StudentController::class, 'import'])->name('students.import');



Route::get('export-students', function () {
    return Excel::download(new StudentsExport, 'students.xlsx');
})->name('exportModel');