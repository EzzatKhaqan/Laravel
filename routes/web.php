<?php

use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');


//Dashboard Routs
Auth::routes(['register' => false]);

Route::middleware('auth')->prefix("administrator")->group(function () {


    Route::get('/dashboard', [\App\Http\Controllers\backend\HomeController::class, 'index'])->name('dashboard');

    Route::get('calendar', function () {
        return view("backend.app-calender");
    })->name("app_calendar");

    //StaffController
    Route::resource('/staff',\App\Http\Controllers\backend\StaffController::class)->parameters(['staff'=>'id']);
    Route::get('/staff/trash/list',[\App\Http\Controllers\backend\StaffController::class, 'trash'])->name('staff.trash');
    Route::get('/staff/trash/restore/{id}',[\App\Http\Controllers\backend\StaffController::class, 'restore'])->name('staff.restore');
    Route::get('/staff/trash/delete/{id}',[\App\Http\Controllers\backend\StaffController::class, 'delete'])->name('staff.delete');

    //PatientsRoute
    Route::resource("patient",\App\Http\Controllers\backend\PatientController::class)->parameters(['patient'=>'id']);
    Route::get('/patient/trash/list',[\App\Http\Controllers\backend\PatientController::class, 'trash'])->name('patient.trash');
    Route::get('/patient/trash/restore/{id}',[\App\Http\Controllers\backend\PatientController::class, 'restore'])->name('patient.restore');
    Route::get('/patient/trash/delete/{id}',[\App\Http\Controllers\backend\PatientController::class, 'delete'])->name('patient.delete');

    //PatientRecord Routs
    Route::resource('/patient-record',\App\Http\Controllers\backend\PatientRecordController::class)->parameters(['patient-record'=>'id']);

    //UserController
    Route::resource("/user",\App\Http\Controllers\backend\UserController::class)->parameters(['user'=>'id']);
    Route::get("/profile", function () {
        return View("backend.user.profile");
    })->name("profile");


});

