<table class="table table-hovered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Code</th>
			<th>Name</th>
			<th>Begin</th>
			<th>End</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($attr_ls as $row) {
			echo '<tr>';
			echo '<td>'.$row->attr_id.'</td>';
			echo '<td>'.$row->short_name.'</td>';
			echo '<td>'.$row->long_name.'</td>';
			echo '<td>'.$row->begin.'</td>';
			echo '<td>'.$row->end.'</td>';
			echo '</tr>';
		}
	?>
	</tbody>
</table>