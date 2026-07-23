<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServiceController extends Controller
{
    public function index()
    {
        $services = $this->withBadges(Service::all());

        return view('services.index', ['services' => $services]);
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'responsable' => 'required|string|max:80',
            'telephone' => 'required|string|max:20',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function show($id)
    {
        $service = Service::find($id);

        if ($service) {
            $service->badge = $this->badgeClass($service->nom);
        }

        return view('services.show', ['service' => $service]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', ['service' => $service]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'responsable' => 'required|string|max:80',
            'telephone' => 'required|string|max:20',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();

        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }

    public function direction()
    {
        $services = $this->withBadges(Service::where('nom', 'Direction')->get());

        return view('services.direction', ['services' => $services]);
    }

    public function responsables()
    {
        $responsables = Service::select('nom', 'responsable')->get();

        return view('services.responsables', ['responsables' => $responsables]);
    }

    public function count()
    {
        $total = Service::count();

        return view('services.count', ['total' => $total]);
    }

    private function withBadges(Collection $services): Collection
    {
        foreach ($services as $service) {
            $service->badge = $this->badgeClass($service->nom);
        }

        return $services;
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