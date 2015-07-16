<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
?>
<?php 
	$this->load->view('admin/org/parent_header');
?>
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
			      'label' => lang('om_org_begin'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($org_begin)
			  ),
			  array(
			      'id' => 'dt_end',
			      'label' => lang('om_org_end'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($org_end)
			  ),
			  array(
			      'id' => 'submit',
			      'label' => lang('act_save'),
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