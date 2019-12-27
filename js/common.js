(function ( $, window, document) {
  'use strict';
  
   var $window = $(window),
   $document   = $(document),
   windowH     = $window.height(),
   windowW     = $window.width();

	/* Sticky Menu */
	if ($window.width() > 943) { 
		stickyMenu();
		function stickyMenu() {
			var el = $('.gfx-header nav.sticky-on');
			var headH = el.outerHeight() + 100;
			var elH = el.outerHeight();
			$window.scroll(function() {
				if($window.scrollTop() >= headH) {
					el.addClass('sticked');
					$('.gfx-header').css('padding-top', elH);
				} else {
					el.removeClass('sticked');
					$('.gfx-header').css('padding-top', '0px');
				};
			});
		};
	}

	$('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
  $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');

  $(document).click(function(e){
		if($(e.target).parents('.menu').length === 0)
		$(".menu > ul").removeClass('show-on-mobile');
  });

  $(".menu > ul > li").click(function() {
		var thisMenu = $(this).children("ul");
		if ($window.width() < 943) {
			thisMenu.slideToggle(300);
		}
  });
  
  $(".mobile-nav-trigger").click(function (e) {
    e.preventDefault();
      $(".mega-mnu").addClass("active");
			$(".main-nav").addClass("v-hidden");
			$('body').addClass('o-hidden');
	});
	
	$('.close-btn').click(function(){
		$(this).parent().removeClass('active');
		$('.main-nav').removeClass('v-hidden');
		$('body').removeClass('o-hidden');
	});

})( jQuery, window, document );

(function($) { 
	$(document).ready(function(){

		$('.phone').mask('+7 (000) 000-00-00');


		//Карта
		$(function(){

			function new_map( $el ) {
				var $markers = $el.find('.marker');
				var args = {
						center		: new google.maps.LatLng(0, 0),
						zoom      : 8
				};
								 
				var map = new google.maps.Map( $el[0], args);
				map.markers = [];
				$markers.each(function(){	
						add_marker( $(this), map );	
				});
				center_map( map );
				return map;
			}
			
			function add_marker( $marker, map ) {
				// var
				var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
				// create marker
				var marker = new google.maps.Marker({
					position	: latlng,
					map			: map
				});
				// add to array
				map.markers.push( marker );
				// if marker contains HTML, add it to an infoWindow
				if( $marker.html() )
				{
					// create info window
					var infowindow = new google.maps.InfoWindow({
						content		: $marker.html()
					});
					// show info window when marker is clicked
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open( map, marker ); 
					});   }  
			}
			
			function center_map( map ) {
				// vars
				var bounds = new google.maps.LatLngBounds();
				// loop through all markers and create bounds
				$.each( map.markers, function( i, marker ){ 
					var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() ); 
					bounds.extend( latlng );
				});
				// only 1 marker?
				if( map.markers.length == 1 )
				{
					// set center of map
						map.setCenter( bounds.getCenter() );
						map.setZoom( 16 );
				}
				else
				{
					// fit to bounds
					map.fitBounds( bounds );
				}
			
			}
			
			var map = null;
			
			$('.acf-map').each(function(){
				map = new_map( $(this) );
			});
	
		});

		//spam protection
		$('.agree').prop('checked', false); 
		$('.wpcf7-submit').removeAttr('disabled', false); 
	
	 
		//accordeon ==================================================
		$(function(){
			$('.accordeon_content').hide();
			$('.accordeon_title').click(function(){
				$(this).parent().toggleClass('active').siblings().removeClass('active');
				$('.accordeon_content').slideUp();
				if(!$(this).next().is(":visible")) {
					$(this).next().slideDown();
				}
			});
		});
	
		// fancybox initialize
		$('[data-fancybox="gallery"]').fancybox({
			protect: true, 
			mobile : {
				thumbs : false,
				protect: true,
			}
		});
		
		$('[data-fancybox]').fancybox({
			clickOutside: "close"
		});

		$('.apartments-wr-item').click(function(){
			var title = $(this).data('title'), 
					number = $(this).data('number'), 
					price = $(this).data('price'), 
					img = $(this).data('img'), 
					m2 = $(this).data('m2'),
					gk = $(this).data('gk');
			$.fancybox.open({
				src  : '#apartments-popup-item',
				type : 'inline',
				opts : {
					beforeLoad : function( e ) {
						var wr = $(e.current.src);

						//Текст
						wr.find('.title').html(title);
						wr.find('.number').html(number);
						wr.find('.price').html(price);
						wr.find('.img').css('background-image', 'url(' + img + ')');
						wr.find('.m2').html(m2);

						//Форма
						wr.find('.r-form-title').val(title)
						wr.find('.r-form-number').val(number)
						wr.find('.r-form-price').val(price)
						wr.find('.r-form-m2').val(m2)
						wr.find('.r-form-gk').val(gk)

					},
					afterClose : function( e ) {
						$('.popup-img').addClass('active');
						$('.popup-form').removeClass('active');
						$('.popup-btn').show();
					}
				}
    	});
		});

		$('.popup-btn').click(function(){
			$('.popup-img').toggleClass('active');
			$('.popup-form').toggleClass('active');
			$(this).hide();
		});
	
		// Scroll to Top ================================================== 
		$(window).scroll(function() {
			if ($(this).scrollTop() >= 1500) {
				$('#return-to-top').fadeIn(200); 
			} else {
				$('#return-to-top').fadeOut(200); 
			}
		});
	
		$('#return-to-top').click(function() {
			$('body,html').animate({
				scrollTop : 0          
			}, 500);
		});

		$('.header__slider-carousel').slick({
			infinite: true,
			arrows: false,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1
		});

		$('.object-s-slider').slick({
			infinite: true,
			arrows: true,
			dots: false,
			fade: true,
			slidesToShow: 1,
			slidesToScroll: 1
		});

		$('.object-s-gallery-slider').slick({
			infinite: true,
			arrows: true,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3
					}
				}
			]
		});

		// REASONS SLIDER
		$('.reasons__slider').slick({
			infinite: true,
			arrows: true,
			dots: false,
			centerMode: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 1,
						centerMode: false,
					}
				},
				{
					breakpoint: 1200,
					settings: {
						dots: true,
						arrows: false,
						centerMode: true,
					}
				}
			]
		});

		$(".js-range-slider").ionRangeSlider({
			skin: "round",
			type: "double",
			min: 0,
			max: $(".js-range-slider").data('max'),
			from: $(".js-range-slider").data('from'),
			to: $(".js-range-slider").data('to'),
			drag_interval: true,
			min_interval: null,
			max_interval: null,
			postfix: "руб.",
			onChange: function (data) {
				updateInputFromRange(data.from, data.to)
			},
		});
		
		var my_range = $(".js-range-slider").data("ionRangeSlider");
		window.my_range = my_range;

		var options =  {
			reverse: true,
			onKeyPress: function(cep, event, currentField, options){
				switch (currentField.data('type')) {
					case 'from':
						my_range.update({from: cep.replace(/\./g, "")});
						break;
					case 'to':
						my_range.update({to: cep.replace(/\./g, "")});
						break;
				
					default:
						break;
				}
			}
		};
		$('.input-price').mask('000.000.000.000.000', options);

		window.changeRange = function(from, to) {
			window.my_range.update({from});
			window.my_range.update({to});
			updateInputFromRange(from, to);
		}
		

		function updateInputFromRange(from, to) {
			const fromInput = $('input[name=price-from].input-price');
			const toInput = $('input[name=price-to].input-price');

			fromInput.val(maskNum(from));
			toInput.val(maskNum(to));
		};

		function maskNum(num) {
			return $('.input-price').masked(num);
		}

		$('.custom-select').selectBox({
			mobile: true,
			menuTransition: 'slide',
			menuSpeed: 'fast',
			hideOnWindowScroll: true
		});

		$('.select2').select2();

		$(function(){
			$('.archive-from').css('paddingTop',  $('.apartments-wr-header').height() + 'px')
		})

		// MAP //
		if ( $('*').is('#map') ) {
			var lat = $('#map').data('lat'), lng = $('#map').data('lng'), x = undefined;
			if ($('body').is('.home')){
				x = 0.0066;			
			}
			var map = {lat,lng, x};
			
			setTimeout(function(){
				ymaps.ready(init.bind(map));
			},100)
		}
		
		function init () {
		
			var myMap = new ymaps.Map("map", {
				center: [this.lat, this.x ? this.lng - this.x : this.lng],
				zoom: 15,
				controls: ['zoomControl']
			}); 
			var myGeoObjects = [];
			myGeoObjects[0] = new ymaps.Placemark([this.lat, this.lng],{},{
				iconLayout: 'default#image',
				iconImageHref: '/geek-brands/wp-content/themes/lptheme/img/map.png',
				iconImageSize: [44, 63],
				iconImageOffset: [-22, -63]
			});   
			var clusterer = new ymaps.Clusterer({
				clusterDisableClickZoom: false,
				clusterOpenBalloonOnClick: false,
				clusterBalloonContentLayout: 'cluster#balloonCarousel',
				clusterBalloonPanelMaxMapArea: 0,
				clusterBalloonContentLayoutWidth: 300,
				clusterBalloonContentLayoutHeight: 200,
				clusterBalloonPagerSize: 5
			});
			clusterer.add(myGeoObjects);
			myMap.geoObjects.add(clusterer);
			myMap.behaviors.disable('scrollZoom');
		}

	});
})(jQuery);