<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

get_header(); 

// Collect author by author slug
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

// Collect author id by author
$authorid = get_user_by( 'id', get_query_var( 'author' ) );

// Collect user name
$user_name = get_the_author_meta('user_login', get_the_author_meta('ID') );

// Global data initialization
$follow = isset( $_GET['follow'] ) ? $_GET['follow'] : '';

// Author post count
$user_posts = count_user_posts( $authorid->ID, 'post' );
$singular_check = ( $user_posts <= 0 ) ? __( 'Article', 'eidmart' ) : __( 'Articles', 'eidmart' );

// Vendor porduct count
$user_items = count_user_posts( $authorid->ID, 'download' );
$singular_check_items = ( $user_posts <= 0 ) ? __( 'Portfolio', 'eidmart' ) : __( 'Portfolio', 'eidmart' );

// Vendor information
if( class_exists( 'EDD_Front_End_Submissions' ) ):
	$db_user = new FES_DB_Vendors();
	$vendor = $db_user->get_vendor_by( 'user_id', $authorid->ID );
endif;

?>

<div class="author-profile-banner">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-9">
				<div class="author-profile-left">
					<div class="media">
						<?php echo get_avatar( get_the_author_meta( 'user_email' )); ?>
						<div class="media-body">
							<span class="author">
								<?php
								the_author(); 
								// if eidmart plugin active
								if( get_theme_mod( 'user_follow', 0 ) == 1 && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
									if ( is_user_logged_in() ) {
										echo followsoft_get_follow_unfollow_links( get_the_author_meta( 'ID', $authorid->ID ) );
									} else { ?>					
										<a href="#" class="followsoft-follow-link"><?php esc_html_e( "Follow", "eidmart" ); ?></a>
									<?php 
									} 
								} ?>
							</span>
							<p>
								<b><?php esc_html_e( 'Joined: ', 'eidmart' ); ?></b>
								<?php
								$udata = get_userdata( get_the_author_meta( 'ID' ) );
								$registered = $udata->user_registered;
								printf( '%s', date( "F j, Y", strtotime( $registered ) ) );							
								?>
							</p>
							<ul class="vendor-social">

								<?php

								$facebook = get_the_author_meta( 'facebook' );
								if ( $facebook && $facebook != '' ) {
									echo '<li><a href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i>&nbsp; </a></li>';
								}

								$twitter = get_the_author_meta( 'twitter' );
								if ( $twitter && $twitter != '' ) {
									echo '<li><a href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i>&nbsp; </a></li>';
								}

								$linkedin = get_the_author_meta( 'linkedin' );
								if ( $linkedin && $linkedin != '' ) {
									echo '<li><a href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i>&nbsp; </a></li>';
								}

								$dribbble = get_the_author_meta( 'dribbble' );
								if ( $dribbble && $dribbble != '' ) {
									echo '<li><a href="' . esc_url($dribbble) . '"><i class="fa fa-dribbble"></i>&nbsp; </a></li>';
								}

								$github = get_the_author_meta( 'github' );
								if ( $github && $github != '' ) {
									echo '<li><a href="' . esc_url($github) . '"><i class="fa fa-github"></i>&nbsp; </a></li>';
								}

								$behance = get_the_author_meta( 'behance' );
								if ( $behance && $behance != '' ) {
									echo '<li><a href="' . esc_url($behance) . '"><i class="fa fa-behance"></i>&nbsp; </a></li>';
								}

								$instagram = get_the_author_meta( 'instagram' );
								if ( $instagram && $instagram != '' ) {
									echo '<li><a href="' . esc_url($instagram) . '"><i class="fa fa-instagram"></i>&nbsp; </a></li>';
								}

								?>
							</ul>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">                  
				<div class="author-profile-right">
					<div class="row">                      

						<div class="col-md-12">
							<div class="sales-info red">
								<h3><?php echo count_user_posts( get_the_author_meta( 'ID' ) ); ?></h3>
								<p><?php esc_html_e( 'Total Articles', 'eidmart' ); ?></p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php 
		if( function_exists( 'EDD' ) ) {
			if( get_user_meta( $author->ID, 'intro', true ) || get_user_meta( $author->ID, 'description', true ) ): ?>
			<div class="row">
				<div class="col-md-12">
					<div class="vendor-intro">
						<h1><?php esc_html_e( 'Introduction', 'eidmart' ); ?></h1> 
						<p>

						<?php 
						if( get_user_meta( $author->ID, 'intro', true ) ):
							echo wp_kses( get_user_meta( $author->ID, 'intro', true ), 'allowed_html' ); 
						else:
							echo wp_kses( get_user_meta( $author->ID, 'description', true ), 'allowed_html' );
						endif;
						?>
							
						</p>
					</div>
				</div>
			</div>
			<?php endif; 
		} ?>

	</div>
