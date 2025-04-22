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
            <table id="datatable-generic" class="table table-bordered table-striped table-dark" style="">
                <thead class="thead-light">
                    <tr>
                        <th><strong>Timestamp Inizio</strong></th>
                        <th><strong>Timestamp Fine</strong></th>
                        <th><strong>Codice Operatore</strong></th>
                        <th><strong>Codice Commessa</strong></th>
                        <th><strong>Codice Macchina</strong></th>
                        <th><strong>Start Segnatura</strong></th>
                        <th><strong>End Segnatura</strong></th>
                        <th><strong>Qta Fogli</strong></th>
                        <th><strong>Qta Fogli Lavorati</strong></th>                        
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach($registrazioni_taglio as $lavorazione)
                    <tr id="row-{{ $lavorazione->id }}">

                        <td>{{ \Carbon\Carbon::parse($lavorazione->timestamp_inizio)->format('d/m/Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($lavorazione->timestamp_fine)->format('d/m/Y H:i') }}</td>
                        <td>{{ $lavorazione->codice_operatore }}</td>
                        <td>{{ $lavorazione->codice_commessa }}</td>
                        <td>{{ $lavorazione->codice_macchina }}</td>
                        <td>{{ $lavorazione->start_segnatura }}</td>
                        <td>{{ $lavorazione->end_segnatura }}</td>
                        <td>{{ $lavorazione->qta_fogli }}</td>
                        <td>{{ $lavorazione->qta_fogli_lavorati }}</td>
                        
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
