<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{LavorazioniTaglio,LavorazioniPiega,LavorazioniRaccolta,LavorazioniCucitura,LavorazioniBrossura};

class ProduzioneController extends Controller
{
    public function home()
    {
        return view('produzione.home_produzione',[
            'title' => 'Produzione'
        ]);

    }

    public function taglio(){
        return view('produzione.taglio',[
            'title' => 'Taglio',
            'lavorazioni' => LavorazioniTaglio::where('timestamp_inizio', null)->get()
        ]);
    }

    public function piega(){
        return view('produzione.piega',[
            'title' => 'Piega'
        ]);
    }    

    public function raccolta(){
        return view('produzione.raccolta',[
            'title' => 'Raccolta'
        ]);
    }

    public function cucitura(){
        return view('produzione.cucitura',[
            'title' => 'Cucitura'
        ]);
    }

    public function brossura(){
        return view('produzione.brossura',[
            'title' => 'Brossura'
        ]);
    }
    
}
