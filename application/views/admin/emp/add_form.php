<?php
echo $this->form_builder->open_form(array('action' => $process, 'id' => 'my_form'));
echo $this->form_builder->build_form_horizontal(
      array(
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
			      'id' => 'txt_email',
			      'label' => lang('basic_email'),
			      'placeholder' => 'jhon@somewhere.com',
			      'value' => html_entity_decode($email)
			  ),
			  array(
			      'id' => 'txt_phone',
			      'label' => lang('basic_phone'),
			      'placeholder' => '+62810555123',
			      'value' => html_entity_decode($phone)
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

?>