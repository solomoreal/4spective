<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<!-- top row -->

			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-header">
						<h3 class="box-title" id="org-title"></h3>
						<!-- tools box -->
							<div class="pull-right box-tools btn-group">
								<?php 
									echo anchor($link_add, '<i class="fa fa-plus"></i>', 'title="'.lang('act_add').'" class="btn btn-act" " data-fancybox-type="ajax"');
								?>
							</div><!-- /. tools -->
						</div>
						<div  class="box-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th colspan="2"><?php echo lang('basic_id'); ?></th>
										<th><?php echo lang('basic_type'); ?></th>

										<th><?php echo lang('basic_name'); ?></th>
										<th><?php echo lang('basic_desc'); ?></th>
										<th width="100" class="hidden-xs"><?php echo lang('basic_begin'); ?></th>
										<th width="100" class="hidden-xs"><?php echo lang('basic_end'); ?></th>
										<th width="50"><?php echo lang('basic_action'); ?></th>
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
<?php $this->load->view('_template/main_bot'); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		refresh();

		function refresh () {
			var base_url = '<?php echo base_url(); ?>index.php/';
			$.ajax({
				url: base_url+'admin/formula/show_formula',
			})
			.done(function(html) {
				$('#list').html(html);
				$('.box-score').hide();

				// DO define btn-act-2 behavior
				$('.btn-act-2').click(function(e) {
					var formula_id = $(this).data('id');
					e.preventDefault();
					$.ajax({
						url: this.href,
						type: 'POST',
						data: {
							formula_id: formula_id},
					})
					.done(function(data) {
						 $.fancybox(data, {
		          // fancybox API options
		          fitToView: true,
		          width: 905,
		          height: 505,
		          autoSize: false,
		          closeClick: false,
		          openEffect: 'none',
		          closeEffect: 'none',
		          afterClose: function(){
		          	$('.box-score[data-id='+formula_id+']').show();
								$.ajax({
									url: base_url+'admin/formula/show_score',
									type: 'POST',
									data: {formula_id: formula_id},
								})
								.done(function(html) {
									$('.list-score[data-id='+formula_id+']').html(html);
									console.log("success");
								})
		          }
		        }); // fancybox
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				});
				// end of btn-act-2 behavior

				// DO define toggle to show Formula's Score
				$(".tgl-score").toggleClick(function(){ 
					var formula_id = $(this).data('id');   
					$(this).children('i').attr('class', 'fa fa-chevron-down');
					$('.box-score[data-id='+formula_id+']').show();
					$.ajax({
						url: base_url+'admin/formula/show_score',
						type: 'POST',
						data: {formula_id: formula_id},
					})
					.done(function(html) {
						$('.list-score[data-id='+formula_id+']').html(html);
						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
					

				}, function(){
					$(this).children('i').attr('class', 'fa fa-chevron-right');
					$('.box-score').hide();

				});


				// console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}


		$('.btn-act').click(function(e) {
			var code = $(this).data('code');
			e.preventDefault();
			$.ajax({
				url: this.href,
				type: 'POST',
				data: {
					code: code},
			})
			.done(function(data) {
				 $.fancybox(data, {
          // fancybox API options
          fitToView: true,
          width: 905,
          height: 505,
          autoSize: false,
          closeClick: false,
          openEffect: 'none',
          closeEffect: 'none',
          afterClose: function(){refresh()}
        }); // fancybox
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
	});
</script>
