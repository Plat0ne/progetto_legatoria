<?php

namespace App\Models;

use App\Http\Controllers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Worker
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $primaryKey = 'id_operatore';

    protected $fillable = [
        'codice_operatore',
        'numero_operatore',
    ];
}
