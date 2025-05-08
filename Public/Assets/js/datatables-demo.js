
$(document).ready(function() {
    $('#apartmentsTable').DataTable({
        dom: '<"d-flex justify-content-start" B>frtip', // Personaliza la disposición del DOM
        buttons: ['copy','csv','excel','colvis'],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });
});
