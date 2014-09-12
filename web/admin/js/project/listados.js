jQuery('.ordenar').mouseup(function() {  
	setTimeout (ordenaRank, 1000); 		
});
jQuery('#borrarNoticiasPendientes').click(function() {  

	jQuery('#noticias-loader').css('display','block');
	jQuery('#noticias-tablas').css('display','none');
	var data ="";

	$.post(Routing.generate('project_back_parser_noticia_borrar_pendientes'), data, function(respuesta) {
	    document.location.href = Routing.generate('project_back_parser_noticia_list');
	});

	return false;
});
jQuery('.recorregir-evento-corrector-ld').click(function() {  

	var idEvento= jQuery(this).parent().attr('objeto');
	var idPronosticoAnterior= jQuery(this).parent().attr('corregido');
    var idPronosticoNuevo=  jQuery("#event_"+idEvento).val();


	var data = 'idEvento='+idEvento+'&idPronosticoNuevo='+idPronosticoNuevo+'&idPronosticoAnterior='+idPronosticoAnterior;

	$.post(Routing.generate('project_back_liga_deportiva_recorrector_ld_corregir_evento'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		
		if(respuesta.estado){
	        jQuery('#fila_'+idEvento).remove();
		}
		else{
		    $.gritter.add({
						title: 'Recorreccion fallida',
						text: 'No se puedo corregir el evento.',
						class_name: 'gritter-error'
					});
		}
	});

	return false;
});

jQuery('#recorrector-ld-mes-anterior').click(function() {  

	var fecha = jQuery('#codigo-fecha-corrector').val();
	var data = 'fecha='+fecha;

	jQuery('#recorrectorLD-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_liga_deportiva_recorrector_ld_mes_anterior'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#recorrectorLD-loader').css('display','none');
		jQuery('.alert-error').remove();

		jQuery('#titulo-corrector').html('Recorrector LD '+respuesta.nombreMes+' - '+respuesta.anio);
		jQuery('#codigo-fecha-corrector').val(respuesta.mes+'-'+respuesta.anio);
		
		if(respuesta.results==true){
			jQuery('#tabla-elementos').css('display','block');
		    jQuery('#cabecera-elementos').empty();
		    jQuery('#contenido-elementos').empty();
		    jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		    jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
		}
		else{
            jQuery('#antes-mensaje-error').after(respuesta.htmlError);
		}
		
	});

	return false;
});
jQuery('#corrector-ld-mes-anterior').click(function() {  

	var fecha = jQuery('#codigo-fecha-corrector').val();
	var data = 'fecha='+fecha;

	jQuery('#correctorLD-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_liga_deportiva_corrector_ld_mes_anterior'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#correctorLD-loader').css('display','none');
		jQuery('.alert-error').remove();

		jQuery('#titulo-corrector').html('Corrector LD '+respuesta.nombreMes+' - '+respuesta.anio);
		jQuery('#codigo-fecha-corrector').val(respuesta.mes+'-'+respuesta.anio);
		
		if(respuesta.results==true){
			jQuery('#tabla-elementos').css('display','block');
		    jQuery('#cabecera-elementos').empty();
		    jQuery('#contenido-elementos').empty();
		    jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		    jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
		}
		else{
            jQuery('#antes-mensaje-error').after(respuesta.htmlError);
		}
		
	});

	return false;
});

jQuery('.corregir-evento-corrector-ld').click(function() {  

	var idEvento= jQuery(this).parent().attr('objeto');
    var valuePronosticoCorregido=  jQuery("#event_"+idEvento).val();

    if(valuePronosticoCorregido == -1) return;
	
	var data = 'idEvento='+idEvento+'&valuePronosticoCorregido='+valuePronosticoCorregido;

	$.post(Routing.generate('project_back_liga_deportiva_corrector_ld_corregir_evento'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		
		if(respuesta.estado){
	        jQuery('#fila_'+idEvento).remove();
		}
		else{
		    $.gritter.add({
						title: 'Correccion fallida',
						text: 'No se puedo corregir el evento.',
						class_name: 'gritter-error'
					});
		}
	});

	return false;
});


jQuery('.borrar-listado-corrector-ld').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');

	var data = 'objeto='+objeto;

	$.post(Routing.generate('project_back_liga_deportiva_corrector_ld_delete'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		
		if(respuesta.estado){
	        jQuery('#fila_'+objeto).remove();
		}
		else{
		    $.gritter.add({
						title: 'Eliminación fallida',
						text: 'No se puedo borrar el objeto deseado porque tiene elementos asociados, por favor intente borrar estos elementos antes de realizar esta acción.',
						class_name: 'gritter-error'
					});
		}
	});

	return false;
});


