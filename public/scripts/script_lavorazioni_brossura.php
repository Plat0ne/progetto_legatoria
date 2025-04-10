<script>
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

			if (value === "" || value === null) {
				alert("Attenzione, inserire tutti i campi (" + key + ")");
				return; // Stop execution of the function
			}
		}
		ToggleShowAdd();

		$.ajax({
			url: 'ajax/ajax_lavorazioni_brossura.php',
			type: 'POST',
			data: {
				aggiunta_riga : "True",
				new_data : JSON.stringify(formValues)
			},
			success: function(response) {
				
				console.log(response);

				var table = $('#datatable-lavorazioni_brossura').DataTable();

				let date = new Date(formValues['data_inizio']);
				let day = String(date.getDate()).padStart(2, '0');
				let month = String(date.getMonth() + 1).padStart(2, '0');
				let year = date.getFullYear();
				let macchina_condivisa = formValues["macchina_condivisa"];
				let segnatura_finita = formValues["segnatura_finita"];

				// Format as dd/mm/yyyy
				let formattedDate = `${day}/${month}/${year}`;
				formValues['data_inizio'] = formattedDate;

				macchina_condivisa = (macchina_condivisa === "1") ? "Sì" : "No";
				segnatura_finita = (segnatura_finita === "1") ? "Sì" : "No";

				var newRow = [
					"	", // ID
					"brossura", // Fase
					formValues['codice_commessa'], // Codice commessa
					formValues['codice_macchina'], // Codice macchina
					formValues['codice_operatore'], // Operatore
					(formValues['condiviso'] == 1) ? "Sì" : "No", // Completato
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

	function ToggleShowMod(id) {
		const fields = [
			'codice_commessa',
			'codice_macchina',
			'codice_operatore',
			'macchina_condivisa',
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


	function modificaCampoNormale(fieldName, value, id) {
		$.ajax({
			url: 'ajax/ajax_lavorazioni_brossura.php',
			type: 'POST',
			data: {
				modifica_campo: "True",
				id: id,
				fieldName: fieldName, 
				value: value 
			},
			success: function (response) {
				console.log(response);
				var showFieldId = 'show_' + fieldName + '_' + id;

				//===================== casistiche speciali ==============================
				if(fieldName === "macchina_condivisa"){
					value = (value === "1") ? "Sì" : "No";
				}
				else if(fieldName === "data_inizio"){
					var dateObj = new Date(value);
					var day = dateObj.getDate();
					var month = dateObj.getMonth() + 1;
					var year = dateObj.getFullYear();
					day = day < 10 ? '0' + day : day;
					month = month < 10 ? '0' + month : month;
					value = day + '/' + month + '/' + year;
				}				
				//======================================================================

				console.log("Modificato " + fieldName);
				$('#' + showFieldId).html(value); 
			},
			error: function (error) {
				console.error("Errore durante la modifica di " + fieldName, error);
			}
		});
	}



</script>