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
        $servicesAvecBadge = [];

        foreach ($this->services as $service) {
            $service['badge'] = $this->badgeClass($service['nom']);
            $servicesAvecBadge[] = $service;
        }

        return view('services.index', ['services' => $servicesAvecBadge]);
    }

    public function show($id)
    {
        $service = collect($this->services)->firstWhere('id', (int) $id);

        if ($service) {
            $service['badge'] = $this->badgeClass($service['nom']);
        }

        return view('services.show', ['service' => $service]);
    }

    private function badgeClass(string $nomService): string
    {
        return match ($nomService) {
            'Direction' => 'primary',
            'Comptabilité' => 'success',
            'Informatique' => 'info',
            'Assistance' => 'warning',
            default => 'secondary',
        };
    }
}