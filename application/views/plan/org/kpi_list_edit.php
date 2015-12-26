<tr >
  <td><?php echo $so ?></td>
  <td><?php echo $kpi_code ?></td>
  <td><?php echo $kpi_name ?></td>
  <td><?php echo $weight ?></td>
  <td><?php echo $ytd ?></td>
  <td><?php echo $formula ?></td>
  <td>
    <div class="btn-group">
      <?php
        // echo anchor($add_kpi, '<i class="fa fa-plus"></i>', 'class="btn btn-default add-kpi"');
        echo '<button data-kpi="'.$kpi_id.'" class="btn btn-default detail-kpi" ><i class="fa fa-list"></i></button>';
        
        echo '<button data-kpi="'.$kpi_id.'" class="btn btn-default edit-kpi" data-toggle="modal" data-target="#kpi-form" ><i class="fa fa-pencil"></i></button>';
        
        echo '<button data-kpi="'.$kpi_id.'" class="btn btn-default remove-kpi" ><i class="fa fa-trash"></i></button>';
        
      ?>
    </div>
  </td>
</tr>

