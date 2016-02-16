<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    
    <li class="active"><a href="#tab_kpi_cascade" data-toggle="tab" aria-expanded="false"><?php echo lang('sc_kpi');?></a></li>
    <li class=""><a href="#tab_target_cascade" data-toggle="tab" aria-expanded="true"><?php echo lang('sc_target');?></a></li>
  </ul>
  <div class="tab-content">
    

    <div class="tab-pane active" id="tab_kpi_cascade">
      <div class="row">
        <div class="form-group col-xs-6 col-sm-4">
          <label ><?php echo lang('basic_type');?> </label>
          <select class="form-control" name="slc_sc_type" id="slc_sc_type">
            <option value=""></option>
            <option value="ORG"><?php echo lang('om_org');?></option>
            <option value="EMP"><?php echo lang('om_emp');?></option>
          </select>
          
        </div>
        <div class="form-group col-xs-6 col-sm-8">
          <label ><?php echo lang('basic_to');?> </label>
          <select class="form-control" name="slc_sc_to" id="slc_sc_to">
            <option value=""></option>
            
          </select>
          
        </div>
      </div>

      <div class="form-group">
        <label ><?php echo lang('sc_so');?> </label>
        <select class="form-control" name="slc_so" id="slc_so_kpi">
          <option value="COPY">Create Copy From Source</option>
        </select>
        
      </div>

      <div class="row">
        <div class="form-group col-xs-12 col-sm-3">
          <label ><?php echo lang('basic_code');?> </label>
          <input type="text" class="form-control txt_code" name="txt_code" id="txt_code_kpi">
        </div>
        
        <div class="form-group col-xs-12 col-sm-9">
          <label ><?php echo lang('basic_name');?> </label>
          <input type="text" class="form-control txt_name" name="txt_name" id="txt_name_kpi">
        </div>
        
      </div>

      <div class="form-group">
        <label ><?php echo lang('basic_desc');?> </label>
        <textarea class="form-control txt_desc_kpi" name="txt_des " id="txt_desc_kp"></textarea>
      </div>

      <div class="form-group">
        <label ><?php echo lang('sc_weight');?> </label>
        <div class="input-group">
          <input type="number" class="form-control" value="0" min="0" max="100" step="0.01" name="nm_weight" id="nm_weight">
          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
        </div>
      </div>
    </div>

    <div class="tab-pane" id="tab_target_cascade">
      
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
            <div class="col-sm-1"><?php echo form_checkbox('chk_target', '4', FALSE, 'class="chk_target_m chk_target_e chk_target_t" id="chk_target_4"');?></div>
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
  </div>
</div>