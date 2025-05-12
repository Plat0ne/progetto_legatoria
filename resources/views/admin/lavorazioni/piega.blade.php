@extends('admin.main-layout')

@section('main')

<div >
    @if(session('success'))
        <div class="alert alert-success" id="session_alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="session_alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table id="datatable-generic" class="table table-bordered table-striped table-dark" >
            <thead class="thead-light">
                <tr>
                    <th class="NoSearchbar"><strong>ID</strong></th>
                    <th><strong>Codice Operatore</strong></th>
                    <th><strong>Codice Commessa</strong></th>
                    <th><strong>Codice Macchina</strong></th>
                    <th><strong>Macchina Condivisa</strong></th>
                    <th><strong>Segnatura</strong></th>
                    <th><strong>N Copie Start</strong></th>
                    <th><strong>N Copie End</strong></th>
                    <th><strong>Timestamp Inizio</strong></th>
                    <th><strong>Timestamp Fine</strong></th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($registrazioni_piega as $lavorazione)
                <tr id="row-{{ $lavorazione->id_lp }}">

                    <td>{{ $lavorazione->id_lp }}</td>
                    <td>{{ $lavorazione->codice_operatore }}</td>
                    <td>{{ $lavorazione->codice_commessa }}</td>
                    <td>{{ $lavorazione->codice_macchina }}</td>
                    <td>{{ $lavorazione->macchina_condivisa }}</td>
                    <td>{{ $lavorazione->segnatura }}</td>
                    <td>{{ $lavorazione->n_copie_start }}</td>
                    <td>{{ $lavorazione->n_copie_end }}</td>
                    <td>{{ $lavorazione->timestamp_inizio ? \Carbon\Carbon::parse($lavorazione->timestamp_inizio)->format('d/m/Y H:i') : $lavorazione->timestamp_inizio }}</td>
                    <td>{{ $lavorazione->timestamp_fine ? \Carbon\Carbon::parse($lavorazione->timestamp_fine)->format('d/m/Y H:i') : $lavorazione->timestamp_fine }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts_pagine_secondarie')
@endsection

