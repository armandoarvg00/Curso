<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1>Calendario</h1>
      </div>
    </div>
  </div>
</section>

<!--Calendario-->
<?php include('componentes/calendario.php');?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>