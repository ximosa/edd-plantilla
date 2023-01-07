<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

get_header();
?>

<div class="page-banner">                 
    <div class="hvrbox">       
        <?php echo the_post_thumbnail( '', array( 'class' => 'hvrbox-layer_bottom' ) ); ?>
        <div class="hvrbox-layer_top">
            <div class="container">
                <div class="overlay-text text-left">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>                       
</div>

<div class="blog-single-1x blog-list-1x">
    <div class="container">
        <div class="row">

            <?php if( is_active_sidebar( 'bbpress_sidebar' ) ){ ?>
            <div class="col-md-8">
                <div class="row">

                    <?php while ( have_posts() ) : the_post(); ?>
                   
                        <div class="col-md-12">
                            <div class="blog-single-left-content">

                                <div class="blog-single-body">                               
                                    
                                    <?php

                                    the_content();

                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links">' . esc_html__( 'Pages ', 'eidmart' ),
                                        'after'       => '</div>',
                                        'link_before' => '<b>',
                                        'link_after'  => '</b>',
                                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page ', 'eidmart' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                    ) );                

                                    ?>

                                </div>

                                <?php

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                comments_template();
                                endif;

                                ?>

                            </div>
                        </div>

                    <?php endwhile; // End of the loop. ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>

            <div class="col-md-4">
              <?php 
                if( is_active_sidebar( 'bbpress_sidebar' ) ):
                    dynamic_sidebar('bbpress_sidebar');
                endif;
              ?>                
            </div>

            <?php } else { ?> 

            <div class="col-md-10 offset-md-1">
                <div class="row">

                    <?php while ( have_posts() ) : the_post(); ?>
                   
                    <div class="col-md-12">
                        <div class="blog-single-left-content">

                            <div class="blog-single-body">                               
                                
                                <?php

                                the_content();

                                wp_link_pages( array(
                                    'before'      => '<div class="page-links">' . esc_html__( 'Pages ', 'eidmart' ),
                                    'after'       => '</div>',
                                    'link_before' => '<b>',
                                    'link_after'  => '</b>',
                                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page ', 'eidmart' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) );                

                                ?>

                            </div>

                            <?php

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                              comments_template();
                            endif;

                            ?>

                        </div>
                    </div>

                    <?php endwhile; // End of the loop. ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>

            <?php } ?> 

        </div>
    </div>
</div>

<?php
get_footer();
