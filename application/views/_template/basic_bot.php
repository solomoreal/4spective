		<!-- jQuery 2.0.2 -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/jquery.min.js"></script>
		<!-- jQuery UI 1.10.3 -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/jquery-ui-1.10.3.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/bootstrap.min.js"></script>
		
		<!-- datepicker -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<!-- daterangepicker -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

		<!-- DATA TABES SCRIPT -->
      <script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
      <script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		
	
		<script src="<?php echo base_url()?>assets/js/toggle_click.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
		
		<?php
		if(isset($js_list)){
			foreach ($js_list as $key => $value) {
				echo '<script src="'. base_url() .'assets/'.$value.'.js" type="text/javascript"></script>';
			}
		}
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			$(".table-dt-full").dataTable();
			$('.table-dt-basic').dataTable({
					"bPaginate": true,
					"bLengthChange": false,
					"bFilter": false,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false
			});

			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			});
			
			$('.daterange').daterangepicker({
				format: 'YYYY-MM-DD',
				showDropdowns:true,
			});
		});
	</script> 

	</body>
</html>