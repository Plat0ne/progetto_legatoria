$(document).ready(function() {

	var currentRoute = window.location.href.split('route=')[1].replace(/_/g, ' ');
	console.log(currentRoute);

    // Create a new row for search inputs
    var searchRow = $('<tr></tr>').appendTo($('#datatable-generic thead'));

    // Setup - add a text input to each footer cell
    $('#datatable-generic thead th').each(function (i) {
        var title = $(this).text();

		        if (!title || $(this).hasClass('NoSearchbar')) {
			$('<th></th>').appendTo(searchRow).html(`
				<div></div>
			`);
            return;
        }
        
        // Add the title to the original th
        $(this).html(`<span>${title}</span>`);

        // Add a search input to the search row
        $('<th></th>').appendTo(searchRow).html(`
            <input type="text" placeholder="" data-index="${i}" style="width: 100%; height: 25px; padding: 2px; font-size: 15px;" />
        `);
    });

    // Initialize DataTable and store it in the 'table' variable
    var table = $('#datatable-generic').DataTable({
        responsive: true,
        language: {
            "sEmptyTable": "Nessun dato presente nella tabella",
            "sInfo": "Vista da _START_ a _END_ di _TOTAL_ elementi",
            "sInfoEmpty": "Vista da 0 a 0 di 0 elementi",
            "sInfoFiltered": "(filtrati da _MAX_ elementi totali)",
            "sInfoThousands": ".",
            "sLengthMenu": "Visualizza _MENU_ elementi",
            "sLoadingRecords": "Caricamento...",
            "sProcessing": "Elaborazione...",
            "sSearch": "Cerca:",
            "sZeroRecords": "La ricerca non ha portato alcun risultato.",
            "oPaginate": {
                "sFirst": "Inizio",
                "sPrevious": "Precedente",
                "sNext": "Successivo",
                "sLast": "Fine"
            },
            "oAria": {
                "sSortAscending": ": attiva per ordinare la colonna in ordine crescente",
                "sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
            }
        },
        dom: 'Bfrtip',
        pageLength: 50,
        order: [0, 'desc'],
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copia',
				title: `Export_${moment($('#start_date').val()).format('DD-MM-YYYY')}_al_${moment($('#end_date').val()).format('DD-MM-YYYY')}`,
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
				title: `Export_${moment($('#start_date').val()).format('DD-MM-YYYY')}_al_${moment($('#end_date').val()).format('DD-MM-YYYY')}`,
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
				title: `Export_${moment($('#start_date').val()).format('DD-MM-YYYY')}_al_${moment($('#end_date').val()).format('DD-MM-YYYY')}`,
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
				title: `Export_${moment($('#start_date').val()).format('DD-MM-YYYY')}_al_${moment($('#end_date').val()).format('DD-MM-YYYY')}`,
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            }
        ],
		columnDefs: [
			{
				targets: '_all', // Applica a tutte le colonne
				render: function (data, type, row, meta) {
					return data; // Default per altri usi
				}
			}
		]
    });

    // Filter event handler
    $(table.table().container()).on('keyup', 'thead input', function () {
        table
            .column($(this).data('index'))
            .search(this.value)
            .draw();
    });
});

