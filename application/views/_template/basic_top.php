<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
		<?php
			if(isset($page_title)){
				echo $page_title;
				echo ' - ';
			}
			?>
			4spective
		</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- bootstrap 3.0.2 -->
		<?php echo link_tag('assets/AdminLTE/css/bootstrap.min.css'); ?>
		<!-- font Awesome -->
		<?php echo link_tag('assets/AdminLTE/css/font-awesome.min.css'); ?>
		<!-- Ionicons -->
		<?php echo link_tag('assets/AdminLTE/css/ionicons.min.css'); ?>
		<!-- fullCalendar -->
		<?php echo link_tag('assets/AdminLTE/css/fullcalendar/fullcalendar.css'); ?>
		<!-- Datepicker -->
		<?php echo link_tag('assets/datepicker/css/datepicker.css'); ?>
		<!-- Daterange picker -->
		<?php echo link_tag('assets/AdminLTE/css/daterangepicker/daterangepicker-bs3.css'); ?>
		<!-- bootstrap wysihtml5 - text editor -->
		<?php echo link_tag('assets/AdminLTE/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>
		<!-- Theme style -->
		<?php echo link_tag('assets/AdminLTE/css/AdminLTE.css'); ?>
		<!-- Multi Level Push Menu -->
		<?php echo link_tag('assets/mlpm/jquery.multilevelpushmenu.css'); ?>
		<?php
		if(isset($css_list)){
			foreach ($css_list as $key => $value) {
				echo link_tag('assets'.$value.'.css');
			}
		}
		?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>