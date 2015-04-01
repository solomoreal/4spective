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
	

						</div>
					</div>
				</div><!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
				<?php 
				$style = array('box-primary','box-info','box-success','box-warning','box-danger');
				$count = 0 ;
				foreach ($count_unit_ls as $row) {
					echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 sortable"><div class="box '.$style[$count%5].'" data-toggle="tooltip"  title="'.$row->description.'">';

					echo '<div class="box-header">';
					echo '<h3 class="box-title" >'.$row->short_name .' '.$row->long_name.'</h3>';
					echo '<div class="pull-right box-tools btn-group">';
					echo anchor($link_edit, '</i><i class="fa fa-pencil"></i> ', 'class="btn btn-act" data-code="'.$row->measure_id.'"title="'.lang('act_edit').'" data-fancybox-type="ajax"');
					echo anchor($link_remove, '</i><i class="fa fa-trash text-danger"></i> ', 'class="btn btn-act" data-code="'.$row->measure_id.'"title="'.lang('act_remove').'" data-fancybox-type="ajax"');
					echo '</div>'; // .tools
					echo '</div>'; // .box-header

					echo '<div class="box-body">';
					echo '<dl>';
				  // echo '<dt>'.lang('basic_name').'</dt><dd>'. $row->long_name.'</dd>';

				  echo '<dt>'.lang('number_range').'</dt>';
				  echo '<dd>';
				  if ($row->has_min) {
						echo $row->min_val;
					} else {
						echo '-&infin;';
					}

					echo ' ~ ';
				  if ($row->has_max) {
						echo $row->max_val;
					} else {
						echo '&infin;';
					}

					echo '</dd>'; // range

					echo '<dt>'.lang('number_real').'</dt>';
					if ($row->real_num) {
						echo '<dd><i class="fa fa-check"></i></dd>';
					} else {
						echo '<dd><i class="fa fa-times"></i></dd>';
					}

					echo '</dl>';
					echo '</div>'; // .box-body
					echo '</div></div>';
					$count++;
				}
				?>
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
