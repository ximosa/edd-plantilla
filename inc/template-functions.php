<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package eidmart
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * Count content excerpt by word
 */
function eidmart_excerpt_word ( $limit = null ) {

    if ( null === $limit ) {
        $limit = 50;
    }

    $eidmart_excerpt = explode(' ', get_the_content(), $limit);      
    if ( count( $eidmart_excerpt ) >= $limit ) {
        array_pop( $eidmart_excerpt );
        $eidmart_excerpt = implode(" ", $eidmart_excerpt ).'...';
    } else {
        $eidmart_excerpt = implode(" ", $eidmart_excerpt ).'...';
    } 
    $eidmart_excerpt = preg_replace('/\[.+\]/','', $eidmart_excerpt);
    $eidmart_excerpt = apply_filters('the_content', $eidmart_excerpt); 
    $eidmart_excerpt = str_replace(']]>', ']]&gt;', $eidmart_excerpt);     

    return wp_strip_all_tags( $eidmart_excerpt );
}

/**
 * Count content excerpt by character 
 */
function eidmart_excerpt_char ( $limit = null ){

    if ( null === $limit ) {
        $limit = 50;
    }

    $excerpt = get_the_content();
    $excerpt = strip_shortcodes( $excerpt );
    $excerpt = strip_tags( $excerpt );
    $excerpt = substr( $excerpt, 0, $limit );
    $excerpt = $excerpt.' ... <a href="'.get_the_permalink().'"></a>';
    return wp_strip_all_tags( $excerpt );
}

/**
 * Count excerpt by character for course title
 */
function eidmart_excerpt_char_course_title ( $limit = null ){

    if ( null === $limit ) {
        $limit = 35;
    }

    $excerpt = get_the_title();
    $excerpt = strip_shortcodes( $excerpt );
    $excerpt = strip_tags( $excerpt );
    $excerpt = substr( $excerpt, 0, $limit );
    $excerpt = $excerpt.'<a href="'.get_the_permalink().'"></a>';
    return wp_strip_all_tags( $excerpt );
}
    
if ( ! function_exists( 'eidmart_entry_meta' ) ) :
  /**
   * Prints HTML with meta information
   */
  function eidmart_entry_meta() { ?>
      
    <div class="blog__meta">
        <div class="author">
            <span class="lnr lnr-user"></span>
            <p><?php esc_html_e( 'By','eidmart' ); ?> <?php the_author(); ?></p>
        </div>
        <div class="date_time">
            <span class="lnr lnr-clock"></span>
            <p><?php the_time( 'j M Y' ); ?></p>
        </div>
        <div class="comment_view">
            <p class="comment"><span class="lnr lnr-bubble"></span><?php comments_number( esc_html__('No Comments','eidmart'), '1'. esc_html__(' Comment ','eidmart'), '% '. esc_html__(' Comments ','eidmart')); ?></p>
            <p class="view"><?php echo eidmart_get_post_views(get_the_ID()); ?></p>
        </div>
    </div>

  <?php   
  }
endif;

if( ! function_exists( 'eidmart_fn' )  ) :
   /**
    *  Category fetch
    */

    function eidmart_fn() {
        $eidmart = get_categories();
        if( $eidmart ):
            foreach( $eidmart as $cat_single ):
                echo '<li><a href="'. esc_url( get_category_link( $cat_single->term_id ) ) .'"><span class="lnr lnr-chevron-right"></span>'." $cat_single->name ".'<span class="item-count">'." $cat_single->count ".' </span></a></li>';
            endforeach;
        else:
            echo "<li>" . esc_html__('There are no categories.','eidmart') . "</li>";
        endif;
    }

endif;

if( ! function_exists( 'eidmart_custom_fn' )  ) :
   /**
    *  Product Category fetch
    */

    function eidmart_custom_fn() {        
        
        $terms = get_terms( 'download_category' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {                
                ?>
                <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"> <?php echo esc_html( $term->name ); ?></a></li>
                <?php                             
            }
        }        
    } // End fn

endif;

/**
 * Eidmart Function - Get terms dropdown
 *
 *  Adding the download category filter.
 */

function eidmart_get_terms_dropdown(){
    $myterms = get_terms( 'download_category' );

    $output ="<div class='input-group-append styleSelect'><select class='select--field' id='inputGroupSelect01' name='download_cat' > ";
    $output.= "<option value='all'>".esc_html__( "All Categories","eidmart" )."</option>";
    foreach($myterms as $term){
        $term_name =$term->name;
        $slug =$term->slug;
        $output .="<option value='".$slug."'>".$term_name."</option>";
    }
    $output .="</select></div>";
    return $output;
  
}

if( ! function_exists( 'eidmart_tag_fn' )  ) :
   /**
    *  Tags fetch
    */

    function eidmart_tag_fn() {

        $marttag = get_tags(); 
                    
        if( $marttag ):

            foreach( $marttag as $tag_single ):
                echo '<li><a href="'. esc_url( get_tag_link( $tag_single->term_id ) ) .'">'." $tag_single->name ".'</a></li>'; 
            endforeach;
        else:
            echo "<li>" . esc_html__('There are no tags.','eidmart') . "</li>";
        endif;

    }

endif;

if( ! function_exists( 'eidmart_pagination' )  ) :
   /**
    *  Tags fetch
    */

    function eidmart_pagination() { ?>

        <div class="pagination-area">
            <nav class="navigation pagination" role="navigation">
                <div class="nav-links">                                    

                    <?php                    
                        global $wp_query;
                        echo paginate_links( array(
                            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'total'        => $wp_query->max_num_pages,
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => '<span class="lnr lnr-arrow-left"></span>',
                            'next_text'    => '<span class="lnr lnr-arrow-right"></span>',
                            'add_args'     => false,
                            'add_fragment' => ''
                        ) );
                    ?>

                </div>
            </nav>
        </div>

    <?php
        
    }

endif;

if( ! function_exists( 'eidmart_author_meta' )  ) :
   /**
    *  Tags fetch
    */

    function eidmart_author_meta() { 

        if( get_theme_mod( 'author_profile' ) == 'show') :

        ?>

        <div class="author_info">
            <div class="author__img">
                <?php echo get_avatar( get_the_author_meta('email'), '' ); ?> 
            </div>

            <div class="author__info">
                <h4><?php the_author(); ?></h4>
                <p><?php the_author_meta('description'); ?></p>
                <ul>

                    <?php 

                    $google_profile = get_the_author_meta( 'google_profile' );
                    if ( $google_profile && $google_profile != '' ) {
                        echo '<li><a href="' . esc_url($google_profile) . '" rel="author"><span class="fa fa-google-plus"></span></a></li>';
                    }

                    $twitter_profile = get_the_author_meta( 'twitter_profile' );
                    if ( $twitter_profile && $twitter_profile != '' ) {
                        echo '<li><a href="' . esc_url($twitter_profile) . '"><span class="fa fa-twitter"></span></a></li>';
                    }

                    $facebook_profile = get_the_author_meta( 'facebook_profile' );
                    if ( $facebook_profile && $facebook_profile != '' ) {
                        echo '<li><a href="' . esc_url($facebook_profile) . '"><span class="fa fa-facebook"></span></a></li>';
                    }

                    $linkedin_profile = get_the_author_meta( 'linkedin_profile' );
                    if ( $linkedin_profile && $linkedin_profile != '' ) {
                        echo '<li><a href="' . esc_url($linkedin_profile) . '"><span class="fa fa-linkedin"></span></a></li>';
                    }

                    ?>

                </ul>
            </div>
        </div><!-- end /.author_info -->

        <?php                                      
        endif;        
    }
endif;

/**
 * HTML tag compatible data validation
 */
