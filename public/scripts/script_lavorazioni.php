<script>

	function ToggleShowMod(id) {
		const fields = [
			'codice_commessa',
			'codice_macchina',
			'codice_operatore',
			'start_segnatura',
			'end_segnatura',
			'qta_fogli',
			'qta_fogli_lavorati',
			'segnatura_finita',
			'data_inizio',
			'ora_inizio',
			'ora_fine'
		];

		$('td').each(function() {
			$('button').each(function() {
				if ($(this).hasClass('active')) {
					$(this).removeClass('active');
				}
			});

			$(this).find('span[id^=modifica_]').each(function() {
				if (!$(this).attr('id').includes(`${id}`)) {
					$(this).addClass('d-none');
				}
			});
			$(this).find('span[id^=show_]').each(function() {
				if (!$(this).attr('id').includes(`${id}`)) {
					$(this).removeClass('d-none');
				}
			});
		});
		fields.forEach(field => {

			const showId = `show_${field}_${id}`;
			const modId = `modifica_${field}_${id}`;

			if ($(`#${showId}`).hasClass('d-none')) {
				$(`#${showId}`).removeClass('d-none');
				$(`#${modId}`).addClass('d-none');
			} else {
				$(`#${showId}`).addClass('d-none');
				$(`#${modId}`).removeClass('d-none');
			}
		});
	}

	function ToggleShowAdd(){
		if ($('#bottone_modifica').hasClass('d-none')){
			$('#bottone_modifica').removeClass('d-none');
			$('#barra_inserisci_riga').addClass('d-none');
			$('#barra_inserisci_riga input').val('');
		}else{
			$('#bottone_modifica').addClass('d-none');
			$('#barra_inserisci_riga').removeClass('d-none');
		}
	}


	function SendData() {
		const form = document.getElementById('myForm');
		
		// Get form data
		const formData = new FormData(form);
		
		// Log the form values
		const formValues = {};
		for (const [key, value] of formData.entries()) {
			formValues[key] = value;
			// Check if the value is empty or for the 'select' elements
			if (value === "" || value === null) {
				alert("Attenzione, inserire tutti i campi (" + key + ")");
				return; // Stop execution of the function
			}
		}

		console.log(formValues);
		ToggleShowAdd();

		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				aggiunta_riga : "True",
				new_data : JSON.stringify(formValues)
			},
			success: function(response) {
				
				console.log(response);

				var table = $('#datatable-lavorazioni').DataTable();

				let date = new Date(formValues['data_inizio']);
				let day = String(date.getDate()).padStart(2, '0');
				let month = String(date.getMonth() + 1).padStart(2, '0');
				let year = date.getFullYear();
				let completato = formValues["completato"];

				// Format as dd/mm/yyyy
				let formattedDate = `${day}/${month}/${year}`;
				formValues['data_inizio'] = formattedDate;

				if(completato == "1"){
					completato = "Sì";
				}else{
					completato = "No";
				}

				var newRow = [
					"	", // ID
					"Taglio", // Fase
					formValues['codice_commessa'], // Codice commessa
					formValues['codice_macchina'], // Codice macchina
					formValues['codice_operatore'], // Operatore
					formValues['inizio_segnatura'], // Inizio segnatura
					formValues['fine_segnatura'], // Fine segnatura
					formValues['fogli'], // Fogli Da Lavorare
					formValues['fogli_lavorati'], // Fogli Lavorati
					completato, // Completato
					formValues['data_inizio'], // Data Inizio
					formValues['orario_inizio'], // Orario Inizio
					formValues['orario_fine'], // Orario Fine
					"__", // Tempo lavorato (Min)
					'<button type="button" class="btn btn-sm btn-outline-success">New</button>'
				];

				table.row.add(newRow).draw();
				table.order([0, 'asc']).draw();

				alert("Riga aggiunta con successo!");
			}

		});


			

	}



//_____________________________________________________________________________codice_commessa______________________________

	function modifica_codice_commessa(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_codice_commessa: id,
				new_data : value
			},
			success: function (response) {
				var show_codice_commessa_id = 'show_codice_commessa_' + id;

				console.log("modificato codice_commessa");
				// var dateObj = new Date(data);
				// var day = dateObj.getDate();
				// var month = dateObj.getMonth() + 1;
				// var year = dateObj.getFullYear();
				// day = day < 10 ? '0' + day : day;
				// month = month < 10 ? '0' + month : month;

				// $('#show_uscita_'+cliente+anno+doc).html(day + '/' + month + '/' + year);
				$('#'+ show_codice_commessa_id).html(value);

			}

		});
	}

