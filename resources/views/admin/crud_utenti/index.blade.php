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

        <button class="reset anim-bg-gradient btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#userModal" >Aggiungi Utente</button>

        <table id="datatable-generic" class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Operatore</th>
                    <th>Creato il</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($users as $user)
                <tr id="row-{{ $user->id }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->operatore ? 'Sì' : 'No' }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button class="edit-button" data-id="{{ $user }}" data-toggle="modal" data-target="#editModal">
                        <span class="text">Modifica</span>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 7.94l-3.75-3.75L3 17.25zM20.71 5.63c-1.59 0-3.05.51-4.23 1.43l-1.42 1.42c-.81.81-1.43 1.94-1.43 3.05v12.59c0 1.61.51 3.05 1.43 4.23l1.42 1.42c.81.81 1.94 1.43 3.05 1.43h12.59c1.61 0 3.05-.51 4.23-1.43l1.42-1.42c.81-.81 1.43-1.94 1.43-3.05v-12.59c0-1.61-.51-3.05-1.43-4.23l-1.42-1.42c-.81-.81-1.94-1.43-3.05-1.43H20.71z"/>
                            </svg>
                        </span>   
                    </button>
                        <form action="{{ route('admin.utenti.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sei sicuro?')">
                            @csrf
                            @method('DELETE')
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
            <h5 class="modal-title" id="editModalLabel">Modifica utente</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
          </div>
  
          <div class="modal-body">
            <input type="hidden" id="id_edit_operatore" name="id_edit_operatore">
  
            <div class="mb-3">
              <label for="name_edit" class="form-label">Nome</label>
              <input type="text" name="name_edit" id="name_edit" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="email_edit" class="form-label">Email</label>
              <input type="email" name="email_edit" id="email_edit" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" name="operatore_edit" id="operatore_edit" value="1">
              <label class="form-check-label" for="operatore_edit">Operatore</label>
            </div>
            <div id="message_popup_modifica" class="rounded d-none text-center"></div>
          </div> <!-- FINE modal-body -->
  
          <div class="modal-footer">
            <button id="modifica_utente" type="button" class="btn btn-primary">Salva modifiche</button>
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
          <h5 class="modal-title" id="userModalLabel">Aggiungi Utente</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Chiudi"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="user_id" name="user_id">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3 password-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="operatore" id="operatore" value="1">
                <label class="form-check-label" for="operatore">Operatore</label>
            </div>
            <div id="message_popup_aggiungi" class=" rounded d-none text-center" style="">
            </div>

        </div>
        <div class="modal-footer">
          <button id="aggiugni_utente" type="button" class="btn btn-success">Salva</button>
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
    function controllaDati(dati_form,modifica=false) {
        let errors = [];

        if (dati_form.name.trim() === '') {
            errors.push('Inserisci un nome');
        }
        if (dati_form.email.trim() === '') {
            errors.push('Inserisci un indirizzo email');
        }
        if (! modifica) {
            if (dati_form.password.trim() === '') {
                errors.push('Inserisci una password');
            } else if (dati_form.password.length < 6) {
                errors.push('La password deve avere almeno 6 caratteri');
            }   
        }
        return errors;
    }

    function popolaFormEdit(user){
        $('#editForm')[0].reset();

        console.log(user);

        $('#id_edit_operatore').val(user.id);
        $('#name_edit').val(user.name);
        $('#email_edit').val(user.email);
        $('#operatore_edit').prop('checked', user.operatore);
    }


    $(document).ready(function() {

        document.querySelectorAll('.modificaButton').forEach(function(button) {
            button.addEventListener('click', function() {
                const data = this.getAttribute('data-id');
                popolaFormEdit(JSON.parse(data));
            });
        });

        if (document.getElementById('session_alert')) {
            setTimeout(() => {
                document.getElementById('session_alert').style.transition = "opacity 1s";
                document.getElementById('session_alert').style.opacity = 0;
                setTimeout(() => document.getElementById('session_alert').remove(), 1000);
            }, 3000);
        }


        //script per modifica utente
        $('#modifica_utente').on('click', function() {
            var id_utente = $('#id_edit_operatore').val();
            var name = $('#name_edit').val();
            var email = $('#email_edit').val();
            var operatore = $('#operatore_edit').is(':checked') ? 1 : 0;

            var dati_form = {
                id: id_utente,
                name: name,
                email: email,
                operatore: operatore,
            };

            var errors = controllaDati(dati_form, true);
            if (errors.length > 0) {
                    showPopup(errors.join('<br>'), false, "message_popup_modifica");
                return;
            }

            $.ajax({
                url: "{{ route('admin.utenti.update', ':id') }}".replace(':id', id_utente),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id_utente,
                    name: name,
                    email: email,
                    operatore: operatore,
                },
                success: function(response) {
                    if (response.success) {
                            showPopup(response.message, true, "message_popup_modifica");
                        $('#editModal').modal('hide');
                            $('#row-' + id_utente).addClass('bg-secondary');
                            $('#row-' + id_utente).find('td:nth-child(1)').text(name);
                            $('#row-' + id_utente).find('td:nth-child(2)').text(email);
                            operatore= operatore == 1 ? 'Si' : 'No';
                            $('#row-' + id_utente).find('td:nth-child(3)').text(operatore);
                            
                    } else {
                            showPopup(response.message, false,"message_popup_modifica");
                    }
                },
                error: function(response) {
                    console.log(response);
                        showPopup('Errore durante la modifica dell\'utente', false, "message_popup_modifica");
                }
            });
        });

        $(document).on('click', '#aggiugni_utente', function(e) {
            e.preventDefault();

            var dati_form = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                operatore: $('#operatore').is(':checked') ? 1 : 0,
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
                url: "{{ route('admin.utenti.store') }}",
                type: 'POST',
                data: dati_form,
                dataType: 'json',
                success: function(response) {
                    var newRow = `
                        <tr>
                            <td>${dati_form.name}</td>
                            <td>${dati_form.email}</td>
                            <td>${dati_form.operatore ? 'Sì' : 'No'}</td>
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

        function showPopup(message, success = true, id_popup = "message_popup_aggiungi") {
            let popup = document.getElementById(id_popup);

            // Reset stato
            popup.classList.remove('fade', 'bg-success', 'bg-danger', 'd-none');
            popup.innerHTML = `<strong class='text-white'>${message}</strong>`;

            if (success) {
                popup.classList.add('bg-success');
            } else {
                popup.classList.add('bg-danger');
            }

            // Mostra per 3 secondi, poi nascondi
            setTimeout(() => {
                popup.classList.add('fade');
                setTimeout(() => popup.classList.add('d-none'), 1000);
            }, 3000);
        }
    });
</script>

@endsection

