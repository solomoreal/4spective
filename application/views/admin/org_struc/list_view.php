<table class="table table-hover">
	<thead>
		<tr>
			<th width="50">Type</th>
			<th>ID</th>
			<th>Code</th>
			<th>Name</th>
			<th width="100" class="hidden-xs">Begin</th>
			<th width="100" class="hidden-xs">End</th>
			<th width="50">Action</th>
		</tr>
	</thead>
	<tbody >
	<?php 

		if (isset($chief)) {
			echo '<tr>';
			echo '<td><i class="fa fa-user text-primary" title="'. lang('om_chief_post').'"></i></td>';
			echo '<td>'.$chief->post_id .'</td>';
			echo '<td>'.$chief->post_code .'</td>';
			echo '<td>'.$chief->post_name .'</td>';
			echo '<td class="hidden-xs">'.$chief->post_begin .'</td>';
			echo '<td class="hidden-xs">'.$chief->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class=" btn-group-vertical">';
			
			echo anchor('admin/post/detail/', '</i><i class="fa fa-list"></i> ', 'class="btn" title="Detail '. lang('om_post').'"');
			echo anchor('admin/post/edit_attr/', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit '. lang('om_post').'"');

			echo anchor('admin/post/delete/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete '. lang('om_post').'"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	
		}
	?>
	<?php
		foreach ($post_ls as $post_row) {
			echo '<tr>';
			echo '<td><i class="fa fa-user" title="'. lang('om_post').'"></i></td>';
			echo '<td>'.$post_row->post_id .'</td>';
			echo '<td>'.$post_row->post_code .'</td>';
			echo '<td>'.$post_row->post_name .'</td>';
			echo '<td class="hidden-xs">'.$post_row->post_begin .'</td>';
			echo '<td class="hidden-xs">'.$post_row->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group-vertical">';
			
			echo anchor('admin/post/detail/', '</i><i class="fa fa-list"></i> ', 'class="btn" title="Detail '. lang('om_post').'"');
			echo anchor('admin/post/edit_attr/', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit '. lang('om_post').'"');

			echo anchor('admin/post/delete/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete '. lang('om_post').'"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	

		}

		foreach ($org_ls as $org_row) {
			echo '<tr>';	
			echo '<td><i class="fa fa-sitemap" title="'. lang('om_org').'"></i></td>';
			echo '<td>'.$org_row->org_id .'</td>';
			echo '<td>'.$org_row->org_code .'</td>';
			echo '<td>'.$org_row->org_name .'</td>';
			echo '<td class="hidden-xs">'.$org_row->org_begin .'</td>';
			echo '<td class="hidden-xs">'.$org_row->org_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group-vertical">';
			
			echo '<a class="btn btn-org-in" data-org="'.$org_row->org_id.'">';
			echo '<i class="fa fa-arrow-right"></i>';
			echo '</a>';
			echo anchor('admin/org/detail/', '</i><i class="fa fa-list"></i> ', 'class="btn" title="Delete '. lang('om_org').'"');
			echo anchor('admin/org/edit_attr/', '</i><i class="fa fa-pencil"></i> ', 'class="btn" title="Edit '. lang('om_org').'"');
			echo anchor('admin/org/delete/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn" title="Delete '. lang('om_org').'"');

			echo '</div>';
			echo '</td>';
			echo '</tr>';	

		}
	?>
	</tbody>
</table>
