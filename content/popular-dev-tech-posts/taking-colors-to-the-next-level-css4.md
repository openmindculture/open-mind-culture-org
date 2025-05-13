# Taking colors to the next (CSS) level

What's next in CSS? (10 Part Series)

Keywords: css, webdev, news, css4

["CSS4"](https://css-tricks.com/css4/) will make even brighter colors available to web designers and developers. Like [parent selectors](https://dev.to/ingosteinke/css-hasparent-selectors-287c), the upcoming [CSS Level 4 Color proposal](https://www.w3.org/TR/css-color-4/) was first implemented in Safari. But before we dive deeper into the details, let's make it clear that "CSS4" does not exist. Thanks to Temani @afif for pointing it out, and thanks to @grahamthedev for suggesting the new title!

## CSS has no Version Numbers

I added a link to the [discussion about "CSS4" on CSS-Tricks.com](https://css-tricks.com/css4/). Of course there is no "CSS4" in the same strict sense that there has never been "MPEG 3" (MP3) or "Web3" either. But like @ppk and others have suggested, "CSS4" might help to make CSS more popular. On the other hand, I recently got quite upset about the so-called "Web3" discussion which inspired @hidde to his excellent post that [the web doesn't have version numbers](https://hiddedevries.nl/en/blog/2022-01-03-the-web-doesnt-have-version-numbers).

## Brighter Color Spaces

Looking back at the old color palettes, like IBM CGA, Commodore 64, and the Adobe Photoshop color picker with its "Only [Web Colors](https://en.wikipedia.org/wiki/Web_colors)" checkbox, choosing from over 16 million RGB colors using 6-digit ([or even 8-digit](https://dev.to/inhuofficial/hold-on-there-are-4-and-8-digit-hex-codes-for-colours-261i)) hex codes, web designers may think that they had all the colors of the world.

![Old color palettes: IBM CGA, Commodore, Adobe Color Picker with "Only Web Colors" checkbox](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/n04ss1r7pxrkf80rq3fi.png)

But although we already have millions of colors in our browsers, it's the brightest colors that have been missing!

With the new color functions, we can use `color(display-p3)`, and also `lab()` and `lch()` to go beyond the sRGB color space.

The previously available syntax defined colors in sRGB color space. ([Named colors](https://www.w3.org/wiki/CSS/Properties/color/keywords), [hex colors](https://www.w3.org/wiki/CSS/Properties/color/RGB), [`rgb()`](https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/rgb()), and even [hsl()](https://developer.mozilla.org/en-US/docs/Web/CSS/color_value/hsl()) color notations are all limited to the sRGB color space up to CSS3).

```css
.srgb-color-syntax {
  background-color: wheat;
  border-color: #ffea21;
  color: rgba(12, 200, 128, 0.2);
  text-decoration-color: hsl(0 100% 50% / 0.5);
}

.wide-gamut-color-syntax {
  background-color: lab(80% 100 50);
  border-color: lch(80% 100 50);
  color: color(display-p3 1 0.5 0);
}
```

The color space [Display-P3](https://css-tricks.com/wide-gamut-color-in-css-with-display-p3/) is a superset of sRGB. It is around 50% larger, including very bright and colorful values that have not been possible to define in CSS until now.


https://www.smashingmagazine.com/2021/11/guide-modern-css-colors/

### How to use CCS4 P3 Colors

How would we use the new colors?

#### How to use color syntax anyway?

Well, how did we use the old ones? Although I can modify existing RGB colors and I have a rough understanding of additive color mixing and hexadecimal numbers, I would not use hex color notation from scratch.

![#ff22aa == #f2a; The first ones are red, the last ones are blue, "f" means fifteen,"a" means ten, both is more than two,  so I'd expect a purple color.](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/7q4rqid9hw53k9wzq5y3.png)

Thanks to @yutamago for pointing out that a single "f" means "fifteen" (which is even easier to keep in mind than what I mistakenly wrote before) only as the rightmost digit in a [hexadecimal number](https://en.wikipedia.org/wiki/Hexadecimal). My pragmatic approach is an oversimplification of the actual values: "f" is a shortcut for "ff" in this example, the hexadecimal notation of 255, which is the highest possible unsigned integer that can be stored as a 16-bit value.

But you see my point: those values are not supposed to be read and written by humans without using tools.

I prefer named colors for demos and debugging. Otherwise, like in front-end web projects, I would use a color picker or copy the color values I got from a designer.

![Screenshots of color pickers and colors as css variables](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/gp4ox3tkwwdis5m8j3nl.png)

Then I would define common colors using custom properties or SCSS variables, so that I don't have to bother with every subsequent page or component.

```css
:root {
  --brand-background: #4081c3;
  --brand-primary: color(display-p3 1 0.5 0);
}
```

or in SCSS

```scss
$brand-background: #4081c3;
$brand-primary: color(display-p3 1 0.5 0);
```

Now we can use the new colors just like any other color in web development. Only difference, and a great improvement: now we can ship nicer websites with even brighter colors to our customers!

Note: this article was first published as [more, and more colourful, web colours](https://www.open-mind-culture.org/en/1982/more-and-more-colourful-web-colours/) in British English and it's also available in German as [mehr und buntere Webfarben](https://www.open-mind-culture.org/1985/mehr-und-buntere-webfarben/). It has been [republished my medium](https://ingosteinke.medium.com/more-and-more-colorful-web-colors-7a7da219120d) and [Tealfeed](https://tealfeed.com/more-colourful-web-colors-qxxga).

Check my [DEV blog series What's next in CSS](https://dev.to/ingosteinke/series/16136) for more colorful, creative, and technical insights about new and improved stylesheet features.
