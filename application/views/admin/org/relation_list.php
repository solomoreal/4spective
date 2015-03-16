<div class="row">
	<div class="col-xs-12">
		<div class="btn-group pull-right">
			<?php 
				echo anchor($add_rel, '<i class="fa fa-plus"></i>', 'title="Add '. lang('om_rel') .'" class="btn btn-rel"  data-fancybox-type="ajax"');
			?>
		</div>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>

			<th>Type</th>
			<th colspan="3">From</th>
			<th colspan="3">To</th>
			<th>Begin</th>
			<th>End</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($rel_ls as $row) {
			echo '<tr>';
			echo '<td>'.$row->rel_id.'</td>';

			echo '<td>'.lang('om_rel_'.$row->rel_type).'</td>';
			echo '<td>'.$row->obj_from.'</td>';
			echo '<td>'.$row->code_from.'</td>';
			echo '<td>'.$row->name_from.'</td>';
			echo '<td>'.$row->obj_to.'</td>';
			echo '<td>'.$row->code_to.'</td>';
			echo '<td>'.$row->name_to.'</td>';
			echo '<td>'.$row->begin.'</td>';
			echo '<td>'.$row->end.'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group-vertical">';
			echo anchor('admin/org/delete_rel/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-rel" data-rel="'.$row->rel_id.'" title="'.lang('act_delete').' '. lang('om_post').'" data-fancybox-type="ajax"');
			
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}
	?>
	</tbody>
</table>
