<tr>
  <td><?php echo $org_name?></td>

  <td><?php echo $status?></td>
  <td>
    <div class="btn-group">
      <?php
      echo '<a class="btn btn-default btn-org-in" data-org="'.$org_id.'"><i class="fa fa-arrow-right"></i></a>';
      echo anchor('plan/org/view_sc/'.$sc_id, '<i class="fa fa-list"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default link"');
      
      // echo anchor('plan/org/rev_sc/'.$sc_id, '<i class="fa fa-unlock"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default"');
      echo '<button class="sc-rev btn btn-default" data-sc="'.$sc_id.'"><i class="fa fa-unlock"></i></button>';
      ?>

    </div>
  </td>
</tr>