<?php 

/**
 * Template Name: Graphicland:: Single Vendor Graphicland Profile
 *
 * @package eidmart
 **/

get_header(); 

global $post;

if ( isset( $_GET['user'] ) ) {

	$user_name = $_GET['user'];

	$username = $user_name;
	$user = get_user_by( 'login', $username);

	// Collect author by author slug
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

	// Global data initialization
	$follow = isset( $_GET['follow'] ) ? $_GET['follow'] : '';

	// Author post count
	$user_posts = count_user_posts( $user->ID, 'post' );
	$singular_check = ( $user_posts <= 0 ) ? __( 'Article', 'eidmart' ) : __( 'Articles', 'eidmart' );

	// Vendor porduct count
	$user_items = count_user_posts( $user->ID, 'download' );
	$singular_check_items = ( $user_posts <= 0 ) ? __( 'Item', 'eidmart' ) : __( 'Items', 'eidmart' );

	?>

	<div class="author-profile-banner">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-7">
					<div class="author-profile-left">
						<div class="media">
							<?php echo get_avatar( $user->ID, '60', '' , '' , array( 'class' => array( '' ) ) ); ?>
							<div class="media-body">
								<span class="author">
									<?php
									echo esc_html( $user->display_name );
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

									<?php

									$facebook = get_the_author_meta( 'facebook', $user->ID );
									if ( $facebook && $facebook != '' ) {
									echo '<li><a href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i>&nbsp; </a></li>';
									}

									$twitter = get_the_author_meta( 'twitter', $user->ID );
									if ( $twitter && $twitter != '' ) {
									echo '<li><a href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i>&nbsp; </a></li>';
									}

									$linkedin = get_the_author_meta( 'linkedin', $user->ID );
									if ( $linkedin && $linkedin != '' ) {
									echo '<li><a href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i>&nbsp; </a></li>';
									}

									$dribbble = get_the_author_meta( 'dribbble', $user->ID );
									if ( $dribbble && $dribbble != '' ) {
									echo '<li><a href="' . esc_url($dribbble) . '"><i class="fa fa-dribbble"></i>&nbsp; </a></li>';
									}

									$github = get_the_author_meta( 'github', $user->ID );
									if ( $github && $github != '' ) {
									echo '<li><a href="' . esc_url($github) . '"><i class="fa fa-github"></i>&nbsp; </a></li>';
									}

									$behance = get_the_author_meta( 'behance', $user->ID );
									if ( $behance && $behance != '' ) {
									echo '<li><a href="' . esc_url($behance) . '"><i class="fa fa-behance"></i>&nbsp; </a></li>';
									}

									$instagram = get_the_author_meta( 'instagram', $user->ID );
									if ( $instagram && $instagram != '' ) {
									echo '<li><a href="' . esc_url($instagram) . '"><i class="fa fa-instagram"></i>&nbsp; </a></li>';
									}

									?>

								</ul>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">                  
					<div class="author-profile-right">
						<div class="row">
						
							<div class="col-md-6 offset-md-6">
								<div class="sales-info red">
									<h3><?php echo count_user_posts( $user->ID, 'download', 'false' ); ?></h3>
									<p><?php esc_html_e( 'Total Items', 'eidmart' ); ?></p>
								</div>
							</div>
						
						</div>
					</div>                      
				</div>
			</div>

			<?php if( get_user_meta( $user->ID, 'intro', true ) || get_user_meta( $user->ID, 'description', true ) ): ?>
			<div class="row">
				<div class="col-md-12">
					<div class="vendor-intro">
						<h1><?php esc_html_e( 'Introduction', 'eidmart' ); ?></h1> 
						<p>

						<?php 
						if( get_user_meta( $user->ID, 'intro', true ) ):
							echo wp_kses( get_user_meta( $user->ID, 'intro', true ), 'allowed_html' ); 
						else:
							echo wp_kses( get_user_meta( $user->ID, 'description', true ), 'allowed_html' );
						endif;
						?>
						
						</p>
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
							<?php if( $user_items > 0 ): ?>
								<a class="nav-item nav-link <?php if( !$follow ): echo "active"; endif; ?>" href="<?php echo esc_url( home_url('profile/')); ?>?user=<?php echo esc_attr($user_name); ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check_items, $user_items ); ?></span></a>
							<?php endif; ?>								
							<a class="nav-item nav-link" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check, $user_posts ); ?></span></a>
							<a class="nav-item nav-link <?php if( 'follower' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( home_url('profile/')); ?>?user=<?php echo esc_attr($user_name); ?>&follow=follower"><?php printf( __( 'Followers <span class="badge badge-secondary">%s</span>', 'eidmart' ), $follower_count ); ?></a>
							<a class="nav-item nav-link <?php if( 'following' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( home_url('profile/')); ?>?user=<?php echo esc_attr($user_name); ?>&follow=following"><?php printf( __( 'Following <span class="badge badge-secondary">%s</span>', 'eidmart' ), $following_count ); ?></a>
						</div>
					</div>
				</nav>
			</div>					
		</div>
	</div>

	<?php } ?>

	<div class="container graphicland-profile-product graphicland-one graphicland-style margin-bottom-large<?php if( get_theme_mod( 'user_follow' ) == 2 ): echo " margin-top-large"; endif; ?>">
		<div class="row">

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

			$paged = ( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;

			$args = array(
				'post_type' => 'download', 
				'author' => $user->ID,                               
				'posts_per_page' => 6,
				'paged' => $paged
			);

			$wp_query = new WP_Query( $args );

			if( $wp_query->have_posts() ) : ?>

			<?php 

			while( $wp_query -> have_posts() ) : $wp_query -> the_post(); 

			$id = get_the_ID();
			$meta = get_post_meta( get_the_ID() );
			$edd_price = isset( $meta['edd_price'][0] ) ? $meta['edd_price'][0] : '';
			$sales = edd_get_download_sales_stats( get_the_ID() );
			$sales = $sales > 1 ? esc_html__('Sales ', 'eidmart') . $sales : esc_html__('Sale ', 'eidmart') .$sales;

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

			<div class="<?php echo esc_attr( get_theme_mod( 'course_grid', 'col-md-3' ) ); ?>">
				<div class="single-product">                  
					<div class="graphicland-product-container">                               
						<div class="product-content">
							<a href="<?php the_permalink(); ?>" target="_blank">
								<div class="content-overlay"></div>

								<?php the_post_thumbnail( '', [ 'class' => 'graphicland-image' ] ); ?>
							
								<div class="overlay-center">
									<?php if( get_post_meta( $post->ID, 'preview_url',true ) ): ?>
									<div class="graphicland-live-preview">
										<?php if( get_post_meta( $post->ID, 'preview_url',true) ): ?><a  target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'preview_url',true) ); ?>"> <i class="las la-eye"></i> </a><?php endif; ?>
									</div>
									<?php endif; if ( get_theme_mod( 'eid_love' ) == 'on'): ?>
									<div class="graphicland-favourite-icon">
										<?php echo eidmart_get_likes_button( get_the_ID() ); ?>
									</div>
									<?php endif; ?>
								</div>                                
							</a>
						</div>
					</div>
				
					<?php if( !empty( get_post_meta( $post->ID, 'edd_feature_download' ) ) ): ?>
						<span class="sticker-feature"><i class="fa fa-gitlab"></i></span>
					<?php endif; 

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
					<?php endif; ?>

					<div class="product-details graphicland-product-details">
						<div class="product-content">

							<div class="product-details graphicland-product-details">                                       
								<h3 class="content-title" ><a href="<?php the_permalink(); ?>"><?php echo eidmart_excerpt_char_course_title( get_theme_mod( 'max_char', '30' ) ); ?></a> <?php if( get_theme_mod( 'eid_price_con' ) == 'on' ): ?><strong><?php if( $edd_price ): echo wp_kses_post( $item_price ); else: echo __( 'Free','eidmart' ); endif; ?></strong><?php endif; ?></h3>
							</div>
							
							<?php

							// Collect user ID
							$user_id = get_the_author_meta( 'ID' ); 
							// Collect user name
							$user_name = get_the_author_meta( 'user_login' , $user_id );

							echo "<p>"; 
								if( get_theme_mod( 'author' ) =='on' || get_theme_mod( 'category' ) =='on' ):                                            
									echo "<span>";
										if( get_theme_mod( 'author' ) =='on' ):
										echo get_avatar( $user_id, 20, '' , '' , array( 'class' => array( 'vendor-avatar' ) ) ); ?> <a href="<?php if( !class_exists( 'EDD_Front_End_Submissions' ) ){ echo esc_url( home_url( 'profile/' ) ); ?>?user=<?php echo esc_attr( $user_name ); } else { echo esc_url( eidmart_edd_fes_author_url() ); } ?>"> <?php the_author(); ?></a> 
										
										<?php 
										endif;
										if( get_theme_mod( 'category' ) =='on' ):
										esc_html_e( 'in', 'eidmart' ); ?>
										<?php
											$terms = get_the_terms( $id , 'download_category' );
											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
												//foreach ( $terms as $term ) {
													?>
										
													<a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?></a> 

													<?php                             
											// }
											}
										endif;
									echo "</span>";
								endif; // End author and category

								if (class_exists('EDD_Reviews') && get_theme_mod( 'eid_ratings' ) == 'on') {
									echo "<span class='bt-review'>";

										$mreview = new \EDD_Reviews;
										$rating = $mreview->average_rating(false);
										echo wp_kses_post( $mreview->render_star_rating( $rating ));
										echo '('. esc_html( $mreview->count_reviews()) .')';

									echo "</span>";
								} // End ratings check 
								if ( get_theme_mod( 'eid_sales' ) == 'on'): 
									echo "<span>".esc_html( $sales )."</span>";
								endif;
								?>
							</p>                                  

						</div>
					</div>
				</div>
			</div>                      

			<?php 
			
			endwhile; 			
			wp_reset_postdata(); 
			
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

				<?php
				endif;                           

			else: ?>                            
			
				<h4><?php esc_html_e( 'No item available right now.','eidmart' ); ?></h4>
			
			<?php endif; 
		} ?>

		</div>
	</div>

<?php } // End user check
get_footer(); ?>