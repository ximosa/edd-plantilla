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

<div class="product-description-left graphicland-demo video-demo">
    
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

    <div class="single-page-player ">

        <?php
        
        $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
        $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

        $sales = edd_get_download_sales_stats(get_the_ID());
        $sales = $sales > 1 ? $sales . __(' sales', 'eidmart') : $sales . __(' sale', 'eidmart');

        $internal_url = isset($meta['mp4_url'][0]) ? $meta['mp4_url'][0] : '';
        $external_url = isset($meta['external_url'][0]) ? $meta['external_url'][0] : '';

        $video_url = !empty( $external_url ) ? $external_url : $internal_url;
        $video_type = isset($meta['video_type'][0]) ? $meta['video_type'][0] : 1; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="single-page-player">
                    <?php                     
                    // Check video type
                    if( $video_type == 1 ){ ?>
                        <video controls muted class="hvrbox-layer_bottom">
                            <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                            <?php esc_html_e( 'Your browser does not support HTML5 video.', 'eidmart' ); ?>
                        </video>
                    <?php } else { ?>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_url ); ?>?rel=0&controls=1" allowfullscreen frameborder="0""></iframe>
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

                <?php if ( !empty( get_the_content() ) ): ?>
                <div class="product-description-tab">       
                    <div class="tab-content">
                        <?php the_content(); ?>                        
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <?php            
            // General product sidebar
            get_template_part( 'template-parts/product/general','sidebar' );             
            ?>
        </div>        
    </div>        
</div> 