<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticationController extends Controller
{
   public function ottineni_pagina_login()
    {
        return view('welcome');
    }

    public function tentativoLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            session(['name' => auth()->user()->name]);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'nomeUtente' => auth()->user()->name]);
            }
            return redirect()->route('welcome')->with('success', 'Loggato con successo!');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Le credenziali non sono valide! Riprova.'
            ], 401);
        }

        return redirect()->back()->withErrors([
            'all' => 'Le credenziali non sono valide! Riprova.'
        ]);
    }


    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect()->route('welcome')->with('success','Logout effettuato con successo!');
    }
}

