# CSS :has(.parent-selectors) 👪

I wonder why I have to follow "Tech Twitter" to find out the good news, so I'm the one to write a short post here on dev.to to celebrate a new CSS feature:

"Parent selectors", the second most awaited CSS feature according to [State of CSS survey 2021](https://2021.stateofcss.com/en-US/opinions), also known as the **has-selector**, have got browser support!

To quote Sara Soueidan quoting Jen Simmons on Twitter:

> :has() is essentially the long-awaited parent selector in CSS 🎊
>> Don’t say Safari is always last. Sometimes we are first.

[![Sara Soueidan quoting Jen Simmons on Twitter: :has() is essentially the long-awaited parent selector in #CSS](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/5zv9vejovlkqdq40s5xp.png)](https://twitter.com/SaraSoueidan/status/1473172721643278338)

But before celebrating this time's "Safari first", be aware that you might not have a browser to test parent selectors early in 2022 yet. Safari updates currently [don't ship or install on older Apple operating systems](https://dev.to/ingosteinke/comment/1m2bg).

## No longer "Missing from CSS"

Now parent selectors are no longer missing from CSS, let's hope that Firefox and Chromium follow quickly.

[![CSS2021 Features missing from CSS](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/yc87lhiowkhxll5yx207.png)](https://2021.stateofcss.com/en-US/opinions)

### What does a "Parent Selector" select?

Parent selectors select parent elements, right? They actually select grandparents and any matching ancestors as well.

I haven't been the only one thinking of `:has()` as a "child selector", so should I call them "has-selectors" to avoid misunderstanding?

[Timothy Huang called `:has()` "a CSS-selector that (selects) a parent with child](https://dev.to/timhuang/css-select-a-parent-with-condition-452m) which sounds like an appropriate description to me.

From [caniuse.com/css-has](https://caniuse.com/css-has):
> For example, `a:has(>img)` selects all `<a>` elements that contain an `<img>` child.

[The `:has()` CSS pseudo-class is documented well on MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/:has).

## Performance Considerations

The main reason that is took so long to implement is the fear of costly calculations. Parent selectors might be a feature that can hurt your site's speed and performance when applied to a document in real time.

[Chris Coyier cited Jonathan Snook (back in 2010)](https://css-tricks.com/parent-selectors-in-css/) "that when elements are dynamically added and removed from the page, it may result in the entire document needing to be re-rendered (major memory usage concerns)".

Maybe we should probably be extra careful to measure our performance when we actually start using parent selectors?

### Implementation that sidesteps Performance Issues:

Update: the performance problems have probably been solved. Eric Meyer mentioned a talk about nerdy details of how the implementation sidesteps performance issues.

[![Eric Meyer on Twitter about nerdy details of how this implementation sidesteps the performance issues](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/euhsjnxfvwwkjsyjkqam.png)](https://twitter.com/meyerweb/status/1473049543423975432)

After [watching Byungwoo Lee on YouTube](https://www.youtube.com/watch?v=bEcNxI0MYzk), I would say that the Blink engine's strategy is somehow similar to the efficiency of a chess engine that must figure out how to ignore irrelevant moves quickly instead of predicting every possible outcome of every possible combination of moves.

In the case of CSS, the Blink engine will prevent walk up and invalidation on irrelevant elements. To reduce the irrelevant recalculations after applying the style, the engine can mark if a style is affected by a `:has()` state change during the recalculation.

But let Byungwoo Lee explain the details of the problems and solutions implementing parent selectors.

{% youtube bEcNxI0MYzk %}

His explanation includes complex use cases like

`.a:has(.b ~ .c)`

or

`.a:is(:has(b), :has(c))`

Wow! I didn't even know that could be valid CSS.

Never stop learning! But still don't show code like that to me in a code review. I will probably request you to refactor that to something which is more easy to understand and maintain for the human brain!

### Actual Use Case

As I see many people struggle to contrive examples how to make use of has selectors: lucky you!

Here is a real world example: I had to hotfix a Shopware theme that had already been hotfixed before, and it was urgent and `!important`, so no clean code at that part of the roadmap at least.

I wish I had been able to use `:has()` here, to lower the risk of accidentally targeting the wrong elements in the CMS-generated markup. The selector is so long that you have to scroll to see all of it!

```css
/* override template heading style */
body.is-act-index .cms-sections .col-12 .cms-element-alignment.align-self-start {
```

Using `has` makes the fix at least a little bit clearer:

```css
/* override template heading style */
body.is-act-index .cms-element-alignment:has(> h1) {
```

We might want to write that code just for the sake of readability. But we have to ensure browser support.

### How to Polyfill :has() Selectors?

As there is no way to workaround parent selectors in recent CSS syntax, they can't be transpiled. Don't hope for [PostCSS](https://postcss.org) or [SASS](https://sass-lang.com)! This time you will need JavaScript to polyfill older browsers.

"jQuery has had the :has selector in its arsenal since basically forever", [Eric Ponto wrote in 2015 already](https://www.ericponto.com/blog/2015/01/10/has-pseudo-class-parent-selector/) showing a polyfill based on jQuery:

```javascript
Polyfill({
	selectors: [":has"]
}).doMatched(rules => {
	rules.each(rule => {
		// just pass it into jQuery since it supports `:has`
		$(rule.getSelectors()).css(rule.getDeclaration())
	});
});
```

## Quiz: How to polyfill without using jQuery?

Take the quiz and submit your Vanilla JS solution!

```
// TODO: add a parent selector polyfill without using jQuery
```

If you know the solution, you can also post it as an answer to the [StackOverflow question if there is a vanilla JS equivalent of jQuery .has()](https://stackoverflow.com/questions/49393309/is-there-a-vanilla-js-equivalent-of-jquery-has).

### querySelectorAllWithHas

[Josh Larson's polyfill-css-has](https://github.com/jplhomer/polyfill-css-has) provides a `querySelectorAllWithHas` (thanks to @lukeshiru for the link!)

But we have managed to live without parent selectors for so long, maybe we don't want to worry anymore, and rather move on to there next upcoming upgrades to the CSS language:

## What's next in CSS?

What to expect from CSS in 2022?

There are more useful features in the pipeline, like [CSS Container Queries](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Container_Queries) which we can already use  in Chrome and Edge by enabling them using feature flags.

This article is part of a small series about new (and underrated) CSS features that you can start to learn and use in 2022. If you are looking for a comprehensive overview of what has been new in CSS in 2022, have a look at @this-is-learning's [review of the state of CSS report 2022](https://dev.to/this-is-learning/review-of-the-state-of-css-2022-2d0h) and find some more useful resources in my [2021/2022 dev bookmarks / reading list post](https://dev.to/ingosteinke/dev-bookmarks-reading-list-excerpts-for-2023-1opf).

{% post https://dev.to/this-is-learning/review-of-the-state-of-css-2022-2d0h %}

{% post https://dev.to/starbist/i-am-not-that-excited-about-new-css-features-4jb5 %}

{%post https://dev.to/ingosteinke/dev-bookmarks-reading-list-excerpts-for-2023-1opf %}
