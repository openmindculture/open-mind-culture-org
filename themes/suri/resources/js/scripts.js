'use strict';(function(){function a(a){function b(){for(var a=this;-1===a.className.indexOf('nav-menu');)'li'===a.tagName.toLowerCase()&&(-1===a.className.indexOf('focus')?a.className+=' focus':a.className=a.className.replace(' focus','')),a=a.parentElement}function c(a){var b,c,d,e;b=document.createTextNode('expand child menu'),c=document.createElement('SPAN'),c.appendChild(b),c.className='screen-reader-text',e=document.createElement('SPAN'),e.className='genericon genericon-expand',e.setAttribute('aria-hidden','true'),d=document.createElement('BUTTON'),d.appendChild(c),d.appendChild(e),d.className='dropdown-toggle',d.setAttribute('aria-expanded','false'),a.parentNode.insertBefore(d,a)}var d,e,f,g,h,j;if((d=document.getElementById(a),!!d)&&(e=d.getElementsByTagName('button')[0],'undefined'!=typeof e)){if(f=d.getElementsByTagName('ul')[0],'undefined'==typeof f)return void(e.style.display='none');f.setAttribute('aria-expanded','false'),-1===f.className.indexOf('nav-menu')&&(f.className+=' nav-menu'),e.onclick=function(){-1===d.className.indexOf('toggled')?(d.className+=' toggled',e.setAttribute('aria-expanded','true'),f.setAttribute('aria-expanded','true')):(d.className=d.className.replace(' toggled',''),e.setAttribute('aria-expanded','false'),f.setAttribute('aria-expanded','false'))},g=f.getElementsByTagName('a'),h=f.getElementsByTagName('ul');for(var k=0,i=h.length;k<i;k++)h[k].parentNode.setAttribute('aria-haspopup','true'),c(h[k]),j=h[k].previousSibling,j.onclick=function(){var a=this;-1===a.className.indexOf('toggled-on')?(a.className+=' toggled-on',a.parentNode.className+=' toggled-on',a.setAttribute('aria-expanded','true')):(a.className=a.className.replace(' toggled-on',''),a.parentNode.className=a.parentNode.className.replace(' toggled-on',''),a.setAttribute('aria-expanded','false'))};for(k=0,i=g.length;k<i;k++)g[k].addEventListener('focus',b,!0),g[k].addEventListener('blur',b,!0)}}(function(){var a=document.documentElement;-1!==a.className.indexOf('no-js')&&(a.className=a.className.replace(/\bno-js\b/,'js'))})(),function(){var a,b,c,d;if((a=document.getElementById('header-menu'),!!a)&&(b=document.getElementById('primary-menu'),!!b)){c=a.querySelectorAll('#header-nav > li');for(var e=0,f=c.length;e<f;e++)d=c[e].cloneNode(!0),d.className+=' moved-item',b.appendChild(d);a.className+=' hide-on-mobile'}}(),a('main-navigation'),a('header-menu'),function(){var a,b;(a=document.getElementById('secondary'),!!a)&&(b=a.getElementsByTagName('button')[0],'undefined'==typeof b||(b.onclick=function(){-1===a.className.indexOf('toggled')?(a.className+=' toggled',b.setAttribute('aria-expanded','true')):(a.className=a.className.replace(' toggled',''),b.setAttribute('aria-expanded','false'))}))}(),function(){var a=-1<navigator.userAgent.toLowerCase().indexOf('webkit'),b=-1<navigator.userAgent.toLowerCase().indexOf('opera'),c=-1<navigator.userAgent.toLowerCase().indexOf('msie');(a||b||c)&&document.getElementById&&window.addEventListener&&window.addEventListener('hashchange',function(){var a,b=location.hash.substring(1);/^[A-z0-9_-]+$/.test(b)&&(a=document.getElementById(b),a&&(!/^(?:a|select|input|button|textarea)$/i.test(a.tagName)&&(a.tabIndex=-1),a.focus()))},!1)}(),function(){var a,b;a=document.querySelectorAll('.suri-gen-b'),b=document.querySelectorAll('.suri-gen-a');for(var c=0,d=a.length;c<d;c++){var e=a[c].className,f=e.substring(e.lastIndexOf('sf-')+3,e.lastIndexOf('-sf')),g=new RegExp(' suri-gen-b sf-'+f+'-sf','g'),h=document.createElement('SPAN');h.className=f,h.setAttribute('aria-hidden','true'),a[c].insertBefore(h,a[c].firstChild),a[c].className=a[c].className.replace(g,'')}for(c=0,d=b.length;c<d;c++){var i=b[c].className,j=i.substring(i.lastIndexOf('sf-')+3,i.lastIndexOf('-sf')),k=new RegExp(' suri-gen-a sf-'+j+'-sf','g'),l=document.createElement('SPAN');l.className=j,l.setAttribute('aria-hidden','true'),b[c].appendChild(l),b[c].className=b[c].className.replace(k,'')}}(),function(){window._paq=window._paq||[],window._paq.push(['trackPageView']),window._paq.push(['enableLinkTracking']),function(){var a='//piwik.open-mind-culture.org/';window._paq.push(['setTrackerUrl',a+'js/']),window._paq.push(['setSiteId','1']);var b=document,c=b.createElement('script'),d=b.getElementsByTagName('body')[0];c.type='text/javascript',c.src=a+'js/',d.parentNode.insertBefore(c,d),b.head.appendChild(c)}(),window._paq.push(['trackPageView'])}(),function(){window.GoogleAnalyticsObject='ga',window.ga=window.ga||function(){(window.ga.q=window.ga.q||[]).push(arguments)},window.ga.l=1*new Date;var b=document,c=b.createElement('script'),a=b.getElementsByTagName('body')[0];c.type='text/javascript',c.src='//www.google-analytics.com/analytics.js',c.async=!0,a.parentNode.insertBefore(c,a),b.head.appendChild(c),ga('create','UA-105786569-1','auto'),ga('send','pageview')}()})();