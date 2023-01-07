<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eidmart
 */
if( get_theme_mod('copy_text') ):
?>

    <div id="aplayer"></div>

    <?php if( get_theme_mod( 'online_payment' ) || get_theme_mod( 'payment_title' ) || get_theme_mod( 'money_back_title' )  || get_theme_mod( 'money_back' ) || get_theme_mod( 'support_title' ) || get_theme_mod( 'support' ) ): ?>
    <div class="feature-1x">
        <div class="<?php if( get_theme_mod( 'cta_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
            <div class="row">

                <?php if( get_theme_mod( 'online_payment' ) || get_theme_mod( 'payment_title' ) ): ?>
                <div class="col-md-4">
                    <div class="single-feature">
                        <div class="color-green">
                            <?php if( get_theme_mod( 'online_payment' ) ): ?><img src="<?php echo esc_url( get_theme_mod( 'online_payment' ) ); ?>" alt="<?php esc_attr_e( 'Secure online payment','eidmart' ); ?>"><?php endif; ?>
                            <div class="color-green">
                                <h5><?php echo esc_html( get_theme_mod( 'payment_title' ) ); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; if( get_theme_mod( 'money_back_title' ) || get_theme_mod( 'money_back' ) ): ?>
                <div class="col-md-4">
                    <div class="single-feature">
                        <div class="color-yellow">
                            <?php if( get_theme_mod( 'money_back' ) ): ?><img src="<?php echo esc_url( get_theme_mod( 'money_back' ) ); ?>" alt="<?php esc_attr_e( 'Secure online payment','eidmart' ); ?>"><?php endif; ?>
                            <div class="color-yellow">
                                <h5><?php echo esc_html( get_theme_mod( 'money_back_title' ) ); ?></h5>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php endif; if( get_theme_mod( 'support_title' ) || get_theme_mod( 'support' ) ): ?>               
                <div class="col-md-4">
                    <div class="single-feature">
                        <div class="color-red">
                            <?php if( get_theme_mod( 'support' ) ): ?><img src="<?php echo esc_url( get_theme_mod( 'support' ) ); ?>" alt="<?php esc_attr_e( 'Free and friendly support','eidmart' ); ?>"><?php endif; ?>
                            <div class="color-red">
                                <h5><?php echo esc_html( get_theme_mod( 'support_title' ) ); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if( is_active_sidebar( 'footer-about' ) || is_active_sidebar( 'footer-link' ) || is_active_sidebar( 'footer-subscribe' ) || get_theme_mod('copy_text') ): ?>
    <footer class="footer-section-1x light <?php /* Check photography archive */ if( get_theme_mod( 'footer_type' ) == '3' ) { echo "photography"; } /* Check footer animation */ if( get_theme_mod( 'footer_type' ) == '2' ){ echo " footer-animation"; } else {} ?>">
        <div class="<?php if( get_theme_mod( 'footer_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
            <div class="row">
                <?php if( is_active_sidebar( 'footer-about' ) || is_active_sidebar( 'footer-link' ) || is_active_sidebar( 'footer-subscribe' ) ): ?>
                <div class="col-md-12">
                    <div class="footer-top">
                        <div class="row">
                            <div class="col-md-4">
                                
                                <?php

                                if( is_active_sidebar( 'footer-about' ) ):
                                    dynamic_sidebar('footer-about');
                                endif;

                                ?>

                            </div>

                            <div class="col-md-8">
                                <div class="footer-top-left">
                                    <div class="row">
                                        <?php

                                        if( is_active_sidebar( 'footer-link' ) ):
                                            dynamic_sidebar('footer-link');
                                        endif;


                                        // Check subscribe form
                                        if( is_active_sidebar( 'footer-subscribe' ) ):
                                        ?>
                                        <div class="col-md-8 offset-md-4">
                                            <div class="footer-subscriber">

                                                <?php dynamic_sidebar( 'footer-subscribe' ); ?>
                                                
                                            </div>
                                        </div>  
                                        <?php endif; ?>

                                    </div>
                                </div>  
                            </div>

                        </div>
                    </div>  
                </div>
                <?php endif; ?>

                <div class="col-md-12">
                    <div class="footer-bottom">
                        <div class="row">
                            <div class="col-md-5">
                                <p><?php echo wp_kses( get_theme_mod('copy_text'), 'allowed_html' ); ?></p>
                            </div>
                            <div class="col-md-7">
                                <ul>
                                    <?php

                                    if( is_active_sidebar( 'footer-bottom-link' ) ):
                                        dynamic_sidebar( 'footer-bottom-link' );
                                    endif;

                                    ?>
                                </ul>
                            </div>
                        </div>  
                        
                    </div>  
                </div>
            </div>
        </div>
    </footer>
	<?php endif; /* end footer about */ endif; /* end copyright */ wp_footer(); ?>

  </body>
</html>       
