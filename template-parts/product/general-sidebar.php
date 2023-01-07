<?php
/**
 * Template part for displaying product sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

$meta = get_post_meta( $post->ID );
$eidmart_radio_value = ( isset( $meta['eidmart_radio_value'][0] ) && '' !== $meta['eidmart_radio_value'][0] ) ? $meta['eidmart_radio_value'][0] : '';
$eidmart_radio_value1 = ( isset( $meta['eidmart_radio_value1'][0] ) && '' !== $meta['eidmart_radio_value1'][0] ) ? $meta['eidmart_radio_value1'][0] : '';
$eidmart_radio_value2 = ( isset( $meta['eidmart_radio_value2'][0] ) && '' !== $meta['eidmart_radio_value2'][0] ) ? $meta['eidmart_radio_value2'][0] : '';
$eidmart_radio_value4 = ( isset( $meta['eidmart_radio_value4'][0] ) && '' !== $meta['eidmart_radio_value4'][0] ) ? $meta['eidmart_radio_value4'][0] : '';
$eidmart_radio_value6 = ( isset( $meta['eidmart_radio_value6'][0] ) && '' !== $meta['eidmart_radio_value6'][0] ) ? $meta['eidmart_radio_value6'][0] : '';
$ex_dwonload_url = ( isset( $meta['ex_dwonload_url'][0] ) && '' !== $meta['ex_dwonload_url'][0] ) ? $meta['ex_dwonload_url'][0] : '';

/**
 * For sidebar user sections
 * Collect user ID
 */
$user_id = get_the_author_meta('ID');
// Collect user name
$user_name = get_the_author_meta('user_login', $user_id);

?>