function eidmart_kses_allowed_html( $tags, $context ) {
  switch( $context ) {
    case 'allowed_html': 
      $tags = array(
        'a'      => [
            'href'  => [],
            'title' => [],
        ],
        'br'     => [],
        'em'     => [],
        'strong' => [],
        'b' => [],
        'span' => [],
        'del' => [],
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'eidmart_kses_allowed_html', 10, 2 );

// Remove all script and style type as w3valitator
function eidmart_buffer_start() { 
    ob_start( 'eidmart_callback' ); 
}
add_action('wp_loaded', 'eidmart_buffer_start');

function eidmart_callback( $buffer ) {
    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", ' ', $buffer );
}

// comment field in top
function eidmart_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'eidmart_move_comment_field_to_bottom' );

// Support commnet on item
function eidmart_edd_download_supports( $supports ) {
 
    // add support for comments
    $supports[] = esc_html__( 'comments', 'eidmart' );
 
    // pass it back to EDD
    return $supports;   
 
} 
add_filter('edd_download_supports', 'eidmart_edd_download_supports');

// User purchased/author badge
function eidmart_comment_badges( $return, $author, $comment_ID ) {
 
    // make sure we only proceed if we are in the comments listing on a download page
    if ( ! is_singular( 'download' ) || ! in_the_loop() || ! is_main_query() ) {
        return $return;
    }
 
    // get product/download ID
    $download_id = get_the_ID();
 
    // get comment author  ID
    $comment = get_comment( $comment_ID );
    $commenter_id = $comment->user_id;
 
    // if the comment was made by a guest return original
    if ( $commenter_id == 0 ) {
        return $return;
    }
 
    // should we display a purchased badge
    $display_purchased_badge = false;
    if ( function_exists( 'edd_has_user_purchased' ) && edd_has_user_purchased( $commenter_id, $download_id ) ) {
        $display_purchased_badge = true;
    }
 
    // append the badge HTML
    if ( $display_purchased_badge ) {
        $return .= '<span class="badge-purchased">'. esc_html__( 'Purchased', 'eidmart' ) .'</span>';
    }

    // should we display author badge
    $display_author_badge = false;
    if ( $commenter_id == get_the_author_meta( 'ID' ) ) {
        $display_author_badge = true;
    }
 
    // append the badge HTML
    if ( $display_author_badge ) {
        $return .= '<span class="badge-author">'. esc_html__( 'Author', 'eidmart' ) .'</span>';
    }
 
    // pass it back to WordPress
    return $return;
 
} 
add_filter( 'get_comment_author_link', 'eidmart_comment_badges', 10, 3 );

/*
 * Easy Digital Downloads - Remove Decimals
 */ 
function eidmart_edd_remove_decimals( $decimals ) {
    return 0;
}
add_filter( 'edd_sanitize_amount_decimals', 'eidmart_edd_remove_decimals' );
add_filter( 'edd_format_amount_decimals', 'eidmart_edd_remove_decimals' );

/**
 * Eidmart Function - Print Cart
 *
 */

if( !function_exists( 'eidmart_print_current_user_name' ) ){
    function eidmart_print_current_user_name(){
        $current_user = wp_get_current_user();
        echo esc_html( $current_user->user_login );
    }
}

/**
 * Cart ajax action.
 */

if( ! function_exists( 'eidmart_custom_ajax' ) ){
    function eidmart_custom_ajax(){
        if( isset( $_GET['cart_count'] ) && ( $_GET['cart_count'] == 1 ) ){
            echo edd_get_cart_quantity();
        }
        else{
            eidmart_print_cart();
        }
        die();
    }
}
add_action( 'wp_ajax_eidmart_custom_ajax', 'eidmart_custom_ajax' );
add_action( 'wp_ajax_nopriv_eidmart_custom_ajax', 'eidmart_custom_ajax' );

/**
 * Eidmart Function - Remove Item Url
 * Returns the URL to remove an item from the cart
 */

if( ! function_exists( 'eidmart_remove_item_url' ) ){
  function eidmart_remove_item_url( $cart_key, $cart_key_id ) {

    global $wp_query;
    
    if ( defined( 'DOING_AJAX' ) ) {
        $current_page = edd_get_checkout_uri();
    } else {
        $current_page = edd_get_current_page_url();
    }

    $remove_url = edd_add_cache_busting( add_query_arg( array( 'cart_item' => $cart_key, 'edd_action' => 'remove' ), $current_page ) );
    return apply_filters( 'edd_remove_item_url', $remove_url );
  }  
}

/**
 * Displays the header cart widget
 */

if( ! function_exists( 'eidmart_print_cart' ) ){
    function eidmart_print_cart(){ 

        if( !class_exists( 'Easy_Digital_Downloads' ) ){
          return; 
        } 

        ?>

        <div class="cart-widget">

            <span class="cart-btn">
                <span class="white-cart"><i class="las la-shopping-cart"></i> <sup><?php if( edd_get_cart_quantity() > 0 ): echo edd_get_cart_quantity(); else: echo "0"; endif; ?></sup></span>
            </span>

            <div class="cart-dropdown-menu">
                <span class="triangle-arrow"></span>              

                <ul>
                    <?php

                    $cart_propertys = edd_get_cart_contents();   

                    if( $cart_propertys ):
                          
                        // Fetch property
                        foreach( $cart_propertys as $cart_property_key => $cart_property_value ):
                                                    
                            // Collect id
                            $id = $cart_property_value['id'];
                                                        
                            // Initialization cart_thumb
                            $cart_thumb = '';
                            $thumb_id = get_post_thumbnail_id( $id );
                            $cart_thumb = wp_get_attachment_image_src( $thumb_id );
                                                            
                            // Collect cat                            
                            $terms = get_the_terms( $id , 'download_category' );

                            ?>

                            <li>
                                <div class="media">
                                    <img src="<?php echo esc_url( $cart_thumb[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $id ) ); ?>">
                                    <div class="media-body">
                                        <h4>
                                            <a href="<?php echo esc_url( get_the_permalink( $id )); ?>"><?php echo wp_kses( get_the_title( $id ), 'allowed_html' ); ?></a>
                                            <a href="<?php echo esc_url( wp_nonce_url( eidmart_remove_item_url( $cart_property_key, $id ), 'edd-remove-from-cart-' . $cart_property_key, 'edd_remove_from_cart_nonce' ) ); ?>" class="" title="<?php esc_attr_e('Remove this item','eidmart');?>"><i class="las la-times"></i></a> 
                                        </h4>
                                        <h3>
                                            <a href="<?php echo esc_url( get_term_link( $terms[0]->term_id ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?> </a>
                                            <span>
                                            <?php 
                                                if(count( $cart_property_value['options'] ) > 0 ) :                                    
                                                    echo edd_cart_item_price( $cart_property_value['id'], $cart_property_value['options'] );                     
                                                else:                                    
                                                    edd_price( $id );                                    
                                                endif;
                                            ?>
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                            </li>                    

                        <?php endforeach; ?> 

                        <li>
                            <p><?php esc_html_e( ' Total : ' , 'eidmart' ); ?> <b><?php edd_cart_total(); ?></b></p>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( edd_get_checkout_uri()); ?>" class="btn-large"><?php esc_html_e( 'Checkout','eidmart' ); ?></a>
                        </li>

                    <?php else: ?>
                
                        <li>
                            <?php esc_html_e( 'Your cart is empty.','eidmart' ); ?>
                        </li>

                    <?php endif; ?>

                </ul>
                               
            </div>
        </div>
    <?php  
    }
}

/**
 * Get the download count 
 */

if( ! function_exists( 'eidmart_edd_mdownload_count' ) ){
    function eidmart_edd_mdownload_count( $download_id = 0 ) {
        global $edd_logs;
        $meta_query = array(
            'relation'  => 'AND',
            array(
                'key'   => '_edd_log_file_id'
            ),
            array(
                'key'   => '_edd_log_payment_id'
            )
        );
        return $edd_logs->get_log_count( $download_id, 'file_download', $meta_query );
    }
}

/**
 * get the FES vendor URL
 */
function eidmart_edd_fes_author_url( $author = null, $user_id = null ) {
    // Collect author meta ID
    $user_id = get_the_author_meta( 'ID' ); 
    // Collect vendor id
    $vendor_id = get_the_author_meta( 'ID' , $user_id );
    $user_name = get_the_author_meta( 'user_login' , $user_id );

    if ( ! $author ) {
        $author = wp_get_current_user();
    } else {
        $author = new WP_User( $author );
    }
    if ( ! class_exists( 'EDD_Front_End_Submissions' ) ) {
        return get_author_posts_url( $author->ID, $author->user_nicename );
    }
    
    if( get_option( 'permalink_structure' ) == "/%postname%/" ){
        return home_url( '/vendor/'. $user_name );
    } else {
        return EDD_FES()->vendors->get_vendor_store_url( $vendor_id );
    }
}

// remove the standard button that shows after the download's content
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

// Category name
if( ! function_exists( 'eidmart_cat_name_single' ) ){

    function eidmart_cat_name_single() {
    
        $terms = get_the_terms( get_the_ID() , 'download_category' );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

            foreach ( $terms as $term ) {
                return $term->name;
            }
        }        
    }
}

// Category slug
if( ! function_exists( 'eidmart_cat_slug_single' ) ){

    function eidmart_cat_slug_single() {
    
        $terms = get_the_terms( get_the_ID() , 'download_category' );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

            foreach ( $terms as $term ) {
                return $term->slug;
            }
        }        
    }
}

// Category name for archive
if( ! function_exists( 'eidmart_cat_name_ark' ) ){

    function eidmart_cat_name_ark() {    
        $terms = get_terms( 'download_category' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) { ?>
                <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/arrow-right.png' ); ?>" alt="<?php echo esc_attr( $term->name ); ?>"> <?php echo esc_html( $term->name ); ?> <span><?php echo esc_html( $term->count ); ?></span></a></li>
            <?php
            }
        }        
    }
}

// Tag name
if( ! function_exists( 'eidmart_tag_name' ) ){
    function eidmart_tag_name() {
        $terms = get_the_terms( get_the_ID() , 'download_tag' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) { ?>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                <?php                             
            }
        }        
    }
}

// Product search
function eidmart_product_search(){ ?>    
   
    <div class="main-banner product-list-banner">                
        <div class="hvrbox">
            <?php if( get_theme_mod( 'banner_upload' ) ): ?>
                <img src="<?php echo esc_url( get_theme_mod( 'banner_upload' ) ); ?>" alt="<?php esc_attr_e( 'Page header banner','eidmart' ); ?>" class="hvrbox-layer_bottom">
            <?php endif; ?>
                        
            <div class="hvrbox-layer_top">
                <div class="container">
                    <div class="overlay-text text-center"> 


                        <?php 
                        if( get_theme_mod( 'main_title' ) ):
                            echo "<h1>";
                                $count_posts = wp_count_posts('download');
                                $total_posts = "<b>". $count_posts->publish ."</b>";
                                if( get_theme_mod( 'product_count', 1 ) == 1 ): echo wp_kses( $total_posts, 'allowed_html' ); endif;
                                echo esc_html( get_theme_mod( 'main_title', __( 'WordPress Themes & Website Templates', 'eidmart' ) ) );
                            echo "</h1>";
                        endif;     
                        ?>

                        <div class="row justify-content-md-center">
                            <div class="col-md-8">
                                <?php                                

                                global $wp;
                                $id = get_the_ID();
                                $current_url = home_url( add_query_arg( array(), $wp->request ));                                   
                                $post_type = get_post_type( $id );
                                
                                ?>

                                <form action="<?php echo esc_url( $current_url ); ?>">
                                    <div class="input-group">                                     
                                        <input class="form-control" name="s" type="text" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" placeholder="<?php esc_attr_e( 'Search...', 'eidmart' ); ?>">
                                        <input type="hidden" name="post_type" value="download">
                                        <?php if( !is_post_type_archive( 'download' )): ?><input type="hidden" name="download_cat" value="<?php echo eidmart_cat_slug_single(); ?>"><?php endif; ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-search" type="submit"><i class="las la-search"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>                       
    </div>

<?php }
add_action( 'product_search','eidmart_product_search' );


// Filter sidear
function eidmart_filter_sidebar(){ 

    $count_posts = wp_count_posts('download');
    $total_posts = $count_posts->publish;  
     
    ?>

    <div class="col-md-3">
        <div class="course-header-left-top">
            <h3><a href="<?php echo esc_url( get_post_type_archive_link('download')); ?>"><?php echo esc_html( get_theme_mod( 'refresh_filter', __( 'Refresh Filter', 'eidmart' ) ) ); ?></a></h3>
        </div>

        <div class="course-header-left">
            <div id="accordion">

                <div class="card">
                    <div class="card-header" id="headingOne">
                        <a href="#" class="icon-right" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h3><?php echo esc_html( get_theme_mod( 'archive_cat', __( 'Category', 'eidmart' ) ) ); ?></h3>
                        </a>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="category">        
                                <ul>
                                    <?php eidmart_cat_name_ark(); ?>                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <a href="#" class="icon-right" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <h3><?php echo esc_html( get_theme_mod( 'short_by', __( 'Product Type', 'eidmart' ) ) ); ?></h3>
                        </a>        
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">                   
                            <div class="filter-product">

                            <?php $checkbox_active = isset( $_GET['orderby'] ) ? $_GET['orderby'] : ''; ?>
                        
                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'popular'))); ?>"><?php esc_html_e( 'Popular','eidmart' ); ?></a>
                                <input type="checkbox" <?php  if( $checkbox_active == "popular" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'featured'))); ?>"><?php esc_html_e( 'Featured','eidmart' ); ?></a>
                                <input type="checkbox" <?php if( $checkbox_active == "featured" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'newest'))); ?>"><?php esc_html_e( 'Newest','eidmart' ); ?></a>
                                <input type="checkbox" <?php if( $checkbox_active == "newest" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'bestselling'))); ?>"><?php esc_html_e( 'Bestselling','eidmart' ); ?></a>
                                <input type="checkbox" <?php if( $checkbox_active == "bestselling" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'low_price'))); ?>"><?php esc_html_e( 'Low Price','eidmart' ); ?></a>
                                <input type="checkbox" <?php if( $checkbox_active == "low_price" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                            <label class="container">
                                <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'high_price'))); ?>"><?php esc_html_e( 'High Price','eidmart' ); ?></a>
                                <input type="checkbox" <?php if( $checkbox_active == "high_price" ): echo "checked='checked'"; endif; ?>>
                                <span class="checkmark"></span>
                            </label>

                                                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php }
add_action( 'filter_sidebr','eidmart_filter_sidebar' );


