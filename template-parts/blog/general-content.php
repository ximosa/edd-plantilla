<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */


if( is_active_sidebar( 'sidebar' ) ) { ?>
    <div class="col-md-8">
        <div class="row">

            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php if( get_theme_mod( 'social_share' ) == 1 ): ?>
            <div class="col-md-1">
                <div class="social-link">
                    <ul>
                        <?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
                    </ul>                   
                </div>
            </div>
            <?php endif; ?>
            
            <?php if( get_theme_mod( 'social_share' ) == 1 ){ ?>
            <div class="col-md-11">
            <?php } else { ?>
            <div class="col-md-12">
            <?php } ?>
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

                    $marttag = get_the_tags( $post->ID );                    
                    if( $marttag ):

                    ?>
                    <ul class="single-post-tag">

                        <?php

                        echo '<li>' . esc_html__( 'Tags:', 'eidmart' ) . '</li>';
                        
                        foreach( $marttag as $tag_single ):
                            echo '<li><a href="'. esc_url( get_tag_link( $tag_single->term_id ) ) .'">'." $tag_single->name ".'</a></li>'; 
                        endforeach;
                    
                        ?>
                    </ul>

                    <?php if( get_theme_mod( 'author_area' ) == 1 ) { ?>
                    <div class="blog-author">
                        <div class="media">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                            <div class="media-body">
                                <h5><?php the_author_posts_link(); ?></h5>
                                <h4>
                                    <?php $designation = get_the_author_meta( 'designation' ); if( $designation && $designation != '' ): echo esc_html( $designation ); endif; ?>  &nbsp;<i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?>
                                    
                                    &nbsp;<i class="fa fa-bookmark-o"></i> 
                                    <?php
                                        $terms = get_the_terms( $post->ID , 'category' );
                                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                            foreach ( $terms as $term ) {
                                                ?>
                                    
                                                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a> 

                                                <?php                             
                                            }
                                        }		                            
                                    ?>
                                </h4>
                                <p>
                                    <?php 
                                    
                                    $author_desc = get_the_author_meta( 'description' ); 
                                    echo esc_html( substr( $author_desc, 0, 250 ) ) . '...';

                                    ?>
                                </p>
                                
                            </div>
                        </div>                          
                    </div>
                    <?php } ?>


                    <?php

                    endif; // End tag check

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    ?>

                </div>
            </div>

            <?php endwhile; // End of the loop.	?>
            <?php wp_reset_postdata(); ?>

        </div>

    </div>

    <div class="col-md-4">
        <?php get_sidebar(); ?>                
    </div>
    <?php } else { ?>

    <div class="col-md-10 offset-md-1">
        <div class="row">

            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php if( get_theme_mod( 'social_share' ) == 1 ): ?>
            <div class="col-md-1">
                <?php if( function_exists( 'eidmart_page_share_buttons' ) ): eidmart_page_share_buttons(); endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if( get_theme_mod( 'social_share' ) == 1 ){ ?>
            <div class="col-md-11">
            <?php } else { ?>
            <div class="col-md-12">
            <?php } ?>
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

                    $marttag = get_the_tags( $post->ID );                    
                    if( $marttag ):

                    ?>
                    <ul class="single-post-tag">

                        <?php

                        echo '<b>' . esc_html__( 'Tags', 'eidmart' ) . '</b>';
                        
                        foreach( $marttag as $tag_single ):
                            echo '<li><a href="'. esc_url( get_tag_link( $tag_single->term_id ) ) .'">'." $tag_single->name ".'</a></li>'; 
                        endforeach;
                    
                        ?>
                    </ul>


                    <?php endif; // End tag check
                    if( get_theme_mod( 'author_area' ) == 1 ) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="blog-author">
                                <div class="media">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                                    <div class="media-body">
                                    <h5><?php the_author_posts_link(); ?></h5>
                                    <h4>
                                        <?php $designation = get_the_author_meta( 'designation' ); if( $designation && $designation != '' ): echo esc_html( $designation ); endif; ?>  &nbsp;<i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?>
                                        
                                        &nbsp;<i class="fa fa-bookmark-o"></i> 
                                        <?php
                                            $terms = get_the_terms( $post->ID , 'category' );
                                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                                foreach ( $terms as $term ) {
                                                    ?>
                                        
                                                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a> 

                                                    <?php                             
                                                }
                                            }                                   
                                        ?>
                                    </h4>
                                    <p>
                                        <?php 
                                        
                                        $author_desc = get_the_author_meta( 'description' ); 
                                        echo esc_html( substr( $author_desc, 0, 250 ) ) . '...';

                                        ?>
                                    </p>
                                    
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>

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

<?php } 