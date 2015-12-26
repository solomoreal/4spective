<aside class="left-side sidebar-offcanvas" id="menu">
	<nav>
		<h2><i class="fa fa-list"></i> Employee</h2>
		<ul>
			<li> <?php echo anchor('', lang('menu_obj')); ?> </li>
			<li> <?php echo anchor('', lang('menu_achv')); ?> </li>

			<li>
				<?php echo anchor('#', '<i class="fa fa-line-chart"></i> '.lang('menu_report')); ?>
				<h2><i class="fa fa-line-chart"></i> <?php echo lang('menu_report');?></h2>
				<ul>
					<li> <?php echo anchor('', lang('menu_org_bsc')); ?> </li>
					<li> <?php echo anchor('', lang('menu_emp_bsc')); ?> </li>

				</ul>
			</li>
		</ul>
	</nav>
</aside>		