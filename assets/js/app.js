$(document).ready(function () {
    cargaModulos();
    date_time('date_time');
    /* if(!idSeteado){
        UIkit.offcanvas("#offcanvas-push").show();
    } */

    $('#doorbell-modal').on('hidden.bs.modal', function (e) {
        $("#citofonoCamera1").removeAttr("hidden");
        $("#citofonoCamera1").removeClass("display");
        $("#citofonoCamera1").show();
    });

    $("#totemSelect").on('change', function(){
        var id = $(this).val();
        window.location.href = base_url +'index.php/'+id;
    });


    $('#led-icon-selector .tx-led-icon').click(function (e) {

        var wasActive = $(this).hasClass('active');
        $('#led-icon-selector .tx-led-icon').removeClass('active');

        // Just remove active if user clicked the same
        if (!wasActive) {
            $(this).addClass('active');
        }

        updateScreenMockup();
    });
    $('#screen-modal form input, #screen-modal form textarea').keyup(function () {
        updateScreenMockup();
    });
    $('#screen-modal form input[type="checkbox"], #screen-modal form input[type="number"]').change(function () {
        updateScreenMockup();
    });
    $('#screen-modal form input[type="number"]').click(function () {
        updateScreenMockup();
    });

    updateScreenMockup();

    $('#led-background-color').ColorPicker({
        color: '#000000',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('#led-background-color div').css('backgroundColor', '#' + hex);
            $('.led-new-visualization').css('backgroundColor', '#' + hex);
        }
    });
});


function nextDashboard(){
    var id = parseInt($("#totemSelect").val())+1;
    window.location.href = base_url +'index.php/'+id;
}

function previousDashboard(){
    var id = parseInt($("#totemSelect").val())-1;
    window.location.href = base_url +'index.php/'+id;
}

function updateLedScreen() {
    createImageFromDiv('#led-new-visualization');
    //createImageFromDiv
}

function createImageFromDiv(container) {
    html2canvas($(container)[0], {logging:false}).then(function(canvas){
        theCanvas = canvas;
        document.body.appendChild(canvas);
        // Convert to image
        $("#led-img-output").html(Canvas2Image.convertToJPEG(canvas));
        ledSettings.new = $("#led-img-output img").attr('src'); 
        document.body.removeChild(canvas);

        uploadLedImage(ledSettings.new, 'base64');
    });
}

function uploadLedImage(ledImage, format) {

    if (ledSettings.working) {
        return;
    }
    ledSettings.working = true;
    $.ajax({
        url: urlApi,
        data: {image: ledImage},
        dataType: 'json',
        method: 'post'
    }).done(function (result) {


        if (result.status) {

            // Update the current led image
            var d = new Date();
            var n = d.getTime();
            $('.tx-current-led-screen').attr('src', '/perfectspy/assets/img/led/current/current.jpg' + '?timestamp=' + n);

            UIkit.notification({
                message: 'Pantalla Led actualizada',
                status: 'success',
                pos: 'top-center'
            });

            setTimeout(function () {
                UIkit.modal('#screen-modal').hide();
            }, 1500)
        }
        else {

            UIkit.notification({
                message: 'Error al actualizar pantalla',
                status: 'danger',
                pos: 'top-center'
            });
        }

    }).fail(function () {

        UIkit.notification({
            message: 'Error de comunicación al actualizar pantalla',
            status: 'danger',
            pos: 'top-center'
        });

    }).always(function () {
        ledSettings.working = false;
    })

}

