<?php ob_start() ?>
  <section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <h1>¡Gracias por su Pago!</h1>          
        </div>
      </div>
    </div>
  </section>
<!--Calendario-->
<?php include('componentes/calendario.php');?>


  <section class="envor-section">
    <div class="container">      
      <div class="row">        
        <div class="col-lg-12 col-md-12">
          <h3>Muchas gracias por su compra, conserve su comprobante para futuras aclaraciones.</h3>
        </div>
      </div>
    </div>
  </section>


<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>