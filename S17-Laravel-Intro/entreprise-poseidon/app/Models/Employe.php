<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    //
    // protected $primaryKey = 'id_employes';

    protected $fillable = [
        "nom",
        "sexe",
        "service",
        "date_embauche",
        "salaire"
    ];
}
