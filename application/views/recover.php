</head>
<body class="login uk-height-1-1">
    <div class="uk-position-medium uk-position-top-center">
        <div class="uk-overlay uk-overlay-primary uk-animation-slide-bottom-medium">
            <div class="uk-panel uk-width-1-1">
                <h2>Recuperar contraseña</h2>
                <hr />
                <div id="recover-panel">
                    <p>Escriba el correo registrado: <br><b>xxmin@hotmail.com</b></p>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="nombre">Correo</label>
                        <div class="uk-form-controls">
                            <form id="recover">
                                <input name="nombre" class="uk-input" type="text" placeholder="Ej.: correo@correo.com" required maxlength="20">        
                                <input class="uk-width-1-1 uk-button uk-button-danger uk-button-large button-login" type="submit" value="Enviar..." name="submit"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>
</body>
</html>