// Filter header for photography
function eidmart_photography_filter_header(){ 

    $count_posts = wp_count_posts('download');
    $total_posts = $count_posts->publish;  
     
    ?>

    <ul class="photography-cat">
        <b><?php esc_html_e( 'Categories: ', 'eidmart' ); ?></b>
        <?php
        function eidmart_photography_cat_name_ark() {
            $terms = get_terms( 'download_category' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                foreach ( $terms as $term ) { ?>
                    <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"> <?php echo esc_html( $term->name ); ?> <span>(<?php echo esc_html( $term->count ); ?>)</span></a></li>
                <?php
                }
            }                
        }
        echo eidmart_photography_cat_name_ark(); ?>

        <br><br>
        <b><?php esc_html_e( 'Filter: ', 'eidmart' ); ?></b>

        <?php $checkbox_active = isset( $_GET['orderby'] ) ? $_GET['orderby'] : ''; ?>            
        <li>
            <input type="checkbox" <?php  if( $checkbox_active == "popular" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'popular'))); ?>"><?php esc_html_e( 'Popular','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>
        <li>
            <input type="checkbox" <?php if( $checkbox_active == "newest" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'newest'))); ?>"><?php esc_html_e( 'Newest','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>
        <li>
            <input type="checkbox" <?php if( $checkbox_active == "featured" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'featured'))); ?>"><?php esc_html_e( 'Featured','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>
        <li>
            <input type="checkbox" <?php if( $checkbox_active == "bestselling" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'bestselling'))); ?>"><?php esc_html_e( 'Bestselling','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>
        <li>
            <input type="checkbox" <?php if( $checkbox_active == "low_price" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'low_price'))); ?>"><?php esc_html_e( 'Low Price','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>
        <li>
            <input type="checkbox" <?php if( $checkbox_active == "high_price" ): echo "checked='checked'"; endif; ?>>
            <a href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'high_price'))); ?>"><?php esc_html_e( 'High Price','eidmart' ); ?></a>
            <span class="checkmark"></span>
        </li>        
    </ul>

<?php }
add_action( 'photography_filter_header','eidmart_photography_filter_header' );


// Video Product search
function eidmart_video_product_search(){ ?>    
   
    <div class="main-banner product-list-banner">                
        <div class="hvrbox">
            <img src="<?php echo esc_url( get_theme_mod( 'banner_upload' ) ); ?>" alt="<?php esc_attr_e( 'Page header banner','eidmart' ); ?>" class="hvrbox-layer_bottom">
            <div class="hvrbox-layer_top">
                <div class="container">
                    <div class="overlay-text text-center"> 

                        <?php 
                        if( get_theme_mod( 'main_title' ) ):
                            echo "<h3>";
                                $count_posts = wp_count_posts('download');
                                if( get_theme_mod( 'product_count', 1 ) == 1 ): echo wp_kses( $total_posts, 'allowed_html' ); endif;
                                echo esc_html( get_theme_mod( 'main_title', __( 'WordPress Themes & Website Templates', 'eidmart' ) ) );
                            echo "</h3>";
                        endif; 
                        ?>      

                        <div class="row justify-content-md-center">
                            <div class="col-md-8">
                                <?php                                

                                global $wp;
                                $id = get_the_ID();
                                $current_url = home_url( add_query_arg( array(), $wp->request ));                                   
                                $post_type = get_post_type( $id );

                                ?>

                                <form action="<?php echo esc_url( $current_url ); ?>">
                                    <div class="input-group">                                     
                                        <input class="form-control" name="s" type="text" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" placeholder="<?php esc_attr_e( 'Search...', 'eidmart' ); ?>">
                                        <input type="hidden" name="post_type" value="download">
                                        <?php if( !is_post_type_archive( 'download' )): ?><input type="hidden" name="download_category" value="<?php echo eidmart_cat_name_single(); ?>"><?php endif; ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-search" type="submit"><i class="las la-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>                       
    </div>

<?php }
add_action( 'video_product_search','eidmart_video_product_search' );

// Top Filter Type
function eidmart_top_filter_header(){ 

    $count_posts = wp_count_posts('download');
    $total_posts = $count_posts->publish;     

    $popular = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
    $newest = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
    $featured = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
    $bestselling = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
    $low_price = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
    $high_price = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';

    $arc_url = get_post_type_archive_link( 'download' );

    $page_object = get_queried_object(); 
    $current_cat_slug = isset($page_object->slug)?$page_object->slug:'';
    
    ?>
    
    <div class="col-md-8">
        <h3 class="filter-left-style"><?php esc_html_e( 'Filter By:', 'eidmart' ); ?>
            <a href="<?php echo esc_url( $arc_url ); ?>"><?php echo esc_html( get_theme_mod( 'refresh_filter', __( 'All Products', 'eidmart' ) ) ); ?></a>
        </h3>
    </div>

    <div class="col-md-2 filter-right-style">
        <div class="form-group">
            <select class="form-control" id="sel2" onchange="location = this.value;">
               
                <?php                

                $terms = get_terms( 'download_category' ); ?>
                <option value="<?php echo esc_attr( $arc_url ); ?>" desabled><?php esc_html_e( 'Select Category', 'eidmart' ); ?></option>
                <?php 
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                    foreach ( $terms as $term ) { ?>       
                        <option value="<?php echo esc_url( get_term_link( $term ) ); ?>" <?php if( $current_cat_slug == $term->slug ): echo "selected"; endif; ?> > <?php echo esc_html( $term->name ); ?> <span>(<?php echo esc_html( $term->count ); ?>)</span> </option>  
                    <?php
                    }
                } 

                ?>

            </select>
        </div>
    </div>

    <div class="col-md-2 filter-right-style">
        <div class="form-group">
            <select class="form-control" id="sel1" onchange="location = this.value;">
                <option value="<?php echo esc_attr( $arc_url ); ?>" desabled><?php esc_html_e( 'Select Product', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'popular'))); ?>" <?php if( $popular == 'popular' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Popular Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'newest'))); ?>" <?php if( $newest == 'newest' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Newest Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'featured'))); ?>" <?php if( $featured == 'featured' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Featured Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'bestselling'))); ?>" <?php if( $newest == 'bestselling' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Bestselling Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'low_price'))); ?>" <?php if( $low_price == 'low_price' ): echo "selected"; endif; ?>><?php esc_html_e( 'Low to High', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'high_price'))); ?>" <?php if( $high_price == 'high_price' ): echo "selected"; endif; ?>><?php esc_html_e( 'High to Low', 'eidmart' ); ?></option>
            </select>
        </div>
    </div>

<?php }
add_action( 'eidmart_top_filter_header','eidmart_top_filter_header' );

/**
 * If we make archive page as home page
 * We'll use this filter
 */
function eidmart_archive_top_filter_header(){ 

    $count_posts = wp_count_posts('download');
    $total_posts = $count_posts->publish;

    $popular = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $newest = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $featured = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $bestselling = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $low_price = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $high_price = isset($_GET['orderby']) ? $_GET['orderby'] : '';

    $arc_url = get_post_type_archive_link('download');

    $page_object = get_queried_object(); 
    $current_cat_slug = isset($page_object->slug)?$page_object->slug:'';  
    
    // Shorting in home page
    global $wp_query;
    if( $wp_query->is_post_type_archive == 1 && !is_search() && !is_tax() && !isset($_GET['post_type']) ){
        $p_type = '&post_type=download';
    } else {
        $p_type = '';
    }

    if( is_tax() || isset( $_GET['post_type'] ) && !is_search() ) {
        if( !isset($_GET['download_category']) ){
            $tax_type = '&post_type=';
        } else {
            $tax_type = '';
        }
    } else {
        $tax_type = '';
    }
    
    ?>
    
    <div class="col-md-8">
        <h3 class="filter-left-style"><?php esc_html_e( 'Filter By:', 'eidmart' ); ?>
            <a href="<?php echo esc_url( $arc_url ); ?>"><?php echo esc_html( get_theme_mod( 'refresh_filter', __( 'All Products', 'eidmart' ) ) ); ?></a>
        </h3>
    </div>

    <div class="col-md-2 filter-right-style">
        <div class="form-group">
            <select class="form-control" id="sel2" onchange="location = this.value;">
               
                <?php                

                $terms = get_terms( 'download_category' ); ?>
                <option value="<?php echo esc_attr( $arc_url ); ?>" desabled><?php esc_html_e( 'Select Category', 'eidmart' ); ?></option>
                <?php 
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                    foreach ( $terms as $term ) { ?>
                        <option value="<?php echo esc_url(add_query_arg(array( 'download_category'=>$term->slug.$tax_type))); ?>" <?php if( $current_cat_slug == $term->slug ): echo "selected"; endif; ?> > <?php echo esc_html( $term->name ); ?> <span>(<?php echo esc_html( $term->count ); ?>)</span> </option>        
                    <?php
                    }
                } ?>

            </select>
        </div>
    </div>

    <div class="col-md-2 filter-right-style">
        <div class="form-group">
            <select class="form-control" id="sel1" onchange="location = this.value;">
                <option value="<?php echo esc_attr( $arc_url ); ?>" desabled><?php esc_html_e( 'Select Product', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'popular'.$p_type))); ?>" <?php if( $popular == 'popular' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Popular Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'newest'.$p_type))); ?>" <?php if( $newest == 'newest' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Newest Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'featured'.$p_type))); ?>" <?php if( $featured == 'featured' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Featured Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'bestselling'.$p_type))); ?>" <?php if( $newest == 'bestselling' ): echo "selected"; endif; ?> ><?php esc_html_e( 'Bestselling Products', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'low_price'.$p_type))); ?>" <?php if( $low_price == 'low_price' ): echo "selected"; endif; ?>><?php esc_html_e( 'Low to High', 'eidmart' ); ?></option>
                <option value="<?php echo esc_url(add_query_arg(array( 'orderby'=>'high_price'.$p_type))); ?>" <?php if( $high_price == 'high_price' ): echo "selected"; endif; ?>><?php esc_html_e( 'High to Low', 'eidmart' ); ?></option>
            </select>
        </div>
    </div>

<?php }
add_action( 'eidmart_archive_top_filter_header','eidmart_archive_top_filter_header' );

/**
 * Change WP Default Logo and url
 */
function eidmart_login_logo() { ?>
    <style type="text/css">
        #login h1 a, 
		.login h1 a {
            background-image: url( <?php echo esc_url( get_theme_mod( 'logo_upload',''.get_template_directory_uri().'/images/logo.png' ) ); ?> );
			max-width: 170px;
			margin: 0 auto 0 auto;
			width: auto;
			background-size: 100%;
            box-shadow: none
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'eidmart_login_logo' );

// Change logo url
function eidmart_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'eidmart_login_logo_url' );

// Change url title
function eidmart_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'eidmart_login_logo_url_title' );

/**
 * Change Form label
 */
add_action( 'login_head', function() {
	add_filter( 'gettext', function( $original_text, $translated_text, $text_domain ) {
		if( 'Username or Email Address' == $translated_text ) {
			$original_text = esc_html__( 'Username', 'eidmart' );
		}
		return $original_text;
	}, 10, 3 );
});

// WordPress register username validation
add_filter('validate_username' , 'eidmart_validate_username', 10, 2);
function eidmart_validate_username($valid, $username ) {
		if (preg_match("/\\s/", $username)) {
   			// there are spaces
			return $valid = false;
		}        
	return $valid;
}

/**
 * Eidmart admin notice
 */
function eidmart_admin_notice() { ?>

    <div class="notice notice-warning">
        <h2><b><?php esc_html_e( 'Eidmart Registration is Required!', 'eidmart' ); ?></b></h2>
        <p><?php printf( 'Please register your copy to work Eidmart theme perfectly. To get registered please hit the below button. <br/><br/><a class="button button-primary" href="%sthemes.php?page=eidmart">Click here to register</a>', get_admin_url() ); ?></p>
    </div>

<?php
}
if ( function_exists( 'EnvatoApi' ) && !EnvatoApi() ) { 
    add_action( 'admin_notices', 'eidmart_admin_notice' );
}

/**
 * Ajax Pagination
 */
