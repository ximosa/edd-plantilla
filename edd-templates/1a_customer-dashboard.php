<?php
/*
* Template Name: Customer:: Customer Dashboard
*
* @package Vendd
*/
get_header(); 

if( is_user_logged_in() ){

$user = get_user_by( 'ID', get_current_user_id() );

?>

<div class="author-profile-banner margin-bottom-large">
	<div class="container">
		<div class="row align-items-center">

			<div class="col-md-7">
				<div class="author-profile-left">
					<div class="media">
						<?php echo get_avatar( $user->ID, '60', '' , '' , array( 'class' => array( '' ) ) ); ?>
						<div class="media-body">
							<span class="author"><?php echo esc_html( $user->display_name ); ?></span>
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
	</div>
</div> 

<div class="container margin-bottom-large customer-dashboard">
	<div class="row">
		<div class="col-md-12"> 

			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><?php esc_html_e( 'Profile', 'eidmart' ); ?></a>
					<a class="nav-item nav-link" id="nav-Purchase-tab" data-toggle="tab" href="#nav-Purchase" role="tab" aria-controls="nav-Purchase" aria-selected="false"><?php esc_html_e( 'Purchase', 'eidmart' ); ?></a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-profile" role="tabpanel"><?php echo do_shortcode( '[edd_profile_editor]' ); ?></div>
				<br >
				<div class="tab-pane fade" id="nav-Purchase" role="tabpanel"><?php echo do_shortcode( '[purchase_history]' ); ?></div>
			</div>

		</div>
	</div>
</div>


<?php } else { ?>

<div class="container margin-bottom-large margin-top-large">
	<p class="edd-alert edd-alert-error"><?php esc_html_e( 'Sorry, trouble retrieving dashboard. Please login!', 'eidmart' ); ?></p>
</div>

<?php } get_footer(); ?>