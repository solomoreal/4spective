<tr>
  <td><?php echo $org_name?></td>
  <td><?php echo $status?></td>
  <td>
    <div class="btn-group">
      <?php
      echo '<a class="btn btn-default btn-org-in" data-org="'.$org_id.'"><i class="fa fa-arrow-right"></i></a>';
      echo anchor('plan/org/view_sc/'.$sc_id, '<i class="fa fa-list"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default link"');
      echo '<button class="btn-approve btn btn-success" data-sc="'.$sc_id.'"><i class="fa fa-thumbs-up"></i></button>';
      echo '<button class="btn-reject btn btn-danger" data-sc="'.$sc_id.'"><i class="fa fa-thumbs-down"></i></button>';
      ?>

    </div>
  </td>
</tr>