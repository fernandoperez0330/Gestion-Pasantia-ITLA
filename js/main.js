
$(document).ready(function(){  

    /**
     *
     **/
    if ($("#areacompaniesmanager").length){
        $("#areacompaniesmanager").ready(function(){
            loadajaxcontent('views/modules/CompaniesLists.php', 'get','',$('.ajaxloader'),$("#areacompaniesmanager"));
        });
    }
    
    /**
     * area para las Carreras
     **/ 
    if( $("#areacareersmanager").length)
    {
        $("#areacareersmanager").ready( function()
                                       {
                loadajaxcontent('views/modules/CareersList.php','get','',$('.ajaxloader'),$("#areacareersmanager") );                                      
                                       });
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
    
    $("#frmregister").submit(function(){
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
        
        if (!(/[0-9]+\-[0-9]+\-[0-9]+/.test($(frmid  + "#telefono").val()))) {
            alert("El telefono es requerido o es incorrecto");
            $(frmid  + "#telefono").focus();
            return false;
        }
        if( $(frmid  + "#telefono2").val() != "" ){
        if (!(/[0-9]+\-[0-9]+\-[0-9]+/.test($(frmid  + "#telefono2").val()))) {
            alert("El telefono2 es requerido o es incorrecto");
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
        if ($(frmid  + "#password").val() == "0") {
            alert("El password es requerido o es incorrecto");
            $(frmid  + "#password").focus();
            return false;
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
        if (confirm("Esta todo correcto?")){
            $.ajax({
                url: "ajax.postStudents.php",
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend:function(){
                    $(domloading).html("Cargando...");
                },
                success: function(data){
                    $(domloading).html("");
                    if (data['return']){
                        location.href=data['redirect'];
                    }
                    else{ 
                        alert('login incorrecto');
                        location.href=data['redirect'];
                    }
                }
            });   
        }
        return false;
    });
    
/******************************formularios*******************************/
/************************************************************************/
});




