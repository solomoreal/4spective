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
                <label ><?php echo lang('om_post');?></label>
                <div class="input-group">
                  <?php echo form_input('post_id', $post_id, 'class="form-control"');?>
                  <span class="input-group-btn">
                    <button class="btn btn-default" data-toggle="modal" data-target="#modal-org-dir" type="button" id="btn-search"><i class="fa fa-ellipsis-h"></i></button>
                  </span>
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-9">
                <label ><?php echo lang('om_post_name');?></label>
                <?php echo form_input('post_name', $post_name, 'class="form-control disabled" readonly disabled="disabled"');?>
              </div>

              <div class="form-group col-xs-12 col-sm-3">
                <label ><?php echo lang('basic_value');?></label>
                <?php echo form_number('nm_value', $value, 'class="form-control " id="nm_value"');?>
              </div>
              
            </div>

            <?php echo anchor('admin/employee/detail/'.$emp_code, lang('act_cancel'), 'class="btn btn-default"'); ?>
            <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>

            

            <?php echo form_close();?>
            </div>
          </div>

        </div><!-- /.col -->
      </div>
    </section><!-- /.content -->
  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade noselect" id="modal-org-dir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('act_search') . ' '. lang('pa_post'); ?></h4>
      </div>
      <div class="modal-body">
        <div id="box-bc" >
          
        </div>
        <input type="hidden" name="hdn-org-search" id="hdn-org-search" value="<?php echo isset($org_id)? $org_id:'1'; ?> ">
      
          <div id="org-list">
            
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close');?></button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('_template/main_bot'); ?>

<script>
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
</script>
<script type="text/javascript">

  $('#spinner-post').hide();

  function refresh_org_list () {
    var base_url = '<?php echo base_url()."index.php"?>';
    var org_id = $('#hdn-org-search').val();
    var begda = $('#dt_begin').val();
    var endda = $('#dt_end').val();
    
    // // DO Fetch Breadcrumb of Organization
    $.ajax({
      url: base_url+'/admin/employee/dir_path',
      type: 'POST',
      data: {
        org_id: org_id,
        begin: begda,
        end:endda
      },
    })
    .done(function(html) {
      $('#box-bc').html(html)
      $('.link-org').click(function(event) {
        $('#org-list').hide();

        /* Act on the event */
        var org = $(this).data('org');
        $('#hdn-org-search').val(org);
        refresh_org_list();
      });
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      $('.link-org').click(function() {
        var org_to = $(this).data('org');
        $('#hdn-org-search').val(org_to);
        refresh_org_list();
      });
    });

    // DO Fetch Position and Organization under Parent Organization
    $.ajax({
      url: base_url+'/admin/employee/dir_ls',
      type: 'POST',
      data: {
        parent: org_id,
        begin: begda,
        end:endda
      },
    })
    .done(function(html) {
      
      $('#org-list').html(html);
      $('#org-list').show();
      $('.btn-in').click(function(event) {
        /* Act on the event */
        org_row = $(this).parents('tr');

        var org = org_row.data('org');

        $('#hdn-org-search').val(org);
        refresh_org_list();
      });

      $('.org-row').dblclick(function(event) {
        /* Act on the event */
        var org = $(this).data('org');
        $('#hdn-org-search').val(org);
        refresh_org_list();
      });

      $('.post-row').dblclick(function(event) {
        var post_id = $(this).data('post');

        var post_name = $(this).children('td.post_name').html();
        // TODO Pindahkan nilai ke textbox post dan tutup modal
        $('#post_id').val(post_id);
        $('#post_name').val(post_name);
        $('#modal-org-dir').modal('hide')
      });

      $('.btn-select').click(function(event) {
        var post_id = $(this).data('post');

        var post_name = $(this).parent().parent().children('td.post_name').html();
        // TODO Pindahkan nilai ke textbox post dan tutup modal
        $('#post_id').val(post_id);
        $('#post_name').val(post_name);
        $('#modal-org-dir').modal('hide')
      });
    })
    .fail(function() {
      console.log("error list");
    })
    .always(function() {
      $('.btn-org-in').click(function() {
        $('#org-list').hide();

        var org_to = $(this).data('org');
        $('#hdn-org-search').val(org_to);
        refresh_org_list();
      });
      
    });
    
  }
  refresh_org_list();

  $('#dt_begin').change(function(event) {
    /* Act on the event */
    refresh_org_list();
  });

  $('#dt_end').change(function(event) {
    /* Act on the event */
    refresh_org_list();
  });
</script>