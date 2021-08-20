<?php
 class ModelAdmin
 {

    protected $conexion;
    private $id_empresa;
    private $id_pagina;
    private $id_usuario;

    public function __construct($la_arguments = array()){
        $this->id_empresa = Config::$mvc_id_empresa;

        if(isset($_SESSION['id_usuario'])){
            $this->id_usuario = $_SESSION['id_usuario'];
        }

        if(isset($la_arguments['id_pagina'])){
            $this->id_pagina = $la_arguments['id_pagina'];
        }
    }

    public function accionesSliders($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_slider), 0) + 1 as id_slider FROM sliders WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO sliders
                            (
                                id_empresa,
                                id_slider,
                                path_portada,
                                titulo,
                                texto,
                                status,
                                user_alta,
                                fecha_alta,
                                tipo_slider
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_slider,
                                :path_portada,
                                :titulo,
                                :texto,
                                :status,
                                :user_alta,
                                {hoy()},
                                :tipo_slider
                            )";

            $la_data = array();
            $la_data[':id_slider'] = $la_clave[0]['id_slider'];
            $la_data[':titulo'] = $la_dataIn['titulo'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':texto'] = $la_dataIn['texto'];
            $la_data[':status'] = $la_dataIn['status'];
            $la_data[':user_alta'] = $this->id_usuario;
            $la_data[':tipo_slider'] = $la_dataIn['tipo_slider'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE sliders
                                SET
                                    titulo = :titulo,
                                    texto = :texto,
                                    status = :status,
                                    path_portada = :path_portada,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = {hoy()},
                                    tipo_slider = :tipo_slider
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_slider = '".$la_dataIn['id_slider']."')";

            $la_data = array();
            $la_data[':titulo'] = $la_dataIn['titulo'];
            $la_data[':texto'] = $la_dataIn['texto'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];
            $la_data[':tipo_slider'] = $la_dataIn['tipo_slider'];


            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosSlider($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_slider']) ){
            $ls_script = "SELECT * FROM sliders WHERE (id_empresa = '".$this->id_empresa."') AND (id_slider = '".$la_dataIn['id_slider']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion'] = array();
        }

        return 1;
    }

    public function obtieneTodosSliders($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        sliders
                       WHERE
                        (id_empresa = '".$this->id_empresa."')  AND (status IN(0,1) )";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        *
                    FROM
                        sliders
                    WHERE
                        (id_empresa = '". $this->id_empresa."')
                        AND (status IN(0,1) )
                        ORDER BY id_slider DESC ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar sliders: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar sliders: '.$ls_mensaje;
               return -1;
          }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_informacion;
        return 1;
    }

    public function accionesMenu($la_dataIn, &$ls_mensaje){
        for($li_index = 1; $li_index <= count($la_dataIn); $li_index++){
            $ls_update = "UPDATE menu SET secuencia = '".$la_dataIn[$li_index]."' WHERE (id = '".$li_index."')";
            if(f_SQL($ls_update, $la_dataNUll, $la_update, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }
        }
        return 1;
    }

    public function accionesMenuItem($la_dataIn, &$ls_mensaje){
        $li_status = '';
        if($la_dataIn['action'] == 'ocultar'){
            $li_status = 0;
        }else{
            $li_status = 1;
        }
        $ls_update = "UPDATE menu SET status = ".$li_status." WHERE (id = '".$la_dataIn['id']."') AND (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_update, $la_dataNUll, $la_update, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
    }

    public function obtieneMenu($la_arguments, &$la_menu, &$arg_mensaje){
        $ls_max = "SELECT * FROM menu WHERE (id_empresa = '".$this->id_empresa."') ORDER BY secuencia ASC";
        if(f_SQL($ls_max, $la_data, $la_menu, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }
    }
    public function accionesPartners($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_partner), 0) + 1 as id_partner FROM partners WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO partners
                            (
                                id_empresa,
                                id_partner,
                                nombre,
                                path_portada,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_partner,
                                :nombre,
                                :path_portada,
                                :status,
                                '".$this->id_usuario."',
                                NOW()
                            )";

            $la_data = array();
            $la_data[':id_partner'] = $la_clave[0]['id_partner'];
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE partners
                                SET
                                    nombre = :nombre,
                                    path_portada = :path_portada,
                                    status = :status,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW()
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_partner = '".$la_dataIn['id_partner']."')";

            $la_data = array();
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];

            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosPartner($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_partner']) ){
            $ls_script = "SELECT * FROM partners WHERE (id_empresa = '".$this->id_empresa."') AND (id_partner = '".$la_dataIn['id_partner']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_partner'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_partner'] = array();
        }

        return 1;
    }

    public function showTodosPartners($la_dataIn, &$la_dataSal, &$ls_mensaje ){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion=partners'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    partners
                   WHERE
                    (id_empresa = '".$this->id_empresa."')
                    AND (status IN(0,1))";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
        $ls_msg = $ls_msj;
        return -1;
        }

        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        id_partner,
                        nombre,
                        path_portada,
                        status
                    FROM
                        partners
                    WHERE
                        (id_empresa = '". $this->id_empresa."') AND (status IN(0,1)) ORDER BY id_partner DESC ".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar partners: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;

        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar paginación: '.$ls_mensaje;
           return -1;
        }

        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }


    public function borrarItemSlider($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE sliders SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_slider = '".$la_dataIn['id_slider']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItemPartner($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE partners SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_partner = '".$la_dataIn['id_partner']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItemServicio($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE servicios SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_servicio = '".$la_dataIn['id_servicio']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItemCategoria($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE categorias SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_categoria = '".$la_dataIn['id_categoria']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItemTestimonio($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE testimonios SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_testimonio = '".$la_dataIn['id_testimonio']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItemInstructor($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE instructores SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_instructor = '".$la_dataIn['id_instructor']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function borrarItem($la_dataIn, &$ls_mensaje){
        $ls_update = "UPDATE cursos_certificaciones SET status = 2 WHERE (id_empresa = '".$this->id_empresa."') AND (id_curso = '".$la_dataIn['id_curso']."') ";
        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $ls_mensaje = 'Se borró correctamenta';
        return 1;
    }

    public function accionesSubtitulos($la_dataIn, &$ls_mensaje){
        /*Actualiza*/
        $ls_update = "UPDATE subtitulos
                            SET
                                introduccion = :introduccion,
                                descripcion = :descripcion,
                                objetivos = :objetivos,
                                caracteristicas = :caracteristicas,
                                dirigido = :dirigido,
                                prerequisitos = :prerequisitos,
                                tomarlo_nosotros = :tomarlo_nosotros,
                                material_estudio = :material_estudio,
                                temario = :temario,
                                otrasnotas = :otrasnotas,
                                user_mod = '".$this->id_usuario."',
                                fecha_mod = NOW()
                        WHERE
                            (id_empresa = '".$this->id_empresa."') ";

        $la_data = array();
        $la_data[':introduccion'] = $la_dataIn['introduccion'];
        $la_data[':descripcion'] = $la_dataIn['descripcion'];
        $la_data[':objetivos'] = $la_dataIn['objetivos'];
        $la_data[':caracteristicas'] = $la_dataIn['caracteristicas'];
        $la_data[':dirigido'] = $la_dataIn['dirigido'];
        $la_data[':prerequisitos'] = $la_dataIn['prerequisitos'];
        $la_data[':tomarlo_nosotros'] = $la_dataIn['tomarlo_nosotros'];
        $la_data[':material_estudio'] = $la_dataIn['material_estudio'];
        $la_data[':temario'] = $la_dataIn['temario'];
        $la_data[':otrasnotas'] = $la_dataIn['otrasnotas'];


        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }

        $ls_mensaje = 'Se actualizó correctamenta';
        return 1;
    }

    public function obtieneDatosServicio($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_servicio']) ){
            $ls_script = "SELECT * FROM servicios WHERE (id_empresa = '".$this->id_empresa."') AND (id_servicio = '".$la_dataIn['id_servicio']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_servicio'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_servicio'] = array();
        }

        return 1;
    }

    public function showServicios($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        servicios
                       WHERE
                        (id_empresa = '".$this->id_empresa."')  AND (status = 1)";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        servicios.id_empresa,
                        servicios.id_categoria,
                        categorias.categoria as categoria,
                        servicios.id_servicio,
                        servicios.titulo,
                        servicios.descripcion,
                        servicios.status
                    FROM
                        servicios
                        LEFT OUTER JOIN categorias
                            ON (categorias.id_empresa = servicios.id_empresa)
                            AND (categorias.id_categoria = servicios.id_categoria)
                    WHERE
                        (servicios.id_empresa = '". $this->id_empresa."')
                        AND (servicios.status = 1)
                        ORDER BY servicios.id_servicio DESC ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_informacion;
        return 1;
    }

    public function accionesServicios($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_servicio), 0) + 1 as id_servicio FROM servicios WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO servicios
                            (
                                id_empresa,
                                id_categoria,
                                id_servicio,
                                titulo,
                                descripcion,
                                introduccion,
                                path_portada,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_categoria,
                                :id_servicio,
                                :titulo,
                                :descripcion,
                                :introduccion,
                                :path_portada,
                                :status,
                                :user_alta,
                                {hoy()}
                            )";

            $la_data = array();
            $la_data[':id_categoria'] = $la_dataIn['id_categoria'];
            $la_data[':id_servicio'] = $la_clave[0]['id_servicio'];
            $la_data[':titulo'] = $la_dataIn['titulo'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':introduccion'] = $la_dataIn['introduccion'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];
            $la_data[':user_alta'] = $this->id_usuario;


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE servicios
                                SET
                                    id_categoria = :id_categoria,
                                    titulo = :titulo,
                                    descripcion = :descripcion,
                                    introduccion = :introduccion,
                                    status = :status,
                                    path_portada = :path_portada,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = {hoy()}
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_servicio = '".$la_dataIn['id_servicio']."')";

            $la_data = array();
            $la_data[':id_categoria'] = $la_dataIn['id_categoria'];
            $la_data[':titulo'] = $la_dataIn['titulo'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':introduccion'] = $la_dataIn['introduccion'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function showCursosCalendario($la_dataIn, &$la_dataOut, &$ls_mensaje){
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
                        AND (cursos.status = 1)
                     ";
        if(f_SQL($ls_script, $la_null, $la_cursos, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar cursos en calendario: '.$ls_mensaje;
           return -1;
        }
        $la_dataOut = $la_cursos;
    }

    public function showIndicadores($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_where = "";

        /*Testimonios*/
        $ls_script ="SELECT
                    COUNT(1) as total_suscripciones
                FROM
                    sucriptores
                WHERE
                    (id_empresa = '". $this->id_empresa."')";
        if(f_SQL($ls_script, $la_null, $la_suscripciones, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }


        /*Certificaciones*/
       $ls_script ="SELECT
                    COUNT(1) as total_certificaciones
                FROM
                    cursos_certificaciones
                WHERE
                    (id_empresa = '". $this->id_empresa."')
                    AND (tipo_publicacion = 0)
                    AND (status = 1)";
        if(f_SQL($ls_script, $la_nullCer, $la_certificaciones, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }


        /*Cursos*/
        $ls_script ="SELECT
                    COUNT(1) as total_cursos
                FROM
                    cursos_certificaciones
                WHERE
                    (id_empresa = '". $this->id_empresa."')
                    AND (tipo_publicacion = 1)
                    AND (status = 1)";
        if(f_SQL($ls_script, $la_nullCer, $la_cursos, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }


        /*Mensajes*/
        $ls_script ="SELECT
                    COUNT(1) as total_mensajes
                FROM
                    mensajes
                WHERE
                    (id_empresa = '". $this->id_empresa."')  ";
        if(f_SQL($ls_script, $la_nullCer, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $la_dataOut['total_suscripciones'] = $la_suscripciones[0]['total_suscripciones'];
        $la_dataOut['total_certificaciones'] = $la_certificaciones[0]['total_certificaciones'];
        $la_dataOut['total_cursos'] = $la_cursos[0]['total_cursos'];
        $la_dataOut['total_mensajes'] = $la_mensajes[0]['total_mensajes'];

        return 1;
    }

    public function accionesTestimonios($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_testimonio), 0) + 1 as id_testimonio FROM testimonios WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO testimonios
                            (
                                id_empresa,
                                id_testimonio,
                                nombre,
                                puesto,
                                testimonio,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_testimonio,
                                :nombre,
                                :puesto,
                                :testimonio,
                                :status,
                                '".$this->id_usuario."',
                                NOW()
                            )";

            $la_data = array();
            $la_data[':id_testimonio'] = $la_clave[0]['id_testimonio'];
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':puesto'] = $la_dataIn['puesto'];
            $la_data[':testimonio'] = $la_dataIn['testimonio'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE testimonios
                                SET
                                    nombre = :nombre,
                                    puesto = :puesto,
                                    testimonio = :testimonio,
                                    status = :status,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW()
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_testimonio = '".$la_dataIn['id_testimonio']."')";

            $la_data = array();
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':puesto'] = $la_dataIn['puesto'];
            $la_data[':testimonio'] = $la_dataIn['testimonio'];
            $la_data[':status'] = $la_dataIn['status'];

            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosTestimonio($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_testimonio']) ){
            $ls_script = "SELECT * FROM testimonios WHERE (id_empresa = '".$this->id_empresa."') AND (status IN(0,1)) AND (id_testimonio = '".$la_dataIn['id_testimonio']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_testimonio'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_testimonio'] = array();
        }

        return 1;
    }

    public function showTodosTestimonios($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        testimonios
                       WHERE
                        (id_empresa = '".$this->id_empresa."') AND (status IN(0,1) )";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        id_empresa,
                        id_testimonio,
                        nombre,
                        puesto,
                        testimonio,
                        status
                    FROM
                        testimonios
                    WHERE
                        (id_empresa = '". $this->id_empresa."') AND (status IN(0,1)) ORDER BY id_testimonio DESC ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataOut['paginacion'] = $ls_pag;
        $la_dataOut['testimonios'] = $la_informacion;
        return 1;
    }

    public function accionesUsuarios($la_dataIn, &$ls_mensaje){
        $lo_modelGeneral = new ModelGeneral();

        if(strlen($la_dataIn['password']) > 0){
            if(strlen($la_dataIn['password']) < 4){
                $ls_mensaje = 'La contraseña ingresada debe tener al menos 4 caracteres';
                return -1;
            }else{
                $la_dataIn['password'] = $lo_modelGeneral->encriptaPassword($la_dataIn['password']);
            }
        }


        if(!$lo_modelGeneral->validaFormatoMail($la_dataIn['mail'])){
            $ls_mensaje = 'El correo electrónico es incorrecto.';
            return -1;
        }


        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT COUNT(1) as existe FROM usuarios WHERE (id_empresa = '".$this->id_empresa."') AND (id_usuario = '".$la_dataIn['id_usuario']."')";
            if(f_SQL($ls_max, $la_data, $la_valida, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            if($la_valida[0]['existe'] > 0){
                $ls_mensaje = 'Error, el usuario ingresado ya existe. Intento con otro.';
                return -1;
            }

             $ls_insert = "INSERT INTO usuarios
                            (
                                id_empresa,
                                id_usuario,
                                nombre,
                                apellido_paterno,
                                apellido_materno,
                                mail,
                                password,
                                tipo_usuario,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_usuario,
                                :nombre,
                                :apellido_paterno,
                                :apellido_materno,
                                :mail,
                                :password,
                                :tipo_usuario,
                                :status,
                                '".$this->id_usuario."',
                                NOW()
                            )";

            $la_data = array();
            $la_data[':id_usuario'] = $la_dataIn['id_usuario'];
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':apellido_paterno'] = $la_dataIn['apellido_paterno'];
            $la_data[':apellido_materno'] = $la_dataIn['apellido_materno'];
            $la_data[':mail'] = $la_dataIn['mail'];
            $la_data[':password'] = $la_dataIn['password'];
            $la_data[':tipo_usuario'] = $la_dataIn['tipo_usuario'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_campo_pass = "";
             $la_data = array();
            if(strlen($la_dataIn['password']) > 0){
                $ls_campo_pass = "password = :password,";
                $la_data[':password'] = $la_dataIn['password'];
            }
            $ls_update = "UPDATE usuarios
                                SET
                                    nombre = :nombre,
                                    apellido_paterno = :apellido_paterno,
                                    apellido_materno = :apellido_materno,
                                    mail = :mail,
                                    ".$ls_campo_pass."
                                    tipo_usuario = :tipo_usuario,
                                    status = :status,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW()
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_usuario = '".$la_dataIn['id_usuario']."')";


            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':apellido_paterno'] = $la_dataIn['apellido_paterno'];
            $la_data[':apellido_materno'] = $la_dataIn['apellido_materno'];
            $la_data[':mail'] = $la_dataIn['mail'];

            $la_data[':tipo_usuario'] = $la_dataIn['tipo_usuario'];
            $la_data[':status'] = $la_dataIn['status'];

            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosUsuarioFull($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_usuario']) ){
            $ls_script = "SELECT * FROM usuarios WHERE (id_empresa = '".$this->id_empresa."') AND (id_usuario = '".$la_dataIn['id_usuario']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_usuario'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_usuario'] = array();
        }

        return 1;
    }

    public function showTodosUsuarios($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        usuarios
                      WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        id_usuario,
                        CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre_completo,
                        mail,
                        tipo_usuario,
                        status
                    FROM
                        usuarios
                    WHERE (id_empresa = '".$this->id_empresa."') ORDER BY id_usuario DESC ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
            return -1;
        }

        $la_dataOut['paginacion'] = $ls_pag;
        $la_dataOut['informacion'] = $la_informacion;
        return 1;
    }

    public function accionesCategorias($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_categoria), 0) + 1 as id_categoria FROM categorias WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO categorias
                            (
                                id_empresa,
                                id_categoria,
                                categoria,
                                descripcion,
                                tipo,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_categoria,
                                :categoria,
                                :descripcion,
                                :tipo,
                                :status,
                                '".$this->id_usuario."',
                                NOW()
                            )";

            $la_data = array();
            $la_data[':id_categoria'] = $la_clave[0]['id_categoria'];
            $la_data[':categoria'] = $la_dataIn['categoria'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':tipo'] = $la_dataIn['tipo'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE categorias
                                SET
                                    categoria = :categoria,
                                    descripcion = :descripcion,
                                    tipo = :tipo,
                                    status = :status,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW()
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_categoria = '".$la_dataIn['id_categoria']."')";

            $la_data = array();
            $la_data[':categoria'] = $la_dataIn['categoria'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':tipo'] = $la_dataIn['tipo'];
            $la_data[':status'] = $la_dataIn['status'];

            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosCategoria($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_categoria']) ){
            $ls_script = "SELECT * FROM categorias WHERE (id_empresa = '".$this->id_empresa."') AND (id_categoria = '".$la_dataIn['id_categoria']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_categoria'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_categoria'] = array();
        }

        return 1;
    }

    public function showTodasCategorias($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        categorias
                       WHERE
                        (id_empresa = '".$this->id_empresa."')  AND (status < 2) ";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " LIMIT ".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"]." ";

        $ls_script ="SELECT
                        id_categoria,
                        categoria,
                        descripcion,
                        tipo,
                        status
                    FROM
                        categorias
                    WHERE
                        (id_empresa = '". $this->id_empresa."') AND (status < 2) ORDER BY id_categoria DESC ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataOut['paginacion'] = $ls_pag;
        $la_dataOut['informacion'] = $la_informacion;
        return 1;
    }

    public function accionesConfiguracionSitio($la_dataIn, &$ls_mensaje){
        /*Actualiza*/
        $ls_update = "UPDATE configuracion_sitio
                            SET
                                twitter = :twitter,
                                facebook = :facebook,
                                google = :google,
                                instagram = :instagram,
                                linkedin = :linkedin,
                                youtube = :youtube,
                                telefono = :telefono,
                                mail = :mail,
                                domicilio = :domicilio,
                                mensaje_suscripcion = :mensaje_suscripcion,
                                acerca_de = :acerca_de,
                                cursos_destacables = :cursos_destacables,
                                certificaciones_destacables = :certificaciones_destacables,
                                mostrar_instructores = :mostrar_instructores,
                                mostrar_campo_empresa = :mostrar_campo_empresa,
                                mostrar_campo_cursos = :mostrar_campo_cursos,
                                mostrar_campo_celular = :mostrar_campo_celular,
                                user_mod = '".$this->id_usuario."',
                                titulo_intro = :titulo_intro,
                                intro = :intro,
                                id_twitter = :id_twitter,
                                fecha_mod = NOW(),
                                descripcion_punto_uno = :descripcion_punto_uno,
                                icon_punto_uno = :icon_punto_uno,
                                descripcion_punto_dos = :descripcion_punto_dos,
                                icon_punto_dos = :icon_punto_dos,
                                descripcion_punto_tres = :descripcion_punto_tres,
                                icon_punto_tres = :icon_punto_tres,
                                descripcion_punto_cuatro = :descripcion_punto_cuatro,
                                icon_punto_cuatro = :icon_punto_cuatro,
                                path_portada = :path_portada,
                                mostrar_partners = :mostrar_partners,
                                mostrar_webinars = :mostrar_webinars

                        WHERE
                            (id_empresa = '".$this->id_empresa."') ";

        $la_data = array();
        $la_data[':twitter'] = $la_dataIn['twitter'];
        $la_data[':facebook'] = $la_dataIn['facebook'];
        $la_data[':google'] = $la_dataIn['google'];
        $la_data[':instagram'] = $la_dataIn['instagram'];
        $la_data[':linkedin'] = $la_dataIn['linkedin'];
        $la_data[':youtube'] = $la_dataIn['youtube'];
        $la_data[':telefono'] = $la_dataIn['telefono'];
        $la_data[':mail'] = $la_dataIn['mail'];
        $la_data[':domicilio'] = $la_dataIn['domicilio'];
        $la_data[':mensaje_suscripcion'] = $la_dataIn['mensaje_suscripcion'];
        $la_data[':acerca_de'] = $la_dataIn['acerca_de'];
        $la_data[':cursos_destacables'] = $la_dataIn['cursos_destacables'];
        $la_data[':certificaciones_destacables'] = $la_dataIn['certificaciones_destacables'];
        $la_data[':mostrar_instructores'] = $la_dataIn['mostrar_instructores'];
        $la_data[':mostrar_campo_empresa'] = $la_dataIn['mostrar_campo_empresa'];
        $la_data[':mostrar_campo_cursos'] = $la_dataIn['mostrar_campo_cursos'];
        $la_data[':mostrar_campo_celular'] = $la_dataIn['mostrar_campo_celular'];
        $la_data[':titulo_intro'] = $la_dataIn['titulo_intro'];
        $la_data[':intro'] = $la_dataIn['intro'];
        $la_data[':id_twitter'] = $la_dataIn['id_twitter'];

        $la_data[':descripcion_punto_uno'] = $la_dataIn['descripcion_punto_uno'];
        $la_data[':icon_punto_uno'] = $la_dataIn['icon_punto_uno'];
        $la_data[':descripcion_punto_dos'] = $la_dataIn['descripcion_punto_dos'];
        $la_data[':icon_punto_dos'] = $la_dataIn['icon_punto_dos'];
        $la_data[':descripcion_punto_tres'] = $la_dataIn['descripcion_punto_tres'];
        $la_data[':icon_punto_tres'] = $la_dataIn['icon_punto_tres'];
        $la_data[':descripcion_punto_cuatro'] = $la_dataIn['descripcion_punto_cuatro'];
        $la_data[':icon_punto_cuatro'] = $la_dataIn['icon_punto_cuatro'];
        $la_data[':path_portada'] = $la_dataIn['path_portada'];
        $la_data[':mostrar_partners'] = $la_dataIn['mostrar_partners'];
        $la_data[':mostrar_webinars'] = $la_dataIn['mostrar_webinars'];


        if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
            echo $ls_mensaje = $mensaje_query;
            return -1;
        }

        $ls_mensaje = 'Se actualizó correctamenta';
        return 1;
    }

    public function obtieneDatosSubtitulos($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_script = "SELECT * FROM subtitulos WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }
        $la_dataSal['informacion_subtitulos'] = $la_informacion[0];
        return 1;
    }

    public function obtieneDatosConfiguracion($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_script = "SELECT * FROM configuracion_sitio WHERE (id_empresa = '".$this->id_empresa."') ";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }
        $la_dataSal['informacion_configuracion'] = $la_informacion[0];
        return 1;
    }

    public function accionesInstructores($la_dataIn, &$ls_mensaje){
        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_instructor), 0) + 1 as id_instructor FROM instructores WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO instructores
                            (
                                id_empresa,
                                id_instructor,
                                nombre,
                                informacion,
                                path_portada,
                                status,
                                user_alta,
                                fecha_alta
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_instructor,
                                :nombre,
                                :informacion,
                                :path_portada,
                                :status,
                                '".$this->id_usuario."',
                                NOW()
                            )";

            $la_data = array();
            $la_data[':id_instructor'] = $la_clave[0]['id_instructor'];
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':informacion'] = $la_dataIn['informacion'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];


            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE instructores
                                SET
                                    nombre = :nombre,
                                    informacion = :informacion,
                                    path_portada = :path_portada,
                                    status = :status,
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW()
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_instructor = '".$la_dataIn['id_instructor']."')";

            $la_data = array();
            $la_data[':nombre'] = $la_dataIn['nombre'];
            $la_data[':informacion'] = $la_dataIn['informacion'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];

            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function obtieneDatosInstructor($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_instructor']) ){
            $ls_script = "SELECT * FROM instructores WHERE (id_empresa = '".$this->id_empresa."') AND (id_instructor = '".$la_dataIn['id_instructor']."')";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_instructor'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_instructor'] = array();
        }

        return 1;
    }

    public function cambiaStatusSuscripcion($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_status = 1;
        if($la_dataIn['action'] == 'baja'){
            $ls_status = 0;
        }

        $ls_update = "UPDATE
                        sucriptores
                    SET
                        fecha_baja = NOW(),
                        user_baja = '".$this->id_usuario."',
                        status = ".$ls_status."
                    WHERE
                        (id_empresa = '".$this->id_empresa."')
                        AND (id_suscriptor = '".$la_dataIn['id_suscriptor']."') ";

        if(f_SQL($ls_update, $la_NULL_TOTAL, $la_update, $ls_msj) < 0){
           $ls_mensaje = $ls_msj;
           return -1;
        }

        $ls_mensaje = 'Se actualizó correctamente';
        return 1;
    }

    public function obtieneDatosCertificacion($la_dataIn, &$la_dataSal, &$ls_mensaje){
        if(isset($la_dataIn['id_curso']) ){
            $ls_script = "SELECT * FROM cursos_certificaciones WHERE (id_empresa = '".$this->id_empresa."') AND (id_curso = '".$la_dataIn['id_curso']."') AND (status = 1)";
            if(f_SQL($ls_script, $la_NULL_TOTAL, $la_informacion, $ls_msj) < 0){
               $ls_msg = $ls_msj;
               return -1;
            }
            $la_dataSal['informacion_curso'] = $la_informacion[0];
        }else{
            $la_dataSal['informacion_curso'] = array();
        }

        return 1;
    }

    public function showCursosCertificaciones($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        cursos_certificaciones
                       WHERE
                        (id_empresa = '".$this->id_empresa."') AND (tipo_publicacion = ".$la_dataIn['tipo_publicacion'].") AND (status IN(0,1))";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " LIMIT ".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"]." ";

        $ls_script ="SELECT
                        cursos.id_empresa,
                        cursos.id_categoria,
                        categorias.categoria as categoria,
                        cursos.id_curso,
                        cursos.titulo,
                        cursos.status,
                        cursos.secuencia
                    FROM
                        cursos_certificaciones cursos
                        LEFT OUTER JOIN categorias
                            ON (categorias.id_empresa = cursos.id_empresa)
                            AND (categorias.id_categoria = cursos.id_categoria)
                    WHERE
                        (cursos.id_empresa = '". $this->id_empresa."')
                        AND (categorias.status = 1)
                        AND (cursos.tipo_publicacion = ".$la_dataIn['tipo_publicacion'].")
                        AND (cursos.status IN(0,1)) ORDER BY IFNULL(cursos.secuencia, 999999) ASC, cursos.id_curso DESC, cursos.fecha_inicia ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_informacion;
        return 1;
    }

    public function showCursosClientes($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion='.$this->id_pagina.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        //cambiar por clientes curso
        $ls_script = "SELECT count(1) as total FROM clientes_cursos cl
                      JOIN cursos_certificaciones cer ON cl.id_curso = cer.id_curso
                      WHERE cer.id_empresa = '".$this->id_empresa."'";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }


        $ls_paginar = " LIMIT ".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"]." ";
    //cambiar por clientes curso
        $ls_script ="SELECT cl.id_cliente_curso,cer.titulo,cli.nombre_completo,cl.ReferenciaPayPal,cl.fecha_compra  FROM clientes_cursos cl
                      JOIN cursos_certificaciones cer ON cl.id_curso = cer.id_curso
                      JOIN clientes cli ON cli.id_cliente = cl.id_cliente
                      WHERE cer.id_empresa = '".$this->id_empresa."'
                         ORDER BY  cl.fecha_compra asc ".$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_informacion, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_informacion;
        return 1;
    }



    public function accionesCertificaciones($la_dataIn, &$ls_mensaje){
        $ls_usuario = '';
        if($la_dataIn['user_alta'] == ''){
            $ls_usuario = $this->id_usuario;
        }else{
            $ls_usuario = $la_dataIn['user_alta'];
        }

        if($la_dataIn['action'] == 'add'){
            /*Inserta*/
            $ls_max = "SELECT IFNULL(MAX(id_curso), 0) + 1 as id_curso FROM cursos_certificaciones WHERE (id_empresa = '".$this->id_empresa."') ";
            if(f_SQL($ls_max, $la_data, $la_clave, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

             $ls_insert = "INSERT INTO cursos_certificaciones
                            (
                                id_empresa,
                                id_categoria,
                                id_curso,
                                titulo,
                                introduccion,
                                descripcion,
                                objetivos,
                                caracteristicas,
                                dirigido,
                                pre_requisitos,
                                porque_tomarlo,
                                material,
                                temario,
                                precio,
                                paypal,
                                mes0,
                                desc__,
                                mes3,
                                mes6,
                                mes9,
                                mes12,
                                duracion,
                                id_instructor,
                                otras_notas,
                                path_portada,
                                tipo_publicacion,
                                status,
                                user_alta,
                                fecha_alta,
                                fecha_inicia,
                                secuencia,
                                es_online,
                                url_video
                            )
                        VALUES
                            (
                                '".$this->id_empresa."',
                                :id_categoria,
                                :id_curso,
                                :titulo,
                                :introduccion,
                                :descripcion,
                                :objetivos,
                                :caracteristicas,
                                :dirigido,
                                :pre_requisitos,
                                :porque_tomarlo,
                                :material,
                                :temario,
                                :precio,
                                :paypal,
                                :mes0,
                                :desc__,
                                :mes3,
                                :mes6,
                                :mes9,
                                :mes12,
                                :duracion,
                                :id_instructor,
                                :otras_notas,
                                :path_portada,
                                :tipo_publicacion,
                                :status,
                                '".$ls_usuario."',
                                NOW(),
                                :fecha_inicia,
                                :secuencia,
                                :es_online,
                                :url_video
                            )";

            $la_data = array();
            $la_data[':id_categoria'] = $la_dataIn['id_categoria'];
            $la_data[':id_curso'] = $la_clave[0]['id_curso'];
            $la_data[':titulo'] = $la_dataIn['titulo'];

            $la_data[':introduccion'] = $la_dataIn['introduccion'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':objetivos'] = $la_dataIn['objetivos'];
            $la_data[':caracteristicas'] = $la_dataIn['caracteristicas'];
            $la_data[':dirigido'] = $la_dataIn['dirigido'];
            $la_data[':pre_requisitos'] = $la_dataIn['pre_requisitos'];
            $la_data[':porque_tomarlo'] = $la_dataIn['porque_tomarlo'];
            $la_data[':material'] = $la_dataIn['material'];
            $la_data[':temario'] = $la_dataIn['temario'];

            if($la_dataIn['precio'] == ''){
                $la_data[':precio'] = NULL;
            }else{
                $la_data[':precio'] = $la_dataIn['precio'];
            }

            if($la_dataIn['paypal'] == ''){
                $la_data[':paypal'] = NULL;
            }else{
                $la_data[':paypal'] = $la_dataIn['paypal'];
            }

            if($la_dataIn['mes0'] == ''){
                $la_data[':mes0'] = NULL;
            }else{
                $la_data[':mes0'] = $la_dataIn['mes0'];
            }

            if($la_dataIn['desc__'] == ''){
                $la_data[':desc__'] = NULL;
            }else{
                $la_data[':desc__'] = $la_dataIn['desc__'];
            }

            if($la_dataIn['mes3'] == ''){
                $la_data[':mes3'] = NULL;
            }else{
                $la_data[':mes3'] = $la_dataIn['mes3'];
            }

            if($la_dataIn['mes6'] == ''){
                $la_data[':mes6'] = NULL;
            }else{
                $la_data[':mes6'] = $la_dataIn['mes6'];
            }

            if($la_dataIn['mes9'] == ''){
                $la_data[':mes9'] = NULL;
            }else{
                $la_data[':mes9'] = $la_dataIn['mes9'];
            }

            if($la_dataIn['mes12'] == ''){
                $la_data[':mes12'] = NULL;
            }else{
                $la_data[':mes12'] = $la_dataIn['mes12'];
            }

            $la_data[':duracion'] = $la_dataIn['duracion'];
            $la_data[':id_instructor'] = $la_dataIn['id_instructor'];
            $la_data[':otras_notas'] = $la_dataIn['otras_notas'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':tipo_publicacion'] = $la_dataIn['tipo_publicacion'];
            $la_data[':status'] = $la_dataIn['status'];

            if($la_dataIn['fecha_inicia'] == ''){
                $la_data[':fecha_inicia'] = NULL;
            }else{
                $la_data[':fecha_inicia'] = $la_dataIn['fecha_inicia'];
            }

            $la_data[':secuencia'] = $la_dataIn['secuencia'];
            $la_data[':es_online'] = $la_dataIn['es_online'];
            $la_data[':url_video'] = $la_dataIn['url_video'];

            if(f_SQL($ls_insert, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se agregó correctamenta';
            return 1;
        }else{
            /*Actualiza*/
            $ls_update = "UPDATE cursos_certificaciones
                                SET
                                    id_categoria = :id_categoria,
                                    titulo = :titulo,
                                    introduccion = :introduccion,
                                    descripcion = :descripcion,
                                    objetivos = :objetivos,
                                    caracteristicas = :caracteristicas,
                                    dirigido = :dirigido,
                                    pre_requisitos = :pre_requisitos,
                                    porque_tomarlo = :porque_tomarlo,
                                    material = :material,
                                    temario = :temario,
                                    precio = :precio,
                                    paypal = :paypal,
                                    mes0 = :mes0,
                                    desc__ = :desc__,
                                    mes3 = :mes3,
                                    mes6 = :mes6,
                                    mes9 = :mes9,
                                    mes12 = :mes12,
                                    duracion = :duracion,
                                    id_instructor = :id_instructor,
                                    otras_notas = :otras_notas,
                                    path_portada = :path_portada,
                                    status = :status,
                                    user_alta = '".$ls_usuario."',
                                    user_mod = '".$this->id_usuario."',
                                    fecha_mod = NOW(),
                                    fecha_inicia = :fecha_inicia,
                                    secuencia = :secuencia,
                                    es_online = :es_online,
                                    url_video = :url_video
                            WHERE
                                (id_empresa = '".$this->id_empresa."')
                                AND (id_curso = '".$la_dataIn['id_curso']."')";

            $la_data = array();
            $la_data[':id_categoria'] = $la_dataIn['id_categoria'];
            $la_data[':titulo'] = $la_dataIn['titulo'];

            $la_data[':introduccion'] = $la_dataIn['introduccion'];
            $la_data[':descripcion'] = $la_dataIn['descripcion'];
            $la_data[':objetivos'] = $la_dataIn['objetivos'];
            $la_data[':caracteristicas'] = $la_dataIn['caracteristicas'];
            $la_data[':dirigido'] = $la_dataIn['dirigido'];
            $la_data[':pre_requisitos'] = $la_dataIn['pre_requisitos'];
            $la_data[':porque_tomarlo'] = $la_dataIn['porque_tomarlo'];
            $la_data[':material'] = $la_dataIn['material'];
            $la_data[':temario'] = $la_dataIn['temario'];
            if($la_dataIn['precio'] == ''){
                $la_data[':precio'] = NULL;
            }else{
                $la_data[':precio'] = $la_dataIn['precio'];
            }
            if($la_dataIn['paypal'] == ''){
                $la_data[':paypal'] = NULL;
            }else{
                $la_data[':paypal'] = $la_dataIn['paypal'];
            }
            if($la_dataIn['mes0'] == ''){
                $la_data[':mes0'] = NULL;
            }else{
                $la_data[':mes0'] = $la_dataIn['mes0'];
            }

            if($la_dataIn['desc__'] == ''){
                $la_data[':desc__'] = NULL;
            }else{
                $la_data[':desc__'] = $la_dataIn['desc__'];
            }

            if($la_dataIn['mes3'] == ''){
                $la_data[':mes3'] = NULL;
            }else{
                $la_data[':mes3'] = $la_dataIn['mes3'];
            }

            if($la_dataIn['mes6'] == ''){
                $la_data[':mes6'] = NULL;
            }else{
                $la_data[':mes6'] = $la_dataIn['mes6'];
            }

            if($la_dataIn['mes9'] == ''){
                $la_data[':mes9'] = NULL;
            }else{
                $la_data[':mes9'] = $la_dataIn['mes9'];
            }

            if($la_dataIn['mes12'] == ''){
                $la_data[':mes12'] = NULL;
            }else{
                $la_data[':mes12'] = $la_dataIn['mes12'];
            }

            $la_data[':duracion'] = $la_dataIn['duracion'];
            $la_data[':id_instructor'] = $la_dataIn['id_instructor'];
            $la_data[':otras_notas'] = $la_dataIn['otras_notas'];
            $la_data[':path_portada'] = $la_dataIn['path_portada'];
            $la_data[':status'] = $la_dataIn['status'];
            if($la_dataIn['fecha_inicia'] == ''){
                $la_data[':fecha_inicia'] = NULL;
            }else{
                $la_data[':fecha_inicia'] = $la_dataIn['fecha_inicia'];
            }
            $la_data[':secuencia'] = $la_dataIn['secuencia'];
            $la_data[':es_online'] = $la_dataIn['es_online'];
            $la_data[':url_video'] = $la_dataIn['url_video'];
            if(f_SQL($ls_update, $la_data, $la_dataPage, $mensaje_query) < 0){
                $ls_mensaje = $mensaje_query;
                return -1;
            }

            $ls_mensaje = 'Se actualizó correctamenta';
            return 1;
        }
    }

    public function showUsuariosEntrada($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT
                        id_usuario,
                        CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) AS nombre
                     FROM
                        usuarios
                    WHERE
                        (id_empresa = '".$this->id_empresa."')
                        AND (status = 1)
                        AND (tipo_usuario = 1)";
        if(f_SQL($ls_script, $la_data, $la_usuarios, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_usuarios;
        return 1;
    }

    public function showInstructores($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT id_instructor, nombre FROM instructores WHERE (id_empresa = '".$this->id_empresa."') AND (status = 1)";
        if(f_SQL($ls_script, $la_data, $la_instructores, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }
        $la_dataOut = $la_instructores;
        return 1;
    }

    public function showCategorias($la_dataIn, &$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT id_categoria, categoria FROM categorias WHERE (id_empresa = '".$this->id_empresa."') AND (tipo = '".$la_dataIn['tipo_categoria']."') AND (status = 1)";
        if(f_SQL($ls_script, $la_data, $la_categorias, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_categorias;
        return 1;
    }

    public function actualizaPaginaGenerica($la_dataIn, &$ls_mensaje){
        $ls_script = "UPDATE
                    paginas_genericas
                 SET
                    titulo = :titulo,
                    subtitulo = :subtitulo,
                    informacion = :informacion,
                    user_mod = '".$this->id_usuario."',
                    fecha_mod = NOW(),
                    path_portada = :path_portada
                 WHERE
                    (id_empresa = '".$this->id_empresa."')
                    AND (id_pagina = '".$this->id_pagina."') ";
        $la_data = array();
        $la_data[':titulo'] = $la_dataIn['titulo'];
        $la_data[':subtitulo'] = $la_dataIn['subtitulo'];
        $la_data[':informacion'] = $la_dataIn['informacion'];
        $la_data[':path_portada'] = $la_dataIn['path_portada'];


        if(f_SQL($ls_script, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }

        $ls_mensaje = 'Se actualizó correctamente';
        return 1;
    }

    public function showInfoGenerica(&$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT * FROM paginas_genericas WHERE (id_empresa = '".$this->id_empresa."') AND (id_pagina = '".$_GET['seccion']."') ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_dataPage[0];
        return 1;
    }

    public function actualizaPagina($la_dataIn, &$ls_mensaje){
        $ls_script = "UPDATE
                        nosotros
                     SET
                        titulo = :titulo,
                        subtitulo = :subtitulo,
                        informacion = :informacion,
                        porque_nosotros = :porque_nosotros,
                        titulo_especialidad_uno = :titulo_especialidad_uno,
                        desc_especialidad_uno = :desc_especialidad_uno,
                        titulo_especialidad_dos = :titulo_especialidad_dos,
                        desc_especialidad_dos = :desc_especialidad_dos,
                        titulo_especialidad_tres = :titulo_especialidad_tres,
                        desc_especialidad_tres = :desc_especialidad_tres,
                        titulo_especialidad_cuatro = :titulo_especialidad_cuatro,
                        desc_especialidad_cuatro = :desc_especialidad_cuatro,
                        titulo_especialidades = :titulo_especialidades,
                        user_mod = '".$this->id_usuario."',
                        icono_especialidad_uno = :icono_especialidad_uno,
                        icono_especialidad_dos = :icono_especialidad_dos,
                        icono_especialidad_tres = :icono_especialidad_tres,
                        icono_especialidad_cuatro = :icono_especialidad_cuatro,
                        fecha_mod = NOW(),
                        path_portada = :path_portada
                     WHERE
                        (id_empresa = '".$this->id_empresa."')
                        AND (id_pagina = '".$this->id_pagina."') ";
        $la_data = array();
        $la_data[':titulo'] = $la_dataIn['titulo'];
        $la_data[':subtitulo'] = $la_dataIn['subtitulo'];
        $la_data[':informacion'] = $la_dataIn['informacion'];
        $la_data[':porque_nosotros'] = $la_dataIn['porque_nosotros'];


        $la_data[':titulo_especialidad_uno'] = $la_dataIn['titulo_especialidad_uno'];
        $la_data[':desc_especialidad_uno'] = $la_dataIn['desc_especialidad_uno'];

        $la_data[':titulo_especialidad_dos'] = $la_dataIn['titulo_especialidad_dos'];
        $la_data[':desc_especialidad_dos'] = $la_dataIn['desc_especialidad_dos'];

        $la_data[':titulo_especialidad_tres'] = $la_dataIn['titulo_especialidad_tres'];
        $la_data[':desc_especialidad_tres'] = $la_dataIn['desc_especialidad_tres'];

        $la_data[':titulo_especialidad_cuatro'] = $la_dataIn['titulo_especialidad_cuatro'];
        $la_data[':desc_especialidad_cuatro'] = $la_dataIn['desc_especialidad_cuatro'];
        $la_data[':titulo_especialidades'] = $la_dataIn['titulo_especialidades'];

        $la_data[':icono_especialidad_uno'] = $la_dataIn['icono_especialidad_uno'];
        $la_data[':icono_especialidad_dos'] = $la_dataIn['icono_especialidad_dos'];
        $la_data[':icono_especialidad_tres'] = $la_dataIn['icono_especialidad_tres'];
        $la_data[':icono_especialidad_cuatro'] = $la_dataIn['icono_especialidad_cuatro'];
        $la_data[':path_portada'] = $la_dataIn['path_portada'];


        if(f_SQL($ls_script, $la_data, $la_dataPage, $mensaje_query) < 0){
            $ls_mensaje = $mensaje_query;
            return -1;
        }

        $ls_mensaje = 'Se actualizó correctamente';
        return 1;
    }

    public function showInfoNosotros(&$la_dataOut, &$ls_mensaje){
        $ls_script = "SELECT * FROM nosotros WHERE (id_empresa = '".$this->id_empresa."') AND (id_pagina = '".$_GET['seccion']."') ";
        if(f_SQL($ls_script, $la_null, $la_dataPage, $mensaje_query) < 0){
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $la_dataOut = $la_dataPage[0];
        return 1;
    }

    public function obtieneTodasSuscripciones($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        if(isset($la_dataIn['id_suscriptor'])){
        $ls_where = " AND (id_suscriptor = '".$la_dataIn['id_suscriptor']."')";
        }

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion=suscripciones&informacion=suscripciones'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    sucriptores
                   WHERE
                    (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
            $ls_msg = $ls_msj;
            return -1;
        }

        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                    id_suscriptor,
                    nombre,
                    mail,
                    telefono,
                    status,
                    fecha_alta
                FROM
                    sucriptores
                WHERE
                    (id_empresa = '". $this->id_empresa."') ORDER BY id_suscriptor DESC ".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function obtieneSuscripciones($la_dataIn, &$la_dataSal, &$ls_mensaje){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        if(isset($la_dataIn['id_mensaje'])){
        $ls_where = " AND (id_mensaje = '".$la_dataIn['id_mensaje']."')";
        }

        $RegistrosAMostrar = 10;
        $arg_dataIn_a['link'] = 'index.php?seccion=panel_admin&informacion=suscripciones'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    sucriptores
                   WHERE
                    (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
            $ls_msg = $ls_msj;
            return -1;
        }

        if(isset($_GET['informacion']) && $_GET['informacion'] == 'suscripciones'){
            $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";
        }else{
            $ls_paginar = " {paginar(0,10)} ";
        }

        $ls_script ="SELECT
                    id_suscriptor,
                    nombre,
                    mail,
                    status,
                    fecha_alta
                FROM
                    sucriptores
                WHERE
                    (id_empresa = '". $this->id_empresa."') ".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function showTodosInstructores($la_dataIn, &$la_dataSal, &$ls_mensaje ){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion=instructores'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    instructores
                   WHERE
                    (id_empresa = '".$this->id_empresa."') AND (status IN(0,1))";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
        $ls_msg = $ls_msj;
        return -1;
        }

        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                        id_instructor,
                        nombre,
                        informacion,
                        status
                    FROM
                        instructores
                    WHERE
                        (id_empresa = '". $this->id_empresa."')  AND (status IN(0,1) ) ORDER BY id_instructor DESC ".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar instructores: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;

        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function obtieneTodasSugerencias($la_dataIn, &$la_dataSal, &$ls_mensaje ){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion=sugerencias'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    sugerencias
                   WHERE
                    (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
        $ls_msg = $ls_msj;
        return -1;
        }

        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                    id_empresa,
                    id_sugerencia,
                    nombre,
                    mail,
                    mensaje,
                    fecha_alta
                FROM
                    sugerencias
                WHERE
                    (id_empresa = '". $this->id_empresa."') ORDER BY id_sugerencia DESC".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;

        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar sugerencias: '.$ls_mensaje;
           return -1;
        }

        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function obtieneTodosMensajes($la_dataIn, &$la_dataSal, &$ls_mensaje ){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        $RegistrosAMostrar = 100;
        $arg_dataIn_a['link'] = 'index.php?seccion=mensajes'.$_SESSION['QUERY_STRING'];

        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                    count(1) as total
                  FROM
                    mensajes
                   WHERE
                    (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
        $ls_msg = $ls_msj;
        return -1;
        }

        $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";

        $ls_script ="SELECT
                    id_mensaje,
                    nombre,
                    empresa,
                    celular,
                    mail,
                    asunto,
                    telefono,
                    mensaje,
                    curso,
                    fecha_alta,
                    status,
                    como_se_entero
                FROM
                    mensajes
                WHERE
                    (id_empresa = '". $this->id_empresa."') ORDER BY id_mensaje DESC".$ls_where.$ls_paginar;
        if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
           $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;

        if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
            $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
        }

        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function obtieneMensajes($la_dataIn, &$la_dataSal, &$ls_mensaje ){
        $ls_where = "";
        $lo_modalGeneral = new ModelGeneral();

        if(isset($la_dataIn['id_mensaje'])){
            $ls_where = " AND (id_mensaje = '".$la_dataIn['id_mensaje']."')";
        }

        $RegistrosAMostrar = 10;
        $arg_dataIn_a['link'] = 'index.php?seccion=panel_admin&informacion=mensajes'.$_SESSION['QUERY_STRING'];
        if(isset($_GET['n_pagina'])){
            $arg_dataIn_a['pag_ini'] = ($_GET['n_pagina']-1) * $RegistrosAMostrar;
            $arg_dataIn_a['n_pagina'] = $_GET['n_pagina'];
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }else{
            $arg_dataIn_a['pag_ini'] = 0;
            $arg_dataIn_a['n_pagina'] = 1;
            $arg_dataIn_a['reg_a_mostrar'] = $RegistrosAMostrar;
        }

        $ls_script = "SELECT
                        count(1) as total
                      FROM
                        mensajes
                       WHERE
                        (id_empresa = '".$this->id_empresa."')";
        if(f_SQL($ls_script, $la_NULL_TOTAL, $la_total, $ls_msj) < 0){
           $ls_msg = $ls_msj;
           return -1;
        }

        if(isset($_GET['informacion']) && $_GET['informacion'] == 'mensajes'){
            $ls_paginar = " {paginar(".$arg_dataIn_a["pag_ini"].",".$arg_dataIn_a["reg_a_mostrar"].")} ";
        }else{
            $ls_paginar = " {paginar(0,10)} ";
        }

        $ls_script ="SELECT
                        id_mensaje,
                        nombre,
                        mail,
                        asunto,
                        telefono,
                        mensaje,
                        fecha_alta
                    FROM
                        mensajes
                    WHERE
                        (id_empresa = '". $this->id_empresa."') ".$ls_where.$ls_paginar;
          if(f_SQL($ls_script, $la_null, $la_mensajes, $ls_mensaje) < 0){
               $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }

        $arg_dataIn_a['total'] = $la_total[0]['total'];
        $arg_dataIn_a['pag_panel'] = 1;
          if($lo_modalGeneral->f_paginacion($arg_dataIn_a, $ls_pag, $arg_msj) < 0){
                $ls_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
               return -1;
          }
        $la_dataSal['paginacion'] = $ls_pag;
        $la_dataSal['informacion'] = $la_mensajes;
        return 1;
    }

    public function obtieneDatosUsuario(){
      $ls_script = "SELECT
                     id_usuario,
                     CONCAT(nombre,' ', apellido_paterno, ' ', apellido_materno) nombre_completo,
                     CAST(fecha_alta AS DATE) fecha_alta
                  FROM
                     usuarios
                  WHERE
                     (id_empresa = '".$this->id_empresa."')
                     AND (id_usuario = '".$_SESSION['id_usuario']."')";
      if(f_SQL($ls_script, $la_null, $la_usuario, $ls_mensaje) < 0){
           $la_dataOut['mensaje'] = 'Error al consultar usuario: '.$ls_mensaje;
           return -1;
      }

      return $la_usuario[0];
    }

    public function iniciarSesionAdmin($la_dataIn = array(), &$la_dataOut = array(), &$arg_mensaje = ''){
        $lo_modelGeneral = new ModelGeneral();
        $ls_script = "SELECT
                        id_empresa,
                        id_usuario,
                        nombre,
                        apellido_paterno,
                        apellido_materno,
                        mail,
                        tipo_usuario
                     FROM
                        usuarios
                     WHERE
                        (id_empresa = '".$this->id_empresa."')
                        AND (id_usuario = '".$la_dataIn['usuario']."')
                        AND (status = 1)
                        AND (password = '".$lo_modelGeneral->encriptaPassword($la_dataIn['password'])."') ";

        if(f_SQL($ls_script, $la_null, $la_usuario, $ls_mensaje) < 0){
            $arg_mensaje = 'Error al consultar usuario: '.$ls_mensaje;
            return -1;
        }

        if(count($la_usuario) > 0){
            $_SESSION['id_usuario'] = $la_usuario[0]['id_usuario'];
             $_SESSION['tipo_usuario'] = $la_usuario[0]['tipo_usuario'];
            return 1;
        }else{
            $arg_mensaje= 'Datos incorrectos, favor de verificar';
            return -1;
        }

        return 1;
    }
 }
