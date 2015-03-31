<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<!-- top row -->

			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<h3 class="box-title" id="org-title"></h3>
						<!-- tools box -->
							<div class="pull-right box-tools btn-group">

							</div><!-- /. tools -->
						</div>
						<div  class="box-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th><?php echo lang('basic_score'); ?></th>
										<th><?php echo lang('basic_low_bnd'); ?></th>
										<th><?php echo lang('basic_up_bnd'); ?></th>
										<th><?php echo lang('basic_color'); ?></th>
									</tr>
								</thead>
								<tbody >

								<?php
									foreach ($score_ls as $row) {
										echo '<tr>';
										echo '<td>'.$row->pc_score.'</td>';
										echo '<td>'.$row->lower.'</td>';
										echo '<td>'.$row->upper.'</td>';
										echo '<td style="background-color:#'.$row->color.';"></td>';
										echo '</tr>';
									}
								?>
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
		$('.btn-act').click(function(e) {
			var code = $(this).data('code');
			e.preventDefault();
			$.ajax({
				url: this.href,
				type: 'POST',
				data: {
					code: code},
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
          afterClose: function(){parent.location.reload(true)}
        }); // fancybox
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
	});
</script>
