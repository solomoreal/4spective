<!-- KPI Modal -->
<div class="modal fade" id="kpi-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('', 'id="form-kpi"'); ?>
      <?php echo form_hidden('kpi_id', '','id="kpi_id"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="kpi-modal-title">KPI Title</h4>
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt><?php echo lang('sc_persp'); ?></dt>
          <dd id="kpi-persp"></dd>

          <dt><?php echo lang('sc_so'); ?></dt>
          <dd id="kpi-so"></dd>

          <dt><?php echo lang('sc_kpi'); ?></dt>
          <dd id="kpi-kpi"></dd>

          <dt><?php echo lang('basic_desc'); ?></dt>
          <dd id="kpi-desc"></dd>

          <dt><?php echo lang('sc_weight'); ?></dt>
          <dd id="kpi-weight"></dd>

          <dt><?php echo lang('sc_measure'); ?></dt>
          <dd id="kpi-measure"></dd>

          <dt><?php echo lang('sc_formula'); ?></dt>
          <dd id="kpi-formula"></dd>

          <dt><?php echo lang('sc_ytd'); ?></dt>
          <dd id="kpi-ytd"></dd>
        </dl>
        
        <h4>Target</h4>

        <table class="table table-bordered">
          <tr>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
          </tr>
          <tr>
            <td id="target_1"></td>
            <td id="target_2"></td>
            <td id="target_3"></td>
            <td id="target_4"></td>
          </tr>
          <tr>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Agu</th>
          </tr>
          <tr>
            <td id="target_5"></td>
            <td id="target_6"></td>
            <td id="target_7"></td>
            <td id="target_8"></td>
          </tr>
          <tr>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
          </tr>
          <tr>
            <td id="target_9"></td>
            <td id="target_10"></td>
            <td id="target_11"></td>
            <td id="target_12"></td>
          </tr>

        </table>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>

    </div>
  </div>
</div>
