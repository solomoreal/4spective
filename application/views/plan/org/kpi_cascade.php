<!-- KPI Modal -->
<div class="modal fade" id="kpi-cascade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="kpi-cascade-title">Cascade KPI</h4>
      </div>
      <div class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_kpi_source" data-toggle="tab" aria-expanded="false"><?php echo lang('sc_kpi');?></a></li>
            <li class=""><a href="#tab_target_source" data-toggle="tab" aria-expanded="true"><?php echo lang('sc_target');?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_kpi_source">
              
              <dl class="dl-horizontal">
                <dt><?php echo lang('sc_persp'); ?></dt>
                <dd id="source_kpi-persp"></dd>

                <dt><?php echo lang('sc_so'); ?></dt>
                <dd id="source_kpi-so"></dd>

                <dt><?php echo lang('sc_kpi'); ?></dt>
                <dd id="source_kpi-kpi"></dd>

                <dt><?php echo lang('basic_desc'); ?></dt>
                <dd id="source_kpi-desc"></dd>

                <dt><?php echo lang('sc_weight'); ?></dt>
                <dd id="source_kpi-weight"></dd>

                <dt><?php echo lang('sc_measure'); ?></dt>
                <dd id="source_kpi-measure"></dd>

                <dt><?php echo lang('sc_formula'); ?></dt>
                <dd id="source_kpi-formula"></dd>

                <dt><?php echo lang('sc_ytd'); ?></dt>
                <dd id="source_kpi-ytd"></dd>
              </dl>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_target_source">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                  </tr>
                  <tr>
                    <td id="source_target_1"></td>
                    <td id="source_target_2"></td>
                    <td id="source_target_3"></td>
                    <td id="source_target_4"></td>
                  </tr>
                  <tr>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Agu</th>
                  </tr>
                  <tr>
                    <td id="source_target_5"></td>
                    <td id="source_target_6"></td>
                    <td id="source_target_7"></td>
                    <td id="source_target_8"></td>
                  </tr>
                  <tr>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                  </tr>
                  <tr>
                    <td id="source_target_9"></td>
                    <td id="source_target_10"></td>
                    <td id="source_target_11"></td>
                    <td id="source_target_12"></td>
                  </tr>

                </table>
                
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <div class="form-group">
          <label ><?php echo lang('sc_kpi_num');?> </label>
            <input type="number" class="form-control" value="1" min="1" max="10" step="1" name="nm_weight" id="nm_weight">

        </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        
      </div>

    </div>
  </div>
</div>
