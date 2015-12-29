<?php $this->load->view('_template/main_top'); ?>
<aside class="right-side">
  <?php $this->load->view('_template/page_head'); ?>
    <style type="text/css">
    .open-kpi{
      cursor: pointer;
    }
    </style>
    <!-- Main content -->
    <section class="content" id="sec-main">
      <?php echo form_hidden('sc_id', $sc_id,'id="sc_id"'); ?>
      
      <!-- top row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header">
              <div class="pull-right box-tools btn-group">
              <?php //echo anchor($send_sc, '<i class="fa fa-send"></i>', ' class="btn pull-right" id="btn-send-sc"');?>
              <button id="btn-send-sc" class="btn btn-default"  title="<?php echo lang('act_send'); ?>"><i class="fa fa-send"></i></button>
              </div>
            </div>
            <div  class="box-body">

              
              <dl class="dl-horizontal">
                
                <dt><?php echo lang('om_org');?></dt>
                <dd><?php echo $org_name ?></dd>

                <dt><?php echo lang('time_period');?></dt>
                <dd><?php echo $period ?></dd>
                
                <dt><?php echo lang('basic_status');?></dt>
                <dd><?php echo $status ?></dd>

                <dt><?php echo lang('sc_weight');?></dt>
                <dd id="sc_weight"> %</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_so" data-toggle="tab" aria-expanded="true"><?php echo lang('sc_so');?></a></li>
              <li class=""><a href="#tab_kpi" data-toggle="tab" aria-expanded="false"><?php echo lang('sc_kpi');?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_kpi">
                <div class="pull-right box-tools btn-group " style="margin-bottom:10px;">
                  <button class="btn add-kpi" data-toggle="modal" data-target="#kpi-form" ><i class="fa fa-plus" ></i></button>
                </div><!-- /. tools -->
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th ><?php echo lang('sc_so');?></th>
                        <th ><?php echo lang('basic_code');?></th>
                        <th ><?php echo lang('basic_name');?></th>
                        <th ><?php echo lang('sc_weight');?></th>
                        <th ><?php echo lang('sc_ytd');?></th>
                        <th ><?php echo lang('sc_formula');?></th>
                       
                        <th width="150"><?php echo lang('basic_action');?></th>
                      </tr>
                    </thead>
                    <tbody id="kpi-list">
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_so">
                
                <div class="pull-right box-tools btn-group " style="margin-bottom:10px;">
                  <button class="btn add-so" data-toggle="modal" data-target="#so-form" ><i class="fa fa-plus" ></i></button>
                </div><!-- /. tools -->
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th ><?php echo lang('sc_persp');?></th>
                        <th ><?php echo lang('basic_code');?></th>
                        <th ><?php echo lang('basic_name');?></th>
                        <th ><?php echo lang('sc_kpi_num');?></th>
                        <th ><?php echo lang('sc_kpi_weight');?></th>
                        <th width="150"><?php echo lang('basic_action');?></th>
                      </tr>
                    </thead>
                    <tbody id="so-list">
                      
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section><!-- /.content -->
  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php $this->load->view('_template/main_bot'); ?>
