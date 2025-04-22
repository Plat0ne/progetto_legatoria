<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\LavorazioniTaglio;
use App\Models\LavorazioniPiega;
use App\Models\LavorazioniRaccolta;
use App\Models\LavorazioniCucitura;
use App\Models\LavorazioniBrossura;
use Illuminate\Http\Request;

class StatisticheController extends Controller
{
    public function taglio(Request $request){
        $data_inizio = $request->input('start', now()->startOfYear());
        $data_fine = $request->input('end', now()->endOfYear());
    
        $lavorazioni = LavorazioniTaglio::betweenDates($data_inizio, $data_fine)->get();
    
        $totaleFogli = $lavorazioni->sum('qta_fogli');
        $totaleLavorati = $lavorazioni->sum('qta_fogli_lavorati');
    
        //Tempo totale in secondi
        $durataTotaleSecondi = $lavorazioni->reduce(function ($carry, $lav) {
            $start = \Carbon\Carbon::parse($lav->timestamp_inizio);
            $end = \Carbon\Carbon::parse($lav->timestamp_fine);
            return $carry + $end->diffInSeconds($start);
        }, 0);
    
        // Tempo medio per foglio (in secondi)
        $tempoMedioPerFoglio = $totaleLavorati > 0 ? $durataTotaleSecondi / $totaleLavorati : 0;
    
        // Efficienza %
        $efficienza = $totaleFogli > 0 ? ($totaleLavorati / $totaleFogli) * 100 : 0;
        
        return view('admin.statistiche.taglio', [
            'lavorazioni' => $lavorazioni,
            'totaleFogli' => $totaleFogli,
            'totaleLavorati' => $totaleLavorati,
            'durataTotaleSecondi' => $durataTotaleSecondi,
            'tempoMedioPerFoglio' => $tempoMedioPerFoglio,
            'efficienza' => $efficienza,
            'data_inizio' => $data_inizio,
            'data_fine' => $data_fine,
            'title' => 'Statistiche Taglio'
        ]);
    }
    
    public function piega(Request $request){

    }

    public function raccolta(Request $request){

    }

    public function cucitura(Request $request){

    }

    public function brossura(Request $request){

    }
}

