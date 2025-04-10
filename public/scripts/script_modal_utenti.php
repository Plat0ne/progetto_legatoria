<script>
	//Salvo in variabili i riferimenti alle parti della pagina che mi servono
	const modal = document.getElementById('modal_<?php echo $p['route_pagina']; ?>');
	const modalBody = document.getElementById('modal-body');
	const modalTitle = document.getElementById('<?php echo $p['route_pagina']; ?>ModalLabel');
	const openModalBtns = document.querySelectorAll('.open-modal');
	var focused;

	//console.log(openModalBtns);

	// Aggiungo un event listener a tutti i bottoni che aprono la modal
	openModalBtns.forEach(btn => {
		btn.addEventListener('click', clickEvent);
	});

	modal.addEventListener('shown.bs.modal', function () {
		focused.focus();
	});

	// Funzione che viene chiamata quando viene cliccato un bottone che apre la modal
	function clickEvent(e) {
		// Recupero il tipo di contenuto da visualizzare nella modal dal data attribute del bottone
		const contentType = e.target.dataset.type;
		//console.log(contentType);
		
		// Recupero l'id del bottone
		var id = e.target.id;
		id = parseInt(id.split('_')[1]);
		//console.log(id);
		
		// Chiamo la funzione che popola la modal con il contenuto richiesto
		populateModal(contentType, id);
	}

	// Funzione che popola la modal con il contenuto richiesto
	function populateModal(contentType, id) {
		// Pulisco la modal prima di riempirla in modo da evitare che si sovrappongano i contenuti
		clearModal();

		// Controllo il tipo di contenuto da visualizzare

		// Se è un insert, allora visualizzo il form per l'inserimento di un nuovo utente
		if(contentType === 'insert'){
			modalTitle.innerHTML = 'Inserisci un nuovo utente';
			modalBody.innerHTML = `
				<form action="" method="POST">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="email_utente" id="email_utente" placeholder="Email" required>
						<label for="email_utente" class="form-label">Email</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" name="password_utente" id="password_utente" placeholder="Password" required>
						<label for="password_utente" class="form-label">Password</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="nome_utente" id="nome_utente" placeholder="Nome" required>
						<label for="nome_utente" class="form-label">Nome</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="cognome_utente" id="cognome_utente" placeholder="Cognome" required>
						<label for="cognome_utente" class="form-label">Cognome</label>
					</div>
					<div class="form-floating mb-3">
						<select class="form-select" name="ruolo_id" id="ruolo_id" required>
							<option selected disabled value="">Seleziona ruolo</option>
							<?php $ruoli = selectAll($conn, 'ruoli'); ?>
							<?php foreach($ruoli as $r): ?>
								<option value="<?php echo $r['id_ruolo']; ?>"><?php echo $r['nome_ruolo']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="ruolo_id">Ruolo</label>
					</div>
					<button type="submit" class="btn btn-primary float-end" name="insert">Aggiungi</button>
				</form>
			`;
			focused = document.getElementById('email_utente');
		}

		// Se è un update, allora visualizzo il form per la modifica di un utente
		if(contentType === 'update'){
			modalTitle.innerHTML = 'Modifica utente';
			$.ajax({
				url: 'ajax/ajax_get_utente.php',
				type: 'POST',
				data: {id_utente: id},
				success: function (response) {
					var utente = JSON.parse(response);
					//console.log(utente);
					modalBody.innerHTML = `
						<form action="" method="POST">
							<input type="hidden" name="id_utente" value="`+utente.id_utente+`">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" name="email_utente" id="email_utente" placeholder="Email" value="`+utente.email_utente+`" readonly>
								<label for="email_utente" class="form-label">Email</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" class="form-control" name="nome_utente" id="nome_utente" placeholder="Nome" value="`+utente.nome_utente+`" required>
								<label for="nome_utente" class="form-label">Nome</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" class="form-control" name="cognome_utente" id="cognome_utente" placeholder="Cognome" value="`+utente.cognome_utente+`" required>
								<label for="cognome_utente" class="form-label">Cognome</label>
							</div>
							<div class="form-floating mb-3">
								<select class="form-select" name="ruolo_id" id="ruolo_id" required>
									<option selected disabled value="">Seleziona ruolo</option>
									<?php $ruoli = selectAll($conn, 'ruoli'); ?>
									<?php foreach($ruoli as $r): ?>
										<option value="<?php echo $r['id_ruolo']; ?>"><?php echo $r['nome_ruolo']; ?></option>
									<?php endforeach; ?>
								</select>
								<label for="ruolo_id">Ruolo</label>
							</div>
							<button type="submit" class="btn btn-primary float-end" name="update">Modifica</button>
						</form>
					`;
					focused = document.getElementById('nome_utente');

					// Imposto a selected la option con il value uguale al ruolo_id dell'utente
					$('#ruolo').val(utente.ruolo_id);
				}
			})
		}

		// Se è un delete, allora visualizzo il dialog per la conferma dell'eliminazione di un utente
		if(contentType === 'delete'){
			modalTitle.innerHTML = 'Elimina utente';
			modalBody.innerHTML = `
				<form action="" method="POST">
					<input type="hidden" name="id_utente" value="`+id+`">
					<p>Sei sicuro di voler eliminare questo utente?</p>
					<button type="submit" class="btn btn-danger float-end" name="delete">Elimina</button>
				</form>
			`;
		}

		// Se è un import, allora visualizzo il form per l'importazione di utenti
		if(contentType === 'import'){
			modalTitle.innerHTML = 'Importa utenti';
			modalBody.innerHTML = `
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="file" class="form-label">File</label>
						<input type="file" class="form-control" name="file" id="file" placeholder="File" accept="text/csv" required>
					</div>
					<button type="submit" class="btn btn-primary float-end" name="import">Importa</button>
				</form>
			`;
		}
	}

	//Svuota il contenuto della modal
	function clearModal() {
		modalTitle.innerHTML = '';
		modalBody.innerHTML = '';
	}
</script>