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
    var urlCitofono = '<?= TX_URL_CITOFONO ?>';
    var PTZ_USER = '<?=PTZ_USER?>';
    var PTZ_PASS = '<?=PTZ_PASS?>';
    var PTZ_URL = '<?=PTZ_URL?>';

    var urlApi = '<?= base_url('index.php/api/screen_update') ?>';
    var TX_URL_CITOFONO = '<?= TX_URL_CITOFONO ?>';
    var base_url = '<?= base_url() ?>';

    var idSeteado = '<?= $id ?>';

</script>

</head>
<body>