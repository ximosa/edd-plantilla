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

global $post;
$post_id = isset( $post->ID ) ? $post->ID : '';

$meta = get_post_meta( $post_id );
$ex_dwonload_url = ( isset( $meta['ex_dwonload_url'][0] ) && '' !== $meta['ex_dwonload_url'][0] ) ? $meta['ex_dwonload_url'][0] : '';

?>
<div id="aplayer"></div>
    <?php if( get_theme_mod( 'cta_title' ) || get_theme_mod( 'desc' ) || get_theme_mod( 'btn_text1' ) ): ?>
	<div class="cta-1x eidmart-page-cta" data-ctabg="<?php echo esc_attr( get_theme_mod( 'cta_bg', ''.get_template_directory_uri(). '/images/counter-bg.jpg')); ?>" data-gradone="<?php echo esc_attr( get_theme_mod( 'grad_one', '0, 0, 0, 0.8' ) ); ?>" data-gradtwo="<?php echo esc_attr( get_theme_mod( 'grad_two', '0, 0, 0, 0.8' ) ); ?>">
        <div class="<?php if( get_theme_mod( 'cta_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
            <div class="row align-items-center">

                <?php if( get_theme_mod( 'btn_text1' ) ): ?>
                <div class="col-md-8">
                    <div class="cta-left">
                        <?php if( get_theme_mod( 'cta_title' ) ): ?><h3><?php echo wp_kses( get_theme_mod( 'cta_title' ), 'allowed_html' ); ?></h3><?php endif; ?>
                        <?php if( get_theme_mod( 'desc' ) ): ?><p><?php echo wp_kses( get_theme_mod( 'desc' ), 'allowed_html' ); ?></p><?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="cta-right">
                        <?php if( get_theme_mod( 'btn_text1' ) ): ?><a href="<?php echo esc_url( get_theme_mod( 'btn_url1' ) ); ?>" class="btn-hover <?php echo esc_attr( get_theme_mod( 'button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'btn_text1' ) ); ?> <i class="fa fa-long-arrow-right"></i></a><?php endif; ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                    <div class="cta-left">
                        <?php if( get_theme_mod( 'cta_title' ) ): ?><h3><?php echo esc_html( get_theme_mod( 'cta_title' ) ); ?></h3><?php endif; ?>
                        <?php if( get_theme_mod( 'desc' ) ): ?><p><?php echo wp_kses( get_theme_mod( 'desc' ), 'allowed_html' ); ?></p><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if( get_theme_mod( 'online_payment' ) || get_theme_mod( 'payment_title' ) || get_theme_mod( 'money_back_title' )  || get_theme_mod( 'money_back' ) || get_theme_mod( 'support_title' ) || get_theme_mod( 'support' ) ): ?>
    <div class="feature-1x <?php /* Check photography archive */ if( get_theme_mod( 'footer_type' ) == '3' ) { echo "photography"; } ?>">
        <div class="<?php if( get_theme_mod( 'commitment_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
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

                <?php 
                $meta = get_post_meta( $post_id );
                $eidmart_radio_value5 = ( isset( $meta['eidmart_radio_value5'][0] ) && '' !== $meta['eidmart_radio_value5'][0] ) ? $meta['eidmart_radio_value5'][0] : 'value_11';
                
                if( get_theme_mod( 'sticky_price' ) == '1' && get_theme_mod( 'price_box' ) == 1 && $eidmart_radio_value5 == 'value_11' && is_singular( 'download' ) ) { ?>
                <div class="col-md-12">
                    <div class="sticky-price">
                        <div class="sticky-display" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Show/Hide Price', 'eidmart' ); ?>">
                            <i class="las la-angle-down"></i>
                        </div>
                        <div class="price-box theme">

                            <?php

                            // Collect Price data
                            $purchase_btn_text = get_post_meta( $post->ID, 'purchase_btn_text', true );

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
                </div>
                <?php } ?>

            </div>
        </div>
    </footer>
	<?php endif; /* end footer about */ endif; /* end copyright */ wp_footer(); ?>

  </body>
</html>       
