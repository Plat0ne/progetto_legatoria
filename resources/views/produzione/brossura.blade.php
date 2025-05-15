@extends('produzione.main-layout_produzione')

@section("icon")
<i class="fas fa-book-open"></i>
@endsection

@section('main')

    <div class="container-fluid mt-1 h-100">

        <div id="lavorazioniContainer">
            @foreach($lavorazioni as $l)
                <div id="carta_lavorazione_{{ strtolower($l['id_lb']) }}" class="card lavorazione-item">
                    <div class="card-body">
                        <div class="row mb-2 justify-content-center">
                            <div class="col">

                                {{ $l['id_lb'] }}
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
                                <button type="button" class="btn btn-warning w-100 text-dark" onclick="init_modal_fine('{{ $l['id_lb'] }}', '{{ $l['codice_operatore'] }}')"><i class="fas fa-sign-out-alt"></i>&nbsp;ESCI</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="hr-color-black">
            @endforeach
        </div>

        @include('produzione.modals.modal_uscita_semplice')
        @include('produzione.modals.modal_entrata_brossura')

        <div class="fixed-bottom p-2">
            <div class="btn-xxl">
                <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_entrata">
                    <i class="fas fa-sign-in-alt"></i>&nbsp;ENTRA
                </button>
            
            </div>
        </div>
    </div>

@endsection


@section('scripts_pagine_secondarie')
<script>

    //scrpit per la parte uscita __________________________________________

    let modalInstance = null;

    function init_modal_fine(id_lavorazione, codice_operatore) {
        document.getElementById('uscitaModalLabel').innerHTML = codice_operatore + ", sei sicuro di terminare questa lavorazione?";
        document.getElementById('id_lavorazione').value = id_lavorazione;


        var modale = document.getElementById('modal_uscita');
        modalInstance = new bootstrap.Modal(modale); // assegna all'istanza globale
        modalInstance.show();
    }

    $(document).ready(function() {
        document.querySelectorAll('.bottone_esci').forEach(function(button) {
            button.addEventListener('click', function() {
                const data = this.getAttribute('data-id');
                popolaFormEdit(JSON.parse(data));
            });
        });

        $('#bottone_esci').on('click', function(e) {
            e.preventDefault();
            var copie_lavorate_fine = $('#copie_lavorate_fine').val();
            var id_lavorazione = $('#id_lavorazione').val();
            var error_msg = $('#error_msg_uscita');

            error_msg.html('');
            $('#copie_lavorate_fine').removeClass('text-danger');

    
            $.ajax({
                type: 'POST',
                url: '/produzione/brossura/uscita/' + id_lavorazione,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_lavorazione': id_lavorazione
                },
                success: function(response) {
                    console.log(response);
                    if (response.success === true) {
                        if (modalInstance) {
                            modalInstance.hide(); // chiudo quell' istanza che era blobale
                        }
                        $('#carta_lavorazione_' + id_lavorazione.toLowerCase()).remove();
                    } else {
                        var error = response;
                        console.log(error.message);
                        error_msg.html(error.message);
                        error_msg.addClass('text-danger');
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON;
                    if (xhr.status == 422) {
                        console.log(errors);
                        error_msg.html(errors.message);
                        error_msg.addClass('text-danger');
                    }
                }
            });
        });

    //scrpit per la parte entrata __________________________________________
        $('#bottone_inizia').on('click', function(event) {
            event.preventDefault();

            var codice_commessa = $('#codice_commessa').val();
            var codice_macchina = $('#codice_macchina').val();
            var codice_operatore = $('#codice_operatore').val();
            var error_msg = $('#error_msg_entrata');
            error_msg.html('');
            $('#form_entrata input').removeClass('text-danger');

            
            var messaggi_errore = [];
            if (!codice_commessa) {
                messaggi_errore.push('Inserire il codice della commessa');
            }
            if (!codice_macchina) {
                messaggi_errore.push('Inserire il codice della macchina');
            }
            if (!codice_operatore) {
                messaggi_errore.push('Inserire il codice dell\'operatore');
            }
            if (messaggi_errore.length > 0) {
                messaggi_errore.forEach(function(messaggio) {
                    error_msg.append(messaggio + '<br>');
                });
                $('#form_entrata input').addClass('text-danger');
                return;
            }
            

            $.ajax({
                type: 'POST',
                url: '/produzione/brossura/entrata',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'codice_commessa': codice_commessa,
                    'codice_macchina': codice_macchina,
                    'codice_operatore': codice_operatore,
                },
                success: function(response){
                    if (response.success === true) {
                        location.reload();                       
                    } else {
                        var error = response;
                        console.log(error.message);
                        error_msg.html(error.message);
                        error_msg.addClass('text-danger');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.message;
                    error_msg.append(errors + '<br>');
                    error_msg.addClass('text-danger'); 
                }
            });
        });
    });
</script>

@endsection

