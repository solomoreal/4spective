<?php $this->load->view('_template/main_top'); ?>
<aside class="right-side">
  <?php 
  $this->load->view('_template/page_head');
  echo form_hidden('sc_id', $sc_id,'id="sc_id"'); 
  ?>
    <style type="text/css">
    .open-kpi{
      cursor: pointer;
    }
    </style>
    <!-- Main content -->
    <section class="content" id="sec-main">
      <!-- top row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header">
              <div class="pull-right box-tools btn-group">
              <button id="btn-reject" class="btn btn-danger"  title="<?php echo lang('act_reject'); ?>"><i class="fa fa-thumbs-down"></i></button>
              <button id="btn-approve" class="btn btn-success"  title="<?php echo lang('act_approve'); ?>"><i class="fa fa-thumbs-up"></i></button>
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
              <li class=""><a href="#tab_so" data-toggle="tab" aria-expanded="true"><?php echo lang('sc_so');?></a></li>
              <li class="active"><a href="#tab_kpi" data-toggle="tab" aria-expanded="false"><?php echo lang('sc_kpi');?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_kpi">
                
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
              <div class="tab-pane" id="tab_so">
                
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
<?php $this->load->view('plan/org/kpi_modal'); ?>

<script type="text/javascript">
  so_list();

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
    });
    
  };
</script>
<script type="text/javascript">
  kpi_list();
  
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
  $('#btn-approve').click(function(event) {
      var sc_id = $('#sc_id').val();
      var base_url = '<?php echo base_url() ?>index.php/';
      swal({   
        title: "Confirm",   
        text: "Are you sure to Approve this Score Card?",    
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
            url: base_url+'plan/org/approve_sc',
            type: 'POST',
            data: {sc_id: sc_id},
          })
          .done(function() {
            swal({
              title: "Approved!",
              text: "Score Card has been Approved",
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

  $('#btn-reject').click(function(event) {
      var sc_id = $('#sc_id').val();
      var base_url = '<?php echo base_url() ?>index.php/';
      swal({   
        title: "Confirm",   
        text: "Are you sure to Reject this Score Card?",    
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
            url: base_url+'plan/org/reject_sc',
            type: 'POST',
            data: {sc_id: sc_id},
          })
          .done(function() {
            swal({
              title: "Rejected!",
              text: "Score Card has been Rejected",
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