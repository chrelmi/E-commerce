$(function() {
    $(".datatable-search").on('click', '.rimuovi-record', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Attenzione!',
            text: "Sicuro di voler eliminare? Non potrai più tornare indietro!",
            showCancelButton: true,
            confirmButtonText: "Procedi",
            confirmButtonColor: "#198754",
            cancelButtonText: "Annulla",
            cancelButtonColor: "#dc3545",
        }).then(function(result) {
            if (result.isConfirmed) {
                $(e.currentTarget).closest('form').submit();
            } else {
                e.preventDefault();
            }
        });
    });
})