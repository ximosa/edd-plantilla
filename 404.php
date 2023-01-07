<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eidmart
 */

get_header();
?>

<div class="section-error">               
    <div class="error-text">

        <img src="<?php echo esc_url( get_theme_mod( 'error_bg', ''.get_template_directory_uri(). '/images/404.png')); ?>" alt="<?php echo esc_attr( get_theme_mod( 'title', __( 'Oops! Page not found!', 'eidmart' ) ) ); ?>" class="hvrbox-layer_bottom"> 

        <h1><?php echo esc_html( get_theme_mod( 'title', __( 'Oops! Page not found!', 'eidmart' ) ) ); ?></h1>
        <br /><br />
        <a href="<?php echo esc_url( get_theme_mod( '404_btn_url', '#' )); ?>" class="btn-hover color-1"><i class="fa fa-home"></i> <?php echo esc_html( get_theme_mod( '404_btn_text', __( 'Go back to homepage', 'eidmart' ) )); ?></a>
    
    </div>                    
</div>

<?php
get_footer();
