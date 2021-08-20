var ls_url = '../api/ajax.upload.files.php';
$(document).ready(function(){
	$("#photo").change(function(ev) {	
		handleFileSelect(ev);
	});

	$("#quitar-imagen-destacada").click(function() {	
		f_quitarImagenDestacada();
	});
});

function f_quitarImagenDestacada(){
	ls_data_tipo_imagen = $("#img-preview").attr("data-tipo-imagen");
	if(ls_data_tipo_imagen == 'instructor'){
		$("#img-preview").attr("src", "../img/sin_foto.jpg");
	}else if(ls_data_tipo_imagen == 'partner'){
		$("#img-preview").attr("src", "../img/sin_imagen_partner.jpg");
	}else{
		$("#img-preview").attr("src", "../img/upload_portada.jpg");
	}
	
	$("#path_portada").val('');
}

function handleFileSelect(evt) {
	ls_data_tipo_imagen = ''
	ls_distinguir = $("#path_portada").attr("data-distinguir");
	if(ls_distinguir == 'SI'){
		ls_data_tipo_imagen = ' data-tipo-imagen="instructor" ';
	}
	var files = evt.target.files;

	for (var i = 0, f; f = files[i]; i++) {
	  if (!f.type.match('image.*')) {
		continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  var span = document.createElement('div');
		  span.innerHTML = ['<img class="img-responsive" '+ls_data_tipo_imagen+' id="img-preview" src="', e.target.result, '"/>'].join('');
		  $('.photo-preview').html(span, null);
		  f_subirArchivo();
		};
	  })(f);
	  reader.readAsDataURL(f);
	}
}


function f_subirArchivo(){
	ls_foto =  $(".photo-preview img").attr("src");
	ls_page = $(".photo-preview").attr("data-page");

	$.ajax({
		type: 'POST',
		data: {"page":ls_page, "path_portada":ls_foto},
		url: ls_url+'?opcion=subir_portada',
		success: function (ls_response){
			try{
				la_resp = JSON.parse(ls_response);
				if(la_resp.retorna == 1){
					alert("Se subió correctamente");
					$("#path_portada").val(la_resp.path_portada);
				}else{
					alert(la_resp.mensaje);
				}
			}catch(ls_error){
				console.log(ls_response);
				alert("Ocurrió un error inesperado: "+ls_error);
			}
		}
	})
}