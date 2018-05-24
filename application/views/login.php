</head>
<body class="login uk-height-1-1">
    <div class="uk-position-medium uk-position-top-center">
        <div class="uk-overlay uk-overlay-primary uk-animation-slide-bottom-medium">
            <div class="uk-panel">
                <img src="<?= base_url('assets/img/logo.png') ?>"/>
                <hr><br>
                <?php echo form_open('index.php/auth/login', 'class="uk-panel uk-panel-box uk-form"');  ?>
                    <div class="uk-form-row">
                        <input id="name" name="username" class="uk-width-1-1 uk-form-large" type="text" placeholder="Usuario">
                    </div>
                    <div class="uk-form-row">
                        <input id="password" name="password" class="uk-width-1-1 uk-form-large" type="password" placeholder="Contraseña">
                    </div>
                    <div class="uk-form-row uk-padding-small uk-padding-remove-horizontal">
                        <input class="uk-width-1-1 uk-button uk-button-danger uk-button-large button-login" type="submit" value="Login" name="submit"/><br />
                    </div>
                    <div class="uk-form-row uk-text-small">
                        <label class="uk-float-left"><input id="remember" name="remember" type="checkbox"> Recordar</label>
                        <a class="uk-float-right uk-link uk-link-muted" href="#"> Recuperar contraseña</a>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>