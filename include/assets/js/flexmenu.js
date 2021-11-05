/*======
*
* Flex Menu
*
======*/
/*	jQuery.flexMenu 1.4.2
	https://github.com/352Media/flexMenu
	Description: If a list is too long for all items to fit on one line, display a popup menu instead.
	Dependencies: jQuery, Modernizr (optional). Without Modernizr, the menu can only be shown on click (not hover). */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function f(){a(window).width()===b&&a(window).height()===c||(a(d).each(function(){a(this).flexMenu({undo:!0}).flexMenu(this.options)}),b=a(window).width(),c=a(window).height())}function g(b){var c,d;c=a("li.flexMenu-viewMore.active"),d=c.not(b),d.removeClass("active").find("> ul").hide()}var e,b=a(window).width(),c=a(window).height(),d=[];a(window).resize(function(){clearTimeout(e),e=setTimeout(function(){f()},200)}),a.fn.flexMenu=function(b){var c,e=a.extend({threshold:2,cutoff:2,linkText:"More",linkTitle:"View More",linkTextAll:"Menu",linkTitleAll:"Open/Close Menu",showOnHover:!0,popupAbsolute:!0,popupClass:"",undo:!1},b);return this.options=e,c=a.inArray(this,d),c>=0?d.splice(c,1):d.push(this),this.each(function(){function s(a){var b=Math.ceil(a.offset().top)>=i+j;return b}var k,l,m,n,o,q,r,b=a(this),c=b.find("> li"),d=c.first(),f=c.last(),h=b.find("li").length,i=Math.floor(d.offset().top),j=Math.floor(d.outerHeight(!0)),p=!1;if(s(f)&&h>e.threshold&&!e.undo&&b.is(":visible")){var t=a('<ul class="flexMenu-popup" style="display:none;'+(e.popupAbsolute?" position: absolute;":"")+'"></ul>');for(t.addClass(e.popupClass),r=h;r>1;r--){if(k=b.find("> li:last-child"),l=s(k),r-1<=e.cutoff){a(b.children().get().reverse()).appendTo(t),p=!0;break}if(!l)break;k.appendTo(t)}p?b.append('<li class="flexMenu-viewMore flexMenu-allInPopup"><a href="#" title="'+e.linkTitleAll+'">'+e.linkTextAll+"</a></li>"):b.append('<li class="flexMenu-viewMore"><a href="#" title="'+e.linkTitle+'">'+e.linkText+"</a></li>"),m=b.find("> li.flexMenu-viewMore"),s(m)&&b.find("> li:nth-last-child(2)").appendTo(t),t.children().each(function(a,b){t.prepend(b)}),m.append(t),n=b.find("> li.flexMenu-viewMore > a"),n.click(function(a){g(m),t.toggle(),m.toggleClass("active"),a.preventDefault()}),e.showOnHover&&"undefined"!=typeof Modernizr&&!Modernizr.touch&&m.hover(function(){t.show(),a(this).addClass("active")},function(){t.hide(),a(this).removeClass("active")})}else if(e.undo&&b.find("ul.flexMenu-popup")){for(q=b.find("ul.flexMenu-popup"),o=q.find("li").length,r=1;r<=o;r++)q.find("> li:first-child").appendTo(b);q.remove(),b.find("> li.flexMenu-viewMore").remove()}})}});