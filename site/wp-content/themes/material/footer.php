<?php global $data;?>
	<footer class="footer">
		<div class="footer-area-cont">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="footer-widget">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<div class="footer-area">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							<?php else: ?>	
							<div class="footer-area">
								<h3 class="widget-title">Footer Sidebar 1</h3>
									<div class="textwidget">Insert your widget on "Footer widget 1" sidebar in Apperrance > Widgets</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="footer-widget">
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<div class="footer-area">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							<?php else: ?>	
							<div class="footer-area">
								<h3 class="widget-title">Footer Sidebar 2</h3>
									<div class="textwidget">Insert your widget on "Footer widget 2" sidebar in Apperrance > Widgets</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="footer-widget">
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<div class="footer-area">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							<?php else: ?>	
							<div class="footer-area">
								<h3 class="widget-title">Footer Sidebar 3</h3>
									<div class="textwidget">Insert your widget on "Footer widget 3" sidebar in Apperrance > Widgets</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="copyright-info">
							<?php if(isset($data['copyright_text']) && ($data['copyright_text'] !='')) { ?>
							<p><?php echo wp_kses_post($data['copyright_text']);  ?></p>
							<?php } else { ?>
							<p><?php _e('Copyright 2014. All Rights Reserved', 'dankov'); ?></p>
							<?php } ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<?php { ?> 
						<?php if(isset($data['display_by_text']))  { ?>
							<?php if($data['display_by_text'] == 1)  { ?>
									
								<div class="developer-info">
									<?php if(isset($data['by_text']) && ($data['by_text'] !='')) { ?>
									<?php echo wp_kses_post($data['by_text']);  ?>
									<?php } else { ?>
									<?php } ?>						
								</div>

							<?php } ?> 
					<?php } ?> 
					<?php } ?> 
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>