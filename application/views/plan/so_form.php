<!-- Modal -->
<div class="modal fade" id="so-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('', 'id="form-so"'); ?>
      <?php echo form_hidden('sc_id', $sc_id,'id="sc_id"'); ?>
      <?php echo form_hidden('so_id', $sc_id,'id="so_id"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="so-form-title">SO Title</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label ><?php echo lang('sc_persp');?> </label>
          <select class="form-control" name="slc_persp" id="slc_persp_so">
            <option value=""></option>
            <?php 
              foreach ($persp_ls as $persp) {
                echo '<option value="'.$persp->persp_code.'">'.$persp->persp_desc.'</option>';
              }
            ?>
          </select>
          
        </div>
        <div class="row">
          <div class="form-group col-xs-12 col-sm-3">
            <label ><?php echo lang('basic_code');?> </label>
            <input type="text" class="form-control" name="txt_code" id="txt_code_so">
          </div>
          
          <div class="form-group col-xs-12 col-sm-9">
            <label ><?php echo lang('basic_name');?> </label>
            <input type="text" class="form-control" name="txt_name" id="txt_name_so">
          </div>
        </div>
        <div class="form-group">
          <label ><?php echo lang('basic_desc');?> </label>
          <textarea class="form-control" name="txt_desc" id="txt_desc_so"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#form-so').submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      dataType: 'json',
      data: $(this).serialize(),
    })
    .done(function(respond) {
      console.log("success");
      // TODO Close Modal
      
      // TODO Berikan Alert Sukses
    })
    .fail(function() {
      console.log("error");
      // TODO Berikan Alert gagal

    })
    .always(function() {
      so_list();
      $('#so-form').modal('hide');
    });
    
  });
</script>