<table class="table table-hovered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Direction</th>
			<th>Type</th>
			<th>From</th>
			<th>To</th>
			<th>Begin</th>
			<th>End</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($rel_ls as $row) {
			echo '<tr>';
			echo '<td>'.$row->rel_id.'</td>';
			echo '<td>'.$row->direction.'</td>';
			echo '<td>'.$row->rel_type.'</td>';
			echo '<td>'.$row->obj_from.'</td>';
			echo '<td>'.$row->obj_to.'</td>';
			echo '<td>'.$row->begin.'</td>';
			echo '<td>'.$row->end.'</td>';
			echo '</tr>';
		}
	?>
	</tbody>
</table>