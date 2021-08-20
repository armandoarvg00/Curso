<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Configurar subtítulos</li>
  </ol>
</section>

<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'):?>
      <div class="alert alert-success">
          <i class="fa fa-check-circle"></i> Subtítulos actualizados correctamente
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>

    <?php if(isset($arams['mensaje_error']) && $params['mensaje_error'] <> ''):?>
      <div class="alert alert-danger">
          <i class="fa fa-check-circle"></i> <?php echo $arams['mensaje_error'];?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>
    
    <div class="col-md-6">
      <div class="box">
        <div class="box-body">
          <div class="form-group">
            <label for="introduccion">Introducción</label>
            <input type="text" class="form-control" id="introduccion" name="introduccion" placeholder="Introducción" value="<?php echo  $params['informacion_subtitulos']['introduccion'];?>">
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" value="<?php echo  $params['informacion_subtitulos']['descripcion'];?>">
          </div>

          <div class="form-group">
            <label for="objetivos">Objetivos</label>
            <input type="text" class="form-control" id="objetivos" name="objetivos" placeholder="Objetivos" value="<?php echo  $params['informacion_subtitulos']['objetivos'];?>">
          </div>


          <div class="form-group">
            <label for="objetivos">Características</label>
            <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" placeholder="Caracterìísticas" value="<?php echo  $params['informacion_subtitulos']['caracteristicas'];?>">
          </div>


          <div class="form-group">
            <label for="dirigido">Dirigido</label>
            <input type="text" class="form-control" id="dirigido" name="dirigido" placeholder="Dirigido" value="<?php echo  $params['informacion_subtitulos']['dirigido'];?>">
          </div>


        </div><!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-6">
      <div class="box">
        <div class="box-body">
          <div class="form-group">
            <label for="prerequisitos">Pre-requisitos</label>
            <input type="text" class="form-control" id="prerequisitos" name="prerequisitos" placeholder="Pre-requisitos" value="<?php echo  $params['informacion_subtitulos']['prerequisitos'];?>">
          </div>

          <div class="form-group">
            <label for="tomarlo_nostros">¿Por qué tomarlo con nosotros?</label>
            <input type="text" class="form-control" id="tomarlo_nosotros" name="tomarlo_nosotros" placeholder="¿Por qué tomarlo con nosotros?" value="<?php echo  $params['informacion_subtitulos']['tomarlo_nosotros'];?>">
          </div>


          <div class="form-group">
            <label for="material_estudio">Material de estudio</label>
            <input type="text" class="form-control" id="material_estudio" name="material_estudio" placeholder="Material de estudio" value="<?php echo  $params['informacion_subtitulos']['material_estudio'];?>">
          </div>


          <div class="form-group">
            <label for="temario">Temario</label>
            <input type="text" class="form-control" id="temario" name="temario" placeholder="Temario" value="<?php echo  $params['informacion_subtitulos']['temario'];?>">
          </div>


          <div class="form-group">
            <label for="otrasnotas">Otras notas</label>
            <input type="text" class="form-control" id="otrasnotas" name="otrasnotas" placeholder="Otras notas" value="<?php echo  $params['informacion_subtitulos']['otrasnotas'];?>">
          </div>


        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-danger btn-block" name="btn_submit" id="btn_submit">Guardar</button>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>