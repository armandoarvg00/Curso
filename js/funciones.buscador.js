$(document).ready(function(){
	$.expr[':'].icontains = function(obj, index, meta, stack){
    	return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
    };
	
	$("#table_search").keyup(function(){
		buscar = $(this).val();
		ls_target_search = 'table.table';
		if(buscar == ''){
			$(ls_target_search+" #tr-sin-concidencias").remove();
			$(ls_target_search+" tr").show();
		}else if(jQuery.trim(buscar) != ''){
				$(ls_target_search+" tr").hide();
				lo_result = $(ls_target_search+" tr:icontains('" + buscar + "')");
				if(lo_result.length == 0){
					$(ls_target_search+" #tr-sin-concidencias").remove();
					$(ls_target_search).append("<tr id='tr-sin-concidencias'><td colspan='3' align='center'>No se encontraron resultados</td></tr>");
				}
								
				$(ls_target_search+" tr:icontains('" + buscar + "')").show();
		}
	});
});