<?php $this->load->view('plan/so_form'); ?>
<?php $this->load->view('plan/kpi_form'); ?>
<?php $this->load->view('plan/org/kpi_modal'); ?>
<script type="text/javascript">
  so_list();
  
  $('.add-so').click(function(event) {
    $('#so-form-title').html('Add SO');
    var base_url = '<?php echo base_url();?>index.php/';
    $('#form-so').attr('action', base_url+'plan/org/add_so_process');
    $('#slc_persp_so').val('');
    $('#txt_code_so').val('');
    $('#txt_name_so').val('');
    $('#txt_desc_so').val('');
  });

  function so_list () {
    var base_url ='<?php echo base_url(); ?>index.php/';
    var sc_id    = $('#sc_id').val();
    $.ajax({
      url: base_url+'plan/org/so_list',
      type: 'POST',
      data: {
        sc_id: sc_id
      },
    })
    .done(function(respond) {
      $('#so-list').html(respond);
      $('.edit-so').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        $('#so-form-title').html('Edit SO');
        var so_id = $(this).data('so');
        var base_url = '<?php echo base_url();?>index.php/';

        $('#slc_persp_so').val('');
        $('#txt_code_so').val('');
        $('#txt_name_so').val('');
        $('#txt_desc_so').val('');
        $.ajax({
          url: base_url+'plan/org/edit_so',
          type: 'POST',
          dataType: 'json',
          data: {so_id: so_id},
        })
        .done(function(respond) {
          $('#so_id').val(so_id);
          $('#sc_id').val(respond.sc_id);
          $('#slc_persp_so').val(respond.persp);
          $('#txt_code_so').val(respond.code);
          $('#txt_name_so').val(respond.name);
          $('#txt_desc_so').val(respond.desc);
          $('#form-so').attr('action', base_url+respond.process);
        });
      });

      $('.remove-so').click(function(event) {
        var so_id = $(this).data("so");
        var base_url = '<?php echo base_url() ?>index.php/';

        swal({   
          title: "<?php echo lang('confirm_sure'); ?>",   
          text: "<?php echo lang('confirm_delete'); ?>",    
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "<?php echo lang('basic_yes'); ?>",   
          cancelButtonText: "<?php echo lang('basic_no'); ?>",   
          closeOnConfirm: false,   
          closeOnCancel: false 
        }, function(isConfirm){   
          if (isConfirm) {
            $.ajax({
              url: base_url+'plan/org/remove_so',
              type: 'POST',
              data: {so_id: so_id},
            })
            .done(function() {
              so_list();
              kpi_list();
              sc_weight();

              swal({
                title: "Deleted!",
                text: "<?php echo lang('notif_delete_ok'); ?>",
                type: "success"
              }, function (){
                // location.reload();
              });
            });
                        
          } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
          } 
        });
      
      });
    });
    
  };
