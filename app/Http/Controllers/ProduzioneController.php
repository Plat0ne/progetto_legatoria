<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{LavorazioniTaglio,LavorazioniPiega,LavorazioniRaccolta,LavorazioniCucitura,LavorazioniBrossura};
use App\Models\Worker;

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
            'lavorazioni' => LavorazioniTaglio::where('timestamp_fine', null)->get()
        ]);
    }
    public function uscita_taglio(Request $data, $id_lavorazione){ 

        $this->validate($data, [
            'fogli_lavorati' => 'required',
        ],[
            'fogli_lavorati.required' => 'Inserire il numero di fogli lavorati',
        ]);

        if(!is_numeric($data->fogli_lavorati) || $data->fogli_lavorati <= 0){
            return response()->json(['success' => false, 'message' => "Il numero di fogli lavorati deve essere maggiore di zero"], 422);
        }

        try {
            $lavorazione = LavorazioniTaglio::find($id_lavorazione);
            $lavorazione->timestamp_fine = now();
            $lavorazione->qta_fogli_lavorati = $data->fogli_lavorati;
            $lavorazione->save();
            return response()->json(['success' => true, 'message' => "success modified lavorazione number $id_lavorazione"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "error modified lavorazione number $id_lavorazione"], 422);
        }
    }
    public function entrata_taglio(Request $data){

        $this->validate($data, [
            'codice_commessa' => 'required',
            'codice_macchina' => 'required',
            'codice_operatore' => 'required',
            'quantita_fogli' => 'required',
            'inizio_segnatura' => 'required',
            'fine_segnatura' => 'required',
        ], [
            'codice_commessa.required' => 'Il codice commessa è obbligatorio',
            'codice_macchina.required' => 'Il codice macchina è obbligatorio',
            'codice_operatore.required' => 'Il codice operatore è obbligatorio',
            'quantita_fogli.required' => 'La quantità di fogli è obbligatoria',
            'inizio_segnatura.required' => 'L\'inizio segnatura è obbligatorio',
            'fine_segnatura.required' => 'La fine segnatura è obbligatoria',
        ]);
        $operatore = Worker::where('codice_operatore', $data->codice_operatore)->first();
        if(!$operatore){
            return response()->json(['success' => false, 'message' => "operatore $data->codice_operatore non trovato"],422);
        }
        if(!is_numeric($data->quantita_fogli) || $data->quantita_fogli <= 0){
            return response()->json(['success' => false, 'message' => "La quantità di fogli deve essere maggiore di zero"],422);
        }

        try {
            $lavorazione = LavorazioniTaglio::create([
                'timestamp_inizio' => now(),
                'fase_id' => 1,
                'codice_commessa' => $data->codice_commessa,
                'codice_macchina' => $data->codice_macchina,
                'codice_operatore' => $data->codice_operatore,
                'qta_fogli' => $data->quantita_fogli,
                'start_segnatura' => $data->inizio_segnatura,
                'end_segnatura' => $data->fine_segnatura,
            ]);
        
            return response()->json(['success' => true, 'message' => "Lavorazione creata con successo", 'id' => $lavorazione->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Errore durante la creazione della lavorazione: " . $e->getMessage()], 422);
        }

    }



    public function piega(){
        return view('produzione.piega',[
            'title' => 'Piega',
            'lavorazioni' => LavorazioniPiega::where('timestamp_fine', null)->get()
        ]);
    }  
    public function uscita_piega(Request $data, $id_lavorazione){ 

        $this->validate($data, [
            'copie_lavorate_fine' => 'required',
        ],[
            'copie_lavorate_fine.required' => 'Inserire il numero di fogli lavorati',
        ]);

        if(!is_numeric($data->copie_lavorate_fine) || $data->copie_lavorate_fine <= 0){
            return response()->json(['success' => false, 'message' => "Il numero di fogli lavorati deve essere maggiore di zero", 422]);
        }

        try {
            $lavorazione = LavorazioniPiega::find($id_lavorazione);

            if(($lavorazione->n_copie_start != null) && ($lavorazione->n_copie_start < $data->copie_lavorate_fine)){
                return response()->json(['success' => false, 'message' => "Il numero di fogli lavorati deve essere maggiore di $lavorazione->n_copie_start"], 422);
            }

            $lavorazione->timestamp_fine = now();
            $lavorazione->n_copie_end = $data->copie_lavorate_fine;
            $lavorazione->save();
            return response()->json(['success' => true, 'message' => "success modified lavorazione number $id_lavorazione"]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "error modified lavorazione number, error: " . $e->getMessage()], 422);
        }
    }
    public function entrata_piega(Request $data){
        $this->validate($data, [
            'codice_commessa' => 'required',
            'codice_macchina' => 'required',
            'codice_operatore' => 'required',
            'segnatura' => 'required',
            'n_copie_inizio' => 'required',
            'macchina_condivisa' => 'required',
        ],
        [
            'codice_commessa.required' => 'La commessa é obbligatoria',
            'codice_macchina.required' => 'La macchina é obbligatoria',
            'codice_operatore.required' => 'L\'operatore é obbligatoria',
            'segnatura.required' => 'La segnatura é obbligatoria',
            'n_copie_inizio.required' => 'Il numero di copie inizio é obbligatoria',
            'macchina_condivisa.required' => 'La macchina condivisa é obbligatoria',
        ]
        );

        $operatore = Worker::where('codice_operatore', $data->codice_operatore)->first();
        if(!$operatore){
            return response()->json(['success' => false, 'message' => "operatore $data->codice_operatore non trovato", 422]);
        }

        if(!is_numeric($data->n_copie_inizio) || $data->n_copie_inizio <= 0){
            return response()->json(['success' => false, 'message' => "Il numero di copie inizio deve essere maggiore di zero", 422]);
        }

        if(!preg_match('/^[0-9]{1,6}$/', $data->segnatura)){
            return response()->json(['success' => false, 'message' => "La segnatura deve essere composta da 1 a 6 numeri", 422]);
        }
        

        try{
            LavorazioniPiega::create([
                'fase_id' => 2,
                'codice_commessa' => $data->codice_commessa,
                'codice_macchina' => $data->codice_macchina,
                'codice_operatore' => $data->codice_operatore,
                'segnatura' => $data->segnatura,
                'n_copie_start' => $data->n_copie_inizio,
                'macchina_condivisa' => $data->macchina_condivisa,
                'timestamp_inizio' => now()
            ]);
            return response()->json(['success' => true, 'message' => "success created lavorazione"]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "error created lavorazione, error: " . $e->getMessage()], 422);
        }
        
    }

    public function raccolta(){
        return view('produzione.raccolta',[
            'title' => 'Raccolta',
            'lavorazioni' => LavorazioniRaccolta::where('timestamp_fine', null)->get()
        ]);
    }

    public function cucitura(){
        return view('produzione.cucitura',[
            'title' => 'Cucitura',
            'lavorazioni' => LavorazioniCucitura::where('timestamp_fine', null)->get()
        ]);
    }

    public function brossura(){
        return view('produzione.brossura',[
            'title' => 'Brossura',
            'lavorazioni' => LavorazioniBrossura::where('timestamp_fine', null)->get()
        ]);
    }
    
}
