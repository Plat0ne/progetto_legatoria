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

        <button class="reset anim-bg-gradient btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#macchineModal" >Aggiungi macchina</button>

        <table id="datatable-generic" class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>ID Macchina</th>
                    <th>Codice Macchina</th>
                    <th>Suffisso Macchina</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody id="macchineTable">
                @foreach($macchine as $m)
                <tr id="row-{{ $m->id_macchina }}">
                    <td>{{ $m->id_macchina }}</td>
                    <td>{{ $m->codice_macchina }}</td>
                    <td>{{ $m->suffisso_macchina }}</td>
                    <td>
                        <button class="edit-button" data-id="{{ $m }}" data-toggle="modal" data-target="#editModal">
                        <span class="text">Modifica</span>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 7.94l-3.75-3.75L3 17.25zM20.71 5.63c-1.59 0-3.05.51-4.23 1.43l-1.42 1.42c-.81.81-1.43 1.94-1.43 3.05v12.59c0 1.61.51 3.05 1.43 4.23l1.42 1.42c.81.81 1.94 1.43 3.05 1.43h12.59c1.61 0 3.05-.51 4.23-1.43l1.42-1.42c.81-.81 1.43-1.94 1.43-3.05v-12.59c0-1.61-.51-3.05-1.43-4.23l-1.42-1.42c-.81-.81-1.94-1.43-3.05-1.43H20.71z"/>
                            </svg>
                        </span>   
                    </button>
                        <form action="{{ route('macchine.destroy', $m->id_macchina) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sei sicuro?')">
                            @csrf
                            @method('DELETE')
                            <!-- <button class="btn btn-sm btn-danger">Elimina</button> -->
                             <button class="noselect-button">
                            <span class='text'>Elimina</span>
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/>
                                </svg>
                            </span>
                            </button>
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
            <h5 class="modal-title" id="editModalLabel">Modifica Macchina</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
          </div>
  
          <div class="modal-body">
            <input type="hidden" id="id_edit_macchina" name="id_edit_macchina">
  
            <div class="mb-3">
              <label for="codice_edit_macchina" class="form-label">Codice macchina</label>
              <input type="text" name="codice_edit_macchina" id="codice_edit_macchina" class="form-control" required placeholder="MAC-FASE-NUM">
            </div>

            <div class="mb-3">
                <label for="suffisso_edit_macchina" class="form-label">Suffisso macchina</label>
                <input type="text" name="suffisso_edit_macchina" id="suffisso_edit_macchina" class="form-control" required placeholder="_fase">
              </div>
  
            <div id="message_popup_modifica" class="rounded d-none text-center">test</div>
          </div> <!-- FINE modal-body -->
  
          <div class="modal-footer">
            <button id="modifica_macchina" type="button" class="btn btn-primary">Salva modifiche</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
          </div>
        </div> <!-- FINE modal-content -->
      </form>
    </div>
</div>


{{-- Modal AGGIUNTA --}}
<div class="modal fade" id="macchineModal" tabindex="-1" aria-labelledby="macchineModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <form id="macchineForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="macchineModalLabel">Aggiungi macchina</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="id_macchina" name="id_macchina">
            <div class="mb-3">
                <label for="codice_macchina" class="form-label">Codice macchina</label>
                <input type="text" name="codice_macchina" id="codice_macchina" class="form-control" required placeholder="MAC-FASE-NUM">
            </div>

            <div class="mb-3">
                <label for="suffisso_macchina" class="form-label">Suffisso macchina</label>
                <input type="text" name="suffisso_macchina" id="suffisso_macchina" class="form-control" required placeholder="_fase">
            </div>
           

            <div id="message_popup_aggiunta" class=" rounded d-none text-center" style=""></div>

        </div>
        <div class="modal-footer">
           <button id="aggiugni_macchina" type="button" class="button-3d--green">Salva</button>

         <button type="button" class="button-3d--grey" data-dismiss="modal">Chiudi</button>
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

        if (dati_form.codice_macchina.trim() === '') {
            errors.push('Inserisci un codice macchina!');
        }

        if (!/^MAC-[A-Z]+-\d+$/u.test(dati_form.codice_macchina)) {
            errors.push('Il codice macchina deve essere formato in questa maniera "MAC-FASE-num", solo maiuscole');
        }

        if (dati_form.suffisso_macchina.trim() === '') {
            errors.push('Inserisci un suffisso macchina');
        }

        if (!/^_[a-z]+$/u.test(dati_form.suffisso_macchina)) {
            errors.push('Il suffisso macchina deve essere formato in questa maniera "_fase" con fase una qualsiasi parola solo alfabetica');
        }

        return errors;
    }

    function popolaFormEdit(macchina){
        $('#editForm')[0].reset();

        $('#id_edit_macchina').val(macchina.id_macchina);
        $('#codice_edit_macchina').val(macchina.codice_macchina);
        $('#suffisso_edit_macchina').val(macchina.suffisso_macchina);
    }

    $(document).ready(function() {
        document.querySelectorAll('.modificaButton').forEach(function(button) {
            button.addEventListener('click', function() {
                const data = this.getAttribute('data-id');
                popolaFormEdit(JSON.parse(data));
            });
        });

        //script per modifica macchina
        $('#modifica_macchina').on('click', function() {
            var id_macchina = $('#id_edit_macchina').val();
            var codice_macchina = $('#codice_edit_macchina').val();
            var suffisso_macchina = $('#suffisso_edit_macchina').val().trim();

            var dati_form = {
                codice_macchina: codice_macchina,
                suffisso_macchina: suffisso_macchina,
            };

            var errors = controllaDati(dati_form);
            if (errors.length > 0) {
                showPopup(errors.join('<br>'), false, "message_popup_modifica");
                console.log(errors);
                return;
            }

            $.ajax({                
                url: "{{ route('macchine.update', ':id') }}".replace(':id', id_macchina),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    codice_macchina: codice_macchina,
                    suffisso_macchina: suffisso_macchina,
                },
                success: function(response) {
                    if (response.success) {
                        showPopup(response.message, true);
                        $('#editModal').modal('hide');

                        $('#row-' + id_macchina).addClass('bg-secondary');
                        $('#row-' + id_macchina).find('td:nth-child(2)').text(codice_macchina);
                        $('#row-' + id_macchina).find('td:nth-child(3)').text(suffisso_macchina);
                    } else {
                        showPopup(response.message, false);
                    }
                        

                },
                error: function(response) {
                    console.log(response);
                    showPopup('Errore durante la modifica dell\'macchina', false);
                }
            });
        });

        //script per aggiunta macchina
        $(document).on('click', '#aggiugni_macchina', function(e) {
            e.preventDefault();

            var dati_form = {
                codice_macchina: $('#codice_macchina').val(),
                suffisso_macchina: $('#suffisso_macchina').val(),
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
                url: "{{ route('macchine.store') }}",
                type: 'POST',
                data: dati_form,
                dataType: 'json',
                success: function(response) {
                    var newRow = `
                        <tr>
                            <td></td>
                            <td>${dati_form.codice_macchina}</td>
                            <td>${dati_form.suffisso_macchina}</td>
                            <td>
                                <button type="button" class="btn btn-success" onclick="location.reload()">Refresh page</button>
                            </td>
                        </tr>
                    `;
                    $('#macchineTable').prepend(newRow);
                    //resetto il form
                    $('#macchineForm')[0].reset();
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

