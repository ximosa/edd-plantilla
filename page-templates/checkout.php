<?php
/**
 * Template Name: Checkout Template
 *
 * @package eidmart
**/

get_header( 'one' ); ?>

<div class="checkout-menu">  
    <div class="container">
        <div class="row align-items-center">
            
        <?php if( get_theme_mod( 'checkout_banner' ) ): ?>
            <div class="col-md-6">
                <?php if( get_theme_mod( 'checkout_logo' ) ): ?>
                <a class="brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_theme_mod( 'checkout_logo',''.get_template_directory_uri().'/images/logo-dark.png' ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
                </a>
                <?php endif; if( get_theme_mod( 'secured_text' )): ?>
                <div class="encrypt-message">
                    <span class="secured-message"><i class="fa fa-lock"></i> <?php echo esc_html( get_theme_mod( 'secured_text' ) ); ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if( get_theme_mod( 'checkout_banner' ) ): ?><img src="<?php echo esc_url( get_theme_mod( 'checkout_banner',''.get_template_directory_uri().'/images/checkout-banner.png' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'gurantee_title' ) ); ?>"><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <?php if( get_theme_mod( 'checkout_logo' ) ): ?>
                <a class="brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_theme_mod( 'checkout_logo',''.get_template_directory_uri().'/images/logo-dark.png' ) ); ?>" class="d-inline-block align-top" alt="<?php bloginfo('name') ?>">                     
                </a>
                <?php endif; if( get_theme_mod( 'secured_text' )): ?>
                <div class="encrypt-message">
                    <span class="secured-message"><i class="fa fa-lock"></i> <?php echo esc_html( get_theme_mod( 'secured_text' ) ); ?></span>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        </div>
    </div>
</div>

<div class="simple-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">

                <?php

                if ( have_posts() ) :
                                    
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        the_content();

                    endwhile;

                endif;

                ?>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
