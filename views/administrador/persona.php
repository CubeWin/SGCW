<div class="d-flex align-items-center">
    <h1 class="teal-text">Persona</h1><span class="badge teal small p-2 h-50 mx-3">Formulario</span>
</div>
<hr>
<div class="card mt-5">
    <div class="cw-front-title cw-backLogin4 d-flex mx-4 px-4 py-2 rounded justify-content-center align-items-center text-white cw-shadow-front position-relative">
        <h2 class="h5 m-0 text-center">Lista de Usuarios</h2>
    </div>
    <div class="card-body table-responsive">
        <div class="p-1 mb-3 rounded d-flex justify-content-between">
            <button id="nuevoPersona" onclick="clearFormPersona()" class="btn btn-white font-weight-bold d-flex align-items-center justify-content-center px-3 px-lg-4 cw-open-lateral" cw-lateral-target="#RegistrarPersona">
                <i class="fa fa-plus-circle text-info"></i>
                <span class="d-none d-md-block">&nbsp;&nbsp;Agregar</span>
            </button>
            <form class="form-inline">
                <div class="md-form my-0 d-flex justify-content-center">
                    <input class="form-control mr-sm-2 w-75" type="text" placeholder="Nombre o Apellido" aria-label="Buscar" onkeyup="myFunctionCW()" id="buscarPersona">
                    <div class="btn btn-white font-weight-bold px-3 m-auto"><i class="fa fa-search text-primary"></i></div>
                </div>
            </form>
        </div>
        <div class="table-responsive shadow-sm">
            <table class="table table-hover text-center table-sm m-0" id="tablePersona">
                <thead class="text-white" style="background: rgb(100, 175, 131);">
                    <th class="text-capitalize font-weight-bold">#</th>
                    <th class="text-capitalize font-weight-bold">Persona</th>
                    <th class="text-capitalize font-weight-bold">Telefono</th>
                    <th class="text-capitalize font-weight-bold">Correo</th>
                    <th class="text-capitalize font-weight-bold">Genero</th>
                    <th class="text-capitalize font-weight-bold">editar</th>
                    <th class="text-capitalize font-weight-bold">eliminar</th>
                </thead>
                <tbody id="listarPersona">
                    <!--  -->
                </tbody>
            </table>
        </div>
        <div id="pagePersona" class="cw-pageNumber text-right mt-4"></div>
    </div>
</div>