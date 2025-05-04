@extends('produzione.main-layout_produzione')

@section("icon")
<i class="fas fa-cut"></i>
@endsection

@section('main')

    <div class="container-fluid mt-1 h-100">

        <div id="lavorazioniContainer">
            @foreach($lavorazioni as $l)
                <div id="carta_lavorazione" class="card lavorazione-item" data-seriale="{{ strtolower($l['id_lavorazione']) }}">
                    <div class="card-body">
                        <div class="row mb-2 justify-content-center">
                            <div class="col">

                                {{ $l['id_lavorazione'] }}
                                <h1 class="display-5 fw-bold text-primary"><strong>{{ $l['codice_operatore'] }} ({{ date('H:i',strtotime($l['timestamp_inizio'])) }})</strong></h1>
                            </div>
                            <div class="row">
                                <div class="col ">
                                    Cod. Commessa: <br>
                                    <h2 class="fw-bold">{{ $l['codice_commessa'] }}</h2>
                                </div>
                               
                                <div class="col ">
                                    Cod. Macchina: <br>
                                    <h2 class="fw-bold">{{ $l['codice_macchina'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 justify-content-between">
                            <div class="col">
                                <button type="button" class="btn btn-warning w-100 text-dark" onclick="init_modal_fine('{{ $l['id_lavorazione'] }}', '{{ $l['codice_operatore'] }}')"><i class="fas fa-sign-out-alt"></i>&nbsp;ESCI</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="hr-color-black">
            @endforeach
        </div>

        @include('produzione.modals.modal_uscita')

        <div class="fixed-bottom p-2">
            <div class="btn-xxl">
                <a href="{{ route('produzione.home') }}" class="btn btn-info d-flex align-items-center justify-content-center" style="width: 100%; height: 60px;  font-size: 2.5rem; ">ENTRA</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts_pagine_secondarie')
<script>
    function init_modal_fine(id_lavorazione, codice_operatore){
        //impostiamo il titolo alla modal:
        document.getElementById('uscitaModalLabel').innerHTML = codice_operatore + ", sei sicuro di terminare questa lavorazione?";
        //impostiamo l' id_lavorazione:
        document.getElementById('id_lavorazione').value = id_lavorazione;

        //apriamola modal
        var myModal = document.getElementById('modal_uscita');
        var modal = new bootstrap.Modal(myModal);
        modal.show();
    }    
</script>    

@endsection
