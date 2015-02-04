<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">
				<div class="wrap-content">
					<div class="breadcrumbs">
					    <?php if(function_exists('bcn_display'))
					    {
					        bcn_display();
					    }

					    else {the_title();}?>
					</div>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
 			<?php wp_link_pages(); ?>
			<?php { ?> 
			<?php if(isset($data['display_comment']))  { ?>
				<?php if($data['display_comment'] == 1)  { ?>
					<?php comments_template( '', true ); ?>
					<?php } else  { ?>
				<?php } ?>
			<?php } ?> 
		<?php } ?> 	
		
		<?php endwhile; // end of the loop. ?>

				</div>
			</div><!-- #content -->

		<?php
			if ($sidebarOff != 'sidebar-no') {
				echo '<aside class="percent-sidebar">';
					if(isset($data['blog_sidebar'])) {
						if($data['blog_sidebar'] !='') { 
							$blog_sidebar_position = $data['blog_sidebar']; 
							dynamic_sidebar($blog_sidebar_position); 
						}
						else {
							get_sidebar();
						}					
					}
					else {
						get_sidebar();
					}
				echo '</aside>';
			}
		?>
		

</div></div>
<?php get_footer(); ?>