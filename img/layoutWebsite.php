<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Impulse ITS">
    <meta name="author" content="Cursos y más">
    <link rel="shortcut icon" href="others/<?php echo Config::$mvc_favicon;?>">

    <title><?php echo $params['title'];?></title>

    <!--
    * Google Fonts
    //-->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <!--<link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/colorbox-skins/4/colorbox.css" type="text/css">
    <link href="css/<?php echo Config::$mvc_vis_css;?>" rel="stylesheet" type="text/css">


    <link href="css/header/h3.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/color1.css" rel="stylesheet" type="text/css" id="envor-site-color">
    <link href="css/rivathemes.css" rel="stylesheet" type="text/css">

    <!-- LayerSlider styles -->
    <link rel="stylesheet" href="css/layerslider/css/layerslider.css" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/vendor/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="js/twitterFetcher_v10_min.js"></script>

    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
    <style>
      th.fc-widget-header{
        color: #FFF !important;
        background: #d34b27 !important;
      }
      td.fc-day-number{
        color: #000000 !important;
        font-weight: bold !important;
      }
    </style>
</head>
<body>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <!--

    Scroll to the top

    //-->
    <div id="to-the-top"><i class="fa fa-chevron-up"></i></div>
    <!--Image Preload//-->
    <div id="envor-preload">
      <span>Por favor espere...</span>
      <i class="fa fa-cog fa-spin"></i>
      <p></p>
    </div>
    <!--Envor mobile menu start//-->
      <?php include('componentes/nav-mobile.php');?>
    <!--Envor mobile menu end//-->
    
    <!--Envor header start//-->
    <header class="envor-header envor-header-3">
      <!--Header Bg start//-->
      <!--<div class="row bg-band-blog">
          <div class="container">
            <div class="col-lg-12">
              <a href="">color negro</a>
            </div>
          </div>
      </div>-->
      <div class="envor-header-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="envor-relative">
                <!--Contact Info start//-->
                <div class="contact-info">
                  <p class="phone"><i class="fa fa-phone"></i> <?php echo $params['telefono'];?></p>
                  <p class="email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $params['mail'];?>"><img src="img/correo_info.jpg"></a></p>
                <!--Contact Info end//-->
                </div>
                <!--Site Logo start//-->
                <a href="index.php?seccion=principal">
                <div class="envor-logo">
                  <img src="img/logo.png" alt="Impulse ITS - Information Technology Solutions">
                  <p class="logo"><img src="img/impulse-text.jpg"></p>
                <!--Site Logo end//-->
                </div>
                </a>
                <!--Social Buttons start//-->
                <div class="social-buttons">
                  <?php if(strlen($params['facebook']) > 0): ?>
                    <a href="<?php echo $params['facebook'];?>"><i class="fa fa-facebook"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['twitter']) > 0): ?>
                    <a href="<?php echo $params['twitter'];?>"><i class="fa fa-twitter"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['linkedin']) > 0): ?>
                    <a href="<?php echo $params['linkedin'];?>"><i class="fa fa-linkedin"></i></a>
                  <?php endif;?>


                  <?php if(strlen($params['google']) > 0): ?>
                    <a href="<?php echo $params['google'];?>"><i class="fa fa-google-plus"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['instagram']) > 0): ?>
                    <a href="<?php echo $params['instagram'];?>"><i class="fa fa-instagram"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['youtube']) > 0): ?>
                    <a href="<?php echo $params['youtube'];?>"><i class="fa fa-youtube"></i></a>
                  <?php endif;?>
                </div>
                <!--Social Buttons end//-->
              </div>
            </div>
          </div>
        </div>
      <!--Header Bg end//-->
      </div>

      <!--Site Menu start/-->
      <div class="envor-desktop-menu-bg" id="envor-header-menu">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
                <?php include('componentes/nav-desktop.php');?>
            </div>
          </div>
        </div>  
      </div>
    <!--Site Menu end//-->
    <!--Envor header end//-->
    </header>



    <!--Envor site content start//-->
    <div class="envor-content">
      <?php echo $contenido;?>
    </div>


    <!--Envor footer start//-->
    <footer class="envor-footer">
      <div class="container">
        <div class="row">
          <!--

          Footer About 2 Widget start

          //-->
          <div class="col-lg-3 col-md-3">
            <div class="envor-widget envor-about-widget">
              <h3>Acerca de nosotros</h3>
              <div class="envor-widget-inner">
                <p><?php echo $params['acerca_de'];?></p>
                <p class="contacts"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $params['mail'];?>"><?php echo $params['mail'];?></a></p>
                <p class="contacts"><i class="fa fa-phone"></i> <?php echo $params['telefono'];?></p>
                <p class="contacts"><i class="fa fa-map-marker"></i> <?php echo $params['domicilio'];?></p>
                <p class="links">
                  <?php if(strlen($params['facebook']) > 0): ?>
                    <a href="<?php echo $params['facebook'];?>"><i class="fa fa-facebook"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['twitter']) > 0): ?>
                    <a href="<?php echo $params['twitter'];?>"><i class="fa fa-twitter"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['linkedin']) > 0): ?>
                    <a href="<?php echo $params['linkedin'];?>"><i class="fa fa-linkedin"></i></a>
                  <?php endif;?>


                  <?php if(strlen($params['google']) > 0): ?>
                    <a href="<?php echo $params['google'];?>"><i class="fa fa-google-plus"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['instagram']) > 0): ?>
                    <a href="<?php echo $params['instagram'];?>"><i class="fa fa-instagram"></i></a>
                  <?php endif;?>

                  <?php if(strlen($params['youtube']) > 0): ?>
                    <a href="<?php echo $params['youtube'];?>"><i class="fa fa-youtube"></i></a>
                  <?php endif;?>
                </p>
              </div>
            </div>
          <!--

          Footer About 2 Widget end

          //-->
          </div>
          <!--

          Footer Newsletters Widget start

          //-->
          <div class="col-lg-3 col-md-3" name="suscripcion">
            <div class="envor-widget envor-about-widget">
              <h3>Suscríbete</h3>
              <div class="envor-widget-inner">
                <p><?php echo $params['mensaje_suscripcion'];?></p>
                <p>&nbsp;</p>
                <div class="quick_newsletter">
                  <?php if($_SERVER['QUERY_STRING'] == ''): ?>
                    <form action="index.php?seccion=principal&suscribe=true" method="POST" id="frm-suscribe">
                  <?php else: ?>
                    <form action="index.php?<?php echo $_SERVER['QUERY_STRING'];?>&suscribe=true" id="frm-suscribe" method="POST">
                  <?php endif; ?>  
                    <input onkeypress="return soloLetras(event)" name="nombre" id="nombre" placeholder="Nombre completo" class="text" type="text" required>
                    <input name="mail" id="mail" placeholder="Correo electrónico" class="text" type="text" required>
                    <input onkeypress="return soloNumeros(event)" name="telefono" maxlength="50" id="telefono" placeholder="Teléfono" class="text" type="text">
                    <input type="hidden" name="hid_action" id="hid_action" value="1">
                    <input name="enviar" value="¡Suscribirme!" onclick="f_valida_suscripcion()" class="envor-btn envor-btn-primary envor-btn-normal" type="button">
                  </form>
                </div>
                <?php if(isset($_GET['status_suscribe']) && $_GET['status_suscribe'] == true): ?>
                  <div class="clearfix"></div>
                  <div class="alert alert-success">¡Gracias por suscribirte! Pronto tendrás las mejores actualizaciones en tu correo electrónico. </div>
                <?php endif; ?>
              </div>
            </div>
          </div>


          <div class="col-lg-3 col-md-3">
            <div class="envor-widget envor-latest-news-2-widget">
              <h3>Próximos <strong>cursos</strong></h3>
              <div class="envor-widget-inner">
                <ul>
                  <?php if(isset($params['ultimos_cursos']) && count($params['ultimos_cursos']) > 0):?>
                    <?php foreach($params['ultimos_cursos'] as $ultimoCurso):?>
                      <?php if($ultimoCurso['tipo_publicacion'] == 0): ?>
                        <li>
                          <p class="title"><a href="index.php?seccion=certificaciones&id_curso=<?php echo $ultimoCurso['id_curso'];?>"><?php echo $ultimoCurso['titulo'];?></a></p>
                          <?php if(isset($ultimoCurso['fecha_inicia']) && strlen($ultimoCurso['fecha_inicia']) > 0):?> <small>Inicia <?php echo $ultimoCurso['fecha_inicia'];?></small><?php endif;?>
                        </li>
                      <?php else: ?>
                        <li>
                          <p class="title"><a href="index.php?seccion=cursos&id_curso=<?php echo $ultimoCurso['id_curso'];?>"><?php echo $ultimoCurso['titulo'];?></a></p>
                          <?php if(isset($ultimoCurso['fecha_inicia']) && strlen($ultimoCurso['fecha_inicia']) > 0):?> <small>Inicia <?php echo $ultimoCurso['fecha_inicia'];?></small><?php endif;?>
                        </li>
                      <?php endif;?>
                    <?php endforeach;?>
                  <?php else:?>
                    <div class="alert alert-danger">No se encontraron próximos cursos</div>
                  <?php endif;?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="envor-widget envor-latest-tweets-widget">
              <h3>Últimos <strong>tweets</strong></h3>
              <?php if($params['id_twitter'] <> ''): ?>
                <script>twitterFetcher.fetch('<?php echo $params['id_twitter'];?>', 'twitter-posts', 5, true, true, false);</script>
                <div class="envor-widget-inner" id="latest-tweets">
                  <div class="envor-latest-tweets" id="twitter-posts"></div>
                  <div class="envor-navigation envor-navigation-left rivaslider-navigation">
                    <a href="" class="back"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a href="" class="forward"><i class="glyphicon glyphicon-chevron-right"></i></a>
                  </div>
                </div>
              <?php else: ?>
                <div class="alert alert-danger">No se ha configurado un Widget de Twitter</div>
              <?php endif;?>
            </div>
          <!--

          Footer Latest Tweets Widget end

          //-->
          </div>
          <!--

          Footer Copyright start

          //-->
          <div class="col-lg-12">
            <div class="envor-widget envor-copyright-widget">
              <div class="envor-widget-inner">
                <p>© Copyright <?php echo date('Y');?> by <a href="#">Impulse ITS</a>. All Rights Reserved. <a href="index.php?seccion=privacidad">Aviso de Privacidad</a> </p>
                <p>Powered by <a href="https://clevercloud.com.mx"><i class="glyphicon glyphicon-cloud"></i> CC</a></p>
              </div>
            </div>
          <!--

          Footer Copyright end

          //-->
          </div>
        </div>
      </div>
    <!--Envor footer end//-->
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
    <script src="plugins/jquery-ui/jquery-ui.js"></script>
    <script src="js/vendor/core-1.0.5.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/jquery.mousewheel.min.js"></script>
    <script src="js/jquery.colorbox-min.js"></script>
    <script src="js/preloadCssImages.jQuery_v5.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <!--* jQuery with jQuery Easing, and jQuery Transit JS//-->
    <script src="js/layerslider/jquery-easing-1.3.js" type="text/javascript"></script>
    <script src="js/layerslider/jquery-transit-modified.js" type="text/javascript"></script>
    <!--* LayerSlider from Kreatura Media with Transitions-->
    <script src="js/layerslider/layerslider.transitions.js" type="text/javascript"></script>
    <script src="js/layerslider/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
    <script src="js/jquery.rivathemes.js"></script>
    <script src="js/funciones.eventos.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="plugins/fullcalendar/fullcalendar.lang.js"></script>
    <script>
      

      function f_valida_suscripcion(){
            ls_nombre = $("#nombre").val();
            ls_mail = $("#mail").val();


            if(ls_nombre == ''){
              alert("Debe ingresar su nombre");
              $("#nombre").focus();
              return;
            }

            if(ls_mail == ''){
              alert("Debe ingresar su correo electrónico");
              $("#mail").focus();
              return;
            }else{
              var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
              if (!regex.test($("#mail").val().trim())) {
                alert('Correo electrónico no válido');
                $("#mail").focus();
                return;
              }           
            }

            $("#frm-suscribe").submit();
          }
          
      function f_showCalendar(){
        $("#show-calendar").toggle('fadein');
        $('#calendar').fullCalendar({
              header: {
                  left: 'prev',
                  center: 'title',
                  right: 'next'
              },
              lang: 'es',
              height: 450,
              <?php if(isset($params['eventos'])){echo $params['eventos']; } ?>
              editable: false
          });
      } 
    </script>
    <?php if(isset($_GET['seccion']) && ($_GET['seccion'] == 'contacto' || $_GET['seccion'] == 'error_404' || $_GET['seccion'] == 'soporte')): ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&key=AIzaSyCsrwU2Ui6kqS3mq-f2gwY61IHWUhk3_2k"></script>
        <script>
          function initialize() {
            // Create an array of styles.
            var styles = [
              {
                stylers: [
                  { hue: "#e14d43" },
                  { saturation: -20 }
                ]
              },{
                featureType: "road",
                elementType: "geometry",
                stylers: [
                  { color: "#ffffff" },
                  { lightness: -20 },
                  { visibility: "simplified" }
                ]
              },{
                featureType: "road",
                elementType: "labels",
                stylers: [
                  { visibility: "on" }
                ]
              }
            ];
            // Create a new StyledMapType object, passing it the array of styles,
            // as well as the name to be displayed on the map type control.
            var styledMap = new google.maps.StyledMapType(styles,
              {name: "Impulse ITS"});
            var myLatlng = new google.maps.LatLng(19.282501,  -99.174821);
            var mapOptions = {
              zoom: 17,
              center: myLatlng,
                mapTypeControlOptions: {
                  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }}
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            // To add the marker to the map, use the 'map' property
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title:"Impulse ITS - Information Technology Solutions"
            });
            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
          }
          google.maps.event.addDomListener(window, 'load', initialize);


          function f_validar_formulario(a){            
            ls_empresa = $("#empresa").val();
            ls_nombre = $("#nombre").val();
            ls_mail = $("#mail").val();
            ls_telefono = $("#telefono").val();
            ls_mensaje = $("#mensaje").val();
            ls_captcha = $("#g-recaptcha-response").val();

            if(ls_nombre == ''){
              alert("Por favor ingrese su nombre");
              $("#nombre").focus();
              return false;
            }
            /*if(ls_asunto == ''){
              alert("Por favor ingrese su nombre");
              $("#asunto").focus();
              return;
            } */
            if(ls_mail == ''){
              alert("Por favor ingrese su correo electrónico");
              $("#mail").focus();
              return false ;
            }else{
              var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
              if (!regex.test($("#mail").val().trim())) {
                alert('Correo electrónico no válido');
                $("#mail").focus();
                return false;
              }           
            }
            if(ls_telefono == ''){
              alert("Por favor ingrese su teléfono");
              $("#telefono").focus();
              return false;
            } 

            /*if(ls_mensaje == ''){
              alert("Por favor ingrese su mensaje");
              $("#mensaje").focus();
              return;
            }    */           
            
            
            var response = grecaptcha.getResponse();

            if(response.length == 0){
                alert("No se ha recibido respuesta de Captcha");
                return false;                
            }


            //$("#frm-contacto").submit();
            return true;
          }
        </script>
    <?php endif;?>
    <script type="text/javascript">
    <?php if(isset($_GET['seccion']) &&( $_GET['seccion'] == 'cursos' || $_GET['seccion'] == 'certificaciones') ):?>
    $(function() {
      $.datepicker.regional['es'] = {
               closeText: 'Cerrar',
               prevText: '<Ant',
               nextText: 'Sig>',
               currentText: 'Hoy',
               monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
               monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
               dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
               dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
               dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
               weekHeader: 'Sm',
               dateFormat: 'dd/mm/yy',
               firstDay: 1,
               isRTL: false,
               showMonthAfterYear: false,
               yearSuffix: ''
             };
             $.datepicker.setDefaults($.datepicker.regional['es']);

      $("#calendariocursos").datepicker({
                    altField: "#fecha_curso",
                    altFormat: "yy-mm-dd",
                    onSelect: function () {
                        selectedDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
                        f_buscarInformacion(selectedDate, "<?php echo $_GET['seccion'];?>");
                    },
                    beforeShowDay: function(date) {
                      events = [<?php echo $params['eventos_datepicker'];?>];                      
                      current = $.datepicker.formatDate('yy-mm-dd', date);
                      return jQuery.inArray(current, events) == -1 ? [true, ''] : [true, 'ui-state-hover', 'ui-state-highlight'];
                    }
                  });
    });
