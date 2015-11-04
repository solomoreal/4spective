<table class="table table-hover">
	<thead>
		<tr>
			<th><?php echo lang('basic_code'); ?></th>
			<th><?php echo lang('basic_name'); ?></th>
			<th width="100" class="hidden-xs"><?php echo lang('time_begin'); ?></th>
			<th width="100" class="hidden-xs"><?php echo lang('time_end'); ?></th>
			<th width="50"><?php echo lang('basic_action'); ?></th>
		</tr>
	</thead>
	<tbody >
	<?php 
		foreach ($emp_ls as $emp_row) {
			echo '<tr>';	
			echo '<td>'.$emp_row->emp_code .'</td>';
			echo '<td>'.$emp_row->fullname .'</td>';
			echo '<td class="hidden-xs">'.$emp_row->emp_begin .'</td>';
			echo '<td class="hidden-xs">'.$emp_row->emp_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group-vertical">';
			echo anchor('admin/employee/detail/'.$emp_row->emp_code, '</i><i class="fa fa-list"></i> ', 'class="btn"  data-emp-code="'.$emp_row->emp_code.'" title="'.lang('act_view_detail').' '. lang('om_emp').'"');
			echo '<button class="btn btn-delete" data-emp-code="'.$emp_row->emp_code.'" title="'.lang('act_delete').' '. lang('om_org').'"></i><i class="fa fa-trash text-danger"></i></button>';

			echo '</div>';
			echo '</td>';
			echo '</tr>';	

		}

		
	?>
	</tbody>
</table>
