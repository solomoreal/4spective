<?php  
$this->load->view('_template/basic_top');
echo '<h2>'.lang('om_org').'</h2>';
echo $this->form_builder->open_form(array('action' => ''));
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
			      'id' => 'dt_start',
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