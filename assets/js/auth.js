$(document).ready(function () {
    $('#recover').on( "submit", function( e ) {
        e.preventDefault();
        $('#recover-panel').empty();
        $('#recover-panel').append(
        "<b>Se ha enviado un email a su correo electr&oacute;nico</b>"
        );
    });
});