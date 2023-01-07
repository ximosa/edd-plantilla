<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eidmart
 */

get_header(); 

//page view count
eidmart_set_post_views( get_the_ID() );
eidmart_get_post_views( get_the_ID() );

$meta = get_post_meta( $post->ID );
$eidmart_radio_value = ( isset( $meta['eidmart_radio_value'][0] ) && '' !== $meta['eidmart_radio_value'][0] ) ? $meta['eidmart_radio_value'][0] : 'value_1';
$eidmart_radio_value1 = ( isset( $meta['eidmart_radio_value1'][0] ) && '' !== $meta['eidmart_radio_value1'][0] ) ? $meta['eidmart_radio_value1'][0] : '';
$eidmart_radio_value2 = ( isset( $meta['eidmart_radio_value2'][0] ) && '' !== $meta['eidmart_radio_value2'][0] ) ? $meta['eidmart_radio_value2'][0] : '';
$eidmart_radio_value3 = ( isset( $meta['eidmart_radio_value3'][0] ) && '' !== $meta['eidmart_radio_value3'][0] ) ? $meta['eidmart_radio_value3'][0] : '';
$eidmart_radio_value4 = ( isset( $meta['eidmart_radio_value4'][0] ) && '' !== $meta['eidmart_radio_value4'][0] ) ? $meta['eidmart_radio_value4'][0] : '';

