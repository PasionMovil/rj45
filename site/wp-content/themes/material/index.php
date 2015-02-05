<?php 
global $data;
$count = 0;
$sidebarOff = ( isset($data['blog_sidebar_position']) && $data['blog_sidebar_position'] != null ) ? $data['blog_sidebar_position'] : 'sidebar-right'; ?>
<?php get_header(); ?>

<div class="container ">
    <div class="row sticky-row resp-marg">

<?php
    $sticky = get_option( 'sticky_posts' );
    if (isset($sticky[0])) {
        // $sticky = array_reverse($sticky);
        $slider = array(
            'post__in' => $sticky,
            'ignore_sticky_posts' => true,
            'order' => 'DESC',
            // 'orderby' => 'post__in',
            'posts_per_page' => -1
        );
        $slider = new WP_Query($slider); // The query

if ($slider->have_posts()) :
                    
    while ($slider->have_posts()) :
        $slider->the_post();

        $link = get_permalink();
        $post_views = dankov_get_post_views($post->ID);

        $cat = get_the_category($post->ID);
        $cat = $cat[0];

        $format = get_post_format();
        if (!$format) $format = 'pencil';

        $excerpt = get_the_excerpt();
?>
<?php $count++; ?>
<?php if ($count == 1) : ?>
          
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 sticky-col sticky-marg phoenix-livetile meta-full">
                    <div class="tiles-wrapper">
                        <div <?php post_class( array("sticky-post-slider", "tile-content") ); ?>>
                            <div class="post-thumbnail"><a href="<?php echo $link; ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div>

<?php elseif ($count ==  2) : ?>
  
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 sticky-col sticky-marg phoenix-livetile meta-short">
                    <div class="tiles-wrapper">
                        <div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
                            <div class="post-thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>  
          
<?php elseif ($count == 3) : ?>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 sticky-col sticky-marg phoenix-livetile meta-short">
                    <div class="tiles-wrapper">
                        <div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
                            <div class="post-thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div>   

<?php elseif ($count == 4) : ?>

                <div class="col-lg-3 col-md-3 col-sm-6 col-sm-4 col-xs-6 sticky-col phoenix-livetile meta-short">
                    <div class="tiles-wrapper">
                        <div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
                            <div class="post-thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> 

<?php elseif ($count == 5) : ?>

                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-4 col-xs-6 sticky-col phoenix-livetile  meta-full">
                    <div class="tiles-wrapper">
                        <div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
                            <div class="post-thumbnail"><a href="<?php echo $link; ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

<?php elseif ($count == 6) : ?>

                <div class="col-lg-3 col-md-3 col-sm-6 col-sm-4 col-xs-6 sticky-col phoenix-livetile meta-short">
                    <div class="tiles-wrapper">
                        <div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
                            <div class="post-thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="shadow-slider">
                                <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                <div class="slider-excerpt"><?php echo $excerpt; ?></div>
                                <ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

<?php else : ?>

    			<div class="phoenix-livetile-extended hidden-livtile-el">
        			<div <?php post_class(array("sticky-post-slider", "tile-content")); ?>>
            			<div class="post-thumbnail"><a href="<?php echo $link; ?>"><?php the_post_thumbnail(); ?></a></div>
            				<div class="shadow-slider">
                				<div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                				<div class="slider-excerpt"><?php echo $excerpt; ?></div>
                				<ul class="slider-meta">
                                    <li class="slider-meta-view"><i class="icon-eye"></i> <span><?php echo $post_views; ?></span></li>
                                    <li class="slider-meta-category"><i class="icon-folder"></i> <span><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a></span></li>
                                    <li class="slider-meta-date"><i class="icon-clock"></i> <span><?php echo get_the_date('F j, Y') ?></span></li>
                                    <li class="slider-meta-more"><i class="icon-arrow-right"></i> <span><a href="<?php the_permalink() ?>"><?php _e('More', 'dankov'); ?></a></span></li>
                				</ul>
            				</div>
        				</div>
   				 	</div>

<?php endif; ?>
                    <?php endwhile; ?>  
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>    
                    <?php } ?>
</div></div>

<?php
// Carousel
wp_reset_query();
wp_reset_postdata();

global $data;

$add_carousel = isset($data['add_carousel']) ? $data['add_carousel'] : true;
$qty = isset($data['carousel_qty']) ? $data['carousel_qty'] : 10;

if ($add_carousel) :

    $carousel_args = array(
        "post_type" => "post",
        "posts_per_page" => $qty,
        "post_status" => array( 'publish', 'private' ),
        'meta_key' => 'dankov_post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'ignore_sticky_posts' => true
    );
    $carousel = new WP_Query($carousel_args);

    if ($carousel->have_posts()) :
    ?>
    <div class="under-slider-block">
        <div class="container">
            <div class="row">
            	<div class="col-lg-12">
                <div class="slider4">
<?php
                    while ($carousel->have_posts()) : 
                        $carousel->the_post();

                        $ID = get_the_id();
                        $title = get_the_title();
                        $thumb = null;
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($ID), 'medium', true );

                        if (has_post_thumbnail()) {
                            $thumb = $thumb[0];
                        } else {
                            $thumb = 'https://fakeimg.pl/135x85/?text=?&font=bebas';
                        }

                        $thumb = '<img src="'. $thumb .'" alt="'. $title .'" />';
?>
                    <div class="slide">
                        <div class="image-slider" style="width: 125px; height: 85px;"><a href="<?php the_permalink() ?>"><?php echo $thumb; ?></a></div>
                        <div class="title-slider"><a href="<?php the_permalink() ?>"><?php echo $title; ?></a></div>
                        <div class="meta-slider"><i class="icon-clock"></i> <span><?php echo get_the_date('F, j') ?></span></div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php endif; ?>
<?php endif; // Carousel END ?>


</div>
    <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-content <?php echo $sidebarOff; ?>">
                    <div class="wrap-content">
                        <div class="posts">

                            <?php
                                $divide_counter = 0;
                                $first_big_post_counter = 0;
                                $stickies = get_option('sticky_posts');
                                if( $stickies ) {
                                    $args = array( 'ignore_sticky_posts' => 1, 'post__not_in' => $stickies );
                                    global $wp_query;
                                    query_posts( array_merge($wp_query->query, $args) );
                                }
                            ?>
                                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                                <?php endif; ?>

                                    <?php 
                                        if (have_posts()) :  while (have_posts()) : the_post(); 

                                            if ($data['show_big_onepost'] == 1) {
                                                $first_big_post_counter++;
                                                $divide_counter++;
                                                get_template_part( 'format', get_post_format() );
                                            } else {
                                                $first_big_post_counter = 0;
                                                get_template_part( 'format', get_post_format() );
                                                $divide_counter++;
                                            }

                                            endwhile;
                                        
                                        if ( function_exists('wp_pagenavi') ) {?>

                                            <div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div>

                                        <?php } else { ?>

                                            <div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'dankov' ) ); previous_posts_link( __( 'Newer posts', 'dankov' ) ); ?></div>
                                        
                                        <?php }

                                        endif;  
                                    ?>


                                </div><!-- #post -->        

                        </div>

                    </div><!-- #content -->

                <?php
                    if ($sidebarOff != 'sidebar-no') {
                        echo '<div class="percent-sidebar">';
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
                        echo '</div>';
                    }
                ?>
                
        </div>
    </div>
<?php get_footer(); ?>
