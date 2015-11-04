<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<?php $this->load->view('_template/daterange_filter'); ?>
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
								<button type="button" class="btn" data-toggle="modal" data-target="#myModal" title="<?php echo lang('act_add').' '. lang('om_emp')?>">
								  <i class="fa fa-plus"></i><i class="fa fa-user"></i>
								</button>
								<?php 
									
									// echo anchor($link_add, '<i class="fa fa-plus"></i><i class="fa fa-user"></i> ', 'title='.lang('act_add').' '. lang('om_emp') .'" class="btn btn-act" data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div id="emp-list" class="box-body">
							
						</div>
					</div>
				</div><!-- /.col -->
			</div>
			<!-- /.row -->
		</section><!-- /.content -->

		<div class="modal fade" id="myModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
	      	<?php
	      		echo form_open($process, 'emp_form');
	      	?>
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">New Employee</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="form-group">
					    <label for="txt_code"><?php echo lang('pa_emp_code'); ?>/Username</label>
					    <input type="text" class="form-control" id="txt_code" name="txt_code" placeholder="000000">
					  </div>

					  <div class="form-group">
					    <label for="txt_name"><?php echo lang('pa_name'); ?></label>
					    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="fullname">
					  </div>

					  <div class="form-group">
					    <label for="txt_email"><?php echo lang('pa_email'); ?></label>
					    <div class="input-group">
					    	<div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
					    	<input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="john@somewhere.com">
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="txt_phone"><?php echo lang('pa_cellphone'); ?></label>
					    <div class="input-group">
					    	<div class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></div>
					    	<input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="+628110001234">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="dt_join"><?php echo lang('pa_join_date'); ?></label>
					    <div class="input-group">
					    	<div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
					    	<input type="text" class="form-control datepicker" id="dt_join" name="dt_join">
					    </div>
					  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
		        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
		      </div>
	      	<?php
	      		echo form_close();
	      	?>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
	refresh();

	$('#btn_filter').click(function(event) {
			refresh();
	});


	function refresh () {
		var base_url = '<?php echo base_url()."index.php"?>';
		 var date_range = $('#dt_range_filter').val();
		$.ajax({
			url: base_url + '/admin/employee/show_list',
			type: 'POST',
			data: {date_range: date_range,},
		})
		.done(function(respond) {
			$('#emp-list').html(respond);

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('.btn-delete').click(function(event) {
				/* Act on the event */
				var emp_code = $(this).data('emp-code');
				swal({   
					title: "<?php echo lang('confirm_sure'); ?>",   
					text: "<?php echo lang('confirm_delete'); ?>",   
					type: "warning",   
					showCancelButton: true,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "<?php echo lang('act_delete'); ?>",   
					closeOnConfirm: false 
				}, function(){   
						console.log(emp_code);

					$.ajax({
						url: base_url + '/admin/employee/delete',
						type: 'POST',
						data: {emp_code: emp_code},
					})
					.done(function() {
            swal({
                title: "Deleted!",
                text: "<?php echo lang('notif_delete_ok'); ?>",
                type: "success"
              }, function (){
                location.reload();
              });
						console.log("success");
					});
					
					
				});
			});

		});
		
	}
</script>
