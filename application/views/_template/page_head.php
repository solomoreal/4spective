<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php
		if(isset($page_title)){
			echo $page_title;
		}
		?>
		<small>
			<?php
			if(isset($page_subtitle)){
				echo $page_subtitle;
			}
			?>
		</small>
	</h1>
	<ol class="breadcrumb">
		<?php
		if (isset($bc_list)) {
			$max = count($bc_list)-1;
			for ($i=0; $i <= $max ; $i++) { 
				if($i==$max){
					echo '<li class="ative">';
					echo anchor($bc_list[$i]['url'], $bc_list[$i]['link']);
				} else {
					echo '<li>';
					echo $bc_list[$i]['link'];
				}
				echo '</li>';
			}
		}
		?>
	</ol>
</section><!-- Content Header (Page header) -->