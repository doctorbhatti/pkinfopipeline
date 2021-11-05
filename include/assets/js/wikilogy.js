/*======
*
* Wikilogy Scripts
*
======*/
(function($){
	'use strict';

	/*====== Admin Bar ======*/
	$(function(){
		var controlwpadminbar = $("#wpadminbar").is("div");
		if(controlwpadminbar == "") {
		} else {
			var controlwpadminbarh = $("#wpadminbar").height();

			var headerHeight = $(".header").height();
			$(".header").css('top',controlwpadminbarh + 'px');
		}
	});



	/*====== Loader ======*/
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 2000);



	/*====== Header Hover Elements ======*/
	$(function () {
		$('.header .elements .item.hover-item .icon').each(function() {
			$(this).on('click', 'i', function(){
				$(this).parent().parent().addClass('open').siblings().removeClass('open');
			});
		});

		$('.header .elements .item.hover-item .icon').each(function() {
			$(this).on('click', '.close-icon', function(){
				$(this).parent().parent().removeClass('open');
			});
		});
	});



	/*====== Header Sidebar ======*/
	$(document).on('click', '.header .elements .header-sidebar .content .close-button, .header .elements .header-sidebar.open .overlay', function(){
		$('.header .elements .item.hover-item.header-sidebar').removeClass('open');
	});

	$(function() {
		if($('.header-sidebar li.dropdown .dropdown-menu').length){
			$('.header-sidebar li.dropdown').append('<i class="fas fa-chevron-down"></i>');
			$('.header-sidebar li.dropdown .fa-chevron-down').on('click', function() {
				$(this).prev('.dropdown-menu').slideToggle(500);
			});
		}

		$('.header-sidebar .content-wrapper').scrollbar();
	});



	/*====== Mobile Header ======*/
	$(document).on('click', '.mobile-menu-icon', function(){
		$('.mobile-header-sidebar').addClass('open');
	});

	$(document).on('click', '.mobile-header-sidebar.header-sidebar.open .overlay, .mobile-header-sidebar.header-sidebar .content .close-button', function(){
		$('.mobile-header-sidebar').removeClass('open');
	});



	/*====== Toolbar ======*/
	$(function() {
		$('.wikilogy-toolbar .comments').click(function() {
			var target = $("#comments");
			$('html,body').animate({
				scrollTop: target.offset().top
			}, 1000);
			return false;
		});

		var toolbarHeight = $('.wikilogy-toolbar ul').height();
		$('.wikilogy-toolbar').css('height', toolbarHeight + 'px');

		$('.wikilogy-toolbar .print').click(function() {
			window.print();
			return false;
		});

		$('.wikilogy-toolbar ul li .icon .plus').on('click', function () {
			$('.single-content .post-content').animate({'font-size': '+=1'});
		});

		$('.wikilogy-toolbar ul li .icon .minus').on('click', function () {
			$('.single-content .post-content').animate({'font-size': '-=1'});
		});
	});



	/*====== Title ======*/
	$(function () {
		$('.wikilogy-title.style-1,.wikilogy-title.style-2,.wikilogy-title.style-3').each(function() {
			var shadowHeight = $(this).find(".shadow-title").height();
			$(this).css('min-height', shadowHeight + 'px');
		});
	});



	/*====== CS Select ======*/
	$(document).ready(function(){
		(function() {
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
				new SelectFx(el);
			} );
		})();
	});



	/*====== Custom Slick ======*/
	function wikilogySlider() {
		$('.wikilogy-slider').each( function() {
			var slick = $(this),
				autoplay = $(this).data('autoplay'),
				autospeed = $(this).data('autospeed'),
				arrows = $(this).data('arrows'),
				fade = $(this).data('fade'),
				centeritem = $(this).data('centeritem'),
				centerpad = $(this).data('centerpad')+'px',
				dots = $(this).data('dots'),
				item = $(this).data('item'),
				slidetoitem = $(this).data('slidetoitem'),
				speed = $(this).data('speed'),
				asNavFor = $(this).data('asNavFor'),
				focusselect = $(this).data('focusselect'),
				rtl = $(this).data('rtl'),
				prevarrow = $(this).data('prevarrow'),
				nextarrow = $(this).data('nextarrow'),
				infinite = $(this).data('infinite');

			slick.slick({
				autoplay: autoplay,
				autoplaySpeed: autospeed,
				arrows: arrows,
				dots: dots,
				fade: fade,
				centerMode: centeritem,
				centerPadding: centerpad,
				slidesToShow: item,
				slidesToScroll: slidetoitem,
				speed: speed,
				asNavFor: asNavFor,
				focusOnSelect: focusselect,
				rtl: rtl,
				infinite: infinite,
				prevArrow: prevarrow,
				nextArrow: nextarrow,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: item < 5 ? item: 4,
						}
					},
					{
						breakpoint: 1198,
						settings: {
							slidesToShow: item < 4 ? item: 3,
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: item < 3 ? item: 2,
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: item < 2 ? item: 1,
						}
					}
				]
			});
		});
	}
	wikilogySlider();



	/*====== Tooltip ======*/
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});



	/*====== Scroll Link ======*/
	$(function () {
		$('a.gt-ref-tooltip[href*="#"]:not([href="#"]), .content-index ul li a').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});



	/*====== Search Form ======*/
	$(function(){
		$(window).resize(function(){
			var windowy = $(window).height();
			$('.wikilogy-search-form.style-3 .wikilogy-slider .item').css('height',windowy + 'px');
			$('.wikilogy-search-form.style-3').css('height',windowy + 'px');
		}).resize();
	});



	/*====== Blog Tabs ======*/
	$('.blog-tabs .tab-content .tab-pane:first-child').addClass('active show');
	$('.blog-tabs ul.tab-list li:nth-child(2) > a').addClass('active show');



	/*====== Content Table ======*/
	$(function () {
		$(document).on('click', '.content-index .close-button', function(){
			$('.content-index').addClass('closed');
		});
	
		$(document).on('click', '.closed .close-button', function(){
			$('.content-index').removeClass('closed');
		});

		if ($(window).height() < 450) {
			var contentIndexHeight = 150 + 55 + 20 + 40;
			$('.content-index').css('height', contentIndexHeight + 'px');
		} else {
			var contentIndexHeight = $('.content-index ul').height() + 55 + 20 + 40;
			$('.content-index').css('height', contentIndexHeight + 'px');
		}

		$('.content-index ul').scrollbar();
	});



	/*====== Toolbar ======*/
	$(function () {
		$(document).on('click', '.wikilogy-toolbar .close-button', function(){
			$('.wikilogy-toolbar').addClass('closed');
		});
	
		$(document).on('click', '.wikilogy-toolbar.closed .close-button', function(){
			$('.wikilogy-toolbar').removeClass('closed');
		});
	});



} )( jQuery );