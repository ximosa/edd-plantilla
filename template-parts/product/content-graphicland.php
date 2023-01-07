<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

$meta = get_post_meta( $post->ID );
$eidmart_radio_value1 = ( isset( $meta['eidmart_radio_value1'][0] ) && '' !== $meta['eidmart_radio_value1'][0] ) ? $meta['eidmart_radio_value1'][0] : '';
$eidmart_radio_value4 = ( isset( $meta['eidmart_radio_value4'][0] ) && '' !== $meta['eidmart_radio_value4'][0] ) ? $meta['eidmart_radio_value4'][0] : '';

$image_urls = get_post_meta($post->ID,'product_gallery_img_url',true);
$gallery_array = explode(";", $image_urls);

?>

<div class="product-description-left graphicland-demo">
    
    <div class="product-header">
        <div class="row">        
            <div class="col-md-8">
                <div class="author-assets">
                    <div class="author-image">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '' , '' , array( 'class' => array( 'vendor-avatar' ) ) ); ?>
                    </div>
                    <div class="author-content">
                        <h1><?php the_title(); ?></h1>
                        <p><?php esc_html_e( 'by ', 'eidmart' ); 

                            // Collect user ID
                            $user_id = get_the_author_meta( 'ID' ); 
                            // Collect user name
                            $user_name = get_the_author_meta( 'user_login' , $user_id );

                            ?> 
                            <b>
                                <a href="<?php if( !class_exists( 'EDD_Front_End_Submissions' ) ){ echo esc_url( home_url( 'profile/' ) ); ?>?user=<?php echo esc_attr( $user_name ); } else { echo esc_url( eidmart_edd_fes_author_url() ); } ?>"> <?php the_author(); ?></a> 
                            </b>
                            <?php esc_html_e( 'in ', 'eidmart' ); ?> 
                            <b>
                                <?php
                                $terms = get_the_terms( $id , 'download_category' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    //foreach ( $terms as $term ) {
                                        ?>
                                        <a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?></a> 
                                        <?php                             
                                    //}
                                }
                                ?>
                            </b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="favourite-icon">
                    <?php echo eidmart_get_likes_button( get_the_ID() ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="product-image">
        <?php

            if( $image_urls ){

            $array_limit = count( $gallery_array );

            for ( $i = 0; $i < $array_limit; $i++ ) { ?>
                 
            <div class="single-product-image">
                <img src="<?php echo esc_url( $gallery_array[$i] ); ?>" alt="<?php esc_attr_e( 'Slide image', 'eidmart' ); ?>">
            </div>

            <?php }

            } else { ?>

            <div class="product-image">
              <?php the_post_thumbnail(); ?>
            </div> 

        <?php } ?>
    </div>    

    <div class="image-bottom-share">
        
        <?php 
        if( count( $gallery_array ) > 1 ){ 

            if( get_theme_mod( 'social_share' ) == 1 ): ?>
            <div class="social-link">                                
                <ul>
                    <li><?php esc_html_e( 'Share:', 'eidmart' ); ?> </li>
                    <?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
                </ul>                  
            </div>
            <?php endif; 

        } else {
        
            if( get_theme_mod( 'social_share' ) == 1 ): ?>
            <div class="social-link text-center">                                
                <ul>
                    <li><?php esc_html_e( 'Share:', 'eidmart' ); ?> </li>
                    <?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
                </ul>                  
            </div>
            <?php endif; 

        }
        ?>    

    </div>

    <div class="product-description-tab">        
        <div class="row">
            <div class="col-md-8">  
                <div class="tab-content">

                    <?php the_content(); ?>

                    <br><hr>
                  
                    <div class="blog-single-1x">
                        <div class="blog-single-left-content">
                        <?php

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                          comments_template( '/graphicland-comments.php' );
                        endif;

                        ?>
                        </div>
                    </div>
                  
                </div>
            </div>
            <?php            
            // General product sidebar
            get_template_part( 'template-parts/product/general','sidebar' );             
            ?>
        </div>
    </div>    
</div> 