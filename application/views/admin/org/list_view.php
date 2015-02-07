<table class="table table-hover">
	<thead>
		<tr>
			<th width="10"></th>
			<th>ID</th>
			<th>Code</th>
			<th>Name</th>
			<th width="50">Type</th>
			<th width="100">Begin</th>
			<th width="100">End</th>
			<th width="100">Action</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach ($post_ls as $post_row) {
			echo '<tr>';
			echo '<td></td>';
			echo '<td>'.$post_row->post_id .'</td>';
			echo '<td>'.$post_row->post_code .'</td>';
			echo '<td>'.$post_row->post_name .'</td>';
			echo '<td>'.$post_row->type .'</td>';
			echo '<td>'.$post_row->post_begin .'</td>';
			echo '<td>'.$post_row->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '</td>';
			echo '</tr>';	
			echo '</tr>';

		}

		foreach ($org_ls as $org_row) {
			echo '<tr>';	
			echo '<td><i id="swt-child-'.$org_row->org_id.'" class="fa fa-folder btn btn-link swt-child" data-org="'. $org_row->org_id .'"></i></td>';
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

			echo '<tr id="tr-child-'.$org_row->org_id.'" class="tr-child" style="display: none;">';
			echo '<td colspan=8>';
			echo '</td>';
			echo '</tr>';


		}
	?>
	</tbody>
</table>