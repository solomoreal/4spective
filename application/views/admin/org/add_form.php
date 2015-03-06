<?php  
$this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
?>

<div class="row">
	<div class="col-sm-12">
		<dl class="dl-horizontal">
			<dt>ID</dt>
		  <dd><?php echo $parent->org_id; ?></dd>
		  <dt><?php echo lang('om_org_code'); ?></dt>
		  <dd><?php echo $parent->org_code; ?></dd>
		  <dt><?php echo lang('om_org_name'); ?></dt>
		  <dd><?php echo $parent->org_name; ?></dd>
		  <dt>Begin</dt>
		  <dd><?php echo $parent->org_begin; ?></dd>
		  <dt>End</dt>
		  <dd><?php echo $parent->org_end; ?></dd>
		</dl>
	</div>

</div>
<i class="fa fa-spinner fa-pulse fa-5x" id="loading"></i>
<div class="row">
	<div class="col-sm-12" id="result"></div>

</div>
<?php
echo $this->form_builder->open_form(array('action' => $process, 'id' => 'my_form'));
echo $this->form_builder->build_form_horizontal(
      array(
			  array(
			      'id' => 'parent_id',
			      'type' => 'hidden',
			      'value' => $parent_id
			  ),
			  array(
			      'id' => 'txt_code',
			      'label' => lang('om_org_code'),
			      'placeholder' => lang('om_org_code'),
			      'value' => html_entity_decode($org_code)
			  ),
			  array(
			      'id' => 'txt_name',
			      'label' => lang('om_org_name'),
			      'placeholder' => lang('om_org_name'),
			      'value' => html_entity_decode($org_name)
			  ),
			  array(
			      'id' => 'dt_begin',
			      'label' => 'Begin Date',
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($org_begin)
			  ),
			  array(
			      'id' => 'dt_end',
			      'label' => 'End Date',
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($org_end)
			  ),
			  array(
			      'id' => 'submit',
			      'type' => 'submit'
			  )
      )
    );

echo $this->form_builder->close_form();
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