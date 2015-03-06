<?php  
$this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
?>

<div class="row">
	<div class="col-sm-12">
		<dl class="dl-horizontal">
			<dt>ID</dt>
		  <dd><?php echo $org->org_id; ?></dd>
		  <dt><?php echo lang('om_org_code'); ?></dt>
		  <dd><?php echo $org->org_code; ?></dd>
		  <dt><?php echo lang('om_org_name'); ?></dt>
		  <dd><?php echo $org->org_name; ?></dd>
		  <dt>Begin</dt>
		  <dd><?php echo $org->org_begin; ?></dd>
		  <dt>End</dt>
		  <dd><?php echo $org->org_end; ?></dd>
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
 			      'label' => 'End Date',
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