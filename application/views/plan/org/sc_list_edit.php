<tr>
  <td><?php echo $org_name?></td>
  <td><?php echo $status?></td>
  <td>
    <div class="btn-group">
      <?php
      echo anchor('plan/org/edit_sc/'.$sc_id, '<i class="fa fa-pencil"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default link"');
      echo anchor('plan/org/send_sc/'.$sc_id, '<i class="fa fa-send"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default link"');
      ?>
    </div>
  </td>
</tr>