<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme eidmart for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'eidmart_register_required_plugins' );
function eidmart_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array( 

		array(
			'name'      => esc_html__('MailChimp','eidmart'),
			'slug'      => 'mailchimp-for-wp',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__('Contact Form 7','eidmart'),
			'slug'      => 'contact-form-7',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__('Elementor Page builder','eidmart'),
			'slug'      => 'elementor',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__('Easy Digital Downloads','eidmart'),
			'slug'      => 'easy-digital-downloads',
			'required'  => true, // this plugin is recommended
		),
        array(
			'name'      => esc_html__('Featured Product','eidmart'),
			'slug'      => 'edd-featured-downloads',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__( 'One Click Demo Import','eidmart' ),
			'slug'      => 'one-click-demo-import',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__( 'Knowledgebase','eidmart' ),
			'slug'      => 'wedocs',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'      => esc_html__( 'Support','eidmart' ),
			'slug'      => 'supportcandy',
			'required'  => true, // this plugin is recommended
		),
		array(
			'name'               => esc_html__( 'Eidmart Plugin','eidmart' ), 
			'slug'               => 'eidmart-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory().'/inc/plugins/eidmart-plugin.zip', 
			'required'           => true,
			'version'            => '1.0',
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
	    )
				
	);
    $config = array(
		'id'           => 'eidmart-tgmpa', // your unique TGMPA ID
		'default_path' => '', // default absolute path
		'menu'         => 'eidmart-install-required-plugins', // menu slug
		'has_notices'  => true, // Show admin notices
		'dismissable'  => false, // the notices are NOT dismissable
		'dismiss_msg'  => esc_html__('I really, really need you to install these plugins, okay?','eidmart'), // this message will be output at top of nag
		'is_automatic' => true, // automatically activate plugins after installation
	);
 
    tgmpa( $plugins, $config );
}
