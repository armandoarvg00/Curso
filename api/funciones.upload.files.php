<?php
function base64_to_jpeg($base64_string, $output_file)
{
    $ifp  = fopen($output_file, "wb");
    $data = explode(',', $base64_string);
    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp);
    return $output_file;
}

function f_subir_archivo($la_dataIn, &$arg_mensaje)
{
    $ls_ruta = "../uploads/" . $la_dataIn['id_empresa'] . "/portadas/" . $la_dataIn['page'] . "/";
    if (!file_exists($ls_ruta)) {
        if (!mkdir($ls_ruta, 0777, true)) {
            $arg_mensaje = 'Error fatal, falló la creación de directorios';
            return -1;
        }
    }

    $ls_fecha_checada = date('Y-m-d H:i:s');
    $ls_path          = $ls_ruta . base64_encode(str_replace(' ', '', $ls_fecha_checada)) . '.jpg';
    if ($la_dataIn['path_portada'] != '../img/upload_portada.jpg') {
        base64_to_jpeg($la_dataIn['path_portada'], $ls_path);
    }

    $la_dataRead         = array();
    $la_dataRead['path'] = $ls_path;

    $la_carpeta      = explode('/', $_SERVER['PHP_SELF']);
    $ls_rutaAbsoluta = 'http://' . $_SERVER['SERVER_NAME'] . '/impulso/impulse/' . str_replace('../', '', $la_dataRead['path']);
    $arg_mensaje     = $ls_rutaAbsoluta;
    return 1;
}
