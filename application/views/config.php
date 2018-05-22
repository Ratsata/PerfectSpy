<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PerfectSpy</title>
    <meta name="description" content="Plataforma PerfectSpy">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>var BASE_URL = '<?= base_url(); ?>';</script>
    <link rel="apple-touch-icon" href="icon.png">
    
    <?= link_tag('assets/css/colorpicker.css') ?>
    <?= link_tag('assets/css/uikit.css') ?>
    <?= link_tag('assets/fonts/flaticon.css') ?>
    <?= link_tag('assets/css/uikit.css') ?>
    <?= link_tag('assets/css/click2call.css') ?>
    <?= link_tag('assets/css/app.css') ?>
    <?= link_tag('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css') ?>

    <script>
        var webphoneStarted = false;

        var audio_context;
        var recorder;

        var dashboardStatus = 0;
        var raspberryIp = '<?= TX_SENSORS_SERVER_IP ?>:<?= TX_SENSORS_WEB_PORT ?>';
        var gpioControls = {
            lights: {status: 0, working: false, gpios: [26, 19, 13, 6]},
            ledStrips: {status: 0, working: false, gpios: [4]},
            speakerControls: {
                status: 0, gpios: [11]
            }
        };


        var sensorsData = {
            external_temperature: {container: '#tx-external_temperature', value: 16, unit: '°C'},
            internal_temperature: {container: '#tx-internal_temperature', value: 16, unit: '°C'},
            humidity: {container: '#tx-humidity', value: 75, unit: '%'},
            battery: {container: '#tx-battery', value: 100, unit: 'kn'}
        };

       var urlApi = '<?= base_url('index.php/api/screen_update') ?>';

    </script>
</head>
<body>
<div class="uk-grid-collapse uk-height-1-1" uk-grid>

    <!-- Menu -->
    <div id="main-menu" class="uk-width-auto@s uk-visible@s uk-height-1-1 uk-light">
        <div class="uk-padding uk-padding-small-top">
            <img src="<?= base_url('assets/img/logo.png') ?>"/>
            <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav>
                <li><a href="<?= base_url('index.php')?>"><i class=" flaticon-dashboard"></i> Dashboard</a></li>
                <li class="uk-active"><a href="<?= base_url('index.php/config')?>"><i class=" flaticon-controls"></i> Configuraci&oacute;n</a></li>
                <li><a href="#"><i class=" flaticon-logout"></i> Salir</a></li>
                
                <div style="margin-top: 100%">
                    <li>
                        <a id="toggleLista" class="uk-text-lead" uk-toggle="target: .listaEstados; animation: uk-animation-fade">Estado</a>
                        <div  id="txtBusqueda" class="uk-panel typewriter">
                            <a class="uk-animation-fade ">Buscando totems online</a>
                            <p class="uk-align-right">...</p>
                        </div>
                    </li> 
                    <div id="listaEstados" hidden class="uk-overlay uk-overlay-primary uk-animation-slide-bottom-medium listaEstados">
                        <div class="uk-panel">
                            <p class="uk-align-left estado">- - -</p>
                            <span class="dot uk-align-right"></span>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>

    <!-- Content -->
    <div class="uk-width-expand" style="position: relative;">

        <!-- Header -->
        <div id="dashboard-header" class="tx-soft-background">
            <div class="uk-grid-collapse" uk-grid>
                <h1 class="uk-header uk-margin-remove uk-text-bold">Configuraci&oacute;n</h1>
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
        </div>

        <div id="modalUpdate"></div>
    
        <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/uikit.js') ?>"></script>
        <script src="<?= base_url('assets/js/uikit-icons.js') ?>"></script>

        <!--
        <script src="<?= base_url('assets/js/inputmask/jquery.inputmask.bundle.js') ?>"></script>
        <script src="<?= base_url('assets/js/inputmask/inputmask/phone-codes/phone.js') ?>"></script>
        <script src="<?= base_url('assets/js/inputmask/inputmask/phone-codes/phone-be.js') ?>"></script>
        <script src="<?= base_url('assets/js/inputmask/inputmask/phone-codes/phone-ru.js') ?>"></script>
        -->
        <script src="<?= base_url('assets/js/config.js') ?>"></script>
        
    </div>
</div>
</body>
</html>
