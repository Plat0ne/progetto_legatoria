<script>
	var route_pagina = document.getElementById('route_pagina');
	var nome_pagina = document.getElementById('nome_pagina');
	var nome_flag_attivazione_pagina = document.getElementById('nome_flag_attivazione_pagina');
	var nome_intestazione_pagina = document.getElementById('nome_intestazione_pagina');
	var icona_intestazione_pagina = document.getElementById('icona_intestazione_pagina');
	var subgroup_pagina = document.getElementById('subgroup_pagina');
	var insert = document.getElementById('insert');

	function generateSequence(val){
		nome_pagina.value = val+".php";
		nome_flag_attivazione_pagina.value = "attivo_"+val;
		nome_intestazione_pagina.removeAttribute('disabled');
		icona_intestazione_pagina.removeAttribute('disabled');
		subgroup_pagina.removeAttribute('disabled');
		insert.removeAttribute('disabled');
	}
</script>