<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package eidmart
 */

/**
 * Registers our main widget area and the front page widget areas.
 */

function eidmart_widgets_init() {

    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'eidmart'),
        'id'            => 'sidebar',
        'description'   => esc_html__('Sidebar position.', 'eidmart'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('bbpress Sidebar', 'eidmart'),
        'id'            => 'bbpress_sidebar',
        'description'   => esc_html__('bbpress Sidebar position.', 'eidmart'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Link Widget', 'eidmart'),
        'id'            => 'footer-link',
        'description'   => esc_html__('Footer widget for link position.', 'eidmart'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer About Widget', 'eidmart'),
        'id'            => 'footer-about',
        'description'   => esc_html__('Footer widget for about position.', 'eidmart'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Subscribe Widget', 'eidmart'),
        'id'            => 'footer-subscribe',
        'description'   => esc_html__('Footer widget for subscribe email form position.', 'eidmart'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name'        => esc_html__('Footer Bottom Link Widget', 'eidmart'),
        'id'          => 'footer-bottom-link',
        'description' => esc_html__('Footer widget for bottom link position.', 'eidmart'),
    ));

    register_sidebar(array(
        'name'        => esc_html__('User Profile Link Wdiget Area', 'eidmart'),
        'id'          => 'user-profile-link',
        'description' => esc_html__('This is your widget profile link widget area to show usefull link.', 'eidmart'),
    ));

    /**
     * register MegaMenu widget if the Mega Menu is set as the menu location
     */
	$location = 'primary';
	$css_class = 'has-mega-menu';
	$locations = get_nav_menu_locations();
	if ( isset( $locations[ $location ] ) ) {
		$menu = get_term( $locations[ $location ], 'nav_menu' );
		if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
			foreach ( $items as $item ) {
				if ( in_array( $css_class, $item->classes ) ) {
					register_sidebar( 
						array(
							'id'   => 'mega-menu-item-' . $item->ID,
							'description' => 'Mega Menu items',
							'name' => $item->title . ' - Mega Menu'
						)
					);
				}
			}
		}
	} // End Mega Menu

}
add_action('widgets_init', 'eidmart_widgets_init');
