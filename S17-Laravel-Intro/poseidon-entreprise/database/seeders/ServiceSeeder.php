<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'nom' => 'Direction',
            'responsable' => 'Jean-Pierre Laborde',
            'telephone' => '01 40 12 34 56',
        ]);

        Service::factory()->count(20)->create();
    }
}