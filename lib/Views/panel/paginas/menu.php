<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Configurar menu</li>
  </ol>
</section>

<form id="frm_informacion" name="frm_informacion" method="POST">
<section class="content">
  <div class="row">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div class="alert alert-success">
          <i class="fa fa-check-circle"></i> Menú actualizado correctamente
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif;?>
    <div class="alert alert-danger" style="display: none;">
        <i class="fa fa-check-circle"></i> Ocurrió un error inesperado
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <i class="fa fa-cog"></i> Configurar opciones del menú
          <div class="pull-right input-group" style="width: 100px;">
            <button type="submit" class="btn btn-success">Guardar orden</button>
          </div>
        </div>
        <div class="box-body">
          <form method="post">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>Descripción</th>
                        <th style="width: 70px;">Orden</th>
                        <th>Usuario modifica</th>
                        <th>fecha modifica</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($params['menu'] as $item):?>
                    <tr>
                        <td><?php echo $item['id'];?></td>
                        <td><?php echo $item['descripcion']; ?></td>
                        <td>
                          <input type="number" class="form-control" id="<?php echo $item['tag'];?><?php echo $item['id'];?>" name="<?php echo $item['id'];?>" value="<?php echo $item['secuencia'];?>">
                        </td>
                        <td><?php echo $item['user_mod'];?></td>
                        <td><?php echo $item['fecha_mod'];?></td>
                      <?php if($item['status'] == 1): ?>
                        <td>Activo</td>
                      <?php else:?>
                        <td>Inactivo</td>
                      <?php endif;?>

                      <?php if($item['status'] == 1): ?>
                        <td><a href="index.php?seccion=menu<?php echo $_SESSION['QUERY_STRING'];?>&action=ocultar&id=<?php echo $item['id'];?>" class="label label-danger"><i class="fa fa-trash"></i> Ocultar </a></td>
                      <?php else:?>
                        <td><a href="index.php?seccion=menu<?php echo $_SESSION['QUERY_STRING'];?>&action=mostrar&id=<?php echo $item['id'];?>" class="label label-success"><i class="fa fa-eye"></i> Mostrar </a></td>
                      <?php endif;?>
                    </tr>
                  <?php endforeach;?>
                </tbody>
            </table>
          </form>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->

  </div><!-- /.row -->
</section><!-- /.content -->
</form>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>