function eidmart_ajax_pager( $query = null, $paged = 1 ) {

    if (!$query)
        return;

    $paginate = paginate_links([
        'base'      => '%_%',
        'type'      => 'array',
        'total'     => $query->max_num_pages,
        'format'    => '#page=%#%',
        'current'   => max( 1, $paged ),
        'prev_text' => esc_html__( 'Prev', 'eidmart' ),
        'next_text' => esc_html__( 'Next', 'eidmart' )
    ]);

    if ($query->max_num_pages > 1) : ?>
        <div class="col-md-12">
            <div class="course-pagination">
                <ul class="pagination">
                    <?php foreach ( $paginate as $page ) :?>
                        <li><?php echo wp_kses_post( $page ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif;
}

/***
 * Product query
 */
function eidmart_filter_products() {

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'filterObj' ) )
        die( esc_html__( 'Permission denied', 'eidmart' ));

    /**
     * Default response
     */
    $response = [
        'status'  => 500,
        'message' => esc_html__( 'Something is wrong, please try again later ...', 'eidmart' ),
        'content' => false,
        'found'   => 0
    ];

    /**
     * Collecting data from params
     */
    $tax  = sanitize_text_field($_POST['params']['tax']);
    $term = sanitize_text_field($_POST['params']['term']);
    $column = sanitize_text_field($_POST['params']['column']);
    $max_char = sanitize_text_field($_POST['params']['max_char']);
    $author = sanitize_text_field($_POST['params']['author']);
    $product_para = sanitize_text_field($_POST['params']['product_para']);
    $product_para_char = sanitize_text_field($_POST['params']['product_para_char']);
    $category = sanitize_text_field($_POST['params']['category']);
    $sale = sanitize_text_field($_POST['params']['sale']);
    $ratings = sanitize_text_field($_POST['params']['ratings']);
    $love = sanitize_text_field($_POST['params']['love']);
    $sales_con = sanitize_text_field($_POST['params']['sales']);
    $price_con = sanitize_text_field($_POST['params']['price_con']);
    $pagination_switch = sanitize_text_field($_POST['params']['pagination_switch']);
    $product_style = sanitize_text_field($_POST['params']['product_style']);
    $page = intval($_POST['params']['page']);
    $qty  = intval($_POST['params']['qty']);

    /**
     * Check if term exists
     */
    if (!term_exists( $term, $tax) && $term != 'all-terms') :
        $response = [
            'status'  => 501,
            'message' => 'Term doesn\'t exist',
            'content' => 0
        ];

        die(json_encode($response));
    endif;

    /**
     * Tax query
     */
    if ($term == 'all-terms') : 

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
            'operator' => 'NOT IN'
        ];
    else :

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
        ];
    endif;

    /**
     * Setup query
     */
    $args = [
        'paged'          => $page,
        'post_type'      => 'download',
        'post_status'    => 'publish',
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry
    ];

    $qry = new WP_Query($args);
    global $post;
    
    ob_start();

        if ($qry->have_posts()) : 
            
            // If photography masonry
            if ( $product_style == 5  ):
                echo '<div class="col-md-12 photography-filter">
                <div class="grid">
                <div class="grid-sizer"></div>';
            endif;
            
            while ($qry->have_posts()) : $qry->the_post(); 
            
            $id = get_the_ID();
            $meta = get_post_meta(get_the_ID());
            $edd_price = isset($meta['edd_price'][0]) ? $meta['edd_price'][0] : '';

            $sales = edd_get_download_sales_stats(get_the_ID());
            $sales = $sales > 1 ? __('Sales ', 'eidmart') . $sales : __('Sale ', 'eidmart') .$sales;

            // Collect downloads tearms
            $terms = get_the_terms($post->ID, 'download_category');

            // For audio version 
            $mp3_url = isset($meta['mp3_url'][0]) ? $meta['mp3_url'][0] : '';
			$mp3_artist = isset($meta['artist'][0]) ? $meta['artist'][0] : '';
            $mp3_title = html_entity_decode(get_the_title()) . uniqid();
			$mp3_title = preg_replace('/[^A-Za-z0-9\-]/', '', $mp3_title);

            // Video Version
            $internal_url = isset($meta['mp4_url'][0]) ? $meta['mp4_url'][0] : '';
            $external_url = isset($meta['external_url'][0]) ? $meta['external_url'][0] : '';
            $video_url = !empty( $external_url ) ? $external_url : $internal_url;
            $video_type = isset($meta['video_type'][0]) ? $meta['video_type'][0] : 1;
            
            // Collect user ID
            $user_id = get_the_author_meta('ID');
            // Collect user name
            $user_name = get_the_author_meta('user_login', $user_id);

            /**
             * Get all variable pricing
             */
            $prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $id ), $id );
            
            /**
             * Get checked item
             */
            $checked_key = isset( $_GET['price_option'] ) ? absint( $_GET['price_option'] ) : edd_get_default_variable_price( $id );
            $price_checked = apply_filters( 'edd_price_option_checked', $checked_key, $id );                            
            $price_checked = isset( $price_checked ) ? $price_checked: 0;

            // Variables pricing price
            $regular_amount = isset( $prices[$price_checked]['regular_amount'] ) ? $prices[$price_checked]['regular_amount']: 1;
            $sale_price = isset( $prices[$price_checked]['sale_price'] ) ? $prices[$price_checked]['sale_price']: 1;

            // Pricing options price
            $single_regular_price = get_post_meta( $id, 'edd_price', true );
            $single_sale_price = get_post_meta( $id, 'edd_sale_price', true );

            /**
             * Get the selected price of variable item
             */
            if( 1 != $checked_key ): 
                $item_price = edd_price( $id, false, $price_checked ); 
            else: 
                $item_price = edd_price( $id, false, '' ); 
            endif;

            ?>

                <?php if( $product_style == 1 ) { // Software Content ?>
                    <div class="<?php echo esc_attr( $column ); ?>">
                        <div class="single-product hover01">
                            <figure>
                                <?php the_post_thumbnail(); ?>
                            </figure>
                            <?php if (!empty(get_post_meta($post->ID, 'edd_feature_download'))): ?>
                                <span class="sticker-feature" data-toggle="tooltip" data-placement="right" title="<?php esc_html_e('Featured', 'eidmart');?>"><i class="las la-gem"></i></span>
                            <?php endif;

                            /**
                             * Discount percentage calculation 
                             * @ edd_has_variable_prices( $id )
                             */
                            if( $sale_price && edd_has_variable_prices( $id ) ):
                                $discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
                            elseif( $single_sale_price ):
                                $discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
                            else:
                                $discount_percent = 0;
                            endif;

                            /**
                             * Discount Percentage
                             */
                            if( $discount_percent > 0 ):
                            ?>
                            <p class="discount-percentage">
                                <span><?php echo esc_html( $discount_percent ); ?>%</span>
                                <?php esc_html_e( 'Off', 'eidmart' ); ?>
                            </p>
                            <?php endif; ?>

                            <div class="product-details">
                                <div class="product-content">
                                    <a href="<?php the_permalink(); ?>"><?php echo eidmart_excerpt_char_course_title( $max_char ); ?></a>

                                    <?php
                                    // Collect user ID
                                    $user_id = get_the_author_meta( 'ID' ); 
                                    // Collect user name
                                    $user_name = get_the_author_meta( 'user_login' , $user_id );
                                
                                    if( $author == 'on' || $category == 'on' ): ?>
                                    <p> 
                                        <?php 
                                        if( $author == 'on' ):
                                        esc_html_e( 'by', 'eidmart' ); ?> <a href="<?php if( !class_exists( 'EDD_Front_End_Submissions' ) ){ echo esc_url( home_url( 'profile/' ) ); ?>?user=<?php echo esc_attr( $user_name ); } else { echo esc_url( eidmart_edd_fes_author_url() ); } ?>"> <?php the_author(); ?></a> 
                                        
                                        <?php 
                                        endif;

                                        if( $category == 'on' ):
                                            esc_html_e( 'in', 'eidmart' ); ?>
                                            <?php
                                            $terms = get_the_terms( $id , 'download_category' );
                                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { ?>                                
                                                    <a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?></a> 
                                                <?php
                                            }
                                        endif;
                                        ?>
                                    </p>
                                    <?php else: ?>
                                        <div class="padding-top-very-small"></div>
                                    <?php endif; 

                                    // Check product paragraph
                                    if( $product_para == 'on' ): ?>
                                        <p class="product-paragraph"><?php if ( has_excerpt() ): echo get_the_excerpt(); else: echo eidmart_excerpt_char( $product_para_char ); endif; ?></p>
                                    <?php endif; ?>

                                    <h3 class="<?php if ( $sale != 'on'): echo esc_attr( "price-n-preview" ); endif; ?>">
                                        <?php if ( $price_con == 'on' ): ?><strong><?php if( $edd_price ): echo wp_kses_post( $item_price ); else: echo __( 'Free','eidmart' ); endif; ?></strong><?php endif; ?>
                                        <span class="cart-btn">
                                            <?php if( $edd_price ){ ?>
                                                <?php if( get_post_meta( $post->ID, 'cart_bt_url',true) ): ?><a href="<?php echo esc_url( get_post_meta( $post->ID, 'cart_bt_url',true) ); ?>"><i class="las la-shopping-cart"></i></a><?php endif; ?>
                                            <?php } else { ?>
                                                <?php if( get_post_meta( $post->ID, 'cart_bt_url',true) ): ?><a href="<?php echo esc_url( get_post_meta( $post->ID, 'cart_bt_url',true) ); ?>"><i class="las la-cloud-download-alt"></i></a><?php endif; ?>
                                            <?php } ?>
                                            <?php if( get_post_meta( $post->ID, 'preview_text',true) ): ?><a  target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'preview_url',true) ); ?>" class="btn-bordered"> <?php echo esc_html( get_post_meta( $post->ID, 'preview_text',true) ); ?> </a><?php endif; ?>
                                        </span>                                
                                    </h3>
                                </div>

                                <?php if ( $sale =='on'): ?>
                                <div class="product-content-footer">
                                    <h4>

                                    <?php
                                    if (class_exists('EDD_Reviews') && $ratings == 'on') {
                                        echo "<span class='bt-review'>";
                                        $mreview = new \EDD_Reviews;                                        

                                        $rating = $mreview->average_rating(false);
                                        echo wp_kses_post( $mreview->render_star_rating( $rating ) );
                                        echo esc_html( $mreview->display_total_reviews_count() );

                                        echo "</span>";
                                    } // End ratings check

                                    if ($love == 'on'):
                                    ?>
                                    <span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span> 

                                    <?php endif; if ($sales_con == 'on'): 
                                        echo "<span>".esc_html( $sales )."</span>";
                                    endif;
                                    ?>

                                    </h4>
                                </div> 
                                <?php endif; ?>

                            </div>
                        </div> 
                    </div> 
                <?php } else if( $product_style == 2 ) { // Graphics Content ?>
                    <div class="<?php echo esc_attr( $column ); ?>">
                        <div class="single-product">                  
                            <div class="graphicland-product-container">                               
                                <div class="product-content">
                                    <a href="<?php the_permalink(); ?>" target="_blank">
                                        <div class="content-overlay"></div>

                                        <?php the_post_thumbnail( '', [ 'class' => 'graphicland-image' ] ); ?>
                                    
                                        <div class="overlay-center">
                                            <?php if( get_post_meta( $post->ID, 'preview_url',true ) ): ?>
                                            <div class="graphicland-live-preview">
                                                <?php if( get_post_meta( $post->ID, 'preview_url',true) ): ?><a  target="_blank" href="<?php echo esc_url( get_post_meta( $post->ID, 'preview_url',true) ); ?>"> <i class="las la-eye"></i> </a><?php endif; ?>
                                            </div>
                                            <?php endif; if ($love == 'on'): ?>
                                            <div class="graphicland-favourite-icon">
                                                <?php echo eidmart_get_likes_button( get_the_ID() ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>                                
                                    </a>
                                </div>
                            </div>
                        
                            <?php if( !empty( get_post_meta( $post->ID, 'edd_feature_download' ) ) ): ?>
                                <span class="sticker-feature"><i class="fa fa-gitlab"></i></span>
                            <?php endif; 

                            /**
                             * Discount percentage calculation
                             */
                            if( $sale_price && edd_has_variable_prices( $id ) ):
                                $discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
                            elseif( $single_sale_price ):
                                $discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
                            else:
                                $discount_percent = 0;
                            endif;

                            /**
                             * Discount Percentage
                             */
                            if( $discount_percent > 0 ):
                            ?>
                            <p class="discount-percentage">
                                <span><?php echo esc_html( $discount_percent ); ?>%</span>
                                <?php esc_html_e( 'Off', 'eidmart' ); ?>
                            </p>
                            <?php endif; ?>

                            <div class="product-details graphicland-product-details">
                                <div class="product-content">

                                    <div class="product-details graphicland-product-details">                                       
                                        <h3 class="content-title" ><a href="<?php the_permalink(); ?>"><?php echo eidmart_excerpt_char_course_title( $max_char ); ?></a> <?php if( $price_con == 'on' ): ?><strong><?php if( $edd_price ): echo wp_kses_post( $item_price ); else: echo __( 'Free','eidmart' ); endif; ?></strong><?php endif; ?></h3>
                                    </div>
                                    
                                    <?php

                                    // Collect user ID
                                    $user_id = get_the_author_meta( 'ID' ); 
                                    // Collect user name
                                    $user_name = get_the_author_meta( 'user_login' , $user_id );

                                    echo "<p>"; 
                                        if( $author =='on' || $category =='on' ):                                            
                                            echo "<span>";
                                                if( $author =='on' ):
                                                echo get_avatar( $user_id, 20, '' , '' , array( 'class' => array( 'vendor-avatar' ) ) ); ?> <a href="<?php if( !class_exists( 'EDD_Front_End_Submissions' ) ){ echo esc_url( home_url( 'profile/' ) ); ?>?user=<?php echo esc_attr( $user_name ); } else { echo esc_url( eidmart_edd_fes_author_url() ); } ?>"> <?php the_author(); ?></a> 
                                                
                                                <?php 
                                                endif;
                                                if( $category =='on' ):
                                                esc_html_e( 'in', 'eidmart' ); ?>
                                                <?php
                                                    $terms = get_the_terms( $id , 'download_category' );
                                                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                                        //foreach ( $terms as $term ) {
                                                            ?>
                                                
                                                            <a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>"><?php echo esc_html( $terms[0]->name ); ?></a> 

                                                            <?php                             
                                                    // }
                                                    }
                                                endif;
                                            echo "</span>";
                                        endif; // End author and category

                                        if (class_exists('EDD_Reviews') && $ratings == 'on') {
                                            echo "<span class='bt-review'>";

                                                $mreview = new \EDD_Reviews;
                                                $rating = $mreview->average_rating(false);
                                                echo wp_kses_post( $mreview->render_star_rating( $rating ) );
                                                echo '('. esc_html( $mreview->count_reviews() ).')';

                                            echo "</span>";
                                        } // End ratings check 
                                        if ($sales_con == 'on'): 
                                            echo "<span>".esc_html( $sales )."</span>";
                                        endif;
                                        ?>
                                    </p>                                  

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else if( $product_style == 3 ) { // Audio Content ?>
                    <div class="<?php echo esc_attr( $column ); ?>">
                        <div class="single-product">
                            <a href="javascript:void(0);" class="album-poster <?php echo esc_attr($mp3_title); ?>" data-uniqid="<?php echo esc_attr($mp3_title); ?>" data-switch="0" data-price='<?php if ($edd_price): echo wp_kses_post( $item_price ); else: esc_html_e('Free', 'eidmart'); endif; ?>' data-title='<?php the_title();?>' data-artist="<?php echo esc_attr($mp3_artist); ?>" data-mp3="<?php echo esc_attr($mp3_url); ?>" data-pid="<?php echo esc_attr($id); ?>" data-cover="<?php the_post_thumbnail_url();?>">
                                <?php the_post_thumbnail();?>
                                <div class="player-icon">
                                    <i class="las la-play"></i>
                                    <i class="las la-pause"></i>
                                </div>
                            </a>

                            <?php if( !empty( get_post_meta( $post->ID, 'edd_feature_download' ) ) ): ?>
                                <span class="sticker-feature"><i class="fa fa-gitlab"></i></span>
                            <?php endif; 

                            /**
                             * Discount percentage calculation
                             */
                            if( $sale_price && edd_has_variable_prices( $id ) ):
                                $discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
                            elseif( $single_sale_price ):
                                $discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
                            else:
                                $discount_percent = 0;
                            endif;

                            /**
                             * Discount Percentage
                             */
                            if( $discount_percent > 0 ):
                            ?>
                            <p class="discount-percentage">
                                <span><?php echo esc_html( $discount_percent ); ?>%</span>
                                <?php esc_html_e( 'Off', 'eidmart' ); ?>
                            </p>
                            <?php endif; ?>

                            <div class="product-content">
                                <div class="audio-title">
                                    <a href="<?php the_permalink();?>"><?php echo eidmart_excerpt_char_course_title($max_char); ?></a>
                                </div>
                                <?php if( $price_con == 'on' ): ?><div class="price"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart');endif;?></div><?php endif; ?>
                            </div>                            

                            <?php

                            echo "<div class='auth-info'>"; 
                                if( $author =='on' || $category =='on' ):                                            
                                    echo "<span>";
                                        if( $author =='on' ):
                                        
                                        // Author picture show
                                        //echo get_avatar( get_the_author_meta('ID'), '40', '' , '' , array( 'class' => array( 'vendor-pic' ) ) );
                                        esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

                                        <?php 
                                        endif;
                                        if( $category =='on' ):
                                            esc_html_e( 'in', 'eidmart' ); 
                                            $terms = get_the_terms($id, 'download_category');
                                            if (!empty($terms) && !is_wp_error($terms)) { ?>
                                                <a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
                                            <?php
                                            }
                                        endif;
                                    echo "</span>";
                                endif; // End author and category

                                if (class_exists('EDD_Reviews') && $ratings == 'on') {
                                    echo "<span class='bt-review'>";

                                        $mreview = new \EDD_Reviews;
                                        $rating = $mreview->average_rating(false);
                                        echo wp_kses_post( $mreview->render_star_rating( $rating ) );
                                        echo '('. esc_html( $mreview->count_reviews() ) .')';

                                    echo "</span>";
                                } // End ratings check 
                                if ($sales_con == 'on'): 
                                    echo "<span>".esc_html( $sales )."</span>";
                                endif;
                                ?>
                            </div>

                        </div>
                    </div>
                <?php } else if( $product_style == 4 ) { // Video Content                     
                     ?>
                    <div class="<?php echo esc_attr( $column ); ?> photography-filter-item">
                        <div class="load-more">
                        
                            <a class="photography-item_url" href="<?php the_permalink();?>">
                            <?php if( $video_url ): 
                                
                                // Check video type
                                if( $video_type == 1 ){ ?>

                                    <video <?php if( get_theme_mod( 'video_sound' ) == 1 ): echo "muted"; endif; ?> class="hvrbox-layer_bottom video-control" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
                                        <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                                        <?php esc_html_e( 'Your browser does not support HTML5 video.', 'eidmart' ); ?>
                                    </video>

                                <?php } else { ?>

                                    <!-- 16:9 aspect ratio -->
                                    <div class="embed-responsive embed-responsive-16by9" style="height: <?php echo esc_attr( get_theme_mod( 'video_height', 210 ) );?>px">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_url ); ?>?rel=0&controls=0&modestbranding=1&showinfo=0" allowfullscreen frameborder="0""></iframe>
                                    </div>

                                <?php } endif; ?>
                            </a>

                            <?php
                            /**
                             * Discount percentage calculation
                             */
                            if( $sale_price && edd_has_variable_prices( $id ) ):
                                $discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
                            elseif( $single_sale_price ):
                                $discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
                            else:
                                $discount_percent = 0;
                            endif;

                            /**
                             * Discount Percentage
                             */
                            if( $discount_percent > 0 ):
                            ?>
                            <p class="discount-percentage">
                                <span><?php echo esc_html( $discount_percent ); ?>%</span>
                                <?php esc_html_e( 'Off', 'eidmart' ); ?>
                            </p>
                            <?php endif; 
                            
                            if ( $love == 'on' ): ?>
                                <div class="image-rating">
                                    <span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span>
                                </div>
                            <?php endif; if ( $price_con == 'on' ): ?>
                                <span class="sale"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart'); endif; ?></span>
                            <?php endif;

                            echo "<div class='auth-info'>"; 
                                if( $author =='on' || $category =='on' ):                                            
                                    echo "<span>";
                                        if( $author =='on' ):
                                        
                                        // Author picture show
                                        echo get_avatar(get_the_author_meta('ID'), '40', '', '', array('class' => array('vendor-pic')));
                                        esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

                                        <?php 
                                        endif;

                                        if ( $category == 'on' ):                                    
                                            esc_html_e('in', 'eidmart');                                                
                                            $terms = get_the_terms($id, 'download_category');
                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                //foreach ( $terms as $term ) {
                                                ?>
                                                    <a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
                                                    <?php if( $video_type == 2 && get_theme_mod( 'youtube_btn' ) ): ?>
                                                    <a class="btn-hover color-11" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'youtube_btn', 'Read more' ) ); ?></a>
                                                <?php
                                            endif; // End video type checking
                                            //}
                                            }
                                        endif;                                    
                                    echo "</span>";
                                endif; // End author and category

                                if (class_exists('EDD_Reviews') && $ratings == 'on') {
                                    echo "<span class='bt-review'>";

                                        $mreview = new \EDD_Reviews;
                                        $rating = $mreview->average_rating(false);
                                        echo wp_kses_post ( $mreview->render_star_rating( $rating ) );
                                        echo '('. esc_html( $mreview->count_reviews() ) .')';

                                    echo "</span>";
                                } // End ratings check 
                                if ($sales_con == 'on'): 
                                    echo "<span>".esc_html( $sales )."</span>";
                                endif;
                                ?>
                            </div>


                        </div>
                    </div>
                <?php } else if( $product_style == 5 ) { // Photograhy Content                     
                     ?>
                    <div class="grid-item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="img-gradient">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </a>

                        <?php
                        /**
                         * Discount percentage calculation
                         */
                        if( $sale_price && edd_has_variable_prices( $id ) ):
                            $discount_percent = intval( 100 * ( $regular_amount - $sale_price ) / $regular_amount );
                        elseif( $single_sale_price ):
                            $discount_percent = intval( 100 * ( $single_regular_price - $single_sale_price ) / $single_regular_price );
                        else:
                            $discount_percent = 0;
                        endif;

                        /**
                         * Discount Percentage
                         */
                        if( $discount_percent > 0 ):
                        ?>
                        <p class="discount-percentage">
                            <span><?php echo esc_html( $discount_percent ); ?>%</span>
                            <?php esc_html_e( 'Off', 'eidmart' ); ?>
                        </p>
                        <?php endif; 
                        
                        if ( $love == 'on' ): ?>
                            <div class="image-rating">
                                <span><i><?php echo eidmart_get_likes_button(get_the_ID()); ?></i></span>
                            </div>
                        <?php endif; if ( $price_con == 'on' ): ?>
                            <span class="sale"><?php if ($edd_price): echo wp_kses_post( $item_price ); else: echo __('Free', 'eidmart'); endif; ?></span>
                        <?php endif;                        

                        echo "<div class='auth-info'>"; 
                            if( $author =='on' || $category =='on' ):                                            
                                echo "<span>";
                                    if( $author =='on' ):
                                    
                                    // Author picture show
                                    echo get_avatar(get_the_author_meta('ID'), '40', '', '', array('class' => array('vendor-pic')));
                                    esc_html_e('by', 'eidmart');?> <a href="<?php if (!class_exists('EDD_Front_End_Submissions')) {echo esc_url(home_url('profile/'));?>?user=<?php echo esc_attr($user_name);} else {echo esc_url(eidmart_edd_fes_author_url());} ?>"> <?php the_author();?></a>

                                    <?php 
                                    endif;

                                    if ( $category == 'on' ):                                    
                                        esc_html_e('in', 'eidmart');                                                
                                        $terms = get_the_terms($id, 'download_category');
                                        if (!empty($terms) && !is_wp_error($terms)) {
                                            //foreach ( $terms as $term ) {
                                            ?>
                                                <a href="<?php echo esc_url(get_term_link($terms[0])); ?>"><?php echo esc_html($terms[0]->name); ?></a>
                                            <?php
                                        //}
                                        }
                                    endif;                                    
                                echo "</span>";
                            endif; // End author and category

                            if (class_exists('EDD_Reviews') && $ratings == 'on') {
                                echo "<span class='bt-review'>";

                                    $mreview = new \EDD_Reviews;
                                    $rating = $mreview->average_rating(false);
                                    echo wp_kses_post( $mreview->render_star_rating( $rating ) );
                                    echo '('. esc_html( $mreview->count_reviews() ) .')';

                                echo "</span>";
                            } // End ratings check 
                            if ($sales_con == 'on'): 
                                echo "<span>".esc_html( $sales )."</span>";
                            endif;
                            ?>
                        </div>

                    </div>
                <?php } ?>            

            <?php endwhile;  /* If photography masonry */ if( $product_style == 5  ): echo "</div></div>"; endif;

            /**
             * Pagination
             */
            if( $pagination_switch == 'on' ):
                eidmart_ajax_pager($qry,$page);
            endif;

            $response = [
                'status'=> 200,
                'found' => $qry->found_posts
            ];
            
        else :

            $response = [
                'status'  => 201,
                'message' => 'No posts found'
            ];

        endif;

    $response['content'] = ob_get_clean();

    die(json_encode($response));

}
add_action('wp_ajax_do_filter_products', 'eidmart_filter_products');
add_action('wp_ajax_nopriv_do_filter_products', 'eidmart_filter_products');

