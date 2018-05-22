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
        var ledSettings = <?= json_encode($led); ?>;
        var raspberryIp = '<?= TX_SENSORS_SERVER_IP ?>:<?= TX_SENSORS_WEB_PORT ?>';
        var gpioControls = {
            lights: {status: 0, working: false, gpios: [26, 19, 13, 6]},
            ledStrips: {status: 0, working: false, gpios: [4]},
            speakerControls: {
                status: 0, gpios: [11]
            }
        };
        var ipCitofono = '<?= TX_URL_CITOFONO ?>';


        var sensorsData = {
            external_temperature: {container: '#tx-external_temperature', value: 16, unit: '°C'},
            internal_temperature: {container: '#tx-internal_temperature', value: 16, unit: '°C'},
            humidity: {container: '#tx-humidity', value: 75, unit: '%'},
            battery: {container: '#tx-battery', value: 100, unit: 'kn'}
        };

       var urlApi = '<?= base_url('index.php/api/screen_update') ?>';
       var TX_URL_CITOFONO = '<?= TX_URL_CITOFONO ?>';
       var base_url = '<?= base_url() ?>';

    </script>
</head>
<body>
<!-- Menu -->
<div class="uk-offcanvas-content">
<div class="uk-grid-collapse uk-height-1-1" uk-grid>

        
    
    <!-- Content -->
    <div class="uk-width-expand" style="position: relative;">
    
        <!-- Header -->
        <div id="dashboard-header" class="tx-soft-background">
            <div class="uk-grid-collapse" uk-grid>
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-push">
            <span uk-icon="icon: menu; ratio: 1.3"></span>Menu</button>
                <div class="uk-width-expand uk-padding-small">
                    <img src="<?= base_url('assets/img/icons/chevron-left.png') ?>" style="vertical-align: middle; cursor: pointer;" onclick="previousDashboard()"/>
                    <div class="uk-display-inline-block uk-padding-small uk-padding-remove-bottom uk-padding-remove-top" style="vertical-align: middle;">
                        <div class="uk-text-small">Perfect Spy &raquo;</div>
                            <div uk-form-custom="target: > * > span:first-child">
                                <select id="totemSelect">
                                    <?php foreach ($json as $key) { ?>
                                        <?php if ($key['id'] == $id) { ?>
                                            <option value="<?=$key['id']?>" selected><?=$key['nombre']?></option>
                                        <?php }else{ ?>
                                            <option value="<?=$key['id']?>"><?=$key['nombre']?></option>
                                        <?php }?>
                                    <?php } ?>
                                </select>
                                <h1>
                                    <span></span>
                                    <span class="uk-link">
                                    <span uk-icon="icon: pencil;ratio: 1.5"></span>
                                    </span>
                                </h1>
                            </div>
                            <div id="dashboard-status" class="uk-text-small uk-text-muted" uk-tooltip>
                                <span class="flaticon-circular-shape-silhouette uk-text-muted"></span>
                                Estableciendo conexión...
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-auto@m uk-width-1-4 uk-text-right uk-padding-small">
                        <img src="<?= base_url('assets/img/icons/chevron-right.png') ?>" style="vertical-align: middle; cursor: pointer;" onclick="nextDashboard()"/>
                    </div>
                </div>
            </div>
        
        <!-- Body Content -->
        <div class="uk-padding">

            <div id="divCamara" class="uk-grid-small" uk-grid>
                <div class="uk-width-expand uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <h2 class="uk-margin-remove-bottom"><i class="flaticon-cctv"></i> PTZ 1</h2>
                        <!-- <iframe src="http://<?= TX_CAMERA_SERVER_IP ?>/cell1.htm?cam=t1c1" class="uk-width-1-1 video-feed"></iframe>
                        <div class="uk-margin-small-top">
                            <button class="uk-button" title="Enfocar cámara" uk-tooltip="delay: 1000;"
                                onclick="focusCamera('t1c1')"><i uk-icon="icon: expand"></i></button>
                        </div> -->
                        <div id="moduloCamara" class="uk-align-center">
                            
                        </div>
                    </div>
                </div>

                <!-- DIV PANTALLA -->
                <div id="divPantalla" class="uk-width-expand uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand@m">
                                <h2 class="uk-margin-remove-bottom">
                                    <i class="flaticon-television"></i> PANTALLA LED
                                </h2>

                                <!-- <a href="#screen-modal" class="uk-button uk-button-primary uk-button-large uk-width-1-1"
                                    uk-toggle>
                                    <i class="flaticon-edit"></i>
                                    Editar Mensaje LED
                                </a>
                                <div class="uk-padding-small uk-margin-small-top" style="background-color: #444444;">
                                    <center>
                                        <img src="<?= base_url('assets/img/led/current/current.jpg') ?>" class="uk-width-3-4 tx-current-led-screen"/>
                                    </center>
                                </div> -->
                                <div id="moduloPantalla" class="uk-align-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- DIV CITOFONO --><
                <div id="divCitofono" class="uk-width-1-4 uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <h2 class="uk-margin-remove-bottom"><i class="flaticon-megaphone"></i> CITOFONO</h2>
                        <!-- <img id="citofonoCamera1" style="-webkit-user-select: none;" src="<?= TX_URL_CITOFONO ?>" class="uk-width-1-1 video-feed">
                        <div class="uk-margin-small-top">
                            <button class="uk-button uk-button-primary uk-button-large uk-width-1-1"
                                        onclick="focusDoorbellCall('t1p1', false);">
                                <i uk-icon="icon: phone"></i> Iniciar Videollamada
                            </button>
                        </div> -->
                        <div id="moduloCitofono" class="uk-align-center">
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>

    <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
        <div style="padding:0" class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <div class="uk-padding uk-padding-small-top">
                <img src="<?= base_url('assets/img/logo.png') ?>"/>
                <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav>
                    <li class="uk-active"><a href="<?= base_url('index.php')?>"><i class=" flaticon-dashboard"></i> Dashboard</a></li>
                    <li><a href="<?= base_url('index.php/config')?>"><i class=" flaticon-controls"></i> Configuraci&oacute;n</a></li>
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
    </div>
