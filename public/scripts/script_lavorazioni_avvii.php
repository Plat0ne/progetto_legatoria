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
</script>