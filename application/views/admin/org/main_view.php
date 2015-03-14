
<?php $this->load->view('_template/page_head'); ?>
	<!-- Main content -->
	<section class="content" id="sec-main">
		<?php $this->load->view('_template/daterange_filter'); ?>
		<?php echo form_hidden('hdn_org', $org_id); ?>
		<!-- top row -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<div class="box-header">
					<h3 class="box-title" id="org-title"></h3>
					<!-- tools box -->
						<div class="pull-right box-tools btn-group">
						<?php 
							echo anchor('admin/org_struc', '<i class="fa fa-arrow-left"></i>', 'class="btn"');
							echo anchor($link_edit_org, '<i class="fa fa-pencil"></i>', 'title="Edit '. lang('om_org') .'" class="btn btn-act"  data-fancybox-type="ajax"');
						?>
						</div><!-- /. tools -->
					</div>
					<div id="last-attr" class="box-body">
						
					</div>
				</div>

				<div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_rel" id='nav-rel' data-toggle="tab" aria-expanded="true">Relation</a></li>
            <li class=""><a href="#tab_attr" id='nav-attr' data-toggle="tab" aria-expanded="false">Attribute</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_rel">
              
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_attr">
              
            </div><!-- /.tab-pane -->
          </div><!-- /.tab-content -->
        </div>

			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->

<script>
jQuery(document).ready(function($) {
	refresh();

	$('#btn_filter').click(function(event) {
			refresh();
		});

		$('.btn-act').click(function(e) {
			var date_range = $('#dt_range_filter').val();
		 	var parent = $('#hdn_org').val();
			e.preventDefault();
			$.ajax({
				url: this.href,
				type: 'POST',
				data: {
					parent: parent,
					obj_id: parent,
					date_range: date_range},
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

	$('#nav-attr').click(function() {
		var base_url   = '<?php echo base_url()."index.php"?>';
		var date_range = $('#dt_range_filter').val();
	 	var org_id     = $('#hdn_org').val();
		$.ajax({
			url:  base_url+'/admin/org/show_attr',
			type: 'POST',
			data: {
				org_id: org_id,
				date_range: date_range
			},
		})
		.done(function(result) {
			$('#tab_attr').html(result);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

	$('#nav-rel').click(function() {
		var base_url   = '<?php echo base_url()."index.php"?>';
		var date_range = $('#dt_range_filter').val();
	 	var org_id     = $('#hdn_org').val();

		$.ajax({
				url: base_url+'/admin/org/show_rel',
				type: 'POST',
				data: {
					org_id: org_id,
					date_range: date_range
				},
			})
			.done(function(result) {
				$('#tab_rel').html(result);
				btn_bhv ();

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	});

	function btn_bhv () {
		/// DO .btn-act-2 behavior 
				$('.btn-act-2').click(function(e) {
					var date_range = $('#dt_range_filter').val();
				 	var parent = $('#hdn_org').val();
				 	var obj_id = $(this).data('obj');
					e.preventDefault();
					$.ajax({
						url: this.href,
						type: 'POST',
						data: {
							obj_id: obj_id,
							date_range: date_range},
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
				}); // end of .btn-act-2
	}

	function refresh () {
		var base_url   = '<?php echo base_url()."index.php"?>';
	 	var date_range = $('#dt_range_filter').val();
	 	var org_id     = $('#hdn_org').val();

		$.ajax({
			url: base_url+'/admin/org/show_last',
			type: 'POST',
			data: {
				org_id: org_id,
				date_range: date_range
			},
		})
		.done(function(result) {
			$('#last-attr').html(result);
			$.ajax({
				url: base_url+'/admin/org/show_rel',
				type: 'POST',
				data: {
					org_id: org_id,
					date_range: date_range
				},
			})
			.done(function(result) {
				$('#tab_rel').html(result);
				btn_bhv ();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}
});
</script>