<?php $this->load->view('_template/main_top'); ?>
  <aside class="right-side">
  <?php $this->load->view('_template/page_head'); ?>
  <!-- Main content -->
    <section class="content" id="sec-main">
      <?php echo form_hidden('hdn_emp', $emp_code); ?>
      <?php echo form_hidden('hdn_date', $date); ?>
      <!-- top row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header">
            <h3 class="box-title" id="post-title"></h3>

            </div>
            <div id="last-attr" class="box-body">
              
              <div class="row">
                <div class="col-sm-12">
                  <dl class="dl-horizontal">

                    <dt><?php echo lang('pa_join_date'); ?></dt>
                    <dd class="emp-join"></dd>

                    <dt><?php echo lang('pa_emp_code'); ?></dt>
                    <dd class="emp-code"></dd>
                    <dt><?php echo lang('pa_name'); ?></dt>
                    <dd class="emp-name"></dd>
                    
                  </dl>

                </div>
              </div>

            </div>
          </div>

        </div><!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            
            <div  class="box-body">
            <?php echo form_open($process, '', $hidden);?>

            <div class="row">
              <div class="form-group col-xs-12 col-sm-6">
                <label ><?php echo lang('time_begin');?></label>
                <?php echo form_input('dt_begin', $begin, 'class="form-control datepicker" id="dt_begin"');?>
              </div>

              <div class="form-group col-xs-12 col-sm-6">
                <label ><?php echo lang('time_end');?></label>
                <?php echo form_input('dt_end', $end, 'class="form-control datepicker" id="dt_end"');?>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-xs-12 col-sm-3">
                <label ><?php echo lang('om_org_code');?></label>
                <div class="input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-default" data-toggle="modal" data-target="#modal-org-dir" type="button" id="btn-search"><i class="fa fa-search"></i></button>
                  </span>
                  <?php echo form_input('org_code', $org_code, 'class="form-control"');?>
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-9">
                <label ><?php echo lang('om_org_name');?></label>
                <?php echo form_input('org_name', $org_name, 'class="form-control disabled" readonly disabled="disabled"');?>
              </div>
              
            </div>

            <div class="row">
              <div class="form-group col-xs-12 ">
                <label ><?php echo lang('om_post');?></label>
                <?php echo form_dropdown('slc_post', array(), '','class="form-control"');?>
              </div>
              
            </div>
            <?php echo anchor('admin/employee', lang('act_cancel'), 'class="btn btn-default"'); ?>
            <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>

            

            <?php echo form_close();?>
            </div>
          </div>

        </div><!-- /.col -->
      </div>
    </section><!-- /.content -->
  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<div class="modal fade" id="modal-org-dir">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo lang('om_org'); ?></h4>
      </div>
      <div class="modal-body">

        
        <button class="btn btn-lg btn-default btn-block" id="btn-back"><i class="fa fa-home"></i> Home</button>
        <input type="hidden" name="hdn-org-search" id="hdn-org-search" value="<?php echo isset($org_id)? $org_id:'1'; ?> ">
        <table class="table " style="-webkit-touch-callout: none;-webkit-user-select: none; -khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;">
          <thead>
            <tr>
              <th><?php echo lang('basic_code'); ?></th>
              <th><?php echo lang('basic_name'); ?></th>
            </tr>
          </thead>
          <tbody id="org-list" style="cursor:pointer">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close');?></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-select"><?php echo lang('act_select');?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view('_template/main_bot'); ?>

<script>
jQuery(document).ready(function($) {
  refresh();

  function refresh () {
    var base_url   = '<?php echo base_url()."index.php"?>';
    var date_range = $('#hdn_date').val();
    var emp_code   = $('#hdn_emp').val();
    
    
    $.ajax({
      url: base_url+'/admin/employee/fetch_attr',
      type: 'POST',
      dataType: 'json',

      data: {
        emp_code: emp_code,
        date_range: date_range
      },
    })
    .done(function(respond) {
      $('.emp-join').html(respond.emp_begin);

      $('.emp-code').html(respond.emp_code);
      $('.emp-name').html(respond.fullname);
     
      
    });
    
  }
});
</script>
<script type="text/javascript">
  $('#btn-search').click(function(event) {
    /* Act on the event */
    $('#modal-org-dir').show();
  });
</script>

<script type="text/javascript">


    function refresh_org_list () {
      var base_url = '<?php echo base_url()."index.php"?>';
      var org_id   = $('#hdn-org-search').val();
      var begin    = $('#dt_begin').val();
      var end      = $('#dt_end').val();

      // DO Fetch Position and Organization under Parent Organization
      $.ajax({
        url: base_url+'/admin/org/get_child',
        type: 'POST',
        data: {
          org_id: org_id,
          begin: begin,
          end: end,
        },
      })
      .done(function(respond) {
        $('#org-list').html(respond);
      })
      .fail(function() {

      })
      .always(function() {
        $('.opt-org').click(function(event) {
          /* Act on the event */

          $('.opt-org').attr('class', 'opt-org');

          $(this).attr('class', 'opt-org selected');
        });

        $('#btn-back').click(function(event) {
          /* Act on the event */
          $('#hdn-org-search').val($(this).data('parent-id')); 
          $('#btn-back').html('<i class="fa fa-home"></i> Home');
          $('#btn-back').data('parent-id',1);

          $('.opt-org').attr('class', 'opt-org');
          refresh_org_list();
        });


        $('.opt-org').dblclick(function(event) {
          /* Act on the event */
          $('.opt-org').attr('style', '');
          var child_id = $(this).data('org-id');
          var name = $(this).closest('tr').children('td.org_name').html();
          $('#btn-back').html('<i class="fa fa-arrow-left"></i> '+name);
          $('#btn-back').data('parent-id',org_id);
          $('#hdn-org-search').val(child_id); 
          refresh_org_list();
        });
        
      });
      
    }


    $('#spinner-post').hide();
    
    refresh_org_list();

</script>