<?php 
/*
WooCommerce template
*/

get_header(); ?>

<div class="page-banner">                 
	<div class="hvrbox">
		<?php if( get_theme_mod( 'banner_upload' ) ): ?>
			<img src="<?php echo esc_url( get_theme_mod( 'banner_upload' ) ); ?>" alt="<?php esc_attr_e( 'Page header banner','eidmart' ); ?>" class="hvrbox-layer_bottom">
		<?php endif; ?>
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-left">                              
					
					<nav aria-label="breadcrumb">
						<?php eidmart_breadcrumbs(); ?>
					</nav>
					<h1><?php esc_html_e( 'Shop','eidmart' ); ?></h1>

				</div>
			</div>
		</div>
	</div>                       
</div>	

<!-- Start edufair blog -->
<div class="blog-list-1x">
	<div class="container">							
		<div class="row">	

			<div class="col-md-12">
				
				<?php
					// Start the loop.
					if ( have_posts() ) :			
							woocommerce_content();		
					// End the loop.
					endif;
				?>

			</div>
		</div>		
			
	</div>
</div>
<!-- End blog -->	

<?php get_footer(); 