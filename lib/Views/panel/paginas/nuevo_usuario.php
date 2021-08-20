<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Agregar nuevo usuario</li>
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
          <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(isset($_GET['action'])): ?>
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
          <?php else: ?>
            <input type="hidden" name="action" value="add">
          <?php endif;?>

          <label for="id_usuario">Ingrese un usuario</label>
          <div class="input-group">
            <?php if(isset($params['informacion_usuario']['id_usuario']) && strlen($params['informacion_usuario']['id_usuario']) > 0): ?>
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" id="id_usuario"  name="id_usuario" class="form-control" readonly  value="<?php echo $params['informacion_usuario']['id_usuario']; ?>">
            <?php else: ;?>
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" maxlength="100" id="id_usuario" name="id_usuario" class="form-control" placeholder="Escriba un usuario" required>
            <?php endif;?>
          </div>
          <br>

          <label for="nombre">Nombre</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" maxlength="100" id="nombre" name="nombre" class="form-control" placeholder="Escriba su nombre" required value="<?php echo $params['informacion_usuario']['nombre']; ?>">
          </div>
          <br>


          <label for="apellido_paterno">Apellido paterno</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" maxlength="100" id="apellido_paterno" name="apellido_paterno" class="form-control" placeholder="Escriba su apellido paterno" required value="<?php echo $params['informacion_usuario']['apellido_paterno']; ?>">
          </div>
          <br>


          <label for="apellido_materno">Apellido materno</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" maxlength="100" id="apellido_materno" name="apellido_materno" class="form-control" placeholder="Escriba su apellido materno" value="<?php echo $params['informacion_usuario']['apellido_materno']; ?>">
          </div>
          <br>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cog"></i> Opciones</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

          <label for="mail">Correo electrónico</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="text" maxlength="150" id="mail" name="mail" class="form-control" placeholder="Escriba su correo electrónico" value="<?php echo $params['informacion_usuario']['mail']; ?>">
          </div>
          <br>


          <label for="password">Nueva contraseña</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <input type="password" id="password" name="password" class="form-control" placeholder="************">
          </div>
          <br>


          <label for="tipo_usuario">Tipo de usuario</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
              
              <?php if($_SESSION['tipo_usuario'] == 1): ?>
                <option value=''>Seleccione uno</option>
                <option value="1">Administrador</option>
              <?php endif;?>
              <option value="0">Autor</option>
            </select>
          </div>

          <br>
          <label for="status">Estatus</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <select id="status" name="status" class="form-control">
              <option value="1">Activo</option>
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