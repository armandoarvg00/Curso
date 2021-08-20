<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Cursos por cliente</li>
  </ol>
</section>

<section class="content">
  <div class="row">

    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de cursos</h3>
            <div class="box-tools">
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
                  <th>Curso</th>
                  <th>Cliente</th>
                  <th>Referencia paypal</th>
                  <th>Fecha de compra</th>
                </tr>

                  <?php foreach($params['informacion'] as $informacion): ?>

                    <tr>
                      <td><?php echo $informacion['id_cliente_curso'];?></td>
                      <td><?php echo $informacion['titulo'];?></td>
                      <td><?php echo $informacion['nombre_completo'];?></td>
                      <td><?php echo $informacion['ReferenciaPayPal'];?></td>
                      <td><?php echo $informacion['fecha_compra'];?></td>
                    </tr>
                  <?php endforeach; ?>
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
