<?php ob_start() ?>
<div class="login-box">
  <div class="login-logo">
    <a href="../index.php"><b>Iniciar </b>sesión</a>
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
        <input type="text" class="form-control" placeholder="Usuario" name="usuario"  id="usuario" value="<?php echo $_POST['usuario'];?>" autocomplete="off" autofo>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="********" name="password"  id="password" value="<?php echo $_POST['password'];?>" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-login" id="btn-login" value="1">Entrar</button>
        </div><!-- /.col -->
      </div>
    </form>

    <a href="index.php?seccion=password">Perdí mi contraseña</a><br>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutLogin.php' ?>