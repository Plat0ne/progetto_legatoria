<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavorazioniCucitura extends Model
{
    use HasFactory;

    protected $table = 'lavorazioni_cucitura';
    protected $primaryKey = 'id_lc';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fase_id',
        'codice_operatore',
        'codice_commessa',
        'codice_macchina',
        'macchina_condivisa',
        'segnatura',
        'segnatura_finita',
        'n_colpi_start',
        'n_colpi_end',
        'timestamp_inizio',
        'timestamp_fine',
    ];

    //metodo che ritorna lavorazioni in un range di date
    public function scopeBetweenDates($query, $start_date, $end_date) {
        return $query->whereBetween('timestamp_inizio', [$start_date, $end_date]);
    }
}

