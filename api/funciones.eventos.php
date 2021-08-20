<?php
function f_enviarSugerencia($la_dataIn, &$la_dataOut, &$arg_mensaje){
    $ls_max = "SELECT IFNULL(MAX(id_sugerencia), 0) + 1 as maximo FROM sugerencias WHERE (id_empresa = '".$la_dataIn['id_empresa']."')";
    if(f_SQL($ls_max, $la_null, $la_maximo, $ls_mensaje) < 0){
        $arg_mensaje = $ls_mensaje;
        return -1;
    }
    $ls_script = "INSERT INTO sugerencias
                        (id_empresa, id_sugerencia, nombre, mail, mensaje, fecha_alta)
                    VALUES 
                        (
                            '".$la_dataIn['id_empresa']."',
                            '".$la_maximo[0]['maximo']."',
                            '".str_replace('"', '', str_replace("'","", $la_dataIn['nombre']))."',
                            '".str_replace('"', '', str_replace("'","", $la_dataIn['mail']))."',
                            '".str_replace('"', '', str_replace("'","", $la_dataIn['mensaje']))."',
                            {hoy()}
                            )";
    if(f_SQL($ls_script, $la_nullos, $la_insert, $ls_mensaje) < 0){
        $arg_mensaje = $ls_mensaje;
        return -1;
    }
    $arg_mensaje = '¡Muchas gracias por sus comentarios! Agradecemos infinitamente su retroalimentación.';
    return 1;
}

function f_buscarInformacion($la_dataIn, &$la_dataOut, &$arg_mensaje){
    $li_tipo_publicacion = 0;
    if($la_dataIn['tipo_publicacion'] == 'certificaciones'){
        $li_tipo_publicacion = 0;
    }else{
        $li_tipo_publicacion = 1;
    }
    $ls_script = "SELECT 
                    cursos.id_curso,
                    cursos.titulo
                  FROM
                    fechas_cursos AS fechas
                  INNER JOIN cursos_certificaciones AS cursos
                    ON(cursos.id_empresa = fechas.id_empresa)
                    AND (cursos.id_curso = fechas.id_curso)
                    AND (cursos.tipo_publicacion = '".$li_tipo_publicacion."') 
                  WHERE
                    (fechas.id_empresa = '".$la_dataIn['id_empresa']."')
                    AND (CAST(fechas.fecha AS DATE) = '".$la_dataIn['fecha']."') ";

    if(f_SQL($ls_script, $la_dataDell, $la_cursos, $ls_mensaje) < 0){
        $arg_mensaje = $ls_mensaje;
        return -1;
    }

    $ls_li = '';
    if(count($la_cursos) > 0){
        foreach($la_cursos as $curso){
            $ls_li .= '<li>
                        <a href="index.php?seccion='.$la_dataIn['tipo_publicacion'].'&id_curso='.$curso['id_curso'].'">
                            <i class="glyphicon glyphicon-tag"></i> '.$curso['titulo'].'</a> 
                        </a>
                      </li>';
        }
    }else{
        $ls_li = 'No hay '.$la_dataIn['tipo_publicacion'].' para este fecha';
    }
    $la_dataOut['informacion'] = $ls_li;
    return 1;
}

function f_borrarInformacion($la_dataIn, &$la_dataOut, &$arg_mensaje){
    $ls_delete = "DELETE FROM 
                    fechas_cursos 
                WHERE 
                    (id_empresa = '".$la_dataIn['id_empresa']."') 
                    AND (id_curso = '".$la_dataIn['id_curso']."') 
                    AND (CAST(fecha AS DATE) = '".$la_dataIn['fecha']."')";
    if(f_SQL($ls_delete, $la_dataDell, $la_delete, $ls_mensaje) < 0){
        $arg_mensaje = $ls_mensaje;
        return -1;
    }
    $arg_mensaje = 'Se borró correctamente';
    return 1;
}

