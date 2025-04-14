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
        Schema::create('lavorazioni_taglio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fase_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('codice_operatore');
            $table->string('codice_commessa');
            $table->string('codice_macchina');
            $table->string('start_segnatura');
            $table->string('end_segnatura');
            $table->integer('qta_fogli');
            $table->integer('qta_fogli_lavorati');
            $table->timestamp('timestamp_inizio');
            $table->timestamp('timestamp_fine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavorazioni_taglio');
    }
};

