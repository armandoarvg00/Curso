<?php ob_start() ?>

<?php include(__DIR__.'/../componentes/modal_icons.php');?>

<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Configuraciones</li>
  </ol>
</section>

<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'):?>
      <div class="alert alert-success">
          <i class="fa fa-check-circle"></i> Configuraciones actualizadas correctamente
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>

    <?php if(isset($arams['mensaje_error']) && $params['mensaje_error'] <> ''):?>
      <div class="alert alert-danger">
          <i class="fa fa-check-circle"></i> <?php echo $arams['mensaje_error'];?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>
    
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cubes"></i> Redes sociales</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label for="twitter">Twitter / URL</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                <input type="text" maxlenght="150" id="twitter" name="twitter" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['twitter'];?>">
              </div>
            </div>

            <div class="col-md-4">
              <label for="id_twitter">Twitter / ID widget</label>
              <div class="input-group">
                <span class="input-group-addon">#</span>
                <input type="text" maxlenght="150" id="id_twitter" name="id_twitter" class="form-control" placeholder="000000000000" value="<?php echo $params['informacion_configuracion']['id_twitter'];?>">
              </div>
            </div>

            <div class="col-md-4">
              <label for="youtube">Youtube</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
                <input type="text" maxlenght="150" id="youtube" name="youtube" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['youtube'];?>">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <label for="facebook">Facebook</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                <input type="text" maxlenght="150" id="facebook" name="facebook" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['facebook'];?>">
              </div>
            </div>

            <div class="col-md-4">
              <label for="google">Google +</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                <input type="text" maxlenght="150" id="google" name="google" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['google'];?>">
              </div>
            </div>

            <div class="col-md-4">
              <label for="instagram">Instagram</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                <input type="text" maxlenght="150" id="instagram" name="instagram" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['instagram'];?>">
              </div>
            </div>

            <div class="col-md-4" style="margin-top: 10px;">
              <label for="linkedin">LinkedIn</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                <input type="text" maxlenght="150" id="linkedin" name="linkedin" class="form-control" placeholder="http://" value="<?php echo $params['informacion_configuracion']['linkedin'];?>">
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cube"></i> Otros datos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-6">
            <label for="direccion">Intro página principal</label>
            <div class="input-group">          
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <input type="text" id="titulo_intro" name="titulo_intro" class="form-control" placeholder="0" value="<?php echo $params['informacion_configuracion']['titulo_intro'];?>">
            </div>
        
            <div class="input-group">          
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <textarea type="text" maxlenght="500"  rows="4" id="intro" name="intro" class="form-control" placeholder="Redactar..."><?php echo $params['informacion_configuracion']['intro'];?></textarea>
            </div>

            <label for="mostrar_partners">Mostrar partners</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-group"></i></span>
              <select type="text" id="mostrar_partners" name="mostrar_partners" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>

            <label for="mostrar_webinars">Mostrar webinars</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-globe"></i></span>
              <select type="text" id="mostrar_webinars" name="mostrar_webinars" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>

          </div>

          <div class="col-md-6">
            <label for="total_cursos_destacables">Total de cursos destacables</label>
            <div class="input-group">
              <span class="input-group-addon">#</span>
              <input type="number" id="cursos_destacables" name="cursos_destacables" class="form-control" placeholder="0" value="<?php echo $params['informacion_configuracion']['cursos_destacables'];?>">
            </div>
            <br>

            <label for="total_certificaciones_destacables">Total de certificaciones destacables</label>
            <div class="input-group">
              <span class="input-group-addon">#</span>
              <input type="text" id="certificaciones_destacables" name="certificaciones_destacables" class="form-control" placeholder="0" value="<?php echo $params['informacion_configuracion']['certificaciones_destacables'];?>">
            </div>
            <br>

            <label for="mostrar_instructores">Mostrar instructores</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
              <select type="text" id="mostrar_instructores" name="mostrar_instructores" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>
          </div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-star"></i> Puntos destacables</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <label for="descripcion_punto_uno">Punto uno</label>
              <div class="input-group">
                <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_uno" data-icon-destino="uno" data-punto-destino="icon_punto_uno" data-class-original="<?php echo $params['informacion_configuracion']['icon_punto_uno'];?>">
                    <i class="fa <?php echo $params['informacion_configuracion']['icon_punto_uno'];?>" id="uno"></i>
                </span>
                <input type="text" maxlenght="100" id="descripcion_punto_uno" name="descripcion_punto_uno" class="form-control" placeholder="Describa el su frase" value="<?php echo $params['informacion_configuracion']['descripcion_punto_uno'];?>">
                <input type="hidden" name="icon_punto_uno" id="icon_punto_uno" value="<?php echo $params['informacion_configuracion']['icon_punto_uno'];?>">
              </div>
            </div>

            <div class="col-md-6">
              <label for="descripcion_punto_dos">Punto dos</label>
              <div class="input-group">
                <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_dos" data-icon-destino="dos" data-punto-destino="icon_punto_dos" data-class-original="<?php echo $params['informacion_configuracion']['icon_punto_dos'];?>">
                    <i class="fa <?php echo $params['informacion_configuracion']['icon_punto_dos'];?>" id="dos"></i>
                </span>
                <input type="text" maxlenght="100" id="descripcion_punto_dos" name="descripcion_punto_dos" class="form-control" placeholder="Describa el su frase" value="<?php echo $params['informacion_configuracion']['descripcion_punto_dos'];?>">
                <input type="hidden" name="icon_punto_dos" id="icon_punto_dos" value="<?php echo $params['informacion_configuracion']['icon_punto_dos'];?>">
              </div>
            </div>
          </div>

          <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
              <label for="descripcion_punto_tres">Punto tres</label>
              <div class="input-group">
                <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_tres" data-icon-destino="tres" data-punto-destino="icon_punto_tres" data-class-original="<?php echo $params['informacion_configuracion']['icon_punto_tres'];?>">
                    <i class="fa <?php echo $params['informacion_configuracion']['icon_punto_tres'];?>" id="tres"></i>
                </span>
                <input type="text" maxlenght="100" id="descripcion_punto_tres" name="descripcion_punto_tres" class="form-control" placeholder="Describa el su frase" value="<?php echo $params['informacion_configuracion']['descripcion_punto_tres'];?>">
                <input type="hidden" name="icon_punto_tres" id="icon_punto_tres" value="<?php echo $params['informacion_configuracion']['icon_punto_tres'];?>">
              </div>
            </div>

            <div class="col-md-6">
              <label for="descripcion_punto_cuatro">Punto cuatro</label>
              <div class="input-group">
                <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_cuatro" data-icon-destino="cuatro" data-punto-destino="icon_punto_cuatro" data-class-original="<?php echo $params['informacion_configuracion']['icon_punto_cuatro'];?>">
                    <i class="fa <?php echo $params['informacion_configuracion']['icon_punto_cuatro'];?>" id="cuatro"></i>
                </span>
                <input type="text" maxlenght="100" id="descripcion_punto_cuatro" name="descripcion_punto_cuatro" class="form-control" placeholder="Describa el su frase" value="<?php echo $params['informacion_configuracion']['descripcion_punto_cuatro'];?>">
                <input type="hidden" name="icon_punto_cuatro" id="icon_punto_cuatro" value="<?php echo $params['informacion_configuracion']['icon_punto_cuatro'];?>">
              </div>
            </div>
          </div>

        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-danger btn-block" name="btn_submit" id="btn_submit">Guardar</button>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-envelope"></i> Formulario de contacto</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-4">
            <label for="mostrar_campo_empresa">Mostrar campo empresa</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
              <select type="text" id="mostrar_campo_empresa" name="mostrar_campo_empresa" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>
          </div>
          
          <div class="col-md-4">
            <label for="mostrar_campo_cursos">Mostrar campo cursos</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
              <select type="text" id="mostrar_campo_cursos" name="mostrar_campo_cursos" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="mostrar_campo_celular">Mostrar campo celular</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
              <select type="text" id="mostrar_campo_celular" name="mostrar_campo_celular" class="form-control">
                  <option value="1">Sí</option>
                  <option value="0">No</option>
              </select>
            </div>
          </div>

        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-envelope"></i> Información de contacto</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <label for="telefono">Teléfono</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" maxlenght="50" id="telefono" name="telefono" class="form-control" placeholder="+52 ____-_____" value="<?php echo $params['informacion_configuracion']['telefono'];?>">
              </div>
            </div>

            <div class="col-md-6">
              <label for="mail">Correo electrónico</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                <input type="text" maxlenght="150" id="mail" name="mail" class="form-control" placeholder="user@dominio.com" value="<?php echo $params['informacion_configuracion']['mail'];?>">
              </div>
            </div>
          </div>

          <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
              <label for="direccion">Domicilio</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa  fa-map-marker"></i></span>
                <textarea type="text" maxlenght="150" rows="4" id="domicilio" name="domicilio" class="form-control" placeholder="Av. Sin nombre, Col. Centro"><?php echo $params['informacion_configuracion']['domicilio'];?></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <label for="mensaje_suscripcion">Mensaje suscripción</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa  fa-envelope"></i></span>
                <textarea type="text" maxlenght="150"  rows="4" id="mensaje_suscripcion" name="mensaje_suscripcion" class="form-control" placeholder="Escribir mensaje"><?php echo $params['informacion_configuracion']['mensaje_suscripcion'];?></textarea>
              </div>
            </div>

            <div class="col-md-6" style="margin-top: 10px;">
              <label for="direccion">Resumen "acerca de nosotros"</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea type="text"maxlenght="150"  rows="4" id="acerca_de" name="acerca_de" class="form-control" placeholder="Redactar..."><?php echo $params['informacion_configuracion']['acerca_de'];?></textarea>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-envelope"></i> Cabecera</h3>
        </div><!-- /.box-header -->
        
        <div class="box-body">
          <label for="titulo">Cambiar cabecera (Resolución recomendada: 1520x290)</label>
          <div class="input-group">
            <label for="photo">
              <div class="photo-preview" align="center" data-page="<?php echo $_GET['seccion'];?>">
                  <?php if(isset($params['informacion_configuracion']['path_portada']) && $params['informacion_configuracion']['path_portada'] <> ''): ?>
                    <img src="<?php echo $params['informacion_configuracion']['path_portada']; ?>" class="img-responsive" id="img-preview">
                  <?php else: ?>
                    <img src="../img/upload_portada.jpg" class="img-responsive" id="img-preview">
                  <?php endif; ?>
              </div>
              <input type="file" accept="image/*;capture=camera" id="photo" name="photo" style="display: none;">
            </label>
            <input type="hidden" name="path_portada" id="path_portada" value="<?php echo $params['informacion_configuracion']['path_portada']; ?>">
            <!--<?php include(__DIR__ . '/../componentes/quitar_imagen_destacada.php');?>-->
          </div>
          <br>
        </div>

      </div><!-- /.box -->
    </div><!-- /.col -->


  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>