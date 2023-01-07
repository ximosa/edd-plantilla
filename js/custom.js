/*
  Version: 1.0
  Author: wpninjDevs
  Website: https://wpninjadevs.com/
*/

;(function($) {
 
	"use strict"; 
	 
	// Page preloader
	if($().fakeLoader){
		var loader = $('.theme-directory').attr( 'data-loader' );
		var loaderBg = $('.theme-directory').attr( 'data-loader-bg' );
		$( "#fakeloader" ).fakeLoader({
			timeToHide: 1000,
			zIndex: "999999", // Default zIndex
			bgColor: loaderBg,
			spinner: loader
		});
	}

    $(document).ready(function(){

		// show body after site load
		$('body').show();

		//Sticky menu
		if($().sticky){
			$(".sticky-menu").sticky({ topSpacing: 0 });
		}

        /* Mag popup */       
        $('.video').magnificPopup({
          type: 'iframe',
          iframe: {
             markup: '<div class="mfp-iframe-scaler">'+
                        '<div class="mfp-close"></div>'+
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                        '<div class="mfp-title">Caption</div>'+
                      '</div>'
          },
          callbacks: {
            markupParse: function( template, values, item ) {
            	values.title = item.el.attr('title');
            }
          }

		});  		

		// Collecting value from PHP
		var slick_rtl = $( '.slick-rtl-selector' ).data( 'slick_rtl' );
		var slick_item = $( '.slick-item-selector' ).data( 'slick_item' );

		//featured-product Carousel (Slick) 		
		$('.featured-product').slick({
	    	slidesToShow: 3,
		    slidesToScroll: 3,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    arrows: false,
		    dots: true,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',
		    responsive: [
				    {
				      breakpoint: 768,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1,
				        infinite: true
				      }
				    }
				  ]
		});

		//lpf product Carousel (Slick) 		
		$('.lpf-product').each( function(){
			$( this ).slick( {
				slidesToShow: slick_item,
				slidesToScroll: slick_item,
				autoplay: false,
				autoplaySpeed: 3000,
				arrows: true,
				prevArrow: $(this).parents('.premium-service').find('.prev,.prev1,.prev2,.prev3,.prev4'),
				nextArrow: $(this).parents('.premium-service').find('.next,.next1,.next2,.next3,.next4'),
				dots: true,
				focusOnSelect: true,
				rtl: slick_rtl,
				easing: 'linear',
				responsive: [
						{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true
						}
					}
				]
			});
		});

		//Static product Carousel (Slick) 		
		$('.static-popular-product').each( function(){
			$( this ).slick( {				
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 3000,
				arrows: true,
				prevArrow: $(this).parents('.special-items').find('.prev,.prev1,.prev2,.prev3,.prev4'),
				nextArrow: $(this).parents('.special-items').find('.next,.next1,.next2,.next3,.next4'),
				dots: true,
				focusOnSelect: true,
				rtl: slick_rtl,
				easing: 'linear',
				fade: true,
				responsive: [
						{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true
						}
					}
				]
			});
		});

		//featured-product Carousel (Slick) 		
		$('.featured-product-2x').slick({
	    	slidesToShow: 1,
		    slidesToScroll: 1,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    arrows: false,
		    fade: true,
    		speed: 900,
		    dots: true,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',
		    responsive: [
				    {
				      breakpoint: 768,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1,
				        infinite: true
				      }
				    }
				  ]
		});		   

		//Client (Slick) 
		$('.client-slider').slick({
	    	slidesToShow: 5,
		    slidesToScroll: 5,
		    arrows: false,
		    dots: false,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',
		    responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 1,
			        infinite: true
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 320,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			  ]
		});

		//Banner Slidr (Slick) 
		$('.banner-slider').slick({
	    	slidesToShow: 1,
		    slidesToScroll: 1,
		    arrows: false,
		    fade: true,
			speed: 900,
		    dots: true,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',			    
		});

		//Featured Product 8x (Slick) 
		$('.featured-product-8').slick({
	    	slidesToShow: 1,
		    slidesToScroll: 1,
		    arrows: false,
			speed: 900,
		    dots: false,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',			    
		});

		//testimonial Slider 3x
		$('.testimonial-3x').slick({
		    	slidesToShow: 1,
			    slidesToScroll: 1,
				arrows: true,
				prevArrow: '<i class="las la-arrow-left"></i>',
    			nextArrow: '<i class="las la-arrow-right"></i>',
			    fade: true,
    			speed: 900,
			    dots: false,
			    autoplay: true,
	  			autoplaySpeed: 3000,
			    focusOnSelect: true,
			    rtl: slick_rtl,
			    easing: 'linear',			    
		}); 
		
		//Product image (Slick) 
	  	$('.product-image').slick({
	    	slidesToShow: 1,
		    slidesToScroll: 1,
		    arrows: true,
		    nextArrow: '<i class="las la-angle-right"></i>',
			prevArrow: '<i class="las la-angle-left"></i>',
		    dots: false,
		    autoplay: false,
  			autoplaySpeed: 3000,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',
			fade: true
	  	});

		//Product image (Single header two) 
		$('.single-header-screen-gallery').slick({
	    	slidesToShow: 3,
		    slidesToScroll: 3,
		    arrows: true,
		    nextArrow: '<i class="las la-angle-right"></i>',
			prevArrow: '<i class="las la-angle-left"></i>',
		    dots: false,
		    autoplay: false,
  			autoplaySpeed: 3000,
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    easing: 'linear',
			responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true
			      }
			    }
			]	    
	  	});

		//Testimonial Carousel (Slick)
		$('.slider-for').slick({	
		    slidesToShow: 1,
		    slidesToScroll: 1,		    
		    dots: false,
		    arrows: false,
		    fade: true,
		    easing: 'linear',
			fade: true,
		    rtl: slick_rtl,
		    asNavFor: '.slider-nav'
		});

		$('.slider-nav').slick({
			slidesToShow: 3,
		    slidesToScroll: 1,
		    autoplay: true,
  			autoplaySpeed: 3000,
		    asNavFor: '.slider-for',
		    arrows: false,
		    dots: true,
		    centerMode: true,
		    centerPadding: '0px',
		    focusOnSelect: true,
		    rtl: slick_rtl,
		    responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true
			      }
			    }
			]	    
		}); 

        //counter
		$('.counter').counterUp({
			delay: 10,
			time: 5000
		});
                		
		// Masonry portfolio for grid
		$('#edd-product').mixItUp({
			selectors: {
				target: '.tile',
				filter: '.filter',
				sort: '.sort-btn'
			},		  
			animation: {
			animateResizeContainer: false,
			effects: 'fade scale'
			}
		});
		
		$('#product').mixItUp();
		$('.form-control').on('change', function() {
		    $('.form-control option:selected').trigger('click'); 
		});


		// For the first load
		// init Masonry
		let $grid = $('.grid').masonry({
		  itemSelector: '.grid-item',
		  percentPosition: true,
		  columnWidth: '.grid-sizer'
		});

		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
		  	$grid.masonry();
		});

		// For the tab load
		$('a[data-toggle=tab]').each(function () {
	  		var $this = $(this);

		  		$this.on('shown.bs.tab', function () {

				// init Masonry
				var $grid = $('.grid').masonry({
				  itemSelector: '.grid-item',
				  percentPosition: true,
				  columnWidth: '.grid-sizer'
				});

				// layout Masonry after each image loads
				$grid.imagesLoaded().progress( function() {
				  $grid.masonry();
				});

			});  
		});
		
		// Tab video load without overlap
		document.querySelectorAll('.video-control').forEach(vid => 
			vid.addEventListener('loadeddata', (event) => {
				$grid.masonry('layout');
			})
		)

		// Active Bootstrap tab after reload
	    $('a[data-toggle="tab"]').on('click', function (e) {
	        e.preventDefault();
			$(this).tab('show');
			
			// Collected active data & saved in localStorage
			var id = $(e.target).attr("data-target");
			localStorage.setItem('selectedTab', id)
			
	    });

	    var selectedTab = localStorage.getItem('selectedTab');
	    if (selectedTab != null) {
	        $('a[data-toggle="tab"][data-target="' + selectedTab + '"]').tab('show');
		}

	    // Load more function
        $(function () {

        	var btn_text = $( '.load-product' ).data( 'btn_text' );
        	var max_post = $( '.load-product' ).data( 'max_post' );
        	var max_post_show = $( '.load-product' ).data( 'max_post_show' );        	
            var post_count = max_post;
            
			$( ".load-more" ).slice( 0, post_count ).show();
			
            $( "#loadMore" ).on( 'click', function (e) {
				e.preventDefault();
			
				$( ".load-more:hidden" ).slice( 0, max_post_show ).slideDown();
				
				if( $( ".load-more:hidden" ).load() ){
					$("#loadMore").text( btn_text+ '...' );
				}

				if ( $( ".load-more:hidden" ).length == 0 ){
					$( "#loadMore" ).text( "No more available" );
					//$( "#loadMore" ).fadeOut( 1000 );
				}

				if ( $( ".load-more:hidden" ).length != 0 ){
					$( 'html,body' ).animate({
						//scrollTop: $(this).offset().top
					}, 1500);
				}

				document.querySelectorAll('.video-control').forEach(vid => 
					vid.addEventListener('loadeddata', (event) => {
						$grid.masonry('layout');
					})
				)                
            });
		});
		
		/**
		 * Audio player
		 */

		// Collect WordPress theme directory url as a global
		var themeDirectory = $(".theme-directory").attr('data-directory');

		// Global variable
		var banyanPlayer;

		// Aplayer existing check
		if (typeof APlayer != "undefined") {	
			$(document).on('click', '.album-poster', function(e){

				var audioTitle = $(this).attr('data-title');
				var nameArtist = $(this).attr('data-artist');
				var mp3Url = $(this).attr('data-mp3');
				var audioCover = $(this).attr('data-cover');
				var audioPrice = $(this).attr('data-price');
				var productId = $(this).attr('data-pid');
				var uniqtitle = $(this).attr('data-uniqid');
				var externalUrl = $(this).attr('data-external-url');

				var dataSwitchId = $(this).attr('data-switch');

				var uniqueId = uniqtitle;				

				//click to slideUp player see
				$( "#aplayer" ).addClass( 'showPlayer' );

				// When active player then stop other player
				$( ".album-poster" ).not(this).removeClass( "player-icon-show" );

				$( "."+uniqueId+"" ).toggleClass( "player-icon-show" );		

				banyanPlayer = new APlayer({
					container: document.getElementById( 'aplayer' ),
					listFolded: true,
					audio: [
						{
							name: audioTitle,
							artist: nameArtist,
							url: mp3Url, // Here is the variable
							cover: audioCover,
							theme: '#ffa947'
						},
					]
				});

				// Now i use aplayer switch function see
				banyanPlayer.list.switch( dataSwitchId ); //this is static id but i use dynamic 

				// Aplayer play function
				// When i click any song to play
				banyanPlayer.play();

				if ( $( "."+uniqueId+"" ).hasClass( 'player-icon-show' ) ){
					banyanPlayer.play();
				} else {
					banyanPlayer.pause();
				}

				// Collect current url
				var currentUrl = window.location.href;			

				// Check product external url if not default purchase
				if( externalUrl ){
					var cartUrl = externalUrl;
				} else {
					var cartUrl = currentUrl+"?edd_action=add_to_cart&download_id="+productId;
				}
			
				$( ".aplayer-music" ).append( "<span class='player-show-hide'><i class='las la-angle-down'></i></span>" );
				$( ".aplayer-music" ).append( "<a href='"+cartUrl+"' class='audio-cart'><i class='las la-shopping-cart'></i></a>" );
				$( ".aplayer-music" ).append( "<span class='audio-price'>"+ audioPrice +"</span>" );

				// Player animated image
				$( "#aplayer" ).append( "<img class='animated-gif' src='"+themeDirectory+"/images/loader/player-animate.gif'>" );
				$( "#aplayer" ).append( "<img class='normal-gif' src='"+themeDirectory+"/images/loader/player.gif'>" );

				// Icon controller from player
				banyanPlayer.on( 'play', function () {
					$( "."+uniqueId+"" ).addClass( "player-icon-show" );
					$( "#aplayer" ).find( ".aplayer-title" ).addClass('title-animation');
					$( "#aplayer" ).addClass('gif-animation');				
				});
				banyanPlayer.on( 'pause', function () {
					$( "."+uniqueId+"" ).removeClass( "player-icon-show" );
					$( "#aplayer" ).find( ".aplayer-title" ).removeClass('title-animation');
					$( "#aplayer" ).removeClass('gif-animation');
				});				
				
				$('span.player-show-hide').on('click', function(){
					$( "#aplayer" ).toggleClass( 'player-hide' );		
				});			
				
			});
		}

		/**
		 * Typewriter
		 */		

		var WritterText = function( el, toRotate, period ) {
			this.toRotate = toRotate;
			this.el = el;
			this.loopNum = 0;
			this.period = parseInt( period, 10 ) || 2000;
			this.txt = '';
			this.tick();
			this.isDeleting = false;
		};
	
		WritterText.prototype.tick = function() {
			
			var i = this.loopNum % this.toRotate.length;
			var fullTxt = this.toRotate[i];
	
			if( fullTxt ){
				if (this.isDeleting) {
					this.txt = fullTxt.substring(0, this.txt.length - 1);
				} else {
					this.txt = fullTxt.substring(0, this.txt.length + 1);
				}
				this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
			}	
	
			var that = this;
			var delta = 200 - Math.random() * 100;
	
			if (this.isDeleting) { delta /= 2; }
	
			if ( !this.isDeleting && this.txt === fullTxt ) {
				delta = this.period;
				this.isDeleting = true;
			} else if ( this.isDeleting && this.txt === '' ) {
				this.isDeleting = false;
				this.loopNum++;
				delta = 500;
			}
	
			setTimeout( function() {
				that.tick();
			}, delta );

		};
	
		window.onload = function() {
			var elements = document.getElementsByClassName( 'typewrite' );
			for ( var i=0; i<elements.length; i++ ) {
				var toRotate = elements[i].getAttribute( 'data-type' );
				var period = elements[i].getAttribute( 'data-period' );
				if ( toRotate ) {
				  new WritterText( elements[i], JSON.parse( toRotate ), period );
				}
			}
			// INJECT CSS
			var css = document.createElement( "style" );
			css.innerHTML = ".typewrite > .wrap { border-right: 2px solid #ddd }";
			document.body.appendChild( css );
		};
	
		/**
		 * Video hover play
		 */
		var videoSelect = $(document);
		
		videoSelect.on( 'mouseover', '.video-control', function() {
			this.play();
		});		
		videoSelect.on( 'mouseout', '.video-control', function() {
			this.pause();
		});
		
		/**
		 * Bootstrap  multi dropdown navbar 
		 * https://bootstrapthemes.co/demo/resource/bootstrap-4-multi-dropdown-navbar/
		 */
		$( '.dropdown-menu a.dropdown-toggle' ).on( 'click', function ( e ) {
			var $el = $( this );
			var $parent = $( this ).offsetParent( ".dropdown-menu" );
			if ( !$( this ).next().hasClass( 'show' ) ) {
				$( this ).parents( '.dropdown-menu' ).first().find( '.show' ).removeClass( "show" );
			}
			var $subMenu = $( this ).next( ".dropdown-menu" );
			$subMenu.toggleClass( 'show' );
			
			$( this ).parent( "li" ).toggleClass( 'show' );
	
			$( this ).parents( 'li.nav-item.dropdown.show' ).on( 'hidden.bs.dropdown', function ( e ) {
				$( '.dropdown-menu .show' ).removeClass( "show" );
			} );
			
			 if ( !$parent.parent().hasClass( 'navbar-nav' ) ) {
				$el.next().css( { "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4 } );
			}	
			return false;
		});

		/**
		 * Sticky price
		 */
		if ($(".single-download .price-box, .single-download .price").length > 0) {
			$(window).scroll(function() {
				var BoxTopHeight = $('.single-download .price-box, .single-download .price').offset().top,
					BoxHeight = $('.single-download .price-box, .single-download .price').outerHeight(),
					DisplayHeight = $(window).height(),
					DisplayScroll = $(this).scrollTop();
				if ( DisplayScroll > ( BoxTopHeight + BoxHeight - DisplayHeight ) && ( BoxTopHeight > DisplayScroll ) && ( DisplayScroll + DisplayHeight > BoxTopHeight + BoxHeight )){
					$('.single-download .price-box, .single-download .price').addClass('view');
					$('.sticky-price').removeClass('show-sticky-price')
				} else {
					$('.sticky-price').addClass('show-sticky-price')
				}
			});
		}

		$('.sticky-display').on('click', function() {
			$( '.sticky-price' ).toggleClass( 'hide-sticky-price' );
		});

		/**
		 * Dynamic responsive
		 */
		$('.sticky-display').on('click', function() {				
			let PriceBoxHeight = $( '.sticky-price' ).height() + 31;
			
			$(this).toggleClass('hide-sticky-price');
			if ($(this).hasClass('hide-sticky-price')) {
				$(".hide-sticky-price").css('bottom', -PriceBoxHeight);
				$(".hide-sticky-price").removeClass('hide');
			} else {
				$('.sticky-price').addClass('hide');
				$(".hide").css('bottom', '0');
			}
		});

		/**
		 * Count register container
		 */
		$(window).on('load', function(){				
			let regContainer = $( '.reg-container' ).height() + 31;
			$(".reg-left").find(".hvrbox").css('height',regContainer);
		});
		
		/**
		 * Hide archive page sticky price
		 */
		$( '.archive .sticky-price' ).hide();

		/**
		 * Grab your button (based on your posted html)
		 */			
		if( $.cookie ){
			$('.close, .btn-close').on( 'click', function( e ){
				// Do not perform default action when button is clicked
				e.preventDefault();	
				/* If you just want the cookie for a session don't provide an expires ( expires: 1,  )
				Set the path as root, so the cookie will be valid across the whole site */
				$.cookie('eidmart-alert', 'closed', { path: '/' });	
			});
		
			// Check if alert has been closed
			if( $.cookie('eidmart-alert') === 'closed' ){	
				$('.alert').hide();	
			}
		}

		/**
		 * Collect css data
		 */
		let dataBg  = $( '.eidmart-page-cta' ).attr( 'data-ctabg' ),
			gradOne = $( '.eidmart-page-cta' ).attr( 'data-gradone' ),
			gradTwo = $( '.eidmart-page-cta' ).attr( 'data-gradtwo' );
		$('.eidmart-page-cta').attr('style','background: linear-gradient(rgba( '+gradOne+' ), rgba('+gradTwo+')), url( '+dataBg+' );background-size: cover;	background-repeat: no-repeat; background-position: center;');

		/**
		 * Add class in wedocs button
		 */
		$( '.wedocs-doc-link a' ).addClass( 'btn-hover color-primary' );

		/**
		 * EDD ajax cart
		 */
		$(document.body).on( 'click', '.edd-add-to-cart, .edd-remove-from-cart', function(e){
			EidmartCartDisplayTime();
		});
		
		function EidmartCartDisplayTime() {
			setTimeout( function () { EidmartCartContentDisplay(); }, 1000 );
		}
	
		function EidmartCartContentDisplay() {
			$( '.cart-widget' ).load( eidmart_custom_ajax.ajaxurl+'?action=eidmart_custom_ajax&_wpnonce='+eidmart_custom_ajax.nonce );
			$( '.eidmart-cart-count' ).load( eidmart_custom_ajax.ajaxurl+'?action=eidmart_custom_ajax&cart_count=1&_wpnonce='+eidmart_custom_ajax.nonce );
		}

		// Initialize bootstrap tooltip
		$( '[data-toggle="tooltip"]' ).tooltip();

		/**
		 * Sidebar Pricing "radio"
		 * Radio price changing
		 */
		var originalRadioPrice = $( '.price-box.theme .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.price-box.theme .total-cart span b').html(originalRadioPrice);

		$(".price-box.theme .edd_price_options input[type='radio']").click(function(){
			originalRadioPrice = $( '.price-box.theme .edd_price_options ul li input:checked' ).attr( 'data-price' );
			$(".price-box.theme .edd_price_options ul li input[type='radio']:checked").each(function() {
				originalRadioPrice = originalRadioPrice;
			});
			$('.price-box.theme .total-cart span b').html(originalRadioPrice);
		});
		if( !originalRadioPrice ){
		$('.price-box.theme .total-cart').hide();
		}
 
		/**
		 * Sidebar Pricing "checkbox"
		 * Checkbox price changing
		 */
		var SelectedCheckboxPrice = $( '.price-box.theme .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.price-box.theme .total-cart span b').html(SelectedCheckboxPrice);

		$(".price-box.theme .edd_price_options input[type='checkbox']").click(function(){
			var TotalCheckboxPrice = 0;
			$(".price-box.theme .edd_price_options ul li input[type='checkbox']:checked").each(function() {
				TotalCheckboxPrice += parseInt(this.getAttribute( 'data-price' ), 10);
			});
			$('.price-box.theme .total-cart span b').html( TotalCheckboxPrice );
		});

		/**
		 * Sidebar Pricing "radio"
		 * Radio price changing for club
		 */
		var originalRadioPriceClub = $( '.price-box.club .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.price-box.club .total-cartt span b').html( originalRadioPriceClub );

		$(".price-box.club .edd_price_options input[type='radio']").click(function(){
			originalRadioPriceClub = $( '.price-box.club .edd_price_options ul li input:checked' ).attr( 'data-price' );
			$(".price-box.club .edd_price_options ul li input[type='radio']:checked").each(function() {
				originalRadioPriceClub = originalRadioPriceClub;
			});
			$('.price-box.club .total-cartt span b').html( originalRadioPriceClub );
		});
		if( !originalRadioPriceClub ){
			$('.price-box.club .total-cartt').hide();
		}

		/**
		 * Sidebar Pricing "checkbox"
		 * Checkbox price changing for club
		 */
		var SelectedCheckboxPriceClub = $( '.price-box.club .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.price-box.club .total-cartt span b').html( SelectedCheckboxPriceClub );

		$(".price-box.club .edd_price_options input[type='checkbox']").click(function(){
			var TotalCheckboxPriceClub = 0;
			$(".price-box.club .edd_price_options ul li input[type='checkbox']:checked").each(function() {
				TotalCheckboxPriceClub += parseInt(this.getAttribute( 'data-price' ), 10);
			});
			$('.price-box.club .total-cartt span b').html( TotalCheckboxPriceClub );
		});

		/**
		 * Sidebar Pricing "radio"
		 * Sticky Radio price changing
		 */
		var stickyOriginalRadioPrice = $( '.sticky-price .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.sticky-price .total-cart span b').html( stickyOriginalRadioPrice );
		$(".sticky-price .edd_price_options input[type='radio']").click(function(){
			stickyOriginalRadioPrice = $( '.sticky-price .edd_price_options ul li input:checked' ).attr( 'data-price' );
			$(".sticky-price .edd_price_options ul li input[type='radio']:checked").each(function() {
				stickyOriginalRadioPrice = stickyOriginalRadioPrice;
			});
			$('.sticky-price .total-cart span b').html( stickyOriginalRadioPrice );
			
		});
		if( !stickyOriginalRadioPrice ){
			$('.sticky-price .total-cart').hide();
		}

		/**
		 * Sidebar Pricing "checkbox"
		 * Sticky Checkbox price changing
		 */
		var stickySelectedCheckboxPrice = $( '.sticky-price .edd_price_options ul li input:checked' ).attr( 'data-price' );
		$('.sticky-price .total-cart span b').html( stickySelectedCheckboxPrice );

		$(".sticky-price .edd_price_options input[type='checkbox']").click(function(){
			var stickyTotalCheckboxPrice = 0;
			$(".sticky-price .edd_price_options ul li input[type='checkbox']:checked").each(function() {
				stickyTotalCheckboxPrice += parseInt(this.getAttribute( 'data-price' ), 10);
			});
			$('.sticky-price .total-cart span b').html( stickyTotalCheckboxPrice );
		});

		/**
		 * Add checkout SSL message
		 */
		$("#edd_payment_mode_select_wrap legend").after("<span class='secured-message'><i class='fa fa-lock'></i>  This is a secure SSL encrypted payment.</span>");

	}); // End load document

	/**
	 * Counter Number
	 * @param {*} options 
	 */
	$.fn.counterUp = function( options ) {
		// Defaults
		var settings = $.extend({
			'time': 400,
			'delay': 10
		}, options);
	
		return this.each(function(){
	
			// Store the object
			var $this = $(this);
			var $settings = settings;
	
			var counterUpper = function() {
				var nums = [];
				var divisions = $settings.time / $settings.delay;
				var num = $this.text();
				var isComma = /[0-9]+,[0-9]+/.test(num);
				num = num.replace(/,/g, '');
				var isInt = /^[0-9]+$/.test(num);
				var isFloat = /^[0-9]+\.[0-9]+$/.test(num);
				var decimalPlaces = isFloat ? (num.split('.')[1] || []).length : 0;
	
				// Generate list of incremental numbers to display
				for (var i = divisions; i >= 1; i--) {
	
					// Preserve as int if input was int
					var newNum = parseInt(num / divisions * i);
	
					// Preserve float if input was float
					if (isFloat) {
						newNum = parseFloat(num / divisions * i).toFixed(decimalPlaces);
					}
	
					// Preserve commas if input had commas
					if (isComma) {
						while (/(\d+)(\d{3})/.test(newNum.toString())) {
							newNum = newNum.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
						}
					}	
					nums.unshift(newNum);
				}
	
				$this.data('counterup-nums', nums);
				$this.text('0');
	
				// Updates the number until we're done
				var f = function() {
					$this.text($this.data('counterup-nums').shift());
					if ($this.data('counterup-nums').length) {
						setTimeout($this.data('counterup-func'), $settings.delay);
					} else {
						delete $this.data('counterup-nums');
						$this.data('counterup-nums', null);
						$this.data('counterup-func', null);
					}
				};
				$this.data('counterup-func', f);
	
				// Start the count up
				setTimeout($this.data('counterup-func'), $settings.delay);
			};	
			// Perform counts when the element gets into view
			$this.waypoint(counterUpper, { offset: '100%', triggerOnce: true });
		});	
	};

	/**
	 * Avoid scroll to top
	 */
	$('.nav-tabs li a').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		$(this).tab('show');
	});
	
	/**
	 * Scroll to top button
	 */
	var scrolltotop={
		//startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
		//scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
		setting: {startline:100, scrollto: 0, scrollduration:1000, fadeduration:[500, 100]},
		controlHTML: '<i class="las la-arrow-up backtotop"></i>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
		controlattrs: {offsetx:0, offsety:105}, //offset of control relative to right/ bottom of window corner
		anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

		state: {isvisible:false, shouldvisible:false},

		scrollup:function(){
			if (!this.cssfixedsupport) //if control is positioned using JavaScript
				this.$control.css({opacity:0}) //hide control immediately after clicking it
			var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
			if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
				dest=jQuery('#'+dest).offset().top
			else
				dest=0
			this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
		},

		keepfixed:function(){
			var $window=jQuery(window)
			var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
			var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
			this.$control.css({left:controlx+'px', top:controly+'px'})
		},

		togglecontrol:function(){
			var scrolltop=jQuery(window).scrollTop()
			if (!this.cssfixedsupport)
				this.keepfixed()
			this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
			if (this.state.shouldvisible && !this.state.isvisible){
				this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
				this.state.isvisible=true
			}
			else if (this.state.shouldvisible==false && this.state.isvisible){
				this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
				this.state.isvisible=false
			}
		},
		
		init:function(){
			$(document).ready(function(){
				var mainobj=scrolltotop
				var iebrws=document.all
				mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
				mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
				mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
					.css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer'})
					.attr({title:''})
					.click(function(){mainobj.scrollup(); return false})
					.appendTo('body')
				if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
					mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
				mainobj.togglecontrol()
				$('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
					mainobj.scrollup()
					return false
				})
				$(window).bind('scroll resize', function(e){
					mainobj.togglecontrol()
				})
			})
		}
	};
	// Initialization
	scrolltotop.init();

	/**
	 * Top Offer countdown timer
	 */
	let topDeal = $('#eidcountdown').attr('offerDate');

	if( topDeal ){
		// Set the date we're counting down to
		let EidcountDownDate = new Date(topDeal).getTime();

		// Update the count down every 1 second
		let x = setInterval(function() {

			// Get today's date and time
			let nowDate = new Date().getTime();

			// Find the remainDate between nowDate and the count down date
			let remainDate = EidcountDownDate - nowDate;

			// Time calculations for days, hours, minutes and seconds
			let days = Math.floor(remainDate / (1000 * 60 * 60 * 24));
			let hours = Math.floor((remainDate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			let minutes = Math.floor((remainDate % (1000 * 60 * 60)) / (1000 * 60));
			let seconds = Math.floor((remainDate % (1000 * 60)) / 1000);

			// Display the result in the element with id="eidcountdown"
			if( document.getElementById("eidcountdown") ){

				document.getElementById("eidcountdown").innerHTML = days + "<span class='day'>d</span> " + hours + "<span class='hour'>h</span> "
				+ minutes + "<span class='min'>m</span>" + seconds + "<span class='sec'>s</span>";

			}
			// If the count down is finished, write some text
			if (remainDate < 0) {
				clearInterval(x);
				document.getElementById("eidcountdown").innerHTML = ""; // EXPIRED
			}		

		}, 1000);
	} // End countdown timer

	// Countdown for dynamic timer
	document.addEventListener('readystatechange', event => {
		if (event.target.readyState === "complete") {
			var eidmartCountdown = document.getElementsByClassName("eidmartCountdown");
		    var countDownDate = new Array();

			for (var i = 0; i < eidmartCountdown.length; i++) {
				countDownDate[i] = new Array();
				countDownDate[i]['el'] = eidmartCountdown[i];
				countDownDate[i]['time'] = new Date(eidmartCountdown[i].getAttribute('data-date')).getTime();
				countDownDate[i]['days'] = 0;
				countDownDate[i]['hours'] = 0;
				countDownDate[i]['seconds'] = 0;
				countDownDate[i]['minutes'] = 0;
			}
		  
		    var countdownfunction = setInterval(function() {
				for (var i = 0; i < countDownDate.length; i++) {
					var now = new Date().getTime();
					var distance = countDownDate[i]['time'] - now;
					countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
					countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);
					
					if (distance < 0) {
						countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
						countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
						countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
						countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
					} else {
						countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
						countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
						countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
						countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
					}	  
		 		}
			}, 1000);
		}
	});

	// Replace div element with span
	$('.edd-reviews-total-count').contents().unwrap().wrap('<span class="edd-reviews-total-count"/>');

})(jQuery);
