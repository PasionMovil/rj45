<?php ?>
	<div class="col-lg-4 col-md-4 col-sm-12 col-sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
</div>

</div><!-- #content -->