jQuery('#puntos-ld-buscar').click(function() {  

	var usuario = jQuery('#usuario').val();
	var mes = jQuery('#mes').val();
	var anio = jQuery('#anio').val();

	var data = 'usuario='+usuario+'&mes='+mes+'&anio='+anio;

	jQuery('#puntosLD-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_liga_deportiva_puntos_ld_buscar_usuario'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#puntosLD-loader').css('display','none');
		jQuery('#tabla-elementos').css('display','block');
		jQuery('#cabecera-elementos').empty();
		jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		jQuery('#contenido-elementos').empty();
		jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
	});

	return false;
});
jQuery('#votacionesForo-eliminar').click(function() {  

	var usuario = jQuery('#usuario').val();
	var mes = jQuery('#mes').val();
	var anio = jQuery('#anio').val();

	var data = 'usuario='+usuario+'&mes='+mes+'&anio='+anio;

	jQuery('#votacionesForo-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_votaciones_foro_eliminar_votos_mes'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#votacionesForo-loader').css('display','none');
		jQuery('#tabla-elementos').css('display','block');
		jQuery('#cabecera-elementos').empty();
		jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		jQuery('#contenido-elementos').empty();
		jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
	});

	return false;
});

jQuery('#votacionesForo-recalcular').click(function() {  

	var data = '';

	jQuery('#votacionesForo-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_votaciones_foro_recalcular'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#votacionesForo-loader').css('display','none');
		jQuery('#tabla-elementos').css('display','block');
		jQuery('#cabecera-elementos').empty();
		jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		jQuery('#contenido-elementos').empty();
		jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
	});

	return false;
});

jQuery('#estadistica-buscar').click(function() {  

	var mes = jQuery('#estadistica-mes').val();
	var anio = jQuery('#estadistica-anio').val();
	var data = 'mes='+mes+'&anio='+anio;

	jQuery('#estadistica-loader').css('display','block');
	jQuery('#tabla-elementos').css('display','none');

	$.post(Routing.generate('project_back_tracking_site_search'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		jQuery('#estadistica-loader').css('display','none');
		jQuery('#tabla-elementos').css('display','block');
		jQuery('#cabecera-elementos').empty();
		jQuery('#cabecera-elementos').append(respuesta.htmlCabecera);
		jQuery('#contenido-elementos').empty();
		jQuery('#contenido-elementos').append(respuesta.htmlCuerpo);
		console.log(respuesta.htmlCabecera);
	});

	return false;
});


jQuery('#menuItem_tipo').click(function() {  
	var tipo = jQuery(this).val();
	if(tipo==0){
		$('#menuItem_category').val($("#menuItem_category option:first").val());
		$('#menuItem_category').prop('disabled', 'disabled');
		$('#menuItem_page').prop('disabled', false);
	}
	else if(tipo==1){
		$('#menuItem_page').val($("#menuItem_page option:first").val());
		$('#menuItem_page').prop('disabled', 'disabled');
		$('#menuItem_category').prop('disabled', false);
	}
	else if(tipo==2){
		$('#menuItem_category').val($("#menuItem_category option:first").val());
		$('#menuItem_page').val($("#menuItem_page option:first").val());
		$('#menuItem_page').prop('disabled', 'disabled');
		$('#menuItem_category').prop('disabled', 'disabled');
	}	
	return false;
});

jQuery('#ver-listado-items').click(function() {  
	var menu = jQuery('#listado-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_list', { menu: menu });
	return false;
});

jQuery('#crear-items').click(function() {  
	var menu = jQuery('#crear-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_create', { menu: menu });
	return false;
});

jQuery('#ordenar-items').click(function() {  
	var menu = jQuery('#ordenar-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_rank', { menu: menu });
	return false;
});

jQuery('.cambiar-estatus-listado').click(function() {  

	var tarea = jQuery(this).attr('tarea');
	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');

	var data = 'objeto='+objeto+'&tarea='+tarea+'&tipo='+tipo;

	if(tarea==0){
		jQuery(this).attr('tarea',1);
		jQuery('#publicado_'+objeto).css('display','none');
		jQuery('#despublicado_'+objeto).css('display','');
	}
	else{
		jQuery(this).attr('tarea',0);
		jQuery('#publicado_'+objeto).css('display','');
		jQuery('#despublicado_'+objeto).css('display','none')
	} 

	$.post(Routing.generate('project_back_status'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});

	return false;
});

jQuery('.borrar-listado').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');

	var data = 'objeto='+objeto+'&tipo='+tipo;

	$.post(Routing.generate('project_back_delete'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		console.log('el estado es '+respuesta.estado);
		if(respuesta.estado){
	        jQuery('#fila_'+objeto).remove();
		}
		else{
		    $.gritter.add({
						title: 'Eliminación fallida',
						text: 'No se puedo borrar el objeto deseado porque tiene elementos asociados, por favor intente borrar estos elementos antes de realizar esta acción.',
						class_name: 'gritter-error'
					});
		}
	});

	return false;
});

function ordenaRank(){
	var data= "cantidad="+jQuery('.ordenar').length;
	var posicion=0;

	$.each(jQuery('.ordenar'), function(indice, valor) {
		var id = $(valor).attr('id');
		var atributo = $(valor).attr('atributo');
		data += '&elemento_' + indice + '=' + atributo;
	});
	console.log(data);
	$.post(direccionRank, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});
}