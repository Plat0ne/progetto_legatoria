<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class LavorazioniTaglio extends Model
{
    //use HasApiTokens, Notifiable;
    use HasFactory;

    protected $table = 'lavorazioni_taglio';
    protected $primaryKey = 'id_lavorazione';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fase_id',
        'codice_operatore',
        'codice_commessa',
        'codice_macchina',
        'start_segnatura',
        'end_segnatura',
        'qta_fogli',
        'qta_fogli_lavorati',
        'timestamp_inizio',
        'timestamp_fine',
    ];

    //metodo che ritorna lavorazioni in un range di date
    public function scopeBetweenDates($query, $start_date, $end_date) {
        return $query->whereBetween('timestamp_inizio', [$start_date, $end_date]);
    }
}

