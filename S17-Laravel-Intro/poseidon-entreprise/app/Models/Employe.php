<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';

    protected $fillable = ['prenom', 'nom', 'sexe', 'service', 'date_embauche', 'salaire'];

    protected $casts = [
    'date_embauche' => 'date',
    'salaire' => 'decimal:2',
    ];
}