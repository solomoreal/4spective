<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<?php $this->load->view('_template/daterange_filter'); ?>
			<?php echo form_hidden('hdn_post', $parent_id); ?>
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
						<h3 class="box-title" id="box-title"></h3>
						<!-- tools box -->
							<div class="pull-right box-tools btn-group">
								<?php 
									echo anchor($link_edit_post, '<i class="fa fa-pencil"></i>', 'title="Edit '. lang('om_org') .'" class="btn btn-act"  data-fancybox-type="ajax"');
									echo anchor($link_add_post, '<i class="fa fa-plus"></i> <i class="fa fa-briefcase"></i> ', 'title="Add '. lang('om_post') .'" class="btn btn-act" " data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div id="div-list" class="box-body">
							
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

		$('#btn_filter').click(function(event) {
			refresh();
		});

		$('.btn-act').click(function(e) {
			var date_range = $('#dt_range_filter').val();
		 	var parent = $('#hdn_post').val();
			e.preventDefault();
			$.ajax({
				url: this.href,
				type: 'POST',
				data: {
					parent: parent,
					obj_id: parent,
					date_range: date_range},
			})
			.done(function(data) {
				 $.fancybox(data, {
          // fancybox API options
          fitToView: true,
          width: 905,
          height: 505,
          autoSize: false,
          closeClick: false,
          openEffect: 'none',
          closeEffect: 'none',
          afterClose: function(){refresh()}
        }); // fancybox
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
		

		function refresh () {
			var base_url = '<?php echo base_url()."index.php"?>';
		 	var date_range = $('#dt_range_filter').val();
		 	var obj_id = $('#hdn_post').val();

		 	// DO Fetch Breadcrumb of Organization
		 	$.ajax({
		 		url:  base_url+'/admin/report_struc/show_breadcrumb',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			obj_id: obj_id,
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
		 			$('#hdn_post').val(org_to);
		 			refresh();
		 		});
		 	});
		 	
		 	// DO Fetch Position and Organization under Parent Organization
		 	$.ajax({
		 		url: base_url+'/admin/report_struc/show_child',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			parent: obj_id,
		 		},
		 	})
		 	.done(function(html) {
				$('#div-list').html(html);
				
		 	})
		 	.fail(function() {
		 		console.log("error list");
		 	})
		 	.always(function() {
		 		$('.btn-post-in').click(function() {
		 			var post_to = $(this).data('post');
		 			$('#hdn_post').val(post_to);
		 			refresh();
		 		});

		 		// DO .btn-act-2 behavior 
				$('.btn-act-2').click(function(e) {
					var date_range = $('#dt_range_filter').val();
				 	var parent = $('#hdn_org').val();
				 	var obj_id = $(this).data('obj');
					e.preventDefault();
					$.ajax({
						url: this.href,
						type: 'POST',
						data: {
							obj_id: obj_id,
							date_range: date_range},
					})
					.done(function(data) {
						 $.fancybox(data, {
		          // fancybox API options
		          fitToView: true,
		          width: 905,
		          height: 505,
		          autoSize: false,
		          closeClick: false,
		          openEffect: 'none',
		          closeEffect: 'none',
		          afterClose: function(){refresh()}
		        }); // fancybox
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}); // end of .btn-act-2
		 		
			});

			// DO Fetch Organization Name
		 	$.ajax({
		 		url: base_url+'/admin/report_struc/show_current',
		 		type: 'POST',
		 		data: {
		 			date_range: date_range,
		 			obj_id: obj_id,
		 		},
		 	})
		 	.done(function(html) {
				$('#box-title').html(html);
		 	})
		 	.fail(function() {
		 		console.log("error title");
		 	})
		 	.always(function() {
		 		
			});			 	
		}		 
	});
</script>
