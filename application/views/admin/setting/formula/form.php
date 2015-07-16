<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('menu_period').'</h2>';
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
			      'id' => 'hdn_id',
			      'type' => 'hidden',
			      'value' => $id
			  ),
			  array(
			      'id' => 'txt_name',
			      'label' => lang('basic_name'),
			      'placeholder' => lang('basic_name'),
			      'value' => html_entity_decode($name)
			  ),
			  array(/* DROP DOWN */
		        'id' => 'slc_type',
			      'label' => lang('basic_type'),
		        'type' => 'dropdown',
		        'options' => array(
							0 => lang('basic_none'),
							1 => lang('number_maxi'),
							2 => lang('number_mini'),
							3 => lang('number_stab')),
		        'value' => $type
		    ),
			  array(
			      'id' => 'txt_desc',
			      'label' => lang('basic_desc'),
			      'type' => 'textarea',
			      'placeholder' => lang('basic_desc'),
			      'value' => html_entity_decode($desc)
			  ),
			  array(
			      'id' => 'dt_begin',
			      'label' => lang('time_begin'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($begin)
			  ),
			  array(
			      'id' => 'dt_end',
			      'label' => lang('time_end'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($end)
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