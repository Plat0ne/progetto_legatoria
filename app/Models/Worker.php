<?php

namespace App\Models;

use App\Http\Controllers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_operatore';
    public $incrementing = true;
    protected $keyType = 'int';

    
    protected $fillable = [
        'codice_operatore',
        'numero_operatore',
    ];

    public function getRouteKeyName()
    {
        return 'id_operatore';
    }
}
