$(document).ready(function() {
    console.log('Entro a incio');
    $('#subirTejido').submit(function() {
        console.log('Entro a submit');
        if (comprobar($('#titulo').val()) && comprobar($('#descp').val()) && comprobar($('#descp').val()) && comprobar($('#precio').val())) {
            $('#errorTejido').hide(200);
            return true;
        } else {
            $('#errorSubirTejido').html('<p id="errorTejido" class="text-danger"> *Hay un error en alguno de los campos, por favor verifique. </p>');
            console.log('No submit :c');
            return false;

        }

    })

});

function comprobar(compString) {

    var textoAuxFiltro = '<>{}-=\~`|';
    var text = '';
    text = compString;
    console.log(text);

    for (char = 0; char < text.length; char++) {
        console.log(text.charAt(char));

        if (textoAuxFiltro.indexOf(text.charAt(char)) != -1) {
            console.log(char);
            return false;
        }
    }

    return true;
}