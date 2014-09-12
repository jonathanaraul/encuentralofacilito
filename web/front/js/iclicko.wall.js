var start=0;
var limit=0;
$(document).ready(function(){
		limit=$("#limit").val();
		$("#unseen_msgs").hide();
		//first_call();
		$("#unseen_msgs").click(function(){
				call_messages('unseen');
		});
		$("#show_more").click(function(){
				start=limit+start;
				call_messages('more');
		});
		//setTimeout("looking_for()",10000);
	
});

function call_messages(from){
//alert('first_date:'+$("#first_date").val()+'last_date:'+$("#last_date").val());
		var s="";
		if($("#owner").val()==0) s="2"; 
		$.ajax({
				type:"post",
				url:"/actions/show_unseen_msgs"+s+".php",
				data:{wall_parent_id: $("#wall_parent_id").val(), wall_type: $("#wall_type").val(), first_date:$("#first_date").val(), last_date:$("#last_date").val(), wall_width:$("#wall_width").val(), where_i_am:$("#where_i_am").val(), from:from, start:start, limit:limit, owner:$("#owner").val()},
				success:function(msg){//alert(msg.split("|*|")[2]+msg.split("|*|")[1]);
				//alert($("#first_date").val()+$("#last_date").val());
					if(from=='unseen'){
						$("#last_msg").remove();
						$("#container").html("<div id='last_msg'></div>");
								
						var messages_html = $("#messages").html();
						messages_html = msg.split("|*|")[0] + messages_html;
						$("#messages").remove();//$("#prueba").html(msg);
						$("#container2").html("<div id='messages'></div>");
						$("#messages").html(messages_html);
								
						$("#unseen_msgs").hide();
						$("#last_date").val(msg.split("|*|")[2]);
					}else if(from=='more'){
						var messages_html = $("#messages").html();
						messages_html = messages_html + msg.split("|*|")[0];
						$("#messages").remove();//$("#prueba").html(msg);
						$("#container2").html("<div id='messages'></div>");
						$("#messages").html(messages_html);
						
						$("#first_date").val(msg.split("|*|")[1]);
						
						if(msg.split("|*|")[3]==1){
								$("#show_more").hide();	
						}
					}
								
				}
		});
}//

function first_call(){
		$.ajax({
				type:"post",
				url:"/actions/show_unseen_msgs.php",
				data:{wall_parent_id: $("#wall_parent_id").val(), wall_type: $("#wall_type").val(), first_date:$("#first_date").val(), last_date:$("#last_date").val(), wall_width:$("#wall_width").val(), where_i_am:$("#where_i_am").val(), from:"more", start:start, limit:limit},
				success:function(msg){
						var messages_html = $("#messages").html();
						messages_html = messages_html + msg.split("|*|")[0];
						$("#messages").remove();//$("#prueba").html(msg);
						$("#container2").html("<div id='messages'></div>");
						$("#messages").html(messages_html);
						
						$("#first_date").val(msg.split("|*|")[1]);
						$("#last_date").val(msg.split("|*|")[2]);
						if(msg.split("|*|")[3]==1){
								$("#div_more").html('');
						}
				}
		});
		//alert($("#last_date").val());

}//

function looking_for(){//alert($("#last_date").val());
		$.ajax({
				type:"post",
				url:"/actions/looking_for_msgs.php",
				data:{wall_parent_id: $("#wall_parent_id").val(), wall_type: $("#wall_type").val(), last_date:$("#last_date").val(), owner:$("#owner").val()},
				success:function(msg){//$("#div_prueba").html($("#last_date").val());
						if(msg.split("|")[0]!=0){//alert($("#wall_parent_id").val()+$("#wall_type").val()+$("#last_id").val());
								$("#unseen_msgs").html(msg.split("|")[1]);//$("#prueba").html(msg);
								$("#unseen_msgs").slideDown('slow');
						}else{
								$("#unseen_msgs").html("");
						}
				}
		});
		setTimeout("looking_for()",10000);
}//look

function send_msg(){
		if(($("#wall_txt").val()==$("#wall_default").val()||($("#wall_default").val()==""))&&($("#is_link").val()==0)&&($("#is_chart").val()==0))
			return;
			
		$("#btn_send").val("Enviando...");
		$("#btn_send").attr("disabled", true);
		
		//var nice=0;//para saber si el formulario de grafico es correcto
		if($("#is_chart").val()==1){ new_chart(); }
		
		if($("#is_chart").val()==0){ call_send(); }
}//

function call_send(){ 
			if($("#twitter:checked").val()===undefined){
					var comments=0;	
			}else{
					var comments=1;
			}
			if($("#fb:checked").val()===undefined){
					var comments_fb=0;	
			}else{
					var comments_fb=1;
			}
	$.ajax({
		type: "POST",
		url: "/actions/send_msg_wall.php",
  	 	data: {wall_parent_id: $("#wall_parent_id").val(), wall_txt: $("#wall_txt").val(), wall_type: $("#wall_type").val(),wall_width: $("#wall_width").val(), is_link: $("#is_link").val(), title_link: $("#title_link").val(), url_link: $("#url_link").val(), description_link: $("#description_link").val(), comments:comments, comments_fb:comments_fb, is_chart:$("#is_chart").val()},
	    success: function(msg){
				$("#wall_txt").val($("#wall_default").val());
				$("#btn_send").removeAttr("disabled");
				$("#btn_send").val("Compartir");
				var last_msg = $(document.createElement("div")).attr("id","last_msg").html(msg).hide();
				$("#last_msg").before(last_msg);
				$('#last_msg').slideDown('slow');
				if($("#is_link").val()==1)
					//añadir un retraso
					$('#content_link').hide();
				else if($("#is_chart").val()==1)
					//añadir un retraso
					$('#content_chart').hide();
		}
 	});
}//

function show_comment(id){
	var wrap = $("#comment_"+id);
	wrap.hide();
	$.ajax({
		type: "POST",
		url: "/actions/show_comment.php",
  	 	data: {wall_id: id},
	    success: function(msg){;
				wrap.html(msg);
				wrap.fadeIn("slow");
				$("#msg_response_"+id).focus();				
   		}
	});
}

function send_msg_response(id){
		
	$("#btn_send_response").val("Enviando...");
	$.ajax({
		type: "POST",
		url: "/actions/send_msg_response_wall.php",
  	 	data: {wall_response_id: id, wall_response_txt: $("#wall_response_txt_"+id).val()},
	    success: function(msg){
				$("#btn_send_response").val("Comentar");
				$("#wall_response_txt_"+id).val("");
				$("#comment_"+id).before(msg);
   		}
 	});
}

function hide(id){
	$("#"+id).slideUp("slow");
}
