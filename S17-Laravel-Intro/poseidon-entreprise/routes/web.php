<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\EmployeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/employes', [EmployeController::class, "index"])->name("employes.index");
Route::get('/employes/{id}', [EmployeController::class, "show"])->name("employes.show");
Route::view('/contact', 'contact.index')->name('contact.index');
Route::get('/exercice', [ExerciceController::class, 'index'])->name('exercice.index');