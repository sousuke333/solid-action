<?php
/**
 * Template part for displaying a message that posts cannot be found
 * 投稿が見つからない旨のメッセージを表示するテンプレートパーツ
 * 投稿ページで投稿がありませんでしたなどの部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Solid_Action
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'solid-action' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					/* 1: WP管理画面の新規投稿ページへのリンクを翻訳しています。*/
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'solid-action' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'solid-action' ); ?>
        </p>
        <?php
			get_search_form();

		else :
			?>

        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'solid-action' ); ?>
        </p>
        <?php
			get_search_form();

		endif;
		?>
    </div><!-- .page-content -->
</section><!-- .no-results -->