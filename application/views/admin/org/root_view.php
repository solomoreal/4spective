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
			echo '<tr>';	
			echo '<td><i id="swt-root" class="fa fa-folder btn btn-link swt-child" data-org="'. $org_row->org_id .'"></i></td>';
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
	?>
	</tbody>
</table>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		$('#swt-root').toggleClick(function() {
			// ODD click Event
			var parent = $(this).data('org');
			var base_url = '<?php echo base_url()."index.php"?>';
			var date_range = $('#dt_range_filter').val();
			var el_1 = $('#tr-child-'+parent);
			var el_2 = $('#tr-child-'+parent+' td');
			$(this).attr('class', 'fa fa-folder-open btn btn-link swt-child');

			el_1.show();
			$.ajax({
		 		url: base_url+'/admin/org_post/show_child',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			parent: parent,
		 		},
		 	})
		 	.done(function(html) {

				el_2.html(html);
		 	})
		 	.fail(function() {
		 		console.log("root error");
		 	})		 


		}, function() {
			// EVEN Click Event
			var parent = $(this).data('org');
			var el_1 = $('#tr-child-'+parent);
			var el_2 = $('#tr-child-'+parent+' td');
			$(this).attr('class', 'fa fa-folder btn btn-link swt-child');
			el_1.hide();
			el_2.empty();

		
		});
	});
</script>