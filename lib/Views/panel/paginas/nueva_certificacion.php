<?php ob_start() ?>

<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nueva certificacion</li>
  </ol>
</section>
<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($params['mensaje'])):?>
      <div class="alert alert-danger"><?php echo $params['mensaje'];?></div>
    <?php endif; ?>

    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-flag"></i> Certificación</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <?php if(isset($params['informacion_curso']['id_curso']) && strlen($params['informacion_curso']['id_curso']) > 0): ?>
            <input type="hidden" name="id_curso" value="<?php echo $params['informacion_curso']['id_curso']; ?>">
          <?php endif;?>
          <label for="titulo">Título</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="titulo" name="titulo" class="form-control" placeholder="Escriba un titulo" required value="<?php echo $params['informacion_curso']['titulo']; ?>">
          </div>
          <br>
          <label for="introduccion">Introducción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="introduccion" name="introduccion" class="form-control" placeholder="Redacte la información" required><?php echo $params['informacion_curso']['introduccion']; ?></textarea>
          </div>
          <br>
          <label for="descripcion">Breve descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="descripcion" name="descripcion" class="form-control" placeholder="Redacte la información" required><?php echo $params['informacion_curso']['descripcion']; ?></textarea>
          </div>

          <br>
          <label for="objetivos">Objetivos</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="objetivos" name="objetivos" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['objetivos']; ?></textarea>
          </div>

          <br>
          <label for="caracteristicas">Características</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="caracteristicas" name="caracteristicas" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['caracteristicas']; ?></textarea>
          </div>

          <br>
          <label for="dirigido">¿A quién va dirigido?</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="dirigido" name="dirigido" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['dirigido']; ?></textarea>
          </div>

          <br>
          <label for="pre_requisitos">Pre-requisitos</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="pre_requisitos" name="pre_requisitos" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['pre_requisitos']; ?></textarea>
          </div>

          <br>
          <label for="porque_tomarlo">¿Por qué tomarlo con nostros?</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="porque_tomarlo" name="porque_tomarlo" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['porque_tomarlo']; ?></textarea>
          </div>


          <br>
          <label for="material">Material para estudio del curso</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="material" name="material" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['material']; ?></textarea>
          </div>


          <br>
          <label for="temario">Temario</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="temario" name="temario" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['temario']; ?></textarea>
          </div>

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cog"></i> Opciones</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

          <label for="titulo">Portada  (Recomendada: 550px x 385px)</label>
          <div class="input-group">
            <label for="photo">
              <div class="photo-preview" align="center" data-page="<?php echo $_GET['seccion'];?>">
                  <?php if(isset($params['informacion_curso']['path_portada']) && $params['informacion_curso']['path_portada'] <> ''): ?>
                    <img src="<?php echo $params['informacion_curso']['path_portada']; ?>" class="img-responsive" id="img-preview">
                  <?php else: ?>
                    <img src="../img/upload_portada.jpg" class="img-responsive" id="img-preview">
                  <?php endif; ?>
              </div>
              <input type="file" accept="image/*;capture=camera" id="photo" name="photo" style="display: none;">
            </label>
            <input type="hidden" name="path_portada" id="path_portada" value="<?php echo $params['informacion_curso']['path_portada']; ?>">
            <?php include(__DIR__ . '/../componentes/quitar_imagen_destacada.php');?>
          </div>
          <br>

          <label for="titulo">Categoría</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <select id="id_categoria" name="id_categoria" class="form-control" required>
              <?php if(count($params['categorias']) > 0): ?>
                <option>Seleccione una</option>
                <?php foreach($params['categorias'] as $categoria): ?>
                  <option value="<?php echo $categoria['id_categoria'];?>"><?php echo $categoria['categoria'];?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option>No hay categorías</option>
              <?php endif; ?>
            </select>
          </div>
          <br>

          <label for="precio">Precio</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
            <input type="text" maxlength="15" id="precio" name="precio" class="form-control" placeholder="0.00" value="<?php echo $params['informacion_curso']['precio']; ?>">
          </div>
          <br>

          <label for="precio">PayPal Button</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="paypal" name="paypal" class="form-control" placeholder="PayPal Button" ><?php echo $params['informacion_curso']['paypal']; ?></textarea>
          </div>
          <br>

          <div>
            <label for="precio">Mensualidades (dejar en blanco si no aplican)</label>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" maxlength="15" id="mes0" name="mes0" class="form-control" placeholder="Pago Único" value="<?php echo $params['informacion_curso']['mes0']; ?>">
            </div>            
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              <input type="text" maxlength="15" id="desc__" name="desc__" class="form-control" placeholder="Descuento" value="<?php echo $params['informacion_curso']['desc__']; ?>">
            </div>            
          </div>

          <div class="col-md-12 col-lg-12" style="height: 10px;"></div>

          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" maxlength="15" id="mes3" name="mes3" class="form-control" placeholder="3 Meses" value="<?php echo $params['informacion_curso']['mes3']; ?>">
            </div>            
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" maxlength="15" id="mes6" name="mes6" class="form-control" placeholder="6 Meses" value="<?php echo $params['informacion_curso']['mes6']; ?>">
            </div>            
          </div>

          <div class="col-md-12 col-lg-12" style="height: 10px;"></div>

          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" maxlength="15" id="mes9" name="mes9" class="form-control" placeholder="9 Meses" value="<?php echo $params['informacion_curso']['mes9']; ?>">
            </div>            
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" maxlength="15" id="mes12" name="mes12" class="form-control" placeholder="12 Meses" value="<?php echo $params['informacion_curso']['mes12']; ?>">
            </div>            
          </div>

          <div class="col-md-12 col-lg-12" style="height: 15px;"></div>

          <div>
            <label for="duracion">Duración</label>  
          </div>          
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-hourglass-2"></i></span>
            <input type="text" maxlength="100" id="duracion" name="duracion" class="form-control" placeholder="0" value="<?php echo $params['informacion_curso']['duracion']; ?>">
          </div>
          <br>

          <label for="id_instructor">Instructor</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <select id="id_instructor" name="id_instructor" class="form-control">
              <?php if(count($params['instructores']) > 0): ?>
                <option>Seleccione una</option>
                <?php foreach($params['instructores'] as $instructor): ?>
                  <option value="<?php echo $instructor['id_instructor'];?>"><?php echo $instructor['nombre'];?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option>No hay instructores</option>
              <?php endif; ?>
            </select>
          </div>
          <br>

          <label for="duracion">Fecha inicia</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input data-inputmask="'alias': 'yyyy-mm-dd'" data-mask type="text" maxlength="100" id="fecha_inicia" name="fecha_inicia" class="form-control" placeholder="aaaa-mm-dd" value="<?php echo $params['informacion_curso']['fecha_inicia']; ?>">
          </div>
          <br>

          <label for="duracion">Secuencia</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
            <input type="number" maxlength="5" id="secuencia" name="secuencia" class="form-control" placeholder="0" value="<?php echo $params['informacion_curso']['secuencia']; ?>">
          </div>
          <br>

          <label for="otras_notas">Otras notas</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="otras_notas" name="otras_notas" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion_curso']['otras_notas']; ?></textarea>
          </div>

          <br>
          <label for="status">Estatus</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <select id="status" name="status" class="form-control">
              <?php if($_SESSION['tipo_usuario'] == 1): ?>
                <option value="1">Activo</option>
              <?php endif;?>
              <option value="0">Inactivo</option>
            </select>
          </div>

          <br>
          <label for="es_online">¿Es online?</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
            <select id="es_online" name="es_online" class="form-control">
                <option value="1">Sí</option>
              <option value="0">No</option>
            </select>
          </div>

          <br>

          <label for="otras_notas">URL vídeos online</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="url_video" name="url_video" class="form-control" placeholder="Ingrese las URL de los vídeos separados por coma(,)."><?php echo $params['informacion_curso']['url_video']; ?></textarea>
          </div>


        </div>
        <div class="box-footer clearfix">
          <button type="submit" value="1" name="guardar" id="guardar" class="btn btn-danger btn-block">Guardar</button>
        </div>
      </div>
    </div>
  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>