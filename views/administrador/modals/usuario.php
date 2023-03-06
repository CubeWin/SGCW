<div class="cw-modal cw-disabled-modal" id="RegistrarUsuario">
    <div class="cw-modal-content">
        <div class="cw-modal-card p-2">
            <form class="card h-100" autocomplete="off" name="usuarioRegistro" action="#">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase m-0 h4 font-weight-bold text-muted">
                        Registrar Usuario
                    </h6>
                    <button type="button" class="cw-close-lateral px-3 bg-transparent border-0" cw-lateral-target="#RegistrarUsuario">
                        <i class="fa fa-times text-danger fa-1x"></i>
                    </button>
                </div>
                <div class="card-body h-100 grey lighten-3 overflow-auto">
                    <input type="text" class="form-control d-none" name="id" id="inputId" placeholder="ID" />

                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">persona:</div>
                        <div class="col-sm-9">
                            <div class="cw-search">

                                <div class="cw-search-box">

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Buscar Persona" name="descriptionPersona">
                                        <a class="input-group-append" onclick="activeSearch()" onchange="validSearch()">
                                            <span class="input-group-text bg-info text-white" id="basic-addon2">
                                                <i class="fa fa-search"></i>&nbsp;Buscar
                                            </span>
                                        </a>
                                    </div>

                                    <div class="cw-search-list">
                                        <span class="cw-list-title bg-info text-white d-flex justify-content-between py-2 px-3 border-bottom">
                                            Seleccionar
                                            <button type="button" class="px-3 bg-transparent border-0" onclick="closeSearch()">
                                                <i class="fa fa-times text-white fa-1x"></i>
                                            </button>
                                        </span>
                                        <div class="cw-search-items" id="listOfPersona">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input type="text" name="id_persona" id="inputId_persona" class="form-control disabled" style="border:0; color:transparent;background:transparent">
                            <label class="error text-danger pl-2" for="inputId_persona"></label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Grupo:</div>
                        <div class="col-sm-9">
                            <select name="id_grupo" id="inputId_grupo" class="form-control">
                                <option selected disabled hidden>Seleccionar Grupo</option>
                                <option value="1">Administrador</option>
                            </select>
                            <label class="error text-danger pl-2" for="inputId_grupo"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Usuario:</div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user" id="inputUser" placeholder="Usuario" />
                            <label class="error text-danger pl-2" for="inputUser"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Clave:</div>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Clave" />
                            <label class="error text-danger pl-2" for="inputPassword"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Estado:</div>
                        <div class="col-sm-9">

                            <select name="state" id="inputState" class="form-control">
                                <option selected disabled hidden>Seleccionar estado</option>
                                <option value="1">Activo</option>
                                <option value="2">No activo</option>
                            </select>
                            <label class="error text-danger pl-2" for="inputState"></label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="#" class="btn border-light px-3 cw-close-lateral" cw-lateral-target="#RegistrarUsuario"><i class="fa fa-times"></i>&nbsp;&nbsp;cancelar</a>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>