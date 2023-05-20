/**
 * @file
 */

(($, Drupal, cookies, once) => {
  Drupal.behaviors.field_group_bootstrap = {
    attach: (context, settings) => {
      function memoryClick(type = '', currentTab, currentGroup) {
        // Retrieve a cookie.
        let cookiesType = cookies.get(type);
        if (cookiesType) {
          cookiesType = JSON.parse(cookiesType);
        } else {
          cookiesType = {};
        }
        cookiesType[currentGroup] = currentTab;
        // Set a cookie.
        cookies.set(type, JSON.stringify(cookiesType));
      }

      // Active first tab.
      $(once('bootstrap-tabs', '.field-group-bootstrap_tabs-wrapper', context)).each(function () {
        let bootstrap_tabs = cookies.get('bootstrap_tabs');
        if (bootstrap_tabs) {
          let tabs = JSON.parse(bootstrap_tabs);
          $.each(tabs, function (key, tab) {
            selectorTab = '.field-group-bootstrap_tabs-wrapper .nav-link[aria-controls="' + tab + '"]';
            if ($(selectorTab).length) {
              $(selectorTab).click();
            }
          });
        } else {
          $('.field-group-bootstrap_tabs-wrapper .nav-link').first().trigger('click');
        }
      });

      // Memory when click on tab.
      $(once('bootstrap-tabs-nav-link', '.field-group-bootstrap_tabs-wrapper .nav .nav-link', context)).click(function () {
        var tabs = [];
        $('.fg-bootstrap-tab.active').each(function () {
          tabs.push($(this).attr('aria-controls'));
        });
        cookies.set('bootstrap_tabs', JSON.stringify(tabs));
      });

      // Memory when click on list item scrollby.
      $(once('bootstrap-tabs-list-group', '.field-group-bootstrap_scrollby-wrapper .list-group .list-group-item', context)).click(function () {
        memoryClick('bootstrap_scrollby', $(this).data('controls'), $(this).data('group'));
      });

      // Memory when click on accordion.
      $(once('bootstrap-tabs-accordion', '.field-group-bootstrap_accordion-wrapper .accordion-button', context)).click(function () {
        memoryClick('bootstrap_accordion', $(this).data('controls'), $(this).data('group'));
      });
    },
  };
})(jQuery, Drupal, window.Cookies, once);