function f_guardarInformacion($la_dataIn, &$la_dataOut, &$arg_mensaje){
    $la_cursosBase64 = explode(',', $la_dataIn['cursos']);
    for($li_index = 0; $li_index < count($la_cursosBase64); $li_index++){
        $la_dataCurso = explode('[<>]', base64_decode($la_cursosBase64[$li_index]));

        $ls_id_curso = $la_dataCurso[0];
        $ls_color = $la_dataCurso[1];

        $ls_delete = "DELETE FROM 
                        fechas_cursos 
                    WHERE 
                        (id_empresa = '".$la_dataIn['id_empresa']."') 
                        AND (id_curso = '".$ls_id_curso."') 
                        AND (fecha = '".$la_dataIn['fecha']."') ";
        if(f_SQL($ls_delete, $la_dataDell, $la_delete, $ls_mensaje) < 0){
            $arg_mensaje = $ls_mensaje;
            return -1;
        }

        $ls_insert = "INSERT INTO
                        fechas_cursos
                            (
                            id_empresa,
                            id_curso,
                            fecha,
                            color,
                            fecha_alta,
                            user_alta
                                ) 
                        VALUES
                            (
                            '".$la_dataIn['id_empresa']."',
                            '".$ls_id_curso."',
                            '".$la_dataIn['fecha']."',
                            '".$ls_color."',
                            NOW(),
                            '".$_SESSION['id_usuario']."'  
                            )";
        if(f_SQL($ls_insert, $la_dataInsert, $la_insert, $ls_mensaje) < 0){
            $arg_mensaje = $ls_mensaje;
            return -1;
        }
    }
    $arg_mensaje = 'Se guardaron correctamente';
    return 1;
}

function f_mostrarInformacion($la_dataIn, &$la_dataOut, &$arg_mensaje){
    $ls_script = "SELECT
                    id_curso,
                    titulo,
                    secuencia,
                    tipo_publicacion
                 FROM
                    cursos_certificaciones
                 WHERE
                    (id_empresa = '".$la_dataIn['id_empresa']."')    
                    AND (status = 1) 
                    AND (tipo_publicacion IN(0,1) )                
                 ORDER BY tipo_publicacion ASC, IFNULL(secuencia, 9999999) ASC, fecha_alta DESC ";
    if(f_SQL($ls_script, $la_dataNull, $la_info, $ls_mensaje) < 0){
        $arg_mensaje = $ls_mensaje;
        return -1;
    }

    $ls_html = '';
    if(count($la_info) > 0){
        $li_index = 1;
        $ls_html = '<table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>';
        $ls_tipo = '';
        $ls_color = '';
        $ls_check = '';
        $ls_style = ' style="padding: 5px; border-radius: 10px;" ';
        foreach($la_info as $info){
            if($info['tipo_publicacion'] == 0){
                $ls_tipo = '<i class="fa fa-graduation-cap bg-blue" title="Certificado" '.$ls_style.'></i>';
                $ls_color = '#367cc3';
                $ls_check = '<label>
                              <input type="checkbox" class="minimal" name="chk_curso[]" id="chk_curso'.$li_index.'" value="'.base64_encode($info['id_curso'].'[<>]'.$ls_color).'">
                            </label>';
            }else{
                $ls_tipo = '<i class="fa fa-book bg-red" title="Curso" '.$ls_style.'></i>';
                $ls_color = '#d34b27';
                $ls_check = '<label>
                              <input type="checkbox" class="minimal-red" name="chk_curso[]" id="chk_curso'.$li_index.'" value="'.base64_encode($info['id_curso'].'[<>]'.$ls_color).'">
                            </label>';
            }

            $ls_html .= '<tr>
                            <td>'.$li_index.'</td>
                            <td><b>'.$info['titulo'].'</b></td>
                            <td>'.$ls_tipo.'</td>
                            <td align=center>'.$ls_check.'</td>
                        </tr>';

            $li_index++;
        }
    }else{
        $ls_html = '<div class="alert alert-danger">No se encontraron resultados</div>';
    }
    $la_dataOut['informacion'] = $ls_html;
    return 1;
}
?>