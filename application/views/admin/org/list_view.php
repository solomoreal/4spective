<table class="table table-hover">
	<thead>
		<tr>
			<th width="50">Type</th>
			<th>ID</th>
			<th>Code</th>
			<th>Name</th>
			<th width="100">Begin</th>
			<th width="100">End</th>
			<th width="150">Action</th>
		</tr>
	</thead>
	<tbody >
	<?php 
		if (count($chief)) {
			echo '<tr>';
			echo '<td><i class="fa fa-user text-primary" title="Position"></i></td>';
			echo '<td>'.$chief->post_id .'</td>';
			echo '<td>'.$chief->post_code .'</td>';
			echo '<td>'.$chief->post_name .'</td>';
			echo '<td>'.$chief->post_begin .'</td>';
			echo '<td>'.$chief->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group">';
			
			echo anchor('', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit Position"');
			echo anchor('', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete Position"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	
		}
	?>
	<?php
		foreach ($post_ls as $post_row) {
			echo '<tr>';
			echo '<td><i class="fa fa-user" title="Position"></i></td>';
			echo '<td>'.$post_row->post_id .'</td>';
			echo '<td>'.$post_row->post_code .'</td>';
			echo '<td>'.$post_row->post_name .'</td>';
			echo '<td>'.$post_row->post_begin .'</td>';
			echo '<td>'.$post_row->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group">';
			
			echo anchor('', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit Position"');
			echo anchor('', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete Position"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	

		}

		foreach ($org_ls as $org_row) {
			echo '<tr>';	
			echo '<td><i class="fa fa-sitemap" title="Organization"></i></td>';
			echo '<td>'.$org_row->org_id .'</td>';
			echo '<td>'.$org_row->org_code .'</td>';
			echo '<td>'.$org_row->org_name .'</td>';
			echo '<td>'.$org_row->org_begin .'</td>';
			echo '<td>'.$org_row->org_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group">';
			echo form_button('btn_org_'.$org_row->org_id,'<i class="fa fa-arrow-right"></i>','title="Go to" class="btn btn-org" data-org="'.$org_row->org_id.'"');
			echo anchor('', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit Organization"');
			echo anchor('', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete Organization"');

			// echo anchor('', '<i class="fa fa-arrow-right"></i>', 'class="btn btn-org" title="Go to" data-org="'.$org_row->org_id.'"');
			echo '</div>';
			echo '</td>';
			echo '</tr>';	

		}
	?>
	</tbody>
</table>