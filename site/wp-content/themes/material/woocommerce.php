<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null && $data['blog_sidebar_position'] != 'sidebar-no' ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">
							<header class="archive-header" style="margin-top: 50px;">
				<h3 class="archive-title archive-shop"><?php printf( __( '%s', 'dankov' ), '<span>' . woocommerce_page_title( '', false ) . '</span>' ); ?></h3>
			</header><!-- .archive-header -->
				<div class="wrap-content">

					<?php woocommerce_content(); ?>
				</div>
			</div><!-- #content -->

			<div class="col-lg-4 col-md-4 col-sm-12 col-sidebar">
				<?php if ( is_active_sidebar( 'woocommerce' ) ) : ?>
					<div class="sidebar">
						<?php dynamic_sidebar( 'woocommerce' ); ?>
					</div><!-- #secondary -->
				<?php endif; ?>
			</div>

		

</div></div>
<?php get_footer(); ?>




</div><!-- #content -->