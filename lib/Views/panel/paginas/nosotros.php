<?php ob_start() ?>
<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Configurar nosotros</li>
  </ol>
</section>

<?php include(__DIR__.'/../componentes/modal_icons.php');?>

<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($params['mensaje'])):?>
      <div class="alert alert-danger"><?php echo $params['mensaje'];?></div>
    <?php endif; ?>
    <?php if(isset($params['mensaje_ok'])):?>
      <div class="alert alert-success"><?php echo $params['mensaje_ok'];?></div>
    <?php endif; ?>
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-users"></i> Página: nosotros <small>Escriba todo lo que pueda decir de su empresa</small></h3>
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
            <input type="text" maxlength="100"  id="subtitulo" name="subtitulo" class="form-control" placeholder="Escriba un subtítulo" value="<?php echo $params['subtitulo'];?>">
          </div>
          <br>
          <label for="informacion">Información</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea id="informacion" name="informacion" rows="10" cols="80"><?php echo $params['informacion'];?></textarea>
          </div>
          <br>
          <label for="porque_nosotros">¿Por qué nosotros?</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <textarea id="porque_nosotros" name="porque_nosotros" rows="10" cols="80"><?php echo $params['porque_nosotros'];?></textarea>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-4">
      <div class="box">
        <div class="box-body">
          <label for="titulo">Imagen (Resolución recomendada: 714x500)</label>
          <div class="input-group">
            <label for="photo">
              <div class="photo-preview" align="center" data-page="<?php echo $_GET['seccion'];?>">
                  <?php if(isset($params['path_portada']) && $params['path_portada'] <> ''): ?>
                    <img src="<?php echo $params['path_portada']; ?>" class="img-responsive" id="img-preview">
                  <?php else: ?>
                    <img src="../img/upload_portada.jpg" class="img-responsive" id="img-preview">
                  <?php endif; ?>
              </div>
              <input type="file" accept="image/*;capture=camera" id="photo" name="photo" style="display: none;">
            </label>
            <input type="hidden" name="path_portada" id="path_portada" value="<?php echo $params['path_portada']; ?>">
            <?php include(__DIR__ . '/../componentes/quitar_imagen_destacada.php');?>
          </div>
          <br>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-users"></i> Especialidades</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <label for="especialidad_uno">Título especialidades</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
            <input type="text"  maxlength="150" id="titulo_especialidades" name="titulo_especialidades" class="form-control" placeholder="Título" value="<?php echo $params['titulo_especialidades'];?>">
          </div>
          <br>

          <div style="height: 650px; overflow: hidden; overflow-y: scroll;">
            <label for="especialidad_uno">Especialidad</label>
            <div class="input-group">
              <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_uno" data-icon-destino="uno" data-punto-destino="icono_especialidad_uno" data-class-original="<?php echo $params['icono_especialidad_uno'];?>">
                <i class="fa <?php echo $params['icono_especialidad_uno'];?>" id="uno"></i>
              </span>
              <input type="hidden" name="icono_especialidad_uno" id="icono_especialidad_uno" value="<?php echo $params['icono_especialidad_uno'];?>">
              <input type="text"  maxlength="50" id="titulo_especialidad_uno" name="titulo_especialidad_uno" class="form-control" placeholder="Título" value="<?php echo $params['titulo_especialidad_uno'];?>">              
              <textarea rows="3" maxlength="150" id="desc_especialidad_uno" name="desc_especialidad_uno" class="form-control" placeholder="Redacte descripción"><?php echo $params['desc_especialidad_uno'];?></textarea>
            </div>
            <br>
            <label for="especialidad_dos">Especialidad</label>
            <div class="input-group">
              <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_dos" data-icon-destino="dos" data-punto-destino="icono_especialidad_dos" data-class-original="<?php echo $params['icono_especialidad_dos'];?>">
                <i class="fa <?php echo $params['icono_especialidad_dos'];?>" id="dos"></i>
              </span>
              <input type="hidden" name="icono_especialidad_dos" id="icono_especialidad_dos" value="<?php echo $params['icono_especialidad_dos'];?>">

              <input type="text" maxlength="50"  id="titulo_especialidad_dos" name="titulo_especialidad_dos" class="form-control" placeholder="Título" value="<?php echo $params['titulo_especialidad_dos'];?>">
              <textarea rows="3" maxlength="150" id="desc_especialidad_dos" name="desc_especialidad_dos" class="form-control" placeholder="Redacte descripción"><?php echo $params['desc_especialidad_dos'];?></textarea>
            </div>
            <br>
            <label for="especialidad_tres">Especialidad</label>
            <div class="input-group">
              <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_tres" data-icon-destino="tres" data-punto-destino="icono_especialidad_tres" data-class-original="<?php echo $params['icono_especialidad_tres'];?>">
                <i class="fa <?php echo $params['icono_especialidad_tres'];?>" id="tres"></i>
              </span>
              <input type="hidden" name="icono_especialidad_tres" id="icono_especialidad_tres" value="<?php echo $params['icono_especialidad_tres'];?>">

              <input type="text" maxlength="50"  id="titulo_especialidad_tres" name="titulo_especialidad_tres" class="form-control" placeholder="Título" value="<?php echo $params['titulo_especialidad_tres'];?>">
              <textarea rows="3" maxlength="150" id="desc_especialidad_tres" name="desc_especialidad_tres" class="form-control" placeholder="Redacte descripción"><?php echo $params['desc_especialidad_tres'];?></textarea>
            </div>
            <br>
            <label for="especialidad_cuatro">Especialidad</label>
            <div class="input-group">
              <span class="input-group-addon" onclick="f_abrirIconos(this)" id="icon_cuatro" data-icon-destino="cuatro" data-punto-destino="icono_especialidad_cuatro" data-class-original="<?php echo $params['icono_especialidad_cuatro'];?>">
                <i class="fa <?php echo $params['icono_especialidad_cuatro'];?>" id="cuatro"></i>
              </span>
              <input type="hidden" name="icono_especialidad_cuatro" id="icono_especialidad_cuatro" value="<?php echo $params['icono_especialidad_cuatro'];?>">

              <input type="text" maxlength="50"  id="titulo__especialidad_cuatro" name="titulo_especialidad_cuatro" class="form-control" placeholder="Título" value="<?php echo $params['titulo_especialidad_cuatro'];?>">
              <textarea rows="3"  maxlength="150" id="desc_especialidad_cuatro" name="desc_especialidad_cuatro" class="form-control" placeholder="Redacte descripción"><?php echo $params['desc_especialidad_cuatro'];?></textarea>
            </div>
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