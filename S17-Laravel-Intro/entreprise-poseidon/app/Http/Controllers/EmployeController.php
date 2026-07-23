<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
   
    // public function bienvenue()
    // {
    //     return view("bonjour");
    // }

    // public function liste()
    // {
    //     return view('employes', [
    //         // "employes" => $this->employes
    //     ]);
    // }

    // // Ici le $id correspond au param arrivant de ma route '/fiche/{id}'
    // public function fiche($id) 
    // {
    //     return "Employe $id";
    // }

    public function index()
    {
        // Ci dessous des instructions en RAW SQL
        // $employes = DB::select("SELECT * FROM employes");
        // $employes = DB::select("SELECT * FROM employes WHERE service='informatique'");
        // $service = "informatique";
        // $employes = DB::select("SELECT * FROM employes WHERE service=?", [$service]);
        // DB::insert('INSERT INTO ..........')
        // DB::update('UPDATE employes ..........')

        // Ci dessous avec du Query Builder
        // $employes = DB::table('employes')->get();
        // $employes = DB::table('employes')
        //                 ->where('service', 'informatique')
        //                 ->get();
        // $employes = DB::table('employes')
        //                 ->orderBy('salaire', 'desc')
        //                 ->limit(5)
        //                 ->get();  // Avec get je récupère une collection
        // $employes = DB::table('employes')->first(); // Avec first juste un objet
        // $employes = DB::table('employes')->find(350); // cherche au travers de l'id 
        // dd(DB::table('employes')->count());
        // DB::table('employes')
        //     ->insert([
        //         'prenom' => 'Pierra',
        //         'nom' => 'Lacaze',
        //         'service' => 'Formation',
        //         'sexe' => 'm'
        //     ]);
        // DB::table('employes')
        //     ->where('id', '991')
        //     ->update([
        //         'salaire' => 3000
        //     ]);

        // DB::table('employes')
        //     ->where('id', '991')
        //     ->delete();

            // where..... orWhere    whereBetween, whereNull

        // A partir de là, en ORM Eloquent

        // dd(Employe::factory()->make()); // simplement creation de l'objet
        // dd(Employe::factory()->create()); // Creation de l'objet de envoi vers bdd

        $employes = Employe::all();
        // $employes = Employe::where('service', 'direction')->get();
        // $employe = Employe::find(350);

        // Création d'un objet puis insertion en BDD
        // $employe = new Employe;
        // $employe->prenom = "Polo";
        // $employe->nom = "Lolo";
        // $employe->sexe = "m";
        // $employe->service = "informatique";
        // $employe->date_embauche = "2026-01-01";
        // $employe->salaire = 2000;
        // $employe->save();

        // $employe = Employe::find(992);
        // $employe->salaire = 3500;
        // $employe->save();
        // $employe = Employe::find(995);
        // $employe->delete();  // delete une fois que l'objet est pioché

        // Employe::destroy(993); // destroy sur le model direct en spécifiant un id

        // Employe::create([
        //     'prenom' => 'Gandalf',
        //     'nom' => 'LeGris',
        //     'sexe' => 'm',
        // ]);
        // dd(Employe::latest()->get());
        

        // dd($employes);
        // dd('Methode index');
        $title = "Liste Employes";
        return view('employes.index', [
            "employes" => $employes,
            "title" => $title,
        ]);
    }

    public function show(Employe $employe)
    {  // Ici on profite du Model Binding, en gros, on modifie notre route pour dire /employes/{employe} et non plus id, et laravel comprends de lui meme qu'il reçoit un int et qu'on lui parle d'un "employe" il fait la liaison directe avec le model
    // Je n'ai donc pas besoin ici de lancer une requête 
    // $employe = Employe::find($id);
    // dd($employe);
    return view('employes.show', compact('employe'));
    }

    public function create()   // create c'est pour afficher le form de creation
    {
        // dd("coucou");
        return view('employes.create');
    }

    public function store()  // différent du create, c'est pour stocker l'element venant du form
    {
        Employe::create([
            'prenom'=>request('prenom'),
            'nom'=>request('nom'),
            'service'=>request('service'),
            'sexe'=>request('sexe'),
            'date_embauche'=>request('date_embauche'),
            'salaire'=>request('salaire'),
        ]);

        return redirect()->route('employes.index');
    }

    public function edit(Employe $employe) 
    {
        return view('employes.edit', compact('employe'));
    }

    public function update(Request $request, Employe $employe) 
    {
        // dd($request->prenom);
        $employe->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'service' => $request->service,
            'sexe' => $request->sexe,
            'date_embauche' => $request->date_embauche,
            'salaire' => $request->salaire,
        ]);

        return redirect()->route('employes.index');
    }

    public function destroy(Employe $employe) 
    {
        $employe->delete();
        return redirect()->route('employes.index');
    }
}
