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
                                <li class="uk-active"><a class="menu-navbar" href="#">General</a></li>
                                <li><a class="menu-navbar" href="<?=base_url('index.php/config/user')?>">Usuario</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Body Content -->
        <div class="uk-padding">
            <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                <h2 class="uk-text-left">Totems Registrados</h2>

                <!-- BOTON NUEVO -->
                <div class="uk-text-right">
                    <button class="uk-button uk-button-success uk-text-center"
                        onclick="focusnewTotem();"><span class="flaticon-wifi-signal-tower"> Nuevo Totem</button>
                </div>

                <table class="uk-table uk-table-hover uk-table-divider">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach ($config as $key =>$value) { ?>
                            <tr>
                                <td>#<?= $value->id ?></td>
                                <td><?= $value->nombre ?></td>
                                <td>
                                    <div class="uk-button-group">
                                        <button data-id="<?= $value->id ?>" class="uk-button uk-button-primary" onclick="focusupdateTotem(<?=$value->id?>)"><span class="flaticon-edit">Modificar</button>
                                        <button class="uk-button uk-button-danger" onclick="focusdeleteTotem(<?=$value->id?>,'<?=$value->nombre?>')"><span class="flaticon-erase-text">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>