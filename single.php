<?php
/**
 * The template for displaying all single posts
 * すべての単一記事を表示するためのテンプレート
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Solid_Action
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



get_header();
?>

<main id="primary" class="site-main">

    <?php
		while ( have_posts() ) :
			the_post();
			//テンプレートパーツをページの投稿タイプを判断して呼び出し
			get_template_part( 'template-parts/content', get_post_type() );
			//ページネーション
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'solid-action' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'solid-action' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			// コメントが募集されている場合や、少なくとも1件のコメントがある場合は、コメントテンプレートを読み込みます。
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();