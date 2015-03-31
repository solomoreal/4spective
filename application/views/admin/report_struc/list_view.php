<table class="table table-hover">
	<thead>
		<tr>
			<th width="50">Type</th>
			<th><?php echo lang('basic_id'); ?></th>
			<th><?php echo lang('om_post_code'); ?></th>
			<th><?php echo lang('om_post_name'); ?></th>

			<th width="100" class="hidden-xs"><?php echo lang('time_begin'); ?></th>
			<th width="100" class="hidden-xs"><?php echo lang('time_end'); ?></th>
			<th width="50"><?php echo lang('basic_action'); ?></th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach ($chief_ls as $post_row) {
			echo '<tr>';
			echo '<td><i class="fa fa-user text-primary" title="'. lang('om_post').'"></i></td>';
			echo '<td>'.$post_row->post_id .'</td>';
			echo '<td>'.$post_row->post_code .'</td>';
			echo '<td>'.$post_row->post_name .'</td>';

			echo '<td class="hidden-xs">'.$post_row->post_begin .'</td>';
			echo '<td class="hidden-xs">'.$post_row->post_end .'</td>';
			echo '<td>';
			// Untuk Action Btn
			echo '<div class="btn-group-vertical">';
			echo '<a class="btn btn-post-in" data-post="'.$post_row->post_id.'"><i class="fa fa-arrow-right"></i></a>';
			echo anchor('admin/post/detail/'.$post_row->post_id, '</i><i class="fa fa-list"></i> ', 'class="btn" data-obj="'.$post_row->post_id.'" title="'.lang('act_view_detail').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo anchor('admin/post/edit_attr/', '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act-2" data-obj="'.$post_row->post_id.'" title="'.lang('act_delete').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo anchor('admin/post/delete/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act-2" data-obj="'.$post_row->post_id.'" title="'.lang('act_delete').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	

		}

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
			echo '<a class="btn btn-post-in" data-post="'.$post_row->post_id.'"><i class="fa fa-arrow-right"></i></a>';
			echo anchor('admin/post/detail/'.$post_row->post_id, '</i><i class="fa fa-list"></i> ', 'class="btn" data-obj="'.$post_row->post_id.'" title="'.lang('act_view_detail').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo anchor('admin/post/edit_attr/', '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act-2" data-obj="'.$post_row->post_id.'" title="'.lang('act_delete').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo anchor('admin/post/delete/', '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act-2" data-obj="'.$post_row->post_id.'" title="'.lang('act_delete').' '. lang('om_post').'" data-fancybox-type="ajax"');
			echo '</div>';

			echo '</td>';
			echo '</tr>';	

		}
	?>
	</tbody>
</table>
