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

        <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#userModal" >Aggiungi operatore</button>

        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Codice Operatore</th>
                    <th>Numero Casa/Familiare</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($workers as $w)
                <tr id="row-{{ $w->id_operatore }}">
                    <td>{{ $w->id_operatore }}</td>
                    <td>{{ $w->codice_operatore }}</td>
                    <td>{{ $w->numero_operatore }}</td>
                    <td>{{ $w->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button class="modificaButton btn btn-sm btn-warning text-dark" data-id="{{ $w }}" data-toggle="modal" data-target="#editModal">Modifica</button>

                        <form action="{{ route('operatori.destroy', $w) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sei sicuro?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- Modal MODIFICA --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modifica operatore</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
          </div>
  
          <div class="modal-body">
            <input type="hidden" id="id_edit_operatore" name="id_edit_operatore">
  
            <div class="mb-3">
              <label for="codice_edit_operatore" class="form-label">Codice Operatore</label>
              <input type="text" name="codice_edit_operatore" id="codice_edit_operatore" class="form-control" required placeholder="N-COGNOME">
            </div>
  
            <div class="mb-3">
              <label for="numero_edit_operatore" class="form-label">Numero casa/famiglia</label>
              <input type="tel" name="numero_edit_operatore" id="numero_edit_operatore" class="form-control" required placeholder="es. 0123456789">
            </div>
  
            <div id="message_popup_modifica" class="rounded d-none text-center">test</div>
          </div> <!-- FINE modal-body -->
  
          <div class="modal-footer">
            <button id="modifica_operatore" type="button" class="btn btn-primary">Salva modifiche</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
          </div>
        </div> <!-- FINE modal-content -->
      </form>
    </div>
</div>


{{-- Modal AGGIUNTA --}}
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <form id="userForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Aggiungi operatore</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="id_operatore" name="id_operatore">
            <div class="mb-3">
                <label for="codice_operatore" class="form-label">Codice Operatore</label>
                <input type="text" name="codice_operatore" id="codice_operatore" class="form-control" required placeholder="N-COGNOME">
            </div>
           
            <div class="mb-3">
                <label for="numero_operatore" class="form-label">numero casa/famiglia</label>
                <input type="tel" name="numero_operatore" id="numero_operatore" class="form-control" required placeholder="es. 0123456789">
            </div>

            <div id="message_popup_aggiunta" class=" rounded d-none text-center" style=""></div>

        </div>
        <div class="modal-footer">
          <button id="aggiugni_operatore" type="button" class="btn btn-success">Salva</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </form>
  </div>
</div>
  
    
@endsection

@section('scripts_pagine_secondarie')

<script>
    

    //funzione per controllare la correttezza dei dati
    function controllaDati(dati_form) {
        let errors = [];

        if (dati_form.codice_operatore.trim() === '') {
            errors.push('Inserisci un codice operatore');
        }
        if (!/^[A-Z]{1}-[A-Z]+$/u.test(dati_form.codice_operatore) && !/^[A-Z]{1}\.[A-Z]+$/u.test(dati_form.codice_operatore)) {
            errors.push('Il codice operatore deve essere formato in questa maniera "N-COGNOME" oppure "N.COGNOME", solo maiuscole');
        }
        if (dati_form.numero_operatore.trim() === '') {
            errors.push('Inserisci un numero operatore');
        }
        if (!/^[0-9]{10}$/.test(dati_form.numero_operatore)) {
            errors.push('Immetti un numero valido!');
        }

        return errors;
    }

    document.querySelectorAll('.modificaButton').forEach(function(button) {
        button.addEventListener('click', function() {
            const data = this.getAttribute('data-id');
            popolaFormEdit(JSON.parse(data));
        });
    });

    function popolaFormEdit(worker){
        $('#editForm')[0].reset();
        
        $('#id_edit_operatore').val(worker.id_operatore);
        $('#codice_edit_operatore').val(worker.codice_operatore);
        $('#numero_edit_operatore').val(worker.numero_operatore);
    }

    $(document).ready(function() {

        //script per modifica operatore
        $('#modifica_operatore').on('click', function() {
            var id_operatore = $('#id_edit_operatore').val();
            var codice_operatore = $('#codice_edit_operatore').val();
            var numero_operatore = $('#numero_edit_operatore').val();

            var dati_form = {
                codice_operatore: codice_operatore,
                numero_operatore: numero_operatore,
            };

            var errors = controllaDati(dati_form);
            if (errors.length > 0) {
                showPopup(errors.join('<br>'), false, "message_popup_modifica");
                console.log(errors);
                return;
            }

            $.ajax({                
                url: "{{ route('operatori.update', ':id') }}".replace(':id', id_operatore),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    codice_operatore: codice_operatore,
                    numero_operatore: numero_operatore,
                },
                success: function(response) {
                    if (response.success) {
                        showPopup(response.message, true);
                        $('#editModal').modal('hide');

                        $('#row-' + id_operatore).addClass('bg-secondary');
                        $('#row-' + id_operatore).find('td:nth-child(2)').text(codice_operatore);
                        $('#row-' + id_operatore).find('td:nth-child(3)').text(numero_operatore);
                    } else {
                        showPopup(response.message, false);
                    }
                        

                },
                error: function(response) {
                    console.log(response);
                    showPopup('Errore durante la modifica dell\'operatore', false);
                }
            });



        });

        //script per aggiunta operatore
        $(document).on('click', '#aggiugni_operatore', function(e) {
            e.preventDefault();

            var dati_form = {
                codice_operatore: $('#codice_operatore').val(),
                numero_operatore: $('#numero_operatore').val(),
            };

            var errors = controllaDati(dati_form);
            if (errors.length > 0) {
                showPopup(errors.join('<br>'), false);
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('operatori.store') }}",
                type: 'POST',
                data: dati_form,
                dataType: 'json',
                success: function(response) {
                    var newRow = `
                        <tr>
                            <td>${dati_form.id_operatore}</td>
                            <td>${dati_form.codice_operatore}</td>
                            <td>${dati_form.numero_operatore}</td>
                            <td>{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <button type="button" class="btn btn-success" onclick="location.reload()">Refresh page</button>
                            </td>
                        </tr>
                    `;
                    $('#userTable').prepend(newRow);
                    //resetto il form
                    $('#userForm')[0].reset();
                    showPopup(response.message);
                },
                error: function(xhr) {
                    console.error("Errore 422:", xhr.responseJSON);

                    let response = xhr.responseJSON;
                    if (response.errors) {
                        for (let key in response.errors) {
                            response.errors[key].forEach(msg => {
                                showPopup(msg, false);
                            });
                        }
                    } else {
                        showPopup("Errore di validazione", false);
                    }
                }
            });
        });

        //_____________________________________________

        function showPopup(message, success = true, id_popup = "message_popup_aggiunta") {
            let popup = document.getElementById(id_popup);

            // Reset stato
            popup.classList.remove('fade', 'bg-success', 'bg-danger', 'd-none');
            popup.textContent = '';
            popup.innerHTML = `<strong class='text-white'>${message}</strong>`;

            if (success) {
                popup.classList.add('bg-success');
            } else {
                popup.classList.add('bg-danger');
            }

            // Mostra per 3 secondi, poi mettiamo una dnone
            setTimeout(() => {
                popup.classList.add('fade');
                setTimeout(() => popup.classList.add('d-none'), 1000);
            }, 3000);
        }

    });

</script>
@endsection

