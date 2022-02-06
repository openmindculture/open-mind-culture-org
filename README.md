[www.open-mind-culture.org](https://www.open-mind-culture.org)

This is a small blog for the main purpose to keep up with WordPress changes,
as I have been using WordPress from the very beginning but rarely used it professionally anymore.

## Linter

```
npx stylelint "**/*.css" --fix
```

## Plugins

[plugins/plugins.md](./plugins/plugins.md)

## Ingo's Personal Project Roadmap

A unified roadmap for builing apps, themes, and any other kind of extension to existing software, currently focused on [Shopware](https://www.shopware.com/), [WordPress](https://wordpress.org), and [fractal](https://fractal.build).

### Development: Directories and Repositories

 * [open-mind-culture.org](https://github.com/openmindculture/open-mind-culture-org) (this repository) is my WordPress project. Development directory structure:
   * `content/export` (export CMS content form database) 
   * `docker-compose.yml` (local dev setup)
   * `plugins`
     * `customizer.css` (optional style overrides, should be obsolete when using child theme)
     * `patch.functions.php` (optional modifications, should be obsolete when using child theme)
     * `plugins.md` (list of required plugins)
     * carbon-footprint-api ([wp-carbon-footprint-api](https://github.com/openmindculture/wp-carbon-footprint-api))
   * `themes`
     * [fasto-child](https://github.com/openmindculture/wp-fasto-child-theme/tree/main/themes/fasto-child) ([wp-fasto-child-theme](https://github.com/openmindculture/wp-fasto-child-theme))
   * `wp-root` (optional DevOps settings for performance and security to deploy to WordPress root folder on a shared host)
 * [fractal-shopware-demo](https://github.com/openmindculture/fractal-shopware-demo)
   * (similar themes and plugins for Shopware 6, NOT for fractal, despite the name)
 * [fractal-build-example](https://github.com/openmindculture/fractal-build-example)
   * reusable web components organized and tested in a design system
 * [bookstack-reading-list-app](https://github.com/openmindculture/bookstack-reading-list-app) is a project using JavaScript-based full-stack web development with Node.js, Preact, and TypeScript.

## Changelog

- 2022
  - [x] common roadmap for WordPress + Shopware development
  - [x] readability: color contrast
  - [ ] default image placeholder size / ratio
  - [ ] move all customizations (css, php) to child theme
  - [ ] add tests (using Cypress or Codecept)
  - [ ] progressive enhancement: use new CSS features
  - [ ] research / practice: use new WordPress features
  - [ ] continuously backup data
  - [ ] prepare possible migration to 11ty/gatsby/...


- 2021 Theme 'Fasto' used for more readability and easier maintenance;
  minify features to improve loading speed and web vitals ranking:
  use default built-in image gallery (needs css fix against distorted proportions);
  deactivate non essential plugins;
  unregister block editor css (we currently only use classic editor);  

- 2020 Custom styles are finally deployed as a child theme (twentytwenty-child)
The child theme will be mounted into a local WordPress running on [localhost:8077](http://localhost:8077)
after running `docker-compose up`.

- 2020 use [twentytwenty](https://wordpress.org/themes/twentytwenty/) default theme and rewrote essential custom changes as customizer css

- 2020 keep using [web font "Nothing You Could Do" by Kimberly Geswein](http://www.kimberlygeswein.com/).

- before: using modified [Suri](https://wordpress.org/themes/suri/) theme