function updateScreenMockup() {

    // Check if an icon is selected
    var iconSelected = false;
    if ($('#led-icon-selector .tx-led-icon.active').length === 1) {
        var iconSrc = $('#led-icon-selector .tx-led-icon.active img').attr('src');
        $('#led-new-visualization-icon').html('<img src="' + iconSrc + '"/>').show();
        iconSelected = true;
    }
    else {
        $('#led-new-visualization-icon').html('').hide();
    }

    // Check if text is available
    var bold = $('#led-font-weight').is(':checked');
    var fontSize = $('#led-font-size').val().trim();
    var fontSpacing = $('#led-font-spacing').val().trim();
    //var ledText = $('#led-new-text').val().replace(/\n/g, "<br>").trim();
    var ledText = $('#led-new-text').val().replace(/\n/g, "<br>").replace(/  /g, "&nbsp;");
    console.log(ledText);
    $('#led-new-visualization-text span').html(ledText)
    $('#led-new-visualization-text').css('font-weight', bold ? 'bold' : 'normal')
        .css('height', ledSettings.height + 'px')
        .css('line-height',fontSpacing + 'px');
    $('#led-new-visualization-text span').css('font-size', fontSize ? fontSize + 'px' : '60px');
    $('#led-new-visualization-text span').css('line-height', fontSpacing ? fontSpacing + 'px' : '60px');

    $('#led-new-visualization-text').css('margin-top', "1px");
    $('#led-new-visualization-text').css('width', '100%');
    $('#led-new-visualization-icon').css('width', '100%');
    $('#led-new-visualization-icon').css('margin-top', "1px");
   /*  if (ledText.length > 0 && !iconSelected) {
        $('#led-new-visualization-icon').css('width', 0);
        $('#led-new-visualization-text').css('margin-top', "1px");
        $('#led-new-visualization-text').css('width', '100%');
    }
    else if (ledText.length > 0 && iconSelected) {
        $('#led-new-visualization-icon').css('width', "40%");
        $('#led-new-visualization-icon').css('margin-top', "25px");
        $('#led-new-visualization-icon').css('padding', "0px");
        $('#led-new-visualization-text').css('margin-top', "25px");
        $('#led-new-visualization-text').css('width', "50%");
    }
    else if (iconSelected && ledText.length === 0) {
        $('#led-new-visualization-icon').css('width', '100%');
        $('#led-new-visualization-icon').css('margin-top', "1px");
        $('#led-new-visualization-text').css('width', 0);
    } */

}

function focusCamera(ipCamara) {
    //window.location.href = "http://"+ipCamara;
    shell_exec("iexplore.exe "+ipCamara);
    /* if (cameraCode === 't1c1') {
        if ($('#camera-modal iframe').attr('src') == '') {
            $('#camera-modal iframe').attr('src', 'http://<?= TX_CAMERA_SERVER_IP ?>/cameracontrol.htm?cam-type=ptz&cam=' + cameraCode);
        }
        UIkit.modal('#camera-modal').show();
    }
    else if (cameraCode === 't1c2') {
        if ($('#camera-modal2 iframe').attr('src') == '') {
            $('#camera-modal2 iframe').attr('src', 'http://<?= TX_CAMERA_SERVER_IP ?>/cameracontrol.htm?cam-type=ptz&cam=' + cameraCode);
        }
        UIkit.modal('#camera-modal2').show();
    } */
}

function focusDoorbellCall(nombre="CIT&Oacute;FONO") {
    if ($('#doorbell-modal img').attr('src') == '') {
        $('#citofonoCamera1').hide();
        $('#doorbell-modal img').attr('src', $('#citofonoCamera1').attr('src'));
        $('#titleCitofono').empty();
        $('#titleCitofono').append(nombre);
    }
    UIkit.modal('#doorbell-modal').show();
}

