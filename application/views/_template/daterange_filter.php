<div id="" class="row">
	<div id="" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="box box-solid">
			<div class="box-header"></div>
			<div class="box-body">
				<div class="form-group">
          <label>Date Filter</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <?php echo form_input('dt_range_filter', $filter_date, 'class="form-control pull-right daterange"'); ?>
            <span class="input-group-btn">
	            <button class="btn " type="button" id="btn_filter">Go!</button>
	          </span>
          </div><!-- /.input group -->
	      </div>
			</div>
		</div>
	</div>
</div>
