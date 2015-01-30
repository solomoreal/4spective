<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content">
			<?php $this->load->view('_template/daterange_filter'); ?>
			<!-- top row -->
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<!-- tools box -->
							<div class="pull-right box-tools">
								<?php echo anchor('', '<i class="fa fa-plus"></i> ', 'class="btn btn-primary"');?>
							</div><!-- /. tools -->
						</div>
						<div class="box-body">
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
								<tbody id="org-list">

								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.col -->
			</div>
			<!-- /.row -->

		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php $this->load->view('_template/main_bot'); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.daterange').daterangepicker({
			format: 'YYYY/MM/DD',
		});
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var base_url = '<?php echo base_url()."index.php"?>';
		refresh();

		$('#btn_filter').click(function(event) {
			refresh();
		});

		function refresh () {
		 	var date_range = $('#dt_range_filter').val();
		 	$.ajax({
		 		url: base_url+'/admin/org_post/show_root',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			parent: 0,
		 		},
		 	})
		 	.done(function(html) {
		 		console.log("success");
				$('#org-list').html(html);
		 	})
		 	.fail(function() {
		 		console.log("error");
		 	})
		 	.always(function() {
		 		console.log("complete");
		 	});
		 	
		}		 
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.toggle-child').toggle(function() {
			$(this).attr('class', 'fa fa-folder-open btn btn-link toggle-child');
		}, function() {
			$(this).attr('class', 'fa fa-folder btn btn-link toggle-child');
		});
		
	});

</script>
<script type="text/javascript">
// jQuery(document).ready(function($) {
// 	$('.org-child').hide();
// 	$('.toggle-child').on('click', function() {
// 		var parent_class = $(this).attr('class');
// 		var parent_id = $(this).data('org');

// 		var el = $('tr[data-org-tr="'+parent_id+'"]');
// 		console.log(el);
// 		if (parent_class=='fa fa-folder btn btn-link toggle-child') {
// 			$(this).attr('class', 'fa fa-folder-open btn btn-link toggle-child');
// 			el.show()

// 			console.log('open');

// 		} else {
// 			$(this).attr('class', 'fa fa-folder btn btn-link toggle-child');
// 			el.hide()
// 				console.log('close');


// 		}
// 	});	
// });
</script>
