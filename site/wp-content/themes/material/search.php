<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">				
				<div class="wrap-content">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h3 class="archive-title archive-search"><?php printf( __( '%s', 'dankov' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</header>


			<?php   /* Start the Loop */
					$divide_counter = 0;
			?>
			<?php while ( have_posts() ) :
				the_post();
				get_template_part( 'format', get_post_format() );
				$divide_counter++;
			?>
			<?php endwhile; ?>

			<?php if ( function_exists('wp_pagenavi') ) {?>
						<div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div>
			<?php } else { ?>
						<div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'dankov' ) ); previous_posts_link( __( 'Newer posts', 'dankov' ) ); ?></div>

			<?php }  ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="search-header">
					<h1 class="search-title"><?php _e( 'Nothing Found', 'dankov' ); ?></h1>
				</header>

				<div class="search-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dankov' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article>

		<?php endif; ?>

		
				</div>
			</div>



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