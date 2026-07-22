<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
    protected $employes = array(
  array('id' => '350','prenom' => 'Jean-pierre','nom' => 'Laborde','sexe' => 'm','service' => 'direction','date_embauche' => '2010-12-09','salaire' => '5000'),
  array('id' => '388','prenom' => 'Clement','nom' => 'Gallet','sexe' => 'm','service' => 'commercial','date_embauche' => '2010-12-15','salaire' => '2300'),
  array('id' => '415','prenom' => 'Thomas','nom' => 'Winter','sexe' => 'm','service' => 'commercial','date_embauche' => '2011-05-03','salaire' => '3550'),
  array('id' => '417','prenom' => 'Chloe','nom' => 'Dubar','sexe' => 'f','service' => 'production','date_embauche' => '2011-09-05','salaire' => '1900'),
  array('id' => '491','prenom' => 'Elodie','nom' => 'Fellier','sexe' => 'f','service' => 'secretariat','date_embauche' => '2011-11-22','salaire' => '1600'),
  array('id' => '509','prenom' => 'Fabrice','nom' => 'Grand','sexe' => 'm','service' => 'comptabilite','date_embauche' => '2011-12-30','salaire' => '2900'),
  array('id' => '547','prenom' => 'Melanie','nom' => 'Collier','sexe' => 'f','service' => 'commercial','date_embauche' => '2012-01-08','salaire' => '3100'),
  array('id' => '592','prenom' => 'Laura','nom' => 'Blanchet','sexe' => 'f','service' => 'direction','date_embauche' => '2012-05-09','salaire' => '4500'),
  array('id' => '627','prenom' => 'Guillaume','nom' => 'Miller','sexe' => 'm','service' => 'commercial','date_embauche' => '2012-07-02','salaire' => '1900'),
  array('id' => '655','prenom' => 'Celine','nom' => 'Perrin','sexe' => 'f','service' => 'commercial','date_embauche' => '2012-09-10','salaire' => '2700'),
  array('id' => '699','prenom' => 'Julien','nom' => 'Cottet','sexe' => 'm','service' => 'secretariat','date_embauche' => '2013-01-05','salaire' => '1390'),
  array('id' => '701','prenom' => 'Mathieu','nom' => 'Vignal','sexe' => 'm','service' => 'informatique','date_embauche' => '2013-04-03','salaire' => '2500'),
  array('id' => '739','prenom' => 'Thierry','nom' => 'Desprez','sexe' => 'm','service' => 'secretariat','date_embauche' => '2013-07-17','salaire' => '1500'),
  array('id' => '780','prenom' => 'Amandine','nom' => 'Thoyer','sexe' => 'f','service' => 'communication','date_embauche' => '2014-01-23','salaire' => '2100'),
  array('id' => '802','prenom' => 'Damien','nom' => 'Durand','sexe' => 'm','service' => 'informatique','date_embauche' => '2014-07-05','salaire' => '2250'),
  array('id' => '854','prenom' => 'Daniel','nom' => 'Chevel','sexe' => 'm','service' => 'informatique','date_embauche' => '2015-09-28','salaire' => '3100'),
  array('id' => '876','prenom' => 'Nathalie','nom' => 'Martin','sexe' => 'f','service' => 'juridique','date_embauche' => '2016-01-12','salaire' => '3550'),
  array('id' => '900','prenom' => 'Benoit','nom' => 'Lagarde','sexe' => 'm','service' => 'production','date_embauche' => '2016-06-03','salaire' => '2550'),
  array('id' => '933','prenom' => 'Emilie','nom' => 'Sennard','sexe' => 'f','service' => 'commercial','date_embauche' => '2017-01-11','salaire' => '1800'),
  array('id' => '990','prenom' => 'Stephanie','nom' => 'Lafaye','sexe' => 'f','service' => 'assistant','date_embauche' => '2017-03-01','salaire' => '1775')
);
    public function bienvenue()
    {
        return view("bonjour");
    }

    public function liste()
    {
        return view('employes', [
            "employes" => $this->employes
        ]);
    }

    // Ici le $id correspond au param arrivant de ma route '/fiche/{id}'
    public function fiche($id) 
    {
        return "Employe $id";
    }

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

    public function show()
    {

    }
}
