<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid">
      <div class="box-header">
      <h3 class="box-title" > <?php echo '<i class="fa '.$persp->persp_icon.'"></i> '.$persp->persp_desc ?></h3>
      <!-- tools box -->
        <div class="pull-right box-tools btn-group">
          <button class="btn add-so" data-toggle="modal" data-target="#so-form" data-persp="<?php echo $persp->persp_code ?>"><i class="fa fa-plus" ></i></button>
          <?php 
            // echo anchor($add_so.$persp->persp_code, '<i class="fa fa-plus"></i>', 'title="'.lang('act_add').'" class="btn btn-act" " data-fancybox-type="ajax"');
          ?>
        </div><!-- /. tools -->
      </div>
      <div  class="box-body">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="2"><?php echo lang('sc_so');?></th>
                  <th width="150"><?php echo lang('basic_action');?></th>
                  <th width="30"><?php echo lang('basic_select');?></th>
                </tr>
              </thead>
              <tbody id="so_list_<?php echo $persp->persp_code; ?>">
                
              </tbody>
            </table>
          </div>

          <div class="col-xs-12 col-sm-6">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th colspan="2"><?php echo lang('sc_kpi');?></th>
                  <th><?php echo lang('sc_weight');?></th>
                  <th width="150"><?php echo lang('basic_action');?></th>
                </tr>
              </thead>
              <tbody id="kpi_list_<?php echo $persp->persp_code; ?>">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.col -->
</div>