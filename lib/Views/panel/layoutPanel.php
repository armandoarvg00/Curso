<?php
if(count($_SESSION) == 0){
  header("Location: index.php?seccion=login");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $params['title'];?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../dist/css/skins/skin-red-light.min.css">
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="icon" href="../others/<?php echo Config::$mvc_favicon?>">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red sidebar-mini fixed  sidebar-collapse">
    <div class="wrapper">
      <?php include('componentes/header.php');?>
      <?php include('componentes/sidebar.php');?>
      <div class="content-wrapper">
        <?php echo $contenido; ?>
      </div>
      <?php include('componentes/footer.php');?>
    </div><!-- ./wrapper -->

    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/pages/dashboard.js"></script>
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <script src="../js/funciones.upload.files.js"></script>
    <script src="../js/funciones.seleccionar.icon.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <?php if(isset($_GET['seccion']) && $_GET['seccion'] == 'calendario'): ?>
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.print.css" media="print">
        <link rel="stylesheet" href="../plugins/iCheck/all.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="../plugins/fullcalendar/fullcalendar.lang.js"></script>
        <script src="../plugins/iCheck/icheck.min.js"></script>
        <script src="../js/funciones.eventos.js"></script>
        <script>
          $(function () {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                lang: 'es',
                <?php echo $params['eventos'];?>
                editable: false,
                dayClick: function(date, jsEvent, view) {
                    ls_date = date.format();
                    f_mostrarInformacion(ls_date);
                },

                eventClick: function(calEvent, jsEvent, view) {
                    li_id = calEvent.id;
                    ls_fecha = calEvent.start.format();
                    ls_titulo = calEvent.title;
                    f_borrarInformacion(li_id, ls_fecha, ls_titulo);
                }
            });
          });
        </script>
    <?php endif; ?>
    <script>
      $(function () {
        <?php if(isset($_GET['seccion']) && $_GET['seccion'] == 'nosotros'): ?>
            CKEDITOR.replace('informacion');
            CKEDITOR.replace('porque_nosotros');
        <?php endif;?>

        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'mision' || $_GET['seccion'] == 'vision' || $_GET['seccion'] == 'valores' || $_GET['seccion'] == 'nuevo_instructor' || $_GET['seccion'] == 'privacidad') ) : ?>
            CKEDITOR.replace('informacion');
        <?php endif;?>

        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nuevo_servicio' ) ) : ?>
            $("#id_categoria").val('<?php echo $params['informacion_servicio']['id_categoria']; ?>');
            $("#status").val('<?php echo $params['informacion_servicio']['status']; ?>');
            CKEDITOR.replace('introduccion');
            CKEDITOR.replace('descripcion');
        <?php endif;?>

        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nueva_certificacion' || $_GET['seccion'] == 'nuevo_webinar'  || $_GET['seccion'] == 'nuevo_curso' || $_GET['seccion'] == 'nueva_entrada') ) : ?>
            $("#id_categoria").val('<?php echo $params['informacion_curso']['id_categoria']; ?>');
            $("#status").val('<?php echo $params['informacion_curso']['status']; ?>');
            $("#id_instructor").val('<?php echo $params['informacion_curso']['id_instructor']; ?>');
            $("#es_online").val('<?php echo $params['informacion_curso']['es_online']; ?>');
            $("#user_alta").val('<?php echo $params['informacion_curso']['user_alta']; ?>');

            CKEDITOR.replace('introduccion');
            CKEDITOR.replace('descripcion');
            CKEDITOR.replace('objetivos');
            CKEDITOR.replace('caracteristicas');
            CKEDITOR.replace('dirigido');
            CKEDITOR.replace('pre_requisitos');
            CKEDITOR.replace('porque_tomarlo');
            CKEDITOR.replace('material');
            CKEDITOR.replace('temario');


            $("#fecha_inicia").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        <?php endif;?>

        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'configuraciones' ) ) : ?>
            $("#mostrar_instructores").val('<?php echo $params['informacion_configuracion']['mostrar_instructores']; ?>');
            $("#mostrar_partners").val('<?php echo $params['informacion_configuracion']['mostrar_partners']; ?>');
            $("#mostrar_webinars").val('<?php echo $params['informacion_configuracion']['mostrar_webinars']; ?>');
            $("#mostrar_campo_empresa").val('<?php echo $params['informacion_configuracion']['mostrar_campo_empresa']; ?>');
            $("#mostrar_campo_cursos").val('<?php echo $params['informacion_configuracion']['mostrar_campo_cursos']; ?>');
            $("#mostrar_campo_celular").val('<?php echo $params['informacion_configuracion']['mostrar_campo_celular']; ?>');
        <?php endif;?>
        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nueva_categoria' ) ) : ?>
            $("#tipo").val('<?php echo $params['informacion_categoria']['tipo']; ?>');
            $("#status").val('<?php echo $params['informacion_categoria']['status']; ?>');
        <?php endif;?>
        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nuevo_usuario' ) ) : ?>
            $("#tipo_usuario").val('<?php echo $params['informacion_usuario']['tipo_usuario']; ?>');
            $("#status").val('<?php echo $params['informacion_usuario']['status']; ?>');
        <?php endif;?>
        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nuevo_testimonio' ) ) : ?>
            $("#status").val('<?php echo $params['informacion_testimonio']['status']; ?>');
        <?php endif;?>
        <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'nuevo_slider' ) ) : ?>
            $("#tipo_salider").val('<?php echo $params['informacion']['tipo_slider']; ?>');
        <?php endif;?>
        //CKEDITOR.replace('informacion_porque');
        $(".textarea").wysihtml5();
        
      });
    </script>
    <script src="../js/funciones.buscador.js"></script>
  </body>
</html>
