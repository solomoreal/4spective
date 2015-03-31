<?php  
$this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
?>

<?php
	$this->load->view($header_view);
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
		        'id' => 'slc_mode',
			      'label' => 'Mode',
		        'type' => 'dropdown',
		        'options' => array(
		            '' => '',
		            'delimit' => lang('act_delimit'),
		            'remove' => lang('act_remove')
		        )
		    ),
			  array(
			      'id' => 'dt_end',
				    'label' => lang('time_end'),
			      'class' => 'datepicker',
			      'placeholder' => 'yyyy-mm-dd',
			      'value' => html_entity_decode($end),
			  ),
			  array(
			      'id' => 'submit',
			      'type' => 'submit',
			      'label' => lang('act_delete'),
			      'class' => 'btn btn-danger'
			  )
      )
    );

echo $this->form_builder->close_form();

$this->load->view('_template/basic_bot');

?>
<script>
jQuery(document).ready(function($) {
	$('#loading').hide();
	$('#dt_end').attr('disabled', 'disabled');
	$('#slc_mode').change(function(event) {
		if ($(this).val()=='delimit') {
			$('#dt_end').removeAttr('disabled');
		} else {
			$('#dt_end').attr('disabled', 'disabled');
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