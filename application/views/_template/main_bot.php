<?php
$this->load->view('_template/basic_bot');
?>
<script src="<?php echo base_url()?>assets/AdminLTE/js/AdminLTE/app.js" type="text/javascript"></script>

<!-- Multi Level Push Menu -->
	<script src="<?php echo base_url()?>assets/mlpm/jquery.multilevelpushmenu.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#menu').multilevelpushmenu({
			mode: 'cover', 
			menuWidth: '220px',
			preventItemClick: false
		});
	});

</script>
<!-- fullCalendar -->
<script src="<?php echo base_url()?>assets/AdminLTE/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>

<!-- POPUP Fancybox -->
<script src="<?php echo base_url()?>assets/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.fancybox').fancybox();
});
</script>

<script type="text/javascript">
  $('.nav_role').click(function(event) {
    /* Act on the event */
    event.preventDefault();
    var role = $(this).data('role');
    var base_url = '<?php echo base_url();?>index.php/'
    $.ajax({
      url: base_url+'account/switch_role',
      type: 'POST',
      // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      data: {role: role},
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
      location.reload();
    });
    
  });
</script>