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

        <h1 class="mb-4">{{ $title }}</h1>
        <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#userModal" >Aggiungi Utente</button>

        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Codice Operatore</th>
                    <th>Numero Casa/Familiare</th>
                    <th>Creato il</th>
                    <th>Anche admin</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($workers as $w)
                <tr id="row-{{ $w->codice_operatore }}">
                    <td>{{ $w->numero }}</td>
                    <td>{{ $w->operatore ? 'Sì' : 'No' }}</td>
                    <td>{{ $w->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning text-dark" onclick='openEditModal(@json($w))'>Modifica</button>
                        <form action="{{ route('admin.utenti.destroy', $w) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sei sicuro?')">
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

{{-- Modal --}}
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
            <div id="message_popup" class=" rounded d-none text-center" style="">
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
    $(document).ready(function() {

        if (document.getElementById('session_alert')) {
            setTimeout(() => {
                document.getElementById('session_alert').style.transition = "opacity 1s";
                document.getElementById('session_alert').style.opacity = 0;
                setTimeout(() => document.getElementById('session_alert').remove(), 1000);
            }, 3000);
        }

        $(document).on('click', '#aggiugni_utente', function(e) {
            e.preventDefault();

            var dati_form = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                operatore: $('#operatore').is(':checked') ? 1 : 0,
            };

            //controllo se ci sono errori nei dati inseriti
            if (dati_form.name.trim() === '') {
                showPopup('Inserisci un nome', false);
                return;
            }
            if (dati_form.email.trim() === '') {
                showPopup('Inserisci un indirizzo email', false);
                return;
            }
            if (dati_form.password.trim() === '') {
                showPopup('Inserisci una password', false);
                return;
            }else if (dati_form.password.length < 6) {
                showPopup('La password deve avere almeno 6 caratteri', false);
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

        function showPopup(message, success = true) {
            let popup = document.getElementById('message_popup');

            if (!popup) {
                console.error("Popup non trovato!!!!");
                return;
            }

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

