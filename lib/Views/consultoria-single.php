<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1><?php echo $params['servicio']['titulo'];?></h1>
      </div>
    </div>
  </div>
</section>

<!--Calendario-->
<?php include('componentes/calendario.php');?>

<section class="envor-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <article class="envor-post">
          <?php if(strlen($params['servicio']['path_portada']) > 0): ?>
              <a href="<?php echo $params['servicio']['path_portada'];?>" class="colorbox"><img src="<?php echo $params['servicio']['path_portada'];?>" alt=""></a>
          <?php endif;?>
        </article>



        <article class="envor-post">

          <header>
            <h3><i class="fa fa-hand-o-right"></i> <span><?php echo $params['servicio']['titulo'];?></span></h3>        
          </header>
          <p><?php echo $params['servicio']['introduccion'];?></p>
          <p><?php echo $params['servicio']['descripcion'];?></p>
        </article>
      
      </div>
    </div>
  </div>
<!--

Main Content start

//-->
</section>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>