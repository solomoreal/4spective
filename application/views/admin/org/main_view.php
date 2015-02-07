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

				$('#org-list').html(html);
		 	})
		 	.fail(function() {
		 		console.log("root error");
		 	})		 	
		}		 
	});
</script>