<?php mh_before_footer(); ?>

<!-- custom footer - jeevon -->
<footer class="mh-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="mh-container mh-container-inner mh-footer-widgets mh-row mh-clearfix">
		<?php mh_magazine_lite_footer_widgets(); ?>

		<div class="mh-col-3-4 mh-home-wide mh-footer-area mh-footer-2">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</div>
	</div>
</footer>



<div class="mh-copyright-wrap">
	<div class="mh-container mh-container-inner mh-clearfix">
		<p class="mh-copyright"><?php printf(esc_html__('Copyright &copy; %1$s | %2$s', 'mh-magazine-lite'), date("Y"), '<a href="' . esc_url('https://www.ibinex.com/') . '" rel="nofollow">An Ibinex Company</a>'); ?></p>
	</div>
</div>
<?php mh_after_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>