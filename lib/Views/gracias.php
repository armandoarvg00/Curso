<?php ob_start() ?>


<!-- Google Code for Contacto Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 881232535;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "NTvgCNbz42YQl5WapAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>

<noscript>
  <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/881232535/?label=NTvgCNbz42YQl5WapAM&amp;guid=ON&amp;script=0"/>
  </div>
</noscript>
 


  <section class="envor-page-title-1" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h1 align="center"><i class="glyphicon glyphicon-ok"></i> ¡Gracias, su mensaje ha sido enviado correctamente!</h1>          
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
          <div class="panel panel-default" style="border: none; cursor: pointer;" data-toggle="modal" data-target="#modal-sugerencias">
            <div class="panel-heading" style="background: #c9302c !important; color: #FFF !important; font-size: 16px; margin-top: 40px; padding: 30px; text-align: center;">
              <i class="fa fa-comment"></i> ¿Cómo podemos mejorar para atenderle mejor?<br><u><b>Haga clic aquí</b></u>
            </div>            
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="modal fade" id="modal-sugerencias" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-comment"></i> Queremos saber sus intereses
      </div>
      <div class="modal-body">
        <form id="frm_sugerencias" style="margin-top: 0px; margin-bottom: 5px; padding: 0px;">
          <div class="form-group">
            <label for="exampleInputEmail1">Escriba su nombre</label>
            <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="nombre_sugerencia" name="nombre_sugerencia" placeholder="Escriba su nombre completo">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Correo electrónico</label>
            <input type="text" maxlength="30" class="form-control" id="mail_sugerencia" name="mail_sugerencia" placeholder="ejemplo@impulseits.com">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Redacte su mensaje</label>
            <textarea class="form-control" maxlength="100" onkeypress="return soloLetras(event)" id="mensaje_sugerencia" name="mensaje_sugerencia" rows="3"></textarea>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>
      <div class="modal-footer" style="padding: 5px; margin-top: 5px;">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
        <input type="button" class="btn btn-danger" onclick="f_enviaSugerencias()" value="Enviar">
      </div>
    </div>
  </div>
</div>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutWebsite.php' ?>