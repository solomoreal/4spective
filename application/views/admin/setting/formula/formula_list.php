<tr>
	<td><a href="#" class="tgl-score" data-id="<?php echo $row->formula_id; ?>"><i class="fa fa-chevron-right"></i></a></td>
	<td><?php echo $row->formula_id; ?></td>
	<td><?php echo $type_ls[$row->type]; ?></td>
	<td><?php echo $row->formula_name; ?></td>
	<td><?php echo $row->description; ?></td>
	<td class="hidden-xs"><?php echo $row->begin; ?></td>
	<td class="hidden-xs"><?php echo $row->end; ?></td>
	<td>
		<div class=" btn-group-vertical">
		<?php
			echo anchor($link_add, '</i><i class="fa fa-plus"></i> ', 'class="btn btn-act-2"  data-id="'.$row->formula_id.'" title="'.lang('act_add').' '. lang('number_score').'"');
			echo anchor($link_edit, '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act-2" data-id="'.$row->formula_id.'"  title="'.lang('act_delete').' '. lang('menu_formula').'"');
			echo anchor($link_remove, '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act-2" data-id="'.$row->formula_id.'" title="'.lang('act_delete').' '. lang('menu_formula').'" data-fancybox-type="ajax"');
		?>
		</div>
	</td>
</tr>
<tr class="box-score" data-id="<?php echo $row->formula_id; ?>">
<td colspan="8">
	<table class="table">
		<thead>
			<tr>
					<th><?php echo lang('number_score'); ?></th>
					<th><?php echo lang('number_lower'); ?></th>
					<th><?php echo lang('number_uppper'); ?></th>
					<th width="50"><?php echo lang('basic_action'); ?></th>
			</tr>
		</thead>
		<tbody class="list-score" data-id="<?php echo $row->formula_id; ?>">
			
		</tbody>
		
	</table>
</td>
</tr>