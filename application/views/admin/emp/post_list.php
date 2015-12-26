<tr data-rel="<?php echo $rel_id; ?>">
  <td class="val"><?php echo $value ?></td>
  <td class="begin"><?php echo $begin ?></td>
  <td class="end"><?php echo $end ?></td>
  <td><?php echo $id ?></td>
  <td><?php echo $code ?></td>
  <td><?php echo $name ?></td>
  <td>
    <div class="btn-group">
      <button class="btn btn-default btn-hold-edit" data-toggle="modal" data-target="#modal-edit-hold" title="<?php echo lang('act_edit')?>"><i class="fa fa-pencil"></i></button>
      <button class="btn btn-default btn-hold-rem" title="<?php echo lang('act_remove')?>"><i class="fa fa-trash"></i></button>
    </div>
  </td>
</tr>