<?php endif;?>
      $('document').ready(function() {
          /*Footer News Slider*/
          $('#footer-news').rivaSlider({
            visible : 1,
            selector : 'envor-post-preview'
          });

          $('#latest-news').rivaSlider({
            visible : 3,
            selector : 'envor-post-preview'
          });

          /*Team Slider*/
          $('#our-team').rivaSlider({
            visible : 3,
            selector : 'envor-team-1'
          });
          
          /*Our Partners Slider*/
          $('#our-partners').rivaCarousel({
            visible : 6,
            selector : 'envor-partner-logo',
            mobile_visible : 1
          });

          /*Home Page Layer Slider*/
          $('#layerslider').layerSlider({
            skinsPath               : 'css/layerslider/skins/',
            skin : 'fullwidth',
            thumbnailNavigation : 'hover',
            hoverPrevNext : false,
            responsive : false,
            responsiveUnder : 1170,
            sublayerContainer : 1170
          });
          
          /*Latest Projects Slider*/
          $('#featured-houses-certificados').rivaCarousel({
            visible : <?php echo $params['certificaciones_destacables'];?>,
            selector : 'envor-property-1',
            mobile_visible : 1
          });


          /*Latest Projects Slider*/
          $('#featured-houses').rivaCarousel({
            visible : <?php echo $params['cursos_destacables'];?>,
            selector : 'envor-property-1',
            mobile_visible : 1
          });

          $('#featured-instructors').rivaCarousel({
            visible : 4,
            selector : 'envor-property-1',
            mobile_visible : 1
          });

          /*Latest Added Homes Slider*/
          $('#latest-added-homes').rivaSlider({
            visible : 5,
            selector : 'envor-property-1'
          });

          /*Latest News Slider*/
          $('#latest-news').rivaSlider({
            visible : 3,
            selector : 'envor-post-preview'
          });

          /*Testimonials #1 Carousel*/
          $('#clients-testimonials').rivaCarousel({
            visible : 1,
            selector : 'envor-testimonials-2',
            mobile_visible : 1
          });

          /** Latest Twitter Posts*/
          setTimeout(function() {
            $('#twitter-posts').each(function() {
              $(this).find('ul > li').addClass('tweet-item').unwrap('ul');
              var $links = $(this).find('p.interact');
              $('<i class="fa fa-reply"></i>').prependTo($links.find('a.twitter_reply_icon'));
              $('<i class="fa fa-reply-all"></i>').prependTo($links.find('a.twitter_retweet_icon'));
              $('<i class="fa fa-heart"></i>').prependTo($links.find('a.twitter_fav_icon'));
              $(this).find('> li').unwrap('.envor-latest-tweets');
              $(this).show();
            })
            $('#latest-tweets').rivaSlider({
              visible : 1,
              selector : 'tweet-item'
            });
          }, 2000);


          /*Bestsellers Slider*/
          $('#bestsellers').rivaSlider({
            visible : 5,
            selector : 'envor-product-1'
          });
          $('#related-posts').rivaSlider({
            visible : 3,
            selector : 'envor-post-preview'
          });
          $('#clients-testimonials').rivaCarousel({
            visible : 1,
            selector : 'envor-testimonials-1',
            mobile_visible : 1
          });

      });
    </script>
    <script src="js/envor.js"></script>
    <script type="text/javascript">
      $('document').ready(function() {
          /*Preload Images*/
          var imgs = new Array(), $imgs = $('img');
          for (var i = 0; i < $imgs.length; i++) {
            imgs[i] = new Image();
            imgs[i].src = $imgs.eq(i).attr('src');
          }
          Core.preloader.queue(imgs).preload(function() {
            var images = $('a').map(function() {
                    return $(this).attr('href');
            }).get();
            Core.preloader.queue(images).preload(function() {
                  $.preloadCssImages();
            })
          })
          $('#envor-preload').hide();

          <?php if(isset($_GET['seccion'])): ?>
            ls_pagina = '<?php echo $_GET['seccion']; ?>';
            if(ls_pagina == 'calendario'){
              f_showCalendar();
            }
          <?php endif;?>
      });

     
     /*Windows Phone 8 и Internet Explorer 10*/
      if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style")
        msViewportStyle.appendChild(
          document.createTextNode(
            "@-ms-viewport{width:auto!important}"
          )
        )
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
      }
    </script>
    <style>
      .envor-page-title-1, 
      .envor-section-bg2,
      .envor-section-bg3,
      .envor-section-bg4,
      .envor-section-bg5,
      .envor-section-bg6,
      .envor-section-bg8,
      .envor-section-bg9,
      .envor-section-bg10,
      .envor-content-404{
        background-image: url(<?php echo $params['path_portada'];?>) !important;
      }
    </style>
</body>

