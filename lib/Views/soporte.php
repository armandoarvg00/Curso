<?php ob_start() ?>
  <section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <h1> <br> <b> Inscripción al Curso: <br><br>
          "Ataques y Desarrollo Seguro de Aplicaciones Web" <br><br> </b> </h1>
          <p style="color:white;">
          Al final de este curso los participantes adquirirán competencias en:
          <br><br>
Conocer las amenazas, ataques, vulnerabilidades y riesgos de la seguridad de las aplicaciones web.<br>
Entender con ejercicios prácticos como son explotadas las vulnerabilidades de los aplicativos Web.<br>
Entender el proceso de administración de riesgos de seguridad de las aplicaciones.<br>
Entender cómo aplicar controles de seguridad en todo el ciclo de vida del desarrollo de sistemas.<br>
Conocer cómo implementar algoritmos seguros de criptografía para cifrar información sensible.<br>
Conocer modelos de pruebas de seguridad para mitigar riesgos y deficiencias en los aplicativos de software.<br>
Entender cómo aplicar controles de seguridad en la programación en PHP y JAVA.
<br><br>
AL INCRIBIRSE RECIBIRÁ UN ENLACE AL VIDEO DE UNA MUESTRA DEL CURSO. 
</p>
        </div>
      </div>
    </div>
  </section>
<!--Calendario-->
<?php include('componentes/calendario.php');?>

   <?php if(isset($_GET['status_page']) && $_GET['status_page'] == 'error'): ?>
    <div class="envor-msg envor-msg-error">
      <p>Disculpas, parece que la página solicitada se encuentra temporalmente desactivada o no existe. Haga clic <a href="index.php">aquí</a> para regresar a la página principal.</p>
    </div>
  <?php endif;?>

  <?php if(isset($_GET['status_page']) && $_GET['status_page'] == 'success'): ?>
    <div class="envor-msg envor-msg-success">
      <p>Mensaje enviado correctamente</p>
    </div>
  <?php endif;?>


<script src='https://www.google.com/recaptcha/api.js'></script>


  <section class="envor-section">
    <div class="container">      
      <div class="row">        
        <div class="col-lg-3 col-md-3">
          <h3><strong>Información de </strong> contacto</h3>
          <p class="contact-item"><i class="fa fa-map-marker"></i> <?php echo $params['domicilio'];?></p>
          <p class="contact-item"><i class="fa fa-phone"></i> <?php echo $params['telefono'];?></p>
          <p class="contact-item"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $params['mail'];?>"><?php echo $params['mail'];?></a></p>          
        </div>
        <div class="col-lg-6 col-md-6">
          <form class="envor-f1" name="frm-contacto" id="frm-contacto" method="POST" action="" onsubmit="return f_validar_formulario();">
            

            <p>
                <label for="nombre">Empresa:*</label>
                <input type="text" maxlength="50" onkeypress="return soloLetras(event)" id="empresa" name="empresa" style="width: 100%;" placeholder="Empresa S. A. de C. V." required value="<?php echo $_POST['empresa']; ?>">
            </p>

            <p>
                <label for="nombre">Nombre completo:*</label>
                <input type="text" maxlength="50" onkeypress="return soloLetras(event)" id="nombre" name="nombre" style="width: 100%;" placeholder="Nombre" required value="<?php echo $_POST['nombre']; ?>">
            </p>
            <p>
                <label for="mail">Correo electrónico:*</label>
                <input type="text" maxlength="30" id="mail" name="mail" style="width: 100%;" placeholder="E-mail" required value="<?php echo $_POST['mail']; ?>">
            </p>

            <!--<p>
                <label for="asunto">Asunto:*</label>-->
            <input type="hidden" maxlength="50" onkeypress="return soloLetras(event)" id="asunto" name="asunto" style="width: 100%;" placeholder="Asunto" value="Nuevo ticket de soporte" required value="<?php echo $_POST['asunto']; ?>">
            <!--</p>-->
            <p>
                <label for="telefono">Teléfono:*</label>
                <input type="number" maxlength="10" onkeypress="return soloNumeros(event)" id="telefono" name="telefono" style="width: 100%;" placeholder="+52 0000-0000" required value="<?php echo $_POST['telefono']; ?>">
            </p>

            <p>
              <label for="mensaje">Puesto:</label>
              <input type="text" onkeypress="return soloLetras(event)" maxlength="30" style="width: 100%; " id="mensaje" name="mensaje" placeholder="Ej. Analista en Sistemas..."  required value="<?php echo $_POST['mensaje']; ?>">
            </p>
            
            <p>
                <div class="g-recaptcha" data-sitekey="6Lc-wI8UAAAAAPtaIRDZYW7cHSzSNcT3vJbxA7Ew"></div>
            </p>

            <p>
                
              <button type="submit" class="envor-btn envor-btn-normal envor-btn-primary riva-prev-tab margin-left-0">Enviar</button>
            </p>
          </form>
        </div>
        <div class="col-lg-3 col-md-3">

          <div class="panel panel-default" style="border: none; cursor: pointer;" data-toggle="modal" data-target="#modal-sugerencias">
            <div class="panel-heading" style="background: #c9302c !important; color: #FFF !important; font-size: 16px; margin-top: 40px; padding: 30px; text-align: center;">
              <i class="fa fa-comment"></i> ¿Cómo podemos mejorar para atenderle mejor?<br><u><b>Haga clic aquí</b></u>
            </div>            
          </div>

        </div>
      </div>
    </div>
  </section>

<div class="modal fade" id="modal-sugerencias" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-comment"></i> Queremos saber sus intereses
      </div>
      <div class="modal-body">
        <form id="frm_sugerencias" style="margin-top: 0px; margin-bottom: 5px; padding: 0px;">
          <div class="form-group">
            <label for="exampleInputEmail1">Escriba su nombre</label>
            <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="nombre_sugerencia" name="nombre_sugerencia" placeholder="Escriba su nombre completo">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Correo electrónico</label>
            <input type="text" maxlength="30" class="form-control" id="mail_sugerencia" name="mail_sugerencia" placeholder="ejemplo@impulseits.com">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Redacte su mensaje</label>
            <textarea class="form-control" onkeypress="return soloLetras(event)" maxlength="100" id="mensaje_sugerencia" name="mensaje_sugerencia" rows="3"></textarea>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>
      <div class="modal-footer" style="padding: 5px; margin-top: 5px;">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
        <input type="button" class="btn btn-danger" onclick="f_enviaSugerencias()" value="Enviar">
      </div>
    </div>
  </div>
</div>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>