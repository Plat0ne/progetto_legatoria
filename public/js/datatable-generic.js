console.log('Debug: DataTable inizializzato!!!');

$(document).ready(function() {
    

    // Creo una nuova riga per le barre di ricerca
    var searchRow = $('<tr></tr>').appendTo($('#datatable-generic thead'));

    // Imposta - aggiungi un input di testo a ogni cella del footer
    $('#datatable-generic thead th').each(function (i) {
        var title = $(this).text();

        if (!title || $(this).hasClass('NoSearchbar')) {
            $('<th></th>').appendTo(searchRow).html(`
                <div></div>
            `);
            return;
        }
        
        // Aggiungi il titolo alla cella originale
        $(this).html(`<span>${title}</span>`);

        // Aggiungi una barra di ricerca alla riga di ricerca
        $('<th></th>').appendTo(searchRow).html(`
            <input type="text" placeholder="" data-index="${i}" style="width: 100%; height: 25px; padding: 2px; font-size: 15px;" />
        `);
    });

    // Inizializza DataTable e memorizzalo nella variabile 'table'
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
				title: 'report Legatoria',
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
				title: 'report Legatoria',
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
				title: 'report Legatoria',
                exportOptions: {
                    columns: ':visible :not(.NoExport)'
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
				title: `report Legatoria`,
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

    // Event handler per la ricerca
    $(table.table().container()).on('keyup', 'thead input', function () {
        table
            .column($(this).data('index'))
            .search(this.value)
            .draw();
    });
});

