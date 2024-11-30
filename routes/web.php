<?php

use App\Http\Controllers\backend\FreeTimeController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\MedicineController;
use App\Http\Controllers\backend\OverTimeController;
use App\Http\Controllers\backend\PatientController;
use App\Http\Controllers\backend\PatientRecordController;
use App\Http\Controllers\backend\ScheduleController;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PatientMedicineController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');


//Dashboard Routs
Auth::routes(['register' => false]);

Route::middleware('auth')->prefix("administrator")->group(function () {


    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('calendar', function () {
        return view("backend.app-calender");
    })->name("app_calendar");

    //StaffController
    Route::resource('/staff',StaffController::class)->parameters(['staff'=>'id']);
    Route::get('/staff/trash/list',[StaffController::class, 'trash'])->name('staff.trash');
    Route::get('/staff/trash/restore/{id}',[StaffController::class, 'restore'])->name('staff.restore');
    Route::get('/staff/trash/delete/{id}',[StaffController::class, 'delete'])->name('staff.delete');

    //PatientsRoute
    Route::resource("patient",PatientController::class)->parameters(['patient'=>'id']);
    Route::get('/patient/trash/list',[PatientController::class, 'trash'])->name('patient.trash');
    Route::get('/patient/trash/restore/{id}',[PatientController::class, 'restore'])->name('patient.restore');
    Route::get('/patient/trash/delete/{id}',[PatientController::class, 'delete'])->name('patient.delete');

    //PatientRecord Routs
    Route::resource('/patient-record',PatientRecordController::class);
    Route::get('/patient-record/trash/list',[PatientRecordController::class,'trash'])->name('patient.record.trash');
    Route::get('/patient-record/trash/restore/{id}',[PatientRecordController::class,'restore'])->name('patient.record.restore');
    Route::delete('/patient-record/trash/delete/{id}',[PatientRecordController::class,'delete'])->name('patient.record.delete');

    //UserRoutes
    Route::resource("/user",UserController::class)->parameters(['user'=>'id']);
    Route::get("/profile", function () {
        return View("backend.user.profile");
    })->name("profile");


    //ScheduleRoutes
    Route::resource("/schedule",ScheduleController::class);
    Route::get("/schedule/trash/list",[ScheduleController::class,"trash"])->name("schedule.trash");
    Route::get("/schedule/trash/restore/{schedule}",[ScheduleController::class,"restore"])->name("schedule.restore");
    Route::delete("/schedule/trash/delete/{schedule}",[ScheduleController::class,"delete"])->name("schedule.delete");

    Route::resource("/staff/schedule/overtime", OverTimeController::class);
    Route::get("/staff/schedule/overtime/trash/list", [OverTimeController::class,'trash'])->name("overtime.trash");
    Route::get("/staff/schedule/overtime/trash/restore/{id}", [OverTimeController::class,"restore"])->name("overtime.restore");
    Route::delete("/staff/schedule/overtime/trash/delete/{id}",[OverTimeController::class,"delete"])->name("overtime.delete");

    Route::resource("/staff/schedule/freetime", FreeTimeController::class);
    Route::get("/staff/schedule/freetime/trash/list", [FreeTimeController::class,'trash'])->name("freetime.trash");
    Route::get("/staff/schedule/freetime/trash/restore/{id}", [FreeTimeController::class,'restore'])->name("freetime.restore");
    Route::delete("/staff/schedule/freetime/trash/delete/{id}", [FreeTimeController::class,'delete'])->name("freetime.delete");


    //MedicineRoutes
    Route::resource("/medicine",MedicineController::class);
    Route::get("/medicine/trash/list",[MedicineController::class,'trash'])->name("medicine.trash");
    Route::get("/medicine/trash/restore/{id}",[MedicineController::class,'restore'])->name("medicine.restore");
    Route::delete("/medicine/trash/delete/{id}",[MedicineController::class,'delete'])->name("medicine.delete");

    //PatientMedicine
    Route::resource("/patient-medicine", PatientMedicineController::class);
    Route::get("/patient-medicine/trash/list", [PatientMedicineController::class,'trash'])->name('patient-medicine.trash');
    Route::get("/patient-medicine/trash/restore/{id}",[PatientMedicineController::class,'restore'])->name("patient-medicine.restore");
    Route::delete("/patient-medicine/trash/delete/{id}", [PatientMedicineController::class,'delete'])->name("patient-medicine.delete");

    //

});

