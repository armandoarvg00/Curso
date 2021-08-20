<?php
 class ModelSite
 {
    protected $conexion;
    private $id_empresa;
    private $id_pagina;
    private $seccion;
    private $id_categoria;
    private $id_curso;
    private $criterio;
    private $suscribe;
    private $id_servicio;
    
    public function __construct($la_arguments = array()){
        $this->id_empresa = Config::$mvc_id_empresa;
        if(isset($la_arguments)){
            $this->id_pagina = $la_arguments['id_pagina'];
        }
        if(isset($la_arguments['seccion'])){
            $this->seccion = $la_arguments['seccion'];
        }else{
            $this->seccion = NULL;
        }

        if(isset($la_arguments['id_categoria'])){
            $this->id_categoria = $la_arguments['id_categoria'];
        }else{
            $this->id_categoria = NULL;
        }

        if(isset($la_arguments['id_curso'])){
            $this->id_curso = $la_arguments['id_curso'];
        }else{
            $this->id_curso = NULL;
        }

        if(isset($la_arguments['id_servicio'])){
            $this->id_servicio = $la_arguments['id_servicio'];
        }else{
            $this->id_servicio = NULL;
        }

        if(isset($la_arguments['criterio'])){
            $this->criterio = $la_arguments['criterio'];
        }else{
            $this->criterio = NULL;
        }

        if(isset($la_arguments['suscribe'])){
            $this->suscribe = true;
        }else{
            $this->suscribe = false;
        }

    }

    public function eventosCalendario(){
        $ls_events = '';
        $ls_events .= 'events: [';
        $ls_curso = '';
        $la_dataPage = array();
        if($this->showCursosCalendarioHome($la_dataPage, $la_dataEvents, $arg_mensaje) <0){
            $params['mensaje'] = $arg_mensaje;
            $ls_curso = '';
        }else{
            if(count($la_dataEvents) > 0){
                $ls_eventos_string = '';
                $ls_tipo_publicacion = '';
                foreach($la_dataEvents as $evento){
                    if($evento['tipo_publicacion'] == 0){
                        $ls_tipo_publicacion = 'certificaciones';
                    }else{
                        $ls_tipo_publicacion = 'cursos';
                    }
                    $ls_eventos_string .= "{
                                        id: '".$evento['id_curso']."',
                                        title: '".$evento['titulo']."',
                                        start: '".$evento['fecha']."',
                                        color: '".$evento['color']."',
                                        url: 'index.php?seccion=".$ls_tipo_publicacion."&id_curso=".$evento['id_curso']."'
                                    },";
                }
                $ls_curso .= trim($ls_eventos_string, ',');
            }else{
                $ls_curso = '';
            }
        }
        $ls_events .= $ls_curso;
        $ls_events .= '],';
        return $ls_events;
    }

    public function showConsultoriaPage(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT
                        servicios.id_servicio,
                        servicios.titulo,
                        servicios.introduccion,
                        servicios.descripcion,
                        servicios.path_portada,
                        servicios.status 
                     FROM 
                        servicios 
                        INNER JOIN categorias
                            ON(categorias.id_empresa = servicios.id_empresa)
                            AND (categorias.id_categoria = servicios.id_categoria)
                    WHERE 
                        (servicios.id_empresa = '".$this->id_empresa."') 
                        AND (servicios.status = 1) 
                        AND (categorias.status = 1)";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_dataPage;
        return 1;
    }

    public function showCursosCalendarioHome($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT
                        fechas.id_curso,
                        CAST(fechas.fecha AS date) as fecha,
                        fechas.color,
                        cursos.titulo,
                        cursos.tipo_publicacion
                     FROM
                        fechas_cursos as fechas
                     INNER JOIN cursos_certificaciones as cursos
                        ON (cursos.id_empresa = fechas.id_empresa)
                        AND (cursos.id_curso = fechas.id_curso)
                     WHERE
                        (cursos.id_empresa = '".$this->id_empresa."')
                        AND (cursos.tipo_publicacion IN(0,1))
                        AND (status = 1)
                     ";
        if(f_SQL($ls_script, $la_null, $la_cursos, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar cursos en calendario: '.$ls_mensaje;
           return -1;
        }
        $la_dataOut = $la_cursos;
    }

    public function suscribir($la_dataIn, &$arg_mensaje){
        $ls_script = "SELECT COUNT(1) AS total FROM sucriptores WHERE (id_empresa = '".$this->id_empresa."') AND (mail = '".$la_dataIn['mail']."') ";
        if(f_SQL($ls_script, $la_null, $la_count, $ls_msj) < 0){
            $arg_mensaje = $ls_msj;
            return -1;
        }

        if($la_count[0]['total'] > 0){
            $ls_update = "UPDATE 
                            sucriptores
                            SET
                                nombre = '".$la_dataIn['nombre']."',
                                telefono =  '".$la_dataIn['telefono']."'
                            WHERE 
                                (id_empresa = '".$this->id_empresa."') 
                                AND (mail = '".$la_dataIn['mail']."') ";
            if(f_SQL($ls_update, $la_null_up, $la_count, $ls_msj) < 0){
                $arg_mensaje = $ls_msj;
                return -1;
            }

            $arg_mensaje = 'Se actualizó correctamente';

            $la_dataMail = array();
            $la_dataMail['mensaje'] = '<b>Se actuzalizó la información del suscriptor</b> <br><br>
                                        Mail: '.$la_dataIn['mail'].'<br>
                                        ';
            $la_dataMail['mail_destinatario'] = 'suscripcion@impulseits.com';
            $la_dataMail['nombre_destinatario'] = 'Impulse ITS::.. Suscripciones';

            if(f_mail($la_dataMail, $la_dataOut, $ls_msg) < 0){
                $arg_mensaje = $ls_msj;
                return -1;
            }


            return 1;
        }else{
            $ls_script = "SELECT IFNULL(MAX(id_suscriptor), 0) + 1 as suscriptor FROM sucriptores WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_script, $la_null, $la_max, $ls_msj) < 0){
                $arg_mensaje = $ls_msj;
                return -1;
            }

            $ls_insert = "INSERT INTO 
                            sucriptores
                                (
                                id_empresa,
                                id_suscriptor,
                                nombre,
                                mail,
                                telefono,
                                status,
                                fecha_alta
                                )
                            VALUES
                                (
                                '".$this->id_empresa."',
                                '".$la_max[0]['suscriptor']."',
                                '".$la_dataIn['nombre']."',
                                '".$la_dataIn['mail']."',
                                '".$la_dataIn['telefono']."',
                                1,
                                NOW()
                                )";
            if(f_SQL($ls_insert, $la_null_insert, $la_insert, $ls_msj) < 0){
                $arg_mensaje = $ls_msj;
                return -1;
            }
            $arg_mensaje = 'Se agregó correctamente';


            $la_dataMail = array();
            $la_dataMail['mensaje'] = '<b>Nuevo suscriptor</b> <br><br>
                                        Nombre: '.$la_dataIn['nombre'].'
                                        Mail: '.$la_dataIn['mail'].'<br>
                                        ';
            $la_dataMail['mail_destinatario'] = 'suscripcion@impulseits.com';
            $la_dataMail['nombre_destinatario'] = 'Impulse ITS::.. Suscripciones';

            if(f_mail($la_dataMail, $la_dataOut, $ls_msg) < 0){
                $arg_mensaje = $ls_msj;
                return -1;
            }


            return 1;
        }
    }

    public function nuevoMensaje($la_dataIn, &$arg_mensaje){
        $lo_general = new ModelGeneral();        
        $la_informacion = $lo_general->limpiarDatosForm($la_dataIn);
        $ls_script = "SELECT IFNULL(MAX(id_mensaje), 0) + 1 as clave_mensaje FROM mensajes WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_null, $la_max, $ls_msj) < 0){
            $arg_mensaje = $ls_msj;
            return -1;
        }

        if(isset($la_informacion['empresa'])){
            $la_informacion['empresa'] = str_replace('"', '', str_replace("'","", $la_informacion['empresa']));
        }else{
            $la_informacion['empresa'] = NULL;
        }

        if(isset($la_informacion['celular'])){
            $la_informacion['celular'] = str_replace('"', '', str_replace("'","", $la_informacion['celular']));
        }else{
            $la_informacion['celular'] = NULL;
        }

        if(isset($la_informacion['curso'])){
            $la_informacion['curso'] = str_replace('"', '', str_replace("'","", $la_informacion['curso']));
        }else{
            $la_informacion['curso'] = NULL;
        }

        $ls_insert = "INSERT INTO 
                            mensajes
                                (  
                                id_empresa,
                                id_mensaje,
                                nombre,
                                mail,
                                asunto,
                                telefono,
                                mensaje,
                                empresa,
                                celular,
                                curso,
                                fecha_alta,
                                status,
                                como_se_entero
                                )
                            VALUES
                                (
                                '".$this->id_empresa."',
                                '".$la_max[0]['clave_mensaje']."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['nombre']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['mail']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['asunto']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['telefono']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['mensaje']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['empresa']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['celular']))."',
                                '".str_replace('"', '', str_replace("'","", $la_informacion['curso']))."',
                                NOW(),
                                1,
                                '".$la_informacion['como_se_entero']."'
                                )";
        
        if(f_SQL($ls_insert, $la_nullos, $la_insert, $ls_msj) < 0){
            $arg_mensaje = $ls_msj;
            return -1;
        }

        /*Inicia autorespuesta*/
        $ls_html = '<body style="background: #E9E9E9;">
                        <div style="width:480px; height: auto; padding: 10px; background: #FFF; margin: 0px auto 0px;">
                            <a href="http://impulseits.com"><img src="http://impulseits.com/img/mail-head.jpg" style="margin-bottom: 15px; border: none;" /></a>
                            
                            <h1 align="center" style="margin-bottom: 8px;">¡Mensaje recibido!</h1> 
                           
                            <p align="justify" style="font-size: 14px; color: #333; margin-bottom: 50px;">
                                <b>Gracias por Inscribirse al Curso: 
                                <strong>"Ataques y Desarrollo Seguro de Aplicaciones Web". 
                                </strong> <br><br> 
                               A la brevedad nos pondremos en contacto con usted para darle detalles de las formas de pago y el precio del curso junto con su descuento por pronto pago.<br><br>
                               Dando click <a href="https://youtu.be/2Nx9F9Q7-C4">Aquí</a> podrá ver el webinar de una muestra del curso.<br><br>
