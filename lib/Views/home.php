<?php ob_start() ?>
<section class="envor-section envor-home-slider">
    <div id="layerslider" class="envor-layerslider" style="height: 500px;">
        <!--LayerSlider layer-->

        <?php foreach ($params['sliders'] as $slider): ?>
            <div class="ls-layer" style="transition3d: 1,4,5,11; transition2d: 2,8,30;">
                <!--LayerSlider background-->
                <img class="ls-bg" src="<?php echo $slider['path_portada']; ?>" alt="layer1-background">
                <div class="envor-layerslider-block ls-s1" style="top: 300px; left: 15px; transition2d: all; slidedelay: 6000; durationin: 1000; easingin: easeOutExpo;">
                    <h3><?php echo $slider['titulo']; ?></h3>
                    <!--<h2>calificados</h2>-->
                    <p><?php echo $slider['texto']; ?></p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</section>

<!--Calendario
<?php include('componentes/calendario.php'); ?>

<section class="envor-section envor-section-align-center" style="padding-bottom: 20px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2><?php echo $params['titulo_intro']; ?></h2>
        <p><?php echo $params['intro']; ?></p>
        <p><a href="javascript:void(0)" onclick="f_showCalendar()" class="envor-btn envor-btn-primary-border envor-btn-normal"><i class="fa fa-calendar"></i> Calendario de cursos</a></p>
      </div>
    </div>
  </div>
</section>-->
<div class="container">
    <div class="row">
        <div class="col-lg-12">&nbsp;</div>
    </div>
</div>
<section class="envor-section envor-section-st3" style="padding: 0px !important;">
    <div class="container">
        <div class="row" style="margin-top: 0px;">
            <div class="col-lg-3 col-sm-4 col-md-3">
                <div class="destaca-seccion">
                    <span><i class="fa <?php echo $params['icon_punto_uno']; ?>"></i></span>
                    <p><?php echo $params['descripcion_punto_uno']; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-3">
                <div class="destaca-seccion">
                    <span><i class="fa <?php echo $params['icon_punto_dos']; ?>"></i></span>
                    <p><?php echo $params['descripcion_punto_dos']; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-3">
                <div class="destaca-seccion">
                    <span><i class="fa <?php echo $params['icon_punto_tres']; ?>"></i></span>
                    <p><?php echo $params['descripcion_punto_tres']; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-3">
                <div class="destaca-seccion">
                    <span><i class="fa <?php echo $params['icon_punto_cuatro']; ?>"></i></span>
                    <p><?php echo $params['descripcion_punto_cuatro']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($params['mostrar_webinars'] == 1): ?>
    <!--Intro-->
    <section class="envor-section envor-section-align-center" style="padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Próximos webinars</h2> <br>
                    <table class="table table-striped table-hover" width="100%">
                        <thead clasS="envor-section-st3" style="color: #fFF;">
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Webinar</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Inscripción gratuita</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php if (count($params['webinars']) > 0): ?>
                                <?php $li_index = 1; ?>
                                <?php foreach ($params['webinars'] as $webinar): ?>
                                    <tr>
                                        <td><?php echo $li_index; ?></td>
                                        <td><a href="index.php?seccion=webinars&id_curso=<?php echo $webinar['id_curso'] ?>"><?php echo $webinar['titulo']; ?></a></td>
                                        <td><?php echo $webinar['fecha_inicia']; ?></td>
                                        <td><a href="index.php?seccion=contacto&id_curso=<?php echo $webinar['id_curso'] ?>&titulo_webinar=<?php echo $webinar['titulo']; ?>">Inscripción gratuita</a></td>
                                    </tr>
                                    <?php $li_index++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No se encontraron webinars</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>


<?php if ($params['mostrar_instructores'] == 1): ?>
    <!--Instructores-->
    <section class="envor-section envor-section-align-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="align-center"><strong>Nuestros</strong> instructores</h3>
                    <div class="envor-relative" id="our-team">          
                        <?php if (count($params['instructores']) > 0): ?>
                            <?php foreach ($params['instructores'] as $instructor): ?>
                                <div class="envor-team-1 envor-padding-left-30">
                                    <div class="envor-team-1-inner">
                                        <header>
                                            <?php if ($instructor['path_portada'] == '') : ?>
                                                <figure><img src="img/sin-avatar.png" alt=""></figure>
                                            <?php else: ?>
                                                <figure><img src="<?php echo $instructor['path_portada']; ?>" alt=""></figure>
                                            <?php endif ?>
                                            <div class="name">
                                                <small>¡Hola! Mi nombre es</small>
                                                <p><?php echo $instructor['nombre']; ?></p>
                                            </div>
                                        </header>
                                        <div class="envor-team-1-details">
                                          <!--<p class="role">Puesto</p>-->
                                            <p><?php echo $instructor['informacion']; ?></p>
                                            <!--<p class="links">
                                              <a href=""><i class="fa fa-facebook"></i></a>
                                              <a href=""><i class="fa fa-twitter"></i></a>
                                              <a href=""><i class="fa fa-linkedin"></i></a>
                                              <a href=""><i class="fa fa-envelope"></i></a>
                                            </p>-->
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger">No se han agregado instructores al sistema</div>
                        <?php endif; ?>
                        <div class="envor-navigation rivaslider-navigation">
                            <a href="" class="back"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a href="" class="forward"><i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!--Testimonios-->
<section class="envor-section envor-section-align-center envor-section-st1" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Testimonios de <strong>nuestros clientes</strong></h2>
                <div class="envor-wrapper" id="clients-testimonials">
                    <?php if (count($params['testimonios']) > 0): ?>
                        <?php foreach ($params['testimonios'] as $testimonio): ?>
                            <article class="envor-testimonials-1">
                                <div class="envor-testimonials-inner">
                                    <p><em><?php echo $testimonio['testimonio']; ?></em></p>
                                    <p class="author">- <?php echo $testimonio['nombre']; ?>, <span><?php echo $testimonio['puesto']; ?></span></p>
                                    <i class="fa fa-quote-left"></i>
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger">No se encontraron testimonios de clientes</div>
                    <?php endif; ?>
                    <div class="envor-controls rivaslider-controls"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($params['mostrar_partners'] == 1): ?>
    <section class="envor-section envor-section-align-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="align-center">Partners</h3>
                    <div class="envor-relative" id="our-partners">
                        <?php if (isset($params['partners']) && count($params['partners']) > 0): ?>
                            <?php foreach ($params['partners'] as $partner): ?>
                                <div class="envor-partner-logo">
                                    <div class="inner">
                                        <img src="<?php echo $partner['path_portada']; ?>" alt="<?php echo $partner['nombre']; ?>"><span class="helper"></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger">No se encontraron partners</div>
                        <?php endif; ?>
                        <div class="envor-controls rivaslider-controls"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>