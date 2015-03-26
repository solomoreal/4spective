<aside class="left-side sidebar-offcanvas" id="menu">
	<nav>
		<h2><i class="fa fa-list"></i> Admin</h2>
		<ul>
			<li>
				<?php echo anchor('#', '<i class="fa fa-sitemap"></i> '.lang('menu_om')); ?>
				<h2><i class="fa fa-sitemap"></i> <?php echo lang('menu_om');?></h2>
				<ul>
					<li> <?php echo anchor('admin/org_struc', lang('menu_org_struc')); ?> </li>
					<li> <?php echo anchor('admin/report_struc', lang('menu_report_struc')); ?> </li>
				</ul>
			</li>
			<li>
				<?php echo anchor('#', '<i class="fa fa-sliders"></i> '.lang('menu_bsc_set')); ?>
				<h2><i class="fa fa-sliders"></i> <?php echo lang('menu_bsc_set');?></h2>
				<ul>
					<li> <?php echo anchor('#', '<i class="fa fa-tachometer"></i> '.lang('menu_score')); ?> 
						<h2><i class="fa fa-tachometer"></i> <?php echo lang('menu_score');?></h2>
						<ul>
							<li> <?php echo anchor('', lang('menu_score_pc')); ?> </li>
							<li> <?php echo anchor('', lang('menu_score_pa')); ?> </li>

						</ul>
					</li>
					<li> <?php echo anchor('#', '<i class="fa fa-calculator"></i> '.lang('menu_count')); ?> 
						<h2><i class="fa fa-calculator"></i> <?php echo lang('menu_count');?></h2>
						<ul>
							<li> <?php echo anchor('admin/formula', '<i class="fa fa-flask"></i> '.lang('menu_formula')); ?> </li>
							<li> <?php echo anchor('admin/count_unit','<i class="fa fa-cubes"></i> '. lang('menu_count_unit')); ?> </li>
							<li> <?php echo anchor('admin/ytd', '<i class="fa fa-calendar"></i> '.lang('menu_ytd')); ?> </li>
							<li> <?php echo anchor('admin/ref', '<i class="fa fa-code-fork fa-flip-vertical"></i> '.lang('menu_ref')); ?> </li>
						</ul>
					</li>
					<li> <?php echo anchor('admin/period', '<i class="fa fa-calendar-o"></i> '.lang('menu_period')); ?> </li>
					<li> <?php echo anchor('admin/gen_kpi', '<i class="fa fa-list-alt"></i> '.lang('menu_gen_kpi')); ?> </li>
					<li> <?php echo anchor('admin/perspective', '<i class="fa fa-eye"></i> '.lang('menu_perspective')); ?> </li>
					<li> <?php echo anchor('admin/other', '<i class="fa fa-cog"></i> '.lang('menu_other')); ?> </li> 
				</ul>
			</li>
			<li>
				<?php echo anchor('#', '<i class="fa fa-users"></i> '.lang('menu_user_man')); ?>
				<h2><i class="fa fa-users"></i> <?php echo lang('menu_user_man');?></h2>
				<ul>
					<li> <?php echo anchor('', lang('menu_user')); ?> </li>
					<li> <?php echo anchor('', lang('menu_roles')); ?> </li>
					<li> <?php echo anchor('', lang('menu_privilege')); ?> </li>
				</ul>
			</li>
		</ul>
	</nav>
</aside>		