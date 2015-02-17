<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<section class="content" id="sec-form">
		</section>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<?php $this->load->view('_template/daterange_filter'); ?>
			<?php echo form_hidden('hdn_org', 1); ?>
			<!-- top row -->
			<div class="row">
				<div class="col-xs-12">
					<div id="box-breadcrumb" class="box-body">
							
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<h3 class="box-title" id="org-title"></h3>
						<!-- tools box -->
							<div class="pull-right box-tools btn-group">
								<a href="#" title="Edit <?php echo lang('om_org'); ?>" class="btn btn-act" data-action="edit" data-obj-type="org">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#" class="btn btn-act btn-add" title="Add '.lang('om_org').'" id="btn_add_org" data-action="add" data-obj-type="org">
									<i class="fa fa-plus"></i>
									<i class="fa fa-sitemap"></i> 
								</a>
								<a href="#" class="btn btn-act btn-add" title="Add '.lang('om_post').'" id="btn-add-post" data-action="add" data-obj-type="post">
									<i class="fa fa-plus"></i>
									<i class="fa fa-user"></i>
								</a>

							</div><!-- /. tools -->
						</div>
						<div id="org-list" class="box-body">
							
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

		refresh();

		$('.btn-act').click(function(event) {
			var base_url = '<?php echo base_url()."index.php/admin/"?>';
			var action   = $(this).data('action');
			var obj_type = $(this).data('obj-type');
			var org_id   = $(this).data('org');
		 	var parent   = $('#hdn_org').val();

			$.ajax({
				url: base_url+obj_type+'/'+action,
				type: 'POST',
				data: {
					org_id: org_id,
					parent: parent},
			})
			.done(function(html) {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

			$('#sec-main').animate({
				opacity:0},
				'slow', function() {
				$('#sec-main').hide();
			});
			
		});

		$('#btn_filter').click(function(event) {
			refresh();
		});

		function refresh () {
			var base_url = '<?php echo base_url()."index.php"?>';
		 	var date_range = $('#dt_range_filter').val();
		 	var org_id = $('#hdn_org').val();

		 	// DO Fetch Breadcrumb of Organization
		 	$.ajax({
		 		url:  base_url+'/admin/org_struc/show_breadcrumb',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			org_id: org_id,
		 		},
		 	})
		 	.done(function(html) {
		 		$('#box-breadcrumb').html(html);


		 	})
		 	.fail(function() {
		 		console.log("error breadcrumb");
		 	})
		 	.always(function() {
		 		$('.link-org').click(function() {
		 			var org_to = $(this).data('org');
		 			$('#hdn_org').val(org_to);
		 			refresh();
		 		});
		 	});
		 	
		 	// DO Fetch Position and Organization under Parent Organization
		 	$.ajax({
		 		url: base_url+'/admin/org_struc/show_child',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			parent: org_id,
		 		},
		 	})
		 	.done(function(html) {
				$('#org-list').html(html);
		 	})
		 	.fail(function() {
		 		console.log("error list");
		 	})
		 	.always(function() {
		 		$('.btn-org-in').click(function() {
		 			var org_to = $(this).data('org');
		 			$('#hdn_org').val(org_to);
		 			refresh();
		 		});
		 		
			});

			// DO Fetch Organization Name
		 	$.ajax({
		 		url: base_url+'/admin/org_struc/show_current',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			org_id: org_id,
		 		},
		 	})
		 	.done(function(html) {
				$('#org-title').html(html);
		 	})
		 	.fail(function() {
		 		console.log("error title");
		 	})
		 	.always(function() {
		 		
			});			 	
		}		 
	});
</script>