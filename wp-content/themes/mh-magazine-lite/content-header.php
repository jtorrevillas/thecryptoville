<div class="mh-header-mobile-nav mh-clearfix"></div>
<div class="mh-preheader">
    <div class="mh-container mh-container-inner mh-row clearfix">
        <div class="mh-header-bar-content mh-header-bar-top-left mh-col-2-3 clearfix">
            <nav class="mh-navigation mh-header-nav mh-header-nav-top clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                <div class="menu-header-container">
                    <ul id="menu-header" class="menu">
                    	<?php
                    		$nav_items = wp_get_nav_menu_items(193);
                    		foreach($nav_items as $item):
                    			?>
                    			<li class="menu-item"><a target="_blank" href="<?=$item->url ?>"><?=$item->post_title ?></a></li>
                    			<?php
                    		endforeach;
                    	?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="mh-header-bar-content mh-header-bar-top-right mh-col-1-3 clearfix">
            <nav class="mh-social-icons mh-social-nav mh-social-nav-top clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                <div class="menu-social-container">
                    <ul id="menu-social" class="menu">
                        <?php
                    		$nav_items = wp_get_nav_menu_items(194);
                    		$config = array(
                    			'Facebook' => array(
                    				'icon' => 'fa fa-facebook'
                    			),
                    			'Twitter' => array(
                    				'icon' => 'fa fa-twitter'
                    			),
                    			'Google Plus' => array(
                    				'icon' => 'fa fa-google-plus'
                    			),
                    			'Youtube' => array(
                    				'icon' => 'fa fa-youtube'
                    			),
                    		);
                    		foreach($nav_items as $item):
                    			?>
                    			<li class="menu-item">
                    				<a target="_blank" href="<?=$item->url ?>">
                    					<i class="fa <?=$config[$item->post_title]['icon'] ?>"></i>
                    					<span class="screen-reader-text"><?=$item->post_title ?></span>
                    				</a>
                    			</li>
                    			<?php
                    		endforeach;
                    	?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<header class="mh-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="mh-container mh-container-inner mh-row mh-clearfix">
		<?php mh_magazine_lite_custom_header(); ?>
	</div>
	<div class="mh-main-nav-wrap">
		<nav class="mh-navigation mh-main-nav mh-container mh-container-inner mh-clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
	</div>
	<div class="mh-dp-menu">
	</div>
</header>

<?php echo do_shortcode('[btc_ticker]'); ?>

