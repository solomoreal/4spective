<?php $this->load->view('_template/main_top'); ?>

	<aside class="right-side">
	<?php $this->load->view('_template/page_head'); ?>
		<!-- Main content -->
		<section class="content" id="sec-main">
			<!-- top row -->

			<div class="row">
				<?php 
				$style = array('box-primary','box-info','box-success','box-warning','box-danger');
				$count = 0 ;
				foreach ($perspective_ls as $row) {

					$desc = 'sc_persp_'.strtolower($row->perspective_code);
					echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"><div class="box '.$style[$count%5].'">';
					echo '<div class="box-header"><h3 class="box-title">'.$row->perspective_code.'</h3></div>';

					echo '<div class="box-body">'.lang($desc).'</div>';
					echo '</div></div>';
					$count++;
				}
				?>
			</div>
			<!-- /.row -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php $this->load->view('_template/main_bot'); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
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
          afterClose: function(){parent.location.reload(true)}
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
