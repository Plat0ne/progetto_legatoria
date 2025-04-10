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
			modalTitle.innerHTML = 'Inserisci un nuovo operatore';
			modalBody.innerHTML = `
				<form action="" method="POST">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="codice_operatore" id="codice_operatore" placeholder="Codice operatore" required>
						<label for="codice_operatore" class="form-label">Codice operatore</label>
					</div>
					<button type="submit" class="btn btn-primary float-end" name="insert">Aggiungi</button>
				</form>
			`;
			focused = document.getElementById('codice_operatore');
		}

		// Se è un update, allora visualizzo il form per la modifica di un utente
		if(contentType === 'update'){
			modalTitle.innerHTML = 'Modifica operatore';
			$.ajax({
				url: 'ajax/ajax_get_operatori.php',
				type: 'POST',
				data: {id_operatore: id},
				success: function (response) {
					var operatore = JSON.parse(response);
					//console.log(operatore);
					modalBody.innerHTML = `
						<form action="" method="POST">
							<input type="hidden" name="id_operatore" value="`+operatore.id_operatore+`">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" name="codice_operatore" id="codice_operatore" placeholder="Codice operatore" value="`+operatore.codice_operatore+`" required>
								<label for="codice_operatore" class="form-label">Codice operatore</label>
							</div>
							<button type="submit" class="btn btn-primary float-end" name="update">Modifica</button>
						</form>
					`;
					focused = document.getElementById('codice_operatore');
				}
			})
		}

		// Se è un delete, allora visualizzo il dialog per la conferma dell'eliminazione di un utente
		if(contentType === 'delete'){
			modalTitle.innerHTML = 'Elimina operatore';
			modalBody.innerHTML = `
				<form action="" method="POST">
					<input type="hidden" name="id_operatore" value="`+id+`">
					<p>Sei sicuro di voler eliminare questo operatore?</p>
					<button type="submit" class="btn btn-danger float-end" name="delete">Elimina</button>
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