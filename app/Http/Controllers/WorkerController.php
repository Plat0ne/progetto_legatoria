<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{

    public function index()
    {
        $workers=Worker::orderBy('created_at', 'desc')->get();
        return view('admin.crud_operatori.index', [
            'title' => 'Operatori',
            'workers' => $workers
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
            'codice_operatore' => 'required|string|unique:workers,codice_operatore',
            'numero_operatore' => 'required|string|unique:workers,numero_operatore'
        ]);

        try {
            $worker = Worker::create([
                'codice_operatore' => $request->codice_operatore,
                'numero_operatore' => $request->numero_operatore
            ]);
        
            if (!$worker) {
                return response()->json(['success' => false, 'message' => 'errore interno, operatore nullo'], 422);
            }
        
            return response()->json(['success' => true, 'message' => 'Operatore creato con successo!'], 200);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Eccezione: ' . $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'codice_operatore' => 'required|string|unique:workers,codice_operatore,' . $worker->id_operatore . ',id_operatore',
            'numero_operatore' => 'required|string|unique:workers,numero_operatore,' . $worker->id_operatore . ',id_operatore'
        ]);

        try {
            $worker->update([
                'codice_operatore' => $request->codice_operatore,
                'numero_operatore' => $request->numero_operatore
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Operatore aggiornato con successo!'
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
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        if (empty($worker->codice_operatore)) {
            return redirect()->route('operatori.index')->with('error', 'Codice operatore non disponibile! '. $worker);
        }
        try {
            $worker->delete();
            return redirect()->route('operatori.index')->with('success', 'Operatore (' . $worker->codice_operatore . ') eliminato!');
        } catch (\Exception $e) {
            return redirect()->route('operatori.index')->with('error', 'Errore durante l\'eliminazione dell\'operatore!');
        }
    }
}
