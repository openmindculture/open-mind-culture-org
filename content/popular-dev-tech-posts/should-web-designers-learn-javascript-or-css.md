# Should web designers learn JavaScript or CSS?

"Do designers need to learn JavaScript?" is a popular question, but what does "learning JavaScript" mean precisely? And why would you ask this question as a web designer? Do you want more control, improve communication with developers, or do you think you'll lose your job if you don't keep up with new technologies?

Should web developers learn design theory or, better, attend a Fimga masterclass or an Illustrator training?

Maybe we all, developers and designers, should learn and practice better communication and documentation first.

## Web technologies that designers can learn

As a developer, there is always something new that you can learn.

But which technologies should you learn as a designer?

- **HTML** (basic knowledge): important, and not _that_ hard
- **CSS**/SCSS: very important, very useful, often underrated
- **JavaScript**/TypeScript/React etc.: keep learning forever?
- WordPress, WebFlow, Shopify, Shopware, Drupal etc.: dto.?

I doubt that there is anyone who knows everything about JavaScript, including all libraries and frameworks, and even if they did, something new will pop up next month or next year!

Likewise, you can spend years learning about e-commerce or content management systems like WordPress.

Some concepts that you should you know:

- **accessibility** (a11y): everyone should be able to use it
- **progressive enhancement**: even in a very old browser
- **responsive web design** (RWD): no matter what screen size
- **web performance** (webperf): don't waste users' time and money
- **sustainable web development** (sustyweb): don't waste (fossil) energy
- **test-driven development** (TDD): verify that you're doing it correctly
- **atomic design**: start with small, reusable elements
- ...

I recommend that everyone, designer or developer, starts with the basics of web development: HTML and CSS!

### HTML in a nutshell

