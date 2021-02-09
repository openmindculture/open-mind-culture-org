[www.open-mind-culture.org](https://www.open-mind-culture.org)

This is a small blog for the main purpose to keep up with WordPress changes,
as I have been using WordPress from the very beginning but rarely used it professionally anymore.

## Linter

```
npx stylelint "**/*.css" --fix
```

## Plugins

[plugins/plugins.md](./plugins/plugins.md)

## Changelog

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