</div> 

<?php // if eidmart plugin active
if( get_theme_mod( 'user_follow', 0 ) == 1  && in_array( 'eidmart-plugin/eidmart-plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-expand-lg navbar-light eidmart-dashboard-menu">
				<?php
					$follower_count = followsoft_get_follower_count( get_the_author_meta( 'ID', $authorid->ID ) );
					$following_count = followsoft_get_following_count( get_the_author_meta( 'ID', $authorid->ID ) ) - 1;
				?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#eidmart_dashboard_menu" aria-controls="eidmart_dashboard_menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="eidmart_dashboard_menu">
					<div class="navbar-nav">

						<?php 
						if( class_exists( 'EDD_Front_End_Submissions' )){
							if( 'approved' == isset( $vendor->status ) && is_user_logged_in() && $authorid->ID == get_current_user_id() ): ?>
								<a class="nav-item nav-link <?php if( !$follow && !get_page_link() ): echo "active"; endif; ?>" href="<?php echo esc_url( home_url( '/vendor-dashboard/' ) ); ?>"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Dashboard', 'eidmart' ); ?></span></a>						
							<?php endif; 
						} // Check user item
						if( $user_items > 0 ): ?>
							<a class="nav-item nav-link <?php if( !$follow && !get_page_link() ): echo "active"; endif; ?>" href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url( EDD_FES()->vendors->get_vendor_store_url( $authorid->ID ) );} ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check_items, $user_items ); ?></span></a>
						<?php endif; ?>

						<a class="nav-item nav-link <?php if( !$follow ): echo "active"; endif; ?>" href="<?php echo esc_url( get_author_posts_url( $author->ID ) ); ?>"><?php printf( '%s <span class="badge badge-secondary">%s</span>', $singular_check, $user_posts ); ?></span></a>
						

						<a class="nav-item nav-link <?php if( 'follower' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( get_author_posts_url( $author->ID ) ); ?>?follow=follower"><?php printf( __( 'Followers <span class="badge badge-secondary">%s</span>', 'eidmart' ), $follower_count ); ?></a>
						<a class="nav-item nav-link <?php if( 'following' == $follow ): echo "active"; endif; ?>" href="<?php echo esc_url( get_author_posts_url( $author->ID ) ); ?>?follow=following"><?php printf( __( 'Following <span class="badge badge-secondary">%s</span>', 'eidmart' ), $following_count ); ?></a>
					</div>
				</div>
			</nav>
		</div>					
	</div>
</div>

<?php } ?>

<div class="container blog-1x author-post">     

	<div class="col-md-12">
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
				<div class="row">  

					<?php 
			
					if( have_posts() ):
						while (have_posts() ) : 
							the_post(); ?>

							<div class="col-lg-4">
								<div class="single-blog hover01">
									<figure>
										<a href="<?php the_permalink();?>">
											<?php the_post_thumbnail();?>
										</a>
									</figure>
									<div class="blog-content">

										<span><i class="fa fa-bookmark-o"></i>
											<?php $categories = get_the_category();
											if (!empty($categories)) {
												echo esc_html($categories[0]->name);
											} ?>
										</span>

										<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo eidmart_excerpt_char_course_title( 45 ); ?></a>

										<div class="pub-meta">
											<span class="pub-author">
												<i class="fa fa-clock-o"></i><?php the_time('d M, Y');?>
											</span>
										</div>

									</div>
								</div>
							</div>

						<?php 
						
						endwhile; // End while loop
						wp_reset_postdata(); // Reset loop

						if( paginate_links() ): ?>          

						<div class="col-md-12">
							<div class="course-pagination">
								<ul class="pagination">
									<li>
										<?php									
											$big = 999999999; // need an unlikely integer
											echo paginate_links(array(
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
						</div>

						<?php
						endif; // End pagination check

					else: // End post existence check
				
					?>                
					<div class="col-md-12">
						<h3><?php echo esc_html__( 'No post available.','eidmart' ); ?></h3>
					</div>

					<?php endif; ?>

				</div>
			</div>
			<?php } ?>

		</div>
	</div>
	
</div>

<?php 
get_footer();
