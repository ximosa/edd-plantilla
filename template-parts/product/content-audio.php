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

<div class="product-description-left graphicland-demo audio">
    
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
                            $user_name = get_the_author_meta( 'user_login' , $user_id ); ?> 
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
        $external_url = isset($meta['purchase_url'][0]) ? $meta['purchase_url'][0] : '';

        $sales = edd_get_download_sales_stats(get_the_ID());
        $sales = $sales > 1 ? $sales . __(' sales', 'eidmart') : $sales . __(' sale', 'eidmart');

        $external_audio = isset($meta['external_audio'][0]) ? $meta['external_audio'][0] : '';
        if ( $external_audio ):
            $mp3_url = $external_audio;
        else:
            $mp3_url = isset($meta['mp3_url'][0]) ? $meta['mp3_url'][0] : '';
        endif;
        $mp3_artist = isset($meta['artist'][0]) ? $meta['artist'][0] : '';

        // Collect downloads tearms
        $terms = get_the_terms($post->ID, 'download_category');

        $mp3_title = html_entity_decode(get_the_title()) . uniqid();
        $mp3_title = preg_replace('/[^A-Za-z0-9\-]/', '', $mp3_title);
        
        ?>

        <div class="row">
            <div class="col-md-8">
                <div class="single-page-player">
                    <a href="javascript:void(0);" class="album-poster <?php echo esc_attr($mp3_title); ?>" data-uniqid="<?php echo esc_attr($mp3_title); ?>" data-external-url="<?php echo esc_attr($external_url); ?>" data-switch="0" data-price='<?php edd_price();?>' data-title='<?php the_title();?>' data-artist="<?php echo esc_attr($mp3_artist); ?>" data-mp3="<?php echo esc_attr($mp3_url); ?>" data-pid="<?php echo esc_attr($id); ?>" data-cover="<?php the_post_thumbnail_url();?>">
                        <img class="single-audio-player" src="<?php echo esc_url( get_template_directory_uri() .'/images/loader/audio-player.gif' ); ?>" alt='<?php the_title();?>' >
                        <img class="single-audio-pic" src="<?php echo esc_url( get_template_directory_uri() .'/images/loader/audio-pic.gif' ); ?>" alt='<?php the_title();?>' >
                        <div class="player-icon">
                            <i class="las la-play"></i>
                            <i class="las la-pause"></i>
                        </div>
                    </a>
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

                    } ?>
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