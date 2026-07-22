<?php

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

$employes = null;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/bonjour', function() {
    // Dans une route je peux faire un return de texte brut ou html
    // Bien sur ce n'est pas trop le but... On préfèrera return des view ! 
    // return "Bonjour à tous";
    return view('bonjour');
});

Route::get('/presentation', function() {
    return "
        <h1>Entreprise Poseidon</h1>
        <p>Bienvenue sur ce nouveau projet ! </p>
    ";
});

Route::get('/laborde', function() {
    $employe = [
        "nom" => "Laborde",
        "prenom" => "Jean-Pierre",
    ];

    // Je peux transmettre de la data à une route 
    return view("laborde", [
        "employe" => $employe,
    ]);
});

Route::get('/employeeseeeeeeeeeeeeeeeeeeee', function() use ($employes){
    return view('employes', [
        "employes" => $employes
    ]
    );
})->name("employes");

Route::get('/bonjour/{prenom}', function($prenom) {
    return "Bonjour $prenom";
});

Route::get('/employe/{id}', function($id) {
    return "Infos de l'employé numéro : $id";
});

Route::get('/contact', function() {
    return view('contact');
});

Route::post('/contact', function() {
    return "Salut, le form a bien été envoyé!";
});

// A partir de là les routes avec controller 
Route::get('/bienvenue', [EmployeController::class, 'bienvenue'])->name('bienvenue');
Route::get('/liste', [EmployeController::class, 'liste'])->name('liste');
Route::get('/fiche/{id}', [EmployeController::class, 'fiche'])->name('fiche');

Route::get('/services', [ServiceController::class, "index"])->name("services.index");
Route::get('/services/{id}', [ServiceController::class, "show"])->name("services.show");

Route::get('/employes', [EmployeController::class, "index"])->name("employes.index");
Route::get('/employes/{id}', [EmployeController::class, "show"])->name("employes.show");

Route::get('/', [HomeController::class, "home"])->name("home");
Route::get('/contact', [HomeController::class, "contact"])->name("contact");
Route::get('/bladetest', [HomeController::class, "bladetest"])->name("bladetest");
Route::get('/bladeexo', [HomeController::class, "bladeexo"])->name("bladeexo");
