<?php
session_start();
require_once __DIR__ . '/../lib/Configs/Config.php';
require_once __DIR__ . '/../lib/Models/ModelGeneral.php';
require_once __DIR__ . '/../lib/Models/ModelBackend.php';
require_once __DIR__ . '/../lib/Controllers/ControllerPanelAdmin.php';
require_once __DIR__ . '/../lib/Configs/class.conection.php';
require_once __DIR__ . '/../lib/Configs/PHPMailer/PHPMailerAutoload.php';

$map = array(
        'login' => array(
                'controller' =>'ControllerPanel',
                'action' =>'login'
                ),
        'password' => array(
                'controller' =>'ControllerPanel',
                'action' =>'password'
                ),
        'panel_admin' => array(
                'controller' =>'ControllerPanel',
                'action' =>'panel_admin'
                ),
        'nosotros' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nosotros'
                ),
        'mision' => array(
                'controller' =>'ControllerPanel',
                'action' =>'mision'
                ),
        'vision' => array(
                'controller' =>'ControllerPanel',
                'action' =>'vision'
                ),
        'valores' => array(
                'controller' =>'ControllerPanel',
                'action' =>'valores'
                ),
        'certificaciones' => array(
                'controller' =>'ControllerPanel',
                'action' =>'certificaciones'
                ),

        'nueva_certificacion' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nueva_certificacion'
                ),
        'testimonios' => array(
                'controller' =>'ControllerPanel',
                'action' =>'testimonios'
                ),

        'nuevo_testimonio' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_testimonio'
                ),

        'calendario' => array(
                'controller' =>'ControllerPanel',
                'action' =>'calendario'
                ),

        'cursos' => array(
                'controller' =>'ControllerPanel',
                'action' =>'cursos'
                ),
        'cursos_clientes' => array(
                'controller' =>'ControllerPanel',
                'action' =>'cursos_clientes'
                ),
        'nuevo_curso' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_curso'
                ),
        'webinars' => array(
                'controller' =>'ControllerPanel',
                'action' =>'webinars'
                ),

        'nuevo_webinar' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_webinar'
                ),

        'entradas' => array(
                'controller' =>'ControllerPanel',
                'action' =>'entradas'
                ),
        'nueva_entrada' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nueva_entrada'
                ),

         'mensajes' => array(
                'controller' =>'ControllerPanel',
                'action' =>'mensajes'
                ),

         'suscripciones' => array(
                'controller' =>'ControllerPanel',
                'action' =>'suscripciones'
                ),

         'instructores' => array(
                'controller' =>'ControllerPanel',
                'action' =>'instructores'
                ),

         'nuevo_instructor' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_instructor'
                ),

        'configuraciones' => array(
                'controller' =>'ControllerPanel',
                'action' =>'configuraciones'
                ),

        'privacidad' => array(
                'controller' =>'ControllerPanel',
                'action' =>'privacidad'
                ),

        'usuarios' => array(
                'controller' =>'ControllerPanel',
                'action' =>'usuarios'
                ),
        'nuevo_usuario' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_usuario'
                ),

        'servicios' => array(
                'controller' =>'ControllerPanel',
                'action' =>'servicios'
                ),
        'nuevo_servicio' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_servicio'
                ),

        'categorias' => array(
                'controller' =>'ControllerPanel',
                'action' =>'categorias'
                ),

        'nueva_categoria' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nueva_categoria'
                ),

        'subtitulos' => array(
                'controller' =>'ControllerPanel',
                'action' =>'subtitulos'
                ),

        'partners' => array(
                'controller' =>'ControllerPanel',
                'action' =>'partners'
                ),
        'nuevo_partner' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_partner'
                ),

        'logout' => array(
                'controller' =>'ControllerPanel',
                'action' =>'logout'
                ),
        'sugerencias' => array(
                'controller' =>'ControllerPanel',
                'action' =>'sugerencias'
                ),
        'menu' => array(
                'controller' =>'ControllerPanel',
                'action' =>'menu'
                ),
        'sliders' => array(
                'controller' =>'ControllerPanel',
                'action' =>'sliders'
                ),
        'nuevo_slider' => array(
                'controller' =>'ControllerPanel',
                'action' =>'nuevo_slider'
                )
    );

if (isset($_GET['seccion'])) {
    if (isset($map[$_GET['seccion']])) {
        $ruta = $_GET['seccion'];
    }else{
        //header('Status: 404 Not Found');
        if(isset($_SESSION['id_usuario']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
            //header('Location: index.php?seccion=panel_admin&token='.base64_encode(date('Y-m-d-H-i-s')).'&login=true&admin=true');
        }else{
            header('Location: index.php?seccion=login');
        }
    }
}else{
    /*Inicia sesión usuario tipo administrador
    if(isset($_SESSION['id_usuario']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
        $ruta = 'panel_admin';
    }else{
        $ruta = 'login';
    }*/
}

/*if(isset($_SESSION['id_usuario']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $ruta <> 'logout'){
    $ruta = 'panel_admin';
}*/

$controlador = $map[$ruta];
if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(
                    array(
                            new $controlador['controller'],
                            $controlador['action']
                        )
                );
               
}else{
    //header('Status: 404 Not Found');
    header('Location: index.php?seccion=login');
}
