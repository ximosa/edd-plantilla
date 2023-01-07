<?php
/**
 * Template Name: Simple Page Template
 *
 * @package eidmart
**/

get_header(); ?>


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

<div class="simple-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

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
