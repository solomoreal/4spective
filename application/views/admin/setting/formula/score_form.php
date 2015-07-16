<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('menu_period').'</h2>';
?>
<i class="fa fa-spinner fa-pulse fa-5x" id="loading"></i>
<div class="row">
	<div class="col-sm-12" id="result"></div>

</div>
<?php
echo form_open($process, 'id="my_form" class="form-horizontal col-sm-12"', $hidden);
?>
	<div class="form-group">
		<label for="txt_short" class="col-sm-2 control-label"><?php echo lang('number_score'); ?></label>
		<div class="col-sm-2">
			<?php echo form_dropdown('slc_score', $score_opt, $score,'class="form-control"'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="nm_lower" class="col-sm-2 control-label"><?php echo lang('number_lower'); ?></label>
		<div class="col-sm-3">
			<?php echo form_number('nm_lower', $lower, 'class="form-control" step="0.01"');?>
		</div>
	</div>


	<div class="form-group">
		<label for="nm_lower" class="col-sm-2 control-label"><?php echo lang('number_uppper'); ?></label>
		<div class="col-sm-3">
			<?php echo form_number('nm_upper', $upper, 'class="form-control" step="0.01"');?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-9 col-sm-offset-2">
			<?php echo form_submit('btn_submit', lang('act_save'),'class="btn btn-primary');?>
		</div>
	</div>
<?php

$this->load->view('_template/basic_bot');

?>
<script>
jQuery(document).ready(function($) {
	$('#loading').hide();
	
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