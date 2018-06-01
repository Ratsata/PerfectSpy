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

<div id="screen-modal" class="uk-modal-container" uk-modal="bg-close: false">
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
                        <!-- <div class="picker-wrapper uk-padding-small uk-width-1-2">
                            <button type="button" class="btn btn-default">Color fondo</button>
                            <div class="color-picker">
                            </div>
                        </div> -->
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
        <div id="led-img-output" style="height=268;width:428" class="uk-hidden"></div>

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close">Cancelar</button>
            <button class="uk-button uk-button-primary"
                    onclick="updateLedScreen();">Actualizar Pantalla
            </button>
        </p>
    </div>
</div>

<div id="doorbell-modal" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom">
            <i class="flaticon-megaphone"></i> <a id="titleCitofono">CIT&Oacute;FONO</a>
        </h1>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <img id="citofonoCamera2" style="-webkit-user-select: none;" src="" class="uk-width-1-1 video-feed">

        <div id="tx-webphone-controls" class="uk-text-center">
        <div id="c2k_container_0" title="" style="text-align: center; display: none !important;"></div>
            <button id="tx-webphone-call" class="uk-button uk-button-large uk-button-primary tx-webphone" onclick="forceCall();">Llamar
            </button>
            <button id="tx-webphone-hangup" class="uk-button uk-button-large uk-button-danger tx-webphone"
                    onclick="forceHangout();"
                    style="display: none;">Colgar
            </button>
        </div>
        <div id="tx-webphone-connecting" class="uk-text-center tx-webphone" style="display: none;">
            <button class="uk-button uk-button-large tx-webphone-connecting" disabled="disabled">
                Conectando llamada...
            </button>
        </div>
    </div>
</div>