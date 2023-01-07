<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

$image_urls = get_post_meta($post->ID,'product_gallery_img_url',true);
$gallery_array = explode(";", $image_urls);

$meta = get_post_meta( $post->ID );
$eidmart_radio_value3 = ( isset( $meta['eidmart_radio_value3'][0] ) && '' !== $meta['eidmart_radio_value3'][0] ) ? $meta['eidmart_radio_value3'][0] : '';

?>

<div class="product-description-left <?php if( !get_post_meta( $post->ID, 'preview_text',true) && !get_post_meta( $post->ID, 'doc_text',true ) && $image_urls ): echo "only-product-gallery"; endif; ?>">
	<div class="product-image">

		<?php
		if( $image_urls ){

			$array_limit = count( $gallery_array );

			for ( $i=0; $i<$array_limit; $i++ ){ ?>			
				<div class="single-product-image">
					<img src="<?php echo esc_url( $gallery_array[$i] ); ?>" alt="<?php esc_attr_e( 'Slide image', 'eidmart' ); ?>">
				</div>
			<?php }

		} else { ?>

			<div class="product-image">
				<?php the_post_thumbnail(); ?>
			</div> 

		<?php } ?>								
	</div>

	<?php 
	if( get_post_meta( $post->ID, 'preview_text',true) || get_post_meta( $post->ID, 'doc_text',true) ):	?>
		<div class="image-bottom <?php if( !$image_urls ): echo "text-center"; endif; ?>">
			<?php if( get_post_meta( $post->ID, 'preview_text',true) ): ?><a target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'preview_url',true) ); ?>" class="btn-small"> <?php echo esc_html( get_post_meta( $post->ID, 'preview_text',true) ); ?> </a><?php endif; ?>
			<?php if( get_post_meta( $post->ID, 'doc_text',true) ): ?><a target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'doc_url',true) ); ?>" class="btn-small"> <?php echo esc_html( get_post_meta( $post->ID, 'doc_text',true) ); ?> </a><?php endif; ?>
		</div>
	<?php endif; ?>		

	<?php if( get_theme_mod( 'favourite' ) == 1 || get_theme_mod( 'social_share' ) == 1 ): ?>
	<div class="image-bottom-share">
		<p>
			<?php 
			if( get_theme_mod( 'favourite' ) == 1 ):
				echo eidmart_get_likes_button( get_the_ID() );
			endif;
			?> 
		</p>
		
		<?php if( get_theme_mod( 'social_share' ) == 1 ): ?>
		<div class="social-link">                                
			<ul>
				<li><?php esc_html_e( 'Share:', 'eidmart' ); ?> </li>
				<?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
			</ul>                  
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="product-description-tab">

		<?php if( $eidmart_radio_value3 == 'value_7' ){ ?>

		<ul class="nav nav-tabs nav-justified" id="product_tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="item-details-tab" data-toggle="tab" href="#" data-target="#item-details"> <?php esc_html_e( 'Item Details', 'eidmart' ); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="comment-tab" data-toggle="tab" href="#" data-target="#comment"><?php esc_html_e( 'Comment', 'eidmart' ); ?></a>
			</li>
			<?php
			if (class_exists('EDD_Reviews')) { ?>
			<li class="nav-item">
				<a class="nav-link" id="review-tab" data-toggle="tab" href="#" data-target="#review"><?php esc_html_e( 'Reviews', 'eidmart' ); ?></a>
			</li>
			<?php } if ( get_post_meta($post->ID,'_faqs_details',true) ): ?>
			<li class="nav-item">
				<a class="nav-link" id="faq-tab" data-toggle="tab" href="#" data-target="#faq"><?php esc_html_e( 'Support', 'eidmart' ); ?></a>
			</li>
			<?php endif; /* End support tab */ ?>
		</ul>

		<?php } ?>
		
		<div class="tab-content" id="product_tab">

			<div class="tab-pane fade show active" id="item-details">
				<div class="item-details">                  

					<div class="edd-content">
						<?php the_content(); ?>
					</div>

				</div>
			</div>
			<div class="tab-pane fade" id="comment">
				
				<div class="blog-single-1x">
					<div class="blog-single-left-content">
					<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
					comments_template();
					endif;

					?>
					</div>
				</div>

			</div>

			<div class="tab-pane fade" id="review">
				<div class="edd-content">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="tab-pane fade" id="faq">
				<div class="faqs-1x item-faq">
					<div class="">
						<div class="row">
							<div class="col-md-12">
								<div id="accordion">

								<?php 
					
								$faqs = get_post_meta($post->ID,'_faqs_details',true);

								if( $faqs ):                                  
																	
								$faqs = get_post_meta($post->ID,'_faqs_details',true);                                                                
								//Obtaining the linked employeedetails meta values
								$_faqs_details = get_post_meta($post->ID,'_faqs_details',true);
								$c = 0;
								if ( is_array($_faqs_details)) {
									foreach( $_faqs_details as $faq_detail ) {
										if ( isset( $faq_detail['name'] ) || isset( $faq_detail['feature_value'] ) ) {                                            
											?>                                
												
											<div class="card single-faq">
												<div class="card-header">
													<h5 class="mb-0">
													<a class="accordion-toggle collapsed" data-toggle="collapse" href="#" data-target="#collapse<?php echo esc_attr( $c ); ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo esc_attr( $c ); ?>">
														<?php echo wp_kses( $faq_detail['name'], 'allowed_html' ); ?>                                 
													</a>
													</h5>
												</div>
												<div id="collapse<?php echo esc_attr( $c ); ?>" class="collapse" role="tabpanel" data-parent="#accordion" style="">
													<div class="card-body">
													<?php echo wp_kses( $faq_detail['feature_value'], 'allowed_html' ); ?>
													</div>
												</div>
											</div>

											<?php                                            
											$c = $c +1;
										}
									}
								} 									
								endif; 

								if( get_post_meta($post->ID,'request_text',true) ):
								?>
								<div class="card single-faq">
									<div class="card-header request-button">
									<h5 class="mb-0">
										<a class="accordion-toggle collapsed" data-toggle="collapse" href="#" data-target="#collapse<?php echo esc_attr( $c ); ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo esc_attr( $c ); ?>">
										<?php echo esc_html( get_post_meta($post->ID,'request_text',true) ); ?>                               
										</a>
									</h5>
									</div>
									<div id="collapse<?php echo esc_attr( $c ); ?>" class="collapse" role="tabpanel" data-parent="#accordion" style="">
									<div class="card-body">
										<?php 
										$request_form = get_post_meta( $post->ID, 'request_form',true);
										if( $request_form ):
										echo do_shortcode( $request_form ); 
										endif;
										?>
									</div>
									</div>
								</div>
								<?php endif; ?>                            
																				
								</div>
							</div>
						</div>
					</div> 
				</div>
			</div>

		</div>
	</div>	
</div> 