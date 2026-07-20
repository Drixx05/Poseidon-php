<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private array $services = [
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
        return view('services.index', ['services' => $this->services]);
    }

    public function show($id)
    {
        $service = collect($this->services)->firstWhere('id', (int) $id);

        return view('services.show', ['service' => $service]);
    }
}