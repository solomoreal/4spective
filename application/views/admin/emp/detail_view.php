<?php $this->load->view('_template/main_top'); ?>
	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
	<!-- Main content -->
		<section class="content" id="sec-main">
			<div id="" class="row">
				<div id="" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box box-solid">
						<div class="box-header"></div>
						<div class="box-body">
							<div class="form-group">
			          <label>Date Filter</label>
			          <div class="input-group">
			            <div class="input-group-addon">
			              <i class="fa fa-calendar"></i>
			            </div>
			            <?php echo form_input('dt_range_filter', $filter_date, 'class="form-control pull-right daterange"'); ?>
			            <span class="input-group-btn">
				            <button class="btn " type="button" id="btn_filter">Go!</button>
				          </span>
			          </div>
				      </div>
						</div>
					</div>
				</div>

				<div id="" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="box box-solid">

						<div class="box-body">
							<div class="box-tools btn-group">

							<?php 
								echo anchor('admin/employee', '<i class="fa fa-arrow-left"></i>', 'class="btn"');
							?>
							</div>
							<div class="box-tools btn-group">

								<button class="btn" data-toggle="modal" data-target="#modal-name"><i class="fa fa-pencil"></i></button>

								<button class="btn" data-toggle="modal" data-target="#modal-cont"><i class="fa fa-phone"></i></button>

								<button class="btn" data-toggle="modal" data-target="#modal-pass"><i class="fa fa-lock"></i></button>
							</div>
							<div class="box-tools btn-group">
								<?php 
								echo anchor('admin/employee/add_post/'.$emp_code, '<i class="fa fa-briefcase"></i>', 'class="btn"');
								?>
							</div><!-- /. tools -->
						</div>
					</div>	
				</div>
			</div>
			<?php echo form_hidden('hdn_emp', $emp_code); ?>
			<!-- top row -->
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<h3 class="box-title" id="post-title"></h3>

						</div>
						<div id="last-attr" class="box-body">
							
							<div class="row">
								<div class="col-sm-12">
									<dl class="dl-horizontal">

									  <dt><?php echo lang('pa_join_date'); ?></dt>
									  <dd class="emp-join"></dd>

									  <dt><?php echo lang('pa_emp_code'); ?></dt>
									  <dd class="emp-code"></dd>
									  <dt><?php echo lang('pa_name'); ?></dt>
									  <dd class="emp-name"></dd>
									  <dt><?php echo lang('om_attr_begin'); ?></dt>
									  <dd class="emp-begin"></dd>
									  <dt><?php echo lang('om_attr_end'); ?></dt>
									  <dd class="emp-end"></dd>
									</dl>

									<dl class="dl-horizontal">

									  <dt><?php echo lang('pa_email'); ?></dt>
									  <dd class="emp-email"></dd>

									  <dt><?php echo lang('pa_cellphone'); ?></dt>
									  <dd class="emp-cell"></dd>

									  
									</dl>
								</div>
							</div>

						</div>
					</div>

					<div class="nav-tabs-custom">
	          <ul class="nav nav-tabs">
	            <li class="active"><a href="#tab_rel" id='nav-rel' data-toggle="tab" aria-expanded="true">Position</a></li>
	            <li class=""><a href="#tab_attr" id='nav-attr' data-toggle="tab" aria-expanded="false">History Position</a></li>
	          </ul>
	          <div class="tab-content">
	            <div class="tab-pane active" id="tab_rel">
	              							 
	            </div><!-- /.tab-pane -->
	            <div class="tab-pane" id="tab_attr">
	              
	            </div><!-- /.tab-pane -->
	          </div><!-- /.tab-content -->
	        </div>

				</div><!-- /.col -->
			</div>
			<!-- /.row -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<div class="modal fade" id="modal-name" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('admin/employee/edit_name', ''); ?>


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Name</h4>
      </div>
      <div class="modal-body">
	      <div class="form-group">
			    <label ><?php echo lang('basic_name');?></label>
			    <?php echo form_input('txt_name', '', 'class="form-control emp-name" id="txt_name"'); ?>
			  </div>

			  <div class="form-group">
			    <label ><?php echo lang('time_start');?></label>
			    <?php echo form_input('dt_start', '', 'class="form-control emp-begin datepicker" id="dt_start"'); ?>
			  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-cont" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('admin/employee/edit_contact', ''); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
      </div>
      <div class="modal-body">

	      <div class="form-group">
			    <label ><?php echo lang('pa_email');?></label>
			    <?php echo form_input('txt_email', '', 'class="form-control emp-email" id="txt_phone"'); ?>
			  </div>

			  <div class="form-group">
			    <label ><?php echo lang('pa_cellphone');?></label>
			    <?php echo form_input('txt_phone', '', 'class="form-control emp-cell" id="txt_phone"'); ?>
			  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-pass" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('admin/employee/edit_pass', ''); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Password</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


<?php $this->load->view('_template/main_bot'); ?>

<script>
jQuery(document).ready(function($) {
	refresh();

	$('#btn_filter').click(function(event) {
			refresh();
		});

	function refresh () {
		var base_url   = '<?php echo base_url()."index.php"?>';
	 	var date_range = $('#dt_range_filter').val();
	 	var emp_code   = $('#hdn_emp').val();
	 	
	 	
		$.ajax({
			url: base_url+'/admin/employee/fetch_attr',
			type: 'POST',
	 		dataType: 'json',

			data: {
				emp_code: emp_code,
				date_range: date_range
			},
		})
		.done(function(respond) {
			$('.emp-join').html(respond.emp_begin);

			$('.emp-code').html(respond.emp_code);
			$('.emp-name').html(respond.fullname);

			$('.emp-begin').html(respond.attr_begin);
			$('.emp-end').html(respond.attr_end);

			$('.emp-email').html(respond.email);
			$('.emp-cell').html(respond.phone);

			$('.emp-code').val(respond.emp_code);

			$('.emp-name').val(respond.fullname);
			$('.emp-begin').val(respond.attr_begin);

			$('.emp-email').val(respond.email);
			$('.emp-cell').val(respond.phone);
			
		});
		
	}
});
</script>