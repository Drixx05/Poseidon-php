<?php

namespace App\Http\Controllers;

use App\Models\Employe;

class RequeteController extends Controller
{
    public function index()
    {
        return view('requetes.index', [
            'tousLesEmployes' => Employe::all(),
            'prenoms' => Employe::pluck('prenom'),
            'employesComptabilite' => Employe::where('service', 'comptabilite')->get(),
            'salairesSuperieurs2500' => Employe::where('salaire', '>', 2500)->get(),
            'recrutesApres2020' => Employe::where('date_embauche', '>', '2020-01-01')->get(),
            'triesParNom' => Employe::orderBy('nom')->get(),
            'triesParSalaireDesc' => Employe::orderByDesc('salaire')->get(),
            'cinqPremiers' => Employe::take(5)->get(),
            'prenomCommenceParA' => Employe::where('prenom', 'like', 'A%')->get(),
            'nombreTotalEmployes' => Employe::count(),
            'salaireMoyen' => Employe::avg('salaire'),
            'salaireMoyenParService' => Employe::selectRaw('service, AVG(salaire) as moyenne')
                ->groupBy('service')
                ->get(),
            'nombreParService' => Employe::selectRaw('service, COUNT(*) as total')
                ->groupBy('service')
                ->get(),
            'nombreHommesFemmes' => Employe::selectRaw('sexe, COUNT(*) as total')
                ->groupBy('sexe')
                ->get(),
            'servicesDifferents' => Employe::select('service')->distinct()->get(),
            'dernierEmbauche' => Employe::orderByDesc('date_embauche')->first(),
            'salaireLePlusEleve' => Employe::orderByDesc('salaire')->first(),
            'salaireLePlusFaible' => Employe::orderBy('salaire')->first(),
            'commercialPlus2200' => Employe::where('service', 'commercial')->where('salaire', '>', 2200)->get(),
            'recrutesEntre2020et2024' => Employe::whereBetween('date_embauche', ['2020-01-01', '2024-12-31'])->get(),
        ]);
    }

    public function augmenterSalaires()
    {
        Employe::query()->increment('salaire', 100);

        return redirect()->route('requetes.index')->with('success', 'Tous les salaires ont été augmentés de 100 €.');
    }

    public function supprimerMarketing()
    {
        Employe::where('service', 'Marketing')->delete();

        return redirect()->route('requetes.index')->with('success', 'Les employés du service Marketing ont été supprimés.');
    }
}