<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nueva categoría</li>
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
          <h3 class="box-title"><i class="fa fa-object-group"></i> Categoría</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <?php if(isset($params['informacion_categoria']['id_categoria']) && strlen($params['informacion_categoria']['id_categoria']) > 0): ?>
            <input type="hidden" name="id_categoria" value="<?php echo $params['informacion_categoria']['id_categoria']; ?>">
          <?php endif;?>
          <label for="categoria">Título</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="categoria" name="categoria" class="form-control" placeholder="Escriba un nombre" required value="<?php echo $params['informacion_categoria']['categoria']; ?>">
          </div>
          <br>

          <label for="descripcion">Breve descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" maxlength="150" id="descripcion" name="descripcion" class="form-control" placeholder="Describa brevemente la categoría" required><?php echo $params['informacion_categoria']['descripcion']; ?></textarea>
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

          <label for="tipo">Tipo de categoría</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <select id="tipo" name="tipo" class="form-control" required>
              <option value=''>Seleccione uno</option>
              <option value="certificaciones">Certificaciones</option>
              <option value="cursos">Cursos</option>
              <option value="blog">Blog</option>
              <option value="servicios">Servicios</option>
              <option value="webinars">Webinars</option>
            </select>
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