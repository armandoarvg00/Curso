<?php ob_start() ?>
<div class="login-box">
  <div class="login-logo">
    <a href="../index.php"><b>Sesión </b>finalizada</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <?php 
      if(isset($_SESSION) && count($_SESSION) > 0 ):
        session_destroy(); ?>
    <p>Tu sesión ha finalizado correctamente a las <h3 align="center"><b><?php echo date('Y-m-d H:i:s');?></b></h3> </p>
    <a href="index.php?seccion=login">Iniciar sesión</a><br>
    <?php else: ?>
      <a href="index.php?seccion=login"><h2 align="center">Iniciar sesión</h2></a><br>
    <?php endif;?>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->


<?php $contenido = ob_get_clean() ?>
<?php include 'layoutLogin.php' ?>