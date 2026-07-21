<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExerciceController extends Controller
{
    protected array $employes = [
        ['id' => '350', 'prenom' => 'Jean-pierre', 'nom' => 'Laborde', 'sexe' => 'm', 'service' => 'direction', 'date_embauche' => '2010-12-09', 'salaire' => '5000'],
        ['id' => '388', 'prenom' => 'Clement', 'nom' => 'Gallet', 'sexe' => 'm', 'service' => 'commercial', 'date_embauche' => '2010-12-15', 'salaire' => '2300'],
        ['id' => '415', 'prenom' => 'Thomas', 'nom' => 'Winter', 'sexe' => 'm', 'service' => 'commercial', 'date_embauche' => '2011-05-03', 'salaire' => '3550'],
        ['id' => '417', 'prenom' => 'Chloe', 'nom' => 'Dubar', 'sexe' => 'f', 'service' => 'production', 'date_embauche' => '2011-09-05', 'salaire' => '1900'],
        ['id' => '491', 'prenom' => 'Elodie', 'nom' => 'Fellier', 'sexe' => 'f', 'service' => 'secretariat', 'date_embauche' => '2011-11-22', 'salaire' => '1600'],
        ['id' => '509', 'prenom' => 'Fabrice', 'nom' => 'Grand', 'sexe' => 'm', 'service' => 'comptabilite', 'date_embauche' => '2011-12-30', 'salaire' => '2900'],
        ['id' => '547', 'prenom' => 'Melanie', 'nom' => 'Collier', 'sexe' => 'f', 'service' => 'commercial', 'date_embauche' => '2012-01-08', 'salaire' => '3100'],
        ['id' => '592', 'prenom' => 'Laura', 'nom' => 'Blanchet', 'sexe' => 'f', 'service' => 'direction', 'date_embauche' => '2012-05-09', 'salaire' => '4500'],
        ['id' => '627', 'prenom' => 'Guillaume', 'nom' => 'Miller', 'sexe' => 'm', 'service' => 'commercial', 'date_embauche' => '2012-07-02', 'salaire' => '1900'],
        ['id' => '655', 'prenom' => 'Celine', 'nom' => 'Perrin', 'sexe' => 'f', 'service' => 'commercial', 'date_embauche' => '2012-09-10', 'salaire' => '2700'],
        ['id' => '699', 'prenom' => 'Julien', 'nom' => 'Cottet', 'sexe' => 'm', 'service' => 'secretariat', 'date_embauche' => '2013-01-05', 'salaire' => '1390'],
        ['id' => '701', 'prenom' => 'Mathieu', 'nom' => 'Vignal', 'sexe' => 'm', 'service' => 'informatique', 'date_embauche' => '2013-04-03', 'salaire' => '2500'],
        ['id' => '739', 'prenom' => 'Thierry', 'nom' => 'Desprez', 'sexe' => 'm', 'service' => 'secretariat', 'date_embauche' => '2013-07-17', 'salaire' => '1500'],
        ['id' => '780', 'prenom' => 'Amandine', 'nom' => 'Thoyer', 'sexe' => 'f', 'service' => 'communication', 'date_embauche' => '2014-01-23', 'salaire' => '2100'],
        ['id' => '802', 'prenom' => 'Damien', 'nom' => 'Durand', 'sexe' => 'm', 'service' => 'informatique', 'date_embauche' => '2014-07-05', 'salaire' => '2250'],
        ['id' => '854', 'prenom' => 'Daniel', 'nom' => 'Chevel', 'sexe' => 'm', 'service' => 'informatique', 'date_embauche' => '2015-09-28', 'salaire' => '3100'],
        ['id' => '876', 'prenom' => 'Nathalie', 'nom' => 'Martin', 'sexe' => 'f', 'service' => 'juridique', 'date_embauche' => '2016-01-12', 'salaire' => '3550'],
        ['id' => '900', 'prenom' => 'Benoit', 'nom' => 'Lagarde', 'sexe' => 'm', 'service' => 'production', 'date_embauche' => '2016-06-03', 'salaire' => '2550'],
        ['id' => '933', 'prenom' => 'Emilie', 'nom' => 'Sennard', 'sexe' => 'f', 'service' => 'commercial', 'date_embauche' => '2017-01-11', 'salaire' => '1800'],
        ['id' => '990', 'prenom' => 'Stephanie', 'nom' => 'Lafaye', 'sexe' => 'f', 'service' => 'assistant', 'date_embauche' => '2017-03-01', 'salaire' => '1775'],
    ];

    public function index()
    {
        $employesAvecBadge = [];

        foreach ($this->employes as $employe) {
            $employe['badge'] = $this->badgeClass($employe['service']);
            $employesAvecBadge[] = $employe;
        }

        return view('exercice', [
            'entreprise' => 'MyEntreprise',
            'employes' => $employesAvecBadge,
        ]);
    }

    private function badgeClass(string $service): string
    {
        return match ($service) {
           'informatique' => 'primary',
           'commercial' => 'success',
           default => 'secondary',
       };
    }
}