<table class="table table-hover">
	<thead>
		<tr>
			<th width="50">Type</th>
			<th><?php echo lang('basic_id'); ?></th>
			<th><?php echo lang('basic_code'); ?></th>
			<th><?php echo lang('basic_name'); ?></th>
			<th width="100" class="hidden-xs"><?php echo lang('time_begin'); ?></th>
			<th width="100" class="hidden-xs"><?php echo lang('time_end'); ?></th>
			<th width="50"><?php echo lang('basic_action'); ?></th>
		</tr>
	</thead>
	<tbody >
	<?php 
		foreach ($org_ls as $org_row) {
			echo '<tr class="org-row" data-org="'.$org_row->org_id.'">';	
			echo '<td><i class="fa fa-sitemap" title="'. lang('om_org').'"></i></td>';
			echo '<td>'.$org_row->org_id .'</td>';
			echo '<td>'.$org_row->org_code .'</td>';
			echo '<td>'.$org_row->org_name .'</td>';
			echo '<td class="hidden-xs">'.$org_row->org_begin .'</td>';
			echo '<td class="hidden-xs">'.$org_row->org_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<a class="btn btn-org-in" data-org="'.$org_row->org_id.'"><i class="fa fa-arrow-right"></i></a>';
			echo '</td>';
			echo '</tr>';	

		}
	?>
	<?php
		foreach ($post_ls as $post_row) {
			echo '<tr class="post-row" data-post="'.$post_row->post_id.'">';
			echo '<td><i class="fa fa-user" title="'. lang('om_post').'"></i></td>';
			echo '<td >'.$post_row->post_id .'</td>';
			echo '<td>'.$post_row->post_code .'</td>';
			echo '<td class="post_name">'.$post_row->post_name .'</td>';
			echo '<td class="hidden-xs">'.$post_row->post_begin .'</td>';
			echo '<td class="hidden-xs">'.$post_row->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<a class="btn btn-select" data-post="'.$post_row->post_id.'"><i class="fa fa-check"></i></a>';

			echo '</td>';
			echo '</tr>';	

		}

		
	?>
	</tbody>
</table>
