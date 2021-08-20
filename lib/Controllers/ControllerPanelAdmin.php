<?php

class ControllerPanel
{

    public function nuevo_webinar()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'webinars';

        if (isset($_GET['id_curso'])) {
            $la_arguments['id_curso'] = $_GET['id_curso'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un webinar | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 3;
            if ($lo_paginaInformacion->accionesCertificaciones($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=webinars' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCertificacion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_curso']) == 0) {
                $la_informacion_curso['informacion_curso']['id_curso']        = '';
                $la_informacion_curso['informacion_curso']['id_categoria']    = '';
                $la_informacion_curso['informacion_curso']['titulo']          = '';
                $la_informacion_curso['informacion_curso']['introduccion']    = '';
                $la_informacion_curso['informacion_curso']['descripcion']     = '';
                $la_informacion_curso['informacion_curso']['objetivos']       = '';
                $la_informacion_curso['informacion_curso']['caracteristicas'] = '';
                $la_informacion_curso['informacion_curso']['dirigido']        = '';
                $la_informacion_curso['informacion_curso']['pre_requisitos']  = '';
                $la_informacion_curso['informacion_curso']['porque_tomarlo']  = '';
                $la_informacion_curso['informacion_curso']['material']        = '';
                $la_informacion_curso['informacion_curso']['temario']         = '';
                $la_informacion_curso['informacion_curso']['precio']          = '';
                $la_informacion_curso['informacion_curso']['duracion']        = '';
                $la_informacion_curso['informacion_curso']['id_instructor']   = '';
                $la_informacion_curso['informacion_curso']['otras_notas']     = '';
                $la_informacion_curso['informacion_curso']['path_portada']    = '';
                $la_informacion_curso['informacion_curso']['status']          = 1;
                $la_informacion_curso['informacion_curso']['fecha_inicia']    = '';
                $la_informacion_curso['informacion_curso']['secuencia']       = '';
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                      = array_merge($params);
        $params['categorias']        = $la_categorias;
        $params['instructores']      = $la_instructores;
        $params['informacion_curso'] = $la_informacion_curso['informacion_curso'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_webinar.php';
    }

    public function webinars()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 3;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los webinars | Impulse ITS::..',
        );

        if (isset($_GET['id_curso']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_curso'] = $_GET['id_curso'];
            if ($lo_paginaInformacion->borrarItem($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=webinars' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showCursosCertificaciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/webinars.php';
    }

    public function nuevo_cuesrionarios()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'webinars';

        if (isset($_GET['id_curso'])) {
            $la_arguments['id_curso'] = $_GET['id_curso'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un webinar | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 3;
            if ($lo_paginaInformacion->accionesCertificaciones($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=webinars' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCertificacion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_curso']) == 0) {
                $la_informacion_curso['informacion_curso']['id_curso']        = '';
                $la_informacion_curso['informacion_curso']['id_categoria']    = '';
                $la_informacion_curso['informacion_curso']['titulo']          = '';
                $la_informacion_curso['informacion_curso']['introduccion']    = '';
                $la_informacion_curso['informacion_curso']['descripcion']     = '';
                $la_informacion_curso['informacion_curso']['objetivos']       = '';
                $la_informacion_curso['informacion_curso']['caracteristicas'] = '';
                $la_informacion_curso['informacion_curso']['dirigido']        = '';
                $la_informacion_curso['informacion_curso']['pre_requisitos']  = '';
                $la_informacion_curso['informacion_curso']['porque_tomarlo']  = '';
                $la_informacion_curso['informacion_curso']['material']        = '';
                $la_informacion_curso['informacion_curso']['temario']         = '';
                $la_informacion_curso['informacion_curso']['precio']          = '';
                $la_informacion_curso['informacion_curso']['duracion']        = '';
                $la_informacion_curso['informacion_curso']['id_instructor']   = '';
                $la_informacion_curso['informacion_curso']['otras_notas']     = '';
                $la_informacion_curso['informacion_curso']['path_portada']    = '';
                $la_informacion_curso['informacion_curso']['status']          = 1;
                $la_informacion_curso['informacion_curso']['fecha_inicia']    = '';
                $la_informacion_curso['informacion_curso']['secuencia']       = '';
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                      = array_merge($params);
        $params['categorias']        = $la_categorias;
        $params['instructores']      = $la_instructores;
        $params['informacion_curso'] = $la_informacion_curso['informacion_curso'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_webinar.php';
    }
    public function cuesrionarios()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 3;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los webinars | Impulse ITS::..',
        );

        if (isset($_GET['id_curso']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_curso'] = $_GET['id_curso'];
            if ($lo_paginaInformacion->borrarItem($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=cuestionarios' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showCursosCertificaciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/cuestionarios.php';
    }

    public function nuevo_slider()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        //$la_arguments['tipo_categoria'] = 'servicios';

        if (isset($_GET['id_slider'])) {
            $la_arguments['id_slider'] = $_GET['id_slider'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un slider | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesSliders($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=sliders' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion del slider*/
        if ($lo_paginaInformacion->obtieneDatosSlider($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion']) == 0) {
                $la_informacion_curso['informacion']['id_slider'] = '';
                $la_informacion_curso['informacion']['titulo']    = '';
                $la_informacion_curso['informacion']['texto']     = '';
                $la_informacion_curso['informacion']['status']    = 1;
            }
        }

        $params                = array_merge($params);
        $params['informacion'] = $la_informacion_curso['informacion'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_slider.php';
    }

    public function sliders()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas los sliders del sitio | Impulse ITS::..',
        );

        if (isset($_GET['id_slider']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_slider'] = $_GET['id_slider'];
            if ($lo_paginaInformacion->borrarItemSlider($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=sliders' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->obtieneTodosSliders($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/sliders.php';
    }

    public function sugerencias()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas las sugerencias del sitio | Impulse ITS::..',
        );

        if ($lo_paginaInformacion->obtieneTodasSugerencias($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/sugerencias.php';
    }

    public function menu()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'menu';

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configurar menú | Impulse ITS::..',
        );

        /*Cambia status*/
        if (isset($_GET['action'])) {
            if ($lo_paginaInformacion->accionesMenuItem($_GET, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=menu' . $_SESSION['QUERY_STRING'] . '&status=success');
            }
        }

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesMenu($_POST, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=menu' . $_SESSION['QUERY_STRING'] . '&status=success');
            }
        }

        /*Consulta informacion de la configuración*/
        if ($lo_paginaInformacion->obtieneMenu($la_arguments, $la_menu, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_menu) == 0) {
                $la_menu = array();
            }
        }

        $params         = array_merge($params);
        $params['menu'] = $la_menu;
        require __DIR__ . '/../Views/panel/paginas/menu.php';
    }

    public function nuevo_partner()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'instructores';

        if (isset($_GET['id_partner'])) {
            $la_arguments['id_partner'] = $_GET['id_partner'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un partner | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesPartners($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=partners' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosPartner($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_partner']) == 0) {
                $la_informacion_curso['informacion_partner']['id_partner']   = '';
                $la_informacion_curso['informacion_partner']['nombre']       = '';
                $la_informacion_curso['informacion_partner']['path_portada'] = '';
                $la_informacion_curso['informacion_partner']['status']       = 1;
            }
        }

        $params                        = array_merge($params);
        $params['informacion_partner'] = $la_informacion_curso['informacion_partner'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_partner.php';
    }

    public function partners()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 2;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los partners en el sitio web | Impulse ITS::..',
        );

        if (isset($_GET['id_partner']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_partner'] = $_GET['id_partner'];
            if ($lo_paginaInformacion->borrarItemPartner($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=partners' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showTodosPartners($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/partners.php';
    }

    public function subtitulos()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'subtitulos';

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Subtítulos de cursos y certificaciones | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesSubtitulos($_POST, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=subtitulos' . $_SESSION['QUERY_STRING'] . '&status=success');
            }
        }

        /*Consulta informacion de la configuración*/
        if ($lo_paginaInformacion->obtieneDatosSubtitulos($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_subtitulos']) == 0) {
                $la_informacion_curso['informacion_subtitulos']['introduccion']     = '';
                $la_informacion_curso['informacion_subtitulos']['descripcion']      = '';
                $la_informacion_curso['informacion_subtitulos']['objetivos']        = '';
                $la_informacion_curso['informacion_subtitulos']['caracteristicas']  = '';
                $la_informacion_curso['informacion_subtitulos']['dirigido']         = '';
                $la_informacion_curso['informacion_subtitulos']['prerequisitos']    = '';
                $la_informacion_curso['informacion_subtitulos']['tomarlo_nosotros'] = '';
                $la_informacion_curso['informacion_subtitulos']['material_estudio'] = '';
                $la_informacion_curso['informacion_subtitulos']['temario']          = '';
                $la_informacion_curso['informacion_subtitulos']['otrasnotas']       = '';
            }
        }

        $params                           = array_merge($params);
        $params['informacion_subtitulos'] = $la_informacion_curso['informacion_subtitulos'];

        require __DIR__ . '/../Views/panel/paginas/subtitulos.php';
    }

    public function nuevo_servicio()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'servicios';

        if (isset($_GET['id_servicio'])) {
            $la_arguments['id_servicio'] = $_GET['id_servicio'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un servicio | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesServicios($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=servicios' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion del servicio*/
        if ($lo_paginaInformacion->obtieneDatosServicio($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_servicio']) == 0) {
                $la_informacion_curso['informacion_servicio']['id_categoria'] = '';
                $la_informacion_curso['informacion_servicio']['id_servicio']  = '';
                $la_informacion_curso['informacion_servicio']['titulo']       = '';
                $la_informacion_curso['informacion_servicio']['introduccion'] = '';
                $la_informacion_curso['informacion_servicio']['descripcion']  = '';
                $la_informacion_curso['informacion_servicio']['path_portada'] = '';
                $la_informacion_curso['informacion_servicio']['status']       = 1;
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                         = array_merge($params);
        $params['categorias']           = $la_categorias;
        $params['informacion_servicio'] = $la_informacion_curso['informacion_servicio'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_servicio.php';
    }

    public function servicios()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 2;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los servicios | Impulse ITS::..',
        );

        if (isset($_GET['id_servicio']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_servicio'] = $_GET['id_servicio'];
            if ($lo_paginaInformacion->borrarItemServicio($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=servicios' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showServicios($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/servicios.php';
    }

    public function calendario()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'calendario';
        $lo_paginaInformacion           = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o quitar cursos y certificaciones a fechas | Impulse ITS::..',
        );
        $ls_events = '';
        $ls_events .= 'events: [';
        $ls_curso = '';
        if ($lo_paginaInformacion->showCursosCalendario($la_arguments, $la_dataEvents, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
            $ls_curso          = '';
        } else {
            if (count($la_dataEvents) > 0) {
                $ls_eventos_string = '';
                foreach ($la_dataEvents as $evento) {
                    $ls_eventos_string .= "{
                                        id: '" . $evento['id_curso'] . "',
                                        title: '" . $evento['titulo'] . "',
                                        start: '" . $evento['fecha'] . "',
                                        color: '" . $evento['color'] . "'
                                    },";
                }
                $ls_curso .= trim($ls_eventos_string, ',');
            } else {
                $ls_curso = '';
            }
        }
        $ls_events .= $ls_curso;
        $ls_events .= '],';
        $params['eventos'] = $ls_events;
        $params            = array_merge($params);

        require __DIR__ . '/../Views/panel/paginas/calendario.php';
    }

    public function nuevo_testimonio()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'testimonios';

        if (isset($_GET['id_testimonio'])) {
            $la_arguments['id_testimonio'] = $_GET['id_testimonio'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un testimonio | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesTestimonios($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=testimonios' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosTestimonio($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_testimonio']) == 0) {
                $la_informacion_curso['informacion_testimonio']['id_testimonio'] = '';
                $la_informacion_curso['informacion_testimonio']['nombre']        = '';
                $la_informacion_curso['informacion_testimonio']['puesto']        = '';
                $la_informacion_curso['informacion_testimonio']['testimonio']    = '';
                $la_informacion_curso['informacion_testimonio']['status']        = 1;
            }
        }

        $params                           = array_merge($params);
        $params['informacion_testimonio'] = $la_informacion_curso['informacion_testimonio'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_testimonio.php';
    }

    public function testimonios()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los testimonios del sitio | Impulse ITS::..',
        );

        if (isset($_GET['id_testimonio']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_testimonio'] = $_GET['id_testimonio'];
            if ($lo_paginaInformacion->borrarItemTestimonio($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=testimonios' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showTodosTestimonios($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['testimonios'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/testimonios.php';
    }

    public function logout()
    {
        $params = array(
            'title' => 'Sesión finalizada | Impulse ITS::..',
        );

        require __DIR__ . '/../Views/panel/logout.php';
    }

    public function nuevo_usuario()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'usuarios';

        if (isset($_GET['id_usuario'])) {
            $la_arguments['id_usuario'] = $_GET['id_usuario'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un usuario | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 1;
            if ($lo_paginaInformacion->accionesUsuarios($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=usuarios' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosUsuarioFull($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_usuario']) == 0) {
                $la_informacion_curso['informacion_usuario']['id_usuario']       = '';
                $la_informacion_curso['informacion_usuario']['nombre']           = '';
                $la_informacion_curso['informacion_usuario']['apellido_paterno'] = '';
                $la_informacion_curso['informacion_usuario']['apellido_materno'] = '';
                $la_informacion_curso['informacion_usuario']['mail']             = '';
                $la_informacion_curso['informacion_usuario']['tipo_usuario']     = '';
                $la_informacion_curso['informacion_usuario']['password']         = '';
                $la_informacion_curso['informacion_usuario']['status']           = 1;
            }
        }

        $params                        = array_merge($params);
        $params['informacion_usuario'] = $la_informacion_curso['informacion_usuario'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_usuario.php';
    }

    public function usuarios()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas los usuarios | Impulse ITS::..',
        );

        if ($lo_paginaInformacion->showTodosUsuarios($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];
        require __DIR__ . '/../Views/panel/paginas/usuarios.php';
    }

    public function nueva_categoria()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'cursos';

        if (isset($_GET['id_categoria'])) {
            $la_arguments['id_categoria'] = $_GET['id_categoria'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un curso | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 1;
            if ($lo_paginaInformacion->accionesCategorias($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=categorias' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCategoria($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_categoria']) == 0) {
                $la_informacion_curso['informacion_categoria']['id_categoria'] = '';
                $la_informacion_curso['informacion_categoria']['categoria']    = '';
                $la_informacion_curso['informacion_categoria']['descripcion']  = '';
                $la_informacion_curso['informacion_categoria']['tipo']         = '';
                $la_informacion_curso['informacion_categoria']['status']       = 1;
            }
        }

        $params                          = array_merge($params);
        $params['informacion_categoria'] = $la_informacion_curso['informacion_categoria'];

        require __DIR__ . '/../Views/panel/paginas/nueva_categoria.php';
    }

    public function categorias()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas las categorias | Impulse ITS::..',
        );

        /*Borrar categoría*/
        if (isset($_GET['id_categoria']) && isset($_GET['id_categoria']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_categoria'] = $_GET['id_categoria'];
            if ($lo_paginaInformacion->borrarItemCategoria($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=categorias' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showTodasCategorias($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];
        require __DIR__ . '/../Views/panel/paginas/categorias.php';
    }

    public function configuraciones()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'configuraciones';

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configuraciones básica sitio web | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesConfiguracionSitio($_POST, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=configuraciones' . $_SESSION['QUERY_STRING'] . '&status=success');
            }
        }

        /*Consulta informacion de la configuración*/
        if ($lo_paginaInformacion->obtieneDatosConfiguracion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_configuracion']) == 0) {
                $la_informacion_curso['informacion_configuracion']['twitter']                     = '';
                $la_informacion_curso['informacion_configuracion']['facebook']                    = '';
                $la_informacion_curso['informacion_configuracion']['google']                      = '';
                $la_informacion_curso['informacion_configuracion']['instagram']                   = '';
                $la_informacion_curso['informacion_configuracion']['linkedin']                    = '';
                $la_informacion_curso['informacion_configuracion']['youtube']                     = '';
                $la_informacion_curso['informacion_configuracion']['telefono']                    = '';
                $la_informacion_curso['informacion_configuracion']['mail']                        = '';
                $la_informacion_curso['informacion_configuracion']['domicilio']                   = '';
                $la_informacion_curso['informacion_configuracion']['mensaje_suscripcion']         = '';
                $la_informacion_curso['informacion_configuracion']['acerca_de']                   = '';
                $la_informacion_curso['informacion_configuracion']['cursos_destacables']          = '';
                $la_informacion_curso['informacion_configuracion']['certificaciones_destacables'] = '';
                $la_informacion_curso['informacion_configuracion']['mostrar_instructores']        = '0';
                $la_informacion_curso['informacion_configuracion']['mostrar_campo_empresa']       = '0';
                $la_informacion_curso['informacion_configuracion']['mostrar_campo_cursos']        = '0';
                $la_informacion_curso['informacion_configuracion']['mostrar_campo_celular']       = '0';
                $la_informacion_curso['informacion_configuracion']['mostrar_partners']            = '0';
                $la_informacion_curso['informacion_configuracion']['mostrar_webinars']            = '0';
            }
        }

        $params                              = array_merge($params);
        $params['informacion_configuracion'] = $la_informacion_curso['informacion_configuracion'];

        require __DIR__ . '/../Views/panel/paginas/configuraciones.php';
    }

    public function nuevo_instructor()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'instructores';

        if (isset($_GET['id_instructor'])) {
            $la_arguments['id_instructor'] = $_GET['id_instructor'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un instructor | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->accionesInstructores($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=instructores' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosInstructor($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_instructor']) == 0) {
                $la_informacion_curso['informacion_instructor']['id_instructor'] = '';
                $la_informacion_curso['informacion_instructor']['nombre']        = '';
                $la_informacion_curso['informacion_instructor']['informacion']   = '';
                $la_informacion_curso['informacion_instructor']['path_portada']  = '';
                $la_informacion_curso['informacion_instructor']['status']        = 1;
            }
        }

        $params                           = array_merge($params);
        $params['informacion_instructor'] = $la_informacion_curso['informacion_instructor'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_instructor.php';
    }

    public function instructores()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 2;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los instructores en el sitio web | Impulse ITS::..',
        );

        if (isset($_GET['id_instructor']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_instructor'] = $_GET['id_instructor'];
            if ($lo_paginaInformacion->borrarItemInstructor($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=instructores' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showTodosInstructores($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/instructores.php';
    }

    public function suscripciones()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas las suscripciones al sitio web | Impulse ITS::..',
        );

        if (isset($_GET['action']) && ($_GET['action'] == 'baja' || $_GET['action'] == 'activar')) {
            if ($lo_paginaInformacion->cambiaStatusSuscripcion($_GET, $la_informacion, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->obtieneTodasSuscripciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/suscripciones.php';
    }

    public function mensajes()
    {
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas los mensajes del sitio | Impulse ITS::..',
        );

        if ($lo_paginaInformacion->obtieneTodosMensajes($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/mensajes.php';
    }

    public function nueva_entrada()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'blog';

        if (isset($_GET['id_curso'])) {
            $la_arguments['id_curso'] = $_GET['id_curso'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un curso | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 2;
            if ($lo_paginaInformacion->accionesCertificaciones($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=entradas' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCertificacion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_curso']) == 0) {
                $la_informacion_curso['informacion_curso']['id_curso']        = '';
                $la_informacion_curso['informacion_curso']['id_categoria']    = '';
                $la_informacion_curso['informacion_curso']['titulo']          = '';
                $la_informacion_curso['informacion_curso']['introduccion']    = '';
                $la_informacion_curso['informacion_curso']['descripcion']     = '';
                $la_informacion_curso['informacion_curso']['objetivos']       = '';
                $la_informacion_curso['informacion_curso']['caracteristicas'] = '';
                $la_informacion_curso['informacion_curso']['dirigido']        = '';
                $la_informacion_curso['informacion_curso']['pre_requisitos']  = '';
                $la_informacion_curso['informacion_curso']['porque_tomarlo']  = '';
                $la_informacion_curso['informacion_curso']['material']        = '';
                $la_informacion_curso['informacion_curso']['temario']         = '';
                $la_informacion_curso['informacion_curso']['precio']          = '';
                $la_informacion_curso['informacion_curso']['duracion']        = '';
                $la_informacion_curso['informacion_curso']['id_instructor']   = '';
                $la_informacion_curso['informacion_curso']['otras_notas']     = '';
                $la_informacion_curso['informacion_curso']['path_portada']    = '';
                $la_informacion_curso['informacion_curso']['id_usuario']      = '';
                $la_informacion_curso['informacion_curso']['status']          = 1;
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta usuarios*/
        if ($lo_paginaInformacion->showUsuariosEntrada($la_arguments, $la_usuarios, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                      = array_merge($params);
        $params['categorias']        = $la_categorias;
        $params['instructores']      = $la_instructores;
        $params['usuarios']          = $la_usuarios;
        $params['informacion_curso'] = $la_informacion_curso['informacion_curso'];
        require __DIR__ . '/../Views/panel/paginas/nueva_entrada.php';
    }

    public function entradas()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 2;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas las entradas del blog | Impulse ITS::..',
        );

        if (isset($_GET['id_curso']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_curso'] = $_GET['id_curso'];
            if ($lo_paginaInformacion->borrarItem($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=entradas' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showCursosCertificaciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/entradas.php';
    }

    public function nuevo_curso()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'cursos';

        if (isset($_GET['id_curso'])) {
            $la_arguments['id_curso'] = $_GET['id_curso'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar un curso | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 1;
            if ($lo_paginaInformacion->accionesCertificaciones($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=cursos' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCertificacion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_curso']) == 0) {
                $la_informacion_curso['informacion_curso']['id_curso']        = '';
                $la_informacion_curso['informacion_curso']['id_categoria']    = '';
                $la_informacion_curso['informacion_curso']['titulo']          = '';
                $la_informacion_curso['informacion_curso']['introduccion']    = '';
                $la_informacion_curso['informacion_curso']['descripcion']     = '';
                $la_informacion_curso['informacion_curso']['objetivos']       = '';
                $la_informacion_curso['informacion_curso']['caracteristicas'] = '';
                $la_informacion_curso['informacion_curso']['dirigido']        = '';
                $la_informacion_curso['informacion_curso']['pre_requisitos']  = '';
                $la_informacion_curso['informacion_curso']['porque_tomarlo']  = '';
                $la_informacion_curso['informacion_curso']['material']        = '';
                $la_informacion_curso['informacion_curso']['temario']         = '';
                $la_informacion_curso['informacion_curso']['precio']          = '';
                $la_informacion_curso['informacion_curso']['duracion']        = '';
                $la_informacion_curso['informacion_curso']['id_instructor']   = '';
                $la_informacion_curso['informacion_curso']['otras_notas']     = '';
                $la_informacion_curso['informacion_curso']['path_portada']    = '';
                $la_informacion_curso['informacion_curso']['status']          = 1;
                $la_informacion_curso['informacion_curso']['fecha_inicia']    = '';
                $la_informacion_curso['informacion_curso']['secuencia']       = '';
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                      = array_merge($params);
        $params['categorias']        = $la_categorias;
        $params['instructores']      = $la_instructores;
        $params['informacion_curso'] = $la_informacion_curso['informacion_curso'];

        require __DIR__ . '/../Views/panel/paginas/nuevo_curso.php';
    }

    public function cursos()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 1;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todos los cursos | Impulse ITS::..',
        );

        if (isset($_GET['id_curso']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_curso'] = $_GET['id_curso'];
            if ($lo_paginaInformacion->borrarItem($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=certificaciones' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }

        if ($lo_paginaInformacion->showCursosCertificaciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/cursos.php';
    }
    public function cursos_clientes()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 1;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver los cursos de clientes | Impulse ITS::..',
        );

        if ($lo_paginaInformacion->showCursosClientes($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];

        require __DIR__ . '/../Views/panel/paginas/cursos_clientes.php';
    }

    public function nueva_certificacion()
    {
        $la_arguments                   = array();
        $la_arguments['id_pagina']      = $_GET['seccion'];
        $la_arguments['tipo_categoria'] = 'certificaciones';

        if (isset($_GET['id_curso'])) {
            $la_arguments['id_curso'] = $_GET['id_curso'];
        }

        $lo_paginaInformacion = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Agregar o editar una certificación | Impulse ITS::..',
        );

        /*Actualiza/insertar informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['tipo_publicacion'] = 0;
            if ($lo_paginaInformacion->accionesCertificaciones($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=certificaciones' . $_SESSION['QUERY_STRING'] . '&status=success&action=' . $_POST['action']);
            }
        }

        /*Consulta informacion de la certificación*/
        if ($lo_paginaInformacion->obtieneDatosCertificacion($la_arguments, $la_informacion_curso, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        } else {
            if (count($la_informacion_curso['informacion_curso']) == 0) {
                $la_informacion_curso['informacion_curso']['id_curso']        = '';
                $la_informacion_curso['informacion_curso']['id_categoria']    = '';
                $la_informacion_curso['informacion_curso']['titulo']          = '';
                $la_informacion_curso['informacion_curso']['introduccion']    = '';
                $la_informacion_curso['informacion_curso']['descripcion']     = '';
                $la_informacion_curso['informacion_curso']['objetivos']       = '';
                $la_informacion_curso['informacion_curso']['caracteristicas'] = '';
                $la_informacion_curso['informacion_curso']['dirigido']        = '';
                $la_informacion_curso['informacion_curso']['pre_requisitos']  = '';
                $la_informacion_curso['informacion_curso']['porque_tomarlo']  = '';
                $la_informacion_curso['informacion_curso']['material']        = '';
                $la_informacion_curso['informacion_curso']['temario']         = '';
                $la_informacion_curso['informacion_curso']['precio']          = '';
                $la_informacion_curso['informacion_curso']['duracion']        = '';
                $la_informacion_curso['informacion_curso']['id_instructor']   = '';
                $la_informacion_curso['informacion_curso']['otras_notas']     = '';
                $la_informacion_curso['informacion_curso']['path_portada']    = '';
                $la_informacion_curso['informacion_curso']['status']          = 1;
                $la_informacion_curso['informacion_curso']['fecha_inicia']    = '';
                $la_informacion_curso['informacion_curso']['secuencia']       = '';
            }
        }

        /*Consulta categorias*/
        if ($lo_paginaInformacion->showCategorias($la_arguments, $la_categorias, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        /*Consulta instructores*/
        if ($lo_paginaInformacion->showInstructores($la_arguments, $la_instructores, $ls_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params                      = array_merge($params);
        $params['categorias']        = $la_categorias;
        $params['instructores']      = $la_instructores;
        $params['informacion_curso'] = $la_informacion_curso['informacion_curso'];
        require __DIR__ . '/../Views/panel/paginas/nueva_certificacion.php';
    }

    public function certificaciones()
    {
        $la_arguments['id_pagina']        = $_GET['seccion'];
        $la_arguments['tipo_publicacion'] = 0;
        $lo_paginaInformacion             = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Ver todas las certificaciones | Impulse ITS::..',
        );

        if (isset($_GET['id_curso']) && isset($_GET['action']) && $_GET['action'] == 'borrar') {
            $la_dataIn['id_curso'] = $_GET['id_curso'];
            if ($lo_paginaInformacion->borrarItem($la_dataIn, $ls_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                header('Location: index.php?seccion=certificaciones' . $_SESSION['QUERY_STRING'] . '&status=success&action=borrar');
            }
        }
        if ($lo_paginaInformacion->showCursosCertificaciones($la_arguments, $la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }
        $params['informacion'] = $la_informacion['informacion'];
        $params['paginacion']  = $la_informacion['paginacion'];
        require __DIR__ . '/../Views/panel/paginas/certificaciones.php';
    }

    public function privacidad()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Aviso de privacidad | Impulse ITS::..',
        );

        /*Actualiza informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->actualizaPaginaGenerica($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                $params['mensaje_ok'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->showInfoGenerica($la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params = array_merge($params, $la_informacion);

        require __DIR__ . '/../Views/panel/paginas/privacidad.php';
    }

    public function valores()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configurar valores | Impulse ITS::..',
        );

        /*Actualiza informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->actualizaPaginaGenerica($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                $params['mensaje_ok'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->showInfoGenerica($la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params = array_merge($params, $la_informacion);

        require __DIR__ . '/../Views/panel/paginas/valores.php';
    }

    public function vision()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configurar visión | Impulse ITS::..',
        );

        /*Actualiza informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->actualizaPaginaGenerica($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                $params['mensaje_ok'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->showInfoGenerica($la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params = array_merge($params, $la_informacion);

        require __DIR__ . '/../Views/panel/paginas/vision.php';
    }

    public function mision()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configurar misión | Impulse ITS::..',
        );

        /*Actualiza informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->actualizaPaginaGenerica($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                $params['mensaje_ok'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->showInfoGenerica($la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params = array_merge($params, $la_informacion);

        require __DIR__ . '/../Views/panel/paginas/mision.php';
    }

    public function nosotros()
    {
        $la_arguments              = array();
        $la_arguments['id_pagina'] = $_GET['seccion'];
        $lo_paginaInformacion      = new ModelAdmin($la_arguments);

        $params = array(
            'title' => 'Configurar nosotros | Impulse ITS::..',
        );

        /*Actualiza informacion*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_paginaInformacion->actualizaPagina($_POST, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
            } else {
                $params['mensaje_ok'] = $arg_mensaje;
            }
        }

        if ($lo_paginaInformacion->showInfoNosotros($la_informacion, $arg_mensaje) < 0) {
            $params['mensaje'] = $arg_mensaje;
        }

        $params = array_merge($params, $la_informacion);
        require __DIR__ . '/../Views/panel/paginas/nosotros.php';
    }

    public function panel_admin()
    {
        $la_arguments  = array();
        $model_usuario = new ModelAdmin($la_arguments);
        $params        = array(
            'title' => 'Panel de administración | Impulse ITS::..',
        );

        $la_dataUsuario       = $model_usuario->obtieneDatosUsuario();
        $la_dataIn            = array();
        $la_dataIn['seccion'] = 'panel';
        if ($model_usuario->obtieneMensajes($la_dataIn, $la_dataSal, $ls_mensaje) < 0) {
            $params['mensaje'] = $ls_mensaje;
        }

        if ($model_usuario->obtieneSuscripciones($la_dataIn, $la_dataSuscribe, $ls_mensaje) < 0) {
            $params['mensaje'] = $ls_mensaje;
        }

        if ($model_usuario->showIndicadores($la_dataIn, $la_dataIndicador, $ls_mensaje) < 0) {
            $params['mensaje'] = $ls_mensaje;
        }

        $params                   = array_merge($params, $la_dataUsuario);
        $params['mensajes']       = $la_dataSal['informacion'];
        $params['paginacion_msj'] = $la_dataSal['paginacion'];

        $params['suscripciones']       = $la_dataSuscribe['informacion'];
        $params['paginacion_suscribe'] = $la_dataSuscribe['paginacion'];

        $params['total_suscripciones']   = $la_dataIndicador['total_suscripciones'];
        $params['total_certificaciones'] = $la_dataIndicador['total_certificaciones'];
        $params['total_cursos']          = $la_dataIndicador['total_cursos'];
        $params['total_mensajes']        = $la_dataIndicador['total_mensajes'];
        require __DIR__ . '/../Views/panel/paginas/principal.php';
    }

    public function password()
    {
        $la_mensajes = array();
        $model_login = new ModelGeneral();
        $params      = array(
            'title' => 'Recuperar contraseña | Impulse ITS::..',
        );

        /*Validar formulario*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            /*Iniciar sesión*/
            if ($model_login->validarFormularioLogin($_POST) == 1) {
                if (!$model_login->validaMailLogin($_POST['mail'])) {
                    $params['mensaje'] = 'Debes ingresar un correo electrónico válido';
                    $params['return']  = -1;
                }

            } else {
                if ($_POST['mail'] == '') {
                    $params['mensaje'] = 'Debes ingresar tu correo electrónico';
                    $params['return']  = -1;
                }
            }
        } else {
            $_POST['mail'] = '';
        }
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            header("Location: index.php?seccion=panel_admin" . $_SESSION['QUERY_STRING']);
        } else {
            require __DIR__ . '/../Views/panel/password.php';
        }
    }

    public function login()
    {
        $la_mensajes   = array();
        $model_login   = new ModelAdmin();
        $model_general = new ModelGeneral();
        $params        = array(
            'title' => 'Iniciar sesión | Impulse ITS::..',
        );

        /*Validar formulario*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /*Iniciar sesión*/
            if ($model_general->validarFormularioLogin($_POST) == 1) {
                if ($model_login->iniciarSesionAdmin($_POST, $la_sesion, $arg_mensaje) < 0) {
                    $params['mensaje'] = $arg_mensaje;
                    $params['return']  = -1;
                } else {
                    $_SESSION['QUERY_STRING'] = '&token=' . base64_encode(date('Y-m-d-H-i-s')) . '&login=true&admin=true';
                    header("Location: index.php?seccion=panel_admin" . $_SESSION['QUERY_STRING']);
                }
            } else {
                if ($_POST['usuario'] == '') {
                    $params['mensaje'] = 'Debes ingresar tu usuario';
                    $params['return']  = -1;
                }

                if ($_POST['password'] == '') {
                    $params['mensaje'] = 'Debes ingresar tu contraseña';
                    $params['return']  = -1;
                }

                if ($_POST['password'] == '' && $_POST['usuario'] == '') {
                    $params['mensaje'] = 'Debes ingresar tu usuario y contraseña';
                    $params['return']  = -1;
                }
            }
        } else {
            $_POST['usuario']    = '';
            $_POST['password']   = '';
            $_POST['recuerdame'] = '';
        }

        if (isset($_SESSION['id_usuario'])) {
            $_SESSION['QUERY_STRING'] = '&token=' . base64_encode(date('Y-m-d-H-i-s')) . '&login=true&admin=true';
            header("Location: index.php?seccion=panel_admin" . $_SESSION['QUERY_STRING']);
        } else {
            require __DIR__ . '/../Views/panel/login.php';
        }
    }
}
