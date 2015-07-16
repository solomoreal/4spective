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
								<?php 
									echo anchor($link_hire, '<i class="fa fa-plus"></i><i class="fa fa-user"></i> ', 'title="Add '. lang('menu_user') .'" class="btn btn-act" data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div class="box-body">
							<table class="table table-hover">
                <thead>
                  <tr>
                    <th width="50">Type</th>
                    <th><?php echo lang('basic_username'); ?></th>
                    <th><?php echo lang('basic_email'); ?></th>
                    <th><?php echo lang('basic_phone'); ?></th>
                    <th><?php echo lang('basic_status'); ?></th>
                    <th width="50"><?php echo lang('basic_action'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  
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


<?php 
	$this->load->view('_template/main_bot'); 
?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.daterange').daterangepicker({
			format: 'YYYY/MM/DD',
		});
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {


	});
</script>
