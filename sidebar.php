<div id="main-sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1') ) { ?>
		<div id="side">
			<ul>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</ul>
		</div>
	<?php } ?>
	<div class="clear"></div>
</div>
