<?php ob_start() ?>

<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1><?php echo $params['titulo'];?></h1>
      </div>
      <!--<div class="col-lg-3 col-md-3 col-sm-3">
        <form class="search">
          <input type="text" placeholder="type to search...">
        </form>
      </div>-->
    </div>
  </div>
</section>

<!--Calendario-->
<?php include('componentes/calendario.php');?>
<?php if(isset($params['mensaje_error'])):?>
  <div class="alert alert-danger">
    <?php echo $params['mensaje_error'];?>  
  </div>
<?php endif;?>

<section class="envor-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <?php if(isset($params['portada_nosotros']) && strlen($params['portada_nosotros']) > 0): ?>
          <figure class="single rotate-portada"><img src="<?php echo $params['portada_nosotros'];?>" alt=""></figure>
        <?php endif;?>
      </div>
      <div class="col-lg-6 col-md-6 rotate-paragraph">
        <h2><?php echo $params['subtitulo'];?></h2>
        <br>
          <?php echo $params['informacion'];?>
      </div>
    </div>
  </div>
</section>

<section class="envor-section envor-section-align-center envor-section-st1">
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-bottom: 30px;">
        <h2><?php echo $params['titulo_especialidades'];?></h2>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <article class="envor-feature-3">
          <span><i class="fa <?php echo $params['icono_especialidad_uno'];?>"></i></span>
          <h3><?php echo $params['titulo_especialidad_uno'];?></h3>
          <p><?php echo $params['desc_especialidad_uno'];?></p>
        </article>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <article class="envor-feature-3">
          <span><i class="fa <?php echo $params['icono_especialidad_dos'];?>"></i></span>
          <h3><?php echo $params['titulo_especialidad_dos'];?></h3>
          <p><?php echo $params['desc_especialidad_dos'];?></p>
        </article>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <article class="envor-feature-3">
          <span><i class="fa <?php echo $params['icono_especialidad_tres'];?>"></i></span>
          <h3><?php echo $params['titulo_especialidad_tres'];?></h3>
          <p><?php echo $params['desc_especialidad_tres'];?></p>
        </article>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <article class="envor-feature-3">
          <span><i class="fa <?php echo $params['icono_especialidad_cuatro'];?>"></i></span>
          <h3><?php echo $params['titulo_especialidad_cuatro'];?></h3>
          <p><?php echo $params['desc_especialidad_cuatro'];?></p>
        </article>
      </div>
    </div>
  </div>
</section>

<section class="envor-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2>¿Por qué <strong>nosotros</strong>?</h2>
        <br>
        <?php echo $params['porque_nosotros'];?>
      </div>
    </div>
  </div>
</section>

<!--Misión-->
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <h1><?php echo $params['mision']['titulo'];?></h1>
        </div>
      </div>
    </div>
</section>

<section class="envor-section envor-section-align-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2><?php echo $params['mision']['subtitulo'];?></h2>
      </div>
      <div class="col-lg-6 col-md-6">
        <?php if(isset($params['mision']['path_portada']) && strlen($params['mision']['path_portada']) > 0):?>
          <figure class="rotate-portada"><img src="<?php echo $params['mision']['path_portada'];?>" alt=""></figure>
        <?php endif;?>
      </div>
      <div class="col-lg-6 col-md-6 envor-section-align-left">
        <?php echo $params['mision']['informacion'];?>
      </div>
    </div>
  </div>
</section>


<!--Visión-->
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1><?php echo $params['vision']['titulo'];?></h1>
      </div>
    </div>
  </div>
</section>

<section class="envor-section envor-section-align-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2><?php echo $params['vision']['subtitulo'];?></h2>
      </div>
      <div class="col-lg-6 col-md-6">
        <?php if(isset($params['vision']['path_portada']) && strlen($params['vision']['path_portada']) > 0):?>
          <figure class="rotate-portada"><img src="<?php echo $params['vision']['path_portada'];?>" alt=""></figure>
        <?php endif;?>
      </div>
      <div class="col-lg-6 col-md-6 envor-section-align-left">
        <?php echo $params['vision']['informacion'];?>
      </div>
    </div>
  </div>
</section>

<!--Valores-->
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1><?php echo $params['valores']['titulo'];?></h1>
      </div>
    </div>
  </div>
</section>

<section class="envor-section envor-section-align-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2><?php echo $params['valores']['subtitulo'];?></h2>
      </div>
      <div class="col-lg-6 col-md-6">
        <?php if(isset($params['valores']['path_portada']) && strlen($params['valores']['path_portada']) > 0):?>
          <figure class="rotate-portada"><img src="<?php echo $params['valores']['path_portada'];?>" alt=""></figure>
        <?php endif;?>
      </div>
      <div class="col-lg-6 col-md-6 envor-section-align-left">
        <?php echo $params['valores']['informacion'];?>
      </div>
    </div>
  </div>
</section>


<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>