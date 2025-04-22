<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LavorazioniBrossura;
use App\Http\Controllers\Controller;



class LavorazioniBrossuraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrazioni_brossura = LavorazioniBrossura::orderByDesc('timestamp_inizio')->get();
        $data=[
            'title' => 'Tempi Brossura',
            'registrazioni_brossura' => $registrazioni_brossura
        ];
        return view('admin.lavorazioni.brossura', $data);
        
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
