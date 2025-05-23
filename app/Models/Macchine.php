<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Macchine extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_macchina';
    protected $table = 'macchine';
    public $incrementing = true;    

    protected $keyType = 'int';
    public $timestamps = false;


    protected $fillable = [
        'nome_macchina',
        'codice_macchina',
        'suffisso_macchina'
    ];

    public function getRouteKeyName()
    {
        return 'id_macchina';
    }
}
