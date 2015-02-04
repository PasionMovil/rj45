<?php

/*
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
*/

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /*

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

        */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /*

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'dankov'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'dankov'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /*

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /*

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /*
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'dankov'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'dankov'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'dankov'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'dankov') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'dankov'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

// GENERAL SETTINGS
            $this->sections[] = array(
                'title'     => __('General', 'dankov'),
                //'desc'      => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'dankov'),
                'icon'      => 'el-icon-wrench',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Upload Favicon', 'dankov'),
                        'subtitle'  => __('Upload a 16px x 16px png/gif/ico icon', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/favicon.ico')                                     
                    ),

                    array(
                        'id'        => 'favicon_iphone',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Apple iPhone Icon', 'dankov'),
                        'subtitle'  => __('Upload a 57px x 57px png/gif/ico icon for Classic iPhone', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/57.png'),              
                    ),

                    array(
                        'id'        => 'favicon_retina_iphone',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Apple iPhone Retina Icon', 'dankov'),
                        'subtitle'  => __('Upload a 114px x 114px png/gif/ico icon for Retina iPhone', 'dankov'),    
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/114.png'),              
                    ),

                    array(
                        'id'        => 'favicon_ipad',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Apple iPad Icon', 'dankov'),
                        'subtitle'  => __('Upload a 72px x 72px png/gif/ico icon for Classic iPad', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/72.png'),                
                    ),

                    array(
                        'id'        => 'favicon_retina_ipad',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Apple iPad Retina Icon', 'dankov'),
                        'subtitle'  => __('Upload a 144px x 144px png/gif/ico icon for Retina iPad', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/144.png'),                
                    ),

                    array(
                        'id'        => 'boxed_swtich',
                        'type'      => 'button_set',
                        'title'     => __('Layout Style', 'dankov'),
                        'subtitle'  => __('Choose boxed or full page mode', 'dankov'),
                        'options'   => array(
                            '1' => 'Full page', 
                            '2' => "Boxed"
                        ), 
                        'default'   => '1'
                    ),

                    array(
                        'id'=> 'boxed_background',
                        'type'     => 'background',
                        'title'    => __('Body Background', 'redux-framework-demo'),
                        'subtitle' => __('Body background with image, color, etc.', 'redux-framework-demo'),
                        'desc'     => __('Will be used if you choose a boxed layout.', 'redux-framework-demo'),
                        'default'  => array(
                            // 'background-color' => '#1e73be',
                        ),
                        'required' => array('boxed_swtich','equals','2')
                    ),

                    array(
                        'id'        => 'custom_color_scheme',
                        'type'      => 'color',
                        'title'     => __('Firtst Custom Color', 'dankov'),
                        'subtitle'  => __('You can define a new custom color for the theme  scheme.', 'dankov'),
                        'default'   => '#444444',
                        'transparent' => false,
                       'validate'  => 'color',
                    ),

                    array(
                       'id'        => 'custom_color_scheme_two',
                        'type'      => 'color',
                        'title'     => __('Second Custom Color', 'dankov'),
                        'subtitle'  => __('You can define a new custom color for the theme scheme.', 'dankov'),
                        'default'   => '#03a9f4',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),

                    array(
                        'id'        => 'analytics_switch',
                        'type'      => 'switch',
                        'title'     => __('Google Analytics Tracking Code', 'dankov'),
                        'subtitle'  => __('Enable/Disable Google Analytics for your website. If you enable it, just add your Google Analytics Property ID into the textfield to track your site`s activity.', 'dankov'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),
                    array(
                        'id'        => 'ga_id',
                        'type'      => 'text',
                        'required'  => array('analytics_switch', '=', '1'),
                        'title'     => __('Google Analytics Property ID', 'dankov'),
                        'subtitle'  => __('Place here Google Analytics Propery ID. It should look like `UA-XXXXX-X` and you should find it inside your Google Analytics Dashboard.', 'dankov')
                    ),
                ),
            );

 // HEADER SETTINGS
            $this->sections[] = array(
                'title'     => __('Header', 'dankov'),
                'icon'      => 'el-icon-website',
                'fields'    => array(

                    array(
                        'id'        => 'custom_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Logo', 'dankov'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload your logo.', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/logo.png')                  
                    ),

                    array(
                        'id'        => 'custom_retina_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Retina Logo', 'dankov'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload your retina logo.', 'dankov'),
                        'default'   => array('url' => get_template_directory_uri() . '/assets/images/logo@2x.png')                  
                    ),

                     array(
                        'id'        => 'use_sticky',
                        'type'      => 'button_set',
                        'title'     => __('Use sticky menu?', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Use', 
                            '2' => "Don't Use"
                        ), 
                        'default'   => '1'
                    ),

                    array(
                        'id'        => 'banner_area',
                        'type'      => 'editor',
                        'title'     => __('Banner Area in Header', 'dankov'),
                        'subtitle'  => __('Place here your banner code ( banner will be showing in the header ) .', 'dankov'),
                        'default'   => '<img alt="" src="http://wordpress.dankov-theme.com/material/wp-content/themes/material/assets/images/head-banner.png">',
                    ),
                    ),

            );

// BLOG SETTINGS
            $this->sections[] = array(
                'title'     => __('Blog', 'dankov'),
                'icon'      => 'el-icon-align-right',
                'fields'    => array(


                    array(
                        'id'        => 'post_type_layout',
                        'type'      => 'button_set',
                        'title'     => __('Select template for blog.', 'dankov'),
                        'subtitle'  => __('Select template for blog post.', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Standard Post', 
                            '2' => 'Left Image Post',
                            '3' => 'Two Columns Post'
                        ), 
                        'default'   => '2'
                    ),

                    array(
                        'id'        => 'show_big_onepost',
                        'type'      => 'button_set',
                        'title'     => __('Full width first post', 'dankov'),
                        'subtitle'  => __('Show big first post in blogroll', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'On',
                            '0' => "Off"
                        ), 
                        'default'   => '1',
                        'required' => array('post_type_layout','greater', '1')
                    ),

                    array(
                        'id'        => 'add_carousel',
                        'type'      => 'switch',
                        'title'     => __('Enable Carousel', 'dankov'),
                        'subtitle'  => __('Enable/Disable Carousel.', 'dankov'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),

                    array(
                        'id'       => 'carousel_qty',
                        'type'     => 'spinner', 
                        'title'    => __('Carousel posts quantity', 'dankov'),
                        // 'subtitle' => __('How many portfolio items will be shown on portfolio single page.','dankov'),
                        'desc'     => null,
                        'default'  => '10',
                        'min'      => '5',
                        'step'     => '1',
                        'max'      => '50',
                    ),
                    


                    array(
                        'id'        => 'post_thumb_set',
                        'type'      => 'button_set',
                        'title'     => __('Show featured image', 'dankov'),
                        'subtitle'  => __('Show thumbnail in single     post', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Show', 
                            '2' => "Don't Show"
                        ), 
                        'default'   => '1'
                    ),

                    array(
                        'id'        => 'animate_post',
                        'type'      => 'button_set',
                        'title'     => __('Use post animation?', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Use', 
                            '2' => "Don't Use"
                        ), 
                        'default'   => '1'
                    ),

                    array(
                        'id'        => 'blog_sidebar_position',
                        'type'      => 'image_select',
                        'title'     => __('Sidebar зosition', 'dankov'),
                        'subtitle'  => __('Select a sidebar position for all pages.', 'dankov'),
                        'options'   => array(
                            'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            'sidebar-no' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                        ),
                        'default'   => 'sidebar-right'
                    ),  

                    array(
                        'id'        => 'show_related_post',
                        'type'      => 'button_set',
                        'title'     => __('Show related posts', 'dankov'),
                        'subtitle'  => __('Show related posts in single post', 'dankov'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Show', 
                            '2' => "Don't Show"
                        ), 
                        'default'   => '1'
                    ),

                    ),
            );

// FOOTER SETTINGS
            $this->sections[] = array(
                'title'     => __('Footer', 'dankov'),
                'icon'      => 'el-icon-minus',
                'fields'    => array(

                    array(
                        'id'        => 'copyright_text',
                        'type'      => 'editor',
                        'title'     => __('Copytight Text', 'dankov'),
                        'subtitle'  => __('Place here your copyright. For ex: Copyright 2014 | My website.', 'dankov'),
                        'default'   => 'Copyright 2014. All Rights Reserved',
                    ),

                    array(
                        'id'        => 'display_by_text',
                        'type'      => 'button_set',
                        'title'     => __('Display "By Who" text?', 'dankov'),
                        'options'   => array(
                            '1' => 'Display', 
                            '2' => "Don't Display"
                        ), 
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'by_text',
                        'type'      => 'editor',
                        'required'  => array('display_by_text', '=', '1'),
                        'title'     => __('By who', 'dankov'),
                        'subtitle'  => __('Place here your text. For ex: Design by Dankov.', 'dankov'),
                        'default'   => 'Design by <a href="http://themeforest.net/user/Dankov" target="_blank">Dankov</a>. Based on Material Design',
                    ),

                    ),
            );

// SOCIAL SETTINGS
            $this->sections[] = array(
                'icon'      => 'el-icon-network',
                'title'     => __('Social', 'dankov'),
                'fields'    => array(

                    array(
                        'id'        => 'switch_social',
                        'type'      => 'switch',
                        'title'     => __('Social Icons', 'dankov'),
                        'subtitle'  => __('Enable/Disable social icons.', 'dankov'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),  

                    array(
                        'id'        => 'facebook',
                        'type'      => 'text',
                        'title'     => __('Facebook URL', 'dankov'),
                        'default'   => 'http://facebook.com'
                    ),  
                    array(
                        'id'        => 'twitter',
                        'type'      => 'text',
                        'title'     => __('Twitter URL', 'dankov'),
                        'default'   => 'http://twitter.com'
                    ),
                    array(
                        'id'        => 'youtube',
                        'type'      => 'text',
                        'title'     => __('Youtube URL', 'dankov'),
                        'default'   => 'http://youtube.com'
                    ), 
                    array(
                        'id'        => 'dropbox',
                        'type'      => 'text',
                        'title'     => __('Dropbox URL', 'dankov'),
                        'default'   => 'http://dropbox.com'
                    ),   
                    array(
                        'id'        => 'googleplus',
                        'type'      => 'text',
                        'title'     => __('Google Plus URL', 'dankov'),
                    ),
                    array(
                        'id'        => 'linkedin',
                        'type'      => 'text',
                        'title'     => __('Linkedin URL', 'dankov'),
                    ),

                    array(
                        'id'        => 'flickr',
                        'type'      => 'text',
                        'title'     => __('Flickr URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'tumblr',
                        'type'      => 'text',
                        'title'     => __('Tumblr URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'foursquare',
                        'type'      => 'text',
                        'title'     => __('Foursquare URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'apple',
                        'type'      => 'text',
                        'title'     => __('Apple URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'android',
                        'type'      => 'text',
                        'title'     => __('Android URL', 'dankov'),
                    ),  
                    array(
                        'id'        => 'vk',
                        'type'      => 'text',
                        'title'     => __('Vk URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'windows',
                        'type'      => 'text',
                        'title'     => __('Windows URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'behance',
                        'type'      => 'text',
                        'title'     => __('Behance URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'dribbble',
                        'type'      => 'text',
                        'title'     => __('Dribbble URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'delicious',
                        'type'      => 'text',
                        'title'     => __('Delicious URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'pinterest',
                        'type'      => 'text',
                        'title'     => __('Pinterest URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'instagram',
                        'type'      => 'text',
                        'title'     => __('Instagram URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'skype',
                        'type'      => 'text',
                        'title'     => __('Skype URL', 'dankov'),
                    ), 
                     array(
                        'id'        => 'github',
                        'type'      => 'text',
                        'title'     => __('GitHub URL', 'dankov'),
                    ), 
                      array(
                        'id'        => 'vimeo',
                        'type'      => 'text',
                        'title'     => __('Vimeo URL', 'dankov'),
                    ), 
                    array(
                        'id'        => 'rss',
                        'type'      => 'text',
                        'title'     => __('RSS Feed', 'dankov'),
                        'default'   => 'http://rss.com'
                    ),                                                                                                                                                                         
               )
            ); 


// OTHER SETTINGS
            $this->sections[] = array(
                'title'     => __('Other', 'dankov'),
                'icon'      => ' el-icon-puzzle',
                'fields'    => array(

                    array(
                        'id'        => 'display_comment',
                        'type'      => 'button_set',
                        'title'     => __('Show comments in Page', 'dankov'),
                        'options'   => array(
                            '1' => 'Display', 
                            '2' => "Don't Display"
                        ), 
                        'default'   => '2'
                    ),
                    array(
                        'id'        => 'id_custom_css',
                        'type'      => 'textarea',
                        'title'     => __('Custom CSS', 'dankov'),
                        'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'dankov'),
                        'desc'      => __('This field is even CSS validated', 'dankov'),
                        'validate'  => 'css',
                    ),                 
                ),
            );

// IMPORT/EXPORT SETTINGS
            $this->sections[] = array(
                'title'     => __('Import / Export', 'dankov'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'dankov'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'dankov'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'dankov')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'dankov'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'dankov')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'dankov');
        }

        /*

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Options', 'dankov'),
                'page_title'        => __('Options', 'dankov'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/profile.php?id=100002027286999',
                'title' => 'Like me on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/DankovTheme',
                'title' => 'Follow me on Twitter',
                'icon'  => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'dankov');
            }
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/*
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/*
  Custom function for the callback validation referenced above
 */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
