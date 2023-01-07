/*
  Title: Sieve Content
  Author: wpninjDevs
  Website: https://wpninjadevs.com/
*/

;(function($) {
 
	$('#container-async').on('click', 'a[data-filter], .pagination a', function(e) {
		if(e.preventDefault) { 
			e.preventDefault(); 
		}
	
		$this = $(this);
	
		if ($this.data('filter')) {
			/**
			 * Click on tag cloud
			 */
			$this.closest('ul').find('.active').removeClass('active');
			$this.parent('li').addClass('active');
			$page = $this.data('page');
		} else {
			/**
			 * Click on pagination
			 */
			$page = parseInt($this.attr('href').replace(/\D/g,''));
			$this = $('.nav-filter .active a');

			// Scroll to top of section
			var targetEle = $('.latest-product-curvebg');;
  
			$('html, body').stop().animate({
				'scrollTop': targetEle.offset().top
			}, 500, 'swing', function () {
				window.location.targetEle = targetEle;
			});
		}	
	
		$params = {
			'page' : $page,
			'tax'  : $this.data('filter'),
			'term' : $this.data('term'),
			'qty'  : $this.closest('#container-async').data('paged'),
			'column'  : $this.closest('#container-async').data('column'),			
			'max_char'  : $this.closest('#container-async').data('max_char'),
			'product_para_char'  : $this.closest('#container-async').data('para_char'),
			'author'  : $this.closest('#container-async').data('author'),
			'product_para'  : $this.closest('#container-async').data('product_para'),
			'category'  : $this.closest('#container-async').data('category'),
			'sale'  : $this.closest('#container-async').data('sale'),
			'ratings'  : $this.closest('#container-async').data('ratings'),
			'love'  : $this.closest('#container-async').data('love'),
			'sales'  : $this.closest('#container-async').data('sales'),
			'price_con'  : $this.closest('#container-async').data('price_con'),
			'pagination_switch'  : $this.closest('#container-async').data('pagination_switch'),
			'product_style'  : $this.closest('#container-async').data('product_style'),
		};		
	
		// Run query
		get_posts($params);

	});

	/**
	 * Call get_posts function
	 */
	function get_posts($params) {

		$container = $('#container-async');
		$content   = $container.find('.product-container');
		$status    = $container.find('.status');
		$product_style =  $this.closest('#container-async').data('product_style');
	
		$status.text('Loading ...');
	
		$.ajax({
			url: filterObj.ajax_url,
			data: {
				action: 'do_filter_products',
				nonce: filterObj.nonce,
				params: $params
			},
			type: 'post',
			dataType: 'json',
			success: function(data, textStatus, XMLHttpRequest) {

				if (data.status === 200) {
					$content.html(data.content);					
					/**
					 * Masonry working on Ajax & Check if Photography content
					 */
					if( $product_style == 5 ){
						let $grid = $('.grid').masonry({
							itemSelector: '.grid-item',
							percentPosition: true,
							columnWidth: '.grid-sizer'
						});
				
						// layout Masonry after each image loads
						$grid.imagesLoaded().progress( function() {
							$grid.masonry();
						});				
					}

				} else if (data.status === 201) {
					$content.html(data.message);	
				} else {
					$status.html(data.message);
				}  
			},			
			error: function(MLHttpRequest, textStatus, errorThrown) {
	
				$status.html(textStatus);
	
				/*console.log(MLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);*/

			},
			complete: function(data, textStatus) {
	
				msg = textStatus;	
				if (textStatus === 'success') {
					msg = data.responseJSON.found;
				}	
				$status.text('Total Items: ' + msg);
	
				/*console.log(data);
				console.log(textStatus);*/

			}
		});
	}

	// Active All onload
	$('a[data-term="all-terms"]').trigger('click');

})(jQuery);