// ===================================================================
// 1) Software Layout One / General
// ===================================================================
if( $eidmart_radio_value == 'value_1' ){
?>

<div class="product-single-banner">
    <div class="container product-head">
        <div class="row">
            <div class="col-md-8">
                <div class="product-banner-content">
                    <nav aria-label="breadcrumb">
                      <?php eidmart_breadcrumbs(); ?>
                    </nav>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="shapes">
            <img class="shape-1" src="<?php echo esc_url( get_template_directory_uri() . '/images/bg-pieces/circle-2.png' ); ?>">
        </div>
    </div>
</div>

<div class="product-description-1x">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <?php 
                
                if( have_posts() ):   // Check posts                  

                    while( have_posts() ) : the_post();   // Start loop 
                
                        // Collect Qr info
                        $id = get_the_ID();
                        $meta = get_post_meta( get_the_ID() );
                        $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
                        $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

                        $sales = edd_get_download_sales_stats( get_the_ID() );
                        $sales = $sales > 1 ? $sales . esc_html__(' Sales','eidmart') : $sales . esc_html__(' Sale','eidmart');                   

                        // Template content
                        get_template_part( 'template-parts/product/content','product' );                  

                    endwhile;  // End loop
                else:

                    // Template nothing found
                    get_template_part( 'template-parts/content','none' );   

                endif; // End posts checking

                ?>

            </div>

            <?php
            
            // General product sidebar
            get_template_part( 'template-parts/product/general','sidebar' ); 
            
            ?>

        </div>
    </div>
</div>

<?php
// ===================================================================
// 2) Photography General Layout
// ===================================================================
} else if( $eidmart_radio_value == 'value_2' ){ ?>

<div class="product-description-1x photography-single">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <?php 
                
                if( have_posts() ):   // Check posts                  

                    while( have_posts() ) : the_post();   // Start loop 
                
                    // Collect Qr info
                    $id = get_the_ID();
                    $meta = get_post_meta( get_the_ID() );
                    $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
                    $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

                    $sales = edd_get_download_sales_stats( get_the_ID() );
                    $sales = $sales > 1 ? $sales . esc_html__(' Sales','eidmart') : $sales . esc_html__(' Sale','eidmart');                   

                    // Template content
                    get_template_part( 'template-parts/product/content','image' );                  

                    endwhile;  // End loop
                    else:

                    // Template nothing found
                    get_template_part( 'template-parts/content','none' );   

                endif; // End posts checking

                ?>

            </div>

            <?php
            
            // General product sidebar
            get_template_part( 'template-parts/product/general','sidebar' ); 
            
            ?>

        </div>
    </div>
</div>

<?php 
// ===================================================================
// 3) Software Layout Two / Landing Single Page
// ===================================================================
} else if ( $eidmart_radio_value == 'value_p3' ) { 

if( have_posts() ):   // Check posts                  

    while( have_posts() ) : the_post();   // Start loop 

    // Collect Qr info
    $id = get_the_ID();
    $meta = get_post_meta( get_the_ID() );
    $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
    $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

    $sales = edd_get_download_sales_stats( get_the_ID() );
    $sales = $sales > 1 ? $sales . esc_html__(' Sales','eidmart') : $sales . esc_html__(' Sale','eidmart');                   

    // Template landing page
    get_template_part( 'template-parts/product/content','landing' );              

    endwhile;  // End loop
else:

    // Template nothing found
    get_template_part( 'template-parts/content','none' );   

endif; // End posts checking

// ===================================================================
// 4) Start Graphicland General
// ===================================================================
} else if ( $eidmart_radio_value == 'value_3' ) { ?>

<div class="product-description-1x">
    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col-md-10">
                
                <?php 
                
                if( have_posts() ):   // Check posts                  

                    while( have_posts() ) : the_post();   // Start loop 
                
                    // Collect Qr info
                    $id = get_the_ID();
                    $meta = get_post_meta( get_the_ID() );
                    $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
                    $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

                    $sales = edd_get_download_sales_stats( get_the_ID() );
                    $sales = $sales > 1 ? $sales . esc_html__(' Sales','eidmart') : $sales . esc_html__(' Sale','eidmart');                   

                    // Template content
                    get_template_part( 'template-parts/product/content','graphicland' );                  

                    endwhile;  // End loop
                    else:

                    // Template nothing found
                    get_template_part( 'template-parts/content','none' );   

                endif; // End posts checking

                ?>

            </div>
            
        </div>
    </div>
</div>

<?php
// ===================================================================
// 5) Start Graphicland Woo
// ===================================================================
} else if ( $eidmart_radio_value == 'value_4' ) { ?>

<div class="product-description-1x">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                
                <?php 
                
                if( have_posts() ):   // Check posts                  

                    while( have_posts() ) : the_post();   // Start loop 
                
                    // Collect Qr info
                    $id = get_the_ID();
                    $meta = get_post_meta( get_the_ID() );
                    $variable_pricing = isset($meta['_variable_pricing'][0]) ? $meta['_variable_pricing'][0] : '';
                    $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

                    $sales = edd_get_download_sales_stats( get_the_ID() );
                    $sales = $sales > 1 ? $sales . esc_html__(' Sales','eidmart') : $sales . esc_html__(' Sale','eidmart');                   

                    // Template content
                    get_template_part( 'template-parts/product/content','graphicland-woo' );                  

                    endwhile;  // End loop
                    else:

                    // Template nothing found
                    get_template_part( 'template-parts/content','none' );   

                endif; // End posts checking

                ?>

            </div>
            
        </div>
    </div>
</div>

<?php

// ===================================================================
// 6) Audio Single
// ===================================================================
} else if ( $eidmart_radio_value == 'value_5' ) { ?>

<div class="product-description-1x">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                
                <?php 
                
                if( have_posts() ):   // Check posts                  

                    while( have_posts() ) : the_post();   // Start loop 
    
                        // Template content
                        get_template_part( 'template-parts/product/content','audio' );                  

                    endwhile;  // End loop
                else:
                    // Template nothing found
                    get_template_part( 'template-parts/content','none' );   

                endif; // End posts checking

                ?>

            </div>            
        </div>
    </div>
</div>
    
<?php

// ===================================================================
// 7) Video Single
// ===================================================================

} else if ( $eidmart_radio_value == 'value_6' ) { ?>

    <div class="product-description-1x">
        <div class="container">
            <div class="row justify-content-md-center">    
                <div class="col-md-12">
                    
                    <?php 
                    
                    if( have_posts() ):   // Check posts                  
    
                        while( have_posts() ) : the_post();   // Start loop 
        
                            // Template content
                            get_template_part( 'template-parts/product/content','video' );                  
        
                        endwhile;  // End loop
                    else:
    
                        // Template nothing found
                        get_template_part( 'template-parts/content','none' );   
    
                    endif; // End posts checking
    
                    ?>
    
                </div>                
            </div>
        </div>
    </div>
        
    <?php
}

$related_product = get_post_meta( $post->ID, 'related_product',true);
if( $related_product && $eidmart_radio_value2 == 'value_5' ):
    echo do_shortcode( $related_product ); 
else:
?>
<div class="margin-top-large"></div>

<?php endif; get_footer(); ?>