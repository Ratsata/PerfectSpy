<div id="offcanvas-push" uk-offcanvas="mode: push;overlay: true;">
    <div id="main-menu" class="uk-offcanvas-bar uk-padding-remove-horizontal">
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <div class="uk-padding uk-padding-small-top">
            <img src="<?= base_url('assets/img/logo.png') ?>"/>
            <ul class="uk-nav-primary uk-nav-parent-icon uk-margin-large uk-margin-remove-horizontal uk-margin-remove-top" uk-nav>
                <li <?php if($activoIndex == 1){?> class="uk-active" <?php } ?> ><a href="<?= base_url('index.php')?>"><i class=" flaticon-dashboard"></i> Dashboard</a></li>
                <li <?php if($activoIndex == 2){?> class="uk-active" <?php } ?> ><a href="<?= base_url('index.php/config')?>"><i class=" flaticon-controls"></i> Configuraci&oacute;n</a></li>
                <li <?php if($activoIndex == 3){?> class="uk-active" <?php } ?> ><a href="#"><i class=" flaticon-logout"></i> Salir</a></li>
                
            </ul>
            <hr class="uk-divider-icon">
            <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav>
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
            </ul>
        </div>
    </div>
</div>