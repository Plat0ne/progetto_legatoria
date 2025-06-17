@extends('admin.main-layout')

@section('main')
    <div class="container">
        <h2 class="mb-4 text-primary"><i class="fas fa-chart-bar"></i> Report Generale</h2>
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

        <form method="GET" action="{{ route('admin.statistiche.fasi') }}" class="row g-3 mb-5">
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

        <div class="row">
            @foreach ($statistiche as $fase => $dati)
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card article-card border-0 shadow-sm h-100">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $fase }}</h5>
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="card-body">
                            <div class="article-card__image">
                                <img src="{{ asset('img/' . strtolower($fase) . '.png') }}" alt="{{ $fase }}">
                            </div>
                        <div class="card-body">
                            <p class="mb-1">
                                @if ($fase == 'Taglio')
                                    <strong>Fogli:</strong> {{ $dati['fogli_lavorati'] }} / {{ $dati['totale_fogli'] }}
                                @elseif ($fase == 'Piega')
                                    <strong>Copie piegate:</strong> {{ $dati['copie_lavorate'] }}
                                @elseif ($fase == 'Cucitura')
                                    <strong>Colpi cuciti:</strong> {{ $dati['colpi_lavorati'] }}
                                @else
                                    <strong>Lavorazioni:</strong> {{ $dati['conteggio'] }}
                                @endif
                            </p>
                            <p class="mb-1"><strong>Durata Totale:</strong> {{ gmdate('H:i:s', $dati['durata']) }}</p>
                            <p class="mb-0">
                                <strong>Efficienza:</strong>
                                @if ($fase == 'Taglio')
                                    {{ $dati['efficienza'] }}%
                                @else
                                    {{ $dati['efficienza'] }} pezzi/ora
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
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
