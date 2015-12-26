<tr>
  <td><?php echo $org_name?></td>

  <td><?php echo $status?></td>
  <td>
    <div class="btn-group">
      <?php
      echo anchor('plan/org/rev_sc/'.$sc_id, '<i class="fa fa-unlock"></i>', 'data-sc="'.$sc_id.'" class="btn btn-default"');
      ?>
    </div>
  </td>
</tr>