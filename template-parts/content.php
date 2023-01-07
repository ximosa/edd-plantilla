<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="blog-list-single">
        <?php the_post_thumbnail(); ?>
        <span class="blog-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
        <div class="blog-list-content">

            <div class="blog-cat">
                <i class="fa fa-user-o"></i>
                <?php the_author_posts_link(); ?> &nbsp; 
                
                <?php

                    $terms = get_the_terms( $post->ID , 'category' );
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                        echo '<i class="fa fa-bookmark-o"></i>';
                        foreach ( $terms as $term ) {
                            ?>
                
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a> 

                            <?php                             
                        }
                    }
                
                ?>
            </div>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo eidmart_excerpt_char( '230' ); ?></p>
            <div class="blog-footer">

                <br>
                <a href="<?php the_permalink(); ?>" class="btn-small"> <?php esc_html_e( 'Read More', 'eidmart' ); ?> </a> 
                
                <?php if( get_theme_mod( 'social_share' ) == 1 ): ?>
                <div class="btn-group dropright ">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-share-alt"></i>
                    </button>
                    <div class="dropdown-menu">  
                        <?php if( function_exists( 'eidmart_default_blog_share_buttons' ) ): eidmart_default_blog_share_buttons(); endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>


</article><!-- #post-<?php the_ID(); ?> -->