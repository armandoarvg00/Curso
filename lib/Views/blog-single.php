<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1><?php echo $params['entrada']['titulo'];?></h1>
      </div>
    </div>
  </div>
</section>

<!--Calendario-->
<?php include('componentes/calendario.php');?>

<section class="envor-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <article class="envor-post">
          <?php if(strlen($params['entrada']['path_portada']) > 0): ?>
              <a href="<?php echo $params['entrada']['path_portada'];?>" class="colorbox"><img src="<?php echo $params['entrada']['path_portada'];?>" alt=""></a>
          <?php endif;?>
          <header>
            <h3><i class="fa fa-paperclip"></i> <span><?php echo $params['entrada']['titulo'];?></span></h3>
            <p>Publicado en <a href="index.php?seccion=blog&id_categoria=<?php echo $params['entrada']['id_categoria'];?>"><?php echo $params['entrada']['categoria'];?></a> por <a href="javascript:void(0)"><?php echo $params['entrada']['nombre_usuario'];?></a></p>
          </header>
          <p><?php echo $params['entrada']['introduccion'];?></p>
          <p><?php echo $params['entrada']['descripcion'];?></p>
          <div class="date">
            <span class="day"><?php echo $params['entrada']['dia_fecha'];?></span>
            <span class="month"><?php echo $params['meses'][$params['entrada']['mes']];?>, <?php echo $params['entrada']['anio_fecha'];?></span>
          </div>
        </article>
      
      </div>
      <div class="col-md-3">
        <aside class="envor-widget envor-search-widget">
          <h3><strong>Listado de </strong> categorías</h3>
          <div class="envor-widget-inner">
            <nav class="envor-side-navi">
                <ul>
                  <?php if(count($params['categorias']) > 0): ?>
                    <?php foreach($params['categorias'] as $categoria):?>
                    <li><i class="glyphicon glyphicon-arrow-right"></i> <a href="index.php?seccion=blog&id_categoria=<?php echo $categoria['id_categoria'];?>"><?php echo $categoria['categoria'];?></a></li>
                    <?php endforeach;?>
                  <?php else: ?>
                    <div class="alert alert-danger">No se encontraron categorìas</div>
                  <?php endif; ?>
                </ul>
              </nav>
          </div>
        </aside>
      </div>
    </div>
  </div>
<!--

Main Content start

//-->
</section>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>