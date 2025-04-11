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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        try {
            $worker->delete();
            return redirect()->route('operatori.index')->with('success', 'Operatore (' . $worker->codice_operatore . ') eliminato!');
        } catch (\Exception $e) {
            return redirect()->route('operatori.index')->with('error', 'Errore durante l\'eliminazione dell\'operatore!');
        }
    }
}
