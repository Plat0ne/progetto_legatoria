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
        Schema::create('lavorazioni_cucitura', function (Blueprint $table) {
            $table->id('id_lc');
            $table->integer('fase_id');
            $table->string('codice_operatore');
            $table->string('codice_commessa');
            $table->string('codice_macchina');
            $table->string('macchina_condivisa');
            $table->string('segnatura');
            $table->string('segnatura_finita');
            $table->unsignedInteger('n_colpi_start');
            $table->unsignedInteger('n_colpi_end');
            $table->unsignedInteger('pacchetto');
            $table->unsignedInteger('sottopacchetto');
            $table->timestamp('timestamp_inizio');
            $table->timestamp('timestamp_fine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavorazioni_cucitura');
    }
};

