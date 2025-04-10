<script>
	// Funzione per ottenere il colore di riempimento del canvas in base al nome e cognome
	function getColor(nome, cognome) {
		var color = "#";
		var letters = "0123456789ABCDEF";
		var string = nome+cognome;
		// Se la dimensione di nome+cognome è minore di 6 aggiungo degli zeri in fondo alla stringa
		if(string.length < 6) {
			for(var i = 0; i < 6-string.length; i++) {
				string += "0";
			}
		}
		// Se la dimensione è minore di 12 i primi 6 caratteri della stringa vengono convertiti per ottenere il colore
		if(string.length < 12){
			for(var i = 0; i < 6; i++) {
				color += letters[string.charCodeAt(i) % 16];
			}
			return color;
		}
		// Se la dimensione è maggiore o uguale a 12 i 6 caratteri pari o dispari (in base alla parità o disparità della dimensione) vengono convertiti per ottenere il colore
		else {
			for(var i = 0; i < 6; i++) {
				if(string.length % 2 == 0) {
					color += letters[string.charCodeAt(2*i) % 16];
				}
				else {
					color += letters[string.charCodeAt(2*i+1) % 16];
				}
			}
			return color;
		}
	}

	// Ottieni il nome e il cognome dell'utente
	var nome = "<?php echo $_SESSION['login']['nome_utente']; ?>";
	var cognome = "<?php echo $_SESSION['login']['cognome_utente']; ?>";

	// Crea un oggetto canvas
	var canvas = document.createElement('canvas');
	var context = canvas.getContext('2d');
	// Imposta le dimensioni del canvas
	canvas.width = 50;
	canvas.height = 50;
	// Imposta il colore di riempimento del canvas
	var color = getColor(nome, cognome);
	context.fillStyle = color;
	context.fillRect(0, 0, canvas.width, canvas.height);
	// Imposta il colore del testo
	context.fillStyle = '#ffffff';
	// Imposta il font del testo
	context.font = '20px sans-serif';
	// Disegna sul canvas iniziali di nome e cognome
	context.fillText(nome.charAt(0).toUpperCase()+cognome.charAt(0).toUpperCase(), 11, 31);
	// Crea un oggetto immagine e imposta la sua fonte come il contenuto del canvas
	var img = document.createElement('img');
	img.src = canvas.toDataURL();
	// Aggiungi l'immagine all'elemento con id "navbarDropdownUserImage"
	document.getElementById('navbarDropdownUserImage').appendChild(img);

	// Crea un oggetto canvas
	var canvas2 = document.createElement('canvas');
	var context2 = canvas2.getContext('2d');
	// Imposta le dimensioni del canvas
	canvas2.width = 40;
	canvas2.height = 40;
	// Imposta il colore di riempimento del canvas
	var color2 = getColor(nome, cognome);
	// Disegna un cerchio
	context2.beginPath();
	context2.arc(20, 20, 20, 0, 2 * Math.PI);
	context2.fillStyle = color2;
	context2.fill();
	// Imposta il colore del testo
	context2.fillStyle = '#ffffff';
	// Imposta il font del testo
	context2.font = '20px sans-serif';
	// Disegna sul canvas iniziali di nome e cognome
	context2.fillText(nome.charAt(0).toUpperCase()+cognome.charAt(0).toUpperCase(), 7, 26);
	// Taglia l'immagine in forma circolare
	context2.clip();
	// Crea un oggetto immagine e imposta la sua fonte come il contenuto del canvas
	var img2 = document.createElement('img');
	img2.src = canvas2.toDataURL();
	// Aggiungi l'immagine all'elemento con id "navbarDropdownUserImage"
	document.getElementById('droppedDownUserImage').appendChild(img2);
</script>