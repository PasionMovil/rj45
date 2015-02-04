<?php
    /**
     * Posts by Comments Widget Class
     */
    class Dankov_Posts_by_Comments extends WP_Widget {

        function __construct() {
            // Instantiate the parent object
            parent::WP_Widget( false,  "Awesome - Popular Posts by Comments");

        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters('Dankov_Posts_by_Comments', $instance['title'] );
            $head = '';
            
            if($title && $title != '') $head = '<h3 class="widget-title">' . $title . '</h3>';

            // global $post;

            // $num = $instance['num_to_show'];
            // if ($num == 0) $num = 3;

            // $popular_posts = new WP_Query(
            //     array(
            //         'post_type' => 'post',
            //         'post_status' => array( 'publish', 'private' ),
            //         'posts_per_page' => $num,
            //         'orderby' => 'comment_count',
            //         'order' => 'DESC'
            //     )
            // );

            global $wpdb;

            $num = $instance['num_to_show'];
            if ($num == 0) $num = 3;

            $popular_posts = $wpdb->get_results("
                SELECT SQL_CALC_FOUND_ROWS  ".$wpdb->posts.".ID FROM ".$wpdb->posts."  WHERE 1=1  AND ".$wpdb->posts.".post_type = 'post' AND ((".$wpdb->posts.".post_status = 'publish' OR ".$wpdb->posts.".post_status = 'private'))  ORDER BY ".$wpdb->posts.".comment_count DESC LIMIT 0, $num
            ");

            $pp_IDs = array();
            foreach ($popular_posts as $id) {
                 $pp_IDs[] = $id->ID;
            }
            
            echo $before_widget . "\n";
                echo '<div class="posts-by-vies-widget">';
                echo $head . "\n";
                echo "<ul>\n";

            foreach ($pp_IDs as $postID) {
                $queried_post = get_post($postID);
?>
                <li>
                    <div class="dankov_image_wrapper">
                        <?php echo get_the_post_thumbnail($postID); ?>
                    </div>
                    <div class="dankov_post_content">
                        <h3><a href="<?php echo get_permalink($postID); ?>"><?php echo $queried_post->post_title; ?></a></h3>
                    </div>
                    <div class="dankov_post_meta">
                        <i class="icon-bubble"></i> <span><?php echo wp_count_comments($postID)->approved; ?> comments</span>
                    </div>
                </li>
<?php
            }
            
            wp_reset_postdata();

            echo '</ul></div>' . $args['after_widget'] . "\n";
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

    add_action('widgets_init', create_function('', 'return register_widget("Dankov_Posts_by_Comments");'));