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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour chaque cotisation
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idtontine');
            $table->integer('montant');
            $table->enum('moyen_paiement', ['ESPECES', 'WAVE', 'OM']);
            $table->timestamps(); // Ajoute les colonnes created_at et updated_at

            // Ajout des clés étrangères
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idtontine')->references('id')->on('tontines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
