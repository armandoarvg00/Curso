<i class="glyphicon glyphicon-align-justify" id="envor-mobile-menu-btn"></i>
<div class="envor-mobile-menu" id="envor-mobile-menu">
  <h3>Menú</h3>
    <nav>
      <ul>
        <?php foreach($params['menu_principal'] as $item): ?>
        <?php if($item['tag'] == 'capacitacion'): ?>
          <li>
            <a href="javascript:void(0)"><?php echo $item['descripcion']?></a>
            <ul>
                <?php if(isset($params['categorias_menu']) && count($params['categorias_menu']) > 0):?>
                  <?php foreach($params['categorias_menu'] as $catLi):?>
                    <li style="line-height: 20px !important; margin-bottom: 15px;"><a style="text-transform: none !important;" href="index.php?seccion=<?php echo $catLi['tipo'];?>&id_categoria=<?php echo $catLi['id_categoria'];?>"><?php echo $catLi['descripcion'];?></a></li>
                  <?php endforeach;?>
                <?php endif;?>
            </ul>
          </li>
        <?php else:?>
          <li><a href="index.php?seccion=<?php echo $item['tag']?>"><?php echo $item['descripcion']?></a></li>
        <?php endif;?>
        
      <?php endforeach;?>
      </ul>
    </nav>
</div>