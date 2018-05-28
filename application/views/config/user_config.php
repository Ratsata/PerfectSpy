<div class="uk-offcanvas-content">
<div class="uk-grid-collapse uk-height-1-1" uk-grid>
    
    <!-- Content -->
    <div class="uk-width-expand" style="position: relative;">

        <!-- Header -->
        <div id="dashboard-header" class="tx-soft-background">
            <div class="uk-grid-collapse" uk-grid>
                <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-push">
                <span uk-icon="icon: menu; ratio: 1.3"></span><a class="uk-visible@l"> Menu</a></button>
                <div class="uk-width-expand uk-padding ">
                    <h1 class="uk-header uk-margin-remove uk-text-bold">Configuraci&oacute;n</h1>
                    
                </div>
                <div class="uk-align-right uk-margin-medium-right">
                    <nav class="uk-navbar-container" uk-navbar>
                        <div class="uk-navbar-left">
                            <ul class="uk-navbar-nav">
                                <li><a class="menu-navbar" href="<?=base_url('index.php/config/index')?>">General</a></li>
                                <li class="uk-active"><a class="menu-navbar" href="#">Usuario</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Body Content -->
        <div class="uk-padding">
            <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                <h2 class="uk-text-left">Usuario</h2>
                
                <div class="uk-text-right">
                    <button id="btnModificar" class="uk-button uk-button-primary uk-text-center"
                        onclick="activeInputs()"><span class="flaticon-edit">Modificar</button>
                </div>
                <center>
                <form id="frmUser" class="uk-width-2-3 uk-form-horizontal uk-margin-large uk-padding-large">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="nombre">Nombre</label>
                        <div class="uk-form-controls">
                            <input id="nombre" name="nombre" class="uk-input inputUser" type="text" placeholder="Ej.: Administrador" maxlength="20" required disabled value="<?=$config['nombre']?>">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="email">Email</label>
                        <div class="uk-form-controls">
                            <input id="email" name="email" class="uk-input inputUser" type="email" placeholder="Ej.: correo@correo.com" maxlength="50" required disabled value="<?=$config['email']?>">
                        </div>
                    </div>

                    <br>

                    <div class="uk-grid-collapse uk-child-width-expand@s uk-text-right" uk-grid>
                        <div>
                            <div><label class="uk-form-label" for="usuario">Usuario</label></div>
                        </div>
                        <div>
                            <div><input id="usuario" name="usuario" class="uk-input inputUser" type="text" placeholder="Ej.: Admin" maxlength="20" required disabled value="<?=$config['user']?>"></div>
                        </div>
                    </div>

                    <div class="uk-grid-collapse uk-child-width-expand@s uk-text-right" uk-grid>
                        <div>
                            <div><label class="uk-form-label" for="hash">Contraseña</label></div>
                        </div>
                        <div>
                            <div><input id="hash" name="hash" class="uk-input inputUser" type="password" placeholder="Ej.: ****" maxlength="20" required disabled value="123456789"></div>
                        </div>
                    </div>
                    <br>
                    <div class="uk-modal-footer uk-text-right uk-padding-remove">
                    <br>
                    <input type="submit" class="uk-button uk-button-success uk-text-center inputUser" value="Guardar" disabled>
                </div>
                </form>
                </center>
            </div>