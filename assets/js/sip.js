webphone_api.onLoaded(function () {
    webphone_api.onCallStateChange(function (event, direction, peername, peerdisplayname, line){
        if (event === 'callSetup' && direction == '2'){
            answerCall(peername,peerdisplayname);
        }
        if (event === 'callSetup' && direction == '1'){
            $('.tx-webphone').hide();
            $('#tx-webphone-connecting').show();
        }
        if (event === 'callDisconnected' && direction == '1'){
            forceHangout();
        }
        if (event === 'callConnected'){
            $('.tx-webphone').hide();
            $('#tx-webphone-hangup').show();
        }
    });
});

function answerCall() {
    var nombre = "";
    var numero ="";
    UIkit.modal.confirm('<span uk-icon=\'icon: bell\'></span> Llamada del dispositivo: '+nombre+' del numero '+numero+'',
        { labels: {
            cancel: 'Cancelar',
            ok: 'Contestar'}
        }).then(function () {
            $('.tx-webphone').hide();
            $('#tx-webphone-connecting').show();
            /* webphone_api.reject();
            setTimeout(function () {
                webphone_api.call(webphone_api.parameters.callto);
            }, 1000) */
            webphone_api.accept();
            $('#tx-webphone-connecting').hide();
            $('#tx-webphone-hangup').show();
            focusDoorbellCall(nombre);
            
        }, function () {}
    );
}

function forceCall() {
    webphone_api.reject();
    $('.tx-webphone-hangup').show();
    setTimeout(function () {
        webphone_api.call(webphone_api.parameters.callto);
    }, 1000)
}

function forceHangout() {
    webphone_api.hangup();
    $('.tx-webphone').hide();
    $('#tx-webphone-call').show();
    UIkit.modal('#doorbell-modal').hide();
    UIkit.notification({message: '<span uk-icon=\'icon: close\'></span> Llamada finalizada', status: 'danger'});
}

function webphonePrime() {
    console.log('tx: Priming webphone');
    webphone_api.call(webphone_api.parameters.callto);
}