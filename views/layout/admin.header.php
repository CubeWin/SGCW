<div class="adm-grid cw-backLogin3" id="adm-grid-all">
    <div class="adm-nav" style="background-image: url(<?php echo constant('URL') . '/public/assets/img/cub2.png'; ?>)">
        <div class="adm-title d-flex justify-content-around align-items-center">
            <h1 class="text-uppercase m-0">Administrador</h1>
            <label for="admCheck" class="menu-icon-container">
                <div class="menu-icon transformed" id="menu-icon-cw"></div>
            </label>
            <input type="checkbox" id="admCheck" autocomplete="off" class="d-none" onclick="checkAdmin()">

        </div>
        <nav class="adm-navbar">

            <div class="cw-categoria-navbar">
                <div class="cw-categoria-title">
                    Usuarios
                </div>
                <div class="cw-categoria-content">
                    <!--
                                SUBCATEGORIA
                            -->

                    <div class="cw-subcategoria">
                        <a href="<?php echo $this->url; ?>administrador/persona" class="cw-subcategoria-title">
                            <div class="cw-subcategoria-icon"><i class="fa fa-user"></i></div>
                            <div class="cw-subcategoria-text">Persona</div>
                        </a>
                    </div>
                    <div class="cw-subcategoria">
                        <a href="<?php echo $this->url; ?>administrador/usuario" class="cw-subcategoria-title">
                            <div class="cw-subcategoria-icon"><i class="fa fa-users"></i></div>
                            <div class="cw-subcategoria-text">Usuario</div>
                        </a>
                    </div>
                    <div class="cw-subcategoria">
                        <div class="cw-subcategoria-title">
                            <div class="cw-subcategoria-icon"><i class="fa fa-file"></i></div>
                            <div class="cw-subcategoria-text">Tercero</div>
                        </div>
                    </div>
                    <div class="cw-subcategoria">
                        <div class="cw-subcategoria-title">
                            <div class="cw-subcategoria-icon"><i class="fab fa-alipay"></i></div>
                            <div class="cw-subcategoria-text">Cuarto</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
                CATEGORIA
                    -->
            <div class="cw-categoria-navbar">
                <div class="cw-categoria-title">
                    PÁGINA
                </div>
                <div class="cw-categoria-content">

                    <div class="cw-subcategoria">
                        <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#inicioSeccion" aria-expanded="false" aria-controls="collapseExample">
                            <div class="cw-subcategoria-icon"><i class="fa fa-home"></i></div>
                            <div class="cw-subcategoria-text">Inicio
                            </div>
                            <div class="cw-icon-title">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="cw-subcategoria-content collapse" id="inicioSeccion">
                            <!--
                                        SUBCATEGORIA-ITEM
                                    -->
                            <div class="cw-item-rightbar">
                                <div class="cw-item-bar"></div>
                            </div>
                            <div class="cw-subcategoria">
                                <a href="<?php echo $this->url; ?>administrador/seccion/1" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Carrusel</div>
                                </a>
                                <a href="<?php echo $this->url; ?>administrador/seccion/2" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Servicios</div>
                                </a>
                                <a href="<?php echo $this->url; ?>administrador/seccion/3" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Presentación</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="cw-subcategoria">
                        <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#nosotrosSeccion" aria-expanded="false" aria-controls="collapseExample">
                            <div class="cw-subcategoria-icon"><i class="fa fa-address-card"></i></div>
                            <div class="cw-subcategoria-text">Nosotros
                            </div>
                            <div class="cw-icon-title">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="cw-subcategoria-content collapse" id="nosotrosSeccion">
                            <div class="cw-item-rightbar">
                                <div class="cw-item-bar"></div>
                            </div>
                            <div class="cw-subcategoria">
                                <a href="<?php echo $this->url; ?>administrador/seccion/4" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Carrusel</div>
                                </a>
                                <a href="<?php echo $this->url; ?>administrador/seccion/5" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Servicios</div>
                                </a>
                                <a href="<?php echo $this->url; ?>administrador/seccion/6" class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Presentación</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
                        CATEGORIA
                    -->
            <div class="cw-categoria-navbar">
                <div class="cw-categoria-title">
                    MENU 1
                </div>
                <div class="cw-categoria-content">

                    <div class="cw-subcategoria">
                        <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <div class="cw-subcategoria-icon"><i class="fab fa-twitter"></i></div>
                            <div class="cw-subcategoria-text">Navegación
                            </div>
                            <div class="cw-icon-title">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="cw-subcategoria-content collapse" id="collapseExample">
                            <!--
                                        SUBCATEGORIA-ITEM
                                    -->
                            <div class="cw-item-rightbar">
                                <div class="cw-item-bar"></div>
                            </div>
                            <div class="cw-subcategoria">
                                <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#collapseInicio" aria-expanded="false" aria-controls="collapseInicio">
                                    <div class="cw-subcategoria-text">Inicio</div>
                                    <div class="cw-icon-title">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="cw-subcategoria-content collapse" id="collapseInicio">
                                    <!-- REPETIR -->
                                    <div class="cw-item-rightbar">
                                        <div class="cw-item-bar"></div>
                                    </div>
                                    <div class="cw-subcategoria">
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">title</div>
                                        </div>
                                        <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                                            <div class="cw-subcategoria-text">content</div>
                                            <div class="cw-icon-title">
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="cw-subcategoria-content collapse" id="collapseContent">
                                            <!-- REPETIR -->
                                            <div class="cw-item-rightbar">
                                                <div class="cw-item-bar"></div>
                                            </div>
                                            <div class="cw-subcategoria">
                                                <div class="cw-subcategoria-title">
                                                    <div class="cw-subcategoria-text">Tipo</div>
                                                </div>
                                                <div class="cw-subcategoria-title">
                                                    <div class="cw-subcategoria-text">Atributo lorem sdgf</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">content 2</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Secundario</div>
                                </div>
                                <div class="cw-subcategoria-title">
                                    <div class="cw-subcategoria-text">Contacto</div>
                                </div>
                                <div class="cw-subcategoria-title collapsed" data-toggle="collapse" data-target="#collapseOtros" aria-expanded="false" aria-controls="collapseOtros">
                                    <div class="cw-subcategoria-text">Otros
                                    </div>
                                    <div class="cw-icon-title">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="cw-subcategoria-content collapse" id="collapseOtros">
                                    <div class="cw-item-rightbar">
                                        <div class="cw-item-bar"></div>
                                    </div>
                                    <div class="cw-subcategoria">
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">Parte 1
                                            </div>
                                        </div>
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">Parte 2
                                            </div>
                                        </div>
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">Parte 3
                                            </div>
                                        </div>
                                        <div class="cw-subcategoria-title">
                                            <div class="cw-subcategoria-text">Parte 4
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </div>
    <div class="adm-header cyan darken-4">
        <div class="container-fluid h-100">
            <div class="row h-100" style="position: relative">
                <div class="col-8 col-md-8 col-lg-5 col-xl-5 d-flex justify-content-start align-items-center h-100">


                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="No funciono XD" class="btn btn-outline-light btn-sm font-weight-bold"><i class="fa fa-upload"></i>&nbsp;<span class="d-none d-md-block">Publicar Cambios</span></a>
                </div>
                <div class="col-lg-5 col-xl-6 d-none d-lg-flex justify-content-end align-items-center h-100">
                    <span class="text-white text-uppercase font-weight-bold"><?php echo $_COOKIE["user"]; ?></span>
                </div>
                <div class="col-4 col-lg-2 col-xl-1 d-flex justify-content-end align-items-center h-100">
                    <div class="btn-group dropleft" role="group">
                        <button id="btnGroupDrop1" type="button" class="bg-transparent dropdown-toggle text-white border-white border rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <!-- <button class="dropdown-item" data-toggle="modal" data-target="#cambiarClave"><i class="fa fa-key text-info"></i>&nbsp;Cambiar clave</button> -->
                            <a href="../" class="dropdown-item"><i class="fa fa-power-off text-danger"></i>&nbsp;Salir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="adm-body grey lighten-3 cw-shadow-inset overflow-auto">
        <div class="p-1 p-sm-3 p-md-4 p-lg-5 position-relative" style="min-height: calc(100vh - 60px)">