//_____________________________________________________________________________codice_macchina______________________________

	function modifica_codice_macchina(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_codice_macchina: id,
				new_data : value 
			},
			success: function (response) {
				var show_codice_macchina_id = 'show_codice_macchina_' + id;

				console.log("modificato codice_macchina");

				$('#'+ show_codice_macchina_id).html(value);
			}

		});
	}

//_____________________________________________________________________________codice_operatore______________________________

	function modifica_codice_operatore(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_codice_operatore: id,
				new_data : value 
			},
			success: function (response) {
				var show_codice_operatore_id = 'show_codice_operatore_' + id;

				console.log("modificato codice_operatore");

				$('#'+ show_codice_operatore_id).html(value);
			}

		});
	}

//_____________________________________________________________________________start_segnatura______________________________

	function modifica_start_segnatura(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_start_segnatura: id,
				new_data : value 
			},
			success: function (response) {
				var show_start_segnatura_id = 'show_start_segnatura_' + id;

				console.log("modificato start_segnatura");

				$('#'+ show_start_segnatura_id).html(value);
			}

		});
	}

//_____________________________________________________________________________end_segnatura______________________________

	function modifica_end_segnatura(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_end_segnatura: id,
				new_data : value 
			},
			success: function (response) {
				var show_end_segnatura_id = 'show_end_segnatura_' + id;

				console.log("modificato end_segnatura");

				$('#'+ show_end_segnatura_id).html(value);
			}

		});
	}

//_____________________________________________________________________________qta_fogli______________________________

	function modifica_qta_fogli(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_qta_fogli: id,
				new_data : value 
			},
			success: function (response) {
				var show_qta_fogli_id = 'show_qta_fogli_' + id;

				console.log("modificato qta_fogli");

				$('#'+ show_qta_fogli_id).html(value);
			}

		});
	}

//_____________________________________________________________________________qta_fogli_lavorati______________________________

	function modifica_qta_fogli_lavorati(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_qta_fogli_lavorati: id,
				new_data : value 
			},
			success: function (response) {
				var show_qta_fogli_lavorati_id = 'show_qta_fogli_lavorati_' + id;

				console.log("modificato qta_fogli_lavorati");

				$('#'+ show_qta_fogli_lavorati_id).html(value);
			}

		});
	}

//_____________________________________________________________________________segnatura_finita______________________________

	function modifica_segnatura_finita(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_segnatura_finita: id,
				new_data : value 
			},
			success: function (response) {
				var show_segnatura_finita_id = 'show_segnatura_finita_' + id;

				console.log("modificato segnatura_finita");

				if(value == "1"){
					value = "Sì";
				}else{
					value = "No";
				}

				$('#'+ show_segnatura_finita_id).html(value);
			}

		});
	}
//_____________________________________________________________________________data_inizio______________________________

	function modifica_data_inizio(value, id){
		$.ajax({
			url: 'ajax/ajax_lavorazioni.php',
			type: 'POST',
			data: {
				id_data_inizio: id,
				new_data : value
			},
			success: function (response) {
				var show_data_inizio_id = 'show_data_inizio_' + id;

				console.log("modificato data_inizio");
				var dateObj = new Date(value);
				var day = dateObj.getDate();
				var month = dateObj.getMonth() + 1;
				var year = dateObj.getFullYear();
				day = day < 10 ? '0' + day : day;
				month = month < 10 ? '0' + month : month;

				$('#'+ show_data_inizio_id).html(day + '/' + month + '/' + year);
			}

		});
	}

//_____________________________________________________________________________ora_inizio______________________________

	function modifica_ora_inizio(value, id){
			$.ajax({
				url: 'ajax/ajax_lavorazioni.php',
				type: 'POST',
				data: {
					id_ora_inizio: id,
					new_data : value
				},
				success: function (response) {
					var show_ora_inizio_id = 'show_ora_inizio_' + id;

					$('#'+ show_ora_inizio_id).html(value);
				}

			});
		}

//_____________________________________________________________________________ora_fine______________________________

	function modifica_ora_fine(value, id){
			$.ajax({
				url: 'ajax/ajax_lavorazioni.php',
				type: 'POST',
				data: {
					id_ora_fine: id,
					new_data : value
				},
				success: function (response) {
					var show_ora_fine_id = 'show_ora_fine_' + id;

					$('#'+ show_ora_fine_id).html(value);
				}

			});
		}


</script>