<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavorazioniBrossura extends Model
{
    use HasFactory;

    protected $table = 'lavorazioni_brossura';
    protected $primaryKey = 'id_lb';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fase_id',
        'codice_operatore',
        'codice_commessa',
        'codice_macchina',
        'timestamp_inizio',
        'timestamp_fine',
    ];

    //metodo che ritorna lavorazioni in un range di date
    public function scopeBetweenDates($query, $start_date, $end_date) {
        return $query->whereBetween('timestamp_inizio', [$start_date, $end_date]);
    }
}

