<?php
session_start();
error_reporting(0);
require_once('../lib/Configs/Config.php');
require_once('../lib/Configs/class.conection.php');
require_once('funciones.eventos.php');

$la_dataIn = array();
$la_resultado = array();
$la_dataIn = array_merge($_GET, $_POST);
$la_dataIn['id_empresa'] = 'IMPL';

if($_GET['opcion'] == 'muestra_informacion'){
    if(f_mostrarInformacion($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }else{
        $la_resultado['retorna'] = 1;
        $la_resultado['informacion'] = $la_dataOut['informacion'];
    }
}elseif($_GET['opcion'] == 'guardar_cursos'){
    if(f_guardarInformacion($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }else{
        $la_resultado['retorna'] = 1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }
}elseif($_GET['opcion'] == 'borrar_informacion'){
    if(f_borrarInformacion($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }else{
        $la_resultado['retorna'] = 1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }
}elseif($_GET['opcion'] == 'buscar_informacion'){
    if(f_buscarInformacion($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
        $la_resultado['mensaje'] = $arg_mensaje;
    }else{
        $la_resultado['retorna'] = 1;
        $la_resultado['informacion'] = $la_dataOut['informacion'];
    }
}elseif($_GET['opcion'] == 'enviar_sugerencia'){
    if(f_enviarSugerencia($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
        $la_resultado['retorna'] = -1;
    }else{
        $la_resultado['retorna'] = 1;
    }
    $la_resultado['mensaje'] = $arg_mensaje;
}

echo json_encode($la_resultado);
?>