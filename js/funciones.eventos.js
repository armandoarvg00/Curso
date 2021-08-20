var ls_url = 'api/ajax.eventos.php';

function f_enviaSugerencias(){
	ls_nombre = $("#nombre_sugerencia").val();
	ls_mail = $("#mail_sugerencia").val();
	ls_mensaje = $("#mensaje_sugerencia").val();
	if(ls_nombre == ''){
		alert("Por favor ingrese su nombre");
		return;
	}

	if(ls_mail == ''){
		alert("Por favor ingrese su correo electrónico");
		return;
	}

	if(ls_mensaje == ''){
		alert("Por favor ingrese su mensaje");
		return;
	}
	$.ajax({
		type: 'POST',
		url: ls_url+'?opcion=enviar_sugerencia',
		data: {'nombre': ls_nombre, 'mail':ls_mail, 'mensaje': ls_mensaje}, 
		success: function(ls_response){
			try{
				la_resp = JSON.parse(ls_response);
				if(la_resp.retorna == 1){
					$("#modal-sugerencias").modal('hide');
					$("#nombre_sugerencia").val('');
					$("#mail_sugerencia").val('');
					$("#mensaje_sugerencia").val('');
				}
				alert(la_resp.mensaje);
			}catch(ls_error){
				console.log(ls_response);
				alert("Ocurrió un error inesperado: "+ls_error);
			}
		}
	});
}

function f_buscarInformacion(arg_fecha, arg_seccion){
	$.ajax({
		type: 'POST',
		data: {"tipo_publicacion":arg_seccion, "fecha":arg_fecha},
		url: ls_url+'?opcion=buscar_informacion',
		success: function(ls_response){
			try{
				la_resp = JSON.parse(ls_response);
				if(la_resp.retorna == 1){
					$("#lista-cursos-encontrados").html(la_resp.informacion);
				}else{
					alert(la_resp.mensaje);
				}
			}catch(ls_error){
				console.log(ls_response);
				alert("Ocurrió un error inesperado: "+ls_error);
			}
		}
	});
}

function f_borrarInformacion(arg_id, arg_fecha, arg_title){
	if(confirm("¿Está seguro que desea borrar «"+arg_title+"» de la fecha «"+arg_fecha+"»?")){
		$.ajax({
			type: 'POST',
			data: {"id_curso":arg_id, "fecha":arg_fecha},
			url: '../'+ls_url+'?opcion=borrar_informacion',
			success: function(ls_response){
				try{
					la_resp = JSON.parse(ls_response);
					if(la_resp.retorna == 1){
						alert(la_resp.mensaje);
						location.reload();
					}else{
						alert(la_resp.mensaje);
					}
				}catch(ls_error){
					console.log(ls_response);
					alert("Ocurrió un error inesperado: "+ls_error);
				}
			}
		});
	}
}

function f_guardarSeleccion(){
	ls_valores = '';
	la_date = $("#fecha_curso").val();
	$('input[name="chk_curso[]"]:checked').each(function() {
		ls_valores += $(this).val() + ",";
	});

	if(ls_valores == ''){
		alert("Seleccione al menos un curso o certificación para continuar.");
	}else{
		ls_valores = ls_valores.substring(0, ls_valores.length-1);
	}

	if(confirm("Los cursos y certificaciones seleccionados se agregarán a la fecha: «"+la_date+"» , ¿desea continuar?")){
		$.ajax({
			type: 'POST',
			data: {"cursos":ls_valores, "fecha":la_date},
			url: '../'+ls_url+'?opcion=guardar_cursos',
			success: function(ls_response){
				try{
				la_resp = JSON.parse(ls_response);
				if(la_resp.retorna == 1){
					alert(la_resp.mensaje);
					//location.reload();
				}else{
					alert(la_resp.mensaje);
				}
			}catch(ls_error){
				console.log(ls_response);
				alert("Ocurrió un error inesperado: "+ls_error);
			}
			}
		});
	}else{
		return;
	}
}

function f_mostrarInformacion(ls_date){
	$("#cursos-certificaciones-info").html('<p>Se está cargando la información. Por favor espere...</p>');
	$("#date-txt").html(ls_date);
    $("#fecha_curso").val(ls_date);
    $("#cursos-certificaciones").modal('show');
    
    /*$('#cursos-certificaciones').on('hidden.bs.modal', function (e) {
    	location.reload();
	});*/
	$.ajax({
		type: 'POST',
		url: '../'+ls_url+'?opcion=muestra_informacion',
		success: function(ls_response){
			try{
				la_resp = JSON.parse(ls_response);
				if(la_resp.retorna == 1){
					$("#cursos-certificaciones-info").html(la_resp.informacion);
					$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		                checkboxClass: 'icheckbox_minimal-blue',
		                radioClass: 'iradio_minimal-blue'
		            });
		            //Red color scheme for iCheck
		            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		                checkboxClass: 'icheckbox_minimal-red',
		                radioClass: 'iradio_minimal-red'
		            });
				}else{
					alert(la_resp.mensaje);
				}
			}catch(ls_error){
				console.log(ls_response);
				alert("Ocurrió un error inesperado: "+ls_error);
			}
		}
	});
}