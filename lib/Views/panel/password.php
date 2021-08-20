<?php ob_start() ?>
<div class="login-box">
  <div class="login-logo">
    <a href="index.php?seccion=password"><b>Recuperar </b>contraseña</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
  	<?php if(isset($params['return'])  && $params['return'] < 0):?>
    	<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
    		<?php echo $params['mensaje'];?>
    	</div>
	<?php endif;?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Correo electrónico" name="mail"  id="mail" value="<?php echo $_POST['mail'];?>" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
          <a href="index.php?seccion=login">Iniciar sesión</a>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-recuperar" id="btn-recuperar" value="1">Recuperar</button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutLogin.php' ?>