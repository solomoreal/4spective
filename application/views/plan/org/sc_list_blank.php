<tr>
  <td><?php echo $org_name?></td>
  <td><?php echo $status?></td>
  <td>
    <div class="btn-group">
      <?php
      
      echo '<a class="btn btn-default btn-org-in" data-org="'.$org_id.'"><i class="fa fa-arrow-right"></i></a>';
      
      echo anchor('plan/org/new_sc_process/'.$period.'/'.$org_id, '<i class="fa fa-file"></i>', 'data-org="'.$org_id.'" title="New" class="btn btn-default create-new"');
      // echo anchor('plan/org/copy_sc/'.$period.'/'.$org_id, '<i class="fa fa-clone"></i>', 'data-org="'.$org_id.'" title="Copy" class="btn btn-default create-copy"');
      ?>
      <button data-toggle="modal" data-target="#modal-copy-sc" data-org="<?php echo $org_id; ?>" data-period="<?php echo $period; ?>" title="Copy" class="btn btn-default create-copy"><i class="fa fa-clone"></i></button>
    </div>
  </td>
</tr>