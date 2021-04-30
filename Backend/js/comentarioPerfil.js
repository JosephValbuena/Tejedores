$(document).ready(function() {
    $(".enviar-btn").keypress(function(event) {
        if (event.which == 13) {

            var getpID = $(this).parent().attr('id').replace('perfil-', '');

            var usuario = $("input#usuario").val();
            var comentario = $("#comentario-" + getpID).val();
            var perfil = getpID;
            var foto = $("input#foto").val();
            var nombre = $("input#nombre").val();
            date_show = new Date();

            if (comentario == '') {
                alert("Debes añadir un comentario");
                return false;
            }

            var dataString = 'usuario=' + usuario + '&comentario=' + comentario + '&perfil=' + perfil;

            $.ajax({
                method: 'POST',
                url: 'http://localhost/ProyectoFinal/Backend/comentarioPerfil.php',
                data: dataString,
                success: function() {
                    window.location = location.href;
                }

            });

            return false;

        }
    });
});