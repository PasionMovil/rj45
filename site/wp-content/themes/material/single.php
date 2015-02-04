<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<?php endif; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="left-part">
					<div id="authorarea">
						<h3><?php echo get_the_author(); ?></h3>
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
							<div class="authorinfo">
							<?php the_author_meta( 'description' ); ?>
						</div>
					</div>
				</div>
				<div class="wrap-content">
					<div class="breadcrumbs">
					    <?php if(function_exists('bcn_display'))
					    {
					        bcn_display();
					    }?>
					</div>

				<article id="post" class="single">



					<div class="entry-content">
					
					<?php get_template_part( 'format', get_post_format() ); ?>

					</div>

			<?php if(isset($data['show_related_post']))  { ?>
				<?php if($data['show_related_post'] == 1)  { ?>
					
						<div class="row">
						<div class="related-posts">  
						<div class="col-lg-12"><h3><?php _e('Related posts', 'dankov'); ?></h3>  </div>
						<?php
						    $orig_post = $post;  
						    global $post;  
						    $tags = wp_get_post_tags($post->ID);  
						      
						    if ($tags) {  
						    $tag_ids = array();  
						    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
						    $args=array(  
						    'tag__in' => $tag_ids,  
						    'post__not_in' => array($post->ID),  
						    'posts_per_page'=> 2,
						    'ignore_sticky_posts'=> 1  
						    );  
						      
						    $my_query = new WP_Query( $args );  
						  
						  	//$queryCounter = $my_query->found_posts;

						    while( $my_query->have_posts() ) {
							    $my_query->the_post();

							    //if ($queryCounter < 3) :
?>


									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-ms-12 ">
											<div id="rel-post" <?php post_class(); ?>>
												<div id="related-post-thumb">
												<div class="post-thumbnail">
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
												</div>	
												<div class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
											</div>
										</div>
									</div>
	
								
						      
<?php
							}

						    // $post = $orig_post;  
						    // wp_reset_query();
						    wp_reset_postdata();
						    } ?>  
						 </div> 
						</div>

				<?php } else { ?>
			<?php } ?> 
<?php } ?> 



					<div class="post-commetns">
						<?php comments_template(); ?>
					</div>

					<?php endwhile; else: ?>


					<div id="posts" class="single-post blog-page">
						<section>
							<article>
								<p><?php _e('Sorry, no posts. ', 'dankov'); ?></p>
							</article>
						</section>
					</div>

					<?php endif; ?>				

				</article><!-- #post -->	

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