function panelLateral(){
    $.ajax({
        url:   base_url+'index.php/seeker',
        type:  'POST',
        dateType:"json",
        success:  function (data){
            if (data){
                if (data == "[]"){
                    data = null;
                    $("#txtBusqueda").empty();
                    $("#txtBusqueda").append("&nbsp;");
                    if ($('#listaEstados').is(":hidden")) UIkit.toggle("#toggleLista").toggle();
                }else{

                $("#txtBusqueda").empty();
                $("#txtBusqueda").append("&nbsp;");

                $("#listaEstados").empty();
                if ($('#listaEstados').is(":hidden")) UIkit.toggle("#toggleLista").toggle();

                var json = eval('('+ data +')');
                var dotColorTotem = "";

                $.each(json, function(i, item){
                    if (item.onlineTotem==0) dotColorTotem = "dot-red";
                    if (item.onlineTotem==1) dotColorTotem = "dot-yellow";
                    if (item.onlineTotem==2) dotColorTotem = "dot-green";

                    if (item.onlineCamara=="none") dotColorCamara = "dot-gray";
                    if (item.onlineCamara=="nok") dotColorCamara = "dot-red";
                    if (item.onlineCamara=="ok") dotColorCamara = "dot-green";
                    
                    if (item.onlinePantalla=="none") dotColorPantalla = "dot-gray";
                    if (item.onlinePantalla=="nok") dotColorPantalla = "dot-red";
                    if (item.onlinePantalla=="ok") dotColorPantalla = "dot-green";

                    if (item.onlineCitofono=="none") dotColorCitofono = "dot-gray";
                    if (item.onlineCitofono=="nok") dotColorCitofono = "dot-red";
                    if (item.onlineCitofono=="ok") dotColorCitofono = "dot-green";
                    $("#listaEstados").append(
                        "<div class='uk-panel'>"+
                        "<button class='uk-button uk-button-default uk-button-small uk-align-left' type='button'>"+item.nombre+"</button>"+
                        "<div uk-dropdown>"+
                        "<div class='uk-panel'>"+
                        "<p class='uk-align-left estado'>Camara</p>"+
                        "<span class='uk-align-right dot "+dotColorCamara+"'></span>"+
                        "</div>"+
                        "<div class='uk-panel'>"+
                        "<p class='uk-align-left estado'>Pantalla</p>"+
                        "<span class='uk-align-right dot "+dotColorPantalla+"'></span>"+
                        "</div>"+
                        "<div class='uk-panel'>"+
                        "<p class='uk-align-left estado'>Citofono</p>"+
                        "<span class='uk-align-right dot "+dotColorCitofono+"'></span>"+
                        "</div>"+
                        "</div>"+
                        "<span class='uk-align-right dot "+dotColorTotem+"'></span>"+
                        "</div>"
                    );
                });}
                llenarModulos(json);
            }
        }
    });
}

function cargaModulos(){
    var spinner =   "<center>"+
                    "<span style='margin-top:100px' uk-spinner='ratio: 4.5'></span>"+
                    "</center>";
    $("#moduloCamara").append(spinner);
    $("#moduloPantalla").append(spinner);
    $("#moduloCitofono").append(spinner);
    panelLateral();
}

