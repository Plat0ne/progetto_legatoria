<div class="modal fade" id="modal_uscita" data-bs-backdrop="static" tabindex="-1" aria-labelledby="uscitaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="uscitaModalLabel"></h5> <!-- inserisci qui l' id_lav (sei sicuro di terminare $id_lav) ? -->
			</div>
			<div class="modal-body" id="modal-body">
				<div class="row mb-3">
					<div class="col">
						<h1 class="text-primary">Premendo esci verrà registrato l'orario di lavoro</h1>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col">
						<form id="form_uscita">
							<input type="hidden" id=id_lavorazione name="id_lavorazione" value="">

							<div class="row mb-3">
								<input type="number" class="form-control" id="colpi_fine" name="colpi_fine" placeholder="numero contatore colpi" style="background-color: #f5f5f5;">
							</div>
							<div id="error_msg_uscita" class="text-danger"></div>
							<div class="d-grid">
								<button class="btn btn-danger btn-lg" id="bottone_esci">ESCI</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>