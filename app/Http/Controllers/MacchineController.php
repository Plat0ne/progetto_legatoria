<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Macchine;
use App\Http\Controllers\Controller;

class MacchineController extends Controller
{

    public function index()
    {
        $macchine=Macchine::orderBy('codice_macchina', 'desc')->get();
        
        return view('admin.crud_macchine.index', [
            'title' => 'Macchine',
            'macchine' => $macchine
        ]);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codice_macchina' => 'required|string|unique:macchine,codice_macchina',
            'suffisso_macchina' => 'required|string'
        ]);

        try {
            $macchina = Macchine::create([
                'codice_macchina' => $request->codice_macchina,
                'suffisso_macchina' => $request->suffisso_macchina
            ]);
        
            if (!$macchina) {
                return response()->json(['success' => false, 'message' => 'errore interno, Macchina nulla'], 422);
            }
        
            return response()->json(['success' => true, 'message' => 'Macchina creata con successo!'], 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Eccezione: ' . $e->getMessage()], 422);
        }
    }

    public function update(Request $request, Macchine $macchina)
    {
        $request->validate([
            'codice_macchina' => 'required|string|unique:macchine,codice_macchina',
            'suffisso_macchina' => 'required|string'
        ]);

        try {
            $macchina->update([
                'codice_operatore' => $request->codice_operatore,
                'suffisso_operatore' => $request->suffisso_operatore
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Macchina aggiornata con successo!'
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Eccezione: ' . $e->getMessage(),
                'errors' => $request->errors()
            ], 422);
        }
    }

    public function destroy(Macchine $macchina)
    {

        if (empty($macchina->id_macchina)) {
            return redirect()->route('macchine.index')->with('error', 'Codice macchina non disponibile! '. $macchina);
        }
        try {
            $macchina->delete();
            return redirect()->route('macchine.index')->with('success', 'macchina (' . $macchina->codice_macchina . ') eliminata!');
        } catch (\Exception $e) {
            return redirect()->route('macchine.index')->with('error', 'Errore durante l\'eliminazione della macchina!');
        }
    }


    
}
