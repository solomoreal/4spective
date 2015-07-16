<?php $this->load->view('_template/main_top'); ?>

  <aside class="right-side">
  <?php $this->load->view('_template/page_head'); ?>
    <!-- Main content -->
    <section class="content" id="sec-main">
      <!-- top row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
          <?php
          echo $this->form_builder->open_form(array('action' => $process, 'id' => 'my_form'));
          echo $this->form_builder->build_form_horizontal(
              array(
              
              array(
                'id' => 'emp_id',
                'type' => 'hidden',
                'value' => $emp_id
              ),
              array(
                'id' => 'txt_name_first',
                'label' => lang('pa_name_first'),
                'placeholder' => lang('pa_name_first'),
                'value' => html_entity_decode($name_first)
              ),
              array(
                'id' => 'txt_name_middle',
                'label' => lang('pa_name_middle'),
                'placeholder' => lang('pa_name_middle'),
                'value' => html_entity_decode($name_middle)
              ),
              array(
                'id' => 'txt_name_last',
                'label' => lang('pa_name_last'),
                'placeholder' => lang('pa_name_last'),
                'value' => html_entity_decode($name_last)
              ),
              array(
                'id' => 'txt_name_nick',
                'label' => lang('pa_name_nick'),
                'placeholder' => lang('pa_name_nick'),
                'value' => html_entity_decode($name_nick)
              ),

              array(/* DROP DOWN */
                'id' => 'slc_gender',
                'label' => lang('pa_gender'),
                'type' => 'dropdown',
                'options' => array(
                  '' => '',
                  'M' => lang('pa_gender_m'),
                  'F' => lang('pa_gender_f')
                )
              ),
              array(
                'id' => 'dt_dob',
                'label' => lang('pa_dob'),
                'class' => 'datepicker',
                'placeholder' => 'yyyy-mm-dd',
                'value' => html_entity_decode($dob)
              ),
              array(
                'id' => 'txt_pob',
                'label' => lang('pa_pob'),
                'placeholder' => lang('pa_pob'),
                'value' => html_entity_decode($pob)
              ),
              array(/* DROP DOWN */
                'id' => 'slc_status',
                'label' => lang('basic_status'),
                'type' => 'dropdown',
                'options' => $opt_status,
                'value' => $status
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
                'type' => 'submit',
                'label' => lang('act_save')
              )
              )
            );

          echo $this->form_builder->close_form();
          ?>

          </div>
        </div><!-- /.col -->
      </div>
      <!-- /.row -->
    </section><!-- /.content -->
  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<?php 
  $this->load->view('_template/main_bot'); 
?>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.daterange').daterangepicker({
      format: 'YYYY/MM/DD',
    });
  });
</script>

<script type="text/javascript">
  jQuery(document).ready(function($) {


  });
</script>
