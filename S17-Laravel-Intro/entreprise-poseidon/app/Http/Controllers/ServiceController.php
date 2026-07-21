<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $services = [
    [
        "id" => 1,
        "nom" => "Direction",
        "responsable" => "Jean-Pierre Laborde",
        "telephone" => "01 40 12 34 56"
    ],
    [
        "id" => 2,
        "nom" => "Comptabilité",
        "responsable" => "Claire Durand",
        "telephone" => "01 40 12 34 57"
    ],
    [
        "id" => 3,
        "nom" => "Informatique",
        "responsable" => "Thomas Chevel",
        "telephone" => "01 40 12 34 58"
    ],
    [
        "id" => 4,
        "nom" => "Assistance",
        "responsable" => "Stephanie Lafaille",
        "telephone" => "01 40 12 34 59"
    ]
];

    public function index()
    {
        // dd('Methode index');
        return view('services.index', [
            "services" => $this->services,
        ]);
    }

    public function show($id)
    {

        // Recherche du service par son ID
        // On fait ça avec une boucle pour parcourir tout les services
        // Evidemment, ce sera plus facile dès lors qu'on aura une bdd 
        $serviceTrouve = null;
        foreach($this->services as $service) {
            if ($service["id"] == $id) {
                $serviceTrouve = $service;
                break;
            }
        }

       return view('services.show', [
        "id" => $id,
        "service" => $serviceTrouve
       ]);
    }
}