Add hidden markup (tags) to your content to define its structure, **emphasize** words, and add [links](https://en.wikipedia.org/wiki/Hyperlink) and images.

```html
define its structure, <strong>emphasize</strong> words, and add 
<a href="https://en.wikipedia.org/wiki/Hyperlink">links</a>
and images.</p>
```

We can use HTML for simple formatting like bold text, headlines, and lists. We can also create web forms to send information to a server. But we need **style sheets** (CSS) to define colors and more advanced styling.

### CSS: underrated, powerful, and (un)forgiving

CSS has been criticized for its inconsistencies, complication, and gotchas. It can be frustrating to rephrase the same simple statement over and over and still not be able to adjust an element's font size or centered position.

CSS is **forgiving** in the same sense as HTML. They both follow the principles of **robustness** and **progressive enhancement**. A typo or a new rule not supported by your browser yet will not necessarily cause the whole website to disappear and display a cryptic error message instead. It's much easier to break a React or JavaScript application than to break CSS or HTML.

But CSS becomes **unforgiving when you don't close brackets** and quotation marks correctly.

```css
footer .curly-style {
  display: curly; /* "curly" is unknown, this line will be ignored */
  background: blue; /* this line will work */

footer.footer--alternative {
  background: red;
  /* this won't, because you forgot to close the brackets above! */
```

Coding became easier thanks to syntax highlighting and automatic code completion. Noticing that `footer.footer--alternative` has different colors than `footer .curly-style` should already raise suspicion, even if your code editor doesn't warn you.

We don't need to memorize every detail when there are tools (like the free Visual Studio Code editor) that will tell us if it's "whitespace: no-wrap" or "white-space: nowrap". (The second one is correct.)

Modern browsers' developer tools ("inspect element" mode) will even show why certain CSS rules do not affect a specific element.

![Screenshot of developer tools showing the text quoted below](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/h4edc0osq1c4vrzn6alc.png)

Helpful advice? "The display: inline property prevents align-items from having an effect. Try adding display: grid or display: flex to make this element into a container," is factually correct, but "try using text-align: right" might have been closer to the designer's intention.

### Begin with the basics

Understand the basic concepts of web technologies. Understand **cascading**, **inheritance**, and **specificity** in CSS! Learn about **shorthand** and different color and transparency/opacity **notations**. Understand absolute and relative positioning, different kinds of units, and the concept of responsive web design!

You don't need to prepare to answer theoretical interview questions about the correct naming, better experiment in your browser's developer tools or in a [codepen](https://codepen.io/) to get a feeling for what works and what doesn't.

Even if you only use "no-code" tools like Webflow or Elementor or if you design layouts in Figma and never write a line of code, it helps to be aware of those concepts and challenges.

It also helps to know about CSS's / browsers' limitations. Yes, there are still limitations! And there are still some customers or CEOs visiting websites in their outdated mini-iPhones.

Useful resources to learn and look up:
- [Mozilla Developer Network (MDN)](https://developer.mozilla.org/)
- [CanIUse](https://caniuse.com/)...
- [CSS-Tricks](https://css-tricks.com/)
- [web.dev](https://web.dev/)
- [Smashing Magazine](https://www.smashingmagazine.com/)
- [StackOverflow](https://stackoverflow.com/)

There are many great (free) tutorials about web development written by designers, speakers, and authors like [Sara Soueidan](https://www.sarasoueidan.com/), [Lea Verou](https://lea.verou.me/), [Rachel Andrew](https://rachelandrew.co.uk/), or [Temani Afif](https://css-articles.com/) and (paid) online training on sites like [frontendmasters.com](https://frontendmasters.com/).

#### Why is everybody telling you something different?

Web development is complex, so there is always more than one way to solve a problem. That's a good thing, but it can also cause misunderstandings and unhelpful discussions.

#### Frontend development divide: UX vs. JavaScript?

Personally, I am opinionated towards the classic, accessible, and visual side of ["the great divide"](https://css-tricks.com/the-great-divide/) of frontend development, sometimes also known as **UX engineering** or **creative web development**. Others, often those coming from algorithmic programming, backend development, and computer science, often tend to neglect design and usability to focus on business logic and consequentially, they rely more on JavaScript and less on CSS in their daily work. But that's my point of view. In the end, we should all work together and combine our expertise!

### Beyond the basics

Beyond the basics, there are popular tools to fill in the gaps of existing technology and make life easier for designers and developers. `SCSS` and `less` are just CSS plus some extra possibilities. `Sass` was an alternative way to write SCSS, and it's hardly used by anyone anymore. If some people say "Sass" they usually mean SCSS. Better ask, if in doubt.

Likewise, there is more to JavaScript than just "JavaScript". Officially, it's not even called "JavaScript" anymore, but have you ever heard someone say that they code in **ECMAScript**? Maybe they'd say they use "JS with **ES**6 syntax" or "prefer **TypeScript**". Another new language worth learning?

TypeScript is to JavaScript what SCSS is to CSS: something more complex and powerful, but viewed from a distance, it's still basically the same.

There's also [JSX](https://en.wikipedia.org/wiki/JSX_(JavaScript)), a notation that looks much like HTML, while it's rather JavaScript, and there is [Markdown (MD)](https://en.wikipedia.org/wiki/Markdown), a simple alternative to HTML, often used for documentation and blogging. This is Markdown:

```markdown
## What we can do with HTML or Markdown

We can define structure, **emphasize** words, and add 
[links](https://en.wikipedia.org/wiki/Hyperlink) and images.
```

Less popular, but promising: [HTMX](https://htmx.org/) looks like a mixture of JSX and Vue.js notation, while [MDX](https://mdxjs.com/) combines JSX with Markdown. Just a simple example:


```js
import {Chart} from './snowfall.js'
export const year = 2023

# Last year’s snowfall

In {year}, the **snowfall** was above average.
Source: [BBC weather](https://www.bbc.com/weather)

<Chart year={year} color="#fcb32c" />
```

Confused? We didn't even approach common single page web app (SPA) concepts like [state management](https://en.wikipedia.org/wiki/State_management) or [memoization](https://en.wikipedia.org/wiki/Memoization) (and we won't, I promise!)

There are loads of specialized ("domain-specific") languages, but most have a lot in common, so they become easier to learn when you already know some others. Each one uses a limited number of special characters to delimit tags and attributes, and many values are exactly the same, like the hex color notation `#fcb32c` in the example above.

### JavaScript / TypeScript / React / Angular: it depends...

You don't need to _know_ JavaScript as a designer. However, understanding the basics can empower you to read JavaScript good enough to know where to change an image file name or a default value without breaking the code.

Most of the classic use cases that made JavaScript popular in the 1990s can (and should be) done in CSS now, like changing an image or a text color when hovering the mouse pointer over an element. Some of the old JavaScript tutorials are easy to understand and still useful to get a feeling for what is happening.

JavaScript in 1999 (still works, but don't do that):

```html
<img src="example.gif" 
  onMouseOver="this.src='example-over.gif'" 
  onMouseOut="this.src='example.gif'">
```

That's short to read but limited to one element. You must copy the same code to other elements and find all occurrences if you need to edit the image filename later. Also, you might get confused where to put which kind of quotation marks.

JavaScript in 2024:

```html
<img src="example.png" class="hoverable">
<script>
let hoverableImages = document.getElementsByClassName('hoverable'); 
for (let i=0; i <  hoverableImages.length; i++) { 
  hoverableImages[i].addEventListener('mouseover',(event) => {
    event.target.src='example-over.gif';
  });
  hoverableImages[i].addEventListener('mouseout',(event) => {
    event.target.src='example-out.gif';
  });
}
</script>
```

This is a contrived example, but that's still the simple way of complicating things. In ReactJS, you could create several components and learn an additional language, JSX, to write complex source code, only to achieve the same effect that you could easily achieve with pure CSS, at least in theory.

#### Simple kinds of complication

In practice, I would either go for background images (but that hinders accessibility) or another image element, and we would have to move the mouseOver effect to a new container element then:

```css
<div class="hoverableContainer">
  <img src="example.png">
  <img src="example-over.png" class="initially-hidden">
</div>
<style>
.initially-hidden {
  display: none;
}
.hoverableContainer:hover img:first-child {
  display: none;
}
.hoverableContainer:hover img.initially-hidden {
  display: block;
}
</style>
```

Still, we only need to apply future changes once, and our CSS version has a simpler syntax than its JavaScript equivalent, so it's hopefully easier not to break the code.

### Descriptive naming

As you can see, even this seemingly simple example starts getting quite complex if you try to follow current coding standards and recommendations. But maybe you can also see another aspect: if I, as a developer, make an effort to choose descriptive namings, you might still be able to guess what's happening just by reading my code, even if you couldn't code anything like that yourself.

There are popular naming methodologies like [BEM](https://getbem.com/) (block, element, modifier), but in practice, we often don't or can't stick to one naming system concisely.

### Naming conventions that nobody told me about

There have been controversies about code comments and commit messages. Many developers who are good at coding don't have the same skill level regarding communication. So they try to use descriptive namings and code comments but still only state the obvious, like adding a road sign "that's a STOP sign" next to the actual stop sign.

Designers might be prone to similar miscommunication. If I open a Fimga layout as a developer and click on an element to inspect its details, I might find information that reads "Ag H1 Brand Default". It's not the designer's fault that Figma adds the (actually helpful) "Ag" typography example, but I had been trying to find a meaning in those letters for years! 😂

### "Ag" !?!

![Image description](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/4mg226qpj22o9kh1a4gy.png)

Source: Adobe Font Tool after visual search failed

It would have helped me much if those typographic examples would have been labeled even more redundantly with a text like "Primary Font usually used in Headlines H1, H3, H4 (but not H2); 1 of 3 brand fonts in this design system".

### Constraints and consistency

"Explicit is better than implicit" is a helpful directive in software development. Define your constraints: if there are font sizes of 12 and 14, does that mean it can only be one of those two, or does it mean the font size could be any other whole number (integer) or even a fractional value like 12.5? What's the entity? Points? Pixels? Percentages?

### Be explicit

Back to theory and practice, we don't need to know everything, and we don't need to follow any paradigm or theory unless it makes sense. But scientists have gained knowledge by questioning assumptions. We can still follow our hearts and gut feelings, but we can add some rational methodologies to make our work even better and prevent wasting time and mental load getting lost in misunderstandings.

## Conclusions

### Should designers learn JavaScript or CSS?

Summing up my rants and ravings, I want to advocate a pragmatic way to combine theory and practice. I have attended some university seminars but never finished with a degree. Instead, I joined a web design and development startup as a co-founder in the millennial years before resuming what I had missed by attending meetups and guest lectures at other startups and our local university.

#### Takeaways for designers and developers:

Learn the basic concepts of:
- HTML
- CSS
- accessibility ([WCAG](https://en.wikipedia.org/wiki/Web_Content_Accessibility_Guidelines))
- file types and file transfer (images, zip archives, (S)FTP)
- JavaScript (or another programming language, like Python)
- version control (git, GitHub)
- search engine optimization (SEO) and marketing
- communication, collaboration, project management
- AI (what it can and what it can't do)
- economics (how to run a business and bill your customers)
- ecology, sociology and culture - because we don't want to be nerds but take part in all aspect of society!

As a web designer, you can safely ignore node, npm, docker, and how to maintain a web server.

### Dev + UX/UI: Let's bridge the gap!

Designers and developers should collaborate more early and more often! This benefits our customers and helps us create beautiful and elegant websites that work for everyone.

Interested? [Contact me](https://www.ingo-steinke.com/) and let's work together!
