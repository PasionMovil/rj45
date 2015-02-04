<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">				<div class="wrap-content">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h3 class="archive-title archive-tags"><?php printf( __( '%s', 'dankov' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h3>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'format', get_post_format() );
				$divide_counter++;

			endwhile;
								
								if ( function_exists('wp_pagenavi') ) {?>

									<div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div>

								<?php } else { ?>

									<div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'dankov' ) ); previous_posts_link( __( 'Newer posts', 'dankov' ) ); ?></div>
								
								<?php }

				else :

					echo "<p class='not-found'>".__('Sorry, no posts found under this tag.', 'dankov')."</p>";

				endif;
							
			?>

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