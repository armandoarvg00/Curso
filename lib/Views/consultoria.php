<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1>Servicios de consultoría</h1>
      </div>
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

<section class="envor-section" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">

      <div class="envor-relative">
        <?php if(count($params['servicios']) > 0): ?>
          <?php foreach($params['servicios'] as $certificacion): ?>
            <article class="envor-property-1 envor-padding-left-30 col-md-4 envor-margin-bottom-10">
              <div class="envor-property-1-inner">
                <?php if($certificacion['path_portada'] == ''):?>
                  <figure>
                        <a href="">
                            <img src="img/sin_portada.jpg" alt="Property">
                        </a>
                    <figcaption>
                        <a href="img/sin_portada.jpg" class="colorbox"><i class="fa fa-plus" style="margin-left: -70px;"></i></a>
                        <a href="index.php?seccion=consultoria&id_servicio=<?php echo $certificacion['id_servicio']?>"><i class="fa fa-eye" style="margin-left: 30px;"></i></a>
                    </figcaption>
                  </figure>
                <?php else: ?>
                  <figure>
                        <a href="">
                            <img src="<?php echo $certificacion['path_portada'];?>" alt="Property">
                        </a>
                    <figcaption>
                        <a href="<?php echo $certificacion['path_portada'];?>" class="colorbox"><i class="fa fa-plus" style="margin-left: -70px;"></i></a>
                        <a href="index.php?seccion=consultoria&id_servicio=<?php echo $certificacion['id_servicio']?>"><i class="fa fa-eye" style="margin-left: 30px;"></i></a>
                    </figcaption>
                  </figure>
                <?php endif;?>
                <P class="title"><a href="index.php?seccion=consultoria&id_servicio=<?php echo $certificacion['id_servicio']?>"><?php echo $certificacion['titulo']?></a></P>
              </div>
            </article>
          <?php endforeach;?>
        <?php else: ?>
          <div class="alert alert-danger">No se han agregado servicios de consultoría al sistema</div>
        <?php endif; ?>

        <!--Featured Houses Controls//-->
        <div class="envor-controls rivaslider-controls"></div>
      </div>

    </div>
  </div>
</section>

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>