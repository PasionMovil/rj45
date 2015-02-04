<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="forum-php">

			<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
 		
		<?php endwhile; // end of the loop. ?>

				</div>
			</div><!-- #content -->

		

</div></div>
<?php get_footer(); ?>