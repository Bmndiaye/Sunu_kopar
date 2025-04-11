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
        Schema::create('participant_tontine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idtontine');
            $table->timestamps();
            $table->integer('ordre')->nullable()->after('idtontine');
            $table->date('date_prevue')->nullable()->after('ordre');

            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idtontine')->references('id')->on('tontines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_tontine');
    }
};
