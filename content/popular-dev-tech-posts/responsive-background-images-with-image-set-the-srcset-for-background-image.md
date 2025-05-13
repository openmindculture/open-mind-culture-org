# Responsive background images with image-set, the srcset for background-image

What's next in CSS? (10 Part Series)

Keywords: css, TIL, todayilearned, webdev, tutorial

Source sets can help us to make websites load faster. We can use them in different ways to offer browsers alternative versions of the same image to match screen size, pixel density, or network speed.

## A Source Set for Background Images

The [image-set](https://developer.mozilla.org/en-US/docs/Web/CSS/image/image-set()) property allows us to do the same for background images in CSS. This feature has been [requested for years](https://stackoverflow.com/questions/26801745/is-there-a-srcset-equivalent-for-css-background-image), but it did not get the same hype as other, newer, CSS features like [parent selectors](https://dev.to/ingosteinke/css-hasparent-selectors-287c) or [container queries](https://dev.to/ingosteinke/a-css-container-queries-example-1le0).

### Understanding Image Sets step by step

First, let's make sure we understand source sets.

## What are source sets and how to use them?

In a typical use case, we provide different image versions and add our recommendation for appropriate screen sizes, but it's up to the browser to decide which image to load:

> The `image-set()` function allows an author to ignore most of these issues, simply providing multiple resolutions of an image and letting the user agent decide which is most appropriate in a given situation.

Source: [csswg.org](https://drafts.csswg.org/css-images-4/#image-set-notation)

## Providing Image Files

Let's start an put one image in an image element, for example [this photography of a landscape](https://www.flickr.com/photos/fraktalisman/51224349248/), 2048 pixels wide, and 1536 pixels high. As a high resolution photography with a lot of details, the file size is 557.7 kB, which is roughly half a megabyte.

We will use an image element to show this photograph on our website. We must specify the image source (the URL to the image file) and the original image dimensions (width and height).

```html
<img
  src="large-landscape-2048x1536.jpg"
  width="2048"
  height="1536"
  alt="landscape"
>
```

Adding the following style sheet will make browsers resize our image (and every other image on that page) proportionally when the horizontal viewport with is smaller than the original image width.

```css
img {
  max-width: 100%;
  height: auto;
}
```

We can test that it works as intented.

{% codepen https://codepen.io/openmindculture/pen/zYEVBjO %}

### But what a waste of bandwidth!

This is responsive in a visual way, but even on a small old mobile phone, browsers will still load the same large image file, half a megabyte of data, only to display a shrunk version of the same image on a tiny screen.

![Same large image on a small mobile phone screen](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/piq1saqjg7k9fh23bly4.jpg)

### A much smaller Image File that still looks good

If our mobile screen is 326 CSS pixels wide, at a resolution of 2 device pixels per CSS pixel, we need an image of 750 x 536 pixels to fill our screen. Scaling our image down to that size and saving it as a high quality JPEG file (with JPEG quality set to 80), the new image file only takes up 90 kilobytes, and the image still looks good.

And if you're not too ambitious, so does the 70 kB file after further image processing on codepen's asset server:

![large-landscape-750x536.jpg](https://assets.codepen.io/2332100/large-landscape-750x536.jpg)

#### Alternative modern image formats

Update: another use case might be webp and avif support, as suggested [on MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/image/image-set#using_image-set_to_provide_alternative_image_formats), combined with a legacy fallback:

```css
.box {
  background-image: url("fallback-balloons.jpg");
  background-image: -webkit-image-set(
    url("large-balloons.avif"),
    url("large-balloons.jpg"));
  background-image: image-set(
    url("large-balloons.avif") type("image/avif"),
    url("large-balloons.jpg") type("image/jpeg"));
}
```

### Adding Source Sets and Sizes to our Image Elements

Now let's tell our browser to use the smaller version if the screen size is not larger than 750 (CSS) pixels. We can add a `srcset` attribute to our existing image.

```html
<img
  src="large-landscape-2048x1536.jpg"
  srcset="small-landscape-750x536.jpg 750w,
          large-landscape-2048x1536.jpg 20480w"
  width="2048"
  height="1536"
  alt="landscape"
>
```

For more complex definitions, we could wrap a picture element around our image and add multiple source elements each with its own srcset attribute. That can be handy if we need to combine different aspects of [responsive images](https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images) for the same image element, like screen width and pixel density.

## Responsive Background Images

Why use background images at all? Well, in the old days before the [object-fit property](https://developer.mozilla.org/en-US/docs/Web/CSS/object-fit) and before layering content using `positioning` and `z-index` worked as it did today, [background images](https://developer.mozilla.org/en-US/docs/Web/CSS/background-image) were a very useful technique to code hero banners and they still provide an easy way to add optional decoration to pages and elements.

Despite their smooth and flexible visual styling, it used to be impossible to optimize background images to save mobile bandwidth, and the warning about ["very limited support" of the image-set property](https://caniuse.com/?search=image-set) probably did not help to make it popular among web developers either.

### Using Image Sets for Background Images

Defining an [image-set](https://developer.mozilla.org/en-US/docs/Web/CSS/image/image-set()) for a background-image url is easy if we know how to use `srcset` attributes for `img` and `source` elements.

A drawback of limited `image-set` support in current browsers is that we can't use pixel width resolutions, so we have to set [pixel density](https://elad.medium.com/understanding-the-difference-between-css-resolution-and-device-resolution-28acae23da0b) (`1x`, `2x`) etc. as a selector instead.

We can use image-set as a replacement for a single url, so that


```css
.landscape-background {
background-image: url(large-landscape-2048x1536.jpg);
}
```

...becomes...

```css
.box {
  background-image: image-set(
    url("small-landscape-750x536.jpg") 1x,
    url("large-landscape-2048x1536.jpg") 2x);
}
```


For the sake of maximum browser compatibility, we should add a webkit-prefixed version as well as a single image url. Currently, Chrome browser still don't support the unprefixed version.

```css
.box {
  background-image: url("small-landscape-750x536.jpg");
  background-image: -webkit-image-set(
    url("small-landscape-750x536.jpg") 1x,
    url("large-landscape-2048x1536.jpg") 2x);
  background-image: image-set(
    url("small-landscape-750x536.jpg") 1x,
    url("large-landscape-2048x1536.jpg") 2x);
}
```

### Progressive Enhancement with w-Units

[CSS 4 Images draft](https://drafts.csswg.org/css-images-4/#image-set-notation) already proposed to introduce width and height units in the future:

> We should add "w" and "h" dimensions as a possibility to match the functionality of HTML’s picture.

While the quoted "we should add" was meant to say that browser vendors should add the functionality to their CSS engines, it could also mean that we, as web developers, should add the dimensions to our code even before any browser actually supports them.

Using [progressive enhancement](https://developer.mozilla.org/en-US/docs/Glossary/Progressive_Enhancement), which means to use new features in an optional way, we could simply add another line with a width-based image-set. It will be ignored for containing (currently) invalid values, but it will start to work once browsers start to implement the new syntax.

Last but not least, we can add a static background color which will display before the image has loaded, or in case the image fails to load for some reason.

```css
.box {
  background: skyblue;
  background-image: url("small-landscape-750x536.jpg");
  background-image: -webkit-image-set(
    url("small-landscape-750x536.jpg") 1x,
    url("large-landscape-2048x1536.jpg") 2x);
  background-image: image-set(
    url("small-landscape-750x536.jpg") 1x,
    url("large-landscape-2048x1536.jpg") 2x);
  background-image: image-set(
    url("small-landscape-750x536.jpg") 750w,
    url("large-landscape-2048x1536.jpg") 20480w);
}
```

Firefox 96 supports `image-set` without prefix, but still sees `750w` and `2048w` as invalid values, falling back to the `image-set` with density values.

![Image description](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/7qzqto8icd2a1eioyr0d.png)

Internet Explorer would still recognize our first line, the background image wihtout an `image-set`, so it looks we're all set to have a nice display in every browser, and a performance optimiziation for the progressive ones.

This is our complete demo code in action:

{% codepen https://codepen.io/openmindculture/pen/KKXjMRr %}

## Conclusion and Alternatives

Due to the limited browser support, I prefer using regular `<img>` elements. Images inside of `<picture>` elements support complex adaptive source sets combining rules for width and pixel density for each image at the same time, also known as the ["art direction" use case](https://developers.google.com/web/fundamentals/design-and-ux/responsive/images#art_direction_in_responsive_images_with_picture).

```html
<picture>
  <source media="(min-width: 800px)" srcset="head.jpg, head-2x.jpg 2x">
  <source media="(min-width: 450px)" srcset="head-small.jpg, head-small-2x.jpg 2x">
  <img src="head-fb.jpg" srcset="head-fb-2x.jpg 2x" alt="a head carved out of wood">
</picture>
```

Quoting [my own StackOverflow answer](https://stackoverflow.com/questions/49174465/understanding-srcset-and-sizes-in-combination-with-hidpi-monitors/71242072#71242072) here:

[![Understanding srcset and sizes in combination with HiDPI monitors](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/y9sr671bukm0zicuen16.png)](https://stackoverflow.com/questions/49174465/understanding-srcset-and-sizes-in-combination-with-hidpi-monitors/71242072#71242072)

{% stackoverflow https://stackoverflow.com/questions/49174465/understanding-srcset-and-sizes-in-combination-with-hidpi-monitors/71242072#71242072 %}

## What's next in CSS?

Thanks for reading, and watch out, there is more to come!

