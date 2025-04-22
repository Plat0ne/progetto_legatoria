@extends('admin.main-layout')

@section('main')
    <h2>Statistiche Taglio ({{ $data_inizio }} - {{ $data_fine }})</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Totale fogli</h6>
                </div>
                <div class="card-body">
                    <p class="m-0">{{ $totaleFogli }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Totale fogli lavorati</h6>
                </div>
                <div class="card-body">
                    <p class="m-0">{{ $totaleLavorati }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Durata totale lavorazione</h6>
                </div>
                <div class="card-body">
                    <p class="m-0">{{ gmdate('H:i:s', $durataTotaleSecondi) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Tempo medio per foglio</h6>
                </div>
                <div class="card-body">
                    <p class="m-0">{{ number_format($tempoMedioPerFoglio, 2) }} secondi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Lavorazioni</h6>
                </div>
                <div class="card-body">
                    <table id="datatable-generic" class="table table-bordered table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Commessa</th>
                                <th>Operatore</th>
                                <th>Inizio</th>
                                <th>Fine</th>
                                <th>Q.tà Fogli</th>
                                <th>Q.tà Lavorati</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lavorazioni as $lav)
                                <tr>
                                    <td>{{ $lav->codice_commessa }}</td>
                                    <td>{{ $lav->codice_operatore }}</td>
                                    <td>{{ $lav->timestamp_inizio }}</td>
                                    <td>{{ $lav->timestamp_fine }}</td>
                                    <td>{{ $lav->qta_fogli }}</td>
                                    <td>{{ $lav->qta_fogli_lavorati }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

