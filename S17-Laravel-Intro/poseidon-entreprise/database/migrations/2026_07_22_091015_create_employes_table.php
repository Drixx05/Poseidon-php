<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string("nom", 50)->nullable();
            $table->string("prenom", 30)->nullable();
            $table->string("email")->nullable();
            $table->enum("sexe", ["m", "f"]);
            $table->string("service", 30)->nullable();
            $table->date("date_embauche")->nullable();
            $table->float("salaire")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
