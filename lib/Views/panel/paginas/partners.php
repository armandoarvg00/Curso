<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Partners</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'):?>
      <div class="alert alert-success">
          <?php if($_GET['action'] == 'add'): ?>
            <i class="fa fa-check-circle"></i> Se agregó correctamente
          <?php else: ?>
            <i class="fa fa-check-circle"></i> Se actualizó correctamente
          <?php endif; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de partners</h3>
            <div class="box-tools">
              <a href="index.php?seccion=nuevo_partner<?php echo $_SESSION['QUERY_STRING'];?>" class="pull-left btn btn-success btn-sm" title="Agregar nuevo registro"> + </a> 
              <div class="pull-left input-group" style="width: 150px; margin-left: 5px;">
                <?php include(__DIR__.'/../componentes/search_table.php'); ?>
              </div>              
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Imagen</th>
                  <th>Estatus</th>
                  <th>Acciones</th>
                </tr>
                <?php if(count($params['informacion']) > 0): ?>
                  <?php foreach($params['informacion'] as $informacion): ?>
                    <tr>
                      <td><?php echo $informacion['id_partner'];?></td>
                      <td><?php echo $informacion['nombre'];?></td>
                      <td><img src="<?php echo $informacion['path_portada'] ;?>" width="75" height="30"></td>
                      <?php if($informacion['status'] == 1): ?>
                        <td>Activo</td>
                      <?php else: ?>
                        <td>Inactivo</td>
                      <?php endif; ?>
                      <td width="140px">
                        <a href="index.php?seccion=nuevo_partner<?php echo $_SESSION['QUERY_STRING'];?>&action=update&id_partner=<?php echo $informacion['id_partner'];?>" class="label label-success"><i class="fa fa-edit"></i> Editar </a> - <a href="index.php?seccion=partners<?php echo $_SESSION['QUERY_STRING'];?>&action=borrar&id_partner=<?php echo $informacion['id_partner'];?>" class="label label-danger"><i class="fa fa-trash"></i> Borrar </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5">
                      <a href="index.php?seccion=nuevo_partner<?php echo $_SESSION['QUERY_STRING'] ?>&action=add"><i class="fa fa-check-circle"></i> No se encontraron partners. Haga clic aquí para agregar uno. </a>
                    </td>
                  </tr>
                <?php endif; ?>
            </tbody>
          </table>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <?php echo $params['paginacion'];?>
            </ul>
          </div>
        </div>
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>