</div>
</div>

<div id="camera-modal" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom"><i class="flaticon-cctv"></i> TORRE 1 C&Aacute;MARA
            2
        </h1>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <iframe src=""
                class="uk-width-1-1 video-feed" style="min-height: 100vh; height: 100vh;"></iframe>

    </div>
</div>
<div id="camera-modal2" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom"><i class="flaticon-cctv"></i> TORRE 1 C&Aacute;MARA
            2
        </h1>
        <div class="uk-text-center uk-margin-bottom">
            <button class="uk-button uk-button-primary tx-loudspeaker-say raspberry-action" disabled="disabled"
                    onclick="txLoudspeakerSay()">HABLAR
            </button>
            <button class="uk-button uk-button-secondary toggle-lights-button raspberry-action"
                    onclick="toggleLights()">
                ENCENDER LUCES
            </button>
        </div>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>


        <iframe src=""
                class="uk-width-1-1 video-feed" style="min-height: 100vh; height: 100vh;"></iframe>

    </div>
</div>

<div id="screen-modal" uk-modal="bg-close: false">
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">ACTUALIZAR PANTALLA</h2>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <div class="uk-grid-collapse" uk-grid style="background-color: #444;">
            <div class="uk-width-1-2 uk-text-center uk-padding-small">
                <div class="uk-light uk-text-left">VISUALIZACION ACTUAL</div>
                <img src="<?= base_url($led['current']) ?>" class="tx-current-led-screen"/>
            </div>
            <div class="uk-width-1-2 uk-text-center uk-padding-small" style="background-color: #555;">
                <div class="uk-light uk-text-left">NUEVA VISUALIZACION</div>
                <div id="led-new-visualization"
                     style="height: <?= $led['height'] ?>px; width: <?= $led['width'] ?>px; background-color: #000;">
                    <div id="led-new-visualization-icon"></div>
                    <div id="led-new-visualization-text"><span></span></div>
                </div>
            </div>
        </div>

        <form class="uk-form uk-margin-top">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-1-2">
                    <label for="led-new-text">Texto</label>
                    <textarea id="led-new-text" class="uk-textarea uk-margin-small-bottom" placeholder="Nuevo Texto">MENSAJE DE PRUEBA</textarea>

                    <label for="led-font-weight"><input id="led-font-weight" class="uk-checkbox" type="checkbox"
                                                        checked="checked"/>
                        Negrita</label>
                    <label for="led-font-size"><input id="led-font-size" class="uk-input uk-form-small" type="number"
                                                      value="16" style="max-width: 64px;" min="11" max="99"/>
                        Tamaño</label>
                    <br>
                    <div style="margin-bottom: 3px;">
                        <span id="led-font-color" class="uk-padding-small uk-display-inline-block"
                              style="padding: 4px; vertical-align: middle; border: 1px solid #ccc;">
                            <div style="background-color: #ffffff; width:24px; height: 24px;"></div>
                        </span> Color de fuente
                    </div>
                    <div style="margin-bottom: 3px;">
                        <span id="led-background-color" class="uk-padding-small uk-display-inline-block"
                              style="padding: 4px; vertical-align: middle; border: 1px solid #ccc;">
                            <div style="background-color: #000000; width: 24px; height: 24px;"></div>
                        </span> Color de fondo
                    </div>

                </div>
                <div class="uk-width-1-2">

                    <label for="led-icon-selector">&Iacute;cono</label>
                    <div id="led-icon-selector">
                        <?php foreach ($led['icons'] as $icon): ?>

                            <div class="tx-led-icon uk-text-center">
                                <img src="<?= base_url($led['path'] . '/' . $icon) ?>"/>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </form>
        <div id="led-img-output" class="uk-hidden"></div>

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button"
                    onclick="updateLedScreen();">Actualizar Pantalla
            </button>
        </p>
    </div>
