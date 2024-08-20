<?php

use App\Models\Moratoire;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\MoratoireController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\SmartCardController;
use App\Http\Controllers\AttendanceController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('schoolInformation', SchoolInformationController::class);
Route::resource('student', StudentController::class);
Route::resource('classe', ClasseController::class);
Route::resource('niveau', NiveauController::class);
Route::resource('scolarite',ScolariteController::class);
Route::resource('payment',PaymentController::class);
Route::resource('moratoire',MoratoireController::class);
Route::resource('timeslots', TimeSlotController::class);
Route::resource('schedules',ScheduleController::class);
Route::resource('teacher',TeacherController::class);

Route::get('card-view', function () {
    return view('student.card-view');
});


// Route::get('scolarite/classe/{niveau}',[NiveauController::class,'scolarite'])->name('scolariteClasse');
Route::get('print/card/{student}/{schoolInformation}', [StudentController::class, 'printCard'])->name('print.card');
Route::get('import-students/{classe}', [StudentController::class, 'showImportForm'])->name('showImportForm');
Route::post('importS/{classe}', [StudentController::class, 'importStudentClase'])->name('importStudentClase');
Route::get('createStudentClass/{classe}', [StudentController::class, 'createStudentClass'])->name('createStudentClass');
Route::get('add-student-card/{student}',[SmartCardController::class,'addStudentCard'])->name('addStudentCard');
Route::post('add-student-card/{student}',[SmartCardController::class,'addPostStudentCard'])->name('addPostStudentCard');
Route::get('searchByname',[StudentController::class,'searchByname'])->name('searchByname');
Route::get('payment/student/{student}',[PaymentController::class,'paymentStudent'])->name('payment.student');
Route::get('receipt-payment/{student}/{payment}',[PaymentController::class,'receiptPayment'])->name('receiptPayment');
Route::get('moratoire/print/{moratoire}',[MoratoireController::class,'downloadMoratoire'])->name('downloadMoratoire');
Route::post('remise/store',[PaymentController::class,'remiseStore'])->name('remiseStore');
Route::post('remise/edit/{reduction}',[PaymentController::class,'remiseEdit'])->name('remiseEdit');
Route::get('remise/delete/{reduction}',[PaymentController::class,'delRemise'])->name('delRemise');
Route::get('remise/status/{reduction}',[PaymentController::class,'statusRemise'])->name('statusRemise');
Route::get('get/remise',[PaymentController::class,'getRemise'])->name('getRemise');
Route::get('get/requetes/{payment}',[PaymentController::class,'requetesShow'])->name('requetesShow');
Route::get('statusReq/{requete}',[PaymentController::class,'statusReq'])->name('statusReq');
Route::post('paiement/control',[SmartCardController::class,'paymentControlStudent'])->name('paymentControlStudent');
Route::get('student-control-payment',[SmartCardController::class,'controlPayment'])->name('controlPayment');
Route::get('scheduleCLass/{classe}',[ScheduleController::class,'scheduleCLass'])->name('scheduleCLass');
Route::get('creneauClass/{classe}',[TimeSlotController::class,'creneauClass'])->name('creneauClass');
Route::get('attendanceStudent/{schedule}',[ScheduleController::class,'attendanceStudent'])->name('attendanceStudent');
route::get('carte/etudiant/{schedule}',[SmartCardController::class,'endListCardschedule'])->name('endListCardschedule');
route::post('carte/shedule/{schedule}',[SmartCardController::class,'scheduleCard'])->name('scheduleCard');



Route::get('/attendance/print/day', [AttendanceController::class, 'printDay'])->name('attendance.print.day');
Route::get('/attendance/print/week', [AttendanceController::class, 'printWeek'])->name('attendance.print.week');
Route::get('/attendance/print/month', [AttendanceController::class, 'printMonth'])->name('attendance.print.month');
Route::get('/attendance/print/period', [AttendanceController::class, 'printPeriod'])->name('attendance.print.period');

Route::get('export-students', function () {
    // return Excel::download(new StudentsExport, 'students.xlsx');
    $filePath = storage_path('app/students.xlsx');

    // Vérifiez si le fichier existe
    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        return back()->with('error', 'Le fichier spécifié n\'existe pas.');
    }
})->name('exportModel');



Route::get('student-view', function () {
    return view('student.student-view');
});



// Route::get('reduction', function(){
//     return view('reduction.reduction');
// });

Route::get('enseignant', function(){
    return view('enseignant.enseignant');
});

Route::get('sequence', function(){
    return view('sequence.sequence');
});