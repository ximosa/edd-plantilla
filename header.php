<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eidmart
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); if( is_singular( 'download' ) && get_theme_mod( 'mouse_key' ) == 1 ): echo "oncontextmenu='return false;'"; endif; ?>>
	<?php wp_body_open(); ?>

    <!-- Send data to the js file -->
    <div class="slick-rtl-selector" data-slick_rtl ="<?php if( get_theme_mod( 'lang_direction' ) == 1 ): echo "true"; else: echo "false"; endif; ?>"></div>
    <!-- Send directory url to the js file -->
    <div class="theme-directory" data-directory="<?php echo esc_attr(get_template_directory_uri()); ?>" data-loader="<?php echo esc_attr( get_theme_mod( 'loader_style' ) ); ?>" data-loader-bg="<?php echo esc_attr( get_theme_mod( 'bg_color' ) ); ?>"></div>
  
    <!-- Preloader -->
    <?php if( get_theme_mod( 'loader_show' ) == 1 ): ?>
    	<div id="fakeloader"></div>
    <?php endif; ?>

    <?php if( get_theme_mod( 'alert_show' ) == 1 ): ?>
	<div class="alert alert-success alert-dismissible fade show message-box eidmart-alert" role="alert">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <p><?php echo wp_kses_post( get_theme_mod( 'alert_text' ) ); ?></p>
                    <?php if( get_theme_mod( 'offer_schedule' ) ): ?>
                        <span id="eidcountdown" offerDate="<?php echo esc_attr( get_theme_mod( 'offer_schedule' )); ?>"></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
		<?php if( get_theme_mod( 'bootstrap_script' ) == 4 ) { ?>        
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="las la-times"></i>
			</button>
		<?php } else { ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<?php } ?>
    </div>
    <?php endif; ?>

    <div class="main-menu-1x <?php if( get_theme_mod( 'menu_bg' ) == '2' ){ echo " minimal"; } else { echo " main-menu-color"; } /* Start sticky menu */ if( get_theme_mod( 'sticky_menu' ) == 1 ){ echo esc_attr(" sticky-menu"); } /* Check photography archive */ if( get_theme_mod( 'archive_type' ) == '2' ) { echo " photography"; } ?>">  
        <div class="<?php if( get_theme_mod( 'market_type' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
            <div class="row">
                <div class="col-md-12">     
                    <div class="main-menu">     
                        <nav class="navbar navbar-expand-lg navbar-light bg-light btco-hover-menu">                           
                          
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'logo_upload',''.get_template_directory_uri().'/images/logo.png' ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
							</a>
							<a class="navbar-brand white-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'sticky_logo_upload',''.get_template_directory_uri().'/images/logo.png' ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
							</a>

							<!-- Single product logos -->
							<?php 
							global $post;
							if( get_post_meta( isset($post->ID), 'product_logo_img_url', true ) && !is_archive() ): ?>
							<a class="navbar-brand single-product-logo" href="#">
								<img src="<?php echo esc_url( get_post_meta( $post->ID, 'product_logo_img_url',true ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
							</a>
							<a class="navbar-brand single-product-logo white-logo" href="#">
								<img src="<?php echo esc_url( get_post_meta( $post->ID, 'product_logo_img_url',true ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
							</a>
							<?php endif; ?>

							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>

                          	<div class="collapse navbar-collapse" id="navbarSupportedContent">
                          
								<?php /* Primary navigation */

								wp_nav_menu( 
									array(
										'theme_location' => 'primary',
										'depth' => 4,
										'container' => false,
										'menu_class' => 'navbar-nav mx-auto main-menu-nav',
										'fallback_cb'  => 'eidmart_primary_menu_fallback',
										//Process nav menu using our custom nav walker
										'walker' => new WP_Bootstrap_Navwalker(),                       
									)
								);

								?>

								<div class="sign-in">

									<?php if( class_exists( 'Easy_Digital_Downloads' ) ){

									if ( function_exists( 'eidmart_web_product_search' ) ){                                
									?>
									<div class="menu-search">
										<i class="las la-search"></i>
										<div class="search-dropdown-menu">
											<span class="triangle-arrow"></span>
											<ul>
												<li>
													<?php echo eidmart_web_product_search(); ?>													
												</li>
											</ul>
										</div>
									</div>
									<?php } } ?>
									

									<?php if( class_exists( 'Easy_Digital_Downloads' ) ): ?>
									<div class="border-left">                          
										<?php eidmart_print_cart(); ?>                                    
									</div>
									<?php endif; 

									if( is_user_logged_in() ){ ?>

									<div class="dropdown show">
										<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo get_avatar( get_current_user_id(), '60', '' , '' , array( 'class' => array( 'loggedin-user-image' ) ) ); ?>
										</a>

										<div class="dropdown-menu dashboard-dropdown-style">
											<span class="triangle-arrow"></span>
											<div class="profile-settings">
												<span class="dropdown-item"><?php esc_html_e( 'Hi, ', 'eidmart' ); echo wp_get_current_user()->display_name .'!'; ?></span>
												<?php

												if( is_active_sidebar( 'user-profile-link' ) ):
													dynamic_sidebar( 'user-profile-link' );
												endif;

												?>
												<a href="<?php echo wp_logout_url( home_url() ); ?>" class="dropdown-item"><?php esc_html_e( 'Logout', 'eidmart' ); ?></a>
											</div>
										</div>										
									</div>

									<?php } else { ?>

										<?php if( get_theme_mod( 'singup_text') ): ?><a href="<?php echo esc_url( get_theme_mod( 'singup_url', '#' ) ); ?>"><?php echo esc_html( get_theme_mod( 'singup_text', __( 'Sign Up', 'eidmart' ) ) ); ?></a><?php endif; ?>
										<?php if( get_theme_mod( 'singin_text') ): ?><a class="btn-hover <?php echo esc_attr( get_theme_mod( 'button_style1' ) ); ?>" href="<?php echo esc_url( get_theme_mod( 'singin_url', '#' ) ); ?>"><i class="las la-user"></i> <?php echo esc_html( get_theme_mod( 'singin_text', __( 'Sign In', 'eidmart' ) ) ); ?></a><?php endif; ?>
									
									<?php } ?>

								</div>
                          	</div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
