@extends('admin.main-layout')

@section('main')
    <div class="container">
        <h2 class="mb-4 text-primary"><i class="fas fa-chart-bar"></i> Report Orari Operatori</h2>
        <p class="text-muted mb-4">Intervallo: <strong>{{ $data_inizio }}</strong> - <strong>{{ $data_fine }}</strong></p>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="GET" action="{{ route('admin.statistiche.orari') }}" class="row g-3 mb-5">
            <div class="col-md-9">
                <label for="daterange" class="form-label fw-bold">Intervallo Date</label>
                <input type="text" class="form-control shadow-sm" id="daterange" name="daterange"
                    value="{{ request('daterange', now()->startOfYear()->format('d/m/Y') . ' - ' . now()->endOfYear()->format('d/m/Y')) }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-success w-100 shadow-sm" type="submit">
                    <i class="bi bi-filter-circle me-1"></i> Filtra
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table id="datatable-generic" class="table table-bordered table-striped table-dark" style="">
                <thead class="thead-light">
                    <tr>
                        <th class="NoSearchbar"><strong>Data</strong></th>
                        <th><strong>Codice Operatore</strong></th>
                        <th><strong>Taglio</strong></th>
                        <th><strong>Piegatura</strong></th>
                        <th><strong>Raccolta</strong></th>
                        <th><strong>Cucitura</strong></th>
                        <th><strong>Brossura</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orari as $operatore)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($operatore->data_lavorazione)->format('d/m/Y') }}</td>
                        <td>{{ $operatore->codice_operatore }}</td>
                        <td>{{ gmdate('H:i', $operatore->tempo_taglio) }} h</td>
                        <td>{{ gmdate('H:i', $operatore->tempo_piegatura) }} h</td>
                        <td>{{ gmdate('H:i', $operatore->tempo_raccolta) }} h</td>
                        <td>{{ gmdate('H:i', $operatore->tempo_cucitura) }} h</td>
                        <td>{{ gmdate('H:i', $operatore->tempo_brossura) }} h</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts_pagine_secondarie')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script>
        $(function () {
            moment.locale('it');

            $('#daterange').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Applica',
                    cancelLabel: 'Annulla',
                    fromLabel: 'Da',
                    toLabel: 'A',
                    customRangeLabel: 'Personalizza',
                    weekLabel: 'S',
                    daysOfWeek: moment.weekdaysMin(),
                    monthNames: moment.months(),
                    firstDay: 1
                }
            });
        });
    </script>
@endsection

