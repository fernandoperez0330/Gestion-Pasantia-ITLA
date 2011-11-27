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