<?php ob_start() ?>
<div class="modal fade" id="cursos-certificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Seleccione lo que desea agregar a la fecha: <b><span id="date-txt"></span></b></h4>
      </div>
      <div class="modal-body" id="cursos-certificaciones-info">
        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="fecha_curso" id="fecha_curso">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="f_guardarSeleccion()">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-body no-padding">
          <button onclick="location.reload();" type="button" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-refresh"></i> Actualizar calendario</button>
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div><!-- /.box-body -->
      </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>