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
									echo anchor($link_add, '<i class="fa fa-plus"></i>', 'title="'.lang('act_add').'" class="btn btn-act" " data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div  class="box-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th><?php echo lang('basic_id'); ?></th>
										<th><?php echo lang('basic_code'); ?></th>
										<th><?php echo lang('basic_name'); ?></th>
										<th><?php echo lang('basic_desc'); ?></th>
										<th width="100">Min</th>
										<th width="100">Max</th>
										<th width="100">Real Num.</th>
										<th width="50"><?php echo lang('basic_action'); ?></th>
									</tr>
								</thead>
								<tbody >

								<?php
									foreach ($count_unit_ls as $row) {
										echo '<tr>';
										echo '<td>'.$row->measure_id.'</td>';
										echo '<td>'.$row->short_name.'</td>';
										echo '<td>'.$row->long_name.'</td>';
										echo '<td>'.$row->description.'</td>';
										
										if ($row->has_min) {
											echo '<td>'.$row->min_val.'</td>';
										} else {
											echo '<td>-&infin;</td>';
										}

										if ($row->has_max) {
											echo '<td>'.$row->max_val.'</td>';
										} else {
											echo '<td>&infin;</td>';
										}

										if ($row->real_num) {
											echo '<td><i class="fa fa-check"></i></td>';
										} else {
											echo '<td><i class="fa fa-times"></i></td>';
										}
										echo '<td>';
										// Untuk Action Btn
										echo '<div class=" btn-group-vertical">';
										
										echo anchor($link_edit, '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act" data-code="'.$row->measure_id.'"title="'.lang('act_edit').'" data-fancybox-type="ajax"');
										echo anchor($link_remove, '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act" data-code="'.$row->measure_id.'"title="'.lang('act_remove').'" data-fancybox-type="ajax"');
										echo '</div>';

										echo '</td>';
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
          height: 605,
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
