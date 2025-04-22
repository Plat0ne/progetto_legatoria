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
        Schema::create('lavorazioni_brossura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fase_id');
            $table->foreign('fase_id')->references('id')->on('fasi');
            $table->string('codice_operatore');
            $table->string('codice_commessa');
            $table->string('codice_macchina');
            $table->boolean('macchina_condivisa')->default(false);
            $table->string('segnatura')->nullable();
            $table->boolean('segnatura_finita')->default(false);
            $table->unsignedInteger('n_copie_start')->nullable();
            $table->unsignedInteger('n_copie_end')->nullable();
            $table->string('pacchetto')->nullable();
            $table->string('sottopacchetto')->nullable();
            $table->timestamp('timestamp_inizio');
            $table->timestamp('timestamp_fine')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavorazioni_brossura');
    }
};

