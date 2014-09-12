jQuery(function($)
{	
	function ecd_readCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}
	
	function ecd_createCookie(name,value,days) {
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime()+(days*24*60*60*1000));
	        var expires = "; expires="+date.toGMTString();
	    }
	    else var expires = "";
	  
	  	
	  	document.cookie = name+"="+value+expires+"; domain="+window.location.hostname+"; path=/";
	  	
	    
	}
	
	function ecd_eraseCookie(name) {
	    ecd_createCookie(name,"",-1);
	}
	
	// GET ECD COOKIE
	var ecd_cookie = ecd_readCookie("ecd_opt_in");
	
	// IF ECD COOKIE NOT SET
	if(!ecd_cookie || ecd_cookie == "null")
	{
		var all_cookies = document.cookie.split(";");
		
		// CLEAR COOKIES
		setTimeout(function(){ecd_clear_cookies(all_cookies);}, 1000) // TIMEOUT SEEMS TO GET AROUND ISSUES CLEARING GOOGLE ANALYTICS COOKIES
		
		var ecd_message	= "Este sitio web utiliza cookies propias y de terceros que nos permiten ofrecer nuestros servicios. Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies. <a href='http://todoapuestas.org/blog/politica-de-cookies/' rel='nofollow' target='_blank'>Más información</a>";
		/*
		if(ecd_params.cookie_message)
		{
			ecd_message	= ecd_params.cookie_message;
		}
		*/
		
		// DISPLAY MESSAGE
		var html = '<div id="ecd_opt_in_banner">\
			<div>\
				<form id="ecd_opt_in_form">\
				<span>'+ecd_message+'</span>\
				<input type="submit" name="ecd_opt_in_submit" value="Aceptar" id="ecd_opt_in_submit" />\
				</form>\
			</div>\
		</div>';
		
		$("body").prepend(html);
		$("#ecd_opt_in_banner").hide().slideDown("slow");
		document.getElementById('banner-top').style.marginTop = '30px';
		$("#ecd_opt_in_submit").live("click", function()
		{
			//if($("#ecd_opt_in_checkbox").attr("checked") == "checked" || $("#ecd_opt_in_checkbox").attr("checked") == "true")
			/*if($("#ecd_opt_in_checkbox").is(':checked'))
			{*/
			ecd_createCookie("ecd_opt_in", 1, 365);
			$("#ecd_opt_in_banner").hide();
			//}
			document.getElementById('example').style.borderWidth = '0px';
			return false;
		});
	}
	
	function ecd_clear_cookies(all_cookies)
	{
		for (var i = 0; i < all_cookies.length; i++)
		{
			
			clearCookie(trim(all_cookies[i].split("=")[0]), window.location.hostname, '/');
			clearCookie(trim(all_cookies[i].split("=")[0]), "."+window.location.hostname, '/');
		
		}
	}
	function clearCookie(name, domain, path){
		
        var domain = domain || document.domain;
        var path = path || "/";
        document.cookie = name + "=; expires=" + new Date + "; domain=" + domain + "; path=" + path;     
		   
	};

	function trim (str) {
		str = str.replace(/^\s+/, '');
		for (var i = str.length - 1; i >= 0; i--) {
			if (/\S/.test(str.charAt(i))) {
				str = str.substring(0, i + 1);
				break;
			}
		}
		return str;
	}

});