function llenarModulos(json){
    var id_select = $("#totemSelect").val();

    $("#moduloCamara").empty();
    $("#moduloPantalla").empty();
    $("#moduloCitofono").empty();
    $("#dashboard-status").empty();
    if(!json){
        $("#divTotem").attr("hidden",false);
        $("#divCamara").fadeOut();
        $("#divPantalla").fadeOut();
        $("#divCitofono").fadeOut();
    }
    $.each(json, function(i, item){
        if(id_select == item.id){
            nombreCitofono = "Citofono: "+$("#totemSelect option:selected").text();
            if (item.onlineCitofono=="ok"){
                $("#moduloCitofono").append("<img id='citofonoCamera1' style='-webkit-user-select: none;' src='http://"+item.ipCitofono+urlCitofono+"' class='uk-width-1-1 video-feed'>"+
                                "<div class='uk-margin-small-top'>"+
                                "<button class='uk-button uk-button-primary uk-button-large uk-width-1-1' onclick='focusDoorbellCall(\" "+nombreCitofono+" \");'>"+
                                "<i uk-icon='icon: phone'></i> Iniciar Videollamada"+
                                "</button>"+
                                "</div>");
            }else if(item.onlineCitofono=="nok"){
                $("#moduloCitofono").append("<center>"+
                    "<span style='margin-top:100px' uk-icon='icon: warning; ratio: 10'></span>"+
                    "<br><a>Error de Conexion</a>"+
                    "</center>");
            }else{
                $("#divCitofono").fadeOut();
            }
            if (item.onlinePantalla=="ok"){
                $("#moduloPantalla").append("<a href='#screen-modal' class='uk-button uk-button-primary uk-button-large uk-width-1-1' uk-toggle>"+
                                "<i class='flaticon-edit'></i>"+
                                "Editar Mensaje LED"+
                                "</a>"+
                                "<div class='uk-padding-small uk-margin-small-top' style='background-color: #444444;'>"+
                                "<center><img src='"+base_url+"assets/img/led/current/current.jpg' class='tx-current-led-screen'/></center>"+
                                "</div>");
            }else if(item.onlinePantalla=="nok"){
                $("#moduloPantalla").append("<center>"+
                    "<span style='margin-top:100px' uk-icon='icon: warning; ratio: 10'></span>"+
                    "<br><a>Error de Conexion</a>"+
                    "</center>");
            }else{
                $("#divPantalla").fadeOut();
            }
            if (item.onlineCamara=="ok"){
                $("#moduloCamara").append("<div class='vxgplayer' id='vxg_media_player1'></div>"+
                                "<div class='uk-margin-small-top'>"+
                                "<button class='uk-button' title='Enfocar cámara' uk-tooltip='delay: 1000;'"+
                                "onclick='focusCamera(\""+item.ipCamara+"\")'><i uk-icon='icon: expand'></i></button>"+
                                "</div>");
                inicializarCamara(item.ipCamara);
                /* width = $("#moduloCamara").width();
                vxgplayer("vxg_media_player1").size(width,300);
                vxgplayer("vxg_media_player1").src('rtsp://admin:cleanvoltage2018@192.168.1.108/cam/realmonitor?channel=1&subtype=0&unicast=true&proto=Onvif');
                vxgplayer("vxg_media_player1").play(); */
            }else if(item.onlineCamara=="nok"){
                $("#moduloCamara").append("<center>"+
                    "<span style='margin-top:100px' uk-icon='icon: warning; ratio: 10'></span>"+
                    "<br><a>Error de Conexion</a>"+
                    "</center>");
            }else{
                $("#divCamara").fadeOut();
            }
            if (item.onlineTotem==0) $("#dashboard-status").append(  "Error en la conexi&oacute;n");
            if (item.onlineTotem==1) $("#dashboard-status").append(  "Conexi&oacute;n establecida con algunos errores...");
            if (item.onlineTotem==2) $("#dashboard-status").append(  "Conexi&oacute;n establecida");
        }
    });
}

function date_time(id)
{
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
    h = date.getHours();
    if(h<10){
        h = "0"+h;
    }
    m = date.getMinutes();
    if(m<10){
        m = "0"+m;
    }
    s = date.getSeconds();
    if(s<10){
        s = "0"+s;
    }
    
    date = ''+days[day]+' '+d+' '+months[month]+' '+year;
    time = ''+h+':'+m+':'+s;
    $(".date").html(date);
    $(".time").html(time);
    setTimeout('date_time("date");','1000');
    return true;
}

function inicializarCamara(ip){
    vxgplayer("vxg_media_player1",{
        nmf_path: 'media_player.nmf',
        nmf_src: '/pnacl/Release/media_player.nmf',
        latency: 300000,
        aspect_ratio_mode: 2,
        autohide: 3,
        controls: false,
        connection_timeout: 5000,
        connection_udp: 0,
        custom_digital_zoom: false
    }).ready(function(){
        var width = $("#moduloCamara").width();
        vxgplayer("vxg_media_player1").size(parseInt(width),300);
        vxgplayer("vxg_media_player1").src('rtsp://'+PTZ_USER+":"+PTZ_PASS+"@"+ip+PTZ_URL);
        vxgplayer("vxg_media_player1").play();
    });
}
