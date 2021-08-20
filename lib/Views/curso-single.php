<?php ob_start() ?>
<section class="envor-page-title-1" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <h1><?php echo $params['certificacion']['titulo'];?></h1>
      </div>
      
    </div>
  </div>
</section>

<!--Calendario-->
<?php include('componentes/calendario.php');?>

<section class="envor-desktop-breadscrubs">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="envor-desktop-breadscrubs-inner">
          <a href="index.php?seccion=certificaciones">Cursos</a><i class="fa fa-angle-double-right"></i><?php echo $params['certificacion']['titulo'];?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="envor-mobile-breadscrubs">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <a href="index.php?seccion=certificaciones">Cursos</a><i class="fa fa-angle-double-right"></i><?php echo $params['certificacion']['titulo'];?>
      </div>
    </div>
  </div>
</section>


<section class="envor-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9">

        <article class="envor-post">
          <?php if(strlen($params['certificacion']['path_portada']) > 0): ?>
            <a href="<?php echo $params['certificacion']['path_portada'];?>" class="colorbox img"><img src="<?php echo $params['certificacion']['path_portada'];?>" alt=""></a>
          <?php else: ?>
            <a href="img/sin_portada.png" class="colorbox img"><img src="img/sin_portada.jpg" alt=""></a>
          <?php endif;?>
          <p><h3><?php echo $params['certificacion']['titulo'];?></h3></p>
          <p><?php echo $params['certificacion']['introduccion'];?></p>
          <p>&nbsp;</p>

          <?php if(strlen($params['certificacion']['dia_fecha']) > 0):?>
          <div class="date">
            <span class="day"><?php echo $params['certificacion']['dia_fecha'];?></span>
            <span class="month"><?php echo $params['meses'][$params['certificacion']['mes']];?>, <?php echo $params['certificacion']['anio_fecha'];?></span>
          </div>
          <?php endif;?>
        </article>

        <?php if(strlen($params['certificacion']['descripcion']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['descripcion'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['descripcion'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>

        <?php if(strlen($params['subtitulos']['objetivos']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['objetivos'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['objetivos'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>


        <?php if(strlen($params['certificacion']['caracteristicas']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['caracteristicas'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['caracteristicas'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>

        <?php if(strlen($params['certificacion']['dirigido']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['dirigido'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['dirigido'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>


        <?php if(strlen($params['certificacion']['pre_requisitos']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['prerequisitos'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['pre_requisitos'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>


        <?php if(strlen($params['certificacion']['porque_tomarlo']) > 0): ?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['tomarlo_nosotros'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['porque_tomarlo'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>


        <?php if(strlen($params['certificacion']['material']) > 0):?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['material_estudio'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['material'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif; ?>

        <?php if(strlen($params['certificacion']['temario']) > 0): ?>
          <article class="envor-post">
            <header>
              <h3><i class="fa fa-list-alt"></i> <span><?php echo $params['subtitulos']['temario'];?></span></h3>
            </header>
            <p><?php echo $params['certificacion']['temario'];?></p>
            <p>&nbsp;</p>
          </article>
        <?php endif;?>

        <?php if (strlen($params['certificacion']['id_instructor']) > 0):?>
        <h3>Acerca de <strong>instructor</strong></h3>
        <div class="envor-post-author">
          <figure>
              <?php if(strlen($params['certificacion']['foto_instructor']) > 0):?>
                <img src="<?php echo $params['certificacion']['foto_instructor'];?>">
              <?php else: ?>
                <img src="img/sin_foto.jpg">
              <?php endif; ?>
          </figure>
          <p class="name"><?php echo $params['certificacion']['nombre'];?></p>
          <!--<p class="role">developer</p>-->
          <p><?php echo $params['certificacion']['informacion'];?></p>
        </div>
        <?php endif;?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <!--<h3><strong>Últimos </strong> cursos</h3>
        <div class="envor-relative" id="related-posts">
          <?php if(count($params['cursos']) > 0): ?>
            <?php foreach($params['cursos'] as $curso): ?>
              <article class="envor-post-preview envor-padding-left-30">
                <div class="envor-post-preview-inner">
                  <header>
                    <?php if(strlen($curso['dia_fecha']) > 0): ?>
                      <div class="date">
                        <span class="day"><?php echo $curso['dia_fecha'];?></span> <span class="month"><?php echo $params['meses'][$curso['mes']];?>, <?php echo $curso['anio_fecha'];?></span>
                      </div>
                    <?php endif;?>
                    <a href="index.php?seccion=cursos&id_curso=<?php echo $curso['id_curso'];?>"><?php echo substr($curso['titulo'], 0, 60);?>...</a>
                  </header>
                  <p><?php echo substr($curso['introduccion'], 0, 150);?>[...]</p>
                </div>
              </article>
            <?php endforeach; ?>
          <?php else:?>
            <div class="alert alert-danger">No se encontraron cursos</div>
          <?php endif;?>
          <div class="envor-navigation envor-navigation-left rivaslider-navigation">
            <a href="" class="back"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a href="" class="forward"><i class="glyphicon glyphicon-chevron-right"></i></a>
          </div>
        </div>-->
      </div>

      <div class="col-lg-3 col-md-3">
        <aside class="envor-widget envor-category-widget">
          <h3>Próximos <strong>cursos</strong></h3>
          <div class="envor-widget-inner">
            <div id="calendariocursos"></div>
          </div>

          <div class="clearfix"></div>
          <div class="envor-widget-inner" style="margin-top: 10px;">
            <ul id="lista-cursos-encontrados">
              
            </ul>
          </div>

        </aside>

        <?php if(strlen($params['certificacion']['mes']) > 0): ?>
        <aside class="envor-widget envor-category-widget">
          <h3><strong>Inicia</strong></h3>
          <div class="envor-widget-inner">
            <a href="javascript:void(0)" class="envor-btn envor-btn-primary-border envor-btn-large"><?php echo $params['semana'][$params['certificacion']['dia']];?>, <?php echo $params['certificacion']['dia_fecha'];?> de <?php echo $params['meses'][$params['certificacion']['mes']];?></a>
          </div>
        </aside>
        <?php endif;?>
        
        <?php if(strlen($params['certificacion']['duracion']) > 0): ?>
        <aside class="envor-widget envor-category-widget">
          <h3><strong>Duración</strong></h3>
          <div class="envor-widget-inner">
            <a href="javascript:void(0)" class="envor-btn envor-btn-primary-border envor-btn-large"><?php echo $params['certificacion']['duracion'];?></a>
          </div>
        </aside>
        <?php endif;?>

        <?php if(strlen($params['certificacion']['precio']) > 0 && $params['certificacion']['precio'] > 0):?>
        <aside class="envor-widget envor-category-widget">
          
          <h3><strong>Precio</strong></h3>
          <div class="envor-widget-inner">
            <a href="javascript:void(0)" class="envor-btn envor-btn-secondary envor-btn-large">$<?php echo number_format($params['certificacion']['precio'], 2);?></a><font style="margin-left: 10px;" size="2pt" color="#000">IVA incluido.</font>
          </div>
          <?php if ($params['certificacion']['mes0']>0 || $params['certificacion']['mes3']>0 || $params['certificacion']['mes6']>0 || $params['certificacion']['mes9']>0 || $params['certificacion']['mes12']>0){ ?>
          <div class="col-md-12 col-lg-12" style="height: 15px;"></div>          
          <!-- <font size="1.9pt"> -->
          <div>
            <strong style="color: red;">Cómodas mensualidades <br>Meses Sin Intereses (MSI).</strong>  
          </div>
          <div style="margin: 5px 0px 5px 0px;">
            Único pago. Descuento del <?php echo number_format($params['certificacion']['desc__'], 0);?>% <br>Usted Paga --> $<?php echo number_format($params['certificacion']['mes0'], 2);?>
          </div>

          <div>
            3 Mensualidades de --> $<?php echo number_format($params['certificacion']['mes3'], 2);?>
          </div>

          <div>
            6 Mensualidades de --> $<?php echo number_format($params['certificacion']['mes6'], 2);?>
          </div>

          <div>
            9 Mensualidades de --> $<?php echo number_format($params['certificacion']['mes9'], 2);?>
          </div>

          <div>
            12 Mensualidades de --> $<?php echo number_format($params['certificacion']['mes12'], 2);?>
          </div>
          
          <div style="height: 15px;"></div>

          <div>
            <em>** Usted elige la mensualidad al momento de realizar su pago.</em>
          </div>

          <!-- </font> -->
        <?php } ?>

          <div class="col-md-12 col-lg-12" style="height: 20px;"></div>

          <?php if(strlen($params['certificacion']['paypal']) > 0 && $params['certificacion']['precio'] > 0):?>  
            <div class="col-md-12 col-lg-12">          
              <?php echo $params['certificacion']['paypal'];?></a>
            </div>
          <?php endif; ?>          
        </aside>
        <?php endif;?>

        <?php if(strlen($params['certificacion']['otras_notas']) > 0):?>
        <aside class="envor-widget envor-category-widget">
          <div class="envor-widget-inner">
              <h3><strong><?php echo $params['subtitulos']['otrasnotas'];?></strong></h3>
              <p><?php echo $params['certificacion']['otras_notas'];?></p>
          </div>
        </aside>
        <?php endif;?>
        
        
        <aside class="envor-widget envor-category-widget">
          <h3>Ver por <strong>categorias</strong></h3>
          <div class="envor-widget-inner">
            <ul>
              <?php if(count($params['categorias']) > 0): ?>
                <?php foreach($params['categorias'] as $categoria): ?>
                  <li>
                    <p><a href="index.php?seccion=cursos&id_categoria=<?php echo $categoria['id_categoria'];?>"><i class="glyphicon glyphicon-folder-open"></i> <?php echo $categoria['categoria'];?></a> <a href="index.php?seccion=certificaciones&id_categoria=<?php echo $categoria['id_categoria'];?>"><i class="fa fa-rss"></i></a> <span></span></p>
                    <small><?php echo $categoria['descripcion'];?></small>
                  </li>
                <?php endforeach;?>
              <?php else: ?>
                <div class="alert alert-danger">
                    No se encontraron categorías
                </div>
              <?php endif;?>
            </ul>
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