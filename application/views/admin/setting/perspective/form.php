<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('menu_perspective').'</h2>';
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
			      'id' => 'hdn_code',
			      'type' => 'hidden',
			      'value' => $code
			  ),
			  array(
			      'id' => 'txt_code',
			      'label' => lang('basic_code'),
			      'placeholder' => lang('basic_code'),
			      'value' => html_entity_decode($code)
			  ),
			  array(
			      'id' => 'txt_name',
			      'label' => lang('basic_name'),
			      'placeholder' => lang('basic_name'),
			      'value' => html_entity_decode($name)
			  ),
			  array(
			      'id' => 'submit',
			      'label' => lang('act_save'),
			      'type' => 'submit'
			  )
      )
    );

echo $this->form_builder->close_form();
// $this->load->view('_template/basic_bot');

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