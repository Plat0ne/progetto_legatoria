<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_pagina';
    protected $fillable = [
        'nome_pagina',
        'nome_intestazione_pagina',
        'icona_intestazione_pagina',
        'subgroup_pagina',
        'order_pagina',
        'attivo_pagina'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function tutto()
    {
        return Page::orderBy('order_pagina')->get();
    }

    public static function getPagesSubgroup($subgroup) {
        return Page::where('subgroup_pagina', $subgroup)->orderBy('order_pagina')->get();
    }
}
