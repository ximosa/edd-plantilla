  <?php 

  /**
   * Template Name: Graphicland:: Multi Vendor Graphicland Profile Template (2)
   *
   * @package eidmart
  **/

  get_header();

  global $post;

  $user_name = get_query_var('vendor');
  $username = $user_name;
  $user = get_user_by( 'login', $username);

  $products = EDD_FES()->vendors->get_all_products( $user->ID );

  $sales = 0;
  $earnings = 0;
  if (!empty($products)) {
    foreach ($products as $product) {
      $sales += $product['sales'];
      $earnings += $product['earnings'];
    }
  } 

  // Vendor information
  $db_user = new FES_DB_Vendors();
  $vendor = $db_user->get_vendor_by( 'user_id', $user->ID );


  // check if vendor
  if ( $db_user->exists( 'user_id', $user->ID ) ) {
  ?>

    <div class="author-profile-banner margin-bottom-large">
      <div class="container">

          <div class="row  align-items-center">
                <div class="col-md-12">
                  <div class="author-profile-left graphicland-profile text-center">

                    <?php echo get_avatar( $user->ID, '80', '' , '' , array( 'class' => array( '' ) ) ); ?>

                    <span class="author">
                        <?php 
                        if( get_user_meta( $user->ID, 'name_of_store', true ) ):                                  
                            echo get_user_meta( $user->ID, 'name_of_store', true ); 
                        else :
                            echo esc_html( $user->display_name ); 
                        endif;
                        ?>
                    </span>

                    <ul class="vendor-social">
                        <?php if( get_user_meta( $user->ID, 'facebook', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'facebook', true )); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
                        <?php if( get_user_meta( $user->ID, 'twitter', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'twitter', true )); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                        <?php if( get_user_meta( $user->ID, 'linkedin', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'linkedin', true )); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
                        <?php if( get_user_meta( $user->ID, 'dribbble', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'dribbble', true )); ?>"><i class="fa fa-dribbble"></i></a></li><?php endif; ?>
                        <?php if( get_user_meta( $user->ID, 'github', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'github', true )); ?>"><i class="fa fa-github"></i></a></li><?php endif; ?>
                        <?php if( get_user_meta( $user->ID, 'behance', true ) ): ?><li><a href="<?php echo esc_url( get_user_meta( $user->ID, 'behance', true )); ?>"><i class="fa fa-behance"></i></a></li><?php endif; ?>
                    </ul>
                    
                  </div>
                </div>
                
          </div>
          
      </div>
    </div>

    <div class="latest-product-1x graphicland-profile-product latest-product-curvebg graphicland-style<?php if( get_theme_mod( 'user_follow' ) == 2 ): echo " margin-top-large"; endif; ?>">
        <div class="container">
            <div class="col-md-12">
                <div class="latest-product-title">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="latest-product-title-right graphicland-fileter">
                               <div id="filters" class="course-menu">
                                 <!-- Filters -->
                                 <?php if(!is_tax()) {
                                 $terms = get_terms( 'download_category' );
                                 $count = count( $terms );
                                 if ( $count > 0 ) { ?>
                                     <button class="filter active"  data-filter="all"><?php esc_html_e( 'All','eidmart' ); ?></button>
                                 <?php
                                     foreach ( $terms as $term ) {
                                         echo '<button  class="filter" data-rel="'. $term->name .'" data-filter=".'.$term->slug.'">'. $term->name .'</button>';

                                     } ?>                                           
                                 <?php } } ?>
                               </div>
                            </div>
                        </div>
                    </div> 
                </div>                  
            </div>

            <div class="all-product-tab">
                
                <div  id="edd-product">
                    <div class="row">

                      <div class="load-product" data-btn_text ="Load More" data-max_post ="<?php echo get_option( 'posts_per_page' ); ?>" data-max_post_show ="8"></div>

                      <?php

                        global $post;

                        $args = array(
                            'orderby' => 'date', 
                            'author' => $user->ID, 
                            'post_type' => 'download',                                
                            'posts_per_page' => -1
                        );

                        
                        $prodcut_downloads = new \WP_Query( $args );

                        if( $prodcut_downloads->have_posts() ) : ?>
                   
                        <?php 

                        while( $prodcut_downloads -> have_posts() ) : $prodcut_downloads -> the_post(); 
                
                        $id = get_the_ID();
                        $meta = get_post_meta( get_the_ID() );
                        $variable_pricing = isset( $meta['_variable_pricing'][0] ) ? $meta['_variable_pricing'][0] : '';
                        $edd_price = isset( $meta['edd_price'][0] ) ? $meta['edd_price'][0] : '';

                        $sales = edd_get_download_sales_stats( get_the_ID() );
                        $sales = $sales > 1 ? $sales . __(' sales','eidmart') : $sales . __(' sale','eidmart');
                                            
                        // Collect downloads tearms 
                        $terms = get_the_terms( $post->ID, 'download_category' );
                   
                        ?>                        

                        <div class="<?php echo esc_attr( get_theme_mod( 'course_grid', 'col-md-3' ) ); ?> tile <?php echo esc_attr( $terms[0]->slug ); ?>"> 
                            <div class="single-product load-more">                                      
                                <div class="graphicland-product-container">                                  
                                    <div class="product-content">
                                        <a href="<?php the_permalink(); ?>" target="_blank">
                                            <div class="content-overlay"></div>

                                            <?php the_post_thumbnail( '', [ 'class' => 'graphicland-image' ] ); ?>
                                            <div class="content-details fadeIn-bottom">
                                                <h3 class="content-title" title="<?php the_title(); ?>"><?php echo eidmart_excerpt_char_course_title( get_theme_mod( 'max_char', '30' ) ); ?> <strong><?php if( $edd_price ): echo edd_price(); else: echo __( 'Free','eidmart' ); endif; ?></strong></h3>
                                            </div>
                                            
                                        </a>
                                    </div>
                                </div>
                            
                                <?php if( !empty( get_post_meta( $post->ID, 'edd_feature_download' ) ) ): ?>
                                    <span class="sticker-feature" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Featured', 'eidmart');?>"><i class="las la-gem"></i></span>
                                <?php endif; ?>
                                
                            </div>
                        </div>  

                        <?php endwhile; wp_reset_postdata(); ?>                             

                        <?php else: ?>                            
                        
                            <div class="col-md-12">
                                <h4><?php esc_html_e( 'No item available right now.','eidmart' ); ?></h4>
                            </div>

                        <?php endif; ?>

                        <div class="col-md-12">                                                                          
                            <div class="all-product-button">
                                <a href="#" id="loadMore" class="btn-small"><?php esc_html_e( 'Load More', 'eidmart' ); ?></a>
                            </div> 
                        </div>

                    </div> 
                </div>
            </div>
        </div>
    </div>

  <?php } else { ?>


  <div class="page-banner">                 
      <div class="hvrbox">       
          <?php echo the_post_thumbnail( '', array( 'class' => 'hvrbox-layer_bottom' ) ); ?>
          <div class="hvrbox-layer_top">
              <div class="container">
                  <div class="overlay-text text-center">
                      <h1><?php esc_html_e( 'Become a Vendor', 'eidmart' ); ?></h1>
                  </div>
              </div>
          </div>
      </div>                       
  </div>

  <div class="simple-page-content">
    <div class="container">
      <div class="row">

        <div class="col-md-6 offset-md-3">
            <?php echo do_shortcode( '[fes_registration_form]' ); ?>                
        </div>

      </div>
    </div>
  </div>

  <?php } get_footer(); ?>