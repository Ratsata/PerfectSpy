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

    var idSeteado = '<?= $id ?>';

</script>

</head>
<body>