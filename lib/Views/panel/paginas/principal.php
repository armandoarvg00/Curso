<?php ob_start() ?>


<section class="content-header">
  <h1>
    Principal
    <small>Panel de administración</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Panel principal</li>
  </ol>
</section>

<section class="content">
  <!--Inician contadores-->
  <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $params['total_suscripciones'];?></h3>
            <p>Suscripciones</p>
          </div>
          <div class="icon">
            <i class="fa fa-heart"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $params['total_certificaciones'];?><sup style="font-size: 20px"></sup></h3>
            <p>Certificaciones</p>
          </div>
          <div class="icon">
            <i class="fa fa-certificate"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $params['total_cursos'];?></h3>
            <p>Cursos</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $params['total_mensajes'];?></h3>
            <p>Mensajes</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
        </div>
      </div><!-- ./col -->
    </div>
  <!--Finalizan contadores-->






  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-envelope"></i> Últimos mensajes</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Correo</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($params['mensajes'] as $mensaje):?>
              <tr>
                <td><?php echo $mensaje['id_mensaje'] ;?></td>
                <td><?php echo $mensaje['nombre'] ;?></td>
                <td><?php echo $mensaje['mail'] ;?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="index.php?seccion=mensajes<?php echo $_SESSION['QUERY_STRING'];?>">
            Ver todos
          </a>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->


    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user"></i> Últimos suscriptores</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Correo</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($params['suscripciones'] as $mensaje):?>
              <tr>
                <td><?php echo $mensaje['id_suscriptor'] ;?></td>
                <td><?php echo $mensaje['nombre'] ;?></td>
                <td><?php echo $mensaje['mail'] ;?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="index.php?seccion=suscripciones<?php echo $_SESSION['QUERY_STRING'];?>">
            Ver todos
          </a>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->

  </div><!-- /.row -->
</section><!-- /.content -->

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layoutPanel.php' ?>