<tr >
  <td><?php echo $persp ?></td>
  <td><?php echo $so_code ?></td>
  <td><?php echo $so_text ?></td>
  <td><?php echo $kpi_num ?></td>
  <td><?php echo $kpi_weight ?></td>
  <td>
    <div class="btn-group">
      <?php
        // echo anchor($add_kpi, '<i class="fa fa-plus"></i>', 'class="btn btn-default add-kpi"');
        echo '<button data-so="'.$so_id.'" class="btn btn-default detail-so" ><i class="fa fa-list"></i></button>';
        
        echo '<button data-so="'.$so_id.'" class="btn btn-default edit-so" data-toggle="modal" data-target="#so-form" ><i class="fa fa-pencil"></i></button>';
        
        echo '<button data-so="'.$so_id.'" class="btn btn-default remove-so" ><i class="fa fa-trash"></i></button>';
        
      ?>
    </div>
  </td>
</tr>

