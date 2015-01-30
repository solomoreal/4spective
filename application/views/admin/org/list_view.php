<table class="table">
	<thead>
		<tr>
			<th></th>
			<th>ID</th>
			<th>Code</th>
			<th>Name</th>
			<th width="100">Type</th>
			<th width="200">Begin</th>
			<th width="200">End</th>
			<th width="100">Action</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach ($org_ls as $org_row) {
			echo '<tr>';	
			echo '<td><i class="fa fa-folder btn btn-link toggle-child" data-status="close" data-org="'. $org_row->org_id .'"></i></td>';
			echo '<td>'.$org_row->org_id .'</td>';
			echo '<td>'.$org_row->org_code .'</td>';
			echo '<td>'.$org_row->org_name .'</td>';
			echo '<td>'.$org_row->type .'</td>';
			echo '<td>'.$org_row->org_begin .'</td>';
			echo '<td>'.$org_row->org_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '</td>';
			echo '</tr>';	


		}
	?>
	</tbody>
</table>