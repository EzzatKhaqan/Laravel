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

    //Staff
    Route::resource('/staff',\App\Http\Controllers\backend\Staff::class)->parameters(['staff'=>'id']);


});


