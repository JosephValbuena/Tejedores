$(document).ready(function() {
    $(".comentarAqui").click(function(event) {

        var getpID = $(this).parent().attr('id').replace('record-', '');

        var usuario = $("input#usuario").val();
        var comentario = $("#comentario-" + getpID).val();
        var publicacion = getpID;
        var foto = $("input#foto").val();
        var nombre = $("input#nombre").val();
        date_show = new Date();

        if (comentario == '') {
            alert("Debes añadir un comentario");
            return false;
        }

        var dataString = 'usuario=' + usuario + '&comentario=' + comentario + '&publicacion=' + publicacion;

        $.ajax({
            method: 'POST',
            url: '/ProyectoFinal/Backend/agregarcomentario.php',
            data: dataString,
            done: function() {
                $('#nuevocomentario' + getpID).append('<div class="box-comment"><img class="img-circle img-sm" src="/ProyectoFinal/Backend/imagenes/usuarios/' + foto + '"><div class="comment-text"><span class="username"> ' + nombre + '<span class="text-muted pull-rigth">' + date_show + '</span></span>' + comentario + '</div></div>');
            }

        });

        return false;
    });
});