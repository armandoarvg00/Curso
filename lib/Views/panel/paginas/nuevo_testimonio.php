<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nuevo testimonio</li>
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
          <h3 class="box-title"><i class="fa fa-comments"></i> Testimonio</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <?php if(isset($params['informacion_testimonio']['id_testimonio']) && strlen($params['informacion_testimonio']['id_testimonio']) > 0): ?>
            <input type="hidden" name="id_testimonio" value="<?php echo $params['informacion_testimonio']['id_testimonio']; ?>">
          <?php endif;?>
          <label for="nombre">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="150" id="nombre" name="nombre" class="form-control" placeholder="Escriba un nombre" required value="<?php echo $params['informacion_testimonio']['nombre']; ?>">
          </div>
          <br>
          <label for="puesto">Puesto</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="150" id="puesto" name="puesto" class="form-control" placeholder="Escriba un puesto" required value="<?php echo $params['informacion_testimonio']['puesto']; ?>">
          </div>
          <br>
          <label for="testimonio">Testimonio</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="testimonio" name="testimonio" class="form-control" placeholder="Redacte una testimonio" required><?php echo $params['informacion_testimonio']['testimonio']; ?></textarea>
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