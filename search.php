<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package eidmart
 */

get_header();

if( is_post_type_archive( 'download' )) {

	// Product type condition
	if( get_theme_mod( 'archive_type' ) == '1' ) { // Software Product Archive

	/*
	Archive header
	 */
	do_action( 'product_search' ); ?> 

	<div class="course-header-1x">
		<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
			<div class="row">

				<?php do_action( 'filter_sidebr' ); ?>

				<div class="col-md-9">

					<div class="course-header-right">
						<div class="row">
						
						<div class="col-md-12">
							<div class="course-tab">
								<p><?php echo esc_html( get_theme_mod( 'usd_price', __( 'All prices are in USD', 'eidmart' ) ) ); ?></p>                    
							</div>
						</div>

						</div>
					</div>

					<div class="course-grid-list">
						<div class="tab-content" id="myTabContent">		              
							<div>
								<div class="course-grid-list">                                
									<div class="row">  
									<?php 
									if( get_theme_mod( 'product_view' ) =='grid' ):
										do_action( 'search_product' );
									else:
										do_action( 'search_product_list' ); 
									endif; ?>
									</div>
								</div> 
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?php } else if( get_theme_mod( 'archive_type' ) == '2' ) { // Photography Archive

	/*
	Archive header
	 */
	do_action( 'product_search' ); ?> 

	<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one">
		<div class="row">
			<?php 
			// Photography top filter ( specific photography filter action "photography_filter_header" )
			do_action( 'eidmart_top_filter_header' ); ?> 
			<div class="col-md-12">
				<?php do_action( 'search_photography' ); ?>
			</div>
		</div>
	</div>

	<?php } else if( get_theme_mod( 'archive_type' ) == '3' ) { // Graphcs Archive

	/*
	Archive header
	 */
	do_action( 'product_search' ); ?>

	<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style padding-bottom-large">
	    <div class="col-md-12">
	        <div class="row">
	        	<?php do_action( 'eidmart_top_filter_header' ); ?>
	            <?php do_action( 'search_graphicland' ); ?>    
	        </div>
	    </div>
	</div>

	<?php
	} else if( get_theme_mod( 'archive_type' ) == '4' ) { // Audio Archive

		/*
		Archive header
		 */
		do_action( 'product_search' ); ?>
	
		<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style audio-version padding-bottom-large">
			<div class="col-md-12">
				<div class="row">
					<?php do_action( 'eidmart_top_filter_header' ); ?>
					<?php do_action( 'search_audio' ); ?>    
				</div>
			</div>
		</div>
	
	<?php
	} else if( get_theme_mod( 'archive_type' ) == '5' ) { // Video Archive

		/*
		Archive header
		 */
		do_action( 'product_search' ); ?>
	
		<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style video-filter padding-bottom-large">
			<div class="col-md-12 photography-filter">
				<div class="row">
					<?php do_action( 'eidmart_top_filter_header' ); ?>
					<?php do_action( 'search_video' ); ?>    
				</div>
			</div>
		</div>
	
	<?php
	} // End condition


/**
 * Start normal page search
 */

} else { ?> 

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
					<h3>
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'eidmart' ), '<span>' . get_search_query() . '</span>' );
						?>						
					</h3>

				</div>
			</div>
		</div>

	</div>                       
</div>   

<div class="blog-list-1x">
	<div class="container"> 
		<div class="row"> 

			<?php 
			/**
			 * Start search blog with sidebar
			 */
			if( is_active_sidebar( 'sidebar' ) ){ ?>
			<div class="col-md-8">
									
				<?php

				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content' );

					endwhile;

					if( paginate_links() ):
			
					?>					

					<div class="course-pagination">
						<ul class="pagination">
							<li>
								<?php
							
								$big = 999999999; // need an unlikely integer

								echo paginate_links(
									array(
										'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
										'format'    => '?paged=%#%',
										'current'   => max(1, get_query_var('paged')),
										'total'     => $wp_query->max_num_pages,
										'type'      => '',
										'prev_text' => '<i class="fa fa-angle-left"></i>',
										'next_text' => '<i class="fa fa-angle-right"></i>',
									)
								);

								?>
							</li>
						</ul>
					</div>

					<?php

					endif; // End pagination

				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>

			<?php
			/**
			 * Start search blog without sidebar
			 */
			} else { ?>

			<div class="col-md-10 offset-md-1">
									
				<?php

				if ( have_posts() ) :
				
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content' );

				endwhile;

				if( paginate_links() ):

				?>         

				<div class="course-pagination">
					<ul class="pagination">
						<li>
							<?php
						
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format'    => '?paged=%#%',
								'current'   => max(1, get_query_var('paged')),
								'total'     => $wp_query->max_num_pages,
								'type'      => '',
								'prev_text' => '<i class="fa fa-angle-left"></i>',
								'next_text' => '<i class="fa fa-angle-right"></i>',
							));

							?>
						</li>
					</ul>
				</div>

				<?php

				endif; // End pagination

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;

				?>

			</div>

			<?php } ?>

		</div>
	</div>
</div>

<?php } // End checking is_post_type_archive
get_footer();
