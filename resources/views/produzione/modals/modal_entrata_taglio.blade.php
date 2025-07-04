<div class="modal fade" id="modal_entrata" data-bs-backdrop="static" tabindex="-1" aria-labelledby="entrataModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="entrataModalLabel" style="text-align: center; font-weight: bold;">Inserisci i dati per iniziare</h4>
			</div>
			<div class="modal-body" id="modal-body">
				{{-- <div class="row mb-3">
					<div class="col">
						<h1 class="text-primary"></h1>
					</div>
				</div> --}}
				<div class="row mb-5">
					<div class="col">
						<form id="form_entrata">
							<div class="row mb-3">
                                <input type="number" class="form-control mb-3" id="codice_commessa" name="codice_commessa" placeholder="Codice commessa" style="background-color: #f5f5f5;">
								<input type="number" class="form-control mb-3" id="quantita_fogli" name="quantita_fogli" placeholder="Numero di fogli da lavorare" style="background-color: #f5f5f5;">
                                <input type="text" class="form-control mb-3" id="codice_macchina" name="codice_macchina" placeholder="Codice macchina" style="background-color: #f5f5f5;">
                                <input type="text" class="form-control mb-3" id="codice_operatore" name="codice_operatore" placeholder="Codice operatore" style="background-color: #f5f5f5;">
                                <input type="number" class="form-control mb-3" id="inizio_segnatura" name="inizio_segnatura" placeholder="Inizio segnatura" style="background-color: #f5f5f5;">
                                <input type="text" class="form-control mb-3" id="fine_segnatura" name="fine_segnatura" placeholder="Fine segnatura" style="background-color: #f5f5f5;">
							</div>
							<div id="error_msg_entrata" class="text-danger"></div>
							<div class="d-grid">
								<button class="button-3d--orange" id="bottone_inizia" type="button">INIZIA</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