/**
 * Aassets
 */
function eidmart_ajax_assets() {
    wp_enqueue_script('eidmart-filter', get_template_directory_uri() . '/js/sieve.js', ['jquery'], null, true);
    wp_localize_script( 'eidmart-filter', 'filterObj', array(
        'nonce'    => wp_create_nonce( 'filterObj' ),
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'eidmart_ajax_assets', 100 );

/**
 * Outputs the description
 * @since 1.0.2
 */
function eidmart_price_extra_field_output( $key, $price, $download_id ) {

	$title = isset( $price['title'] ) ? $price['title'] : null;
	$description = isset( $price['description'] ) ? $price['description'] : null;
	if( $description ): echo '<p class="edd-variable-pricing-description">' . esc_html( $description ) . '</p>'; endif;
	if( $title ): echo '<h3 class="edd-variable-pricing-title">' . esc_html( $title ) . '</h3>'; endif;

}
add_action( 'edd_after_price_option', 'eidmart_price_extra_field_output', 10, 3 );

/**
 * Adds the table cell with title input field
 *
 * @since 1.0
 */
function eidmart_download_price_table_row( $post_id, $key, $args ) {
	$title = isset($args['title']) ? $args['title'] : null;
	$description = isset($args['description']) ? $args['description'] : null;
?>

	<div class="edd-custom-price-option-section">
		<span class="edd-custom-price-option-section-title"><?php echo esc_html__( 'Option Divider Title', 'eidmart' ); ?></span>
		<input type="text" class="edd_variable_prices_description" value="<?php echo esc_attr( $title ); ?>" name="edd_variable_prices[<?php echo esc_attr( $key ); ?>][title]" id="edd_variable_prices[<?php echo esc_attr( $key ); ?>][title]" />
	</div>
	<div class="edd-custom-price-option-section">
		<span class="edd-custom-price-option-section-title"><?php echo esc_html__( 'Option Descrition', 'eidmart' ); ?></span>
		<input type="text" class="edd_variable_prices_name large-text" value="<?php echo esc_attr( $description ); ?>" name="edd_variable_prices[<?php echo esc_attr( $key ); ?>][description]" id="edd_variable_prices[<?php echo esc_attr( $key ); ?>][description]" />
	</div>

<?php }
add_action( 'edd_download_price_option_row', 'eidmart_download_price_table_row', 10, 3 );

/**
 * Add title field to edd_price_row_args
 *
 * @since 1.0
 */
function eidmart_price_row_args( $args, $value ) {

	$args['title'] = isset( $value['title'] ) ? $value['title'] : '';
	$args['description'] = isset( $value['description'] ) ? $value['description'] : '';

	return $args;

}
add_filter( 'edd_price_row_args', 'eidmart_price_row_args', 10, 2 );


if ( get_theme_mod( 'img_compress' ) == 0 ) {
    add_filter('jpeg_quality', function( $arg ){
        return 100;
    });
    add_filter( 'wp_editor_set_quality', function( $arg ){
        return 100;
    });
    add_filter( 'big_image_size_threshold', '__return_false' );
}

// Custom styling options
function eidmart_color_styles_method() {
    
    wp_enqueue_style(
        'eidmart-default',
        get_template_directory_uri() . '/css/color/default.css'
    );

    // Color
    $primary = get_theme_mod( 'primary', '#6caf17' );  // #6caf17
    $primary_hover = get_theme_mod( 'primary_hover', '#549006' );  // #549006
    $secondary = get_theme_mod( 'secondary', '#ffb307' );  // #ffb307
    $secondary_hover = get_theme_mod( 'secondary_hover', '#C98C00' );  // #C98C00
    
    // Fonts
    $primary_font_family = get_theme_mod( "primary_font_family", "'Open Sans', sans-serif;" );  
    $secondary_font_family = get_theme_mod( "secondary_font_family", "'Roboto', sans-serif;" );  
    
    $custom_css = " 
   
    /************************************************************************************
    Default Color
    Color Primary: #6caf17;
    Color Primary Hover: #549006;
    Color Secondary: #ffb307;
    Color Secondary Hover: #C98C00;
    ************************************************************************************/

    /*Reset Css*/

    ::-moz-selection {
    background: {$primary};
    }
    ::selection {
    background: {$primary};
    }
    button:hover,
    input[type='button']:hover,
    input[type='reset']:hover,
    input[type='submit']:hover {
    border-color: {$primary_hover}; 
    }
    div.bootstrap-iso select.form-control:focus,
    div.bootstrap-iso input.form-control:focus,
    .main-banner.log-reg .overlay-text input[type='text']:focus,
    input[type='text']:focus,
    input[type='email']:focus,
    input[type='url']:focus,
    input[type='password']:focus,
    input[type='search']:focus,
    input[type='number']:focus,
    input[type='tel']:focus,
    input[type='range']:focus,
    input[type='date']:focus,
    input[type='month']:focus,
    input[type='week']:focus,
    input[type='time']:focus,
    input[type='datetime']:focus,
    input[type='datetime-local']:focus,
    input[type='color']:focus,
    textarea:focus,
    textarea.form-control:focus {
        border-color: {$primary} !important;
        box-shadow: 0 0px 0px {$primary} inset, 0 0 0px {$primary} !important; 
    }
    a:hover,
    a:focus,
    a:active {
        color: {$primary_hover};
    }
    /*---------------------------- End of Reset Code ----------------*/

    /*============ background =======================================================================*/
    button, 
    input[type='button'], 
    input[type='reset'], 
    input[type='submit'],

    div.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list > li.current_page_parent > a, 
    div.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list > li.current_page_item > a, 
    div.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list > li.current_page_ancestor > a,

    button.fes-ignore.fes-ignore-comments-form-submit-button.button, 
    button.fes-cmt-submit-form.fes-comments-form-submit-button.button, 
    a.fes-avatar-image-btn.edd-submit.button, 
    a.fes-feat-image-btn.edd-submit.button, 
    a#multiple, 
    a.edd-submit.button.upload_file_button, 
    .fes-vendor-contact-form div.fes-form .fes-submit input[type=submit], 
    .fes-login-form div.fes-form .fes-submit input[type=submit], 
    .fes-registration-form div.fes-form .fes-submit input[type=submit], 
    #edd-purchase-button, 
    .edd-submit, 
    [type=submit].edd-submit, 
    a.edd-add-to-cart, 
    a.edd-submit.button.blue, 
    .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,

    .btn-hover.color-primary,
    .search-dropdown-menu .btn.btn-search,
    .faqs-1x .single-faq .card-header.request-button a.accordion-toggle.collapsed,
    .bbpress .widget dd,
    .page-content button.btn.btn-search, 
    .widget button.btn.btn-search,
    .product-description-1x .product-description-left .product-description-tab .tab-content .authors-review .media .media-body h3 b,
    .ColorSwitcher__control,
    .comming-soon-banner .overlay-text .footer-social-link ul li i,
    .events-1x .events-single b,
    .blog-list-1x .blog-list-right .blog-subscriber .btn-search,
    .blog-list-1x .blog-list-right .blog-search .btn-search,
    .blog-list-1x .blog-list-single span.blog-date,
    .features-description-2x .single-description .btn-bordered,
    .testimonial-section-2x ul.slick-dots li.slick-active button,
    .about-banner .overlay-text a.btn-circle,
    .main-menu-green,
    .latest-product-1x .latest-product-title-right .course-menu button.active,
    .footer-subscriber button.btn-subscriber,
    .footer-section-1x .footer-top .footer-top-left .footer-subscriber button.btn-subscriber,
    .main-banner .overlay-text button.btn.btn-search,
    .sign-in span sup,
    a.btn-ellips,
    a.btn-small,
    a.btn-large,
    .is-sticky .sign-in span sup,
    a.subscription-toggle,
    .active-sticker,
    .pricing-plan-1x .single-pricing.active .btn-bordered {
        background: {$primary};
    }

    /***** Background hover *****/
    .btn-hover.color-primary:hover,
    button, input[type='button']:hover, 
    input[type='reset']:hover, 
    input[type='submit']:hover,  
    .edd-submit:hover, 
    [type=submit].edd-submit:hover, 
    button.fes-ignore.fes-ignore-comments-form-submit-button.button:hover, 
    button.fes-cmt-submit-form.fes-comments-form-submit-button.button:hover, 
    a.fes-feat-image-btn.edd-submit.button:hover, 
    a#multiple:hover, 
    .fes-vendor-contact-form div.fes-form .fes-submit input[type=submit]:hover, 
    .fes-login-form div.fes-form .fes-submit input[type=submit]:hover, 
    .fes-registration-form div.fes-form .fes-submit input[type=submit]:hover, 
    a.edd-submit.button.upload_file_button:hover, 
    #edd-purchase-button:hover, 
    a.edd-add-to-cart:hover, 
    a.edd-submit.button.blue:hover, 
    .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,
    a.btn-small:focus,
    a.btn-small:hover,
    .backtotop:hover,
    .author-profile-banner.author-profile-banner-2x .sale-price-info ul a.btn-large:hover,
    .violet-cta .cta-right .btn-large:hover,
    .about-us-3x .about-us-left .btn-bordered:hover,
    .events-1x .events-single .events-single-content a.btn-small:hover,
    .blog-list-1x .blog-list-right .tag-link a:hover,
    .blog-list-1x .blog-list-single .blog-list-content .blog-footer a.btn-small:hover,
    .job-board-1x .single-job a:hover,
    .product-description-1x .product-description-left .image-bottom a.btn-small:hover,
    .course-grid-list .media:hover .product-content h3 a.btn-bordered,
    .latest-product-1x .latest-product-title-right .course-menu button:hover,
    .cta-1x .cta-right .btn-large:hover,
    a.edd-submit.button.blue.active, 
    a.edd-submit.button.blue:focus,
    .sign-in .cart-dropdown-menu ul li a.btn-large:hover,
    .sign-in .cart-dropdown-menu ul li:hover a.btn-large:hover,
    a.btn-large:hover,
    a.btn-bordered:hover {
        background: {$primary_hover};
    }

    /*=============== color =============================================================================*/
    .article-child.well ul.children li:hover:before,
    .wedocs-shortcode-wrap ul.wedocs-docs-list ul.wedocs-doc-sections li:hover:before,
    div.wedocs-shortcode-wrap ul.wedocs-docs-list ul.wedocs-doc-sections,
    div.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list li:hover ul.children a,

    .contact-info .info-adress b,
    .single-product:hover .product-details.graphicland-product-details .content-title a,
    .single-product .product-details.graphicland-product-details .content-title strong,
    .graphicland-one .single-product .product-details.graphicland-product-details .content-title strong,
    .faqs-1x .single-faq .card-header .accordion-toggle.collapsed:after,
    .price-box .edd_price_options input[type='radio']:checked+span:before, 
    .price-box .edd_price_options input[type='checkbox']:checked+span:before,
    .graphicland-demo.graphicland-woo .graphicland-feature ul li::before,
    .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover,
    .product-description-right .purchase-comments h2 i,
    .product-management .nav-tabs .nav-item.show .nav-link, 
    .product-management .nav-tabs .nav-link:hover, 
    .product-management .nav-tabs .nav-link.active,
    .testimonial-section-1x .single-slide h3,
    .footer-bottom p a,
    .product-management .nav-tabs .nav-item.show .nav-link, 
    .product-management .nav-tabs .nav-link:hover, 
    .product-management .nav-tabs .nav-link.active,
    .main-banner.log-reg .overlay-text p b,
    .log-reg #edd_login_form legend, 
    .log-reg #edd_register_form legend,
    .price-box .edd_price_options input[type='radio']:not(:disabled)+span:hover:before, 
    .price-box .edd_price_options input[type='checkbox']:not(:disabled)+span:hover:before,
    .graphicland-one .single-product .product-details .product-content p a:hover,
    a .doc-block:hover h3,
    .navbar-light .navbar-nav .active > .nav-link,
    .latest-product-1x.photography-filter .latest-product-title-right .course-menu button.active,
    .latest-product-1x.photography-filter .latest-product-title-right .course-menu button:hover,
    .team-members-left a:hover,
    .blog-content a:hover,

    .main-menu-1x.main-menu-6x .sign-in a:hover,
    .author-profile-banner.author-profile-banner-2x .sale-price-info ul a.btn-small:hover,
    .author-profile-banner.author-profile-banner-2x .sale-price-info ul a.btn-large,
    .author-profile-banner.author-profile-banner-2x .sale-price-info ul .item-price h2 span,
    .product-single-banner .product-banner-right h3 i,
    .main-menu-1x.main-menu-6x .main-menu .navbar-nav .nav-link:hover,
    .main-menu-1x.main-menu-6x .navbar-light .navbar-nav .active > .nav-link,
    .service-3x .single-service:hover a,
    .featured-product-single-8 .media h4 a:hover,
    .single-featured-product:hover a.prod-title,
    .single-featured-product .featured-content a.prod-title:hover,
    .single-featured-product .featured-content h3 span,
    .featured-product-single-8 .media .media-body a.prod-title:hover,
    .testimonial-section-3x .single-testimonial i,
    .featured-product-single-8 .media .media-body h2,
    .service-3x .single-service a:hover,
    .blog-single-1x .blog-single-left-content .comment-section .media .media-body h5.author-meta,
    .photography.footer-section-1x .footer-top .footer-top-left .single-link ul li a:hover,

    .btco-hover-menu .active a, .btco-hover-menu .active a:focus, 
    .btco-hover-menu .active a:hover, .btco-hover-menu li a:hover, 
    .comment-section .media .media-body h5 span a,
    .comment-section .media .media-body h5,
    .checkout-page-1x .order-info ul li a,
    .cart-page-1x .cart-page-content .table td a,
    .cart-page-1x .cart-page-content .table th .media .media-body a:hover,
    .sign-in .cart-dropdown-menu ul li .media .media-body h3,
    .sign-in .cart-dropdown-menu ul li .media .media-body h4 a:hover,
    .error-page .error-page-content span,
    .btco-hover-menu .sign-in .media-dropdown-menu ul li:hover a,
    .product-description-1x .product-description-left .product-description-tab .tab-content .author-downloads a,
    .main-menu-white .navbar-light .navbar-nav .nav-link:hover,
    .main-menu-white .navbar-light .navbar-nav .active > .nav-link,
    .about-us-3x .about-us-left .btn-bordered,
    .about-us-3x .about-us-left a.btn-small:hover,
    .about-us-3x .about-us-left h2 span,
    .events-1x .events-single .events-single-content a.btn-small,
    .events-1x .events-single .events-single-content a:hover,
    .events-banner .overlay-text .countdown-timer ul li:nth-child(1),
    .events-banner .overlay-text h4,
    .blog-1x .blog-single .blog-single-content a:hover,
    .blog-single-1x .blog-single-left-content .comment-section .media .media-body h5 span a,
    .blog-single-1x .blog-single-left-content .comment-section .media .media-body h5,
    .blog-list-1x .blog-list-right .category-link ul li a:hover,
    .blog-list-1x .blog-list-right .recent-popular-post .recent-popular-tab .recent-post .media a:hover,
    .blog-list-1x .blog-list-right .recent-popular-post ul.recent-popular-nav li .active,
    .blog-list-1x .blog-list-single .blog-list-content .blog-footer .dropright button i,
    .blog-list-1x .blog-list-single .blog-list-content .blog-footer a.btn-small,
    .blog-list-1x .blog-list-single .blog-list-content h2 a:hover,
    .job-single-1x .job-features i,
    .job-board-1x .single-job a,
    .job-board-1x .single-job p i,
    .job-board-1x .single-job h2 span,
    .sign-in-1x .sign-in-form h4 a,
    .sign-in-1x .sign-in-form ul li a:hover,
    .features-description-2x .single-description .btn-bordered:hover,
    .features-description-2x .single-description h2 span,
    .testimonial-section-2x .slider-content p i,
    .about-us-2x .about-us-left h2 span,
    .course-header-1x .course-header-left .category ul li a:hover,
    .course-header-1x .course-header-right .course-tab .nav-tabs .nav-link.active,
    .product-description-1x .product-description-right .product-features ul li span a,
    .product-description-1x .product-description-right .purchase-comments a i,
    .product-description-1x .product-description-left .product-description-tab .nav-tabs .nav-link.active,
    .social-link ul li:hover i,
    .counter-section-2x .color-green span,
    .course-grid-list .media:hover .product-content a,
    .course-grid-list .media .media-body .product-content h3 span .btn-bordered,
    .course-grid-list .media .media-body .product-content a:hover,
    .single-product:hover .product-content a,
    .single-product .product-details .product-content h3 span .btn-bordered,
    .single-product .product-details .product-content a:hover,
    .footer-section-1x .footer-top .footer-top-right .footer-social-link ul li:hover i,
    .footer-section-1x .footer-top .footer-top-right ul li,
    .cta-1x .cta-right .btn-large,
    .main-menu-green .btco-hover-menu .collapse ul > li:hover > a.dropdown-item,
    .btco-hover-menu .collapse ul > li:hover > a.dropdown-item,
    .sign-in .media-dropdown .media .media-body h3,
    .popular-tag-search.dark ul.esearch-tags li a:hover,
    .service-3x.audio-service.dark .single-service a:hover,
    .audio-version .album-poster:hover .product-content .audio-title a,
    .audio-version .without-album-poster:hover .product-content .audio-title a,
    .audio-version.dark-audio-filter .single-product:hover .product-content .audio-title a,
    a.btn-bordered,
    .mega-menu-wrapper .menu-single-item a:hover,
    .service-3x.audio-service.dark .artist-list:hover h5,
    .artist-list a:hover h5,
    ul.wp-block-categories li:before,
    ul.wp-block-archives li:before,
    .widget ul li:before{
        color: {$primary};
    }

    /* Primary Hover color */
    .product-description-1x .product-description-left .product-description-tab .tab-content .author-downloads a:hover {
        color: {$primary_hover}
    }

    /* Background Color */
    .edd_pagination a.page-numbers:hover,
    .edd_pagination span.page-numbers.current,
    .page-links b, 
    .page-links b:hover, 
    .course-pagination ul li a.page-numbers:hover,
    .course-pagination ul li .page-numbers.current,
    .is-sticky .main-menu-1x,
    .product-description-1x .product-description-right .price-box .custom-radio .custom-control-input:checked ~ .custom-control-label::before,
    .checkout-page-1x .payment-info ul li .custom-radio .custom-control-input:checked ~ .custom-control-label::before,
    .course-pagination ul .page-link:hover,
    .course-pagination ul .page-item.active .page-link,
    .course-header-1x .course-header-left .filter-product .container input:checked ~ .checkmark,
    .course-header-1x .course-header-left .filter-product .container:hover input ~ .checkmark {
        background-color: {$primary}; 
    }

    /* Border 1px */
    .btn.btn-search,
    .pricing-plan-1x .single-pricing .btn-bordered,
    .page-content button.btn.btn-search, 
    .widget button.btn.btn-search,
    .blog-list-1x .blog-list-single .blog-list-content .blog-footer a.btn-small,
    .featured-product-single-8 .media .media-body a.category:after,
    .about-us-3x .about-us-left a.btn-small,
    .sign-in-1x .sign-in-form h3:after,
    .features-description-2x .single-description .btn-bordered,
    .testimonial-section-2x ul.slick-dots li button,
    .course-header-1x .course-header-left .filter-product .container input:checked ~ .checkmark,
    .main-banner .overlay-text button.btn.btn-search:focus,
    a.btn-bordered,
    .title-right-btn .btn-small,
    .title-right-btn .btn-small:hover,
    .pricing-plan-1x .single-pricing.active .btn-bordered {
        border: 1px solid {$primary};
    }

    /* Hover Border */
    .title-right-btn .btn-small:hover {
        border: 1px solid {$primary_hover};
    }

    /*Border 3px*/
    .product-description-1x .product-description-right .price-box .container input:checked ~ .checkmark,
    .product-description-1x .product-description-right .price-box .container:hover input ~ .checkmark,
    .pricing-plan-1x .single-pricing.active {
        border: 3px solid {$primary}; 
    }

    /*Border 5px*/
    .product-description-1x .product-description-left .product-description-tab .nav-tabs .nav-link.active {
        border-top: 5px solid {$primary}; 
    }
    /*Border 10px*/
    .trapezoid {
        border-bottom: 10px solid {$primary};
    }

    /*Border 100px*/
    .featured-sticker {
        border-top: 100px solid {$primary};
    }
    /*Border 2px*/
    .latest-product-1x.latest-product-2x .title-left h2:after,
    .featured-product-3x .title-left h2:after,
    .service-3x .title-left h2:after{
        border: 2px solid {$primary};
    }
    .is-sticky .main-menu-1x.main-menu-6x .sign-in a:hover,
    .is-sticky .main-menu-1x.main-menu-6x .main-menu .navbar-nav .nav-link:hover,
    .is-sticky .main-menu-1x.main-menu-6x .navbar-light .navbar-nav .active > .nav-link{
        color: #ffffff;
    }

    /* ======= Start secondary color ======================================================================== */
    .intro-social i,
    .image-of-day a,
    .category-style span.cat-name,
    .auth-info a,
    .blog-cat i,
    .product-list-banner .overlay-text h1 b,
    .product-list-banner .overlay-text h3 b,
    .vendor-item h2 span,
    .vendor-profile h2 span,
    .blog-1x .blog-single .blog-single-content h3 i,
    .testimonial-section-2x .single-testimonial p:before,
    a.btn-bordered.app-store i, 
    .app-section-1x a.btn-bordered.app-store i, 
    .app-section-1x a.btn-bordered.google-play i,
    .app-section-1x .app-text h2 span,
    .pricing-plan-1x .single-pricing h2:before,
    .section-link a,
    .counter-section-1x .title-middle h2 span,
    .blog-content i,
    .recent-post i,
    .testimonial-section-2x .single-testimonial p:before,
    .team-members-left a i,
    .subscribe-section-1x .footer-subscriber h2 span,
    .testimonial-section-1x .slider-content p:before,
    .main-banner .overlay-text .slider-feature ul li i,
    .counter-section-1x .title-middle h2 span, 
    .main-banner .overlay-text h1 span, 
    .main-banner.main-banner-6x .overlay-text .slider-content-left h1 span, 
    .title-middle h2 span, 
    .blog-author .media .media-body h4 i,
    .doc-block .doc-block-icon i,
    .audio-version .product-content .price,
    .title-left h2 span {
        color: {$secondary}
    }

    .btn-hover.color-secondary,
    .main-banner-2x .overlay-text .banner-slider ul.slick-dots li.slick-active button,
    .pricing-plan-1x .single-pricing.active:hover .btn-bordered,
    .pricing-plan-1x .single-pricing:hover .btn-bordered,
    #bbpress-forums li.bbp-footer, 
    #bbpress-forums li.bbp-header,
    .category-style span.cat-item,
    span.sticker-popular, 
    span.sticker-new, 
    span.sticker-feature,
    .player-icon,
    .featured-product-1x ul.slick-dots li.slick-active button,
    .testimonial-section-1x ul.slick-dots li.slick-active button {
        background: {$secondary};
    }

    /* Secondary background hover */
    .btn-hover.color-secondary:hover {
        background: {$secondary_hover};
    }

    .testimonial-section-1x ul.slick-dots li button,
    .main-banner-2x .overlay-text .banner-slider ul.slick-dots li.slick-active button,
    .pricing-plan-1x .single-pricing.active:hover .btn-bordered,
    .pricing-plan-1x .single-pricing:hover .btn-bordered,
    .featured-product-1x ul.slick-dots li button,
    .testimonial-section-1x ul.slick-dots li.slick-active button {
        border: 1px solid {$secondary};
    }
    .pricing-plan-1x .single-pricing h2:before {
        border-bottom: 5px solid {$secondary};
    }

    /* Font style */
    .single-product .product-details .product-content.product-author p a,
    .single-product .product-details .product-content h3 span .btn-bordered,
    .testimonial-section-1x .single-slide h3,
    .testimonial-section-1x .single-slide h4,
    .event-speakers .single-speaker .speaker-details h2,
    .single-product .product-details .product-content p a,
    body {
        font-family: {$primary_font_family};
    }

    h1, h2, h3, h4, h5, h6,
    .single-product .product-details.graphicland-product-details .content-title,
    button.fes-ignore.fes-ignore-comments-form-submit-button.button,
    button.fes-cmt-submit-form.fes-comments-form-submit-button.button,
    a.fes-avatar-image-btn.edd-submit.button,
    a.fes-feat-image-btn.edd-submit.button,
    a#multiple,
    a.edd-submit.button.upload_file_button,
    .fes-vendor-contact-form div.fes-form .fes-submit input[type=submit],
    .fes-login-form  div.fes-form .fes-submit input[type=submit],
    .fes-registration-form  div.fes-form .fes-submit input[type=submit],
    #edd-purchase-button, .edd-submit, [type=submit].edd-submit,
    a.edd-add-to-cart,
    a.edd-submit.button.blue,
    .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
    a.btn-small,
    a.btn-ellips,
    a.btn-bordered,
    a.btn-circle,
    .title-middle h2,
    .title-left h2,
    .alertbox-1x .alert p,
    .sign-in a,
    .main-banner .overlay-text h1,
    .main-banner .overlay-text .slider-feature ul li,
    .main-banner .overlay-text h2,
    .service-1x .single-service h2,
    .counter-section-1x .single-counter span,
    .counter-section-single-product .single-counter span,
    .how-works-1x .single-works h3,
    .cta-1x .cta-left h3,
    .become-partnar h2,
    .feature-1x .single-feature h5,
    .footer-subscriber h3,
    .footer-section-1x .footer-top .footer-top-left .single-link h3,
    .single-product .product-details .product-content a,
    .single-product .product-details .product-content h3 strong,
    .latest-product-1x .latest-product-title h2,
    .latest-product-1x .latest-product-title-right .course-menu button.filter,
    .course-grid-list .media .media-body .product-content a,
    .course-grid-list .media .media-body .product-content h3 strong,
    .counter-section-2x .single-counter .media .media-body span,
    .checkout-docs .checkout-docs-left h3,
    .pricing-plan-1x .single-pricing h2,
    .pricing-plan-1x .single-pricing h3,
    .faqs-1x .single-faq .card-header a,
    .features-description-1x .single-description h2,
    .product-management .product-content h2,
    .subscribe-section-1x .footer-subscriber h2,
    .app-section-1x .app-text h2,
    .product-single-banner .product-banner-content h1,
    .product-description-1x .product-description-left .product-description-tab .nav-tabs .nav-link,
    .product-description-1x .product-description-left .product-description-tab .tab-content .item-details h3,
    .product-description-1x .product-description-left .product-description-tab .tab-content .authors-review .media .media-body a,
    .product-description-right .price-box h3,
    .product-description-right .price-box h3 span b,
    .product-description-right .price-box a.btn-small,
    .product-description-right .company-details .media .media-body a,
    .product-description-right .purchase-comments h2 span,
    .product-description-right .purchase-comments a span,
    .product-description-right .item-rating p,
    .product-description-right .product-features ul li strong,
    .product-description-right .social-link h3,
    .product-description-right .author-mailling-form h3,
    .course-header-1x .course-header-left h3,
    .page-banner .overlay-text h1,
    .page-banner .overlay-text h3,
    .about-us-2x .about-us-left h2,
    .service-4x .service-4x-left h2,
    .feature-2x .single-feature .media .media-body h5,
    .author-profile-banner .author-profile-left .media .media-body a,
    .author-profile-banner .author-profile-right .sales-info h3,
    h3#fes-products-page-title,
    .vendor-dashboard-main legend#fes-submission-form-title,
    .vendor-dashboard-main legend#fes-profile-form-title,
    h3#fes-orders-page-title,
    h1#fes-products-page-title,
    .about-banner .overlay-text h3,
    .about-banner .overlay-text h4,
    .features-description-2x .single-description h2,
    .features-description-2x .single-description h3,
    .client-1x .client-title h4,
    .sign-in-1x .sign-in-form h3,
    .job-board-1x .single-job h2,
    .job-single-1x h3,
    .blog-1x-no-bg .title-left h2,
    .related-post h3,
    .blog-list-1x .blog-list-single .blog-list-content h2 a,
    .blog-list-1x .blog-list-right .recent-popular-post ul.recent-popular-nav li .nav-link,
    .blog-list-1x .blog-list-right .recent-popular-post .recent-popular-tab .recent-post .media a,
    .blog-list-1x .blog-list-right .recent-popular-post ul.recent-popular-nav,
    .custom-category h2,
    h2.widgettitle, 
    .blog-list-1x .blog-list-right h2,
    .entry-content h1,
    .blog-single-1x .blog-single-left-content h1,
    h3#edd-reviews-heading,
    h2#edd-reviews-title,
    .blog-single-1x .blog-single-left-content .comment-form h3,
    .blog-single-1x .blog-single-left-content .comment-section h3,
    .blog-author .media .media-body h5,
    .blog-1x .blog-single .blog-single-content a,
    .events-banner .overlay-text h5,
    .events-banner .overlay-text h4,
    .events-banner .overlay-text .countdown-timer ul li,
    .events-1x .events-single b,
    .events-1x .events-single .events-single-content a,
    .about-us-3x .about-us-left h2,
    .about-us-3x .about-us-left h3,
    .event-speakers-bg .single-speaker .speaker-details h2,
    .comming-soon-banner .overlay-text .countdown-timer ul li,
    .comming-soon-banner .overlay-text h3,
    .error-page .error-page-content span,
    .error-page .error-page-content p,
    .author-profile-banner.author-profile-banner-2x .sale-price-info ul .item-price h2,
    .product-single-banner .product-banner-right h3,
    .service-2x .single-service h5,
    .service-3x .single-service a,
    .lfp-item-tabs .nav-tabs .nav-link,
    .single-featured-product .featured-content a.prod-title,
    .single-featured-product .featured-content h3,
    .single-featured-product .featured-content h4,
    .single-product-doc .doc-title h2,
    .main-banner.main-banner-6x .overlay-text .slider-content-left h1,
    .main-banner.main-banner-7x .overlay-text .slider-content-left h1,
    .featured-product-single-8 .media h4,
    .featured-product-single-8 .media .media-body a.prod-title,
    .featured-product-single-8 .media .media-body h2,
    .woocommerce-Reviews span#reply-title,
    h3#order_review_heading,
    label.woocommerce-form__label span, 
    .blog-single-1x .blog-single-left-content .woocommerce-billing-fields h3,
    .cart-collaterals .cart_totals h2,
    .woocommerce h2,
    .testimonial-section-1x .slider-content p,
    .filter-content a,
    .business-cta-3x .cta-content h3,
    .cta-content h2,
    .category-style span.cat-name,
    .blog-content a,
    .recent-item h2, .featured-item h2, .trending-item h2,
    .audio-version .product-content .price,
    .why-audio-service .left-desc h2,
    .testimonial-section-3x .single-testimonial h2,
    .doc-block-content h3,
    .testimonial-section-2x .single-testimonial p,
    .minimal.product-description-right h2,
    .single-header-left-content h1,
    .product-list-banner .overlay-text h3,
    .author-profile-left.graphicland-profile span.author,
    .author-profile-left.graphicland-profile span.author-title,
    .author-assets .author-content h1,
    .bbp-body a.bbp-forum-title,
    a.bbp-topic-permalink,
    .custom-cat-content span.cat-name,
    blockquote,
    a.btn-large {
        font-family: {$secondary_font_family};
    }

    ";

    if(  get_theme_mod( 'custom_style') == 1 ):
        wp_add_inline_style( 'eidmart-default', $custom_css );
    endif;

}
add_action( 'wp_enqueue_scripts', 'eidmart_color_styles_method' );
