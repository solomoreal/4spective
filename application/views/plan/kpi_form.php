<!-- Modal -->
<div class="modal fade" id="kpi-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('', 'id="form-kpi"'); ?>

      <?php echo form_hidden('kpi_id', '','id="kpi_id"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="kpi-form-title">KPI Title</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label ><?php echo lang('sc_persp');?> </label>
          <select class="form-control" name="slc_persp" id="slc_persp_kpi">
            <option value=""></option>
            <?php 
              foreach ($persp_ls as $persp) {
                echo '<option value="'.$persp->persp_code.'">'.$persp->persp_desc.'</option>';
              }
            ?>
          </select>
          
        </div>
        <div class="form-group">
          <label ><?php echo lang('sc_so');?> </label>
          <select class="form-control" name="slc_so" id="slc_so_kpi">
            <option value=""></option>
          </select>
          
        </div>
        <div class="row">
          <div class="form-group col-xs-12 col-sm-3">
            <label ><?php echo lang('basic_code');?> </label>
            <input type="text" class="form-control" name="txt_code" id="txt_code_kpi">
          </div>
          
          <div class="form-group col-xs-12 col-sm-9">
            <label ><?php echo lang('basic_name');?> </label>
            <input type="text" class="form-control" name="txt_name" id="txt_name_kpi">
          </div>
          
        </div>

        <div class="form-group">
          <label ><?php echo lang('basic_desc');?> </label>
          <textarea class="form-control" name="txt_desc" id="txt_desc_kpi"></textarea>
        </div>
        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_weight');?> </label>
            <div class="input-group">
              <input type="number" class="form-control" value="0" min="0" max="100" step="0.01" name="nm_weight" id="nm_weight">
              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
            </div>
          </div>
          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_ytd');?> </label>
            <select class="form-control" name="slc_ytd" id="slc_ytd">
              <option value=""></option>
              <?php 
                foreach ($ytd_ls as $row) {
                  echo '<option value="'.$row->ytd_code.'">'.$row->ytd_name.'</option>';
                }
              ?>

            </select>
            
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_formula');?> </label>
            <select class="form-control" name="slc_formula" id="slc_formula">
              <option value=""></option>
              <?php 
                foreach ($formula_ls as $row) {
                  echo '<option value="'.$row->formula_id.'">'.$row->formula_name.'</option>';
                }
              ?>

            </select>
            
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_measure');?> </label>
            <select class="form-control" name="slc_measure" id="slc_measure">
              <option value=""></option>
              <?php 
                foreach ($measure_ls as $row) {
                  echo '<option value="'.$row->measure_id.'">'.$row->short_name .' '.$row->long_name.'</option>';
                }
              ?>

            </select>
            
          </div>
        
          
        </div>
        <h4>Target</h4>
        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_target_type');?> </label>
            <select class="form-control" name="slc_target_type" id="slc_target_type">
              <option value=""></option>
              <option value="F">Flat</option>
              <option value="P">Progresive</option>
            </select>
          </div>
          <div class="form-group col-xs-6 col-sm-3">
            <label ><?php echo lang('sc_target_slc');?> </label>
            <select class="form-control" name="slc_target_slc" id="slc_target_slc">
              <option value=""></option>
              <option value="M"><?php echo lang('sc_target_m');?></option>
              <option value="O"><?php echo lang('sc_target_o');?></option>
              <option value="E"><?php echo lang('sc_target_e');?></option>
              <option value="Q"><?php echo lang('sc_target_q');?></option>
              <option value="T"><?php echo lang('sc_target_t');?></option>
              <option value="S"><?php echo lang('sc_target_s');?></option>
            </select>
          </div>
          
          <div class="form-group col-xs-6 col-sm-3" id="target-base">
            <label ><?php echo lang('sc_target_base');?> </label>
            <input type="number" class="form-control" value="0" name="nm_target_base" id="nm_target_base" step="0.01">
          </div>

          <div class="form-group col-xs-6 col-sm-3" id="target-step">
            <label ><?php echo lang('sc_target_step');?> </label>
            <input type="number" class="form-control" value="0" name="nm_target_step" id="nm_target_step" step="0.01">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label >Jan </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '1', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_1"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_1" id="nm_target_1" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Feb </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '2', FALSE, 'class="chk_target_m chk_target_e " id="chk_target_2"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e" name="nm_target_2" id="nm_target_2" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Mar </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '3', FALSE, 'class="chk_target_m chk_target_o chk_target_q" id="chk_target_3"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o nm_target_q" name="nm_target_3" id="nm_target_3" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Apr </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '4', FALSE, 'class="chk_target_m chk_target_e chk_target_t" id="chk_target_4"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_t" name="nm_target_4" id="nm_target_4" step="0.01"></div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label >May </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '5', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_5"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_5" id="nm_target_5" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Jun </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '6', FALSE, 'class="chk_target_m chk_target_e chk_target_q chk_target_s" id="chk_target_6"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_q nm_target_s" name="nm_target_6" id="nm_target_6" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Jul </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '7', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_7"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_7" id="nm_target_7" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Agu </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '8', FALSE, 'class="chk_target_m chk_target_e chk_target_t" id="chk_target_8"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_t" name="nm_target_8" id="nm_target_8" step="0.01"></div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label >Sep </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '9', FALSE, 'class="chk_target_m chk_target_o chk_target_q" id="chk_target_9"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o nm_target_q" name="nm_target_9" id="nm_target_9" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Oct </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '10', FALSE, 'class="chk_target_m chk_target_e" id="chk_target_10"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e" name="nm_target_10" id="nm_target_10" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Nov </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '11', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_11"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_11" id="nm_target_11" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Dec </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target[]', '12', FALSE, 'class="chk_target_m chk_target_e chk_target_q chk_target_t chk_target_s" id="chk_target_12"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_q nm_target_t nm_target_s" name="nm_target_12" id="nm_target_12" step="0.01"></div>
            </div>
          </div>

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
  $('#target-base').hide();
  $('#target-step').hide();

  $('#slc_target_type').change(function(event) {
    /* Act on the event */
    $('#target-base').hide();
    $('#target-step').hide();
    $('.nm_target_m').val();
    if ($(this).val() == 'F') {
      $('#target-base').show();

    } else if ($(this).val() == 'P') {
      $('#target-base').show();
      $('#target-step').show();

    };
    calc_target();
  });

  $('#slc_target_slc').change(function(event) {
    calc_target();  
  });

  $('#nm_target_base').keyup(function(event) {
    calc_target();
  });

  $('#nm_target_step').keyup(function(event) {
    calc_target();
  });
  

  function calc_target () {
    var slc  = $('#slc_target_slc').val();
    var type = $('#slc_target_type').val();
    var base = $('#nm_target_base').val();
    var step = $('#nm_target_step').val();

    $('.nm_target_m').val('');
    $('.chk_target_m').iCheck('uncheck');
    if (type == 'F') {
      if (slc == 'M') {
        // TODO check semua target
        $('.chk_target_m').iCheck('check');
        $('.nm_target_m').val(base);
      } else if (slc == 'O') {
        // TODO check target bulan ganjil
        $('.chk_target_o').iCheck('check');
        $('.nm_target_o').val(base);
      } else if (slc == 'E'){
        // TODO check target bulan genap
        $('.chk_target_e').iCheck('check');
        $('.nm_target_e').val(base);
      } else if (slc == 'Q') {
        // TODO check target Quater (Mar, Jun, Sep, Des)
        $('.chk_target_q').iCheck('check');
        $('.nm_target_q').val(base);
      } else if (slc == 'T') {
        // TODO check target Quater (Mar, Jun, Sep, Des)
        $('.chk_target_t').iCheck('check');
        $('.nm_target_t').val(base);
      }else if (slc == 'S'){
        // TODO check target Semester (Jun, Des)
        $('.chk_target_s').iCheck('check');
        $('.nm_target_s').val(base);
      };
    } else if (type == 'P') {
      var temp = base;
      if (slc == 'M') {
        // TODO check semua target
        $('.chk_target_m').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          $('#nm_target_'+i).val(temp);
          temp = parseFloat(temp) + parseFloat(step);

        };

      } else if (slc == 'O') {
        // TODO check target bulan ganjil
        $('.chk_target_o').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          if (i%2==1) {
            $('#nm_target_'+i).val(temp);
            temp = parseFloat(temp) + parseFloat(step);
          };
        };
      } else if (slc == 'E'){
        // TODO check target bulan genap
        $('.chk_target_e').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          if (i%2==0) {
            $('#nm_target_'+i).val(temp);
            temp = parseFloat(temp) + parseFloat(step);
          };
        };
      } else if (slc == 'Q') {
        // TODO check target Quater (Mar, Jun, Sep, Des)
        $('.chk_target_q').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          if (i%3==0) {
            $('#nm_target_'+i).val(temp);
            temp = parseFloat(temp) + parseFloat(step);
          };
        };
      } else if (slc == 'T') {
        // TODO check target 4 bulanan (Apr, Agus, Des)
        $('.chk_target_t').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          if (i%4==0) {
            $('#nm_target_'+i).val(temp);
            temp = parseFloat(temp) + parseFloat(step);
          };
        };
      }else if (slc == 'S'){
        // TODO check target Semester (Jun, Des)
        $('.chk_target_s').iCheck('check');
        for (var i = 1; i <= 12; i++) {
          if (i%6==0) {
            $('#nm_target_'+i).val(temp);
            temp = parseFloat(temp) + parseFloat(step);
          };
        }; 
      };
    };
  }

  $('#slc_persp_kpi').change(function(event) {
    /* Act on the event */
    var base_url = '<?php echo base_url();?>index.php/';
    var sc_id = $('#sc_id').val();
    var persp = $(this).val();
    
    $.ajax({
      url: base_url+'plan/org/so_opt',
      type: 'POST',
      dataType: 'html',
      data: {sc_id: sc_id, persp: persp},
    })
    .done(function(respond) {
      $('#slc_so_kpi').html(respond);
    });
    
  });
</script>
<script type="text/javascript">
  $('#form-kpi').submit(function(event) {
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
      kpi_list();
      sc_weight();
      $('#kpi-form').modal('hide');
    });
  
  });
</script>