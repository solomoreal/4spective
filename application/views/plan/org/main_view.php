<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<!-- top row -->
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div  class="box-body">
							<form class="form-inline">
							  <div class="form-group">
							    <label for="exampleInputName2">Period</label>

							    <?php echo form_dropdown('slc_period', $period_opt, $period_def,'class="form-control" id="slc_period"'); ?>
							  </div>

							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<h3 class="box-title" id="org-title"></h3>
						<!-- tools box -->
							<div class="pull-right box-tools btn-group">
								<?php 
									// echo anchor($link_add, '<i class="fa fa-plus"></i>', 'title="'.lang('act_add').'" class="btn btn-act" " data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div  class="box-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th><?php echo lang('om_org'); ?></th>
										<th><?php echo lang('basic_status'); ?></th>
										<th ><?php echo lang('basic_action'); ?></th>
									</tr>
								</thead>
								<tbody id="list">

								</tbody>
							</table>

						</div>
					</div>
				</div><!-- /.col -->
			</div>
			<!-- /.row -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal-copy-sc" tabindex="-1" role="dialog" aria-labelledby="sc-form-title">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('plan/org/copy_sc_process', 'id="form-sc"'); ?>
      <?php echo form_hidden('hdn_period', ''); ?>
      <?php echo form_hidden('hdn_org', ''); ?>
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sc-form-title">Copy SC</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label ><?php echo lang('basic_from');?> </label>
          <select class="form-control" name="slc_from" id="slc_from">
            <option value=""></option>
            <option value="past">Past Period</option>
            <option value="other">Other Org</option>
          </select>
          
        </div>
        <div class="form-group">
          <label ><?php echo lang('basic_source');?> </label>
          <select class="form-control" name="slc_source" id="slc_source">
            
          </select>
          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('act_close'); ?></button>
        <button type="button" class="btn btn-primary"><?php echo lang('act_save'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<?php $this->load->view('_template/main_bot'); ?>

<script type="text/javascript">
	show_list();
	$('#slc_period').change(function(event) {
		/* Act on the event */
		show_list();
	
	});
	function show_list () {
		var base_url = '<?php echo base_url()?>index.php/';
		var period = $('#slc_period').val();
		$.ajax({
			url: base_url + 'plan/org/sc_list',
			type: 'POST',
			dataType: 'html',
			data: {period: period},
		})
		.done(function(respond) {
			$('#list').html(respond);
			$('.create-copy').click(function(event) {
				/* Act on the event */
				$('#hdn_period').val($(this).data('period'));
				$('#hdn_org').val($(this).data('org'));
			});
		});
		
	}
	
</script>
<script type="text/javascript">
	
	$('#slc_from').change(function(event) {
		/* Act on the event */

		var from   = $('#slc_from').val();

		var url    = '<?php echo base_url(); ?>index.php/plan/org/';
		var period = $('#hdn_period').val();
		var org_id = $('#hdn_org').val();
		if (from == 'past') {
			
			$.ajax({
				url: url+'source_past',
				type: 'POST',
				dataType: 'json',
				data: {
					period: period,
					org_id: org_id
				},
			})
			.done(function(respond) {
				$.each(respond, function(i, row) {
           $('#slc_source').append($('<option>').text(row.text).attr('value', row.value));
        });
				console.log("success");
			});
			
		} else if (from == 'other') {
			$.ajax({
				url: url+'source_other',
				type: 'POST',
				dataType: 'json',
				data: {
					period: period,
					org_id: org_id
				},
			})
			.done(function(respond) {
				$.each(respond, function(i, row) {
           $('#slc_source').append($('<option>').text(row.text).attr('value', row.value));
        });
				console.log("success");
			});
			
		} else {
			$('#slc_source').empty();
		};
	});
</script>
