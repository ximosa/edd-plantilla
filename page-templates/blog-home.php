<?php
/**
 * Template Name: Blog Home
 *
 * @package eidmart
**/

get_header(); ?>

<div class="blog-home">

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

<?php get_footer( 'home' ); ?>
