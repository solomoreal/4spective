<tr>
	<td><?php echo $row->pc_score; ?></td>
	<td><?php echo $row->lower; ?></td>
	<td><?php echo $row->upper; ?></td>
	<td>
		<div class=" btn-group-vertical">
		<?php
			echo anchor($link_edit, '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act-2" data-id="'.$row->score_id.'"  title="'.lang('act_delete').' '. lang('menu_formula').'"');
			echo anchor($link_remove, '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act-2" data-id="'.$row->score_id.'" title="'.lang('act_delete').' '. lang('menu_formula').'" data-fancybox-type="ajax"');
		?>
		</div>
	</td>
</tr>
