$(document).ready(function () {

    panelLateral();
    
    $('#frmNew').on( "submit", function( e ) {
        e.preventDefault();
        var form_data = $(this).find(":input:not(:hidden)").serialize();
        $.ajax({
            data:  form_data,
            url:   'config/nuevo',
            type:  'POST',
            dateType:"json",
            beforeSend: function () {
                //$("#resultado").html("Procesando, espere por favor...");
            },success:  function (data){
                var json = eval('('+ data +')');
                $("#tbody").empty();

                $.each(json, function(i, item){
                    $("#tbody").append($(
                        "<tr>" +
                        "<td>#"+ item.id +"</td>" +
                        "<td>"+ item.nombre +"</td>" +
                        "<td>"+
                        "<div class='uk-button-group'>"+
                        "<button data-id='"+item.id+"' class='uk-button uk-button-primary' onclick='focusupdateTotem("+item.id+")'><span class='flaticon-edit'>Modificar</button>"+
                        "<button class='uk-button uk-button-danger' onclick='focusdeleteTotem("+item.id+",`"+item.nombre+"`)'><span class='flaticon-erase-text'>Eliminar</button>"+
                        "</div>"+
                        "</td>"+
                        "</tr>"
                    ));
                });
                
                UIkit.modal("#totem-new-modal").hide();
            }
        });
    });

    $('#frmUpdate').on( "submit", function( e ) {
        e.preventDefault();
        
        var form_data = "id="+$(this).data("id");
        form_data += "&"+$(this).find(":input:not(:hidden)").serialize();
        $.ajax({
            data:  form_data,
            url:   'config/modificar',
            type:  'POST',
            dateType:"json",
            beforeSend: function () {
                //$("#resultado").html("Procesando, espere por favor...");
            },success:  function (data){
                var json = eval('('+ data +')');
                $("#tbody").empty();

                $.each(json, function(i, item){
                    $("#tbody").append($(
                        "<tr>" +
                        "<td>#"+ item.id +"</td>" +
                        "<td>"+ item.nombre +"</td>" +
                        "<td>"+
                        "<div class='uk-button-group'>"+
                        "<button data-id='"+item.id+"' class='uk-button uk-button-primary' onclick='focusupdateTotem("+item.id+")'><span class='flaticon-edit'>Modificar</button>"+
                        "<button class='uk-button uk-button-danger' onclick='focusdeleteTotem("+item.id+",`"+item.nombre+"`)'><span class='flaticon-erase-text'>Eliminar</button>"+
                        "</div>"+
                        "</td>"+
                        "</tr>"
                    ));
                });
                
                UIkit.modal("#totem-update-modal").hide();
            }
        });
    });
});

function focusnewTotem() {
    UIkit.modal('#totem-new-modal').show();
}

function focusupdateTotem(id) {
    $.ajax({
        data:   {"id":id},
        url:   'config/listar',
        type:  'POST',
        dateType:"json",
        success:  function (data){
            var json = eval('('+ data +')');
            var visible = false;
            
            $('#frmUpdate').data('id',json.id);
            $("#nombre").attr("value",json.nombre);
            UIkit.modal('#totem-update-modal').show();
            
            var visible = $('#Uip-camara').is(":visible")?true:false;
            if (visible) UIkit.toggle("#toggleCamara").toggle();
            if(json.camara.estado == 1){
                $("#Uip-camara").attr("value",json.camara.ip);
                UIkit.toggle("#toggleCamara").toggle();
            }

            var visible = $('#Uip-pantalla').is(":visible")?true:false;
            if (visible) UIkit.toggle("#togglePantalla").toggle();
            if(json.pantalla.estado == 1){
                $("#Uip-pantalla").attr("value",json.pantalla.ip);
                UIkit.toggle("#togglePantalla").toggle();
            }

            var visible = $('#Uip-citofono').is(":visible")?true:false;
            if (visible) UIkit.toggle("#toggleCitofono").toggle();
            if(json.citofono.estado == 1){
                $("#Uip-citofono").attr("value",json.citofono.ip);
                UIkit.toggle("#toggleCitofono").toggle();
            }
        }
    });
}

function focusdeleteTotem(id,nombre){
    UIkit.modal.confirm('Desea eliminar al registro: '+nombre+'',
        { labels: {
            cancel: 'Cancelar',
            ok: 'Eliminar'}
        }).then(function () {
            $.ajax({
                data:  {"id": id},
                url:   'config/eliminar',
                type:  'POST',
                dateType:"json",
                success:  function (data){
                    var json = eval('('+ data +')');
                    $("#tbody").empty();

                    $.each(json, function(i, item){
                        $("#tbody").append($(
                            "<tr>" +
                            "<td>#"+ item.id +"</td>" +
                            "<td>"+ item.nombre +"</td>" +
                            "<td>"+
                            "<div class='uk-button-group'>"+
                            "<button data-id='"+item.id+"' class='uk-button uk-button-primary' onclick='focusupdateTotem("+item.id+")'><span class='flaticon-edit'>Modificar</button>"+
                            "<button class='uk-button uk-button-danger' onclick='focusdeleteTotem("+item.id+",`"+item.nombre+"`)'><span class='flaticon-erase-text'>Eliminar</button>"+
                            "</div>"+
                            "</td>"+
                            "</tr>"
                        ));
                    });
                }
            });
    }, function () {}
    );
}

function panelLateral(){
    $.ajax({
        url:   'seeker',
        type:  'POST',
        dateType:"json",
        success:  function (data){
            if (data){
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
                });
            }else{
                console.log("failed");
            }
        }
    });
}