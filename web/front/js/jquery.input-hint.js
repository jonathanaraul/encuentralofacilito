 //variables globales    
var searchBox1 = $("#wall");
var defaultText = $("#wall_default").val();

alert(defaultText);
    //Mostramos / ocultamos el texto por defecto si es necesario  
    searchBox1.focus(function(){  
		alert(defaultText);
        if($(this).attr("value") == defaultText) $(this).attr("value", "");  
    });  
    searchBox1.blur(function(){  
        if($(this).attr("value") == "") $(this).attr("value", defaultText);  
    });