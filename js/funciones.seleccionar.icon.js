$(document).ready(function(){
	$(".fontawesome-icon-list .col-md-3").click(function(){
		lo_icon = this.firstChild;
		ls_clases = $(lo_icon).attr("class");
		la_class = ls_clases.split(' ');
		ls_class = la_class[2];
		$("#"+$("#icono_destino").val()).removeAttr("class").attr("class", "fa "+ls_class);
		$("#"+$("#punto_destino").val()).val(ls_class);
	});
});
function f_abrirIconos(arg_elemento){
	ls_icono_destino = $(arg_elemento).data("icon-destino");
	ls_punto_destino = $(arg_elemento).data("punto-destino");
	ls_class_original = $(arg_elemento).data("class-original");

	$("#icono_destino").val(ls_icono_destino);
	$("#punto_destino").val(ls_punto_destino);
	$("#clase_original").val(ls_class_original);

	$("#modal_icons").modal('show');
}