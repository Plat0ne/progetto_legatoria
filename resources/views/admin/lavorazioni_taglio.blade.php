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

    <div class="container datatable-generic">

        <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#userModal" >Aggiungi Utente</button>

        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Fase ID</th>
                    <th>Codice Operatore</th>
                    <th>Codice Commessa</th>
                    <th>Codice Macchina</th>
                    <th>Start Segnatura</th>
                    <th>End Segnatura</th>
                    <th>Qta Fogli</th>
                    <th>Qta Fogli Lavorati</th>
                    <th>Timestamp Inizio</th>
                    <th>Timestamp Fine</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($registrazioni_taglio as $lavorazione)
                <tr id="row-{{ $lavorazione->id }}">
                    <td>{{ $lavorazione->fase_id }}</td>
                    <td>{{ $lavorazione->codice_operatore }}</td>
                    <td>{{ $lavorazione->codice_commessa }}</td>
                    <td>{{ $lavorazione->codice_macchina }}</td>
                    <td>{{ $lavorazione->start_segnatura }}</td>
                    <td>{{ $lavorazione->end_segnatura }}</td>
                    <td>{{ $lavorazione->qta_fogli }}</td>
                    <td>{{ $lavorazione->qta_fogli_lavorati }}</td>
                    <td>{{ $lavorazione->timestamp_inizio }}</td>
                    <td>{{ $lavorazione->timestamp_fine }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts_pagine_secondarie')
<script>


</script>
@endsection