/* global wp, jQuery */
/**
 * File customizer.js.
 * ファイルcustomizer.jsです。
 *
 * Theme Customizer enhancements for a better user experience.
 * テーマカスタマイザーが強化され、より使いやすくなりました。
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * テーマカスタマイザーのプレビューの変更を非同期にリロードさせるためのハンドラが含まれています。
 */

(function ($) {
  // Site title and description.
  // サイトのタイトルと説明文。
  wp.customize("blogname", function (value) {
    value.bind(function (to) {
      $(".site-title a").text(to);
    });
  });
  wp.customize("blogdescription", function (value) {
    value.bind(function (to) {
      $(".site-description").text(to);
    });
  });

  // Header text color.
  // ヘッダーの文字色。
  wp.customize("header_textcolor", function (value) {
    value.bind(function (to) {
      if ("blank" === to) {
        $(".site-title, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-title, .site-description").css({
          clip: "auto",
          position: "relative",
        });
        $(".site-title a, .site-description").css({
          color: to,
        });
      }
    });
  });
})(jQuery);
