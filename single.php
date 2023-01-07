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
if ( function_exists( 'eidmart_set_post_views' ) ){ 
    eidmart_set_post_views( get_the_ID() );
}

// Initialize the meta options

$meta = get_post_meta( $post->ID );
$related_product = get_post_meta( $post->ID, 'related_product',true );
$read_time = get_post_meta( $post->ID, 'read_time',true );
$single_blog = ( isset( $meta['single_blog'][0] ) && '' !== $meta['single_blog'][0] ) ? $meta['single_blog'][0] : '1';
$show_hide_related_post = ( isset( $meta['show_hide_related_post'][0] ) && '' !== $meta['show_hide_related_post'][0] ) ? $meta['show_hide_related_post'][0] : '';

if( $single_blog == 1 ) { // General with sidebar

?>

<div class="page-banner">                 
    <div class="hvrbox">       
        <?php echo the_post_thumbnail( '', array( 'class' => 'hvrbox-layer_bottom' ) ); ?>
        <div class="hvrbox-layer_top">
            <div class="container">
                <div class="overlay-text text-left">
                    <nav aria-label="breadcrumb">
                        <?php eidmart_breadcrumbs(); ?>
                    </nav>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>                       
</div> 

<div class="blog-single-1x blog-list-1x">
    <div class="container">
        <div class="row">

            <?php
            
            // Template content
            get_template_part( 'template-parts/blog/general','content' );  
            
            ?>

        </div>
    </div>
</div>

<?php } else if( $single_blog == 2 ) { // Without sidebar ?>

<div class="single-page-header">                 
    <div class="container">       
        <div class="row align-items-center">       
            <div class="col-md-5"> 
                <div class="single-header-left-content">
                    <nav aria-label="breadcrumb">
                        <?php eidmart_breadcrumbs(); ?>
                    </nav>
                    <h1><?php the_title(); ?></h1>
                    <span class="meta-info">
                        <?php
                        if( is_singular() ):

                            // Author name
                            if( get_theme_mod( 'author_area_top' ) == 1 ):
                                $author_id = get_queried_object()->post_author;
                                echo "<i class='fa fa-pencil-square-o'></i> ". get_the_author_meta('display_name', $author_id) . " ";
                            endif;
                            echo "<i class='fa fa-clock-o'></i> ". get_the_date();
                            if( $read_time ): echo "<i class='fa fa-book'></i> ". $read_time; endif;

                        endif;
                        
                        ?>
                    </span>
                </div>
            </div>
            <div class="col-md-7">
                <?php echo the_post_thumbnail( '', array( 'class' => 'single-header-right-content' ) ); ?>
            </div>                  
        </div>                       
    </div>                       
</div> 

<div class="blog-single-1x blog-list-1x">
    <div class="container">
        <div class="row">

            <?php
            
            // Template content
            get_template_part( 'template-parts/blog/full','width' );  
            
            ?>

        </div>
    </div>
</div>

<?php
}

if( $related_product && $show_hide_related_post == '1' ):
    echo do_shortcode( $related_product ); 
endif;

get_footer();
