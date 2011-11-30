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
    
    /*enlace para eliminar de carreras*/
    if( $(".eliminar").length )
    {
        $(".eliminar").click( function( e )
        {
            if( confirm( "Desea realmnte eliminar es ta carrera ?" ) )
            {   
                return true; 
            }
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
                url:  $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                cache: false,
                dataType: 'JSON',
                beforeSend:function(){
                    $('.ajaxloader').html("Cargando...");
                },
                error: function(data,type,error){
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
                    if( data.return)
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
                //dataType : "JSON",                        
                beforeSend: function()
                {
                    $(".ajaxloader").html( "Cargando..." )
                },
                error: function(data,type,error){
                    alert(error); 
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
    });
    
    //formulario de pasantias
    $("#frmInternshipEditor").submit( function( e )
    {
        if($("#nombre").val()=="")
        {
            e.preventDefault();
            $("#nombre").focus();
            alert( "El nombre es requerido" );
            return;
        }
        if( $("#empresa_id").val()=="0")
        {
            $("#empresa_id").focus();
            alert( "Es requerida la empresa para la pasantia");
            return; 
        }
        if( $("#carreras").val()=="")
        {
            $("#carreras").focus();
            alert( "Es requerida al menos una carrera para la pasantia");
            return; 
        }
        //verificar las carreras para ponerlas separada por coma para que pueda ir a post en php
        carreras = $("#carreras").serialize();
        idcarreras = "";
        arrSplitCarreras = carreras.split('&');
        for (i=0; i<arrSplitCarreras.length; i++){
            arrIdCarreras = arrSplitCarreras[i].split('=');
            if (idcarreras != "") idcarreras += ","; 
            idcarreras += arrIdCarreras[1];
        }
        
        if( $("#modificar").length )
        {                    
            $.ajax( {
                url : $( this ).attr( 'action' ),
                type: $( this ).attr( 'method' ),
                data: $( this ).serialize() + "&carreras=" + idcarreras,
                dataType : "JSON",    
                beforeSend: function()
                {
                    $(".ajaxloader").html( "Cargando..." )
                },
                success: function( data )
                {
                    $(".ajaxloader").html( "" );                            
                    if( data.return)
                    {
                        alert( "la pasantia ha sido actualizada exitosamente" );
                        $(".ajaxredirect").click();
                    }else
                        alert( "la pasantia no ha sido actualizada correctamente" );
                }
                        
            });
        }
        else
        {                    
            $.ajax( {                        
                url : $( this ).attr( 'action' ),
                type: $( this ).attr( 'method' ),
                data: $( this ).serialize() + "&carreras=" + idcarreras,
                dataType : "JSON",                        
                beforeSend: function()
                {
                    $(".ajaxloader").html( "Cargando..." )
                },
                error: function(data,type,error){
                    alert(error); 
                },
                success: function( data )
                {                            
                    $(".ajaxloader").html( "" );
                    if( data.return)
                    {
                        alert( "La pasantia ha sido agregada exitosamente" );
                        $(".ajaxredirect").click();
                    }else
                        alert( "La pasantia no ha sido agregada correctamente" );
                }    
            });                    
        }
        return false;
    })
    
});