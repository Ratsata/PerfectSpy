<div id="totem-new-modal" class="uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h1 class="uk-modal-title uk-text-center uk-margin-remove-bottom"><i class="flaticon-megaphone"></i> Nuevo Totem
            </h1>
        </div>

        <div class="uk-modal-body">
            <form id="frmNew" class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="nombre">Nombre</label>
                    <div class="uk-form-controls">
                        <input name="nombre" class="uk-input" type="text" placeholder="Ej.: Totem 1" required maxlength="20">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Dispotivos</label>
                    <div class="uk-form-controls">&nbsp;</div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .ip-camera; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-cctv"> Camara
                    </button>
                    <div class="uk-form-controls">
                        <label class="ip-camera">&nbsp;</label>
                        <input hidden name="ip-camara" class="uk-input ip-camera ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0" maxlength="14">
                    </div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .ip-pantalla; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-television"> Pantalla
                    </button>
                    <div class="uk-form-controls">
                        <label class="ip-pantalla">&nbsp;</label>
                        <input hidden name="ip-pantalla" class="uk-input ip-pantalla ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0" maxlength="14">
                    </div>
                </div>
                <div class="uk-margin">
                    <button style="color: black;" class="uk-form-label uk-button-primary" type="button" uk-toggle="target: .ip-citofono; animation: uk-animation-slide-left, uk-animation-slide-bottom">
                        <span class="flaticon-megaphone"> Citofono
                    </button>
                    <div class="uk-form-controls">
                        <label class="ip-citofono">&nbsp;</label>
                        <input hidden name="ip-citofono" class="uk-input ip-citofono ip_address" type="text" data-inputmask="'mask': '999.999.999.999'" placeholder="Ej.: 0.0.0.0" maxlength="14">
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <input type="submit" class="uk-button uk-button-success uk-text-center" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>