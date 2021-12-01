<?php
/**
 * The sidebar containing the main widget area
 * メインのウィジェットエリアを含むサイドバー
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Solid_Action
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


//sidebarが存在するか確認
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!-- sidebarの呼び出し -->
<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->