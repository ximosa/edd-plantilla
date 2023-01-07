<?php 

/**
 * Template Name: Video:: Multi Vendor Profile
 *
 * @package eidmart
 **/

get_header();

global $post;

$user_name = get_query_var('vendor');
$username = $user_name;
$user = get_user_by( 'login', $username);

$products = EDD_FES()->vendors->get_all_products( $user->ID );

$sales = 0;
$earnings = 0;
if (!empty($products)) {
	foreach ($products as $product) {
		$sales += $product['sales'];
		$earnings += $product['earnings'];
	}
} 

// Collect author by author slug
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

// Global data initialization
$follow = isset( $_GET['follow'] ) ? $_GET['follow'] : '';

// Author post count
$user_posts = count_user_posts( $user->ID, 'post' );
$singular_check = ( $user_posts <= 0 ) ? __( 'Article', 'eidmart' ) : __( 'Articles', 'eidmart' );

// Vendor porduct count
$user_items = count_user_posts( $user->ID, 'download' );
$singular_check_items = ( $user_posts <= 0 ) ? __( 'Portfolio', 'eidmart' ) : __( 'Portfolio', 'eidmart' );

// Vendor information
if( class_exists( 'EDD_Front_End_Submissions' ) ):
	$db_user = new FES_DB_Vendors();
	$vendor = $db_user->get_vendor_by( 'user_id', $user->ID );
endif;

