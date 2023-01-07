<?php
/**
 * Template Name: Container-fluid Width Page Template
 *
 * @package eidmart
**/

get_header(); ?>

<div class="full-page-content">
    <div class="container-fluid">
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
