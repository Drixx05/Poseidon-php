<?php

use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;

$employes = null;

Route::get('/', function () {
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
