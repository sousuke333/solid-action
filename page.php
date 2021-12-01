<?php
/**
 * The template for displaying all pages
 * 全ページを表示するためのテンプレート
 *
 * This is the template that displays all pages by default.
 * これは、デフォルトですべてのページを表示するテンプレートです。
 * 
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * これは、デフォルトですべてのページを表示するテンプレートです。
 * あなたのWordPressサイトの他の「ページ」は、別のテンプレートを使用しているかもしれません。
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();