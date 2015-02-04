<?php global $data; ?>
<?php
	global $divide_counter, $content_class, $first_big_post_counter;
	$post_views = dankov_get_post_views($post->ID);
	$first_big_post = ($first_big_post_counter == 1) ? " first_big_post" : null;
	$oddEvenPostClass = null;
?>
		<?php
			$type_class = '';
			if(isset($data['post_type_layout'])) {
				if($data['post_type_layout'] == 1) {
					$type_class = 'standart-post';
				} 
				elseif($data['post_type_layout'] == 2) {
					$type_class = 'left-image-post';
				} 
				elseif ($data['post_type_layout'] == 3) {
					$type_class = 'two-colls-post';
					$oddEvenPostClass = ($divide_counter % 2 == 0) ? ' first' : ' last';
					if ($first_big_post_counter == 1) $oddEvenPostClass = null;
				}
			} 
		?>

		<?php  
			$animation_class = '';
			if(isset($data['animate_post'])) {
				if($data['animate_post'] == 1) {
					$animation_class = 'animate';
				}
			} 
		?>

		<?php if(is_single()) { ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class();?> >

			<?php } else  { ?>

					<?php if( has_post_thumbnail()) { ?>

						<article id="post-<?php the_ID();?>" <?php if($type_class != 'post-set $animation_class') { echo post_class("post-set $type_class $animation_class" . $first_big_post . $oddEvenPostClass); } ?>>

					
					<?php } else  { ?>

						<article id="post-<?php the_ID();?>" <?php if($type_class != 'post-set $animation_class') { echo post_class("post-set no-thumbnail $type_class $animation_class" . $first_big_post . $oddEvenPostClass); } ?>>

					<?php } ?>

		<?php } ?>


	<?php
		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$image_url = wp_get_attachment_url($thumbnail_id);		
 		


 			if(is_single()) {?>
					
			<div class="audio-content">
			<?php dankov_audio($post->ID); ?>
			</div>

				<h1 class="title">
					<?php the_title(); ?>
				</h1>
		
		<div class="post-content">
		<?php  
			global $more; 
			if(!is_single()) { $more = 0; }
			the_content(); ?> 
		</div>

			<?php }
			else { ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				
				<a class="paper-button btn-next audio"  href="<?php the_permalink(); ?>"></a>

				<h1 class="title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h1>

		<div class="post-content">
		<?php  
			global $more; 
			if(!is_single()) { $more = 0; }
			the_content(); ?> 
		</div>

			<?php } ?>

		<div class="entry-meta">

			<?php if(!is_single()) { ?>

				<ul>  
					<li><i class="icon-clock"></i> <span><?php echo get_the_date('F, j') ?></span></li>
					<li><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
					<li><i class="icon-folder"></i> <span><?php the_category(', '); ?></span></li>
					<li><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>">More</a></span></li>
				</ul>

			<?php } else { ?>
				
				<ul>  
					<li><i class="icon-music-tone-alt"></i> <span><?php _e('Audio', 'dankov'); ?></span></li>
					<li><i class="icon-user"></i> <span><?php the_author() ?></span></li>
					<li><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
					<li><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
					<li><i class="icon-bubble"></i> <span><?php comments_number ( 'No Comments', '1', '%' ); ?></span></li>
					<?php if ( has_tag() ) : ?>
						<li><i class="icon-tag"></i> <span><a href="<?php echo get_tag_link(1); ?>"><?php the_tags(''); ?></a></span></li>
					<?php endif; ?>
					<li><i class="icon-folder"></i> <span><a href="<?php echo get_category_link(1); ?>"><?php the_category(', '); ?></a></span></li>
				</ul>

			<?php } ?>

		</div>	
		<div class="clear"></div>
	</article><!-- #post -->