/**
 *
 **/
function loadajaxcontent(url,method,data,DOMloading,DOMReceiver){
    $.ajax({
        url: url,
        type: method,
        beforeSend:function(){
            $(DOMloading).html("Cargando...");
        },
        success: function(data){
            $(DOMloading).html("");
            $(DOMReceiver).html(data);            
        }
    });   
}

/**
 *
 **/
function validaemail(valor){
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (filter.test(valor)) 
        return true;
    else
        return false;
};


jQuery.fn.passStrength = function( options )
{
    /*
	*@function : passStrength , esta funcion controla la fortaleza de un clave
	*@param text : texto personalizado para mensaje
	*@return : instance this
	*/
    var config =
    {
        initialMsg : "",
        fisrtMsg : " La clave debe contener mas de 4 caracteres",
        secondMsg : " Clave no segura",
        thirdMsg : " Clave Segura",
        imageBad :"",
        imageOk:""
    }
    
    jQuery.extend( config,options );
    
    this.each( function()
    {
        var elem = $( this );                
        var text = $("<span>"+config.initialMsg+"</span>");
        elem.after( text );                
        elem.data("text",text);
                                
        elem.keyup( function()
        {
            var pass = $(this);                                                
            var number = parseInt( pass.attr("value").length );
                            
            switch( number )
            {
                case 0: case 1: case 2: case 3: case 4:
                    pass.data("text").html( config.fisrtMsg );
                    break;
                case 5:case 6: case 7:
                {                                    
                    var image = config.imageBad.length !=0 ?$("<p style='display:inline'><img src="+config.imageBad+">"+config.secondMsg+"</p>") : config.secondMsg;                                    
                    pass.data("text").html( image );
                }
                break;                                                            
                default:{
                    var image = config.imageOk.length !=0 ?$("<p style='display:inline'><img src="+config.imageOk+">"+config.thirdMsg+"</p>") : config.thirdMsg;                                    
                    pass.data("text").html( image );
                }
            }
        })
    })
    return this;
}