</script>
<script type="text/javascript">
  kpi_list();
  $('.add-kpi').click(function(event) {
    $('#kpi-form-title').html('Add KPI');
    var base_url = '<?php echo base_url();?>index.php/';
    $('#form-kpi').attr('action', base_url+'plan/org/add_kpi_process');
    $('#slc_so_kpi').empty();
    $('#slc_persp_kpi').val('');
    $('#slc_so_kpi').val('');
    $('#txt_code_kpi').val('');
    $('#txt_name_kpi').val('');
    $('#txt_desc_kpi').val('');
    $('#nm_weight').val('');
    $('#slc_ytd').val('');
    $('#slc_formula').val('');
    $('#slc_measure').val('');
    $('.chk_target_m').iCheck('uncheck');
    $('.nm_target_m').val('');

    $('#slc_target_slc').val('');
    $('#slc_target_type').val('');
    $('.nm_target_base').val('');
    $('.nm_target_step').val('');

    
  });
  function kpi_list () {
    var base_url ='<?php echo base_url(); ?>index.php/';
    var sc_id    = $('#sc_id').val();
    $.ajax({
      url: base_url+'plan/org/kpi_list',
      type: 'POST',
      dataType: 'html',
      data: {sc_id: sc_id},
    })
    .done(function(respond) {
      $('#kpi-list').html(respond);

      $('.edit-kpi').click(function(event) {
        var kpi_id = $(this).data('kpi');
        $('#kpi-form-title').html('Edit KPI');
        var base_url = '<?php echo base_url();?>index.php/';
        $.ajax({
          url: base_url+'plan/org/edit_kpi',
          type: 'POST',
          dataType: 'json',
          data: {kpi_id: kpi_id},
        })
        .done(function(respond) {
          
          $('#form-kpi').attr('action', base_url+respond.process);
          
          $('#slc_so_kpi').empty();
          $('#slc_persp_kpi').val('');
          $('#slc_so_kpi').val('');
          $('#txt_code_kpi').val('');
          $('#txt_name_kpi').val('');
          $('#txt_desc_kpi').val('');
          $('#nm_weight').val('');
          $('#slc_ytd').val('');
          $('#slc_formula').val('');
          $('#slc_measure').val('');
          $('#slc_target_slc').val('');
          $('#slc_target_type').val('');
          $('.nm_target_base').val('');
          $('.nm_target_step').val('');
          $('.nm_target_m').val('');
          $('.chk_target_m').iCheck('uncheck');


          $.each(respond.so_opt, function(index, val) {
             /* iterate through array or object */
            $('#slc_so_kpi').append('<option value="'+val.value+'">'+val.text+'</option>');
          });
          $('#kpi_id').val(respond.kpi_id);
          $('#sc_id').val(respond.sc_id);
          $('#slc_persp_kpi').val(respond.persp);
          $('#slc_so_kpi').val(respond.so_id);
          $('#txt_code_kpi').val(respond.code);
          $('#txt_name_kpi').val(respond.name);
          $('#txt_desc_kpi').val(respond.desc);
          $('#nm_weight').val(respond.weight);
          $('#slc_ytd').val(respond.ytd);
          $('#slc_formula').val(respond.formula);
          $('#slc_measure').val(respond.measure);

          $.each(respond.target, function(month, val) {
             /* iterate through array or object */
            if (val.chk == true) {
              $('#chk_target_'+month).iCheck('check');

            } else {
              $('#chk_target_'+month).iCheck('uncheck');

            };
            $('#nm_target_'+month).val(val.value);
          });

        });
      }); // End of $('.edit-kpi').click()

      $('.remove-kpi').click(function(event) {
        var kpi_id = $(this).data("kpi");
        var base_url = '<?php echo base_url() ?>index.php/';
        swal({   
          title: "<?php echo lang('confirm_sure'); ?>",   
          text: "<?php echo lang('confirm_delete'); ?>",    
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "<?php echo lang('basic_yes'); ?>",   
          cancelButtonText: "<?php echo lang('basic_no'); ?>",   
          closeOnConfirm: false,   
          closeOnCancel: false 
        }, function(isConfirm){   
          if (isConfirm) {
            $.ajax({
              url: base_url+'plan/org/remove_kpi',
              type: 'POST',
              data: {kpi_id: kpi_id},
            })
            .done(function() {
              kpi_list();
              so_list();
              sc_weight();
              swal({
                title: "Deleted!",
                text: "<?php echo lang('notif_delete_ok'); ?>",
                type: "success"
              }, function (){
                // location.reload();
              });
            });
                        
          } else {     
              swal("Cancelled", "Your imaginary file is safe :)", "error");   
          }
        });
      }); // End of $('.remove-kpi').click()
    
      $('.detail-kpi').click(function(event) {
        /* Act on the event */
        var kpi_id = $(this).data('kpi');
        var base_url ='<?php echo base_url(); ?>index.php/';

        $.ajax({
          url: base_url+'plan/org/kpi_detail',
          type: 'POST',
          dataType: 'json',
          data: {kpi_id: kpi_id},
        })
        .done(function(respond) {
          $('#kpi-persp').html(respond.persp);
          $('#kpi-so').html(respond.so);
          $('#kpi-kpi').html(respond.kpi);
          $('#kpi-modal-title').html(respond.kpi);
          $('#kpi-weight').html(respond.weight);
          $('#kpi-desc').html(respond.desc);
          $('#kpi-measure').html(respond.measure);
          $('#kpi-formula').html(respond.formula);
          $('#kpi-ytd').html(respond.ytd);
         
          $.each(respond.target, function(month, val) {
            $('#target_'+month).html(val);
          });
          // console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
      });// End of $('.detail-kpi').click()

      
    
  });
}
</script>
<script type="text/javascript">
  sc_weight();
  function sc_weight () {
    var base_url ='<?php echo base_url(); ?>index.php/';
    var sc_id    = $('#sc_id').val();
    $.ajax({
      url: base_url+'plan/org/sc_weight',
      type: 'POST',
      dataType: 'json',
      data: {sc_id: sc_id},
    })
    .done(function(respond) {
      $('#sc_weight').html(respond.weight+ ' %');
      if (respond.weight == 100) {
        $('#btn-send-sc').attr('class', 'btn pull-right');

      }else {
        $('#btn-send-sc').attr('class', 'btn pull-right disabled');

      };
    });
    
  }
</script>
<script type="text/javascript">
  $('#btn-send-sc').click(function(event) {
      var sc_id = $('#sc_id').val();
      var base_url = '<?php echo base_url() ?>index.php/';
      swal({   
        title: "Confirm",   
        text: "Are you sure to Send this Score Card?",    
        type: "warning",   
        showCancelButton: true,   
        // confirmButtonColor: "#DD6B55",   
        confirmButtonText: "<?php echo lang('basic_yes'); ?>",   
        cancelButtonText: "<?php echo lang('basic_no'); ?>",   
        closeOnConfirm: false,   
        closeOnCancel: false 
      }, function(isConfirm){   
        if (isConfirm) {
          $.ajax({
            url: base_url+'plan/org/send_sc',
            type: 'POST',
            data: {sc_id: sc_id},
          })
          .done(function() {
            swal({
              title: "Sended!",
              text: "Score Card has been Send",
              type: "success"
            }, function (){
              location.reload();
            });
          });
                      
        } else {     
            swal("Cancelled", "", "error");   
        }
    });
  });
</script>
