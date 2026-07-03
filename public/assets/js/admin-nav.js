/**
 * Lightweight AJAX navigation for the admin panel.
 *
 * Intercepts sidebar/navbar link clicks and content-wrapper form
 * submissions, fetches the target page, and swaps only the
 * `.content-wrapper` markup in place - the sidebar, header, and
 * overall layout are never touched. Falls back to a normal full
 * page navigation any time something doesn't look like a safe
 * partial swap (network error, non-admin response, error page,
 * logged out, etc.), so a bug here degrades to "acts like a normal
 * link" rather than breaking the page.
 *
 * Deliberately does NOT send an X-Requested-With/XMLHttpRequest
 * header: that header makes Laravel treat the request as "wants
 * JSON" (Request::expectsJson()), which would turn validation
 * failures and 403/404/500 pages into JSON payloads instead of the
 * normal HTML this script parses. Every request here is fetched
 * exactly like a normal browser navigation, and the full HTML page
 * is fetched every time (no server-side changes needed anywhere) -
 * only the .content-wrapper portion is extracted client-side.
 */
(function () {
    'use strict';

    var CONTENT_SELECTOR = '.content-wrapper';
    var INTERACTIVE_SCOPE = '.main-sidebar, .main-header, .content-wrapper';

    function isSameOrigin(url) {
        try {
            return new URL(url, window.location.href).origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    function shouldSkipLink(link) {
        if (!link || !link.getAttribute) {
            return true;
        }

        var href = link.getAttribute('href');

        if (!href || href.charAt(0) === '#') {
            return true;
        }

        if (href.indexOf('javascript:') === 0 || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) {
            return true;
        }

        if (link.hasAttribute('data-no-ajax') || link.hasAttribute('download')) {
            return true;
        }

        if (link.target && link.target !== '' && link.target !== '_self') {
            return true;
        }

        if (!isSameOrigin(link.href)) {
            return true;
        }

        return false;
    }

    function shouldSkipForm(form) {
        if (!form) {
            return true;
        }

        if (form.hasAttribute('data-no-ajax')) {
            return true;
        }

        if (form.target && form.target !== '' && form.target !== '_self') {
            return true;
        }

        if (!isSameOrigin(form.action)) {
            return true;
        }

        return false;
    }

    function extractContent(html) {
        var doc = new DOMParser().parseFromString(html, 'text/html');
        var content = doc.querySelector(CONTENT_SELECTOR);

        if (!content) {
            return null;
        }

        return {
            html: content.innerHTML,
            title: doc.title,
        };
    }

    function swapContent(parsed) {
        var current = document.querySelector(CONTENT_SELECTOR);

        if (!current) {
            return false;
        }

        current.innerHTML = parsed.html;

        if (parsed.title) {
            document.title = parsed.title;
        }

        if (window.jQuery && typeof initAdminWidgets === 'function') {
            initAdminWidgets();
        }

        window.scrollTo(0, 0);

        return true;
    }

    function hardNavigate(url) {
        window.location.href = url;
    }

    /**
     * Fetches a URL like a normal navigation, extracts .content-wrapper,
     * and either swaps it in or falls back to a real navigation.
     */
    function handleResponse(fetchPromise, fallbackUrl, pushState) {
        fetchPromise
            .then(function (response) {
                return response.text().then(function (html) {
                    return { html: html, finalUrl: response.url };
                });
            })
            .then(function (result) {
                var parsed = extractContent(result.html);

                if (!parsed) {
                    // Not an admin-panel page (logged out, redirected to the
                    // public site, a standalone error page, session expired,
                    // etc.) - let the browser navigate there for real.
                    hardNavigate(result.finalUrl || fallbackUrl);
                    return;
                }

                if (!swapContent(parsed)) {
                    hardNavigate(result.finalUrl || fallbackUrl);
                    return;
                }

                if (pushState) {
                    history.pushState({ ajaxNav: true }, '', result.finalUrl || fallbackUrl);
                }
            })
            .catch(function () {
                hardNavigate(fallbackUrl);
            });
    }

    function navigateTo(url, options) {
        options = options || {};

        handleResponse(
            fetch(url, { credentials: 'same-origin' }),
            url,
            options.pushState !== false
        );
    }

    function submitFormAjax(form) {
        var method = (form.getAttribute('method') || 'GET').toUpperCase();

        if (method === 'GET') {
            var params = new URLSearchParams(new FormData(form));
            var url = form.action.split('?')[0] + '?' + params.toString();
            navigateTo(url, { pushState: true });
            return;
        }

        handleResponse(
            fetch(form.action, {
                method: 'POST', // Laravel spoofs PUT/PATCH/DELETE via a hidden _method field.
                body: new FormData(form),
                credentials: 'same-origin',
            }),
            form.action,
            true
        );
    }

    document.addEventListener('click', function (e) {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) {
            return;
        }

        var link = e.target.closest ? e.target.closest('a') : null;

        if (!link || !link.closest(INTERACTIVE_SCOPE)) {
            return;
        }

        if (shouldSkipLink(link)) {
            return;
        }

        e.preventDefault();
        navigateTo(link.href, { pushState: true });
    });

    document.addEventListener('submit', function (e) {
        if (e.defaultPrevented) {
            // Respects onsubmit="return confirm(...)" cancellations (e.g. delete buttons).
            return;
        }

        var form = e.target;

        if (!(form instanceof HTMLFormElement) || !form.closest(CONTENT_SELECTOR)) {
            return;
        }

        if (shouldSkipForm(form)) {
            return;
        }

        e.preventDefault();
        submitFormAjax(form);
    });

    window.addEventListener('popstate', function () {
        navigateTo(window.location.href, { pushState: false });
    });
})();
