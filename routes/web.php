<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');


//Dashboard Routs
Auth::routes(['register' => false]);

Route::middleware('auth')->prefix("administrator")->group(function () {

    Route::get("/profile", function () {
        return View("backend.profile");
    })->name("profile");

    Route::get('/dashboard', [\App\Http\Controllers\backend\HomeController::class, 'index'])
        ->name('dashboard');

    Route::get('calendar', function () {
        return view("backend.app-calender");
    })->name("app_calendar");

    //StaffController
    Route::resource('/staff',\App\Http\Controllers\backend\StaffController::class)->parameters(['staff'=>'id']);
    Route::get('/staff/trash/list',[\App\Http\Controllers\backend\StaffController::class, 'trash'])->name('staff.trash');
    Route::get('/staff/trash/restore/{id}',[\App\Http\Controllers\backend\StaffController::class, 'restore'])->name('staff.restore');
    Route::get('/staff/trash/delete/{id}',[\App\Http\Controllers\backend\StaffController::class, 'delete'])->name('staff.delete');

});

