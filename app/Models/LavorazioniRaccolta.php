<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class LavorazioniRaccolta extends Model
{
    //use HasApiTokens, Notifiable;
    use HasFactory;

    protected $table = 'lavorazioni_raccolta';
    protected $primaryKey = 'id_lr';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

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

