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

<body <?php body_class(); ?>>
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