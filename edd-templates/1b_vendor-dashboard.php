<?php
/*
* Template Name: General:: Vendor Dashboard
*
* @package Vendd
*/
get_header(); 

global $current_user;

$products = EDD_FES()->vendors->get_all_products( get_current_user_id() );

// Collect author by author slug
//$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

// Global data initialization
$follow = isset( $_GET['follow'] ) ? $_GET['follow'] : '';

// Author post count
$user_posts = count_user_posts( get_current_user_id(), 'post' );
$singular_check = ( $user_posts <= 0 ) ? __( 'Article', 'eidmart' ) : __( 'Articles', 'eidmart' );

// Vendor porduct count
$user_items = count_user_posts( get_current_user_id(), 'download' );
$singular_check_items = ( $user_posts <= 0 ) ? __( 'Public Store', 'eidmart' ) : __( 'Public Store', 'eidmart' );

// Vendor information
if( class_exists( 'EDD_Front_End_Submissions' ) ):
	$db_user = new FES_DB_Vendors();
	$vendor = $db_user->get_vendor_by( 'user_id', get_current_user_id() );
endif;

// check if vendor
if ( $db_user->exists( 'user_id', get_current_user_id() ) ) {

	if( is_user_logged_in() ): ?>

	<div class="author-profile-banner">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-md-6">
					<div class="author-profile-left">
						<div class="media">
							<?php echo get_avatar( get_current_user_id(), '60', '' , '' , array( 'class' => array( '' ) ) ); ?>
							<div class="media-body">
								<span class="author">
									<?php 

									if( get_user_meta( get_current_user_id(), 'name_of_store', true ) ):                                  
									echo get_user_meta( get_current_user_id(), 'name_of_store', true ); 
									else :
									echo esc_html( $current_user->display_name ); 
									endif;

									?>
									</span>
								<p>
									<b><?php esc_html_e( 'Joined: ', 'eidmart' ); ?></b>
									<?php
									$udata = get_userdata( get_current_user_id() );
									$registered = $udata->user_registered;
									printf( '%s', date( "F j, Y", strtotime( $registered ) ) );
								
									?>
								</p>
								<ul class="vendor-social">
									<?php if( get_user_meta( get_current_user_id(), 'facebook', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'facebook', true )); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( get_current_user_id(), 'twitter', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'twitter', true )); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( get_current_user_id(), 'linkedin', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'linkedin', true )); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( get_current_user_id(), 'dribbble', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'dribbble', true )); ?>"><i class="fa fa-dribbble"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( get_current_user_id(), 'github', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'github', true )); ?>"><i class="fa fa-github"></i></a></li><?php endif; ?>
									<?php if( get_user_meta( get_current_user_id(), 'behance', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( get_current_user_id(), 'behance', true )); ?>"><i class="fa fa-behance"></i></a></li><?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">                  
					<div class="author-profile-right">
						<div class="row">                      

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

							<div class="col-md-4">
								<div class="sales-info red">
									<h3><?php echo esc_html( count_user_posts( get_current_user_id(), 'download' ) ); ?></h3>
									<p><?php esc_html_e( 'Total Items', 'eidmart' ); ?></p>
								</div>
							</div>						
						
						</div>                      
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php // if eidmart plugin active
	if( get_theme_mod( 'user_follow', 0 ) == 1  && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light eidmart-dashboard-menu">
					<?php
						$follower_count = followsoft_get_follower_count( get_the_author_meta( 'ID', get_current_user_id() ) );
						$following_count = followsoft_get_following_count( get_the_author_meta( 'ID', get_current_user_id() ) ) - 1;
					?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#eidmart_dashboard_menu" aria-controls="eidmart_dashboard_menu" aria-expanded="false" aria-label="Toggle navigation">
						<i class="las la-bars"></i>
					</button>
					<div class="collapse navbar-collapse" id="eidmart_dashboard_menu">
						<div class="navbar-nav">
							<?php if( class_exists( 'EDD_Front_End_Submissions' ) && 'approved' == isset( $vendor->status ) && is_user_logged_in() ): ?>
								<a class="nav-item nav-link <?php if( !$follow && get_page_link() ): echo "active"; endif; ?>" href="<?php echo esc_url ( get_page_link() ); ?>"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Dashboard', 'eidmart' ); ?></span></a>						
							<?php endif; 
							// Check user item
							if( $user_items > 0 ): ?>
								<a class="nav-item nav-link" href="<?php echo esc_url( home_url( '/vendor/'. $current_user->user_login ) ); ?>"><span class="dashicons dashicons-store"></span> <?php printf( '%s', $singular_check_items ); ?></span></a>
							<?php endif; ?>
								
							<a class="nav-item nav-link" href="<?php echo esc_url( get_author_posts_url( get_current_user_id() ) ); ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check, $user_posts ); ?></span></a>
								
							<?php if( class_exists( 'EDD_Front_End_Submissions' ) ): ?>
								<a class="nav-item nav-link <?php if( 'follower' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( add_query_arg( 'follow', 'follower' ) ); ?>"><?php printf( __( 'Followers <span class="badge badge-secondary">%s</span>', 'eidmart' ), $follower_count ); ?></a>
								<a class="nav-item nav-link <?php if( 'following' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( add_query_arg( 'follow', 'following' ) ); ?>"><?php printf( __( 'Following <span class="badge badge-secondary">%s</span>', 'eidmart' ), $following_count ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</nav>
			</div>					
		</div>
	</div>

	<?php } ?>

	<?php else: ?>

	<div class="margin-bottom-middle"></div>

	<?php endif; ?>

	<div class="vendor-dashboard-main">
		<div class="container">
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

			} else { ?>
				
				<div class="col-md-12">
					<?php while ( have_posts() ) : the_post(); ?>
			
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
						</article>

					<?php endwhile; // end of the loop. ?>
				</div>
				
			<?php } ?>

			</div>
		</div>
	</div>

<?php } else { ?>

<div class="page-banner">                 
	<div class="hvrbox">       
		<?php echo the_post_thumbnail( '', array( 'class' => 'hvrbox-layer_bottom' ) ); ?>
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