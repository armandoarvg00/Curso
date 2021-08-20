<?php ob_start() ?>
  <section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <h1>Contáctenos ahora mismo</h1>          
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
          <p class="contact-item"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $params['mail'];?>"><img src="img/correo_info.jpg"></a></p>          
        </div>
        <div class="col-lg-3 col-md-3">
            <form class="envor-f1" name="frm-contacto" id="frm-contacto" method="POST" action="" onsubmit="return f_validar_formulario();">
            <p>
                <label for="como_se_entero">¿Cómo se enteró de nosotros?</label>
                <select id="como_se_entero" name="como_se_entero" style="max-width: 240px !important;">
                  <option value="Mailing">Mailing</option>
                  <option value="Google">Google</option>
                  <option value="Redes sociales">Redes sociales</option>
                  <option value="Evento">Evento</option>
                  <option value="Referido">Referido</option>
                </select>
            </P>

            <?php if($params['mostrar_campo_empresa'] == 1): ?>
              <p>
                  <label for="nombre">Empresa:*</label>
                  <input type="text" id="empresa" name="empresa" placeholder="Empresa S. A. de C. V." value="<?php echo $_POST['empresa']; ?>">
              </p>
            <?php endif;?>

            <p>
                <label for="nombre">Nombre completo:*</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required value="<?php echo $_POST['nombre']; ?>">
            </p>
            <p>
                <label for="mail">Correo electrónico:*</label>
                <input type="text" id="mail" name="mail" placeholder="E-mail" required value="<?php echo $_POST['mail']; ?>">
            </p>
            <?php if($params['mostrar_campo_cursos'] == 1): ?>
              <p style="display: none;">
                  <label for="nombre">Curso / Certificación:*</label>
                  <select id="curso" name="curso" style="max-width: 240px !important;">
                    <?php if(isset($params['drop_cursos']) && count($params['drop_cursos']) > 0):?>
                      <optgroup label="Certificaciones">
                        <?php foreach($params['drop_cursos'] as $optionCer):?>
                          <?php if($optionCer['tipo_publicacion'] == 0):?>
                            <option value="<?php echo $optionCer['titulo'];?>"><?php echo $optionCer['titulo'];?></option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </optgroup>

                      <optgroup label="Cursos">
                        <?php foreach($params['drop_cursos'] as $optionCer):?>
                          <?php if($optionCer['tipo_publicacion'] == 1):?>
                            <option value="<?php echo $optionCer['titulo'];?>"><?php echo $optionCer['titulo'];?></option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </optgroup>
                    <?php else:?>
                      <option value="">No se han agregado cursos y certificaciones</option>
                    <?php endif;?>
                  </select>
              </p>
            <?php endif;?>
            <p style="display: none;">
                <label for="asunto">Asunto:*</label>
                <?php if(isset($_GET['titulo_webinar']) ):?>
                  <input type="text" id="asunto" name="asunto" placeholder="Asunto" value="Webinar: <?php echo $_GET['titulo_webinar']; ?>">
                <?php else: ?>
                  <input type="text" id="asunto" name="asunto" placeholder="Asunto" value="<?php echo $_POST['asunto']; ?>">
                <?php endif;?>
            </p>
            <p>
                <label for="telefono">Teléfono:*</label>
                <input type="number" id="telefono" name="telefono" placeholder="+52 0000-0000" value="<?php echo $_POST['telefono']; ?>">
            </p>
            <?php if($params['mostrar_campo_celular'] == 1): ?>
              <p style="display: none;">
                  <label for="nombre">Celular:*</label>
                  <input type="number" id="celular" name="celular" placeholder="+52" value="<?php echo $_POST['celular']; ?>">
              </p>
            <?php endif;?>
            <p>
              <label for="mensaje">Mensaje:*</label>
              <textarea onkeypress="return soloLetras(event)" style="min-width: 240px !important;" id="mensaje" name="mensaje" placeholder="Escriba su mensaje..."><?php echo $_POST['mensaje']; ?></textarea>
            </p>
            
            
            <p>
                <div class="g-recaptcha" data-sitekey="6Lc-wI8UAAAAAPtaIRDZYW7cHSzSNcT3vJbxA7Ew"></div>
            </p>
            
            
            <p>
                <button type="submit"  class="envor-btn envor-btn-normal envor-btn-primary riva-prev-tab margin-left-0">Enviar mensaje</button>
            </p>
          </form>
        </div>
        <div class="col-lg-6 col-md-6">
          <div id="map-canvas"></div>    

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
            <input type="text" class="form-control" id="nombre_sugerencia" name="nombre_sugerencia" placeholder="Escriba su nombre completo">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Correo electrónico</label>
            <input type="text" class="form-control" id="mail_sugerencia" name="mail_sugerencia" placeholder="ejemplo@impulseits.com">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Redacte su mensaje</label>
            <textarea class="form-control" id="mensaje_sugerencia" name="mensaje_sugerencia" rows="3"></textarea>
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