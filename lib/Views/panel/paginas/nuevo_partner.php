<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nuevo partner</li>
  </ol>
</section>
<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($params['mensaje'])):?>
      <div class="alert alert-danger"><?php echo $params['mensaje'];?></div>
    <?php endif; ?>
    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-secret"></i> Partner</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <?php if(isset($params['informacion_partner']['id_partner']) && strlen($params['informacion_partner']['id_partner']) > 0): ?>
            <input type="hidden" name="id_partner" value="<?php echo $params['informacion_partner']['id_partner']; ?>">
          <?php endif;?>
          <label for="nombre">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="nombre" name="nombre" class="form-control" placeholder="Escriba un nombre" required value="<?php echo $params['informacion_partner']['nombre']; ?>">
          </div>
          <br>
          <label for="titulo">Imagen (Recomendada: 250px x 117px)</label>
          <div class="input-group">
            <label for="photo">
              <div class="photo-preview" align="center" data-page="<?php echo $_GET['seccion'];?>">
                  <?php if(isset($params['informacion_partner']['path_portada']) && $params['informacion_partner']['path_portada'] <> ''): ?>
                    <img src="<?php echo $params['informacion_partner']['path_portada']; ?>" class="img-responsive" id="img-preview">
                  <?php else: ?>
                    <img src="../img/sin_imagen_partner.jpg" class="img-responsive" data-tipo-imagen="partner" id="img-preview">
                  <?php endif; ?>
              </div>
              <input type="file" accept="image/*;capture=camera" id="photo" name="photo" style="display: none;">
            </label>
            <input type="hidden" name="path_portada" id="path_portada" data-distinguir="SI" value="<?php echo $params['informacion_instructor']['path_portada']; ?>">
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
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" value="1" name="guardar" id="guardar" class="btn btn-danger btn-block">Guardar</button>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>