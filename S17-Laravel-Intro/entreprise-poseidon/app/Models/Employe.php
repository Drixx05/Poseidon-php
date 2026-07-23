<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    //
    // protected $primaryKey = 'id_employes';
    use HasFactory;

    protected $fillable = [
        "nom",
        "prenom",
        "sexe",
        "service",
        "date_embauche",
        "salaire"
    ];
}
