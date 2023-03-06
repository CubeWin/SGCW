var usuario = new UsuarioFunciones();

async function guardar() {
    myForm = document.querySelector("form[name='usuarioRegistro']");
    var formData = new FormData(myForm);
    await usuario.guardarUsuario(formData);
    await myForm.reset();
    modal = document.querySelector("[class='cw-modal']");
    modal.classList.add("cw-disabled-modal");
}
function editUsuario(id) {
    usuario.editarUsuario(id);
}

function deleteUsuario(id) {
    swal({
        title: "Eliminar?",
        text: "Esta seguro de borrar este usuario?",
        icon: "error",
        buttons: ["Cancelar", true],
        dangerMode: true,
    })
        .then(deleteIt => {
            if (deleteIt) {
                usuario.eliminarUsuario(id);
            }
        });
}

function clearFormUsuario() {
    myForm = document.querySelector("form[name='usuarioRegistro']");
    myForm.reset();
}

$(function () {
    $("form[name='usuarioRegistro']").validate({
        rules: {
            id_persona: {
                required: true
            },
            id_grupo: {
                required: true
            },
            user: {
                required: true,
                minlength: 4,
                maxlength: 20
            },
            password: {
                required: true,
                minlength: 4,
                maxlength: 25
            },
            state: {
                required: true
            }
        },
        submitHandler: function (form) {
            guardar();
        }
    });
});

function myFunctionCW() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("buscarUsuario");
    filter = input.value.toUpperCase();
    table = document.getElementById("tableUsuario");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function activeSearch() {
    // console.log(document.querySelector("[name='descriptionPersona']")['value']);

    // newbuscar = document.querySelector("[name='descriptionPersona']")['value'];
    // console.log(newbuscar);
    // let newbuscar =  document.querySelector("[name='descriptionPersona']")['value'];
    let buscar =  document.querySelector("[name='descriptionPersona']")['value'];
    let newbuscar=buscar.split(" ");
    usuario.listarPersona(newbuscar[0]);
    document.querySelector(".cw-search-box").classList.add("cw-search-active");
}

function closeSearch() {
    document.querySelector(".cw-search-box").classList.remove("cw-search-active");
}

function selectSearch(obj) {
    // console.log(obj);
    // console.log(obj.attributes["search"].value);
    // console.log(obj.innerText);
    let id = 0;
    let text = "";

    id = obj.attributes["search"].value;
    text = obj.innerText;

    document.querySelector("[name='descriptionPersona']")['value'] = text;
    document.querySelector("[name='id_persona']")['value'] = id;

    closeSearch();
}

function validSearch (){
    document.querySelector("[name='id_persona']")['value'] = "";
}