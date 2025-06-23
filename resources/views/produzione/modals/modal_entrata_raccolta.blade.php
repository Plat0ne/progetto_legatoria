<div class="modal fade" id="modal_entrata" data-bs-backdrop="static" tabindex="-1" aria-labelledby="entrataModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="entrataModalLabel" style="text-align: center; font-weight: bold;">Inserisci i dati per iniziare</h4>
			</div>
			<div class="modal-body" id="modal-body">
				<div class="row mb-5">
					<div class="col">
						<form id="form_entrata">
							<div class="row mb-3">
                                <input type="number" class="form-control" id="codice_commessa" name="codice_commessa" placeholder="codice commessa" style="background-color: #f5f5f5;">
                                <input type="text" class="form-control" id="codice_macchina" name="codice_macchina" placeholder="codice macchina" style="background-color: #f5f5f5;">
                                <input type="text" class="form-control" id="codice_operatore" name="codice_operatore" placeholder="codice operatore" style="background-color: #f5f5f5;">
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


