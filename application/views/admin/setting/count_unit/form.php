<?php  
$this->load->view('_template/basic_top');
echo '<h2>'.lang('menu_count_unit').'</h2>';
?>
<i class="fa fa-spinner fa-pulse fa-5x" id="loading"></i>
<div class="row">
	<div class="col-sm-12" id="result"></div>

</div>
<?php
echo form_open($process, 'class="form-horizontal col-sm-12"', $hidden);
?>
<div class="form-group">
	<label for="txt_short" class="col-sm-2 control-label"><?php echo lang('basic_code')?></label>
	<div class="col-sm-9">
		<?php echo form_input('txt_short', $short, 'label="Code" placeholder="Code" class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<label for="txt_long" class="col-sm-2 control-label"><?php echo lang('basic_name')?></label>
	<div class="col-sm-9">
		<?php echo form_input('txt_long', $long, 'label="Name" placeholder="Name" class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<label for="txt_code" class="col-sm-2 control-label"><?php echo lang('basic_desc')?></label>
	<div class="col-sm-9">
		<?php echo form_textarea('txt_desc', $desc, 'class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<label for="nm_min" class="col-sm-2 control-label"><?php echo lang('basic_min')?></label>
	<div class="col-sm-2">
		<div class="input-group">
			<span class="input-group-addon">
		     <?php echo form_checkbox('chk_min', 1, $has_min,'id="chk_min"');?>
		  </span>
			<?php echo form_number('nm_min', $min_val, 'class="form-control"');?>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="nm_max" class="col-sm-2 control-label"><?php echo lang('basic_max')?></label>
	<div class="col-sm-2">
		<div class="input-group">
			<span class="input-group-addon">
		     <?php echo form_checkbox('chk_max', 1, $has_max,'id="chk_max"');?>
		  </span>
			<?php echo form_number('nm_max', $max_val, 'class="form-control"');?>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="nm_max" class="col-sm-2 control-label">Real Number</label>
	<div class="col-sm-1">
		<?php echo form_checkbox('chk_real', 1, $is_real, 'id="chk_real"');?>
	</div>

</div>
<div class="form-group">
	<div class="col-sm-9 col-sm-offset-2">
		<?php echo form_submit('btn_submit', lang('act_save'),'class="btn btn-primary');?>
	</div>
</div>
<?php

echo form_close();
$this->load->view('_template/basic_bot');

?>
<script>
jQuery(document).ready(function($) {
	$('#loading').hide();

	if ($('#chk_min').prop('checked')) {
		$('#nm_min').removeAttr('disabled');
		$('#nm_min').attr('class', 'form-control');
	} else {
		$('#nm_min').attr('disabled', 'disabled');
		$('#nm_min').attr('class', 'form-control disabled');

	} 

	if ($('#chk_max').prop('checked')) {
		$('#nm_max').removeAttr('disabled');
		$('#nm_max').attr('class', 'form-control');
	} else {
		$('#nm_max').attr('disabled', 'disabled');
		$('#nm_max').attr('class', 'form-control disabled');

	} 

	$('#chk_min').click(function(event) {
		if ($('#chk_min').prop('checked')) {
			$('#nm_min').removeAttr('disabled');
			$('#nm_min').attr('class', 'form-control');
		} else {
			$('#nm_min').attr('disabled', 'disabled');
			$('#nm_min').attr('class', 'form-control disabled');

		} 
	});

	$('#chk_max').click(function(event) {
		if ($('#chk_max').prop('checked')) {
			$('#nm_max').removeAttr('disabled');
			$('#nm_max').attr('class', 'form-control');
		} else {
			$('#nm_max').attr('disabled', 'disabled');
			$('#nm_max').attr('class', 'form-control disabled');

		} 
	});
	
	$('#my_form').submit(function(event) {
		event.preventDefault();
		$('#loading').show();
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			data: $(this).serialize()
		})
		.done(function(msg) {
			$('#result').html(msg);
			// console.log("success");
			$('#my_form').hide();
		})
		.fail(function() {
			console.log("error");
			$('#loading').hide();

		})
		.always(function() {
			console.log("complete");
			$('#loading').hide();

		});
			return false;
	});
	
});
</script>