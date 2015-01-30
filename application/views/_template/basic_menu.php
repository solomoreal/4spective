<aside class="left-side sidebar-offcanvas" id="menu">
	<nav>
		<h2><i class="fa fa-list"></i> Menu</h2>
		<ul>

			<li>
				<?php echo anchor('#', '<i class="fa fa-sitemap"></i> '.lang('menu_om')); ?>
				<h2><i class="fa fa-sitemap"></i> <?php echo lang('menu_om');?></h2>
				<ul>
					<li> <?php echo anchor('admin/org_post', lang('menu_org_post')); ?> </li>
					<li> <?php echo anchor('#', lang('menu_job')); ?> </li>
				</ul>
			</li>
			
		</ul>
	</nav>
</aside>		