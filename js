<script type="text/javascript">
	// jQuery(document).ready(function($) {
	// 	// $(".org-child").hide();
	// 	// 
	// 	$("#org-child-<?php echo $org_row->org_id?>").hide();
	// 	var base_url = '<?php echo base_url()."index.php"?>';
	
	// 	$('.toggle-child').click(function(event) {
	// 		var status = $(this).data('status');
	// 		var parent_id = $(this).data('org');
	// 		var date_range = $('#dt_range_filter').val();

	// 		if (status=='close') {
	// 			$(this).attr('class', 'fa fa-folder-open btn btn-link toggle-child');
	// 			$(this).data('status','open');

	// 			$.ajax({
	// 				url: base_url + '/admin/org_post/show_child',
	// 				type: 'POST',
	// 				data: {parent: parent_id, date_range: date_range},
	// 			})
	// 			.done(function(html) {
	// 				// console.log("success");
	// 				$('#org-child-<?php echo $org_row->org_id?> td table tbody').html(html);
	// 				$("#org-child-<?php echo $org_row->org_id?>").show();
	// 			})
	// 			.fail(function() {
	// 				// console.log("error");
	// 			})
	// 			.always(function() {
	// 				// console.log("complete");
	// 			});
				
				

	// 		} else {
	// 			$(this).attr('class', 'fa fa-folder btn btn-link toggle-child');
	// 			$(this).data('status','close');
	// 			$('#org-child-<?php echo $org_row->org_id?> td table tbody').empty();
	// 			$("#org-child-<?php echo $org_row->org_id?>").hide();
	// 		};
	// 	});
	// });
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	$('.toggle-child').on('click', function() {
		var parent_class = $(this).attr('class');
		var parent_id = $(this).data('org');
		var base_url = '<?php echo base_url()."index.php"?>';
		var date_range = $('#dt_range_filter').val();
		var el = $('tr[data-org-tr="'+parent_id+'"]');
		var el2 = $('tr[data-org-tr="'+parent_id+'"] td table tbody');
		console.log(parent_class);
		if (parent_class=='fa fa-folder btn btn-link toggle-child') {
			$(this).attr('class', 'fa fa-folder-open btn btn-link toggle-child');
			el.show()
			$.ajax({
				url: base_url+'/admin/org_post/show_child',
				type: 'POST',
				data: {parent: parent_id, date_range: date_range},
			})
			.done(function(html) {
				el2.html(html);
				console.log("success2");
			})
			.fail(function() {
				console.log("error2");
			})
			.always(function() {
				console.log("complete2");
			});
			
			console.log('open');

		} else {
			$(this).attr('class', 'fa fa-folder btn btn-link toggle-child');
			el2.empty();
			el.hide()

			console.log('close');


		}
	});	
});
</script>