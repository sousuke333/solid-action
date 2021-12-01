<?php
/**
 * The main template file
 * メインのテンプレートファイル
 *
 * This is the most generic template file in a WordPress theme
 * これは、WordPressテーマの中で最も一般的なテンプレートファイルです。
 * 
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * そして、テーマに必要な2つのファイルのうちの1つです（もう1つは style.css）。
 * 具体的には、クエリにマッチするものがない場合に、ページを表示するために使用します。
 * 例：home.phpファイルが存在しない場合、ホームページを作成する。
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
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
    <header>
        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
    </header>
    <?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * コンテンツのPost-Type固有のテンプレートを含める。
				 * 
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 * 子テーマでこれを上書きしたい場合は、content-___.phpというファイルをインクルードしてください。
				 * content-___.php（__はポストタイプ名）をインクルードすると、それが代わりに使用されます。
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();