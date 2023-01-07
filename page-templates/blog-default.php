<?php
/**
 * Template Name: Blog Default
 *
 * @package eidmart
**/

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
					<h1><?php the_title(); ?></h1>

				</div>
			</div>
		</div>
	</div>                       
</div>

<div class="blog-list-1x">
	<div class="container"> 
		<div class="row">  

			<div class="col-md-8">                                      
				<?php

				query_posts('post_type=post&post_status=publish&paged='. get_query_var('paged'));

				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

				if( paginate_links() ):

				?>                  

				<div class="course-pagination">
					<ul class="pagination">
						<li>
							<?php
					
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format'    => '?paged=%#%',
								'current'   => max( 1, get_query_var( 'paged' ) ),
								'total'     => $wp_query->max_num_pages,
								'type'      => '',
								'prev_text' => '<i class="fa fa-angle-left"></i>',
								'next_text' => '<i class="fa fa-angle-right"></i>',
							) );

							?>
						</li>
					</ul>
				</div>

				<?php

				endif;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;

				?>
			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div> 

		</div>
	</div>
</div>

<?php get_footer();
