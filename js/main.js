
$(document).ready(function(){  
    $("#loadingajax").ajaxStart(function(){
        $(this).fadeIn();
    });
    
    $("#loadingajax").ajaxStop( function(){
        $(this).fadeOut();
    });
    
    
    //formualario de sugerencias
    $("#frmsuggestion").submit(function(){
        if ($("#nombre").val() == ""){
            $("#nombre").focus();
            alert('El nombre es requerido');
            return false;
        }
        if ($("#correo").val() == ""){
            $("#correo").focus();
            alert('El correo es requerido');
            return false;
        }else if (!validaemail($("#correo").val())){
            $("#correo").focus();
            alert('El correo no es valido');
            return false;
        }
        if ($("#sugerencia").val() == ""){
            $("#correo").focus();
            alert('La sugerencia es requerida');
            return false;
        }
       domloading = $("#frmsuggestion .ajaxloader")
       form = $(this);
        //ejecutar el contenido del archivo ajax
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            //dataType: 'JSON',
            beforeSend:function(){
                $(domloading).html("Cargando...");
            },
            error:function(data,tipo,error){
                $(domloading).html("Ocurrio un error, favor intentar de nuevo");
            },
            success: function(data){
                if (data.return){
                    $(form)[0].reset();
                    $(domloading).html("La sugerencia ha sido enviada, Gracias :D");
                    $(domloading).fadeIn();
                }
            }
        });
        return false; 
        
    });
    
    
    //area para la listas de las companias
    if ($("#areacompaniesmanager").length){
        $("#areacompaniesmanager").ready(function(){
            loadajaxcontent('views/modules/CompaniesLists.php', 'get','',$('.ajaxloader'),$("#areacompaniesmanager"));
        });
    }
    
    //area para las listas de las pasantias
    if ($("#areainternshipsmanager").length){
        $("#areainternshipsmanager").ready(function(){
            loadajaxcontent('views/modules/InternshipsLists.php', 'get','',$('.ajaxloader'),$("#areainternshipsmanager"));
        });
        
    }
    
    
    //area para las listas de las solicitudes de pasantias
    if ($("#arearequestmanager").length){
        $("#arearequestmanager").ready(function(){
            loadajaxcontent('views/modules/RequestLists.php', 'get','',$('.ajaxloader'),$("#arearequestmanager"));
        });
        
    }
    /* area de para la lista de empleados**/
    
    if( $("#areaemployeesmanager").length)
    {
        $("#areaemployeesmanager").ready( function()
        {            
            loadajaxcontent('views/modules/EmployeesList.php','get','',$('.ajaxloader'),$("#areaemployeesmanager") );                                      
        });
    }
        
    
    //area para las lista de las carreras
    if( $("#areacareersmanager").length)
    {
        $("#areacareersmanager").ready( function()
        {            
            loadajaxcontent('views/modules/CareersList.php','get','',$('.ajaxloader'),$("#areacareersmanager") );                                      
        });
    }

    
    /**
     * area para los estudiantes
     **/
    if( $("#areastudentsmanager").length)
    {
        $("#areastudentsmanager").ready( function()
        {
            loadajaxcontent('views/modules/StudentsList.php','get','',$('.ajaxloader'),$("#areastudentsmanager") );                                      
        });
    }
    
    /**
     * area para la animacion de password
     **/
    if( $("#password").length )
    {
        $( "#password" ).passStrength({
            fisrtMsg:" La clave debe contener mas de 7 caracteres",
            imageBad:"resources/bad.gif",
            imageOk:"resources/ok.gif"
        } );
    }
   
    /************************************************************************/
    /******************************formularios*******************************/
    /**
     *
     **/
    $("#frmlogin").submit(function(){
        $("#agregar").attr("disabled",true);
        error = false;
        frmid = $(this).attr('id') + " ";
        var domloading = "#" + frmid + " .ajaxloader";
        if ($("#usuario").val() == ""){
            alert('El correo es requerido');
            $("#usuario").focus();
            error = true;
        } 
            
        if ($("#clave").val() == ""){
            alert('La clave es requerida');
            $("#clave").focus();
            error = true;
        }
        
        if (error){
        //
            
        }
        else{
            //ejecutar el contenido del archivo ajax
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend:function(){
                    $(domloading).html("Cargando...");
                },
                error:function(data,tipo,error){
                    $(domloading).html("Ocurrio un error, favor intentar de nuevo");
                },
                success: function(data){
                    $(domloading).html("");
                    if (!data['return']) {
                        alert('login incorrecto');
                    }else
                        location.href=data['redirect'];
                }
            });
        }
        $("#agregar").attr("disabled",false);
        return false;  
    });
    
    
    
    
    $("#frmregister").submit(function( e ){        
        error = false;
        frmid = "#" + $(this).attr('id') + " ";
        if ($(frmid  + "#nombre").val() == "") {
            alert("El nombre es requerido");
            $(frmid  + "#nombre").focus();
            return false;
        }
        
        if ($(frmid  + "#correo").val() == ""){
            alert("El correo es requerido");
            $(frmid  + "#correo").focus();
            return false;
        }
        else if(!validaemail($(frmid  + "#correo").val())){
            alert("El correo no es valido");
            $(frmid  + "#correo").focus();
            return false;
        }
        
        if ($(frmid  + "#password").val().length < 8 ) {            
            alert("El password es requerido o es incorrecto");
            $(frmid  + "#password").focus();
            return false;
        }            
        if (!(/[0-9]+\-[0-9]+\-[0-9]+/.test($(frmid  + "#telefono").val()))) {
            alert("El telefono es requerido o es incorrecto");
            $(frmid  + "#telefono").focus();
            return false;
        }
        if( $(frmid  + "#telefono2").val() != "" ){
            if (!(/[0-9]+\-[0-9]+\-[0-9]+/.test($(frmid  + "#telefono2").val()))) {
                alert("El telefono2 es incorrecto");
                $(frmid  + "#telefono2").focus();
                return false;
            }
        }
        if( $(frmid  + "#celular").val() != "" ){
            if (!(/[0-9]+\-[0-9]+\-[0-9]+/.test($(frmid  + "#telefono2").val()))) {
                alert("El celular es requerido o es incorrecto");
                $(frmid  + "#celuar").focus();
                return false;
            }
        }
        if ($(frmid  + "#carrera").val() == "0") {
            alert("La carrera en la que pertenece el estudiante es requerida");
            $(frmid  + "#carrera").focus();
            return false;
        }        
        
        if ($(frmid  + "#foto").val() == "") {
            alert("La foto es requerida");
            $(frmid  + "#foto").focus();
            return false;
        }
        
        if( $("#modificar").length )
        {
            $.ajax({
                url: $(this).attr( 'action' ),
                type: $(this).attr( 'method' ),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend : function()
                {
                    $("#frmregister .ajaxloader").html( "Cargando..." );
                }, 
                error: function(data,type,error){
                    $("#frmregister .ajaxloader").html( "" );
                    
                },
                success: function( data )
                {
                    $("#frmregister .ajaxloader").html( "" );
                    if( data.return ){
                        alert( "El Usuario ha sido Actualizado correctamente" );                    
                        $("#frmregister")[0].reset();
                        $("span").find("p").remove();
                        $(".ajaxredirect").click();
                    }
                    else                    
                        alert( "El Usuario no ha sido Actualizado , favor intentelo nuevamente" );
                }
            });            
        }
        else{
            e.preventDefault();
            if(confirm("Esta todo correcto?")){
                $.ajax({
                    url: $(this).attr( 'action' ),
                    type: $(this).attr( 'method' ),
                    data: $(this).serialize(),
                    //dataType: "JSON",
                    beforeSend : function()
                    {
                        $("#frmregister .ajaxloader").html( "Cargando..." );
                    },
                    error:function(data,type,error){
                        $("#frmregister .ajaxloader").html("Problema en el registro");
                        alert(error);
                    },
                    success: function( data )
                    {
                        $("#frmregister .ajaxloader").html( "" );
                        if( data.return ){
                            alert( "El Usuario ha sido agregado correctamente" );
                            $("#frmregister")[0].reset();
                            $("span").find("p").remove();
                            $(".ajaxredirect").click();
                        }
                        else
                            alert( "El Usuario no ha sido agregado , favor intentelo nuevamente" );
                    }
                });
  
            }
        }
        return false;
    });
    
    /******************************formularios*******************************/
    /************************************************************************/

    $(".soliPasantia").click(function(){
        /**
    *id de la solicitud de la passantia
    **/
        var idsol = $(this).attr('value');
        var DOMajaxloading = $("span[name='ajaxresSoliPasantia[" + idsol +"]']");
        if (confirm("Desea solicitar esta pasantia?")){
            $.ajax({
                url: $(this).attr( 'href' ),
                type: 'get',
                data: $(this).serialize(),
                //dataType: "JSON",
                beforeSend : function()
                {
                    $(DOMajaxloading).html( "Cargando..." );
                },
                success: function( data )
                {
                    $(DOMajaxloading).html( "" );
                    if( data.return ){
                        alert("La solicitud se ha enviado correctamente, esperar a que los operadores aprueben su solicitud");
                    }
                    else{
                        alert(data.msg);
                    }
                        
                }
            });
       
        }
        return false; 
    
    });


});