</div>

<div id="doorbell-modal" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom"><i class="flaticon-megaphone"></i> CIT&Oacute;FONO
            T1P1
        </h1>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <img id="citofonoCamera2" style="-webkit-user-select: none;" src="" class="uk-width-1-1 video-feed">

        <div id="tx-webphone-controls" class="uk-text-center">
        <div id="c2k_container_0" title="" style="text-align: center;"></div>
            <button class="uk-button uk-button-large uk-button-primary tx-webphone-call" onclick="forceCall();"
                    disabled="disabled">Llamar
            </button>
            <button class="uk-button uk-button-large uk-button-secondary tx-webphone-answer" onclick="answerCall();"
                    style="display: none">
                Contestar
            </button>
            <button class="uk-button uk-button-large uk-button-danger tx-webphone-hangup"
                    onclick="webphone_api.hangup();"
                    style="display: none;">Colgar
            </button>
        </div>
        <div id="tx-webphone-connecting" class="uk-text-center" style="display: none;">
            <button class="uk-button uk-button-large tx-webphone-connecting" disabled="disabled">
                Conectando llamada...
            </button>
        </div>
        <div id="c2k_container_0" title="" style="text-align: center; display: none !important;">
            <!--rewrite the CALLTO and uncomment the following line to enable support for ancient browsers-->
            <!--<a href="tel://CALLTO" id="c2k_alternative_url">CALLTO</a>-->
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/uikit.js') ?>"></script>
<script src="<?= base_url('assets/js/uikit-icons.js') ?>"></script>
<script src="<?= base_url('assets/js/colorpicker.js') ?>"></script>
<script src="<?= base_url('assets/js/html2canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/canvas2image.js') ?>"></script>
<script src="<?= base_url('assets/js/recordmp3.js') ?>"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script src="<?= base_url('assets/webphone/webphone_api.js?jscodeversion=1') ?>"></script>
<script src="<?= base_url('assets/webphone/js/click2call/click2call.js?jscodeversion=1') ?>"></script>
        
   

</body>
</html>