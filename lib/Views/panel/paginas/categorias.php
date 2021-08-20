<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Categorías en el sitio web</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'):?>
      <div class="alert alert-success">
          <?php if($_GET['action'] == 'add'): ?>
            <i class="fa fa-check-circle"></i> Se agregó correctamente
          <?php elseif($_GET['action'] == 'update'): ?>
            <i class="fa fa-check-circle"></i> Se actualizó correctamente
          <?php elseif($_GET['action'] == 'borrar'): ?>
            <i class="fa fa-check-circle"></i> Se borró correctamente
          <?php endif; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
    <?php endif; ?>
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de categorías</h3>
            <div class="box-tools">
              <a href="index.php?seccion=nueva_categoria<?php echo $_SESSION['QUERY_STRING'];?>" class="pull-left btn btn-success btn-sm" title="Agregar nuevo registro"> + </a> 
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
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Tipo</th>
                  <th>Estatus</th>
                  <th>Acciones</th>
                </tr>
                <?php if(count($params['informacion']) > 0): ?>
                  <?php foreach($params['informacion'] as $informacion): ?>
                    <tr>
                      <td><?php echo $informacion['id_categoria'];?></td>
                      <td><?php echo $informacion['categoria'];?></td>
                      <td><?php echo $informacion['descripcion'];?></td>
                      
                      <?php if($informacion['tipo'] == 'certificaciones'): ?>
                        <td>Certificaciones</td>
                      <?php elseif($informacion['tipo'] == 'cursos'): ?>
                        <td>Cursos</td>
                      <?php elseif($informacion['tipo'] == 'blog'): ?>
                        <td>Blog</td>
                      <?php elseif($informacion['tipo'] == 'servicios'): ?>
                        <td>Servicios</td>
                      <?php elseif($informacion['tipo'] == 'webinars'): ?>
                        <td>Webinars</td>
                      <?php endif; ?>

                      <?php if($informacion['status'] == 1): ?>
                        <td>Activo</td>
                      <?php else: ?>
                        <td>Inactivo</td>
                      <?php endif; ?>
                      <td width="140px"> 
                        <a href="index.php?seccion=nueva_categoria<?php echo $_SESSION['QUERY_STRING'];?>&action=update&id_categoria=<?php echo $informacion['id_categoria'];?>" class="label label-success"><i class="fa fa-edit"></i> Editar </a> - <a href="index.php?seccion=categorias<?php echo $_SESSION['QUERY_STRING'];?>&action=borrar&id_categoria=<?php echo $informacion['id_categoria'];?>" class="label label-danger"><i class="fa fa-trash"></i> Borrar </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5">
                      <a href="index.php?seccion=nueva_categoria<?php echo $_SESSION['QUERY_STRING'] ?>&action=add"><i class="fa-check-circle"></i> No se encontraron categorías. Haga clic aquí para agregar una. </a>
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