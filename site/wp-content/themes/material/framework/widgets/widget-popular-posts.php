<?php
    /**
     * Posts by Views Widget Class
     */
    class Dankov_Posts_by_Views extends WP_Widget {

        function __construct() {
            // Instantiate the parent object
            parent::WP_Widget( false,  "Awesome - Popular Post");

        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters('Dankov_Posts_by_Views', $instance['title'] );
            $head = '';
            
            if($title && $title != '') $head = '<h3 class="widget-title">' . $title . '</h3>';

            global $wpdb;

            $num = $instance['num_to_show'];
            if ($num == 0) $num = 3;

            $popular_posts = $wpdb->get_results("
                SELECT SQL_CALC_FOUND_ROWS  ".$wpdb->posts.".ID FROM ".$wpdb->posts."  INNER JOIN ".$wpdb->postmeta." ON (".$wpdb->posts.".ID = ".$wpdb->postmeta.".post_id) WHERE 1=1  AND ".$wpdb->posts.".post_type = 'post' AND (".$wpdb->posts.".post_status = 'publish' OR ".$wpdb->posts.".post_status = 'private') AND (".$wpdb->postmeta.".meta_key = 'dankov_post_views_count' ) GROUP BY ".$wpdb->posts.".ID ORDER BY ".$wpdb->postmeta.".meta_value+0 DESC LIMIT 0, $num
            ");

            $pp_IDs = array();
            foreach ($popular_posts as $id) {
                 $pp_IDs[] = $id->ID;
            }
            
            echo $before_widget;
                echo '<div class="posts-by-vies-widget">';
                echo $head;
                echo "<ul>";

            foreach ($pp_IDs as $postID) {
                $queried_post = get_post($postID);
?>
                <li>
                    <div class="dankov_image_wrapper ">
                        <?php echo get_the_post_thumbnail($postID); ?>
                    </div>
                    <div class="dankov_post_content">
                        <a href='<?php get_permalink($postID); ?>'><?php echo $queried_post->post_title; ?></a>
                    </div>
                    <div class="dankov_post_meta">
                        <i class="icon-eye"></i> <span><?php echo dankov_get_post_views($postID); ?> views</span>
                    </div>
                </li>
<?php
            }
            
            wp_reset_postdata();

            echo '</ul>' . $args['after_widget'];
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['num_to_show'] = strip_tags($new_instance['num_to_show']);
            
            return $instance;
        }

        function form( $instance ) {
            $title = isset($instance['title']) ? $instance['title'] : '';
            $num_to_show = isset($instance['num_to_show']) ? $instance['num_to_show'] : '';

              ?>            
              <p><label>Title: <input name="<?php echo $this->get_field_name('title'); ?>"
            type="text" value="<?php echo $title; ?>" /></label></p>
              </p>
              <p><label># of posts to show:</label> 
              <select name="<?php echo $this->get_field_name('num_to_show'); ?>">
            <?php
                for ( $i = 0; $i <= 8; $i++){
                    echo ' <option ';
                    if ($num_to_show == $i){echo 'selected="selected"';}
                    echo ' value="'. $i .'">' . $i .'</option>';
                }
            ?>       
            </select></p>
              <?php
        }
    }

    add_action('widgets_init', create_function('', 'return register_widget("Dankov_Posts_by_Views");')); 

?>