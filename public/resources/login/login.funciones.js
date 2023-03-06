class Usuarios {
    constructor() {

    }

    logUser(user, password) {
        if (user == "") {
            $("[name='usuario']").focus();
            $.toast({ title: "Falta ingresar usuario", type: "warning", delay: 5000 });
        } else {
            if (password == "") {
                $("[name='password']").focus();
                $.toast({ title: "Falta ingresar password", type: "warning", delay: 5000 });
            } else {
                if (validarTexto(user)) {
                    if (password.length >= 4) {
                        var formData = new FormData();
                        formData.append('user',  user);
                        formData.append('password', password);

                        fetch('usuario/validar', {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            method: "POST",
                            body: JSON.stringify(Object.fromEntries(formData))
                        })
                            .then(res => res.json())
                            .catch(error => {
                                console.error('Error:', error);
                            })
                            .then(response => {
                                console.log(response);
                                if (response.success) {
                                    $.toast({ title: response.success, type: response.tipo, delay: 3000 });
                                    setTimeout(function () { window.location = "login/inicio" }, 1000);
                                } else {
                                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 5000 });
                                }
                            });

                    } else {
                        $("[name='password']").focus();
                        $.toast({ title: "Ingresar almenos 4 caracteres", type: "danger", delay: 5000 });
                    }
                } else {
                    $("[name='usuario']").focus();
                    $.toast({ title: "Usar caracteres validos en el usuario", type: "danger", delay: 5000 });
                }
            }
        }
    }
}
