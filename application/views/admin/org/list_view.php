<tr>
	<td><i class="fa fa-folder btn btn-link toggle-child" data-status="close" data-org="<?php echo $org_row->org_id ?>"></i></td>
	<td><?php echo $org_row->org_id ?></td>
	<td><?php echo $org_row->org_code ?></td>
	<td><?php echo $org_row->org_name ?></td>
	<td><?php echo $org_row->type ?></td>
	<td><?php echo $org_row->org_begin ?></td>
	<td><?php echo $org_row->org_end ?></td>
	<td>

	</td>
</tr>

<tr id="org-child-<?php echo $org_row->org_id ?>" class="org-child" data-org-tr="<?php echo $org_row->org_id ?>" style="display:none">
	<td colspan="8">
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
			<tbody>

			</tbody>
		</table>
	</td>
</tr>

