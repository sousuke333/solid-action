<?php
/**
 * Solid Action functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Solid_Action
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
	      // 直接アクセスした場合は終了します。
}



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	// リリースごとにテーマのバージョン番号を入れ替えます。
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'solid_action_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * テーマのデフォルトを設定し、WordPressの様々な機能のサポートを登録します。
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 * この関数は、initフックの前に実行されるafter_setup_themeフックにフックされていることに注意してください.
	 * initフックは、サムネイルのサポートを示すなど、いくつかの機能には遅すぎます。
	 */
	function solid_action_setup() {
		/*
		 * Make theme available for translation.
		 * テーマを翻訳可能にする。
		 * Translations can be filed in the /languages/ directory.
		 * 翻訳は、/languages/ ディレクトリにファイルすることができます。
		 * If you're building a theme based on Solid Action, use a find and replace
		 * to change 'solid-action' to the name of your theme in all the template files.
		 * Solid Actionをベースにしたテーマを構築している場合は、すべてのテンプレートファイルで、検索と置換を使って
		 * すべてのテンプレートファイルで 'solid-action' をテーマ名に変更してください。
		 */
		load_theme_textdomain( 'solid-action', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		// デフォルトの投稿とコメントのRSSフィードリンクをヘッドに追加。
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * ドキュメントタイトルの管理をWordPressに任せる。
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 * ドキュメントヘッドにハードコードされた <title> タグを使用しないことを宣言し、WordPress がそれを提供することを期待します。
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 * 投稿やページのサムネイル表示を可能にする。
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		//このテーマでは、wp_nav_menu()を1箇所で使用しています。
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'solid-action' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * 検索フォーム、コメントフォーム、コメントのデフォルトのコアマークアップを切り替える
		 * デフォルトのコアマークアップを、有効なHTML5を出力するように変更。
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		// WordPressコアのカスタムバックグラウンド機能を設定します。
		add_theme_support(
			'custom-background',
			apply_filters(
				'solid_action_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		// テーマでウィジェットの選択的更新をサポートしました。
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 * コアのカスタムロゴに対応しました。
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'solid_action_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * テーマのデザインとスタイルシートに基づいて、コンテンツの幅をピクセル単位で設定します。
 *
 * Priority 0 to make it available to lower priority callbacks.
 * 優先度0で、優先度の低いコールバックが利用できるようにします
 *
 * @global int $content_width
 */
function solid_action_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'solid_action_content_width', 640 );
}
add_action( 'after_setup_theme', 'solid_action_content_width', 0 );

/**
 * Register widget area.
 * ウィジェット領域を登録します。
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solid_action_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'solid-action' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'solid-action' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'solid_action_widgets_init' );

/**
 * Enqueue scripts and styles.
 * スクリプトとスタイルをエンキューする。
 */
function solid_action_scripts() {
	$my_theme = wp_get_theme();
	// wp_enqueue_style( 'solid-action-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'solid-action-style', get_template_directory_uri() . '/styles/style.css' , array(),$my_theme->get( 'Version' ));
	// wp_style_add_data( 'solid-action-style', 'rtl', 'replace' );

	wp_enqueue_script( 'solid-action-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'solid_action_scripts' );

/**
 * Implement the Custom Header feature.
 * カスタムヘッダー機能の実装
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 * このテーマのカスタムテンプレートタグです。
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 * WordPressに接続してテーマを強化する機能。
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 * カスタマイザーの追加。
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 * Jetpackの互換ファイルを読み込む。
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}