// check if vendor
if ( $db_user->exists( 'user_id', $user->ID ) ) { ?>

	<div class="author-profile-banner">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-md-6">
					<div class="author-profile-left">
						<div class="media">
							<?php echo get_avatar( $user->ID, '60', '' , '' , array( 'class' => array( '' ) ) ); ?>
							<div class="media-body">
								<span class="author">
									<?php 

									if( get_user_meta( $user->ID, 'name_of_store', true ) ):                                  
										echo get_user_meta( $user->ID, 'name_of_store', true ); 
									else :
										echo esc_html( $user->display_name ); 
									endif;

									// if eidmart plugin active
									if( get_theme_mod( 'user_follow', 0 ) == 1 && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
										if ( is_user_logged_in() ) {
											echo followsoft_get_follow_unfollow_links( get_the_author_meta( 'ID', $user->ID ) );
										} else { ?>					
											<a href="#" class="followsoft-follow-link"><?php esc_html_e( "Follow", "eidmart" ); ?></a>
										<?php 
										} 
									} ?>
								</span>
								
								<p>
									<b><?php esc_html_e( 'Joined: ', 'eidmart' ); ?></b>
									<?php
									$udata = get_userdata( $user->ID );
									$registered = $udata->user_registered;
									printf( '%s', date( "F j, Y", strtotime( $registered ) ) );
								
									?>
								</p>
								<ul class="vendor-social">
									<?php if( get_user_meta( $user->ID, 'facebook', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'facebook', true )); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( $user->ID, 'twitter', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'twitter', true )); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( $user->ID, 'linkedin', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'linkedin', true )); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( $user->ID, 'dribbble', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'dribbble', true )); ?>"><i class="fa fa-dribbble"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( $user->ID, 'github', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'github', true )); ?>"><i class="fa fa-github"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( $user->ID, 'behance', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'behance', true )); ?>"><i class="fa fa-behance"></i></a></li><?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">                  
					<div class="author-profile-right">
						<div class="row">                      

							<?php if( get_current_user_id() == $user->ID ): ?>
							
								<div class="col-md-4">
									<div class="sales-info orange">
										<h3><?php echo edd_currency_symbol(); echo esc_html( intval( $vendor->sales_value ) ); ?></h3>
										<p><?php esc_html_e( 'Total Earnings', 'eidmart' ); ?></p>
									</div>
								</div>

								<div class="col-md-4">
									<div class="sales-info blue">
										<h3><?php echo esc_html( $vendor->sales_count ); ?></h3>
										<p><?php esc_html_e( 'Lifetime Sales', 'eidmart' ); ?></p>
									</div>
								</div>

							<?php else : ?>

								<div class="col-md-4 offset-md-4">
									<div class="sales-info blue">
										<h3><?php echo esc_html( $vendor->sales_count ); ?></h3>
										<p><?php esc_html_e( 'Lifetime Sales', 'eidmart' ); ?></p>
									</div>
								</div>

							<?php endif; ?>

							<div class="col-md-4">
								<div class="sales-info red">
									<h3><?php echo esc_html( count_user_posts( $user->ID, 'download' ) ); ?></h3>
									<p><?php esc_html_e( 'Total Items', 'eidmart' ); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php if( get_user_meta( $user->ID, 'intro', true ) ): ?>
			<div class="row">
				<div class="col-md-12">
				<div class="vendor-intro">
					<h1><?php esc_html_e( 'Introduction', 'eidmart' ); ?></h1> 
					<p><?php echo wp_kses( get_user_meta( $user->ID, 'intro', true ), 'allowed_html' ); ?></p>
				</div>
				</div>
			</div>
			<?php endif; ?>
			
		</div>
	</div> 

	<?php // if eidmart plugin active
	if( get_theme_mod( 'user_follow', 0 ) == 1  && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>

	<div class="container margin-bottom-large">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light eidmart-dashboard-menu">
					<?php
						$follower_count = followsoft_get_follower_count( get_the_author_meta( 'ID', $user->ID ) );
						$following_count = followsoft_get_following_count( get_the_author_meta( 'ID', $user->ID ) ) - 1;
					?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#eidmart_dashboard_menu" aria-controls="eidmart_dashboard_menu" aria-expanded="false" aria-label="Toggle navigation">
						<i class="las la-bars"></i>
					</button>
					<div class="collapse navbar-collapse" id="eidmart_dashboard_menu">
						<div class="navbar-nav">						
							<?php if( class_exists( 'EDD_Front_End_Submissions' ) && 'approved' == isset( $vendor->status ) && is_user_logged_in() && $user->ID == get_current_user_id() ): ?>
								<a class="nav-item nav-link <?php if( !$follow && !get_page_link() ): echo "active"; endif; ?>" href="<?php echo esc_url( home_url( '/vendor-dashboard/' ) ); ?>"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Dashboard', 'eidmart' ); ?></span></a>						
							<?php endif; 
							// Check user item
							if( $user_items > 0 ): ?>
								<a class="nav-item nav-link <?php if( !$follow ): echo "active"; endif; ?>" href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url( EDD_FES()->vendors->get_vendor_store_url( $user->ID ) );} ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check_items, $user_items ); ?></span></a>
							<?php endif; ?>
								
							<a class="nav-item nav-link" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check, $user_posts ); ?></span></a>
								
							<?php if( class_exists( 'EDD_Front_End_Submissions' ) ): ?>
								<a class="nav-item nav-link <?php if( 'follower' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( EDD_FES()->vendors->get_vendor_store_url( $user->ID ) ); ?>?follow=follower"><?php printf( __( 'Followers <span class="badge badge-secondary">%s</span>', 'eidmart' ), $follower_count ); ?></a>
								<a class="nav-item nav-link <?php if( 'following' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( EDD_FES()->vendors->get_vendor_store_url( $user->ID ) ); ?>?follow=following"><?php printf( __( 'Following <span class="badge badge-secondary">%s</span>', 'eidmart' ), $following_count ); ?></a>
							<?php endif; ?>
						</div>
					</div>

					<?php if( get_theme_mod( 'vendor_message_popup', 1 ) == 1 ): ?>
						<!-- Button trigger modal -->
						<button type="button" class="btn-hover color-primary" data-toggle="modal" data-target="#vendorMessage" data-bs-toggle="modal" data-bs-target="#exampleModal">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i> <?php esc_html_e( 'Message', 'eidmart' ); ?>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="vendorMessage" tabindex="-1" aria-labelledby="vendorMessageLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title"><?php echo esc_html__( 'Email to ', 'eidmart' ) . '<span>' . $user->display_name . '</span>' ?></h3>
									</div>
									<div class="modal-body">
										<div class="vendor-feature-product vendor-profile">
											<?php echo do_shortcode( '[fes_vendor_contact_form id="'. $user->ID .'"]'  ); ?>
										</div>
									</div>						
								</div>
							</div>
						</div>
					<?php endif; ?>
				</nav>
			</div>					
		</div>
	</div>

	<?php } ?>

	<div class="container margin-bottom-large video-filter<?php if( get_theme_mod( 'user_follow' ) == 2 ): echo " margin-top-large"; endif; ?>">
		<div class="row photography-filter">

			<?php if( 'follower' == $follow ) { 				

			// if eidmart plugin active
			if( get_theme_mod( 'user_follow', 0 ) == 1 && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				// Author following users
				include_once( ABSPATH.'wp-content/plugins/eidmart-plugin/inc/user-follow/display/author_follower.php' );
			} // eidmart plugin active check

			} else if( 'following' == $follow ) { 

			// if eidmart plugin active
			if( get_theme_mod( 'user_follow', 0 ) == 1 && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				// Author following users
				include_once( ABSPATH.'wp-content/plugins/eidmart-plugin/inc/user-follow/display/author_following.php' );
			} // eidmart plugin active check

			} else { 
				
				// Vendor sidebar show/hide
				if( get_theme_mod( 'vendor_sidebar', 1 ) == 1 ) { ?>

					<div class="col-md-4">

						<?php

						$featured_item = get_user_meta( $user->ID, 'featured_item', true );
						
						if ( $featured_item ) {
						
						$args = array(
							'post_type' => 'download', 
							'author' => $user->ID,                              
							'post__in' => array( $featured_item ),
							'posts_per_page' => 1
						);


						$featured_item = new WP_Query( $args ); 

						if( $featured_item->have_posts() ):
							while ( $featured_item->have_posts() ) : 

							$featured_item -> the_post();
						
							$id = get_the_ID();
							$meta = get_post_meta(get_the_ID());
							$variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
							$edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

							$sales = edd_get_download_sales_stats(get_the_ID());
							$sales = $sales > 1 ? __('Sales ', 'eidmart') . $sales : __('Sale ', 'eidmart') .$sales;

							$internal_url = isset($meta['mp4_url'][0]) ? $meta['mp4_url'][0] : '';
							$external_url = isset($meta['external_url'][0]) ? $meta['external_url'][0] : '';

							$video_url = !empty( $external_url ) ? $external_url : $internal_url;
							$video_type = isset($meta['video_type'][0]) ? $meta['video_type'][0] : 1;

							// Collect downloads tearms
							$terms = get_the_terms($post->ID, 'download_category');

							/**
							 * Get all variable pricing
							 */
							$prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $id ), $id );
							
							/**
							 * Get checked item
							 */
							$checked_key = isset( $_GET['price_option'] ) ? absint( $_GET['price_option'] ) : edd_get_default_variable_price( $id );
							$price_checked = apply_filters( 'edd_price_option_checked', $checked_key, $id );                            
							$price_checked = isset( $price_checked ) ? $price_checked: 0;

							// Variables pricing price
							$regular_amount = isset( $prices[$price_checked]['regular_amount'] ) ? $prices[$price_checked]['regular_amount']: 1;
							$sale_price = isset( $prices[$price_checked]['sale_price'] ) ? $prices[$price_checked]['sale_price']: 1;

							// Pricing options price
							$single_regular_price = get_post_meta( $id, 'edd_price', true );
							$single_sale_price = get_post_meta( $id, 'edd_sale_price', true );

							/**
							 * Get the selected price of variable item
							 */
							if( 1 != $checked_key ): 
								$item_price = edd_price( $id, false, $price_checked ); 
							else: 
								$item_price = edd_price( $id, false, '' ); 
							endif;
							
							?>                    

							<div class="col-md-12 photography-filter-item">
								<div class="load-more">
								
									<a class="photography-item_url" href="<?php the_permalink();?>">
									<?php if( $video_url ): 
										
										// Check video type
										if( $video_type == 1 ){ ?>

											<video <?php if( get_theme_mod( 'video_sound' ) == 1 ): echo "muted"; endif; ?> class="hvrbox-layer_bottom video-control" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
												<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
												<?php esc_html_e( 'Your browser does not support HTML5 video.', 'eidmart' ); ?>
											</video>

										<?php } else { ?>

											<!-- 16:9 aspect ratio -->
											<div class="embed-responsive embed-responsive-16by9" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
												<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_url ); ?>?rel=0&controls=0&modestbranding=1&showinfo=0" allowfullscreen frameborder="0""></iframe>
											</div>

										<?php } endif; ?>
									</a>

									<?php
									/**
									 * Discount percentage calculation
									 */
									if( $sale_price && edd_has_variable_prices( $id ) ):
										$discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
									elseif( $single_sale_price ):
										$discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
									else:
										$discount_percent = 0;
									endif;

									/**
									 * Discount Percentage
									 */
									if( $discount_percent > 0 ):
									?>
									<p class="discount-percentage">
										<span><?php echo esc_html( $discount_percent ); ?>%</span>
										<?php esc_html_e( 'Off', 'eidmart' ); ?>
									</p>
									<?php endif; 
									
									if ( get_theme_mod( 'eid_love' ) == 'on' ): ?>
										<div class="image-rating">
											<span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span>
										</div>
									<?php endif; if ( get_theme_mod( 'eid_price_con' ) == 'on' ): ?>
										<span class="sale"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart'); endif; ?></span>
									<?php endif;

									echo "<div class='auth-info'>"; 
										if( get_theme_mod( 'author' ) =='on' || get_theme_mod( 'category' ) =='on' ):                                            
											echo "<span>";
												if( get_theme_mod( 'author' ) =='on' ):
												
												// Author picture show
												echo get_avatar(get_the_author_meta('ID'), '40', '', '', array('class' => array('vendor-pic')));
												esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

												<?php 
												endif;

												if ( get_theme_mod( 'category' ) == 'on' ):                                    
													esc_html_e('in', 'eidmart');                                                
													$terms = get_the_terms($id, 'download_category');
													if (!empty($terms) && !is_wp_error($terms)) {
														//foreach ( $terms as $term ) {
														?>
															<a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
															<?php if( $video_type == 2 && get_theme_mod( 'youtube_btn' ) ): ?>
															<a class="btn-hover color-11" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'youtube_btn', 'Read more' ) ); ?></a>
														<?php
													endif; // End video type checking
													//}
													}
												endif;                                    
											echo "</span>";
										endif; // End author and category

										if (class_exists('EDD_Reviews') && get_theme_mod( 'eid_ratings' ) == 'on') {
											echo "<span class='bt-review'>";

												$mreview = new \EDD_Reviews;
												$rating = $mreview->average_rating(false);
												echo wp_kses_post( $mreview->render_star_rating( $rating ) );
												echo '('. esc_html( $mreview->count_reviews() ).')';

											echo "</span>";
										} // End ratings check 
										if ( get_theme_mod( 'eid_sales' ) == 'on'): 
											echo "<span>".esc_html( $sales )."</span>";
										endif;
										?>
									</div>
								</div>
							</div>               

							<?php endwhile; wp_reset_postdata();                     

						else: ?>                            
						
						<div class="vendor-feature-product vendor-profile">
							<h3><?php esc_html_e( 'No item available right now.','eidmart' ); ?></h3>
						</div>

						<?php endif; } ?>

						<?php if( get_user_meta( $user->ID, 'work_ad', true ) ): ?>
						<div class="freelance-available">
						<i class="fa fa-check-circle"></i> <?php echo get_user_meta( $user->ID, 'work_ad', true ); ?>
						</div>
						<?php endif; ?>

						<div class="vendor-feature-product vendor-profile">
							<h2><?php echo esc_html__( 'Email to ', 'eidmart' ) . '<span>' . $user->display_name . '</span>' ?></h2>
							<?php echo do_shortcode( '[fes_vendor_contact_form id="'. $user->ID .'"]'  ); ?>
						</div>

					</div>

					<div class="col-md-8">
						<div class="row">
							
							<?php
							// Author item display
							$paged = ( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;

							$args = array(
								'post_type' => 'download', 
								'author' => $user->ID,  
								'product_para' => '',                             
								'paged' => $paged,                             
								'posts_per_page' => 6
							);


							$temp = $wp_query; 
							$wp_query = null; 

							$wp_query = new WP_Query(); 

							$wp_query -> query( $args ); 

							if( $wp_query->have_posts() ): ?>

							<?php

								while ( $wp_query->have_posts() ) : 
									$wp_query -> the_post();
							
									$id = get_the_ID();
									$meta = get_post_meta(get_the_ID());
									$variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
									$edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

									$sales = edd_get_download_sales_stats(get_the_ID());
									$sales = $sales > 1 ? __('Sales ', 'eidmart') . $sales : __('Sale ', 'eidmart') .$sales;

									$internal_url = isset($meta['mp4_url'][0]) ? $meta['mp4_url'][0] : '';
									$external_url = isset($meta['external_url'][0]) ? $meta['external_url'][0] : '';

									$video_url = !empty( $external_url ) ? $external_url : $internal_url;
									$video_type = isset($meta['video_type'][0]) ? $meta['video_type'][0] : 1;

									// Collect downloads tearms
									$terms = get_the_terms($post->ID, 'download_category');

									/**
									 * Get all variable pricing
									 */
									$prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $id ), $id );
									
									/**
									 * Get checked item
									 */
									$checked_key = isset( $_GET['price_option'] ) ? absint( $_GET['price_option'] ) : edd_get_default_variable_price( $id );
									$price_checked = apply_filters( 'edd_price_option_checked', $checked_key, $id );                            
									$price_checked = isset( $price_checked ) ? $price_checked: 0;

									// Variables pricing price
									$regular_amount = isset( $prices[$price_checked]['regular_amount'] ) ? $prices[$price_checked]['regular_amount']: 1;
									$sale_price = isset( $prices[$price_checked]['sale_price'] ) ? $prices[$price_checked]['sale_price']: 1;

									// Pricing options price
									$single_regular_price = get_post_meta( $id, 'edd_price', true );
									$single_sale_price = get_post_meta( $id, 'edd_sale_price', true );

									/**
									 * Get the selected price of variable item
									 */
									if( 1 != $checked_key ): 
										$item_price = edd_price( $id, false, $price_checked ); 
									else: 
										$item_price = edd_price( $id, false, '' ); 
									endif;
									
									?>                    

									<div class="col-md-6 photography-filter-item">
										<div class="load-more">
										
											<a class="photography-item_url" href="<?php the_permalink();?>">
											<?php if( $video_url ): 
												
												// Check video type
												if( $video_type == 1 ){ ?>

													<video <?php if( get_theme_mod( 'video_sound' ) == 1 ): echo "muted"; endif; ?> class="hvrbox-layer_bottom video-control" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
														<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
														<?php esc_html_e( 'Your browser does not support HTML5 video.', 'eidmart' ); ?>
													</video>

												<?php } else { ?>

													<!-- 16:9 aspect ratio -->
													<div class="embed-responsive embed-responsive-16by9" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
														<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_url ); ?>?rel=0&controls=0&modestbranding=1&showinfo=0" allowfullscreen frameborder="0""></iframe>
													</div>

												<?php } endif; ?>
											</a>

											<?php
											/**
											 * Discount percentage calculation
											 */
											if( $sale_price && edd_has_variable_prices( $id ) ):
												$discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
											elseif( $single_sale_price ):
												$discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
											else:
												$discount_percent = 0;
											endif;

											/**
											 * Discount Percentage
											 */
											if( $discount_percent > 0 ):
											?>
											<p class="discount-percentage">
												<span><?php echo esc_html( $discount_percent ); ?>%</span>
												<?php esc_html_e( 'Off', 'eidmart' ); ?>
											</p>
											<?php endif; 
											
											if ( get_theme_mod( 'eid_love' ) == 'on' ): ?>
												<div class="image-rating">
													<span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span>
												</div>
											<?php endif; if ( get_theme_mod( 'eid_price_con' ) == 'on' ): ?>
												<span class="sale"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart'); endif; ?></span>
											<?php endif;

											echo "<div class='auth-info'>"; 
												if( get_theme_mod( 'author' ) =='on' || get_theme_mod( 'category' ) =='on' ):                                            
													echo "<span>";
														if( get_theme_mod( 'author' ) =='on' ):
														
														// Author picture show
														echo get_avatar(get_the_author_meta('ID'), '40', '', '', array('class' => array('vendor-pic')));
														esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

														<?php 
														endif;

														if ( get_theme_mod( 'category' ) == 'on' ):                                    
															esc_html_e('in', 'eidmart');                                                
															$terms = get_the_terms($id, 'download_category');
															if (!empty($terms) && !is_wp_error($terms)) {
																//foreach ( $terms as $term ) {
																?>
																	<a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
																	<?php if( $video_type == 2 && get_theme_mod( 'youtube_btn' ) ): ?>
																	<a class="btn-hover color-11" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'youtube_btn', 'Read more' ) ); ?></a>
																<?php
															endif; // End video type checking
															//}
															}
														endif;                                    
													echo "</span>";
												endif; // End author and category

												if (class_exists('EDD_Reviews') && get_theme_mod( 'eid_ratings' ) == 'on') {
													echo "<span class='bt-review'>";

														$mreview = new \EDD_Reviews;
														$rating = $mreview->average_rating(false);
														echo wp_kses_post( $mreview->render_star_rating( $rating ) );
														echo '('. esc_html( $mreview->count_reviews() ).')';

													echo "</span>";
												} // End ratings check 
												if ( get_theme_mod( 'eid_sales' ) == 'on'): 
													echo "<span>".esc_html( $sales )."</span>";
												endif;
												?>
											</div>
										</div>
									</div>                                  

									<?php endwhile; wp_reset_postdata(); 
									
									if( paginate_links() ): ?>  

									<div class="col-md-12">
										<div class="course-pagination">
											<ul class="pagination">
												<li>
												<?php

												global $wp_query;
											
												$big = 999999999; // need an unlikely integer

												echo paginate_links( array(             
													
													'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
													'total'        => $wp_query->max_num_pages,
													'current'      => max( 1, get_query_var( 'paged' ) ),
													'format'       => '?paged=%#%',
													'show_all'     => false,
													'type'         => 'plain',
													'end_size'     => 2,
													'mid_size'     => 1,
													'prev_next'    => true,
													'prev_text' => '<i class="fa fa-angle-left"></i>',
													'next_text' => '<i class="fa fa-angle-right"></i>',
													'add_args'     => false,
													'add_fragment' => ''

												) );

												?>
												</li>
											</ul>
										</div>
									</div>                           

							<?php endif; else: ?>                            
							
								<h4><?php esc_html_e( 'No item available right now.','eidmart' ); ?></h4>
							
							<?php endif; ?>

						</div>
					</div>

				<?php } else { ?>

					<div class="col-md-12">
						<div class="row">

							<?php
							// Author item display
							$paged = ( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;

							$args = array(
								'post_type' => 'download', 
								'author' => $user->ID,  
								'product_para' => '',                             
								'paged' => $paged,                             
								'posts_per_page' => 6
							);


							$temp = $wp_query; 
							$wp_query = null; 

							$wp_query = new WP_Query(); 

							$wp_query -> query( $args ); 

							if( $wp_query->have_posts() ): ?>

							<?php

								while ( $wp_query->have_posts() ) : 
									$wp_query -> the_post();
							
									$id = get_the_ID();
									$meta = get_post_meta(get_the_ID());
									$variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
									$edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

									$sales = edd_get_download_sales_stats(get_the_ID());
									$sales = $sales > 1 ? __('Sales ', 'eidmart') . $sales : __('Sale ', 'eidmart') .$sales;

									$internal_url = isset($meta['mp4_url'][0]) ? $meta['mp4_url'][0] : '';
									$external_url = isset($meta['external_url'][0]) ? $meta['external_url'][0] : '';

									$video_url = !empty( $external_url ) ? $external_url : $internal_url;
									$video_type = isset($meta['video_type'][0]) ? $meta['video_type'][0] : 1;

									// Collect downloads tearms
									$terms = get_the_terms($post->ID, 'download_category');

									/**
									 * Get all variable pricing
									 */
									$prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $id ), $id );
									
									/**
									 * Get checked item
									 */
									$checked_key = isset( $_GET['price_option'] ) ? absint( $_GET['price_option'] ) : edd_get_default_variable_price( $id );
									$price_checked = apply_filters( 'edd_price_option_checked', $checked_key, $id );                            
									$price_checked = isset( $price_checked ) ? $price_checked: 0;

									// Variables pricing price
									$regular_amount = isset( $prices[$price_checked]['regular_amount'] ) ? $prices[$price_checked]['regular_amount']: 1;
									$sale_price = isset( $prices[$price_checked]['sale_price'] ) ? $prices[$price_checked]['sale_price']: 1;

									// Pricing options price
									$single_regular_price = get_post_meta( $id, 'edd_price', true );
									$single_sale_price = get_post_meta( $id, 'edd_sale_price', true );

									/**
									 * Get the selected price of variable item
									 */
									if( 1 != $checked_key ): 
										$item_price = edd_price( $id, false, $price_checked ); 
									else: 
										$item_price = edd_price( $id, false, '' ); 
									endif;
									
									?>                    

									<div class="col-md-6 photography-filter-item">
										<div class="load-more">
										
											<a class="photography-item_url" href="<?php the_permalink();?>">
											<?php if( $video_url ): 
												
												// Check video type
												if( $video_type == 1 ){ ?>

													<video <?php if( get_theme_mod( 'video_sound' ) == 1 ): echo "muted"; endif; ?> class="hvrbox-layer_bottom video-control" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
														<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
														<?php esc_html_e( 'Your browser does not support HTML5 video.', 'eidmart' ); ?>
													</video>

												<?php } else { ?>

													<!-- 16:9 aspect ratio -->
													<div class="embed-responsive embed-responsive-16by9" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
														<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_url ); ?>?rel=0&controls=0&modestbranding=1&showinfo=0" allowfullscreen frameborder="0""></iframe>
													</div>

												<?php } endif; ?>
											</a>

											<?php
											/**
											 * Discount percentage calculation
											 */
											if( $sale_price && edd_has_variable_prices( $id ) ):
												$discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
											elseif( $single_sale_price ):
												$discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
											else:
												$discount_percent = 0;
											endif;

											/**
											 * Discount Percentage
											 */
											if( $discount_percent > 0 ):
											?>
											<p class="discount-percentage">
												<span><?php echo esc_html( $discount_percent ); ?>%</span>
												<?php esc_html_e( 'Off', 'eidmart' ); ?>
											</p>
											<?php endif; 
											
											if ( get_theme_mod( 'eid_love' ) == 'on' ): ?>
												<div class="image-rating">
													<span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span>
												</div>
											<?php endif; if ( get_theme_mod( 'eid_price_con' ) == 'on' ): ?>
												<span class="sale"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart'); endif; ?></span>
											<?php endif;

											echo "<div class='auth-info'>"; 
												if( get_theme_mod( 'author' ) =='on' || get_theme_mod( 'category' ) =='on' ):                                            
													echo "<span>";
														if( get_theme_mod( 'author' ) =='on' ):
														
														// Author picture show
														echo get_avatar(get_the_author_meta('ID'), '40', '', '', array('class' => array('vendor-pic')));
														esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

														<?php 
														endif;

														if ( get_theme_mod( 'category' ) == 'on' ):                                    
															esc_html_e('in', 'eidmart');                                                
															$terms = get_the_terms($id, 'download_category');
															if (!empty($terms) && !is_wp_error($terms)) {
																//foreach ( $terms as $term ) {
																?>
																	<a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
																	<?php if( $video_type == 2 && get_theme_mod( 'youtube_btn' ) ): ?>
																	<a class="btn-hover color-11" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'youtube_btn', 'Read more' ) ); ?></a>
																<?php
															endif; // End video type checking
															//}
															}
														endif;                                    
													echo "</span>";
												endif; // End author and category

												if (class_exists('EDD_Reviews') && get_theme_mod( 'eid_ratings' ) == 'on') {
													echo "<span class='bt-review'>";

														$mreview = new \EDD_Reviews;
														$rating = $mreview->average_rating(false);
														echo wp_kses_post( $mreview->render_star_rating( $rating ) );
														echo '('. esc_html( $mreview->count_reviews() ).')';

													echo "</span>";
												} // End ratings check 
												if ( get_theme_mod( 'eid_sales' ) == 'on'): 
													echo "<span>".esc_html( $sales )."</span>";
												endif;
												?>
											</div>
										</div>
									</div>                                  

									<?php endwhile; wp_reset_postdata(); 
									
									if( paginate_links() ): ?>  

									<div class="col-md-12">
										<div class="course-pagination">
											<ul class="pagination">
												<li>
												<?php

												global $wp_query;
											
												$big = 999999999; // need an unlikely integer

												echo paginate_links( array(             
													
													'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
													'total'        => $wp_query->max_num_pages,
													'current'      => max( 1, get_query_var( 'paged' ) ),
													'format'       => '?paged=%#%',
													'show_all'     => false,
													'type'         => 'plain',
													'end_size'     => 2,
													'mid_size'     => 1,
													'prev_next'    => true,
													'prev_text' => '<i class="fa fa-angle-left"></i>',
													'next_text' => '<i class="fa fa-angle-right"></i>',
													'add_args'     => false,
													'add_fragment' => ''

												) );

												?>
												</li>
											</ul>
										</div>
									</div>                           

							<?php endif; else: ?>                            
							
								<h4><?php esc_html_e( 'No item available right now.','eidmart' ); ?></h4>
							
							<?php endif; ?>

						</div>
					</div>

				<?php } // End vendor sidebar show/hide
				
			} ?>

		</div>
	</div>

<?php } else { ?>

	<div class="page-banner">                 
		<div class="hvrbox">       
			<?php echo the_post_thumbnail( '', array( 'class' => 'hvrbox-layer_bottom' ) ); ?>
			<div class="hvrbox-layer_top">
				<div class="container">
					<div class="overlay-text text-center">
						<h1><?php esc_html_e( 'Become a Vendor', 'eidmart' ); ?></h1>
					</div>
				</div>
			</div>
		</div>                       
	</div>

	<div class="simple-page-content">
		<div class="container">
			<div class="row">

				<div class="col-md-6 offset-md-3">
					<?php echo do_shortcode( '[fes_registration_form]' ); ?>                
				</div>

			</div>
		</div>
	</div>

<?php } get_footer(); ?>