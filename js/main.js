
$(document).ready(function(){  

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
        if ($("#usuario").val() == "") 
            error = true;
        if ($("#clave").val() == "")
            error = true;
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
                },error:function(data,tipo,error){
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
        
        if (!(/^[\_]*[a-zA-Z0-9]+(\_|\.*)?[a-z0-9A-Z]+@[a-zA-Z0-9]+\.[a-z0-9A-Z]{3,6}$/.test(($(frmid  + "#correo").val())))) {        
            alert("El correo es requerido o es incorrecto");
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
                  $(".ajaxloader").html( "Cargando..." );
                },                
                success: function( data )
                {
                    $(".ajaxloader").html( "" );
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
                dataType: "JSON",
                beforeSend : function()
                {
                  $(".ajaxloader").html( "Cargando..." );
                },
                success: function( data )
                {
                    $(".ajaxloader").html( "" );
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
});




