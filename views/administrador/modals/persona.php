<div class="cw-modal cw-disabled-modal" id="RegistrarPersona">
    <div class="cw-modal-content">
        <div class="cw-modal-card p-2">
            <form class="card h-100" autocomplete="off" name="personaRegistro" action="#">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase m-0 h4 font-weight-bold text-muted">
                        Registrar Persona
                    </h6>
                    <button type="button" class="cw-close-lateral px-3 bg-transparent border-0" cw-lateral-target="#RegistrarPersona">
                        <i class="fa fa-times text-danger fa-1x"></i>
                    </button>
                </div>
                <div class="card-body h-100 grey lighten-3 overflow-auto">
                    <input type="text" class="form-control d-none" name="id" id="inputId" placeholder="ID" />
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Nombres:</div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="inputNombre" placeholder="Nombres"/>
                            <label class="error text-danger pl-2" for="inputNombre"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Apellidos:</div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="surname" id="inputApellido" placeholder="Apellidos"/>
                            <label class="error text-danger pl-2" for="inputApellido"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Teléfono:</div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="telephone" id="inputTelefono" placeholder="Teléfono"/>
                            <label class="error text-danger pl-2" for="inputTelefono"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Correo:</div>
                        <div class="col-sm-9">
                            <input type="mail" class="form-control" name="email" id="inputCorreo" placeholder="Correo@dominio.com"/>
                            <label class="error text-danger pl-2" for="inputCorreo"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label teal-text font-weight-bold">Género:</div>
                        <div class="col-sm-9">
                            <select name="gender" id="inputGenero" class="form-control">
                                <option selected disabled hidden>Seleccionar Género</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                            <label class="error text-danger pl-2" for="inputGenero"></label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="#" class="btn border-light px-3 cw-close-lateral" cw-lateral-target="#RegistrarPersona"><i class="fa fa-times"></i>&nbsp;&nbsp;cancelar</a>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>