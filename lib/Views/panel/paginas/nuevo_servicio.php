<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nuevo servicio</li>
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
          <h3 class="box-title"><i class="fa fa-star"></i> Servicio</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <?php if(isset($params['informacion_servicio']['id_servicio']) && strlen($params['informacion_servicio']['id_servicio']) > 0): ?>
            <input type="hidden" name="id_servicio" value="<?php echo $params['informacion_servicio']['id_servicio']; ?>">
          <?php endif;?>
          <label for="titulo">Título</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="titulo" name="titulo" class="form-control" placeholder="Escriba un titulo" required value="<?php echo $params['informacion_servicio']['titulo']; ?>">
          </div>

          <br>
          <label for="introduccion">Introducción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="introduccion" name="introduccion" class="form-control" placeholder="Redacte la información" required><?php echo $params['informacion_servicio']['introduccion']; ?></textarea>
          </div>

          <br>
          <label for="descripcion">Redactar servicio</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="descripcion" name="descripcion" class="form-control" placeholder="Redacte la información" required><?php echo $params['informacion_servicio']['descripcion']; ?></textarea>
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

          <label for="titulo">Portada (Recomendada: 550px x 385px)</label>
          <div class="input-group">
            <label for="photo">
              <div class="photo-preview" align="center" data-page="<?php echo $_GET['seccion'];?>">
                  <?php if(isset($params['informacion_servicio']['path_portada']) && $params['informacion_servicio']['path_portada'] <> ''): ?>
                    <img src="<?php echo $params['informacion_servicio']['path_portada']; ?>" class="img-responsive" id="img-preview">
                  <?php else: ?>
                    <img src="../img/upload_portada.jpg" class="img-responsive" id="img-preview">
                  <?php endif; ?>
              </div>
              <input type="file" accept="image/*;capture=camera" id="photo" name="photo" style="display: none;" id="img-preview">
            </label>
            <input type="hidden" name="path_portada" id="path_portada" value="<?php echo $params['informacion_servicio']['path_portada']; ?>">
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