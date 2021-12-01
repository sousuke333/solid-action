/**
 * File navigation.js.
 * ファイル navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 * 小さな画面用のナビゲーションメニューのトグルを処理し、TABキーを有効にする
 * ドロップダウンメニューのナビゲーションをサポートしました。
 */
(function () {
  const siteNavigation = document.getElementById("site-navigation");

  // Return early if the navigation don't exist.
  // ナビゲーションが存在しない場合は、早期に戻ります。
  if (!siteNavigation) {
    return;
  }

  const button = siteNavigation.getElementsByTagName("button")[0];

  // Return early if the button don't exist.
  // ボタンが存在しない場合は早期に返却します。
  if ("undefined" === typeof button) {
    return;
  }

  const menu = siteNavigation.getElementsByTagName("ul")[0];

  // Hide menu toggle button if menu is empty and return early.
  // メニューが空の場合、メニューのトグルボタンを非表示にして、早めに戻るようにしました。
  if ("undefined" === typeof menu) {
    button.style.display = "none";
    return;
  }

  if (!menu.classList.contains("nav-menu")) {
    menu.classList.add("nav-menu");
  }

  // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
  // ボタンがクリックされるたびに、.toggled クラスと aria-expanded 値を切り替えます。
  button.addEventListener("click", function () {
    siteNavigation.classList.toggle("toggled");

    if (button.getAttribute("aria-expanded") === "true") {
      button.setAttribute("aria-expanded", "false");
    } else {
      button.setAttribute("aria-expanded", "true");
    }
  });

  // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
  // ユーザーがナビゲーションの外をクリックすると、.toggledクラスを削除し、aria-expandedをfalseに設定します。
  document.addEventListener("click", function (event) {
    const isClickInside = siteNavigation.contains(event.target);

    if (!isClickInside) {
      siteNavigation.classList.remove("toggled");
      button.setAttribute("aria-expanded", "false");
    }
  });

  // Get all the link elements within the menu.
  // メニュー内のすべてのリンク要素を取得します。
  const links = menu.getElementsByTagName("a");

  // Get all the link elements with children within the menu.
  // メニュー内の子を持つすべてのリンク要素を取得します。
  const linksWithChildren = menu.querySelectorAll(
    ".menu-item-has-children > a, .page_item_has_children > a"
  );

  // Toggle focus each time a menu link is focused or blurred.
  // メニューリンクにフォーカスが当たったり、ぼかしたりするたびに、フォーカスを切り替えます。
  for (const link of links) {
    link.addEventListener("focus", toggleFocus, true);
    link.addEventListener("blur", toggleFocus, true);
  }

  // Toggle focus each time a menu link with children receive a touch event.
  // 子を持つメニューリンクがタッチイベントを受信するたびにフォーカスを切り替える。
  for (const link of linksWithChildren) {
    link.addEventListener("touchstart", toggleFocus, false);
  }

  /**
   * Sets or removes .focus class on an element.
   * 要素に.focusクラスを設定・削除します。
   */
  function toggleFocus() {
    if (event.type === "focus" || event.type === "blur") {
      let self = this;
      // Move up through the ancestors of the current link until we hit .nav-menu.
      // 現在のリンクの祖先を .nav-menu になるまで移動します。
      while (!self.classList.contains("nav-menu")) {
        // On li elements toggle the class .focus.
        // li要素では、クラス.focusをトグルします。
        if ("li" === self.tagName.toLowerCase()) {
          self.classList.toggle("focus");
        }
        self = self.parentNode;
      }
    }

    if (event.type === "touchstart") {
      const menuItem = this.parentNode;
      event.preventDefault();
      for (const link of menuItem.parentNode.children) {
        if (menuItem !== link) {
          link.classList.remove("focus");
        }
      }
      menuItem.classList.toggle("focus");
    }
  }
})();
