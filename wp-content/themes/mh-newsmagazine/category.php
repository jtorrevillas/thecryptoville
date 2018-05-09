<?php
get_header();
$slug = get_category( get_query_var( 'cat' ) )->slug;
$page = get_posts(
    array(
        'name'      => $slug,
        'post_type' => 'page'
    )
);
$content = $page[0]->post_content;
?>
<div class="mh-wrapper mh-clearfix">
	<div id="main-content" class="mh-loop mh-content" role="main"><?php
		mh_before_page_content();
		if (have_posts()) { ?>
			<nav class="mh-breadcrumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) 
				{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</nav>
			<header class="page-header"><?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				if (is_author()) {
					mh_magazine_lite_author_box();
				} else {
					the_archive_description('<div class="entry-content mh-loop-description">', '</div>');
				} ?>
			</header>
			<div class="entry-content mh-loop-description" style="margin-bottom: 28px;">
				<?=$content ?>
			</div>
			<?php
			mh_magazine_lite_loop_layout();
			mh_magazine_lite_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>