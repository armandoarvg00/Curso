<?php ob_start() ?>
  
  <section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <h1><?php echo $params['titulo'];?></h1>
        </div>
      </div>
    </div>
  <!--

  Page Title end

  //-->
  </section>


<!--Calendario-->
<?php include('componentes/calendario.php');?>

  <!--

      Main Content start

      //-->
      <section class="envor-section envor-section-align-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2><?php echo $params['subtitulo'];?></h2>
            </div>
            <div class="col-lg-6 col-md-6">
              <figure><img src="img/valores.png" alt=""></figure>
            </div>
            <div class="col-lg-6 col-md-6 envor-section-align-left">
              <?php echo $params['informacion'];?>
              
            </div>
          </div>
        </div>
      <!--

      Main Content start

      //-->
      </section>

  <?php include('componentes/certificaciones-slider.php');?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>