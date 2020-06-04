let id = document.querySelector('input[name="id_seccion"]').value;
let seccion = new SeccionFunciones();

$(document).ready(function(){
    console.log(id);
    seccion.cargarHtml(id);
});