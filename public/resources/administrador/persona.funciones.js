class PersonaFunciones {
    constructor() {
        this.listarPersona();
    }

    guardarPersona(formData) {
        fetch('../persona/guardar', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST",
            body: JSON.stringify(Object.fromEntries(formData))
        })
            .then(res => res.json())
            .catch(error => {
                this.getError();
            })
            .then(response => {
                if (response.success) {
                    $.toast({ title: response.success, type: response.tipo, delay: 3000 });
                    swal("Completo!", response.success, "success");
                } else {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 5000 });
                    swal("Fallo!", response.fail, "info");
                }
                this.listarPersona();
            });
    }

    editarPersona(id) {
        fetch('../persona/buscar/' + id, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST"
        })
            .then(res => res.json())
            .catch(error => {
                this.getError();
            })
            .then(response => {
                if (response.fail) {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 5000 });
                } else {
                    // Object.entries(response).forEach(([key, value]) => {
                    //     console.log(key + ' - ' +value) // key - value
                    // })
                    // for(var key in response){
                    //     console.log(key + ' - ' + response[key])
                    //   }
                    document.querySelector("#nuevoPersona").click();
                    document.querySelector("[name='id']")['value'] = response[0].id;
                    document.querySelector("[name='name']")['value'] = response[0].name;
                    document.querySelector("[name='surname']")['value'] = response[0].surname;
                    document.querySelector("[name='telephone']")['value'] = response[0].telephone;
                    document.querySelector("[name='email']")['value'] = response[0].email;
                    document.querySelector("[name='gender']")['value'] = response[0].gender;

                }
                this.listarPersona();
            });
    }

    eliminarPersona(id) {
        fetch('../persona/eliminar/' + id, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST"
        })
            .then(res => res.json())
            .catch(error => {
                this.getError();
            })
            .then(response => {
                if (response.success) {
                    $.toast({ title: response.success, type: response.tipo, delay: 5000 });
                    swal("Eliminado!", response.success, "success");
                } else {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 5000 });
                    swal("No eliminado!", response.fail, "info");
                }
                this.listarPersona();
            });
    }

    listarPersona() {
        fetch('../persona/listar', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST"
        })
            .then(res => res.json())
            .catch(error => {
                this.getError();
            })
            .then(response => {
                var htmlSet = "";
                var genero = "";
                var telephone = "";
                var email = "";
                if (response.fail) {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 15000 });
                } else {
                    for (let i = 0; i < response.length; i++) {
                        if (response[i].gender == 1) { genero = "Masculino" } else { genero = "Femenino" }
                        if (response[i].telephone == null) { telephone = "-" } else { telephone = response[i].telephone }
                        if (response[i].email == null) { email = "-" } else { email = response[i].email }
                        htmlSet += "<tr>";
                        htmlSet += "<td> " + (i + 1) + "</td>";
                        htmlSet += "<td> " + response[i].name + " " + response[i].surname + " </td>";
                        htmlSet += "<td> " + telephone + " </td>";
                        htmlSet += "<td> " + email + " </td>";
                        htmlSet += "<td> " + genero + " </td>";
                        htmlSet += "<td> <a class=\"card-link text-info\" onclick=\"editPersona(" + response[i].id + ")\"><i class=\"fa fa-edit\"></i></a></td>";
                        htmlSet += "<td> <a class=\"card-link text-danger\" onclick=\"deletePersona(" + response[i].id + ")\"><i class=\"fa fa-trash\"></i></a></td>";
                        htmlSet += "</tr>";
                    }
                    document.querySelector('#listarPersona').innerHTML = htmlSet;
                    $(function() {
                        $('#pagePersona').jPages({
                            containerID: 'listarPersona',
                            perPage: 10,
                            midRange: 3,
                            animation: "fadeIn"
                        });
                    });
                    document.querySelector('#buscarPersona').value = "";
                }
            });
    }

    getError() {
        if (getCookie("token") == "") {
            $.toast({ title: "Warning", subtitle: "", content: "Se sobrepaso el tiempo sin actividad.", type: "warning", delay: 10000 });
            $.toast({ title: "Error", subtitle: "", content: "Token caducado", type: "danger", delay: 10000 });
            $.toast({ title: "Info", subtitle: "", content: "Se redireccionara a la pagina de login.", type: "info", delay: 10000 });
            setTimeout(function () { window.location = "../login/inicio" }, 10000);
        }else{
            $.toast({ title: "Warning", subtitle: "", content: "Hubo un error, se recomienda actualizar la página.", type: "warning", delay: 10000 });
        }
    }

}
