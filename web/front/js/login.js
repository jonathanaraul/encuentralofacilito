$(document).ready(function(){
	var remember = $.cookie('remember');
	if ( remember == 'true' ) {
		var username = $.cookie('username');
		var password = $.cookie('password');
		// autofill the fields
		$('#email_log').attr("value", username);
		$('#pass_log').attr("value", password);
		$('#remember').attr("checked", true);
		
	}


});

function login(){
	
	$('#btn_entrar').val("Entrando...");
	$("#btn_entrar").attr("disabled","disabled");

	if ($('#remember').attr('checked')) {
		var username = $('#email_log').attr("value");
		var password = $('#pass_log').attr("value");
		// set cookies to expire in 14 days
		$.cookie('username', username, { expires: 14 });
		$.cookie('password', password, { expires: 14 });
		$.cookie('remember', true, { expires: 14 });
	} else {
		// reset cookies
		$.cookie('username', null);
		$.cookie('password', null);
		$.cookie('remember', null);
	}
	$.ajax({
		type: "POST",
		url: "/actions/login.php",
  	 	data: {email: $("#email_log").val(), pass: $.md5($("#pass_log").val())},
	    success: function(msg){
				if(msg.split("|")[0]==1){
					$.cookie("key", msg.split("|")[1], {path: '/', expires: 14,  domain: 'todoapuestas.org'});
					location.href = msg.split("|")[2];
					$("#btn_entrar").removeAttr("disabled");
				}
				else if(msg.split("|")[0]==2){
		     		location.href = msg.split("|")[1];
					$("#btn_entrar").removeAttr("disabled");
				}
				else{
					$('#results_log').html(msg);
					$('#btn_entrar').val("Entrar");
					$("#btn_entrar").removeAttr("disabled");
				}
   		}
 	});
}