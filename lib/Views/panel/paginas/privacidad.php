<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Aviso de privacidad</li>
  </ol>
</section>
<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($params['mensaje'])):?>
      <div class="alert alert-danger"><?php echo $params['mensaje'];?></div>
    <?php endif; ?>
    <?php if(isset($params['mensaje_ok'])):?>
      <div class="alert alert-success"><?php echo $params['mensaje_ok'];?></div>
    <?php endif; ?>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cube"></i> Aviso de privacidad</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <label for="titulo">Título</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="titulo" name="titulo" class="form-control" placeholder="Escriba un titulo" value="<?php echo $params['titulo'];?>">
          </div>
          <br>
          <label for="subtitulo">Subtítulo</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text" maxlength="100" id="subtitulo" name="subtitulo" class="form-control" placeholder="Escriba un subtítulo" value="<?php echo $params['subtitulo'];?>">
          </div>
          <br>
          <label for="informacion">Información</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea rows="8" id="informacion" name="informacion" class="form-control" placeholder="Redacte la información"><?php echo $params['informacion'];?></textarea>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" value="1" name="guardar" id="guardar" class="btn btn-danger btn-block">Guardar</button>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>