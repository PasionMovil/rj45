<?php
/**
 * Twitter Widget Class
 */

class AWESOME_Twitter_Widget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::WP_Widget( false, 'Awesome - Twitter' );
    }

    function widget( $args, $instance )
    {
        extract($args);

        global $cb;

        $title = apply_filters('AWESOME_Twitter_Widget', $instance['titletweets'] );
        $username = ($instance['twitter_username']) ?  $instance['twitter_username'] : '';
        $number = isset($instance['show_num']) ? $instance['show_num'] : '';
        $head = '';

        if($title && $title != '') $head = '<h3>' . $title . '</h3>';

        echo $args['before_widget'];
            echo $head;

            echo '<div class="block_recent_tweets">';

            $tweets = $this->get_tweets( $args['widget_id'], $instance );

            if( !empty( $tweets['tweets'] ) AND empty( $tweets['tweets']->errors ) ) {

                $user = current( $tweets['tweets'] );
                $user = $user->user;

                echo '<ul class="tweet_list">';

                foreach( $tweets['tweets'] as $tweet ) {
                    if( is_object( $tweet ) ) {
                        $tweet_text = htmlentities($tweet->text, ENT_QUOTES, 'UTF-8');
                        $tweet_text = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $tweet_text );

                        echo '
                            <li>
                                <span class="content">' . $tweet_text . '</span>
                            </li>';
                    }
                }
                echo '</ul>';
                echo '</div>';

            } elseif ($tweets['tweets']->errors) {
                echo 'Authentication failed! Please check your Twitter app data.';
            } elseif (!$tweets['tweets']) {
                echo 'There\'s no tweets there =)';
            }

        echo $args['after_widget'];

    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['titletweets'] = strip_tags( $new_instance['titletweets'] );
        $instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
        $instance['show_num'] = strip_tags( $new_instance['show_num'] );

        return $instance;
    }

    function form( $instance )
    {
        $title = isset($instance['titletweets']) ? $instance['titletweets'] : '';
        $user = isset($instance['twitter_username']) ? $instance['twitter_username'] : '';
        $number = isset($instance['show_num']) ? $instance['show_num'] : '';
        
          ?>
            <p><label for="<?php echo $this->get_field_id( 'titletweets' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'titletweets' ); ?>" name="<?php echo $this->get_field_name( 'titletweets' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
          <p><label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>">Twitter Username:</label><input class="widefat" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" type="text" value="<?php echo $user; ?>" /></p>
          <p><label for="<?php echo $this->get_field_id( 'show_num' ); ?>">Tweets to Show:</label> 
          <select class="widefat" id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>">
        <?php
            for ( $i = 0; $i <= 10; $i++){
                echo ' <option ';
                if ( $number == $i){echo 'selected="selected"';}
                echo ' value="'. $i .'">' . $i .'</option>';
            }
?>       
        </select></p>
<?php
    }

    function retrieve_tweets( $widget_id, $instance )
    {
        global $cb;
        $timeline = $cb->statuses_userTimeline( 'screen_name=' . $instance['twitter_username']. '&count=' . $instance['show_num'] . '&exclude_replies=true' );
        return $timeline;
    }

    function save_tweets( $widget_id, $instance )
    {
        $timeline = $this->retrieve_tweets( $widget_id, $instance );
        $tweets = array( 'tweets' => $timeline, 'update_time' => time() + ( 60 * 1 ) );
        update_option( 'awesome_tweets_' . $widget_id, $tweets );
        return $tweets;
    }

    function get_tweets( $widget_id, $instance )
    {
        $tweets = get_option( 'awesome_tweets_' . $widget_id );
        if( empty( $tweets ) OR time() > $tweets['update_time'] ) {
            $tweets = $this->save_tweets( $widget_id, $instance );
        }
        return $tweets;
    }   

}
    
?>