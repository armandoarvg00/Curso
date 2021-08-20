<?php
error_reporting(0);

require_once __DIR__ . '/lib/Configs/Config.php';
require_once __DIR__ . '/lib/Models/ModelWebsite.php';
require_once __DIR__ . '/lib/Models/ModelGeneral.php';
require_once __DIR__ . '/lib/Controllers/ControllerWebsite.php';
require_once __DIR__ . '/lib/Configs/class.conection.php';
require_once __DIR__ . '/lib/Configs/PHPMailer/class.sendmail.smtp.php';

$map = array(
        'principal' => array(
                'controller' =>'ControllerHome', 
                'action' =>'principal'
                ),
        'nosotros' => array(
                'controller' =>'ControllerHome', 
                'action' =>'nosotros'
                ),
        'mision' => array(
                'controller' =>'ControllerHome', 
                'action' =>'mision'
                ),
        'vision' => array(
                'controller' =>'ControllerHome', 
                'action' =>'vision'
                ),
        'valores' => array(
                'controller' =>'ControllerHome', 
                'action' =>'valores'
                ),
        'certificaciones' => array(
                'controller' =>'ControllerHome', 
                'action' =>'certificaciones'
                ),
        'webinars' => array(
                'controller' =>'ControllerHome', 
                'action' =>'webinars'
                ),
        'cursos' => array(
                'controller' =>'ControllerHome', 
                'action' =>'cursos'
                ),
        'consultoria' => array(
                'controller' =>'ControllerHome', 
                'action' =>'consultoria'
                ),
        'contacto' => array(
                'controller' =>'ControllerHome', 
                'action' =>'contacto'
                ),
        'soporte' => array(
                'controller' =>'ControllerHome', 
                'action' =>'soporte'
                ),
        'blog' => array(
                'controller' =>'ControllerHome', 
                'action' =>'blog'
                ),
        'privacidad' => array(
                'controller' =>'ControllerHome', 
                'action' =>'privacidad'
                ),
        'calendario' => array(
                'controller' =>'ControllerHome', 
                'action' =>'calendario'
                ),
        'gracias' => array(
                'controller' =>'ControllerHome', 
                'action' =>'gracias'
                ),
        'graciaspago' => array(
                'controller' =>'ControllerHome', 
                'action' =>'gracias_pago'
                ),        
        'pagofail' => array(
                'controller' =>'ControllerHome', 
                'action' =>'pago_fail'
                ),                
        'error_404' => array(
                'controller' =>'ControllerHome', 
                'action' =>'error_404'
                )
    );

if (isset($_GET['seccion'])) {
    if (isset($map[$_GET['seccion']])) {
        $ruta = $_GET['seccion'];
    }else{
        //header('Status: 404 Not Found');
        header('Location: index.php?seccion=error_404&status_page=error');
    }
}else{
    $ruta = 'principal';
}

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
    header('Location: index.php?seccion=error_404&status_page=error');
}