<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Sugerencias del sitio web</li>
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
            <h3 class="box-title">Listado de sugerencias</h3>
            <div class="box-tools">
              <!--<a href="index.php?seccion=nuevo_curso<?php echo $_SESSION['QUERY_STRING'];?>" class="pull-left btn btn-success btn-sm" title="Agregar nuevo registro"> + </a> -->
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
                  <th>Mail</th>
                  <th>Mensaje</th>
                  <th>Fecha</th>
                </tr>
                <?php if(count($params['informacion']) > 0): ?>
                  <?php foreach($params['informacion'] as $informacion): ?>
                    <tr>
                      <td><?php echo $informacion['id_sugerencia'];?></td>
                      <td><?php echo $informacion['nombre'];?></td>
                      <td><?php echo $informacion['mail'];?></td>
                      <td><?php echo $informacion['mensaje'];?></td>
                      <td><?php echo $informacion['fecha_alta'];?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5">
                      No se encontraron sugerencias</a>
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