<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{LavorazioniTaglio,LavorazioniPiega,LavorazioniRaccolta,LavorazioniCucitura,LavorazioniBrossura};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function tempoLavoratoOggiQuery($model) {
        #per ogni fase calcolo il tempo lavorato nella giornata di oggi
        #differenze timestamp fine-inizio

        $oggi = now()->startOfDay();
        $domani = now()->copy()->addDay()->startOfDay();
    
        return $model::whereBetween('timestamp_inizio', [$oggi, $domani])
            ->whereNotNull('timestamp_fine')
            ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, timestamp_inizio, timestamp_fine)) as total_seconds')
            ->value('total_seconds') ?? 0;
    }
    
    public function dashboard(){

        $orari_giornata_fase = [
            'taglio' => gmdate('H:i', $this->tempoLavoratoOggiQuery(LavorazioniTaglio::class)),
            'piega' => gmdate('H:i', $this->tempoLavoratoOggiQuery(LavorazioniPiega::class)),
            'raccolta' => gmdate('H:i', $this->tempoLavoratoOggiQuery(LavorazioniRaccolta::class)),
            'cucitura' => gmdate('H:i', $this->tempoLavoratoOggiQuery(LavorazioniCucitura::class)),
            'brossura' => gmdate('H:i', $this->tempoLavoratoOggiQuery(LavorazioniBrossura::class)),
        ];

        $data = [
            'title'=>'Dashboard',
            'orari_giornata_fase'=>$orari_giornata_fase
        ];
        return view('admin.dashboard',$data);
    }

}

