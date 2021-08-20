<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h1>Sucesos e información destacable</h1>
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
        <?php if(count($params['entradas']) > 0): ?>
          <?php foreach($params['entradas'] as $entrada): ?>
            <article class="envor-post">
              <figure>
                <?php if($entrada['path_portada'] <> ''): ?>
                  <a href="<?php echo $entrada['path_portada'];?>" class="colorbox"><img src="<?php echo $entrada['path_portada'];?>" alt=""></a>
                  <figcaption><a href="<?php echo $entrada['path_portada'];?>" title="<?php echo $entrada['titulo'];?>" class="colorbox"><i class="fa fa-plus"></i></a></figcaption>
                <?php endif;?>
              </figure>
              <header>
                <h3><i class="fa fa-pencil"></i> <a href="index.php?seccion=blog&id_curso=<?php echo $entrada['id_curso'];?>"><?php echo $entrada['titulo'];?></a></h3>
                <p>Publicado en <a href="index.php?seccion=blog&id_categoria=<?php echo $entrada['id_categoria'];?>"><?php echo $entrada['categoria'];?></a> por <a href="javascript:void(0)"><?php echo $entrada['nombre_usuario'];?></a></p>
              </header>
              <p><?php echo $entrada['introduccion'];?></p>
              <p><a href="index.php?seccion=blog&id_curso=<?php echo $entrada['id_curso'];?>" class="envor-btn envor-btn-small envor-btn-secondary-border">Leer más <i class="fa fa-arrow-circle-right"></i></a></p>
              <div class="date">
                <span class="day"><?php echo $entrada['dia_fecha'];?></span>
                <span class="month"><?php echo $params['meses'][$entrada['mes']];?>, <?php echo $entrada['anio_fecha'];?></span>
              </div>
            </article>
          <?php endforeach;?>
        <?php else: ?>
          <div class="alert alert-danger">No se han encontrado publicaciones</div>
        <?php endif; ?>
        
        <div class="envor-pagination">
          <?php echo $params['paginacion']; ?>
        </div>
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