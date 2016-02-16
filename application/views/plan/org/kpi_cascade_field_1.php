<h4>To # <?php echo $num?></h4>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_sc_cascade_<?php echo $num; ?>" data-toggle="tab" aria-expanded="false">SC</a></li>
    <li class=""><a href="#tab_kpi_cascade_<?php echo $num; ?>" data-toggle="tab" aria-expanded="false"><?php echo lang('sc_kpi');?></a></li>
    <li class=""><a href="#tab_target_cascade_<?php echo $num; ?>" data-toggle="tab" aria-expanded="true"><?php echo lang('sc_target');?></a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_sc_cascade_<?php echo $num; ?>">
      <div class="row">
        <div class="form-group col-xs-6 col-sm-4">
          <label ><?php echo lang('sc_ref_weight');?> </label>
          <input type="number" class="form-control" value="0" min="0" max="1000" step="0.01" name="nm_ref_weight_<?php echo $num ?>" id="nm_ref_weight_<?php echo $num ?>">
          
        </div>
        <div class="form-group col-xs-6 col-sm-8">
          <label ><?php echo lang('basic_type');?> </label>
          <select class="form-control" name="slc_sc_type_<?php echo $num ?>" id="slc_sc_type_<?php echo $num ?>">
            <option value=""></option>
            <option value="ORG"><?php echo lang('om_org');?></option>
            <option value="EMP"><?php echo lang('om_emp');?></option>
          </select>
          
        </div>
        
      </div>
      <div class="form-group">
          <label ><?php echo lang('basic_to');?> </label>
          <select class="form-control" name="slc_sc_to_<?php echo $num ?>" id="slc_sc_to_<?php echo $num ?>">
            <option value=""></option>
            
          </select>
          
        </div>
    </div> 

    <div class="tab-pane" id="tab_kpi_cascade_<?php echo $num; ?>">
      
      <div class="form-group">
        <label ><?php echo lang('sc_so');?> </label>
        <select class="form-control" name="slc_so_<?php echo $num ?>" id="slc_so_kpi_<?php echo $num ?>">
          <option value="COPY">Create Copy From Source</option>
        </select>
        
      </div>
      <div class="row">
        <div class="form-group col-xs-12 col-sm-3">
          <label ><?php echo lang('basic_code');?> </label>
          <input type="text" class="form-control txt_code" name="txt_code_<?php echo $num ?>" id="txt_code_kpi_<?php echo $num ?>">
        </div>
        
        <div class="form-group col-xs-12 col-sm-9">
          <label ><?php echo lang('basic_name');?> </label>
          <input type="text" class="form-control txt_name" name="txt_name_<?php echo $num ?>" id="txt_name_kpi_<?php echo $num ?>">
        </div>
        
      </div>

      <div class="form-group">
        <label ><?php echo lang('basic_desc');?> </label>
        <textarea class="form-control txt_desc_kpi" name="txt_desc_<?php echo $num ?> " id="txt_desc_kpi_<?php echo $num ?>"></textarea>
      </div>

      <div class="form-group">
        <label ><?php echo lang('sc_weight');?> </label>
        <div class="input-group">
          <input type="number" class="form-control" value="0" min="0" max="100" step="0.01" name="nm_weight_<?php echo $num; ?>" id="nm_weight_<?php echo $num; ?>">
          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
        </div>
      </div>
    </div> 

    <div class="tab-pane" id="tab_target_cascade_<?php echo $num; ?>">
      <div class="row">
        <div class="form-group col-xs-6 col-sm-3">
          <label ><?php echo lang('sc_target_type');?> </label>
          <select class="form-control" name="slc_target_type_<?php echo $num ?>" id="slc_target_type_<?php echo $num ?>">
            <option value=""></option>
            <option value="F">Flat</option>
            <option value="P">Progresive</option>
          </select>
        </div>
        <div class="form-group col-xs-6 col-sm-3">
          <label ><?php echo lang('sc_target_slc');?> </label>
          <select class="form-control" name="slc_target_slc_<?php echo $num ?>" id="slc_target_slc_<?php echo $num ?>">
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
          <input type="number" class="form-control" value="0" name="nm_target_base_<?php echo $num ?>" id="nm_target_base_<?php echo $num ?>" step="0.01">
        </div>

        <div class="form-group col-xs-6 col-sm-3" id="target-step">
          <label ><?php echo lang('sc_target_step');?> </label>
          <input type="number" class="form-control" value="0" name="nm_target_step_<?php echo $num ?>" id="nm_target_step_<?php echo $num ?>" step="0.01">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-xs-6 col-sm-3">
          <label >Jan </label>
          <div class="row">
            <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '1', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_1_'.$num.'"');?></div>
            <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_1_<?php echo $num ?>" id="nm_target_1_<?php echo $num ?>" step="0.01"></div>
          </div>
        </div>

        <div class="form-group col-xs-6 col-sm-3">
          <label >Feb </label>
          <div class="row">
            <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '2', FALSE, 'class="chk_target_m chk_target_e " id="chk_target_2_'.$num.'"');?></div>
            <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e" name="nm_target_2_<?php echo $num ?>" id="nm_target_2_<?php echo $num ?>" step="0.01"></div>
          </div>
        </div>

        <div class="form-group col-xs-6 col-sm-3">
          <label >Mar </label>
          <div class="row">
            <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '3', FALSE, 'class="chk_target_m chk_target_o chk_target_q" id="chk_target_3_'.$num.'"');?></div>
            <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o nm_target_q" name="nm_target_3_<?php echo $num ;?>" id="nm_target_3_<?php echo $num ;?>" step="0.01"></div>
          </div>
        </div>

        <div class="form-group col-xs-6 col-sm-3">
          <label >Apr </label>
          <div class="row">
            <div class="col-sm-1"><?php echo form_checkbox('chk_target'.$num.'[]', '4', FALSE, 'class="chk_target_m chk_target_e chk_target_t" id="chk_target_4'.$num.'"');?></div>
            <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_t" name="nm_target_4_<?php echo $num; ?>" id="nm_target_4_<?php echo $num; ?>" step="0.01"></div>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label >May </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '5', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_5_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_5_<?php echo $num ;?>" id="nm_target_5_<?php echo $num ;?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Jun </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '6', FALSE, 'class="chk_target_m chk_target_e chk_target_q chk_target_s" id="chk_target_6_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_q nm_target_s" name="nm_target_6_<?php echo $num?>" id="nm_target_6_<?php echo $num?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Jul </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '7', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_7_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_7_<?php echo $num; ?>" id="nm_target_7_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Agu </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '8', FALSE, 'class="chk_target_m chk_target_e chk_target_t" id="chk_target_8_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_t" name="nm_target_8_<?php echo $num; ?>" id="nm_target_8_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-6 col-sm-3">
            <label >Sep </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '9', FALSE, 'class="chk_target_m chk_target_o chk_target_q" id="chk_target_9_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o nm_target_q" name="nm_target_9_<?php echo $num; ?>" id="nm_target_9_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Oct </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '10', FALSE, 'class="chk_target_m chk_target_e" id="chk_target_10_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e" name="nm_target_10_<?php echo $num; ?>" id="nm_target_10_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Nov </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '11', FALSE, 'class="chk_target_m chk_target_o" id="chk_target_11_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_o" name="nm_target_11_<?php echo $num; ?>" id="nm_target_11_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>

          <div class="form-group col-xs-6 col-sm-3">
            <label >Dec </label>
            <div class="row">
              <div class="col-sm-1"><?php echo form_checkbox('chk_target_'.$num.'[]', '12', FALSE, 'class="chk_target_m chk_target_e chk_target_q chk_target_t chk_target_s" id="chk_target_12_'.$num.'"');?></div>
              <div class="col-sm-9"><input type="number" class="form-control nm_target_m nm_target_e nm_target_q nm_target_t nm_target_s" name="nm_target_12_<?php echo $num; ?>" id="nm_target_12_<?php echo $num; ?>" step="0.01"></div>
            </div>
          </div>
        </div>

    </div> 
  </div>
</div>
<script type="text/javascript">
  $('#slc_sc_type_<?php echo $num ?>').change(function(event) {
    /* Act on the event */
    var type = $(this).val();
    var kpi_id = $('#kpi_id').val();
    var base_url = '<?php echo base_url(); ?>index.php/';
    if (type != '') {
      $.ajax({
        url: base_url + 'plan/org/sc_opt',
        type: 'POST',
        dataType: 'json',
        data: {
          type: type,
          kpi_id: kpi_id},
      })
      .done(function(respond) {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
      
    }; 
  });
</script>

