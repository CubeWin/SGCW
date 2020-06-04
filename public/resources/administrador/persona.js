var persona = new PersonaFunciones();

async function guardar() {
    myForm = document.querySelector("form[name='personaRegistro']");
    var formData = new FormData(myForm);
    await persona.guardarPersona(formData);
    await myForm.reset();
    modal = document.querySelector("[class='cw-modal']");
    modal.classList.add("cw-disabled-modal");
}
function editPersona(id) {
    persona.editarPersona(id);
}

function deletePersona(id) {
    swal({
        title: "Eliminar?",
        text: "Esta seguro de borrar esta persona?",
        icon: "error",
        buttons: ["Cancelar", true],
        dangerMode: true,
    })
        .then(deleteIt => {
            if (deleteIt) {
                persona.eliminarPersona(id);
            }
        });
}

function clearFormPersona() {
    myForm = document.querySelector("form[name='personaRegistro']");
    myForm.reset();
}

$(function () {
    $("form[name='personaRegistro']").validate({
        rules: {
            name: {
                required: true,
                minlength: 4,
                maxlength: 100
            },
            surname: {
                required: true,
                minlength: 4,
                maxlength: 200
            },
            telephone: {
                maxlength: 15
            },
            email: {
                email: true,
                maxlength: 50
            },
            gender: {
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
    input = document.getElementById("buscarPersona");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablePersona");
    tr = table.getElementsByTagName("tr");
    
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
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