<div id="totem-update-modal" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom"><i class="flaticon-megaphone"></i> Modificar Totem
            </h1>
        </div>
        <div class="uk-modal-body">
            <form id="frmUpdate" data-id="" class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="nombre">Nombre</label>
                    <div class="uk-form-controls">
                        <input id="nombre" name="nombre" class="uk-input" type="text" placeholder="Ej.: Totem 1" maxlength="20" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Dispotivos</label>
                    <div class="uk-form-controls">&nbsp;</div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" id="toggleCamara" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .Uip-camera; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-cctv"> Camara
                    </button>
                    <div class="uk-form-controls">
                        <label class="Uip-camera">&nbsp;</label>
                        <input hidden id="Uip-camara" name="Uip-camara" class="uk-input Uip-camera ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0"  maxlength="14">
                    </div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" id="togglePantalla" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .Uip-pantalla; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-television"> Pantalla
                    </button>
                    <div class="uk-form-controls">
                        <label class="Uip-pantalla">&nbsp;</label>
                        <input hidden id="Uip-pantalla" name="Uip-pantalla" class="uk-input Uip-pantalla ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0"  maxlength="14">
                    </div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" id="toggleCitofono" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .Uip-citofono; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-megaphone"> Citofono
                    </button>
                    <div class="uk-form-controls">
                        <label class="Uip-citofono">&nbsp;</label>
                        <input hidden id="Uip-citofono" name="Uip-citofono" class="uk-input Uip-citofono ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0"  maxlength="14">
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <input type="submit" class="uk-button uk-button-success uk-text-center" value="Guardar">
                </div>
            </form>
        </div>
        
    </div>
</div>