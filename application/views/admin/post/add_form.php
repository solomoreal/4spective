<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('om_post').'</h2>';
?>
<?php 
	$this->load->view($header);
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
			      'label' => lang('om_post_code'),
			      'placeholder' => lang('om_post_code'),
			      'value' => html_entity_decode($post_code)
			  ),
			  array(
			      'id' => 'txt_name',
			      'label' => lang('om_post_name'),
			      'placeholder' => lang('om_post_name'),
			      'value' => html_entity_decode($post_name)
			  ),
			  array(/* DROP DOWN */
		        'id' => 'slc_chief',
			      'label' => lang('om_chief_post'),
		        'type' => 'dropdown',
		        'options' => array(
		            0 => 'none',
		            1 => lang('om_chief')
		        )
		    ),
			  array(
			      'id' => 'dt_begin',
			      'label' => lang('om_post_begin'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($post_begin)
			  ),
			  array(
			      'id' => 'dt_end',
			      'label' => lang('om_post_end'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($post_end)
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