<!-- Start Sidebar -->
<div class="col-md-4">
    <div class="product-description-right">

		<?php if ( get_theme_mod( 'price_box' ) == 1 ) { 
			
		// Collect Price data
		$product_name = get_post_meta( $post->ID, 'product_name', true );
		$purchase_btn_text = get_post_meta( $post->ID, 'purchase_btn_text', true );
		$plan_name = get_post_meta( $post->ID, 'plan_name', true );
		$product_number = get_post_meta( $post->ID, 'product_number', true );
		$purchase_plan_btn_text = get_post_meta( $post->ID, 'purchase_plan_btn_text', true );
		$purchase_plan_btn_id = get_post_meta( $post->ID, 'purchase_plan_btn_id', true );
		
		?>
		<div class="price-tab">

			<?php if ( $eidmart_radio_value6 == 'price_nav_show' ): ?>
			<ul class="nav nav-pills" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="pills-theme-tab" data-bs-toggle="pill" data-bs-target="#theme" data-toggle="pill" data-target="#theme" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo esc_html( $product_name ); ?></button>
				</li>
				<li class="nav-item" role="presentation">
					<span><?php echo esc_html( $product_number ); ?></span>
					<button class="nav-link" id="pills-club-tab" data-bs-toggle="pill" data-bs-target="#club" data-toggle="pill" data-target="#club" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo esc_html( $plan_name ); ?></button>
				</li>
			</ul>
			<?php endif; ?>
			
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="theme" role="tabpanel" aria-labelledby="pills-theme-tab">
					<div class="price-box theme">

						<?php

						// Check if free download item
						if ( !get_post_meta( $post->ID, 'cart_bt_url', true ) ) {

							// Check for not external purchase link
							if ( !get_post_meta( $post->ID, 'purchase_text', true ) ) {

								if ( function_exists( 'EDD' ) ) {

									if ( edd_has_variable_prices( $post->ID ) ): // if free ?>
										<h3 class="total-cart"><?php echo edd_currency_symbol(); ?><span><b></b></span></h3>
									<?php
									else:
										echo "<h3><span><b>";
										echo edd_price( $post->ID );
										echo "</b></span></h3>";
									endif;

								}

								// Price list
								echo do_shortcode( '[purchase_link text="'. $purchase_btn_text .'" price=0]' );

							} else { // If external link

								echo "<h3><span><b>";
								echo edd_price( $post->ID );
								echo "</b></span></h3>";

								?>
								
									<a target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'purchase_url', true ) ); ?>" class="btn-small" <?php if( $ex_dwonload_url == 'download_yes' ): echo "download"; endif; ?>><?php echo esc_html( get_post_meta( $post->ID, 'purchase_text', true ) ); ?></a>

								<?php } // End external link

						} else { // Free download link button ?>

							<a target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'cart_bt_url', true ) ); ?>" class="btn-small free-download-btn" <?php if( $ex_dwonload_url == 'download_yes' ): echo "download"; endif; ?>><?php echo esc_html( get_post_meta( $post->ID, 'purchase_text', true ) ); ?></a>

						<?php } // End free download check ?>

					</div> <!--End price-box-->
				</div>
				<div class="tab-pane fade" id="club" role="tabpanel" aria-labelledby="pills-club-tab">
					<div class="price-box club">
						<h3 class="total-cartt"><?php echo edd_currency_symbol(); ?><span><b></b></span></h3>
						<?php echo do_shortcode( '[purchase_link id="'. $purchase_plan_btn_id .'" text="'. $purchase_plan_btn_text .'"]' ); ?>
					</div> <!--End price-box-->
				</div>
				<?php if( get_theme_mod( 'secured_text' ) || get_theme_mod( 'info_1' ) || get_theme_mod( 'secured_img' ) ): ?>
				<ul class="price-additional-info">
					<?php if( get_theme_mod( 'info_1' ) ): ?><li><i class="las la-check"></i> <?php echo esc_html( get_theme_mod( 'info_1' ) ); if( get_theme_mod( 'info_1_details' ) ): ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( get_theme_mod( 'info_1_details' ) ); ?>"></i><?php endif; ?></li><?php endif; ?>
					<?php if( get_theme_mod( 'info_2' ) ): ?><li><i class="las la-check"></i> <?php echo esc_html( get_theme_mod( 'info_2' ) ); if( get_theme_mod( 'info_2_details' ) ): ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( get_theme_mod( 'info_2_details' ) ); ?>"></i><?php endif; ?></li><?php endif; ?>
					<?php if( get_theme_mod( 'info_3' ) ): ?><li><i class="las la-check"></i> <?php echo esc_html( get_theme_mod( 'info_3' ) ); if( get_theme_mod( 'info_3_details' ) ): ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( get_theme_mod( 'info_3_details' ) ); ?>"></i><?php endif; ?></li><?php endif; ?>
					<?php if( get_theme_mod( 'info_4' ) ): ?><li><i class="las la-check"></i> <?php echo esc_html( get_theme_mod( 'info_4' ) ); if( get_theme_mod( 'info_4_details' ) ): ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( get_theme_mod( 'info_4_details' ) ); ?>"></i><?php endif; ?></li><?php endif; ?>
					<?php if( get_theme_mod( 'info_5' ) ): ?><li><i class="las la-check"></i> <?php echo esc_html( get_theme_mod( 'info_5' ) ); if( get_theme_mod( 'info_5_details' ) ): ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( get_theme_mod( 'info_5_details' ) ); ?>"></i><?php endif; ?></li><?php endif; ?>
					<?php if( get_theme_mod( 'secured_text' ) ): ?><span><i class="fa fa-lock"></i> <?php echo esc_html( get_theme_mod( 'secured_text' ) ); ?></span><?php endif; ?>
					<?php if( get_theme_mod( 'secured_img' ) ): ?><img src="<?php echo esc_attr( get_theme_mod( 'secured_img', ''.get_template_directory_uri(). '/images/credit-card-certificate.png')); ?>" alt="<?php echo esc_attr( 'Credit Card Certificate', 'eidmart' ); ?>"><?php endif; ?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
        <?php } // End price box
		
		// Start purchase and comment
		if ( $eidmart_radio_value1 == 'value_3' && get_theme_mod( 'purchase_comment' ) == 1 ) { ?>
        <div class="purchase-comments">
            <h2><i class="fa fa-cart-plus"></i> <span><?php echo edd_get_download_sales_stats( get_the_ID() ); ?></span> <?php esc_html_e( 'Purchase', 'eidmart' );?></h2>
            <a href="#comment"> <i class="fa fa-comment" aria-hidden="true"></i> <span><?php comments_number( esc_html__( '0', 'eidmart' ), '1' . esc_html__( ' ', 'eidmart' ), '% ' . esc_html__( ' ', 'eidmart' ) );?></span> <?php esc_html_e( 'Comments', 'eidmart' );?></a>
        </div>
        <?php } ?>

		<?php if ( get_theme_mod( 'user_profile' ) == 1 ): ?>
		<div class="eproduct-author">
			<div class="user-image">
				<?php echo get_avatar( $user_id, '95', '' , '' , array( 'class' => array( '' ) ) ); ?>
			</div>
			<div class="user-information">
				<span class="user-name"><?php the_author(); ?></span>
				<span class="user-join-date">
					<b><?php esc_html_e( 'Joined: ', 'eidmart' ); ?></b>
					<?php
					$udata = get_userdata( $user_id );
					$registered = $udata->user_registered;
					printf( '%s', date( "F Y", strtotime( $registered ) ) );							
					?>
				</span>
				<span class="user-profile"><a class="btn-hover color-primary" href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"><?php esc_html_e( 'View Portfolio', 'eidmart' );  ?></a></span>
			</div>
		</div>
		<?php endif; ?>

		<?php 		
		if ( $eidmart_radio_value4 == 'value_9' ) {
			if ( class_exists( 'EDD_Reviews' ) ) {?>
			<div class="item-rating">
				<b><?php esc_html_e( 'Item Rating:', 'eidmart' );?></b><br>
				<?php
					$mreview = new \EDD_Reviews;					
					$rating = $mreview->average_rating(false);						
					if ( $rating > 0 ) {
						echo wp_kses_post( $mreview->render_star_rating( $rating ) . ' ('. $rating .') ' );
						echo esc_html( $mreview->display_total_reviews_count() );
					} else {
						esc_html_e( 'This item no rated yet.', 'eidmart' );
					}
				?>
			</div>
			<?php 
			}
		} 

		if ( get_theme_mod( 'pro_feature' ) != 0 ) {

			$browser_support = get_post_meta( $post->ID, 'browser_support', true );
			$compatible_with = get_post_meta( $post->ID, 'compatible_with', true );
			$framework = get_post_meta( $post->ID, 'framework', true );
			$software_version = get_post_meta( $post->ID, 'software_version', true );
			$layout_types = get_post_meta( $post->ID, 'layout_types', true );
			$files_included = get_post_meta( $post->ID, 'files_included', true );

			?>

			<div class="product-features">
				<ul>
					<?php 
					if ( get_theme_mod( 'pro_feature' ) == 2 ) {

						// Vendor Features
						if ( is_array( $browser_support ) && isset( $browser_support ) ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Compatible Browsers', 'eidmart' ); ?> 
								</strong>
								<span>								
									<?php
									$copy = $browser_support;
									foreach ( $browser_support as $browser ) {
										echo esc_html( $browser );
										if ( next( $copy ) ) {
											echo ', ';
										}
									}
									?>
								</span>
							</li>
						<?php
						} if ( $compatible_with != '' ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Compatible With', 'eidmart' ); ?> 
								</strong>
								<span>
									<?php echo esc_html( $compatible_with ); ?>
								</span>
							</li>
						<?php
						} if ( is_array( $framework ) && isset( $framework ) ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Framework', 'eidmart' ); ?> 
								</strong>
								<span>
								
								<?php
								$copy = $framework;
								foreach ( $framework as $item ) {
									echo esc_html( $item );
									if ( next( $copy ) ) {
										echo ', ';
									}
								}
								?>
								</span>
							</li>
						<?php
						} if ( is_array( $software_version ) && isset( $software_version ) ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Software Version', 'eidmart' ); ?> 
								</strong>
								<span>
									<?php
									$copy = $software_version;
									foreach ( $software_version as $software ) {
										echo esc_html( $software );
										if ( next( $copy ) ) {
											echo ', ';
										}
									}
									?>
								</span>
							</li>
						<?php
						} if ( is_array( $layout_types ) && isset( $layout_types ) ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Layout Types', 'eidmart' ); ?> 
								</strong>
								<span>
									<?php
									$copy = $layout_types;
									foreach ( $layout_types as $layout ) {
										echo esc_html( $layout );
										if ( next( $copy ) ) {
											echo ', ';
										}
									}
									?>
								</span>
							</li>
						<?php
						} if ( is_array( $files_included ) && isset( $files_included ) ) { ?>
							<li>
								<strong> 
									<?php echo esc_html__( 'Files Included', 'eidmart' ); ?> 
								</strong>
								<span>
									<?php
									$copy = $files_included;
									foreach ( $files_included as $file ) {
										echo esc_html( $file );
										if ( next( $copy ) ) {
											echo ', ';
										}
									}
									?>
								</span>
							</li>
						<?php } // End array check

					} else {

						// Administrator Features
						$features = get_post_meta( $post->ID, '_feature_details', true );
						//Obtaining the linked employeedetails meta values
						$_feature_details = get_post_meta( $post->ID, '_feature_details', true );
						$c = 0;

						if ( is_array( $_feature_details ) ) {
							foreach ( $_feature_details as $employeeDetail ) {
								if ( isset( $employeeDetail['name'] ) || isset( $employeeDetail['feature_value'] ) ) { ?>

									<li><strong> <?php echo wp_kses( $employeeDetail['name'], 'allowed_html' ); ?> </strong> <span><?php echo wp_kses( $employeeDetail['feature_value'], 'allowed_html' ); ?></span></li>

									<?php
									$c = $c + 1;
								}
							}
						} ?>						

					<?php } ?>

					<!-- Item tags -->
					<li><strong><?php esc_html_e( 'Tags', 'eidmart' );?></strong><span><?php echo eidmart_tag_name(); ?></span></li>

				</ul>
			</div>

		<?php 
		} ?>

    </div>
</div> <!-- End Sidebar -->