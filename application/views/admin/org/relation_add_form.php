<?php  
// $this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
?>
<?php 
	// $this->load->view('admin/org/org_header');
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
			      'id' => 'org_id',
			      'type' => 'hidden',
			      'value' => $org_id
			  ),
			  array(/* DROP DOWN */
		        'id' => 'slc_type',
			      'label' => 'Type',
		        'type' => 'dropdown',
		        'options' => array(
		            '' => '',
		            '002A' => lang('om_rel_002A'),
		            '002B' => lang('om_rel_002B'),
		            // '003A' => lang('om_rel_003A'),
		            // '003B' => lang('om_rel_003B'),
		            // '012A' => lang('om_rel_012A'),
		            '012B' => lang('om_rel_012B'),
		        )
		    ),
		    array(
			      'id' => 'txt_obj',
			      'label' => 'Related Object',
			      'value' => html_entity_decode($rel_obj)
			  ),
			  array(
			      'id' => 'dt_begin',
			      'label' => lang('om_rel_begin'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($begin)
			  ),
			  array(
			      'id' => 'dt_end',
			      'label' => lang('om_rel_end'),
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