Le agradecemos la confianza por elegirnos.<br><br>
Atentamente Impulse ITS.
</b>
                            </p>                            
                            <p style="font-size: 14px; color: #333;  margin-bottom: 30px;">
                                
                            </p>                            
                            <p align="center" style="margin-bottom: 30px;">
                                <a href="https://impulseits.com" style="padding: 20px; background: #88bc18; color: #F87; font-size: 18px; font-weight: bold; display: block; width: 180px; text-decoration: none;">Impulse ITS</a>
                            </p>
                        </div>
                        <div style="width:480px; height: auto; padding: 10px; color: #999; margin: 0px auto 0px; font-size: 10px; text-align:center;">
                            '.date('Y').' Todos los derechos reservados | Impulse ITS <br />
                            Este correo fue enviado automáticamente a <b>'.$la_informacion['nombre'].'</b>
                        </div>
                    </body>';
        
        $la_dataMail['mensaje'] = $ls_html;
        $la_dataMail['mail_destinatario'] = $la_informacion['mail'];
        $la_dataMail['nombre_destinatario'] = $la_informacion['nombre'];

        if(f_mail($la_dataMail, $la_dataOut, $ls_msg) < 0){
            $arg_mensaje = $ls_msj;
            return -1;
        }

        $ls_contenido = '';

        if(isset($la_informacion['empresa']) && strlen($la_informacion['empresa']) > 0){
            $ls_contenido .= '<b>Nombre:</b> '.$la_informacion['empresa'].'<br>';
        }

        if(isset($la_informacion['celular']) && strlen($la_informacion['celular']) > 0){
            $ls_contenido .= '<b>Celular:</b> '.$la_informacion['celular'].'<br>';
        }

        if(isset($la_informacion['curso']) && strlen($la_informacion['curso']) > 0){
            $ls_contenido .= '<b>Curso / Certificación:</b> '.$la_informacion['curso'].'<br>';
        }
        /*Enviar mensaje a Impulse*/
        $ls_html = '<body style="background: #E9E9E9;">
                        <div style="width:480px; height: auto; padding: 10px; background: #FFF; margin: 0px auto 0px;">
                            <a href="http://impulseits.com"><img src="http://impulseits.com/img/mail-head.jpg" style="margin-bottom: 15px; border: none;" /></a>
                            <h1 align="center" style="margin-bottom: 10px;">¡Mensaje recibido!</h1>
                            <p align="justify" style="font-size: 14px; color: #333; margin-bottom: 50px;">
                                Se ha recibido un nuevo mensaje con la siguiente información: 
                            </p>                            
                            <p style="font-size: 14px; color: #333;  margin-bottom: 30px;">
                                <b>Nombre:</b> '.$la_informacion['nombre'].'<br>
                                <b>Mail:</b> '.$la_informacion['mail'].'<br>
                                <b>Asunto:</b> '.$la_informacion['asunto'].'<br>
                                <b>Teléfono:</b> '.$la_informacion['telefono'].'<br>
                                <b>Mensaje:</b> <br>" '.$la_informacion['mensaje'].' " <br>
                            </p>                            
                        </div>
                        <div style="width:480px; height: auto; padding: 10px; color: #999; margin: 0px auto 0px; font-size: 10px; text-align:center;">
                            '.date('Y').' Todos los derechos reservados | Impulse ITS <br />
                            Este correo fue enviado automáticamente a info@impulseits.comº</b>
                        </div>
                    </body>';
        $la_dataMail = array();
        $la_dataMail['mensaje'] = $ls_html;
        $la_dataMail['mail_destinatario'] = 'info@impulseits.com';
        $la_dataMail['nombre_destinatario'] = 'Impulse ITS';

        if(f_mail($la_dataMail, $la_dataOut, $ls_msg) < 0){
            $arg_mensaje = $ls_msj;
            return -1;
        }
    }

    public function showCategorias(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT id_categoria, categoria, descripcion FROM categorias WHERE (id_empresa = '".$this->id_empresa."') AND (tipo = '".$this->seccion."') AND (status = 1)";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
        
        if(count($la_dataPage) > 0){
            $la_dataOut['categorias'] = $la_dataPage;
        }else{
            $la_dataOut['categorias'] = array();
        }
    }
    
    public function showFullServicio(&$la_dataOut, &$arg_mensaje){
        $ls_where = "";

        if($this->id_servicio <> NULL){
            $ls_where .= " AND (servicios.id_servicio = ".$this->id_servicio.")";
        }

        $ls_script = "SELECT 
                        servicios.id_servicio,
                        servicios.titulo,
                        servicios.introduccion,
                        servicios.descripcion,
                        servicios.path_portada,
                        categorias.descripcion as categoria_desc
                    FROM 
                        servicios
                        INNER JOIN categorias
                            ON(categorias.id_empresa = servicios.id_empresa)
                            AND (categorias.id_categoria = servicios.id_categoria)
                    WHERE 
                        (servicios.id_empresa = '".$this->id_empresa."')  
                        AND (servicios.status = 1)
                        AND (categorias.status = 1)
                        ".$ls_where;
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataPage[0]['introduccion'] = $this->replaceList($la_dataPage[0]['introduccion']);
            $la_dataPage[0]['descripcion'] = $this->replaceList($la_dataPage[0]['descripcion']);
            $la_dataOut['servicio'] = $la_dataPage[0];
        }else{
            $la_dataOut['servicio'] = array();
        }
    }

    public function showFullEntrada(&$la_dataOut, &$arg_mensaje){
        $ls_where = "";

        if($this->id_curso <> NULL){
            $ls_where .= " AND (blog.id_curso = ".$this->id_curso.")";
        }

        $ls_script = "SELECT 
                        blog.id_curso, 
                        blog.titulo, 
                        blog.path_portada, 
                        DATE_FORMAT(blog.fecha_alta, '%y') as anio_fecha,
                        DATE_FORMAT(blog.fecha_alta, '%d') as dia_fecha,
                        DAYOFWEEK(blog.fecha_alta) as dia,
                        MONTH(blog.fecha_alta) as mes,
                        blog.introduccion,
                        blog.user_alta,
                        blog.id_categoria,
                        blog.descripcion,
                        categorias.categoria,
                        usuarios.nombre as nombre_usuario
                    FROM 
                        cursos_certificaciones blog
                        INNER JOIN categorias
                            ON (categorias.id_empresa = blog.id_empresa)
                            AND (categorias.id_categoria = blog.id_categoria)
                        INNER JOIN usuarios
                            ON (usuarios.id_empresa = blog.id_empresa)
                            AND (usuarios.id_usuario = blog.user_alta)
                    WHERE 
                        (blog.id_empresa = '".$this->id_empresa."') 
                        AND (blog.tipo_publicacion = 2)  
                        AND (blog.status = 1)
                        ".$ls_where;
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataPage[0]['introduccion'] = $this->replaceList($la_dataPage[0]['introduccion']);
            $la_dataPage[0]['descripcion'] = $this->replaceList($la_dataPage[0]['descripcion']);
            $la_dataOut['entrada'] = $la_dataPage[0];
        }else{
            $la_dataOut['entrada'] = array();
        }
    }

    private function replaceList($arg_elemento){
        $la_replace = array('<ul', '<li>');
        $la_replace_with = array('<ul class="e-color-list" ', '<li><i class="glyphicon glyphicon-check"></i> ');
        return str_replace($la_replace, $la_replace_with, $arg_elemento);
    }
    
    public function showEntradas(&$la_dataOut, &$arg_mensaje){        
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 10;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina;
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar; 
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_where = "";

        if(($this->id_categoria <> NULL) && ($this->seccion == 'blog') ){
            $ls_where .= " AND (blog.id_categoria = ".$this->id_categoria.")";
        }

        $ls_script = "SELECT 
                        count(1) as total
                      FROM 
                        cursos_certificaciones blog
                        INNER JOIN categorias
                            ON (categorias.id_empresa = blog.id_empresa)
                            AND (categorias.id_categoria = blog.id_categoria)  
                      WHERE 
                        (blog.id_empresa = '".$this->id_empresa."') 
                        AND (blog.tipo_publicacion = 2) 
                        AND (blog.status = 1)
                        AND (categorias.status = 1)  
                        ".$ls_where." 
                        ORDER BY blog.id_curso DESC ";

        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }

        if($this->seccion == ''){
            $ls_limit = " {paginar(1,6)} ";
        }else{
            $ls_limit = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")}";
        }

        $ls_script = "SELECT 
                        blog.id_curso, 
                        blog.titulo, 
                        blog.path_portada, 
                        DATE_FORMAT(blog.fecha_alta, '%y') as anio_fecha,
                        DATE_FORMAT(blog.fecha_alta, '%d') as dia_fecha,
                        DAYOFWEEK(blog.fecha_alta) as dia,
                        MONTH(blog.fecha_alta) as mes,
                        blog.introduccion,
                        blog.user_alta,
                        blog.id_categoria,
                        categorias.categoria,
                        usuarios.nombre as nombre_usuario
                    FROM 
                        cursos_certificaciones blog
                        INNER JOIN categorias
                            ON (categorias.id_empresa = blog.id_empresa)
                            AND (categorias.id_categoria = blog.id_categoria)
                            AND (categorias.status = 1)  
                        INNER JOIN usuarios
                            ON (usuarios.id_empresa = blog.id_empresa)
                            AND (usuarios.id_usuario = blog.user_alta)
                    WHERE 
                        (blog.id_empresa = '".$this->id_empresa."') 
                        AND (blog.tipo_publicacion = 2) 
                        AND (blog.status = 1)
                        ".$ls_where." 
                        ORDER BY blog.id_curso DESC ".$ls_limit;
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
        
        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 2;
        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al paginar resultados: '.$ls_mensaje;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataOut['paginacion'] = $ls_pag;
            $la_dataOut['entradas'] = $la_dataPage;
        }else{
            $la_dataOut['entradas'] = array();
            $la_dataOut['paginacion'] = array();
        }
    }

    public function showWebinar(&$la_dataOut, &$arg_mensaje){
        if($this->seccion == ''){
            $ls_limit = " LIMIT 10 ";
        }else{
            $ls_limit = " ";
        }
        $ls_where = "";

        if(($this->id_categoria <> NULL) && ($this->seccion == 'cursos') ){
            $ls_where .= " AND (id_categoria = ".$this->id_categoria.")";
        }

        if(($this->criterio <> NULL) && ($this->seccion == 'cursos') ){
            $ls_where .= " AND ( 
                                    (titulo LIKE '%".$this->criterio."%') OR 
                                    (introduccion LIKE '%".$this->criterio."%') OR 
                                    (descripcion LIKE '%".$this->criterio."%') 
                                )";
        }

        $ls_script = "SELECT 
                        id_curso, 
                        titulo, 
                        path_portada, 
                        DATE_FORMAT(fecha_inicia, '%y') as anio_fecha,
                        DATE_FORMAT(fecha_inicia, '%d') as dia_fecha,
                        DAYOFWEEK(fecha_inicia) as dia,
                        MONTH(fecha_inicia) as mes,
                        CAST(fecha_inicia AS DATE) fecha_inicia,
                        introduccion
                    FROM 
                        cursos_certificaciones 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (tipo_publicacion = 3) 
                        AND (status = 1)
                        AND ( (CAST(NOW() AS DATE) < CAST(fecha_inicia AS DATE)) OR (fecha_inicia IS NULL) ) 
                        ".$ls_where." 
                        ORDER BY IFNULL(secuencia, 999999) ASC, id_curso DESC ".$ls_limit;

        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
        
        if(count($la_dataPage) > 0){
            $la_dataOut['webinars'] = $la_dataPage;
        }else{
            $la_dataOut['webinars'] = array();
        }
    }

    public function showCursos(&$la_dataOut, &$arg_mensaje){
        if($this->seccion == ''){
            $ls_limit = " LIMIT 6 ";
        }else{
            $ls_limit = " ";
        }
        $ls_where = "";

        if(($this->id_categoria <> NULL) && ($this->seccion == 'cursos') ){
            $ls_where .= " AND (id_categoria = ".$this->id_categoria.")";
        }

        if(($this->criterio <> NULL) && ($this->seccion == 'cursos') ){
            $ls_where .= " AND ( 
                                    (titulo LIKE '%".$this->criterio."%') OR 
                                    (introduccion LIKE '%".$this->criterio."%') OR 
                                    (descripcion LIKE '%".$this->criterio."%') 
                                )";
        }

        $ls_script = "SELECT 
                        id_curso, 
                        titulo, 
                        path_portada, 
                        DATE_FORMAT(fecha_inicia, '%y') as anio_fecha,
                        DATE_FORMAT(fecha_inicia, '%d') as dia_fecha,
                        DAYOFWEEK(fecha_inicia) as dia,
                        MONTH(fecha_inicia) as mes,
                        introduccion
                    FROM 
                        cursos_certificaciones 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (tipo_publicacion = 1) 
                        AND (status = 1)
                        AND ( (CAST(NOW() AS DATE) < CAST(fecha_inicia AS DATE)) OR (fecha_inicia IS NULL) ) 
                        ".$ls_where." 
                        ORDER BY IFNULL(secuencia, 999999) ASC, id_curso DESC ".$ls_limit;

        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
        
        if(count($la_dataPage) > 0){
            $la_dataOut['cursos'] = $la_dataPage;
        }else{
            $la_dataOut['cursos'] = array();
        }
    }

    public function showFullCertificacion(&$la_dataOut, &$arg_mensaje){
        $ls_where = "";

        if($this->id_curso <> NULL){
            $ls_where .= " AND (certificacion.id_curso = ".$this->id_curso.")";
        }

        $ls_script = "SELECT 
                        certificacion.id_curso, 
                        certificacion.titulo, 
                        certificacion.path_portada, 
                        DATE_FORMAT(certificacion.fecha_inicia, '%y') as anio_fecha,
                        DATE_FORMAT(certificacion.fecha_inicia, '%d') as dia_fecha,
                        DAYOFWEEK(certificacion.fecha_inicia) as dia,
                        MONTH(certificacion.fecha_inicia) as mes,
                        certificacion.introduccion,
                        certificacion.descripcion,
                        certificacion.objetivos,
                        certificacion.caracteristicas,
                        certificacion.dirigido,
                        certificacion.pre_requisitos,
                        certificacion.porque_tomarlo,
                        certificacion.material,
                        certificacion.temario,
                        certificacion.precio,
                        certificacion.paypal,
                        certificacion.mes0,
                        certificacion.desc__,
                        certificacion.mes3,
                        certificacion.mes6,
                        certificacion.mes9,
                        certificacion.mes12,
                        certificacion.duracion,
                        certificacion.id_instructor,
                        certificacion.otras_notas,
                        instructores.nombre,
                        instructores.informacion,
                        instructores.path_portada as foto_instructor
                    FROM 
                        cursos_certificaciones certificacion
                        LEFT OUTER JOIN instructores 
                            ON (instructores.id_empresa = certificacion.id_empresa)
                            AND (instructores.id_instructor = certificacion.id_instructor)
                    WHERE 
                        (certificacion.id_empresa = '".$this->id_empresa."') 
                        AND (certificacion.status = 1)
                        ".$ls_where;
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataPage[0]['introduccion'] = $this->replaceList($la_dataPage[0]['introduccion']);
            $la_dataPage[0]['descripcion'] = $this->replaceList($la_dataPage[0]['descripcion']);
            $la_dataPage[0]['caracteristicas'] = $this->replaceList($la_dataPage[0]['caracteristicas']);
            $la_dataPage[0]['pre_requisitos'] = $this->replaceList($la_dataPage[0]['pre_requisitos']);
            $la_dataPage[0]['porque_tomarlo'] = $this->replaceList($la_dataPage[0]['porque_tomarlo']);
            $la_dataPage[0]['objetivos'] = $this->replaceList($la_dataPage[0]['objetivos']);
            $la_dataPage[0]['material'] = $this->replaceList($la_dataPage[0]['material']);
            $la_dataPage[0]['temario'] = $this->replaceList($la_dataPage[0]['temario']);
            $la_dataPage[0]['dirigido'] = $this->replaceList($la_dataPage[0]['dirigido']);

            $la_dataOut['certificacion'] = $la_dataPage[0];
        }else{
            $la_dataOut['certificacion'] = array();
        }

        $ls_script = "SELECT * FROM subtitulos WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_null, $la_dataSubtitulos, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
        $la_dataOut['subtitulos'] = $la_dataSubtitulos[0];
    }

    public function showCertificaciones(&$la_dataOut, &$arg_mensaje){
        if($this->seccion == ''){
            $ls_limit = " LIMIT 6 ";
        }else{
            $ls_limit = "  ";
        }

        $ls_where = "";

        if($this->id_categoria <> NULL && $this->seccion == 'certificaciones'){
            $ls_where .= " AND (id_categoria = ".$this->id_categoria.")";
        }

        if(($this->criterio <> NULL) && ($this->seccion == 'certificaciones') ){
            $ls_where .= " AND ( 
                                    (titulo LIKE '%".$this->criterio."%') OR 
                                    (introduccion LIKE '%".$this->criterio."%') OR 
                                    (descripcion LIKE '%".$this->criterio."%')  
                                )";
        }

        $ls_script = "SELECT 
                        id_curso, 
                        titulo, 
                        path_portada, 
                        DATE_FORMAT(fecha_inicia, '%y') as anio_fecha,
                        DATE_FORMAT(fecha_inicia, '%d') as dia_fecha,
                        DAYOFWEEK(fecha_inicia) as dia,
                        MONTH(fecha_inicia) as mes,
                        introduccion
                    FROM 
                        cursos_certificaciones 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (tipo_publicacion = 0) 
                        AND (status = 1) 
                        AND ( (CAST(NOW() AS DATE) < CAST(fecha_inicia AS DATE)) OR (fecha_inicia IS NULL) ) 
                        ".$ls_where." 
                        ORDER BY IFNULL(secuencia, 999999) ASC, id_curso DESC ".$ls_limit;
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataOut['certificaciones'] = $la_dataPage;
        }else{
            $la_dataOut['certificaciones'] = array();
        }
    }

    public function showSliders($la_dataIn, &$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT 
                        texto,
                        titulo,
                        path_portada
                    FROM 
                        sliders
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (status = 1)
                        AND (tipo_slider = ".$la_dataIn['tipo_slider'].")
                        ORDER BY id_slider DESC ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataOut['sliders'] = $la_dataPage;
        }else{
            $la_dataOut['sliders'] = array();
        }
    }

    public function showPartners(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT 
                        id_empresa,
                        id_partner,
                        nombre,
                        path_portada
                    FROM 
                        partners 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (status = 1)
                        ORDER BY fecha_alta DESC";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataOut['partners'] = $la_dataPage;
        }else{
            $la_dataOut['partners'] = array();
        }
    }

    public function showTestimonios(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT 
                        id_empresa,
                        id_testimonio,
                        nombre,
                        puesto,
                        testimonio
                    FROM 
                        testimonios 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (status = 1)
                        ORDER BY id_testimonio DESC LIMIT 30";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        if(count($la_dataPage) > 0){
            $la_dataOut['testimonios'] = $la_dataPage;
        }else{
            $la_dataOut['testimonios'] = array();
        }
    }

    public function showInstructores(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT id_instructor, nombre, informacion, path_portada  FROM instructores WHERE (id_empresa = '".$this->id_empresa."') AND (status = 1) ORDER BY id_instructor DESC LIMIT 9";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut['instructores'] = $la_dataPage;
    }

    public function showConfiguracionSitio(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT * FROM configuracion_sitio WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }


        $ls_script = "SELECT 
                        fechas.id_curso,
                        CAST(fechas.fecha AS DATE) as fecha_inicia,
                        cursos.titulo,
                        cursos.tipo_publicacion
                    FROM 
                        fechas_cursos fechas
                        INNER JOIN cursos_certificaciones cursos
                            ON (cursos.id_curso = fechas.id_curso)
                            AND (cursos.id_empresa = fechas.id_empresa)
                    WHERE
                        (fechas.id_empresa = '".$this->id_empresa."')
                        AND (cursos.tipo_publicacion IN(0,1) )
                        AND (cursos.status = 1)
                        AND (fechas.fecha > NOW())
                        ORDER BY fechas.fecha ASC LIMIT 6 ";
        if(f_SQL($ls_script, $la_null, $la_dataCursos, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }


        $ls_script = "SELECT   
                        titulo,
                        tipo_publicacion,
                        secuencia
                    FROM 
                        cursos_certificaciones 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (tipo_publicacion IN(0,1))
                        AND (status = 1) 
                    ORDER BY tipo_publicacion DESC, {esnulo(secuencia, 99999)} ASC";
        if(f_SQL($ls_script, $la_null, $la_dataCursosCertificaciones, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $ls_script = "SELECT 
                        id_categoria, 
                        descripcion,
                        tipo
                    FROM 
                        categorias 
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (tipo IN('certificaciones', 'cursos'))
                        AND (status = 1)";
        if(f_SQL($ls_script, $la_null, $la_mainCategorias, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }


        $ls_script = "SELECT 
                        tag,
                        descripcion
                    FROM 
                        menu
                    WHERE 
                        (id_empresa = '".$this->id_empresa."') 
                        AND (status = 1) 
                        ORDER BY secuencia ASC";
        if(f_SQL($ls_script, $la_null, $la_menuPrincipal, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_dataPage[0];
        $la_dataOut['ultimos_cursos'] = $la_dataCursos;
        $la_dataOut['drop_cursos'] = $la_dataCursosCertificaciones;
        $la_dataOut['categorias_menu'] = $la_mainCategorias;
        $la_dataOut['menu_principal'] = $la_menuPrincipal;
    }

    public function showPageGeneric(&$la_dataOut, &$arg_mensaje){  
        $ls_script = "SELECT * FROM paginas_genericas WHERE (id_empresa = '".$this->id_empresa."') AND (id_pagina = '".$this->id_pagina."') ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_dataPage[0];
    }

    public function showNosotrosPage(&$la_dataOut, &$arg_mensaje){
        $ls_script = "SELECT * FROM nosotros WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataPage[0]['portada_nosotros'] = $la_dataPage[0]['path_portada'];
        $la_dataOut = $la_dataPage[0];
        return 1;
    } 
 }