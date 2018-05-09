<?php mh_before_footer(); ?>
<!-- <?php mh_magazine_lite_footer_widgets(); ?> -->

<!-- custom footer - jeevon -->
<footer class="mh-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="mh-container mh-container-inner mh-footer-widgets mh-row mh-clearfix">
		<div class="mh-col-1-4 mh-home-wide  mh-footer-area mh-footer-1">
			<div id="mh_footer_about-2" class="mh-footer-widget mh_footer_about">
				<div class="mh-author-bio-widget">
					<h4 class="mh-author-bio-title">About Us</h4>
					<figure class="mh-author-bio-avatar mh-author-bio-image-frame">
						<a href="https://demo.mhthemes.com/magazine4/author/mh-themes/"> 
							<img src="http://localhost/thecryptoville/wp-content/uploads/2018/05/CRYPTOVILLE-3-2.jpg" width="120" height="120" alt="MH Themes" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 alignnone photo"> </a>
					</figure>
					<div class="mh-author-bio-text">This is something new.</div>
				</div>
			</div>
		</div>

		<div class="mh-col-3-4 mh-home-wide mh-footer-area mh-footer-2">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</div>
	</div>
</footer>



<div class="mh-copyright-wrap">
	<div class="mh-container mh-container-inner mh-clearfix">
		<p class="mh-copyright"><?php printf(esc_html__('Copyright &copy; %1$s | WordPress Theme by %2$s', 'mh-magazine-lite'), date("Y"), '<a href="' . esc_url('https://www.mhthemes.com/') . '" rel="nofollow">MH Themes</a>'); ?></p>
	</div>
</div>
<?php mh_after_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>