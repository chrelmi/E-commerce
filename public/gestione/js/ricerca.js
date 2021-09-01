$(function() {

  if ($('.datatable-search').length > 0 && !!$.fn.DataTable) {
    $('.datatable-search').each(function(index, elem) {
      var form = $("#" + $(elem).data('idform'));
      var columns = [];

      if (typeof window.columns != "undefined") {
        for (var i in window.columns) {
          columns.push({
            data: window.columns[i].data,
            orderable: !!window.columns[i].orderable
          });
        }
      }

      var dataTable = $(elem).dataTable($.extend({}, window.optionsDefaultDataTable, {
        saveState: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
          url: form.attr("action"),
          type: form.attr("method"),
          data: function(d) {
            return (
              $.extend(
                d, {
                  data: form.serializeObject()
                }
              )
            );
          }
        },
        pageLength: 25,
        columns: columns
      }));

      // dataTable.on('draw.dt', (e, settings) => {
      //   window.reloadInputs($("#search-table"));
      // });

      form.on('click', '.reset-ordinamento', function(e) {
        e.preventDefault();
        dataTable.fnSortNeutral();
      });

      form.submit(function(e) {
        e.preventDefault();
        dataTable.api().ajax.reload();
      });

      form.on('click', '.annulla-ricerca', function(e) {
        $('.campo-ricerca').each(function(index, elem) {
          $(elem).val('');
        });
        form.submit();
      });
    });
  }
});

// Opzioni di default per il plugin jQuery.DataTable
window.optionsDefaultDataTable = {
	responsive: false,
	/* No ordering applied by DataTables during initialisation */
	order: [],
	language: {
		emptyTable: "Nessun dato presente",
		info: "Vista da _START_ a _END_ di _TOTAL_ elementi",
		infoEmpty: "Vista da 0 a 0 di 0 elementi",
		infoFiltered: "(filtrati da _MAX_ elementi totali)",
		infoPostFix: "",
		infoThousands: ".",
		lengthMenu: "Visualizza _MENU_ elementi",
		loadingRecords: "Caricamento...",
		processing: "Elaborazione...",
		search: "Cerca:",
		zeroRecords: "La ricerca non ha portato alcun risultato.",
		paginate: {
			first: "Inizio",
			previous: "Precedente",
			next: "Successivo",
			last: "Fine"
		},
		aria: {
			sortAscending: ": attiva per ordinare la colonna in ordine crescente",
			sortDescending: ": attiva per ordinare la colonna in ordine decrescente"
		}
	}
};