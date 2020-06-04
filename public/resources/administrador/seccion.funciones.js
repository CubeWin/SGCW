class SeccionFunciones {
    constructor() {

    }

    cargarHtml(id) {
        let URL = '../../seccion/listar/' + id;
        console.log(URL);
        fetch(URL, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST"
        })
            .then(res => res.json())
            .catch(error => {
                console.log("hubo un fallo");
            })
            .then(response => {
                let htmlSet = "";
                if (response.fail) {
                    $.toast({ title: "Error", subtitle: "", content: response.fail, type: response.tipo, delay: 15000 });
                } else {
                    console.log(response);
                    htmlSet = this.htmlReturn(response);
                    document.querySelector('#seccion').innerHTML = htmlSet;
                }
            });
    }

    htmlReturn(a) {
        let totalFilas = a.length;
        let iterable, idDetalle, bloque, contar = 0;
        let returnHtml = "";
        let htmlIterable = "";
        for (let i = 0; i < totalFilas; i++) {
            // const element = array[i];
            contar++;
            if (a[i].iterable == 1) {
                htmlIterable = `<div class=\"p-1 mb-3 rounded d-flex justify-content-between\">
                        <button id=\"nuevoPersona\" onclick=\"\" class=\"btn btn-white font-weight-bold d-flex align-items-center justify-content-center px-3 px-lg-4 cw-open-lateral\" cw-lateral-target=\"#RegistrarPersona\">
                            <i class=\"fa fa-plus-circle text-info\"></i>
                            <span class=\"d-none d-md-block\">&nbsp;&nbsp;Agregar</span>
                        </button>
                        <form class=\"form-inline\">
                            <div class=\"md-form my-0 d-flex justify-content-center\">
                                <input class=\"form-control mr-sm-2 w-75\" type=\"text\" placeholder=\"Contenido\" aria-label=\"Buscar\" onkeyup=\"myFunctionCW()\" id=\"buscarPersona\">
                                <div class=\"btn btn-white font-weight-bold px-3 m-auto\"><i class=\"fa fa-search text-primary\"></i></div>
                            </div>
                        </form>
                    </div>`;
            }
            const htmlHeader = `<div class=\"card mt-5\">
                <div class=\"cw-front-title cw-backLogin4 d-flex mx-4 px-4 py-2 rounded justify-content-center align-items-center text-white cw-shadow-front position-relative\">
                    <h2 class=\"h5 m-0 text-center\">${a[i].nombre}</h2>
                </div>
                <div class=\"card-body table-responsive\">
                    ${htmlIterable}
                    <div class=\"table-responsive shadow-sm\">
                        <table class=\"table table-hover text-center table-sm m-0\" id=\"\">
                            <thead class=\"text-white\" style=\"background: rgb(100, 175, 131);\">
                                <th class=\"text-capitalize font-weight-bold\">#</th>
                                <th class=\"text-capitalize font-weight-bold\">contenido</th>
                                <th class=\"text-capitalize font-weight-bold\">grupo</th>
                                <th class=\"text-capitalize font-weight-bold\">editar</th>
                                <th class=\"text-capitalize font-weight-bold\">eliminar</th>
                            </thead>
                            <tbody id=\"\">`;
            let htmlLine = `<tr>
                    <td>${contar}</td>
                    <td>${a[i].contenido}</td>
                    <td>${a[i].grupo}</td>
                    <td><a class=\"card-link text-info\" onclick=\"edit(${a[i].id_detalle_pk})\"><i class=\"fa fa-edit\"></i></a></td>
                    <td><a class=\"card-link text-danger\" onclick=\"delete(${a[i].id_detalle_pk})\"><i class=\"fa fa-trash\"></i></a></td>
                </tr>`;
            const htmlFooter = `</tbody>
                            </table>
                        </div>
                        <div id=\"\" class=\"cw-pageNumber text-right mt-4\"></div>
                    </div>
                </div>`;

            if (i == 0) {
                iterable = a[i].iterable;
                idDetalle = a[i].id_detalle;
                bloque = a[i].id_bloque;
                returnHtml += htmlHeader;
            }

            if (iterable == a[i].iterable && idDetalle == a[i].id_detalle && bloque == a[i].id_bloque) {
                returnHtml += htmlLine;
            } else {
                returnHtml += htmlFooter;
                iterable = a[i].iterable;
                idDetalle = a[i].id_detalle;
                bloque = a[i].id_bloque;
                contar = 1;
                returnHtml += htmlHeader;
                returnHtml += `<tr>
                <td>${contar}</td>
                <td>${a[i].contenido}</td>
                <td>${a[i].grupo}</td>
                <td><a class=\"card-link text-info\" onclick=\"edit(${a[i].id_detalle_pk})\"><i class=\"fa fa-edit\"></i></a></td>
                <td><a class=\"card-link text-danger\" onclick=\"delete(${a[i].id_detalle_pk})\"><i class=\"fa fa-trash\"></i></a></td>
            </tr>`;
            }

            if (i == totalFilas - 1) {
                returnHtml += htmlFooter;
            }
        }

        return returnHtml;
    }
}