<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LavorazioniCucitura;
use App\Http\Controllers\Controller;


class LavorazioniCucituraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrazioni_cucitura = LavorazioniCucitura::orderByDesc('timestamp_inizio')->get();
        $data=[
            'title' => 'Tempi Cucitura',
            'registrazioni_cucitura' => $registrazioni_cucitura
        ];
        return view('admin.lavorazioni.cucitura', $data);
        
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
    public function destroy(string $id)
    {
        //
    }
}

