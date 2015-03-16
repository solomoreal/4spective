<div class="row">
	<div class="col-sm-12">
		<dl class="dl-horizontal">
			<dt>Type</dt>
		  <dd><?php echo $rel->rel_type; ?></dd>

		  <dt>From</dt>
		  <dd><?php echo $rel->obj_from. ' - '. $rel->code_from . ' - '.$rel->name_from; ?></dd>

		  <dt>To</dt>
		  <dd><?php echo $rel->obj_to. ' - '. $rel->code_to . ' - '.$rel->name_to; ?></dd>

		  <dt><?php echo lang('om_rel_begin'); ?></dt>
		  <dd><?php echo $rel->begin; ?></dd>

		  <dt><?php echo lang('om_rel_end'); ?></dt>
		  <dd><?php echo $rel->end; ?></dd>
		</dl>
	</div>
</div>