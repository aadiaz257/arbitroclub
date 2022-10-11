$(document).ready(function(){
    $('.finalizar_partido').on('click', function(e){
        e.preventDefault();
        let url = $(this).prop('href');
        let id = (url.split('=')[1]).split('&')[0];
        let horas_laboradas = $('#horas_laboradas-'+id).val();

        $.ajax({
            url: url+'&horas_laboradas='+horas_laboradas,
            type: 'GET',
            success: function(data){
                if(data == 1)
                {
                    var URLactual = jQuery(location).attr('href');
                    $(location).prop('href', URLactual)
                }
                else
                {
                    alert('Error');
                }
            }
        });
     });
});


$(document).ready( function () {
    $("#caddie").dataTable().fnDestroy();
    var table = $('#caddie').DataTable( {
    pageLength : 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],

              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
            dom: 'Btip', 
        buttons: [
            { extend: 'excelHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
        ]
  } )
} );


