
	<?php 
		echo '<tr style="background-color:#'.$row->color.';">';
		echo '<td >'.$row->pc_score.'</td>';

		if (is_null($row->lower)) {
			echo '<td>-&infin;</td>';
		} else {
			echo '<td>'. $row->lower.'</td>';
		}

		if (is_null($row->upper)) {
			echo '<td>&infin;</td>';
		} else {
			echo '<td>'. $row->upper.'</td>';
		}
	?>
	<td>
		<div class=" btn-group-vertical">
		<?php
			echo anchor($link_edit, '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act-score" data-id="'.$row->score_id.'"  title="'.lang('act_edit').' '. lang('basic_score').'" data-fancybox-type="ajax"');
			echo anchor($link_remove, '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act-score" data-id="'.$row->score_id.'" title="'.lang('act_delete').' '. lang('basic_score').'" data-fancybox-type="ajax"');
		?>
		</div>
	</td>
</tr>
