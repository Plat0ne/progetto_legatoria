<script>
	function exportToPdf(fileName){
		var element = document.getElementById('dataTable');
		var opt = {
			margin: [0.15, 0.15, 0.15, 0.15],
			filename: fileName,
			image: {type: 'jpeg', quality: 1},
			html2canvas: {scale: 2},
			jsPDF: {unit: 'in', format: 'a4', orientation: 'portrait'}
		};
		html2pdf().set(opt).from(element).save();
	}

	function exportToCsv(fileName){
		var csv = "<?php echo $csv; ?>";
		var data = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
		var csvURL = window.URL.createObjectURL(data);
		var tempLink = document.createElement('a');
		tempLink.setAttribute('href', csvURL);
		tempLink.setAttribute('download', fileName);
		tempLink.style.visibility = 'hidden';
		document.body.appendChild(tempLink);
		tempLink.click();
		document.body.removeChild(tempLink);
	}
</script>