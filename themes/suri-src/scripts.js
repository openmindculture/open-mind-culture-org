/**
 * Theme scripts file.
 *
 * Contains scripts for navigation menu and sidebar toggle. Also, handles js
 * detection and skip link focus fix.
 */
( function() {

    // Detect if javascript is enabled or not in the browser.
    ( function () {
        var rootElement = document.documentElement;
        if (-1 !== rootElement.className.indexOf('no-js')) {
            rootElement.className = rootElement.className.replace(/\bno-js\b/,'js');
        }
    } ) ();

    // Merge Header Menu and Primary menu on smaller screens.
    ( function mergeMenu() {
        var headerNav, mainNav, headerItems, item;
        headerNav = document.getElementById('header-menu');
        if (!headerNav) {
            return;
        }

        mainNav = document.getElementById( 'primary-menu' );
        if (!mainNav) {
            return;
        }

        headerItems = headerNav.querySelectorAll( '#header-nav > li' );

        for (var i = 0, len = headerItems.length; i < len; i++) {
            item = headerItems[i].cloneNode(true);
            item.className += ' moved-item';
            mainNav.appendChild(item);
        }

        headerNav.className += ' hide-on-mobile';
    } ) ();

    /**
     * Handles toggling the navigation menu for small screens and
     * enables TAB key navigation support for dropdown menus.
     */
    function navToggle( navId ) {
        var container, button, menu, links, subMenus, childToggle;
        container = document.getElementById( navId );
        if (!container) {
            return;
        }

        button = container.getElementsByTagName('button')[0];
        if ('undefined' === typeof button) {
            return;
        }

        menu = container.getElementsByTagName('ul')[0];

        // Hide menu toggle button if menu is empty and return early.
        if ('undefined' === typeof menu) {
            button.style.display = 'none';
            return;
        }

        menu.setAttribute('aria-expanded', 'false');
        if (-1 === menu.className.indexOf('nav-menu')) {
            menu.className += ' nav-menu';
        }

        button.onclick = function() {
            if (-1 !== container.className.indexOf('toggled')) {
                container.className = container.className.replace(' toggled', '');
                button.setAttribute('aria-expanded', 'false');
                menu.setAttribute('aria-expanded', 'false');
            } else {
                container.className += ' toggled';
                button.setAttribute('aria-expanded', 'true');
                menu.setAttribute('aria-expanded', 'true');
            }
        };

        // Get all the link elements within the menu.
        links = menu.getElementsByTagName('a');
        subMenus = menu.getElementsByTagName('ul');

        for (var i = 0, len = subMenus.length; i < len; i++) {
            // Set menu items with submenus to aria-haspopup="true".
            subMenus[i].parentNode.setAttribute('aria-haspopup', 'true');

            // Child menu toggle functionality.
            addDropToggle(subMenus[i]);
            childToggle = subMenus[i].previousSibling;
            childToggle.onclick = function() {
                var self = this;
                if (-1 !== self.className.indexOf('toggled-on')) {
                    self.className = self.className.replace(' toggled-on', '');
                    self.parentNode.className = self.parentNode.className.replace(' toggled-on', '');
                    self.setAttribute('aria-expanded', 'false');
                } else {
                    self.className += ' toggled-on';
                    self.parentNode.className += ' toggled-on';
                    self.setAttribute('aria-expanded', 'true');
                }
            };
        }

        // Each time a menu link is focused or blurred, toggle focus.
        for (i = 0, len = links.length; i < len; i++) {
            links[i].addEventListener('focus', toggleFocus, true);
            links[i].addEventListener('blur', toggleFocus, true);
        }

        // Sets or removes .focus class on an element.
        function toggleFocus() {
            var self = this;

            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (-1 === self.className.indexOf('nav-menu')) {

                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    if (-1 !== self.className.indexOf('focus')) {
                        self.className = self.className.replace(' focus', '');
                    } else {
                        self.className += ' focus';
                    }
                }
                self = self.parentElement;
            }
        }

        // Add dropdown toggle button to submenus.
        function addDropToggle( ele ) {
            var txt, spn, btn, spn2;
            txt = document.createTextNode('expand child menu');
            spn = document.createElement('SPAN');
            spn.appendChild(txt);
            spn.className = 'screen-reader-text';
            spn2 = document.createElement('SPAN');
            spn2.className = 'genericon genericon-expand';
            spn2.setAttribute('aria-hidden', 'true');
            btn = document.createElement('BUTTON');
            btn.appendChild(spn);
            btn.appendChild(spn2);
            btn.className = 'dropdown-toggle';
            btn.setAttribute('aria-expanded', 'false');
            ele.parentNode.insertBefore(btn, ele);
        }
    }
    navToggle( 'main-navigation' );
    navToggle( 'header-menu' );

    // Handles toggling the sidebar for small screens.
    ( function () {
        var sidebarContainer, toggleButton;
        sidebarContainer = document.getElementById( 'secondary' );
        if (!sidebarContainer) {
            return;
        }

        toggleButton = sidebarContainer.getElementsByTagName('button')[0];
        if ('undefined' === typeof toggleButton) {
            return;
        }

        toggleButton.onclick = function() {
            if (-1 !== sidebarContainer.className.indexOf('toggled')) {
                sidebarContainer.className = sidebarContainer.className.replace(' toggled', '');
                toggleButton.setAttribute('aria-expanded', 'false');
            } else {
                sidebarContainer.className += ' toggled';
                toggleButton.setAttribute('aria-expanded', 'true');
            }
        };
    } ) ();

    // Helps with accessibility for keyboard only users.
    ( function () {
        var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
            is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
            is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;
        if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
            window.addEventListener( 'hashchange', function() {
                var id = location.hash.substring( 1 ),
                    element;
                if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                    return;
                }
                element = document.getElementById( id );
                if ( element ) {
                    if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                        element.tabIndex = -1;
                    }
                    element.focus();
                }
            }, false );
        }
    } ) ();

    // Generate accessibility friendly font icons.
    ( function() {
        var elemsBefore, elemsAfter;
        elemsBefore = document.querySelectorAll( '.suri-gen-b' );
        elemsAfter = document.querySelectorAll( '.suri-gen-a' );
        for (var i = 0, len = elemsBefore.length; i < len; i++) {
            var elemClass = elemsBefore[i].className;
            var str = elemClass.substring( elemClass.lastIndexOf('sf-') + 3, elemClass.lastIndexOf('-sf') );
            var replaceStr = new RegExp( ' suri-gen-b sf-' + str + '-sf', 'g' );
            var spn = document.createElement('SPAN');
            spn.className = str;
            spn.setAttribute('aria-hidden', 'true');
            elemsBefore[i].insertBefore(spn, elemsBefore[i].firstChild);
            elemsBefore[i].className = elemsBefore[i].className.replace( replaceStr, '' );
        }
        for ( i = 0, len = elemsAfter.length; i < len; i++) {
            var elemClassa = elemsAfter[i].className;
            var stra = elemClassa.substring( elemClassa.lastIndexOf('sf-') + 3, elemClassa.lastIndexOf('-sf') );
            var replaceStra = new RegExp( ' suri-gen-a sf-' + stra + '-sf', 'g' );
            var spna = document.createElement('SPAN');
            spna.className = stra;
            spna.setAttribute('aria-hidden', 'true');
            elemsAfter[i].appendChild(spna);
            elemsAfter[i].className = elemsAfter[i].className.replace( replaceStra, '' );
        }
    } ) ();
    ( function() {
        window._paq = window._paq || [];
        window._paq.push(['disableCookies'],['enableLinkTracking'],['trackPageView']);
        (function() {
            var u="//www.open-mind-culture.org/piwik/";
            window._paq.push(['setTrackerUrl', u+'js/'],['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('body')[0];
            g.type='text/javascript'; g.src=u+'js/'; s.parentNode.insertBefore(g,s);
            d.head.appendChild(g);
        })();
        window._paq.push(['trackPageView']);
    }) ();
} ) ();
