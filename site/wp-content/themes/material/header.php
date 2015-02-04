<?php global $data;?>
<!DOCTYPE html>
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if(!empty($data['favicon']['url'])) { ?><link rel="icon" type="image/png" href="<?php echo esc_url($data['favicon']['url']); ?>" /><?php } ?>			
<?php if(!empty($data['favicon_retina_ipad']['url'])) { ?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url($data['favicon_retina_ipad']['url']); ?>" /><?php } ?>	
<?php if(!empty($data['favicon_retina_iphone']['url'])) { ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($data['favicon_retina_iphone']['url']); ?>" /><?php } ?>	
<?php if(!empty($data['favicon_ipad']['url'])) { ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($data['favicon_ipad']['url']); ?>" /><?php } ?>	
<?php if(!empty($data['favicon_iphone']['url'])) { ?><link rel="apple-touch-icon" href="<?php echo esc_url($data['favicon_iphone']['url']); ?>" /><?php } ?>	
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php theme_custom_background(); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php { ?> 
	<?php if(isset($data['boxed_swtich']))  { ?>
		<?php if($data['boxed_swtich'] == 1)  { ?>
			<div class="wrapper">
			<?php } else  { ?>
			<div class="wrapper boxed">
		<?php } ?>
	<?php } ?> 
<?php } ?> 	
	<div class="top-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 hidden-sm">
					<div class="menu-top">
						<nav id="top-navigation">
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id' => 'top-nav',
							'menu_class' => 'sf-menu',
							'sort_column' => 'menu_order',
							'fallback_cb' => ''
						)); ?>

						</nav>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 par">
					<?php if(isset($data['switch_social']) && ($data['switch_social'] != 0)) { ?>
						<div class="icons-social">
							<?php
								$social_links = array('facebook', 'twitter', 'youtube', 'dropbox', 'rss', 'googleplus', 'linkedin', 'flickr', 'tumblr', 'foursquare', 'apple', 'android', 'vk', 'windows', 'behance', 'dribbble', 'delicious', 'pinterest', 'instagram', 'skype', 'github', 'vimeo');
								if($social_links) {
								foreach($social_links as $social_link) {
									if(!empty($data[$social_link])) { echo '<a href="'. esc_url($data[$social_link]) .'" title="'. $social_link .'" id="icon-'.$social_link.'"  target="_blank"></a>';
									}
								}
							}
							?>
						</div>
					<?php } ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-xs pal">
			        <div class="head-search">
						<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" value="" name="s" placeholder="<?php _e('Search', 'dankov' ) ?>">
							<span><input type="submit" id="searchsubmit_search" value=""></span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
					<?php if(isset($data['custom_logo']['url']) && ($data['custom_logo']['url'] !='')) { ?>
						<div class="logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo $data['custom_logo']['url']; ?>" data-at2x="<?php echo $data['custom_retina_logo']['url']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a></div>
					<?php } 
					else { ?>			
						<div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" data-at2x="<?php echo $data['custom_retina_logo']['url']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a></div>
					<?php } ?>	
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="banner-area">
						<?php if(isset($data['banner_area']) && ($data['banner_area'] !='')) { ?>
							<?php echo wp_kses_post($data['banner_area']);  ?>
							<?php } else { ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-wrapper">
		<?php { ?> 
			<?php if(isset($data['use_sticky']))  { ?>
				<?php if($data['use_sticky'] == 2)  { ?>
					<div class="menu non-sticky">
				<?php } else  { ?>
					<div class="menu">
				<?php } ?>
			<?php } ?> 
		<?php } ?> 			
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<nav id="navigation">

									<div id="dl-menu" class="dl-menuwrapper">
										<a class="nav-btn dl-trigger"><i class="fa fa-bars"></i></a>
										<?php wp_nav_menu( array(
											'theme_location' => 'top_menu',
											'container' => false,
											'menu_id' => 'main-nav',
											'menu_class' => 'sf-menu dl-menu',
											'sort_column' => 'menu_order',
											'fallback_cb' => ''
										)); ?>
									</div>
								</nav>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<div class="content">