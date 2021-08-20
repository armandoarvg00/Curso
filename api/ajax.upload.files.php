<?php
require_once('funciones.upload.files.php');

$la_dataIn = array();
$la_resultado = array();
$la_dataIn = array_merge($_GET, $_POST);
$la_dataIn['id_empresa'] = 'IMPL';
if($_GET['opcion'] == 'subir_portada'){
    if(f_subir_archivo($la_dataIn, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }else{
        $la_resultado['retorna'] = 1;
        $la_resultado['path_portada'] = $arg_mensaje;
    }
}
echo json_encode($la_resultado);
?>