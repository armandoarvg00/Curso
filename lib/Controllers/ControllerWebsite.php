<?php

class ControllerHome {

    public function gracias() {
        $la_dataPage['id_pagina'] = 'calendario';
        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => '¡Gracias! Su mensaje se ha enviado correctamente  | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }


        $params = array_merge($params, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();

        require __DIR__ . '/../Views/gracias.php';
    }

    public function calendario() {
        $la_dataPage['id_pagina'] = 'calendario';
        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => 'Calendario de cursos y certificaciones  | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }


        $params = array_merge($params, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();

        require __DIR__ . '/../Views/calendario.php';
    }

    public function consultoria() {
        $la_dataPage['id_pagina'] = 'consultoria';
        if (isset($_GET['id_servicio'])) {
            $la_dataPage['id_servicio'] = $_GET['id_servicio'];
        }

        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => 'Servicios de consultoría | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showConsultoriaPage($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }


        $params = array_merge($params, $la_configPage);
        $params['servicios'] = $la_dataPage;
        $params['eventos'] = $lo_page->eventosCalendario();

        if (isset($_GET['id_servicio'])) {
            if ($lo_page->showFullServicio($la_servicio, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificacion = array();
            }
            $params['title'] = $la_servicio['servicio']['titulo'];
            $params = array_merge($params, $la_servicio);
            require __DIR__ . '/../Views/consultoria-single.php';
        } else {
            require __DIR__ . '/../Views/consultoria.php';
        }
    }

    public function blog() {
        $la_dataPage['id_pagina'] = 'blog';
        $la_dataPage['seccion'] = 'blog';

        $lo_page = new ModelSite($la_dataPage);
        $params = array();
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if (isset($_GET['id_curso'])) {
            $la_dataPage['id_curso'] = $_GET['id_curso'];
        }

        if (isset($_GET['id_categoria'])) {
            $la_dataPage['id_categoria'] = $_GET['id_categoria'];
        }


        $params['title'] = 'Sucesos e información destacable | Impulse ITS::.. Information Technology Solutions';

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        if (!isset($_GET['id_curso'])) {
            if ($lo_page->showEntradas($la_entradas, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_entradas = array();
            }
        } else {
            $la_entradas = array();
        }

        if ($lo_page->showCategorias($la_categorias, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_categorias = array();
        }

        $params['semana'] = array('', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $params['meses'] = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

        $params = array_merge($params, $la_dataPage, $la_configPage, $la_categorias, $la_entradas);
        $params['eventos'] = $lo_page->eventosCalendario();

        if (isset($_GET['id_curso'])) {
            if ($lo_page->showFullEntrada($la_entrada, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificacion = array();
            }
            $params['title'] = $la_entrada['entrada']['titulo'];
            $params = array_merge($params, $la_entrada);
            require __DIR__ . '/../Views/blog-single.php';
        } else {
            require __DIR__ . '/../Views/blog.php';
        }
    }

    public function error_404() {
        $la_dataPage['id_pagina'] = 'error_404';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Error 404 :o( | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();

        require __DIR__ . '/../Views/contacto.php';
    }

    public function soporte() {
        $la_dataPage['id_pagina'] = 'soporte';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Webinars | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_page->nuevoMensaje($_POST, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header("Location: index.php?seccion=gracias");
            }
        } else {
            $_POST['nombre'] = '';
            $_POST['mail'] = '';
            $_POST['asunto'] = '';
            $_POST['telefono'] = '';
            $_POST['mensaje'] = '';
            $_POST['empresa'] = '';
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        require __DIR__ . '/../Views/soporte.php';
    }

    public function contacto() {
        $la_dataPage['id_pagina'] = 'contacto';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Contáctenos ahora mismo | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($lo_page->nuevoMensaje($_POST, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
            } else {
                header("Location: index.php?seccion=gracias");
            }
        } else {
            $_POST['nombre'] = '';
            $_POST['mail'] = '';
            $_POST['asunto'] = '';
            $_POST['telefono'] = '';
            $_POST['mensaje'] = '';
            $_POST['empresa'] = '';
            $_POST['curso'] = '';
            $_POST['celular'] = '';
            $_POST['como_se_entero'] = '';
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/contacto.php';
    }

    public function gracias_pago() {
        $la_dataPage['id_pagina'] = 'graciaspago';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => '¡Gracias por su Pago! | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/gracias_pago.php';
    }

    public function pago_fail() {
        $la_dataPage['id_pagina'] = 'pagofail';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => '¡Pago Fallido! | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/pago_fail.php';
    }

    public function cursos() {
        $la_dataPage['id_pagina'] = 'cursos';
        $la_dataPage['seccion'] = 'cursos';

        if (isset($_GET['id_curso'])) {
            $la_dataPage['id_curso'] = $_GET['id_curso'];
        }

        if (isset($_GET['id_categoria'])) {
            $la_dataPage['id_categoria'] = $_GET['id_categoria'];
        }

        if (isset($_GET['criterio'])) {
            $la_dataPage['criterio'] = $_GET['criterio'];
        }


        $lo_page = new ModelSite($la_dataPage);
        $params = array();

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        $params['title'] = 'Todos nuestros cursos | Impulse ITS::.. Information Technology Solutions';

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        if ($lo_page->showCursos($la_cursos, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_cursos = array();
        }

        if ($lo_page->showCategorias($la_categorias, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_categorias = array();
        }

        $params['semana'] = array('', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $params['meses'] = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

        $la_dataIn = array();
        $la_dataIn['tipo_slider'] = 1;

        if ($lo_page->showSliders($la_dataIn, $la_dataSliders, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPartners = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage, $la_categorias, $la_cursos);
        $params['eventos'] = $lo_page->eventosCalendario();
        $params['sliders'] = $la_dataSliders;
        if (isset($_GET['id_curso'])) {

            if ($lo_page->showFullCertificacion($la_certificacion, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificacion = array();
            }
            $params['title'] = $la_certificacion['certificacion']['titulo'];
            $params = array_merge($params, $la_certificacion);

            $ls_events = '';
            $ls_curso = '';
            if ($lo_page->showCursosCalendarioHome($la_dataPage, $la_dataEvents, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
                $ls_curso = '';
            } else {
                if (count($la_dataEvents) > 0) {
                    $ls_eventos_string = '';
                    foreach ($la_dataEvents as $evento) {
                        if ($evento['tipo_publicacion'] == 1) {
                            $ls_eventos_string .= "'" . $evento['fecha'] . "',";
                        }
                    }
                    $ls_curso .= trim($ls_eventos_string, ',');
                } else {
                    $ls_curso = '';
                }
            }
            $ls_events .= $ls_curso;
            $params['eventos_datepicker'] = $ls_events;
            $params['subtitulos'] = $la_certificacion['subtitulos'];
            require __DIR__ . '/../Views/curso-single.php';
        } else {
            $params['eventos_datepicker'] = '';
            require __DIR__ . '/../Views/cursos.php';
        }
    }

    public function webinars() {
        $la_dataPage['id_pagina'] = 'webinars';
        $la_dataPage['seccion'] = 'webinars';
        if (isset($_GET['id_curso'])) {
            $la_dataPage['id_curso'] = $_GET['id_curso'];
        }

        if (isset($_GET['id_categoria'])) {
            $la_dataPage['id_categoria'] = $_GET['id_categoria'];
        }

        if (isset($_GET['criterio'])) {
            $la_dataPage['criterio'] = $_GET['criterio'];
        }

        $params = array();
        $lo_page = new ModelSite($la_dataPage);
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        $params['title'] = 'Webinars | Impulse ITS::.. Information Technology Solutions';

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        if (!isset($_GET['id_curso'])) {
            if ($lo_page->showCertificaciones($la_certificaciones, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificaciones = array();
            }
        } else {
            $la_certificaciones = array();
        }

        if ($lo_page->showCursos($la_cursos, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_certificaciones = array();
        }

        if ($lo_page->showCategorias($la_categorias, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_categorias = array();
        }


        $params['semana'] = array('', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $params['meses'] = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

        $params = array_merge($params, $la_dataPage, $la_configPage, $la_certificaciones, $la_categorias, $la_cursos);
        $params['eventos'] = $lo_page->eventosCalendario();

        $la_dataIn = array();
        $la_dataIn['tipo_slider'] = 1;

        if ($lo_page->showSliders($la_dataIn, $la_dataSliders, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPartners = array();
        }
        $params['sliders'] = $la_dataSliders;
        if (isset($_GET['id_curso'])) {
            if ($lo_page->showFullCertificacion($la_certificacion, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificacion = array();
            }

            $ls_events = '';
            $ls_curso = '';
            if ($lo_page->showCursosCalendarioHome($la_dataPage, $la_dataEvents, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
                $ls_curso = '';
            } else {
                if (count($la_dataEvents) > 0) {
                    $ls_eventos_string = '';
                    foreach ($la_dataEvents as $evento) {
                        if ($evento['tipo_publicacion'] == 3) {
                            $ls_eventos_string .= "'" . $evento['fecha'] . "',";
                        }
                    }
                    $ls_curso .= trim($ls_eventos_string, ',');
                } else {
                    $ls_curso = '';
                }
            }
            $ls_events .= $ls_curso;
            $params['eventos_datepicker'] = $ls_events;
            $params['title'] = $la_certificacion['certificacion']['titulo'];

            $params = array_merge($params, $la_certificacion);
            require __DIR__ . '/../Views/webinar-single.php';
        } else {
            $params['eventos_datepicker'] = '';
            require __DIR__ . '/../Views/webinars.php';
        }
    }

    public function certificaciones() {
        $la_dataPage['id_pagina'] = 'certificaciones';
        $la_dataPage['seccion'] = 'certificaciones';
        if (isset($_GET['id_curso'])) {
            $la_dataPage['id_curso'] = $_GET['id_curso'];
        }

        if (isset($_GET['id_categoria'])) {
            $la_dataPage['id_categoria'] = $_GET['id_categoria'];
        }

        if (isset($_GET['criterio'])) {
            $la_dataPage['criterio'] = $_GET['criterio'];
        }

        $params = array();
        $lo_page = new ModelSite($la_dataPage);

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        $params['title'] = 'Certificaciones | Impulse ITS::.. Information Technology Solutions';

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        if (!isset($_GET['id_curso'])) {
            if ($lo_page->showCertificaciones($la_certificaciones, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificaciones = array();
            }
        } else {
            $la_certificaciones = array();
        }

        if ($lo_page->showCursos($la_cursos, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_certificaciones = array();
        }

        if ($lo_page->showCategorias($la_categorias, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_categorias = array();
        }


        $params['semana'] = array('', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $params['meses'] = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

        $params = array_merge($params, $la_dataPage, $la_configPage, $la_certificaciones, $la_categorias, $la_cursos);
        $params['eventos'] = $lo_page->eventosCalendario();

        $la_dataIn = array();
        $la_dataIn['tipo_slider'] = 1;

        if ($lo_page->showSliders($la_dataIn, $la_dataSliders, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPartners = array();
        }
        $params['sliders'] = $la_dataSliders;
        if (isset($_GET['id_curso'])) {
            if ($lo_page->showFullCertificacion($la_certificacion, $arg_mensaje) < 0) {
                $params['mensaje_error'] = $arg_mensaje;
                $la_certificacion = array();
            }

            $ls_events = '';
            $ls_curso = '';
            if ($lo_page->showCursosCalendarioHome($la_dataPage, $la_dataEvents, $arg_mensaje) < 0) {
                $params['mensaje'] = $arg_mensaje;
                $ls_curso = '';
            } else {
                if (count($la_dataEvents) > 0) {
                    $ls_eventos_string = '';
                    foreach ($la_dataEvents as $evento) {
                        if ($evento['tipo_publicacion'] == 0) {
                            $ls_eventos_string .= "'" . $evento['fecha'] . "',";
                        }
                    }
                    $ls_curso .= trim($ls_eventos_string, ',');
                } else {
                    $ls_curso = '';
                }
            }
            $ls_events .= $ls_curso;
            $params['eventos_datepicker'] = $ls_events;
            $params['title'] = $la_certificacion['certificacion']['titulo'];
            $params = array_merge($params, $la_certificacion);
            require __DIR__ . '/../Views/certificacion-single.php';
        } else {
            $params['eventos_datepicker'] = '';
            require __DIR__ . '/../Views/certificaciones.php';
        }
    }

    public function valores() {
        $la_dataPage['id_pagina'] = 'valores';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Nuestros valores | Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showPageGeneric($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/valores.php';
    }

    public function vision() {
        $la_dataPage['id_pagina'] = 'vision';
        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => 'Nuestra visión | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showPageGeneric($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/vision.php';
    }

    public function mision() {
        $la_dataPage = array();
        $la_dataPage['id_pagina'] = 'mision';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Nuestra mision | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showPageGeneric($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();

        require __DIR__ . '/../Views/mision.php';
    }

    public function privacidad() {
        $la_dataPage = array();
        $la_dataPage['id_pagina'] = 'privacidad';
        $lo_page = new ModelSite($la_dataPage);
        $params = array(
            'title' => 'Aviso de privacidad | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }

        if ($lo_page->showPageGeneric($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }

        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }

        $params = array_merge($params, $la_dataPage, $la_configPage);
        $params['eventos'] = $lo_page->eventosCalendario();

        require __DIR__ . '/../Views/privacidad.php';
    }

    public function nosotros() {
        $la_dataPage['id_pagina'] = 'nosotros';
        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => 'Acerca de nosotros | Impulse ITS::.. Information Technology Solutions'
        );

        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }


        if ($lo_page->showNosotrosPage($la_dataPageSal, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPageSal = array();
        }



        if ($lo_page->showConfiguracionSitio($la_configPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_configPage = array();
        }


        /* Misión */
        $ls_script = "SELECT * FROM paginas_genericas WHERE (id_empresa = 'IMPL') AND (id_pagina = 'mision') ";
        if (f_SQL($ls_script, $la_null, $la_dataMision, $mensaje_query) < 0) {
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        /* Visión */
        $ls_script = "SELECT * FROM paginas_genericas WHERE (id_empresa = 'IMPL') AND (id_pagina = 'vision') ";
        if (f_SQL($ls_script, $la_null, $la_dataVision, $mensaje_query) < 0) {
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        /* Valores */
        $ls_script = "SELECT * FROM paginas_genericas WHERE (id_empresa = 'IMPL') AND (id_pagina = 'valores') ";
        if (f_SQL($ls_script, $la_null, $la_dataValores, $mensaje_query) < 0) {
            $arg_mensaje = $mensaje_query;
            return -1;
        }

        $params = array_merge($params, $la_dataPageSal, $la_configPage);
        $params['mision'] = $la_dataMision[0];
        $params['vision'] = $la_dataVision[0];
        $params['valores'] = $la_dataValores[0];
        $params['eventos'] = $lo_page->eventosCalendario();
        require __DIR__ . '/../Views/nosotros.php';
    }

    public function principal() {
        $la_dataPage['id_pagina'] = 'principal';

        $lo_page = new ModelSite($la_dataPage);

        $params = array(
            'title' => 'Impulse ITS::.. Information Technology Solutions'
        );
        if ($this->validSuscribe()) {
            if (isset($_GET['suscribe']) && $_GET['suscribe'] == true && isset($_POST['hid_action']) && $_POST['hid_action'] == 1) {
                if ($lo_page->suscribir($_POST, $arg_mensaje) < 0) {
                    $params['mensaje_error'] = $arg_mensaje;
                } else {
                    header("Location: index.php?" . $_SERVER['QUERY_STRING'] . "&status_suscribe=true#suscripcion");
                }
            }
        }
        if ($lo_page->showConfiguracionSitio($la_dataPage, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPage = array();
        }


        if ($lo_page->showInstructores($la_instructores, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_instructores = array();
        }

        if ($lo_page->showCertificaciones($la_certificaciones, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_certificaciones = array();
        }

        if ($lo_page->showCursos($la_cursos, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_cursos = array();
        }

        if ($lo_page->showWebinar($la_webinars, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_webinars = array();
        }

        if ($lo_page->showTestimonios($la_dataTestimonios, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataTestimonios = array();
        }

        if ($lo_page->showPartners($la_dataPartners, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPartners = array();
        }

        $la_dataIn = array();
        $la_dataIn['tipo_slider'] = 0;


        if ($lo_page->showSliders($la_dataIn, $la_dataSliders, $arg_mensaje) < 0) {
            $params['mensaje_error'] = $arg_mensaje;
            $la_dataPartners = array();
        }

        $params = array_merge($params, $la_webinars, $la_dataPage, $la_cursos, $la_certificaciones, $la_instructores, $la_dataTestimonios, $la_dataPartners, $la_dataSliders);
        $params['semana'] = array('', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $params['meses'] = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $params['eventos'] = $lo_page->eventosCalendario();
        $params['partners'] = $la_dataPartners['partners'];
        require __DIR__ . '/../Views/home.php';
    }

    private function validSuscribe() {
        if ($_POST) {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            if (preg_match('/^[a-z0-9 .\-]+$/i', $nombre)) {
                if (is_numeric($telefono)) {
                    if ($this->comprobar_email($mail)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private function comprobar_email($email) {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
    }

}
