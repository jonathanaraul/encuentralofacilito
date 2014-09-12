

jQuery('.nickcasatabla').focusout(function() {  

	var paysafecardbookies = jQuery(this).attr('paysafecardbookies');
	var bookies = jQuery(this).attr('bookies');
	var nombre = jQuery(this).val();
	var data = 'paysafecardbookies=' + paysafecardbookies + '&bookies=' + bookies +'&nombre='+nombre;

	$.ajax({
		type : "POST",
		url : direccionSaveBookiesValues,
		data : data,
		dataType : "json",
		success : function(data) {
		}
	});
});