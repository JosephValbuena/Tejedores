$(document).ready(function(){

    $('.comentForm').submit(function(e){
        const comentGet = {
            coment:  $('#'+$(this)[0].children[0].id+'').val(),
            idPublic: $(this)[0].children[0].id,
            idUser: 1 //aquí se define el id del usuario, teniendo en cuenta el login 
        }

        $.post('../Backend/comentarios.php',comentGet,function(response){
            console.log(response)
        })
        e.preventDefault();


    })
});