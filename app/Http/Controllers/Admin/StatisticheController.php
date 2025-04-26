<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\LavorazioniTaglio;
use App\Models\LavorazioniPiega;
use App\Models\LavorazioniRaccolta;
use App\Models\LavorazioniCucitura;
use App\Models\LavorazioniBrossura;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticheController extends Controller
{
    public function genera_report_fasi(Request $request)
    {
        $range = $request->input('daterange');

        if (!$range) {
            $data_inizio = now()->startOfYear()->toDateString();
            $data_fine = now()->endOfYear()->toDateString();
        } else {
            [$start, $end] = explode(' - ', $range);
            $data_inizio = date('Y-m-d', strtotime(str_replace('/', '-', $start)));
            $data_fine = date('Y-m-d', strtotime(str_replace('/', '-', $end)));
        }

        if (strtotime($data_fine) < strtotime($data_inizio)) {
            return redirect()->back()->withErrors(['Le date selezionate non sono valide']);
        }

        // Raccolta dati
        $taglio = LavorazioniTaglio::whereBetween('timestamp_inizio', [$data_inizio, $data_fine])->get();
        $piega = LavorazioniPiega::whereBetween('timestamp_inizio', [$data_inizio, $data_fine])->get();
        $raccolta = LavorazioniRaccolta::whereBetween('timestamp_inizio', [$data_inizio, $data_fine])->get();
        $cucitura = LavorazioniCucitura::whereBetween('timestamp_inizio', [$data_inizio, $data_fine])->get();
        $brossura = LavorazioniBrossura::whereBetween('timestamp_inizio', [$data_inizio, $data_fine])->get();

        // Calcolo durata totale per fase
        $calcolaDurata = fn ($collezione) =>
            $collezione->reduce(fn ($carry, $item) =>
                $carry + Carbon::parse($item->timestamp_fine)->diffInSeconds(Carbon::parse($item->timestamp_inizio)), 0
            );
        
        $secondi_to_ore = fn ($s) => $s > 0 ? $s / 3600 : 1;

        $statistiche = [
            'Taglio' => [
                'totale_fogli' => $taglio->sum('qta_fogli'),
                'fogli_lavorati' => $taglio->sum('qta_fogli_lavorati'),
                'durata' => $durata = $calcolaDurata($taglio),
                'efficienza' => $taglio->sum('qta_fogli') > 0
                    ? round(($taglio->sum('qta_fogli_lavorati') / $taglio->sum('qta_fogli')) * 100, 2)
                    : 0,
            ],
            'Piega' => [
                'copie_lavorate' => $copie = $piega->sum(fn ($item) => ($item->n_copie_end - $item->n_copie_start)),
                'durata' => $durata = $calcolaDurata($piega),
                'efficienza' => round($copie / $secondi_to_ore($durata), 2),
            ],
            'Raccolta' => [
                'conteggio' => $conteggio = $raccolta->count(),
                'durata' => $durata = $calcolaDurata($raccolta),
                'efficienza' => round($conteggio / $secondi_to_ore($durata), 2),
            ],
            'Cucitura' => [
                'colpi_lavorati' => $colpi = $cucitura->sum(fn ($item) => ($item->n_colpi_end - $item->n_colpi_start)),
                'durata' => $durata = $calcolaDurata($cucitura),
                'efficienza' => round($colpi / $secondi_to_ore($durata), 2),
            ],
            'Brossura' => [
                'conteggio' => $conteggio = $brossura->count(),
                'durata' => $durata = $calcolaDurata($brossura),
                'efficienza' => round($conteggio / $secondi_to_ore($durata), 2),
            ],
        ];

        $data_inizio=date('d/m/Y',strtotime($data_inizio));
        $data_fine=date('d/m/Y',strtotime($data_fine));

        return view('admin.statistiche.fasi', [
            'title' => "Statistiche Generali ( $data_inizio - $data_fine )",
            'statistiche' => $statistiche,
            'data_inizio' => $data_inizio,
            'data_fine' => $data_fine
        ]);
    }


    public function genera_report_orari(Request $request){
        #TODO

    }

    public function raccolta(Request $request){

    }

    public function cucitura(Request $request){

    }

    public function brossura(Request $request){

    }
}

