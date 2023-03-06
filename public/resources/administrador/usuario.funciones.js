class UsuarioFunciones {
    constructor() {
        this.listarUsuario();
    }

    guardarUsuario(formData) {
        fetch('../usuario/guardar', {
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
                this.listarUsuario();
            });
    }

    editarUsuario(id) {
        fetch('../usuario/buscar/' + id, {
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
                    console.log(response);
                    document.querySelector("#nuevoUsuario").click();
                    document.querySelector("[name='id']")['value'] = response[0].id;
                    document.querySelector("[name='id_persona']")['value'] = response[0].id_persona;
                    document.querySelector("[name='descriptionPersona']")['value'] = response[0].person;
                    document.querySelector("[name='id_grupo']")['value'] = response[0].id_grupo;
                    document.querySelector("[name='user']")['value'] = response[0].user;
                    document.querySelector("[name='password']")['value'] = "";
                    document.querySelector("[name='state']")['value'] = response[0].state;
                }
                this.listarUsuario();
            });
    }

    eliminarUsuario(id) {
        fetch('../usuario/eliminar/' + id, {
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
                this.listarUsuario();
            });
    }

    listarUsuario() {
        fetch('../usuario/listar', {
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
                var grupo = "";
                var estado = "";
                if (response.fail) {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 15000 });
                } else {
                    for (let i = 0; i < response.length; i++) {
                        if (response[i].id_grupo == 1) { grupo = "Administrador" } else { grupo = "estandar" }
                        if (response[i].state == 1) { estado = "Activo" } else { estado = "no Activo" }
                        htmlSet += "<tr>";
                        htmlSet += "<td> " + (i + 1) + "</td>";
                        htmlSet += "<td> " + grupo+ " </td>";
                        htmlSet += "<td> " + response[i].user + " </td>";
                        htmlSet += "<td> " + response[i].password + " </td>";
                        htmlSet += "<td> " + estado + " </td>";
                        htmlSet += "<td> <a class=\"card-link text-info\" onclick=\"editUsuario(" + response[i].id + ")\"><i class=\"fa fa-edit\"></i></a></td>";
                        htmlSet += "<td> <a class=\"card-link text-danger\" onclick=\"deleteUsuario(" + response[i].id + ")\"><i class=\"fa fa-trash\"></i></a></td>";
                        htmlSet += "</tr>";
                    }
                    document.querySelector('#listarUsuario').innerHTML = htmlSet;
                    $(function() {
                        $('#pageUsuario').jPages({
                            containerID: 'listarUsuario',
                            perPage: 10,
                            midRange: 3,
                            animation: "fadeIn"
                        });
                    });
                    document.querySelector('#buscarUsuario').value = "";
                }
            });
    }

    buscarPersona(id) {
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
                    $.toast({ title: "Error", subtitle: "Buscar Persona", content: response.fail, type: response.tipo, delay: 5000 });
                } else {
                    return {"option" : response[0].name + " " + response[0].surname, "value" : response[0].id};
                }
            });
    }

    listarPersona(buscar) {
        fetch('../persona/buscar_by_person/'+buscar, {
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
                if (response.tipo == "danger") {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 15000 });
                } else if(response.tipo == "warning"){
                    htmlSet += "<div class=\"py-2 px-3 border-bottom\">No hay datos</div>";
                    document.querySelector('#listOfPersona').innerHTML = htmlSet;
                } else {
                    for (let i = 0; i < response.length; i++) {
                        htmlSet += "<div class=\"py-2 px-3 border-bottom\" search=\"" + response[i].id +"\" onclick=\"selectSearch(this)\">";
                        htmlSet += response[i].name + " " + response[i].surname +"</div>"
                    }
                    document.querySelector('#listOfPersona').innerHTML = htmlSet;
                }
            });
    }

    getError() {
        //console.log("Respuesta : " + getCookie("token2"));

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
