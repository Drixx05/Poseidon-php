<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RequeteController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/services/direction', [ServiceController::class, 'direction'])->name('services.direction');
Route::get('/services/responsables', [ServiceController::class, 'responsables'])->name('services.responsables');
Route::get('/services/count', [ServiceController::class, 'count'])->name('services.count');
Route::resource('services', ServiceController::class);

Route::get('/employes', [EmployeController::class, "index"])->name("employes.index");
Route::get('/employes/{id}', [EmployeController::class, "show"])->name("employes.show");

Route::view('/contact', 'contact.index')->name('contact.index');

Route::get('/exercice', [ExerciceController::class, 'index'])->name('exercice.index');

Route::get('/requetes', [RequeteController::class, 'index'])->name('requetes.index');
Route::post('/requetes/augmenter-salaires', [RequeteController::class, 'augmenterSalaires'])->name('requetes.augmenter-salaires');
Route::post('/requetes/supprimer-marketing', [RequeteController::class, 'supprimerMarketing'])->name('requetes.supprimer-marketing');