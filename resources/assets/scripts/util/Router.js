import camelCase from './camelCase';

/**
 * DOM-based Routing
 *
 * Based on {@link http://goo.gl/EUTi53|Markup-based Unobtrusive Comprehensive DOM-ready Execution} by Paul Irish
 *
 * The routing fires all common scripts, followed by the page specific scripts.
 * Add additional events for more control over timing e.g. a finalize event
 */
class Router {

  /**
   * Create a new Router
   * @param {Object} routes
   */
  constructor(routes, shortcodes) {
    this.routes = routes;
    this.shortcodes = shortcodes;
  }

  /**
   * Fire Router events
   * @param {string} route DOM-based route derived from body classes (`<body class="...">`)
   * @param {string} [event] Events on the route. By default, `init` and `finalize` events are called.
   * @param {string} [arg] Any custom argument to be passed to the event.
   */
  fire(route, event = 'init', arg) {
    document.dispatchEvent(new CustomEvent('routed', {
      bubbles: true,
      detail: {
        route,
        fn: event,
      },
    }));

    const fire = route !== '' && this.routes[route] && typeof this.routes[route][event] === 'function';
    if (fire) {
      this.routes[route][event](arg);
    }
  }

  fireShortcode(shortcode, event = 'init', arg) {
    document.dispatchEvent(new CustomEvent('routed', {
      bubbles: true,
      detail: {
        shortcode,
        fn: event,
      },
    }));

    const fire = shortcode !== '' && this.shortcodes[shortcode] && typeof this.shortcodes[shortcode][event] === 'function';
    if (fire) {
      this.shortcodes[shortcode][event](arg);
    }
  }

  /**
   * Automatically load and fire Router events
   *
   * Events are fired in the following order:
   *  * common init
   *  * page-specific init
   *  * page-specific finalize
   *  * common finalize
   */
  loadEvents() {
    this.fire('common'); // Fire common init JS

    // Fire page-specific init JS, and then finalize JS
    document.body.className
      .toLowerCase()
      .replace(/-/g, '_')
      .split(/\s+/)
      .map(camelCase)
      .forEach((className) => {
        this.fire(className);
        this.fire(className, 'finalize');
      });

    // Fire shortcode-specific init JS, and then finalize JS
    var shortcodesPresent = document.getElementsByClassName('plubo-shortcode');
    if (shortcodesPresent.length > 0) {
      for (var i = 0; i < shortcodesPresent.length; i++) {
        shortcodesPresent[i].dataset.tag
        .toLowerCase()
        .replace(/-/g, '_')
        .split(/\s+/)
        .map(camelCase)
        .forEach((tag) => {
          this.fireShortcode(tag);
          this.fireShortcode(tag, 'finalize');
        });
      }
    }

    this.fire('common', 'finalize'); // Fire common finalize JS
  }
}

export default Router;
