# Pure CSS parallax perspective beyond landscape images

I researched many tutorials and examples about "parallax scrolling" effects, and I wasn't impressed. Most parallax examples were not elegant both in a visual way and concerning their code. I often struggled to understand the principle hidden between irrelevant styles and misleading class names. Some "pure CSS" examples still use JavaScript, and most don't care about accessibility, using parallax movements even if the users have set to prefer reduced motion.

This **(meta-) tutorial** shows some experiments and deliberate failures on my way to understand what is going on and how to code a **working, robust, accessible, and maintainable perspective effect beyond the typical "awesome landscape" image**.

![parallax animation example gif by Wikimedia commons](https://upload.wikimedia.org/wikipedia/commons/3/34/Parallax_scrolling_example_scene.gif)
Source: [Wikimedia Commons: File:Parallax_scrolling_example_scene.gif](https://en.wikipedia.org/wiki/File:Parallax_scrolling_example_scene.gif).

## Table of Contents
- [Definition(s) of parallax scrolling effects](#definitions-of-parallax-scrolling-effects)
	- [Parallax beyond awesome landscape images](#parallax-beyond-awesome-landscape-images)
	- [Misconceptions, outdated and complicated tutorials](#misconceptions-outdated-and-complicated-tutorials)
- [Pure CSS and minimal additional markup](#pure-css-and-minimal-additional-markup)
	- [Contain the effect, ensure scrolling, and don't mess with the global document!](#contain-the-effect-ensure-scrolling-and-dont-mess-with-the-global-document)
	- [Understanding my intermediate double-scrollbars example](#understanding-my-intermediate-doublescrollbars-example)
	- [(Dis)advantages of a global body height approach](#disadvantages-of-a-global-body-height-approach)
	- [(Dis-)advantages of old-school "parallax" approaches](#disadvantages-of-oldschool-parallax-approaches)
	- [2D transformations to approach 3D perspective](#2d-transformations-to-approach-3d-perspective)
	- [Accessibility: respecting prefers-reduced-motion](#accessibility-respecting-prefersreducedmotion)
	- [Even more research ...](#even-more-research-)
- [Conclusion](#conclusion)
	- [Helpful tutorials and codepens](#helpful-tutorials-and-codepens)
	- [Finally, a pragmatic "beyond landscape" setup](#finally-a-pragmatic-beyond-landscape-setup)
	- [See it in action: my new codepen](#see-it-in-action-my-new-codepen)

## Definition(s) of parallax scrolling effects

What is a "**parallax perspective effect**" anyway? Simple as it may seem, there seem to be different interpretations of what it is on a website, generalized as an umbrella term for various kinds of [scroll-linked](https://css-tricks.com/practical-use-cases-for-scroll-linked-animations-in-css-with-scroll-timelines/) movement effects. A popular parallax effect simply resizes full-width hero images to make them slightly larger than they need to be, then adding a subtle scroll-linked movement to make it appear as if we were looking at a distant landscape through a window while moving. This is quite nice, although it does not make much sense if the pictures don't show a distant landscape.

### Parallax beyond awesome landscape images

Another reason for restricting the effect to hero images is that this circumvents a lot of the problems of more complex scenarios, as we will see when inspecting code demos below.

[![Animated website scrolling example by Andrej Sharapov on dribbble](https://cdn.dribbble.com/users/2241643/screenshots/5863059/ezgif.com-video-to-gif.gif)](https://dribbble.com/shots/5863059-CSS-mix-blend-mode-Awesome-parallax-scrolling)
Source: [CSS mix-blend-mode and Awesome parallax scrolling by Andrej Sharapov on dribbble](https://dribbble.com/shots/5863059-CSS-mix-blend-mode-Awesome-parallax-scrolling)

Another scroll-linked effect that changes the content, like overlaying a photograph over a matching drawing or wireframe model, like in the [popular Ivy Chen example](https://www.akaivyc.com), has also been listed as a parallax effect, while it's actually something completely different.

According to [Wikipedia, parallax](https://en.wikipedia.org/wiki/Parallax) is "a displacement or difference in the apparent position of an object viewed along two different lines of sight", and [parallax scrolling](https://en.wikipedia.org/wiki/Parallax_scrolling) applies this effect in analog cartoon animation films or "in computer graphics where background images move past the camera more slowly than foreground images, creating an illusion of depth in a 2D scene of distance" like the clouds in classic jump-and-run-games like Super Mario Brothers or The Great Giana Sisters.

[![animated sequence of the classic 1980s computer game Giana Sisters, found on makeagif.com](https://i.makeagif.com/media/9-22-2015/kKDOjO.gif)](https://makeagif.com/gif/c64-longplay-the-great-giana-sisters-warpless-kKDOjO)
Source: [The Great Giana Sisters](https://en.wikipedia.org/wiki/The_Great_Giana_Sisters) game sequence on [makeagif.com](https://i.makeagif.com/media/9-22-2015/kKDOjO.gif).

Unlike the classic film or computer game examples, where something runs, rides, or flies in a horizontal direction in front of a landscape, websites are typically scrolled down in a vertical direction.

### Misconceptions, outdated and complicated tutorials

I heard different things about perspective effects, from "just add a `perspective` property" to "the HTML document / body must act as a perspective parent / scrolling container, thus making it necessary to refactor our project and risk undesired side-effects on pages that don't even use the scrolling effect.

I found a relatively straightforward codepen by Keith Clark related to his 2014 [Pure CSS Parallax Websites](https://keithclark.co.uk/articles/pure-css-parallax-websites/) that I forked and modified in order to better understand and reduce to its core requirements to generate a minimal template for different kinds of parallax perspective effects that can be added to any project without breaking existing work and without needing to modify existing markup. I only succeeded kind of half way.

Some of the "pure CSS" parallax examples actually contain JavaScript, and some aspects might be outdated and obsolete nearly ten years later. But the essence is still the same! Quoting Keith's 2014 blog post:

> The `parallax` class is where the parallax magic happens. Defining the height and perspective style properties of an element will lock the perspective to its centre, creating a fixed origin 3D viewport. Setting `overflow-y: auto` will allow the content inside the element to scroll in the usual way, but now descendant elements will be rendered relative to the fixed perspective. This is the key to creating the parallax effect.

Using this technique and replacing the background layer div with a `.parallax::after` style, we should be able to achieve our goals without JavaScript, global styles and side effects.

## Pure CSS and minimal additional markup

Why would we even want to do that? While Tailwind and Bootstrap use functional classes everywhere, React projects and content management software introduce illegible generic class names based on random instance hashes, why not write HTML like it's 1999 and add a lot of new div elements to wrap our virtual layers? You might guess from my tone, and my previous articles, that's not how I prefer to code modern websites.

Trying to document how and why a decorative module introduced global styles and possible side effects, I could not help but feel I was implementing it in the wrong way.

![Screenshot of my IDE with the code mentioned below and a README section about side effects and global styles](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/bzi95pvy0qpuhnqgx807.png)

I prefer to introduce new design
- in a **modular** / atomic way to **prevent side-effects**,
- [**separating design and content**](https://en.wikipedia.org/wiki/Separation_of_concerns), providing themes as optional and interchangeable skins around the bare, semantic content,
- in a minimal way to keep my code **readable** and **reduce loading time**.

That's why I don't think that I succeeded to create a minimal, portable template for a simple parallax scrolling effect yet. But still it might be a step forward - after several steps back and forth, as you can see in this intermediate debugging screenshot, trying to understand and debug adding colorful borders and experimenting with position, height, overflow, and z-index:

![Screenshot trying to debug an intermediate stage adding colorful borders and experimenting with position, height, overflow, and z-index](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/s9y0hmlclczy9515r3kk.png)

The new code still has side-effects, as it seems that we need to make its the perspective background layer's height greater than the content, and that clipping with `overflow: hidden` did somehow break the perspective effect, so we need to give adjacent unrelated elements a higher `z-index` and define a background color to make sure that they stay on top and remain visually unaffected. Another aspect still true and already mentioned in the  ["parallax sections" chapter](https://keithclark.co.uk/articles/pure-css-parallax-websites/#parallax-sections) of Keith's good old tutorial:

> One important rule to keep in mind when grouping elements is, we cannot clip the content of a group. Setting `overflow: hidden` on a `parallax__group` will break the parallax effect. Unclipped content will result in descendant elements overflowing, so we need to be creative with the `z-index` values of the groups to ensure content is correctly revealed/hidden as the visitor scrolls through the document.

At least we could, in theory, limit our perspective effect to the parallax container so we don't need to apply global `html, body` styles. But won't that break continuous body scrolling and add scrollbars to the sections instead?

[![Side view of parallax demo layers in Keith Clark's demo #3](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/1m7dldfr5ze1329vwb2a.png)](https://keithclark.co.uk/articles/pure-css-parallax-websites/demo3/)

As we can see in the "debug mode" side view of [Keith Clark's third demo](https://keithclark.co.uk/articles/pure-css-parallax-websites/demo3/), we actually have at least three perspective layers: foreground elements, matching section backgrounds (containing background graphics), and a "deep background" which might be the document body or another parent wrapper element containing the effect to make it independent from the rest of the document.

### Contain the effect, ensure scrolling, and don't mess with the global document!

But how did that demo prevent multiple scrollbars and make sure that we can scroll the whole document in the usual way using a mouse or touchpad, either swiping, using the mouse wheel, or dragging the scrollbar, or pressing arrow keys? Well, it just didn't! There are two static elements fixed to the top and bottom of the page, but the deep background has been set to `height: 100vh; overflow-y: auto` and the document `body` to `overflow: hidden`.

<strike>I would like to move the `overflow: hidden` to our contained section without breaking the perspective effect. But do we really need to add another wrapper, when the parallax container already got the same height and overflow styles? Turns out the body styles are redundant, irrelevant, and obsolete, so I can delete this section when everything works.</strike>

![Debugging screenshot of the same demo with disabled body styles in the developer tools](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/nmepyacxagppfrn7lk1i.png)

The point is that demo doesn't use any other content sections before or after the deep background that are not pinned to an absolute position. If it did, it would have the same problem as my interim codepen: **double scrollbars** and **interrupted user experience**.

![Screenshot of the same demo with static elements before the deep background section resulting in double scrollbars](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/7gp53ybru37cbksxohxj.png)

At this point, I still failed or refused to understand why I can't simply make the deep background wrapper match its base layer's content height and clip the overflowing decorative background layer without breaking the parallax perspective effect.

### Understanding my intermediate double-scrollbars example

While the original codepen had multiple foreground elements inside the parallax (group) container, we can add another wrapper around them to make it easier to verify (and hopefully control) its height and behavior.

![Screenshot of my own codepen with added foreground wrapper element marked with a blue border](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/noll4nryj3e0j3gwmppx.png)

Now I can move any layout styles (just some padding in my minimal example) to the new foreground content wrapper and set `margin: 0; padding: 0` to the parallax (group) container.

{% codepen https://codepen.io/openmindculture/pen/BaGZBNG %}

But what happens when I change its height to match the foreground content wrapper and set decorative background, or the parent parallax (group) container, or both, to clip its overflowing content? Will that break my awesome parallax perspective effect again? It will, because we need some scrolling _inside_ the container to make the layers move. If there is no more scrolling, there is no more scrolling effect either!

### (Dis)advantages of a global body height approach

This is the reason that most of the seemingly overengineered tutorials use the whole document body as a deep background and use z-index to make unrelated content areas stay on top of the decorative background layer and have an opaque background-color, while the decorated sections have a transparent one so that the decorations are visible behind its content.

Using the document body as a deep background has the advantage that it's already there, without having to add markup outside of our parallax section / module. But we risk to interfere with other modules that might have done other things with the body, so this approach might break unrelated code, especially when used in a large project or a modular CMS environment like WordPress.

As our decorative background layer is a child of its parallax group container, its absolute positioning with a four edges set to zero offset ties its location and size where it belongs, while still allowing it to scroll more slowly due to its perspective and distance / Z-axis transformation, resulting in the desired scroll-linked parallax perspective effect. (Update: to get a deeper knowledge about adjusting and ordering chained transformations in CSS, this StackOverflow question might be a good start: [Understanding translate after scale in CSS transforms](https://stackoverflow.com/questions/65159464/understanding-translate-after-scale-in-css-transforms)

{% stackoverflow https://stackoverflow.com/questions/65159464/understanding-translate-after-scale-in-css-transforms %}

### (Dis-)advantages of old-school "parallax" approaches

But before accepting seemingly hacky necessities, I want to have another look at the seemingly simple landscape image effects again. Maybe there is some practical middle ground in between those and my previous explorations that still feel a bit like an overly complicated way to achieve the same result as setting `background-attachment: fixed` for the document body like in [this classic W3Schools How-To](https://www.w3schools.com/howto/howto_css_parallax.asp), although in that case, the background would not move at all, while in the parallax scenario it moves at another speed which can be fine-tuned, plus we can optionally add more than one background layer when using perspective techniques.

Advantages of a fixed background attachment: only a few lines of code, very easy to understand, and from a theoretical stance we might even see the fixed background as a special edge case of a perspective scenario which a distance that approximates infinity, much like looking at the moon or the stars that don't seem to move at all when changing perspective.

### 2D transformations to approach 3D perspective

[CSS Sticky Parallax Sections, a codepen by Ryan Mulligan](https://codepen.io/hexagoncircle/pen/JjRYaZw) is another example of a simplified pseduo-perspective approach without actually using three-dimensional transformations, but it's also another example of burying the actual code in beautiful unrelated styles and hiding JavaScript in the HTML tab.

The sticky background image movement only seems to work with a full-height (`100vh`) section in this codepen. If we can  use the foreground content height instead, then it would be perfect. Maybe we can modify the background's top margin or position inside its sticky container parent to control its movement explicitly.

### Accessibility: respecting prefers-reduced-motion

But there is another aspect that makes Ryan's codepen stand out: he cares about accessibility and uses a custom property to disable the perspective movement if the use prefers reduced motion:

```css
@media (prefers-reduced-motion) {
  :root {
    --scale: 0;
  }
}
```

### Even more research ...

At that point I still have not been satisfied with mind findings and understanding so far. Every example had some disadvantage that made it hard to use in another context.

- 3D perspective needs global body styles?
- 2D scaleY is contained, but needs 100vh sections?
- 2D fixed attachment does not move the background
- older tutorials depend on costly outdated JS calculations

How can it be so hard to find one tutorial that sums up the concept and provide simple, portable examples for every alternative. Shouldn't there be something like the great grid and flexbox tutorials on MDN going beyond the brief [perspective reference](https://developer.mozilla.org/en-US/docs/Web/CSS/perspective)?

![It looks like there aren't many great matches for your search](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/tui7rdhnha6t38fzxssa.png)

Proceeding my search, googling for "2d parallax approximation css", I came up with a lot of StackOverflow results, and another DEV article, written by Rob O'Leary in 2022:

{% post https://dev.to/logrocket/create-parallax-scrolling-with-css-441d %}

## Conclusion

As I "wasted" too much time on this topic already, this probably won't be the perfect roundup with ready-made recipes either - unless I do a complete rewrite some time - but I will publish it anyway, to share and back up my thoughts and findings.

### Helpful tutorials and codepens

- [Create parallax scrolling with CSS (DEV post by Rob O'Leary, 2022)](https://dev.to/logrocket/create-parallax-scrolling-with-css-441d)
- [CSS Sticky Parallax Sections (codepen by Ryan Mulligan, 2020)](https://codepen.io/hexagoncircle/pen/JjRYaZw)
- [Pure CSS Parallax Websites (blog post by Keith Clark, 2014)](https://keithclark.co.uk/articles/pure-css-parallax-websites/)
- [How to CSS Parallax (W3Schools, long ago)](https://www.w3schools.com/howto/howto_css_parallax.asp)

### Finally, a pragmatic "beyond landscape" setup

My final, clean and minimal (enough) version behaves much like the infamous "awesome landscape", but it allows to use multiple CSS backgrounds or arbitrary DOM content that moves slower than the foreground content. Note that **order matters**, so the background layer should come first in our markup.

#### Choosing 2D for its simplicity and containment

My codepen is mostly based on Ryan Mulligan's tutorial, but it did help to follow Keith Clark's actual 3D approach to understand and compare the advantages and disadvantages of both and see my own conclusions verified when I finally found Rob O'Leary's DEV post. Any parallax approach has its limitations and caveats, and all recent posts seem to agree that we should rely on pure CSS without scroll position listeners to avoid costly callbacks known to cause performance problems.

Negative `z-index` is [supported by every modern browser](https://caniuse.com/mdn-css_properties_z-index_negative_values), and so are [custom properties (CSS variables)](https://caniuse.com/css-variables). We can even add `background-attachment: fixed` to improve legacy browser support with only one additional line of code.

#### Adapting the 2D approach beyond hero images

To avoid undesirable vertical margins when using this technique with variable content height paragraphs instead of hero-style page-height sections, I tried to clip the container and give it a corresponding margin to compensate for the foreground's `margin-top: -50vh` and the background's `height: 100vh`, and I changed the latter to `min-height: 100vh`to make it useful for content of arbitrary length. Note that values below `100vh` can make our parallax section overlap other content unless we adjust the foreground's negative top margin accordingly.

![Screenshot of overlapping content marked by colorful debugging borders](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/wld34ig5bfu7m0katp9z.png)

We can't clip the outer container's `overflow-y` without clipping the background too early at its bottom, but why? Because `position: sticky` takes it out of context so its natural height is reduced to 0 – unless we add `bottom: 0` to span it to both edges of its parent container? Unfortunately that does not work in this case.

Aligning both layers using [grid](https://developer.mozilla.org/en-US/docs/Web/CSS/grid) areas (as suggested in StackOverflow answers to [position: absolute and parent height?](https://stackoverflow.com/questions/13545947/position-absolute-and-parent-height/13546011#answer-63711983) removes the perspective effect, and as far as I know, there is no native CSS property to use an element's scroll position in a `calc()` function (yet).

Pragmatically, we could use JavaScript once, and only once, to determine our foreground layer's height and write it to a custom CSS property that we can use in a [`max()`](https://developer.mozilla.org/en-US/docs/Web/CSS/max) formula to increase our parallax background's `min-height` in case `100vh` is not enough. It might also be a good idea to provide an absolute minimum height for our section, as the visual effect needs some space to unfold as intended anyway.

```css
:root {
  --parallax-min-height: 20rem;
}

.parallax__layer--background {
  min-height: max(100vh, var(--parallax-min-height));
```

So we have two variable custom properties, a scaling factor `--parallax-scale` that can be set to zero for accessibility reasons, and a `--parallax-min-height` that we can potentially increase based on a one-time measurement when the document has finished rendering (`document.addEventListener('DOMContentLoaded'` …) but that would go beyond a pure CSS solution.

#### Don't (up)scale the content for no reason

The original demo used to scale both the background and foreground, only slightly, and I wondered if that's changing the foreground content's sizes, thus breaking pixel-perfect design requirements. It doesn't, as it compensates the opposite scaling of the parent container.

#### Move and hide the overlapping top margin

We need some extra space to make the visual effect work properly, but we don't want that to break our layout if the effect is used in a normal text-with-images article context without page-height hero sections. So let's try and adjust our container's top margins and/or hide the overlap below the preceding element.

We could compensate the top offset reusing our `min-height` calculation like this:

```css
.parallax__layer--foreground {
  margin-top: calc(-1 * max(100vh, var(--parallax-min-height)));
```

But this makes both foreground and background scroll together without any offset until they reach the top of the viewport and the `sticky` position does its trick.

So we should either use the same negative top margin on the outer container and make sure its content gets hidden _below_ the preceding element, by defining another negative `z-index` and adding `position: relative`, as the implicit default `position: static` disables any `z-index` directives. Alternatively, we could apply a positive `z-index` to the preceding sections which aren't 100% independent from our changes, as we will see further below.

```css
.parallax__group {
  margin-top: calc(-1 * max(100vh, var(--parallax-min-height)));
  z-index: -1;
  position: relative;
```

This `margin-top` still does not match perfectly, as it does not compensate our Y-transformation yet. Without bothering too much about properly converting an integer scaling factor to a rem or pixel value, I'll just hard-code the actual offset like this:

```css
.parallax__group {
    3.75rem /* fixed offset adjustment */
    + 
    (-1     /* compensate background min-height */
      *
      max(100vh, var(--parallax-min-height))
    )
  );
``` 

Now we're almost done: 😉😂

![Intermediate state screenshot with overlapping content above the parallax scrolling section](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/3nzg0uu4bhivsqxpemux.png)

#### Requirement: opaque background and zero margin siblings

Now there is a side effect: even if there was a CSS selector to target a previous element, our top margin adjustment introduces a new requirement that affects unrelated content. Any element(s) before our parallax scrolling section must have an opaque (non-transparent) background, otherwise the background decoration will shine through.

The same is probably also true if we adjust the bottom end of our effect section as well. Although this side effect breaks my idealistic modular requirement, it's "only a single `background-color`" – and zero margins (we can use padding instead). That's what most (atomic) design systems usually set anyway, just like the typical `body { margin: 0; padding: 0`, so I think this solution is good enough in practice.

```css
/* recommended other elements' opaque background etc. */
body {
  margin: 0;
  padding: 0;
}

.header, .footer, .content {
  background-color: white;
  margin:0;
  padding: 1rem;
}
```

Same with the background's height and margin: it looks wrong and broken with a pattern of repeating circles, but nobody would notice when using a set of centered objects or the notorious "awesome landscape" image adjusted with `object-fit: cover` and faded out below a linear gradient, like every other tutorial and ready-to-use preset does.

![Screenshot of sticky parallax codepen highlighting the linear background making the background image fade out](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/f7k1nffdsl748sbq228h.png)

Now let's remove any debug stuff and see if it works, (re-)test alternative browsers, different viewports, and make sure that there is really is no parallax effect if the user prefers reduced motion!

### See it in action: my new codepen

{% codepen https://codepen.io/openmindculture/pen/wvQevbd %}

Source: [codepen.io/openmindculture/pen/wvQevbd](https://codepen.io/openmindculture/pen/wvQevbd)

Relevant code snippets:

```html
<section class="parallax__group">
  <div class="parallax__layer parallax__layer--background">
  </div>
  <div class="parallax__layer parallax__layer--foreground">
```

```css
:root {
  --parallax-scale: 0.1;
  --parallax-min-height: 44rem;
  --container-offset-adjustment: 5rem;
}

/* disable if requested for accessibility reasons */
@media (prefers-reduced-motion) {
  :root {
    --parallax-scale: 0;
  }
}

/* container around parallax layers */
.parallax__group {
  position: relative;
  z-index: -1;
  transform-origin: center top;
  transform: scaleY(calc(1 - var(--parallax-scale)));
  margin-top: calc(
    var(--container-offset-adjustment)
    + 
    (-1
      *
      max(100vh, var(--parallax-min-height))
    )
  );
  margin-bottom: calc(-1 * var(--container-offset-adjustment));
}

.parallax__layer {
  transform-origin: center top;
  transform: scaleY(calc(1 / (1 - var(--parallax-scale))));
}

.parallax__layer--foreground {
  position: relative;
  top: 0;
}

.parallax__layer--background {
  position: sticky;
  z-index: -2;
  top: 0;
  transform-origin: center top;
  transform: scaleY(calc(1 / (1 - var(--parallax-scale))));
  height: 100%;
  min-height: 100vh;
  min-height: max(100vh, var(--parallax-min-height));
  width: 100vw;
  background-attachment: fixed; /* legacy fallback */
  background-image: url(…); 
}

/* recommended other elements' opaque background etc. */
body {
  margin: 0;
  padding: 0;
}

.header, .footer, .content {
  background-color: white;
  margin:0;
  padding: 1rem;
}
```

That's it. This is not the perfect best-case-fits-all tutorial that I hoped to write, and neither is my code. All I can say is that it's good enough and that it helped me to better understand the concept and the necessary CSS styles. Hopefully it can help and inspire others as well and show that even senior web developers don't always come up with a perfect solution.
