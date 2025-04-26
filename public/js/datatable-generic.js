console.log('Debug: DataTable inizializzato');

$(document).ready(function() {


    //qui impostiamo una barra di ricerca per ogni colonna
    $('#datatable-generic thead th').each(function (i) {
        var title = $(this).text();

        if (!title || $(this).hasClass('NoSearchbar')) {
             $('<div></div>').appendTo($(this)).html(`
                <div><br></div>
            `);
            return;
        }
        
        // // Aggiungi il titolo alla cella originale
        // $(this).html(`<span>${title}</span>`);

        // Aggiungo una input barr
        $('<div></div>').appendTo($(this)).html(`
            <input type="text" placeholder="" data-index="${i}" style="width: 100%; height: 25px; padding: 2px; font-size: 15px;" />
        `);
    });

    //datatable
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
                    columns: ':visible :not(.NoExport)',
					header: true,
					modifier: {
						search: 'applied',
						order: 'applied'
					}
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
				title: 'report Legatoria',
                exportOptions: {
                    columns: ':visible :not(.NoExport)',
					header: true,
					modifier: {
						search: 'applied',
						order: 'applied'
					}
                }
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
				title: 'report Legatoria',
                exportOptions: {
                    columns: ':visible :not(.NoExport)',
					header: true,
					modifier: {
						search: 'applied',
						order: 'applied'
					}
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
				title: `report Legatoria`,
                exportOptions: {
                    columns: ':visible :not(.NoExport)',
					header: true,
					modifier: {
						search: 'applied',
						order: 'applied'
					}
                }
            }
        ],
		columnDefs: [
			{
				targets: '_all',
				render: function (data, type, row, meta) {
					return data;
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

