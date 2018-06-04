<!-- Menu -->
<div class="uk-offcanvas-content">
<div class="uk-grid-collapse uk-height-1-1" uk-grid>
    
    <!-- Content -->
    <div class="uk-width-expand" style="position: relative;">
    
        <!-- Header -->
        <div id="dashboard-header" class="tx-soft-background">
            <div class="uk-grid-collapse" uk-grid>
            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-push">
            <span uk-icon="icon: menu; ratio: 1.3"></span><a class="uk-visible@l"> Menu</a></button>
                <div class="uk-width-expand uk-padding-small ">
                    <img src="<?= base_url('assets/img/icons/chevron-left.png') ?>" class="uk-visible@m posMiddle" onclick="previousDashboard()"/|>
                    <div class="uk-display-inline-block uk-padding-small uk-padding-remove-bottom uk-padding-remove-top posMiddle">
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
                        </div>
                    </div>
                    <div class="uk-align-center uk-visible@m">
                        <span class="date posMiddle"></span>
                        <h3><span class="time posMiddle"></span></h3>
                    </div>
                    <div class="uk-width-auto@m uk-width-1-4 uk-text-right uk-padding-small   uk-visible@m">
                        <img src="<?= base_url('assets/img/icons/chevron-right.png') ?>" class="posMiddle" onclick="nextDashboard()"/|>
                    </div>
                </div>
            </div>
        
        <!-- Body Content -->
        <div class="uk-padding">

            <!-- DIV AGREGAR-TOTEM -->
            <div id="divTotem" class="uk-width-1-1 uk-padding-small" hidden>
                <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                    <div class="uk-align-center uk-text-center">
                        <h1> Ingrese un totem en la pantalla de Configuraci&oacute;n</h1>
                        <br>
                        <a href="<?=base_url('index.php/config')?>" uk-icon="icon: plus-circle; ratio: 5"></a>
                        <div class="uk-text-small uk-text-muted">
                            Agregar Totem
                        </div>
                    </div>
                </div>
            </div>

            <!-- DIV CAMARA -->
            <div class="uk-grid-collapse uk-child-width-expand@s" uk-grid>
                <div  id="divCamara" class="uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <h3 class="uk-margin-remove-bottom"><i class="flaticon-cctv"></i> PTZ 1</h3>
                        <div id="moduloCamara" class="uk-align-center">    
                        </div>
                    </div>
                </div>

                <!-- DIV PANTALLA -->
                <div id="divPantalla" class="uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand@m">
                                <h3 class="uk-margin-remove-bottom">
                                    <i class="flaticon-television"></i> PANTALLA LED
                                </h3>
                                <div id="moduloPantalla" class="uk-align-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DIV CITOFONO -->
                <div id="divCitofono" class="uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l uk-padding-small">
                    <div class="uk-card uk-card-default uk-card-body uk-animation-slide-bottom-medium">
                        <h3 class="uk-margin-remove-bottom"><i class="flaticon-megaphone"></i> CITOFONO</h3>
                        <div id="moduloCitofono" class="uk-align-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>