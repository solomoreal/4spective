<tr>
	<td></td>
	<td><?php echo $user->username; ?></td>
	
	<td><?php echo $user->email; ?></td>
	<td><?php echo $user->phone; ?></td>
	<?php 
		if ($user->is_active) {
			echo '<td><span class="label label-success">Active</span></td>';
		} else {
			echo '<td><span class="label label-danger">Inactive</span></td>';
		}
	?>
	<td>
		<div class="btn-group-vertical">
		
		</div>
	</td>
</tr>