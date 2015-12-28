<?php
$this->load->view('_template/basic_top');
?>
	<body class="skin-blue fixed">
		<!-- header logo: style can be found in header.less -->
		<header class="header">
			<?php echo anchor('', '4spective', 'class="logo "'); ?>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-right">
					<ul class="nav navbar-nav">
						<?php
							if ($this->user_model->check_privilege($this->session->userdata('login_user'),'USER')) {
								echo '<li>'.anchor('', 'Emp','class="nav_role" data-role="emp"') .'</li>';
							}

							if ($this->user_model->is_chief($this->session->userdata('username'))) {
								echo '<li>'.anchor('', 'Chief','class="nav_role" data-role="chief"') .'</li>';
							} else if ($this->user_model->is_spv($this->session->userdata('username'))) {
								echo '<li>'.anchor('', 'SPV','class="nav_role" data-role="spv"') .'</li>';
							}

							if ($this->user_model->check_privilege($this->session->userdata('login_user'),'SA')) {
								echo '<li>'.anchor('', 'Admin','class="nav_role" data-role="admin"').'</li>';
							}
						?>
						
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown">
								<i class="glyphicon glyphicon-user"></i>
								<span class="">
									<?php 

									if ($this->session->userdata('emp_name')) {
										echo $this->session->userdata('emp_name');
									} else {
										echo $this->session->userdata('username');
									}
									?>
								 <i class="caret"></i></span>
							</a>
							<a href="#" class="dropdown-toggle visible-xs" data-toggle="dropdown">
								<i class="glyphicon glyphicon-user"></i>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header bg-light-blue">
									<?php
									$img_properies = array(
										'src' => 'assets/AdminLTE/img/avatar.png',
										'alt' => 'User Image',
										'class' => 'img-circle'
									); 
									echo img($img_properies);
									?>
									<p>
										<?php echo $this->session->userdata('emp_name');?>
										<small><?php echo $this->session->userdata('username');?></small>
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">
									<div class="col-xs-6 text-center">
										<?php
											echo anchor('#', lang('menu_change_pw'));
										?>
									</div>
									<div class="col-xs-6 text-center">
										<?php
											echo anchor('home/switch_lang/'.str_replace('/', '|', $this->uri->uri_string()), lang('menu_switch_lang'));
										?>
									</div>
									
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
									<?php
										// echo anchor('#', lang('menu_profile'), 'class="btn btn-default btn-flat"');
									?>
									</div>
									<div class="pull-right">
										<?php
											echo anchor('account/logout', lang('menu_logout'), 'class="btn btn-default btn-flat"');
										?>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- Left side column. contains the logo and sidebar -->
			
<?php
	
	if ($this->session->userdata('sidemenu') == false ) {
		$this->load->view('_template/emp_menu');	

	} else {
		$this->load->view('_template/'.$this->session->userdata('sidemenu'));	

	}

?>