$(document).ready(function(){
    /**
    * enlace para abrir formulario para agregar
    **/
    if ($(".ajaxredirect").length){
        $(".ajaxredirect").click(function(){            
            loadajaxcontent($(this).attr('href'), 'get','',$(".lnkajaxloader"),$("#site_content"));            
            return false;  
        });
    }


    /********************formularios********************/
    /***************************************************/
    $("#frmCompaniesEditor").submit(function(){
        if ($("#nombre").val() == ""){
            $("#nombre").focus();
            alert('El nombre es requerido');
            return false;
        }
        
        if ($("#direccion").val() == ""){
            $("#direccion").focus();
            alert('La direccion es requerida');
            return false;
        }
        
        if ($("#desripcion").val() == ""){
            $("#desripcion").focus();
            alert('La descripcion es requerida');
            return false;
        }
        
        if ($("#telefono1").val() == ""){
            $("#telefono1").focus();
            alert('El telefono 1 es requerido');
            return false;
        }
        
        if ($("#telefono2").val() == ""){
            $("#telefono2").focus();
            alert('El telefono 2 es requerido');
            return false;
        }
        
        if ($("#correo").val() == ""){
            $("#correo").focus();
            alert('El correo es requerido');
            return false;
        }
        
        if ($("#modificar").length){
            //cuando sea para modificar       
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend:function(){
                    $('.ajaxloader').html("Cargando...");
                },
                success: function(data){
                   $('.ajaxloader').html("");
                   if (data['return']) {
                     alert('La empresa ha sido actualizada correctamente');
                     $(".ajaxredirect").click();
                   }else alert('La empresa no ha podido ser actualizada  correctamente');
                }
            }); 
        } else{
            //cuando sea agregar        
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend:function(){
                    $('.ajaxloader').html("Cargando...");
                },
                success: function(data){
                   $('.ajaxloader').html("");
                   if (data['return']) {
                       alert('La empresa ha sido agregada correctamente');
                      $(".ajaxredirect").click();
                   }else alert('La empresa no ha podido ser agregada correctamente');
                }
            }); 
        } 
        return false;
    });
    
    /**************Formulario de Carreras*************/
    
    $("#frmCareerEditor").submit( function( e )
                                 {
                if($("#nombre").val()=="")
                {
                    e.preventDefault();
                    $("#nombre").focus();
                    alert( "El nombre es requerido" );
                    return;
                }
                if( $("#descripcion").val()=="" )
                {
                    e.preventDefault();
                    $("#descripcion").focus();
                    alert( "Es requerida una descripcion para la carrera" );
                    return;
                }
                if( $("#modificar").length )
                {                    
                    $.ajax( {
                        url : $( this ).attr( 'action' ),
                        type: $( this ).attr( 'method' ),
                        data: $( this ).serialize(),
                        dataType : "JSON",
                        
                        beforeSend: function()
                        {
                            $(".ajaxloader").html( "Cargando..." )
                        },
                        success: function( data )
                        {
                            $(".ajaxloader").html( "" );                            
                            if( data.return )
                            {
                                alert( "la carrera ha sido actualizada exitosamente" );
                                $(".ajaxredirect").click();
                            }else
                               alert( "la carrera no ha sido actualizada correctamente" );
                        }
                        
                            });
                }
                else
                {                    
                    $.ajax( {                        
                        url : $( this ).attr( 'action' ),
                        type: $( this ).attr( 'method' ),
                        data: $( this ).serialize(),
                        dataType : "JSON",                        
                        beforeSend: function()
                        {
                            $(".ajaxloader").html( "Cargando..." )
                        },
                        success: function( data )
                        {                            
                            $(".ajaxloader").html( "" );
                            if( data.return )
                            {
                                alert( "la carrera ha sido agregada exitosamente" );
                                $(".ajaxredirect").click();
                            }else
                               alert( "la carrera no ha sido agregada correctamente" );
                        }
                        
                            });                    
                }
                return false;
                                 })
    
    
    
});