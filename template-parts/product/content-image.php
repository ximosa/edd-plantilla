<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

?>

<div class="product-description-left image-demo">

	<div class="phography_img_view">
		<a class="image-view" href="<?php echo get_the_post_thumbnail_url(); ?>" data-fancybox-group="group"><i class="fa fa-expand"></i></a> 
	</div>

	<div class="product-image">
		<?php the_post_thumbnail(); ?>
	</div>    
	
	<br>
	<div class="image-bottom-share">
		<p><?php echo eidmart_get_likes_button( get_the_ID() ); ?></p>
		
		<?php if( get_theme_mod( 'social_share' ) == 1 ): ?>
			<div class="social-link">                                
				<ul>
					<li><?php esc_html_e( 'Share:', 'eidmart' ); ?> </li>
					<?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
				</ul>                  
			</div>
		<?php endif; ?>
	</div>

	<br>
	<div class="product-description-tab">        
		<div class="graphicland-demo graphicland-woo">
			<div class="faqs-1x item-faq">
				<div id="accordion">
					<div class="card single-faq">
						<div class="card-header">
							<h5 class="mb-0">
								<a class="accordion-toggle collapsed" data-toggle="collapse" href="#" data-target="#collapse_1eidmart5ea9955ccc" role="button" aria-expanded="false" aria-controls="collapse_1eidmart5ea9955ccc">
									<?php comments_number( '0'. esc_html__(' Comment ','eidmart'), '1'. esc_html__(' Comment ','eidmart'), '% '. esc_html__(' Comments ','eidmart'), $post->ID ); ?>                                
								</a>
							</h5>
						</div>
						<div id="collapse_1eidmart5ea9955ccc" class="collapse" role="tabpanel" data-parent="#accordion">
							<div class="card-body"> 
								<div class="blog-single-1x">
									<div class="blog-single-left-content">
										<?php
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template( '/graphicland-comments.php' );
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
	
</div> 