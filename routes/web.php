<?php

use App\Http\Controllers\backend\AdmitController;
use App\Http\Controllers\backend\AppointmentController;
use App\Http\Controllers\backend\FreeTimeController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\PatientTreatmentController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\TestController;
use App\Http\Controllers\backend\MedicineController;
use App\Http\Controllers\backend\OverTimeController;
use App\Http\Controllers\backend\PatientController;
use App\Http\Controllers\backend\PatientRecordController;
use App\Http\Controllers\backend\PatientTestController;
use App\Http\Controllers\backend\ScheduleController;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\backend\TreatmentController;
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

    //LaboratoryRoutes
    Route::resource("/laboratory/test",TestController::class);
    Route::get("/laboratory/test/trash/list",[TestController::class,"trash"])->name("test.trash");
    Route::get("/laboratory/test/trash/restore/{id}",[TestController::class,"restore"])->name("test.restore");
    Route::delete("/laboratory/test/trash/delete/{id}",[TestController::class,"delete"])->name("test.delete");

    //PatientTestRoutes
    Route::resource("/laboratory/patient-test", PatientTestController::class);
    Route::get("/laboratory/patient-test/trash/list", [PatientTestController::class,'trash'])->name("patient-test.trash");
    Route::get("/laboratory/patient-test/trash/restore/{id}", [PatientTestController::class,'restore'])->name("patient-test.restore");
    Route::delete("/laboratory/patient-test/trash/delete/{id}", [PatientTestController::class,'delete'])->name("patient-test.delete");

    //RoomRoutes
    Route::resource("/room",RoomController::class);
    Route::get("/room/trash/list",[RoomController::class,'trash'])->name("room.trash");
    Route::get("/room/trash/restore/{id}",[RoomController::class,'restore'])->name("room.restore");
    Route::delete("/room/trash/delete/{id}",[RoomController::class,'delete'])->name("room.delete");

    //AdmitRoutes
    Route::resource("/admit",AdmitController::class);
    Route::get("/patient/admit/trash/list",[AdmitController::class,'trash'])->name("admit.trash");
    Route::get("/patient/admit/trash/restore/{id}",[AdmitController::class,'restore'])->name("admit.restore");
    Route::delete("/patient/admit/trash/delete/{id}",[AdmitController::class,'delete'])->name("admit.delete");

    //TreatmentRoutes
    Route::resource("/treatment",TreatmentController::class);
    Route::get("/treatment/trash/list",[TreatmentController::class,'trash'])->name("treatment.trash");
    Route::get("/treatment/trash/restore/{id}",[TreatmentController::class,'restore'])->name("treatment.restore");
    Route::delete("/treatment/trash/delete/{id}",[TreatmentController::class,'delete'])->name("treatment.delete");

    //PatientTreatment
    Route::resource("/patient-treatment", PatientTreatmentController::class);
    Route::get("/patient-treatment/trash/list", [PatientTreatmentController::class,'trash'])->name("patient-treatment.trash");
    Route::get("/patient-treatment/trash/restore/{id}", [PatientTreatmentController::class,'restore'])->name("patient-treatment.restore");
    Route::delete("/patient-treatment/trash/delete/{id}", [PatientTreatmentController::class,'delete'])->name("patient-treatment.delete");

    //AppointmentRoutes
    Route::resource("/appointment",AppointmentController::class);
    Route::get("/appointment/trash/list",[AppointmentController::class,"trash"])->name("appointment.trash");
    Route::get("/appointment/trash/restore/{id}",[AppointmentController::class,"restore"])->name("appointment.restore");
    Route::delete("/appointment/trash/delete/{id}",[AppointmentController::class,"delete"])->name("appointment.delete");

    //FinanceRoutes

    //----------------------------------------------------------------------------------------------------------------//

    //UserRoutes

});

