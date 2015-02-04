<?php $sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">
				<div class="wrap-content">
					<article id="post-0" class="post error404 no-results not-found">
						<header class="search-header">
							<h3 class="search-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'dankov' ); ?></h3>
						</header>

						<div class="search-content">
							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dankov' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

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