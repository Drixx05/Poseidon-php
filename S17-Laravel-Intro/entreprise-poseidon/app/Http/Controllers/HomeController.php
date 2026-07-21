<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() 
    {
        $title = "Accueil";
        return view('pages.home', compact("title"));
    }

    public function contact()
    {

    }

    public function bladetest()
    {

    $titre = "<h1>Bienvenue chez Entreprise Poseidon</h1>";
    $entreprise = "poseidon";
    $employe = "Jean-pierre";
    $admin = false;
    $age = 16;
    $tentatives = 4;
    // $employes = [
    //     array('id_employes' => '350','prenom' => 'Jean-pierre','nom' => 'Laborde','sexe' => 'm','service' => 'direction','date_embauche' => '2010-12-09','salaire' => '5000'),
    //     array('id_employes' => '388','prenom' => 'Clement','nom' => 'Gallet','sexe' => 'm','service' => 'commercial','date_embauche' => '2010-12-15','salaire' => '2300'),
    //     array('id_employes' => '415','prenom' => 'Thomas','nom' => 'Winter','sexe' => 'm','service' => 'commercial','date_embauche' => '2011-05-03','salaire' => '3550'),
    // ];
    $employes = array();


        return view('pages.bladetest', compact("titre", "employes", "entreprise", "employe", "admin", "age", "tentatives"));
    }
}
