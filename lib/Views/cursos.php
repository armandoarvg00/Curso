<?php ob_start() ?>
<?php if(count($params['sliders']['sliders']) > 0):?>
<section class="envor-section envor-home-slider">
  <div id="layerslider" class="envor-layerslider" style="height: 500px;">
    <pre>
    <?php for($li_index = 0; $li_index < count($params['sliders']['sliders']); $li_index++ ): ?>
      <div class="ls-layer" style="transition3d: 1,4,5,11; transition2d: 2,8,30;">
        <img class="ls-bg" src="<?php echo $params['sliders']['sliders'][$li_index]['path_portada'];?>">
        <p class="envor-store-ls1 ls-s1" style="top: 40px; left: 15px; delayin: 200;"><?php echo $params['sliders']['sliders'][$li_index]['titulo'];?></p>
        <p class="envor-store-ls2 ls-s2" style="top: 110px; left: 15px; slidedirection : fade; scalein: -2;  delayin: 600;"><?php echo $params['sliders']['sliders'][$li_index]['texto'];?></p>
      </div>
    <?php endfor;?>
  </div>
</section>
<?php endif;?>

<!--Calendario-->
<?php include('componentes/calendario.php');?>

      <!--Property Search Form start//-->
      <section class="envor-section envor-section-st2 envor-estate envor-section-color envor-section-bg4">
        <div class="container">
          <div class="row">
          <form class="envor-estate-form" name="frm_buscar" id="frm_buscar" method="get" action="">
            <input type="hidden" name="seccion" id="seccion" value="<?php echo $_GET['seccion'];?>">
            <div class="col-md-8" aling="left">
                <div class="form-group">
                    <p class="elabel">Criterios de búsqueda</p>
                    <input type="text" onkeypress="return soloLetras(event)" class="form-control" id="criterio" name="criterio" placeholder="Buscar..." value="<?php if(isset($_GET['criterio'])){echo $_GET['criterio']; } ?>">
                </div>
            </div>
            <div class="col-md-3" aling="left">
                <div class="form-group">
                    <p class="elabel">Seleccione una categoría</p>
                    <select class="form-control" name="id_categoria" id="id_categoria">
                      <option value="">Todas</option>
                      <?php if(count($params['categorias']) > 0): ?>
                        <?php foreach($params['categorias'] as $categoria): ?>
                          <option value="<?php echo $categoria['id_categoria']?>"><?php echo $categoria['categoria']?></option>
                        <?php endforeach;?>
                      <?php else: ?>
                        <option value="">No se encontraron categorias</option>
                      <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
              <p class="elabel">&nbsp;</p>
              <input type="submit" value="Buscar" class="envor-btn envor-btn-secondary envor-btn-normal">
            </div>
          </form>
          </div>
        </div>
      <!--Property Search Form end//-->
      </section>

      <!--Featured Houses start//-->
      <section class="envor-section envor-section-align-center envor-section-st1">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2>Cursos <strong>destacables</strong></h2>
              <div class="envor-relative">
                <?php if(count($params['cursos']) > 0): ?>
                  <?php foreach($params['cursos'] as $certificacion): ?>
                    <article class="envor-property-1 envor-padding-left-30 col-md-4 envor-margin-bottom-10">
                      <div class="envor-property-1-inner">
                        <?php if($certificacion['path_portada'] == ''):?>
                          <figure>
                                <a href="">
                                    <img src="img/sin_portada.jpg" alt="Property">
                                </a>
                            <figcaption>
                                <a href="img/sin_portada.jpg" class="colorbox"><i class="fa fa-plus" style="margin-left: -70px;"></i></a>
                                <a href="index.php?seccion=cursos&id_curso=<?php echo $certificacion['id_curso']?>"><i class="fa fa-eye" style="margin-left: 30px;"></i></a>
                            </figcaption>
                          </figure>
                        <?php else: ?>
                          <figure>
                                <a href="">
                                    <img src="<?php echo $certificacion['path_portada'];?>" alt="Property">
                                </a>
                            <figcaption>
                                <a href="<?php echo $certificacion['path_portada'];?>" class="colorbox"><i class="fa fa-plus" style="margin-left: -70px;"></i></a>
                                <a href="index.php?seccion=cursos&id_curso=<?php echo $certificacion['id_curso']?>"><i class="fa fa-eye" style="margin-left: 30px;"></i></a>
                            </figcaption>
                          </figure>
                        <?php endif;?>
                        <p class="title"><a href="index.php?seccion=cursos&id_curso=<?php echo $certificacion['id_curso']?>"><?php echo $certificacion['titulo']?></a></p>
                        <?php if(strlen($certificacion['dia_fecha']) > 0):?>
                        <p class="begin-course-icon"><b><i class="fa fa-calendar"></i> Inicia:</b> <?php echo $params['semana'][$certificacion['dia']];?>, <?php echo $certificacion['dia_fecha']?> de <?php echo $params['meses'][$certificacion['mes']];?></p>
							

						<?php endif;?>
                      </div>
                    </article>
                  <?php endforeach;?>
                <?php else: ?>
                  <div class="alert alert-danger">No se han agregado certificaciones al sistema</div>
                <?php endif; ?>

                <!--Featured Houses Controls//-->
                <div class="envor-controls rivaslider-controls"></div>
              </div>
            </div>
          </div>
        </div>
      <!--Featured Houses start//-->
      </section>

      <section class="envor-section envor-section-st2 envor-section-cta2">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <p><span>¡Conozca todas nuestras <strong>certificaciones</strong>!</span> <a href="index.php?seccion=certificaciones" class="envor-btn envor-btn-normal envor-btn-border-white"><i class="glyphicon glyphicon-download"></i> sabes más</a></p>
              </div>
            </div>
          </div>
        <!--Call To Action #2 end//-->
      </section>

<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>