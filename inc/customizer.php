<?php
/**
 * Eidmart Theme Customizer
 *
 * @package Eidmart
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eidmart_customize_register($wp_customize) {

    /**
     * Separator control in Customizer API
    */
    class Separator_Custom_control extends WP_Customize_Control{
        public $type = 'separator';
        public function render_content(){ ?>
            <h2><?php echo esc_html( $this->label ); ?></h2>
            <p><hr></p>
        <?php
        }
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'eidmart_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'eidmart_customize_partial_blogdescription',
        ));
    }

    /************************************************************************
    Site identity
    *************************************************************************/

    // Logo
    $wp_customize->add_setting('logo_upload',

        array(
            'default' => '' . get_template_directory_uri() . '/images/logo.png',
            'sanitize_callback' => 'eidmart_sanitize_image',
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo_upload',
            array(
                'label'    => esc_html__('Logo', 'eidmart'),
                'section'  => 'title_tagline',
                'settings' => 'logo_upload',
                'priority' => '8',
            )
        )
    );

    // Sticky Logo
    $wp_customize->add_setting('sticky_logo_upload',

        array(
            'default' => '' . get_template_directory_uri() . '/images/logo.png',
            'sanitize_callback' => 'eidmart_sanitize_image',
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'sticky_logo_upload',
            array(
                'label'    => esc_html__('Sticky Logo', 'eidmart'),
                'section'  => 'title_tagline',
                'settings' => 'sticky_logo_upload',
                'priority' => '8',
            )
        )
    );

    // Sticky menu show/hide
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Stiky menu show/hide', 'eidmart'),
            'section'  => 'title_tagline',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Loader show/hide
    $wp_customize->add_setting(
        'loader_show',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'loader_show',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Page Loader', 'eidmart'),
            'section'  => 'title_tagline',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Loader style
    $wp_customize->add_setting(
        'loader_style',
        array(
            'default'           => 'spinner1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'loader_style',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Page Loader Style', 'eidmart'),
            'section'  => 'title_tagline',
            'priority' => '20',
            'choices'  => array(
                'spinner1' => esc_html__('Style 1', 'eidmart'),
                'spinner2' => esc_html__('Style 2', 'eidmart'),
                'spinner3' => esc_html__('Style 3', 'eidmart'),
                'spinner4' => esc_html__('Style 4', 'eidmart'),
                'spinner5' => esc_html__('Style 5', 'eidmart'),
                'spinner6' => esc_html__('Style 6', 'eidmart'),
                'spinner7' => esc_html__('Style 7', 'eidmart'),
            ),
        )
    );

    // Loader BG Color
    $wp_customize->add_setting('bg_color', array(
        'default'           => '#000000',
        'transport'         => 'refresh',
        'sanitize_callback' => 'color_sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bg_color', array(
        'section' => 'title_tagline',
        'label'   => esc_html__('Loader Background Color', 'eidmart'),
    )));

    // Menu width
    $wp_customize->add_setting(
        'market_type',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'market_type',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Menu Width ( Container or Container Fluid )', 'eidmart'),
            'section'  => 'title_tagline',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Container', 'eidmart'),
                '2' => esc_html__('Container Fluid', 'eidmart'),
            ),
        )
    );

    // Menu Background
    $wp_customize->add_setting(
        'menu_bg',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'menu_bg',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Menu Background ( Dark or Light )', 'eidmart'),
            'section'  => 'title_tagline',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Background Drak', 'eidmart'),
                '2' => esc_html__('Background Light', 'eidmart'),
            ),
        )
    );

    /**************************************************************************************************
    Header Section
     ***************************************************************************************************/

    // Header Panel
    $wp_customize->add_panel('efheader', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Header', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // Default page header ***********************************************************************************
    $wp_customize->add_section('page_alert', array(

        'title'    => esc_html__('Top Alert', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efheader',

    ));

    // Alert text
    $wp_customize->add_setting('alert_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post' // Allowed HTML from content

    ));
    $wp_customize->add_control('alert_text', array(

        'section' => 'page_alert',
        'label'   => esc_html__('Top Deal Alert Text', 'eidmart'),
        'type'    => 'textarea',

    ));

    // Alert show/hide
    $wp_customize->add_setting(
        'alert_show',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'alert_show',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Alert Show/Hide', 'eidmart'),
            'section'  => 'page_alert',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Alert text
    $wp_customize->add_setting('offer_schedule', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'eidmart_sanitize_date' // Allowed HTML from content

    ));
    $wp_customize->add_control('offer_schedule', array(

        'section' => 'page_alert',
        'label'   => esc_html__('Date Schedule', 'eidmart'),
        'type'    => 'date',

    ));

    // Default top menu text ***********************************************************************************
    $wp_customize->add_section('top_menu', array(

        'title'    => esc_html__('Top menu information', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efheader',

    ));

    // Phone no
    $wp_customize->add_setting('phone', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('phone', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Phone no', 'eidmart'),
        'type'    => 'text',

    ));

    // Email no
    $wp_customize->add_setting('email', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email'

    ));
    $wp_customize->add_control('email', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Email', 'eidmart'),
        'type'    => 'text',

    ));

    // Change main menu button text
    $wp_customize->add_setting('btn_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('btn_text', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Button text', 'eidmart'),
        'description' => esc_html__('Main menu right button text.', 'eidmart'),
        'type'        => 'text',

    ));

    // Change tom menu button url
    $wp_customize->add_setting('btn_url', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('btn_url', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Button url', 'eidmart'),
        'description' => esc_html__('Main menu right button url.', 'eidmart'),
        'type'        => 'text',

    ));

    // Change menu sing up text
    $wp_customize->add_setting('singup_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('singup_text', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Signup text', 'eidmart'),
        'description' => esc_html__('Main menu signup text.', 'eidmart'),
        'type'        => 'text',

    ));

    // Change menu sing in url
    $wp_customize->add_setting('singup_url', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('singup_url', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Signup url', 'eidmart'),
        'description' => esc_html__('Main menu signup url.', 'eidmart'),
        'type'        => 'text',

    ));

    // Change menu sing in text
    $wp_customize->add_setting('singin_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('singin_text', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Signin text', 'eidmart'),
        'description' => esc_html__('Main menu signin text.', 'eidmart'),
        'type'        => 'text',

    ));

    // Change menu sing in url
    $wp_customize->add_setting('singin_url', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('singin_url', array(

        'section'     => 'top_menu',
        'label'       => esc_html__('Signin url', 'eidmart'),
        'description' => esc_html__('Main menu signin url.', 'eidmart'),
        'type'        => 'text',

    ));

    // Menu CTA button style
    $wp_customize->add_setting(
        'button_style1',
        array(
            'default'           => 'color-primary',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'button_style1',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Call to action button style', 'eidmart'),
            'section'  => 'top_menu',
            'priority' => '20',
            'choices'  => array(                
                'color-1'  => esc_html__('Style one', 'eidmart'),
                'color-2'  => esc_html__('Style two', 'eidmart'),
                'color-3'  => esc_html__('Style three', 'eidmart'),
                'color-4'  => esc_html__('Style four', 'eidmart'),
                'color-5'  => esc_html__('Style five', 'eidmart'),
                'color-6'  => esc_html__('Style six', 'eidmart'),
                'color-7'  => esc_html__('Style seven', 'eidmart'),
                'color-8'  => esc_html__('Style eight', 'eidmart'),
                'color-9'  => esc_html__('Style nine', 'eidmart'),
                'color-10' => esc_html__('Style ten', 'eidmart'),
                'color-11' => esc_html__('Style eleven', 'eidmart'),
                'color-primary' => esc_html__('Style Primary', 'eidmart'),
                'color-secondary' => esc_html__('Style Secondary', 'eidmart'),
                'color-default' => esc_html__('Style Default', 'eidmart'),
                ''         => esc_html__('None', 'eidmart'),
            ),
        )
    );

    // Facebook social
    $wp_customize->add_setting('fb_social', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('fb_social', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Facebook url', 'eidmart'),
        'type'    => 'text',

    ));

    // Twitter social
    $wp_customize->add_setting('tw_social', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('tw_social', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Twitter url', 'eidmart'),
        'type'    => 'text',

    ));

    // Linkedin social
    $wp_customize->add_setting('ln_social', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ln_social', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Linkedin url', 'eidmart'),
        'type'    => 'text',

    ));

    // Google social
    $wp_customize->add_setting('gl_social', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('gl_social', array(

        'section' => 'top_menu',
        'label'   => esc_html__('Google url', 'eidmart'),
        'type'    => 'text',

    ));

    // Default page header ***********************************************************************************
    $wp_customize->add_section('page_header', array(

        'title'    => esc_html__('Page Header Banner', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efheader',

    ));

    // Banner
    $wp_customize->add_setting('banner_upload',

        array(
            'default' => '' . get_template_directory_uri() . '/images/banner.jpg',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'banner_upload',
            array(
                'label'    => esc_html__('Upload Page Banner', 'eidmart'),
                'section'  => 'page_header',
                'settings' => 'banner_upload',
            )
        )
    );

    /**************************************************************************************************
    Color Section
     ***************************************************************************************************/

    // Header Panel
    $wp_customize->add_panel('efcolor', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Colors & Fonts', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // Custom style activation ***********************************************************************************
    $wp_customize->add_section('active_custom_style', array(

        'title'    => esc_html__('Active Custom Colors & Fonts', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efcolor',

    ));

    // LTR/RTL
    $wp_customize->add_setting(
        'custom_style',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'custom_style',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Active/Deactive Custom Style', 'eidmart'),
            'section'  => 'active_custom_style',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Active', 'eidmart'),
                '2' => esc_html__('Deactive', 'eidmart'),
            ),
        )
    );

    // Header color ***********************************************************************************
    $wp_customize->add_section('default_color', array(

        'title'    => esc_html__('Eidmart Colors', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efcolor',

    ));

    // Primary color
    $wp_customize->add_setting('primary', array(
        'default'           => '#6caf17',
        'transport'         => 'refresh',
        'sanitize_callback' => 'color_sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary', array(
        'section' => 'default_color',
        'label'   => esc_html__('Primary Color', 'eidmart'),
    )));

    // Primary hover color
    $wp_customize->add_setting('primary_hover', array(
        'default'           => '#549006',
        'transport'         => 'refresh',
        'sanitize_callback' => 'color_sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_hover', array(
        'section' => 'default_color',
        'label'   => esc_html__('Primary Hover Color', 'eidmart'),
    )));

    // Secondary color
    $wp_customize->add_setting('secondary', array(
        'default'           => '#ffb307',
        'transport'         => 'refresh',
        'sanitize_callback' => 'color_sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary', array(
        'section' => 'default_color',
        'label'   => esc_html__('Secondary Color', 'eidmart'),
    )));

    // Secondary hover color
    $wp_customize->add_setting('secondary_hover', array(
        'default'           => '#C98C00',
        'transport'         => 'refresh',
        'sanitize_callback' => 'color_sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_hover', array(
        'section' => 'default_color',
        'label'   => esc_html__('Secondary Hover Color', 'eidmart'),
    )));

    // Eidmart font ***********************************************************************************
    $wp_customize->add_section('default_font', array(

        'title'    => esc_html__('Eidmart Fonts', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efcolor',

    ));

    // Primary Font
    $wp_customize->add_setting('primary_font', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('primary_font', array(

        'section'     => 'default_font',
        'priority'    => '20',
        'label'       => esc_html__('Primary Font', 'eidmart'),
        'description' => esc_html__('Input your desired Primary Font. Ex: Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600', 'eidmart'),
        'type'        => 'text',
    ));

    // Primary Font
    $wp_customize->add_setting('primary_font_family', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('primary_font_family', array(

        'section'     => 'default_font',
        'priority'    => '20',
        'label'       => esc_html__('Primary Font Family', 'eidmart'),
        'description' => esc_html__("Input Primary Font Family. Ex: 'Open Sans', sans-serif;", "eidmart"),
        'type'        => 'text',

    ));

    // Secondary Font
    $wp_customize->add_setting('secondary_font', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('secondary_font', array(

        'section'     => 'default_font',
        'priority'    => '20',
        'label'       => esc_html__('Secondary Font', 'eidmart'),
        'description' => esc_html__('Input your desired Secondary Font. Ex: Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500', 'eidmart'),
        'type'        => 'text',

    ));

    // Secondary Font
    $wp_customize->add_setting('secondary_font_family', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('secondary_font_family', array(

        'section'     => 'default_font',
        'priority'    => '20',
        'label'       => esc_html__('Secondary Font Family', 'eidmart'),
        'description' => esc_html__("Input Secondary Font Family. Ex: 'Poppins', sans-serif;", "eidmart"),
        'type'        => 'text',

    ));

    // Language Direction ***********************************************************************************
    $wp_customize->add_section('language_direction', array(

        'title'    => esc_html__('Language Direction', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efcolor',

    ));

    // LTR/RTL
    $wp_customize->add_setting(
        'lang_direction',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'lang_direction',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Language Direction ( LTR/RTL )', 'eidmart'),
            'section'  => 'language_direction',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('RTL', 'eidmart'),
                '2' => esc_html__('LTR', 'eidmart'),
            ),
        )
    );

    /**************************************************************************************************
    Sidebar
     ***************************************************************************************************/
    // Sidebar Panel
    $wp_customize->add_panel('efsidebar', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Blog', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // Course archive free/paid information ***********************************************************************************
    $wp_customize->add_section('sidebar', array(

        'title'       => esc_html__('Blog Sidebar Options', 'eidmart'),
        'priority'    => '20',
        'panel'       => 'efsidebar',
        'description' => '',

    ));

    // Sidebar Category
    $wp_customize->add_setting(
        'cats',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'cats',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide eidmart Category Style', 'eidmart'),
            'section'  => 'sidebar',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Sidebar tags
    $wp_customize->add_setting(
        'tags',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'tags',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide eidmart Tag Style', 'eidmart'),
            'section'  => 'sidebar',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Sidebar Category
    $wp_customize->add_setting(
        'favourite',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'favourite',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide blog favourite icon from product and author page.', 'eidmart'),
            'section'  => 'sidebar',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Single page author display ***********************************************************************************
    $wp_customize->add_section('author_display', array(

        'title'    => esc_html__('Blog Single Page', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efsidebar',

    ));

    // Single page share icon show/hide
    $wp_customize->add_setting(
        'social_share',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'social_share',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Single Post Share Icon show/hide', 'eidmart'),
            'section'  => 'author_display',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Single page author show/hide
    $wp_customize->add_setting(
        'author_area',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'author_area',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Single Post Author show/hide', 'eidmart'),
            'section'  => 'author_display',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Single page author show/hide
    $wp_customize->add_setting(
        'author_area_top',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'author_area_top',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Single Post Top Author show/hide ( Full Width )', 'eidmart'),
            'section'  => 'author_display',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Author page settings ***********************************************************************************
    $wp_customize->add_section('author_page_settings', array(

        'title'    => esc_html__('Author/Vendor Settings', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efsidebar',
        'icon'    => 'dashicons-admin-tools',

    ));

    // Author following/follower options show/hide
    $wp_customize->add_setting(
        'user_follow',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'user_follow',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Following, Follower Menu and Button Show/Hide', 'eidmart'),
            'section'  => 'author_page_settings',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Vendor sidebar show/hide
    $wp_customize->add_setting(
        'vendor_sidebar',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'vendor_sidebar',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Vendor Sidebar Show/Hide', 'eidmart'),
            'section'  => 'author_page_settings',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Vendor message button show/hide
    $wp_customize->add_setting(
        'vendor_message_popup',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'vendor_message_popup',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Vendor Message Button Show/Hide', 'eidmart'),
            'section'  => 'author_page_settings',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    /**************************************************************************************************
    Eidmart Settings
     ***************************************************************************************************/
    // Eidmart Settings Panel
    $wp_customize->add_panel('cproduct', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Settings', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // Settings panels ***********************************************************************************
    $wp_customize->add_section('settings', array(

        'title'    => esc_html__('Settings', 'eidmart'),
        'priority' => '20',
        'panel'    => 'cproduct',

    ));

    // Deactive WordPress default image compression
    $wp_customize->add_setting(
        'img_compress',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'img_compress',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Select Image Compression Type', 'eidmart' ),
            'description' => esc_html__( 'When customers purchase images and go to the dashboard for download,  WordPress compress images automatically. If you don\'t want to compress just select "Remove Default Compression" and publish.', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '1' => esc_html__( 'Keep Default Compression', 'eidmart' ),
                '0' => esc_html__( 'Remove Default Compression', 'eidmart' )
            ),
        )
    );

    /***
    Separator
    **/
    $wp_customize->add_setting('asset_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'asset_separator', array(
                'settings'		=> 'asset_separator',
                'label'       => esc_html__('Asset Controller', 'eidmart'),
                'section'  		=> 'settings',
                'priority'    => '20',
            )
        )
    );

    // Bootstrap version scripts
    $wp_customize->add_setting(
        'bootstrap_script',
        array(
            'default'           => '4',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'bootstrap_script',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Select Bootstrap', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '4' => esc_html__( 'Bootstrap 4 ( Recommended )', 'eidmart' ),
                '5' => esc_html__( 'Bootstrap 5', 'eidmart' )
            ),
        )
    );

    // Audio scripts
    $wp_customize->add_setting(
        'mp3_script',
        array(
            'default'           => '0',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'mp3_script',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Active MP3 Scripts', 'eidmart' ),
            'description' => esc_html__( 'Active MP3 scripts to play audio.', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '1' => esc_html__( 'Active', 'eidmart' ),
                '0' => esc_html__( 'Inactive', 'eidmart' )
            ),
        )
    );

    // Lightbox scripts for Photography
    $wp_customize->add_setting(
        'lightbox_script',
        array(
            'default'           => '0',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'lightbox_script',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Active Lightbox Scripts', 'eidmart' ),
            'description' => esc_html__( 'Active Lightbox scripts to pop up photography image.', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '1' => esc_html__( 'Active', 'eidmart' ),
                '0' => esc_html__( 'Inactive', 'eidmart' )
            ),
        )
    );

    /***
    Separator
    **/
    $wp_customize->add_setting('widget_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'widget_separator', array(
                'settings'		=> 'widget_separator',
                'label'       => esc_html__('Widget Settings', 'eidmart'),
                'section'  		=> 'settings',
                'priority'    => '20',
            )
        )
    );

    // Widget Type
    $wp_customize->add_setting(
        'ewidget_opt',
        array(
            'default'           => '0',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'ewidget_opt',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Select Widget Style', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '0' => esc_html__( 'Non-block Widget', 'eidmart' ),
                '1' => esc_html__( 'Block Widget', 'eidmart' )
            ),
        )
    );

    /***
    Separator
    **/
    $wp_customize->add_setting('separator_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'separator_1', array(
                'settings'		=> 'separator_1',
                'label'       => esc_html__('VideoMart Settings', 'eidmart'),
                'section'  		=> 'settings',
                'priority'    => '20',
            )
        )
    );

    // Video Height
    $wp_customize->add_setting('video_height', array(

        'default'   => '210px',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('video_height', array(

        'section'     => 'settings',
        'priority'    => '20',
        'label'       => esc_html__('Video Height ( Only for video demo )', 'eidmart'),
        'type'        => 'number',

    ));

    // Video sound
    $wp_customize->add_setting(
        'video_sound',
        array(
            'default'           => '0',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'video_sound',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Active Video Sound on Hover', 'eidmart' ),
            'section'     => 'settings',
            'priority'    => '20',
            'choices'     => array(
                '0' => esc_html__( 'Sound Active', 'eidmart' ),
                '1' => esc_html__( 'Sound Inactive', 'eidmart' )
            ),
        )
    );

    // Youtube video read more button text
    $wp_customize->add_setting('youtube_btn', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('youtube_btn', array(

        'section'     => 'settings',
        'priority'    => '20',
        'label'       => esc_html__('Youtube video "Read More" button text', 'eidmart'),
        'type'        => 'text',

    ));

    // Archive panels ***********************************************************************************
    $wp_customize->add_section('course_archive', array(

        'title'    => esc_html__('Archive Settings', 'eidmart'),
        'priority' => '20',
        'panel'    => 'cproduct',

    ));

    // Serach box text
    $wp_customize->add_setting('main_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('main_title', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Change serach box text', 'eidmart'),
        'type'    => 'text',

    ));

    // Product count show/hide
    $wp_customize->add_setting(
        'product_count',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'product_count',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Product Count Show/Hide', 'eidmart'),
            'section'  => 'course_archive',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Refresh filter text
    $wp_customize->add_setting('refresh_filter', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('refresh_filter', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Refresh Filter text', 'eidmart'),
        'type'    => 'text',

    ));

    // Sort By : text
    $wp_customize->add_setting('short_by', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('short_by', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Product Type Text', 'eidmart'),
        'type'    => 'text',

    ));

    // All prices are in USD text
    $wp_customize->add_setting('usd_price', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('usd_price', array(

        'section' => 'course_archive',
        'label'   => esc_html__('All Prices Are in USD Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Sidebar Category text
    $wp_customize->add_setting('archive_cat', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('archive_cat', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Change Category Text', 'eidmart'),
        'type'    => 'text',

    ));    

    // Product Archive page width
    $wp_customize->add_setting(
        'ark_width',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'ark_width',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Product Archive Page Width ( Container or Container Fluid )', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Container', 'eidmart'),
                '2' => esc_html__('Container Fluid', 'eidmart'),
            ),
        )
    );

    // Archive product style
    $wp_customize->add_setting(
        'product_view',
        array(
            'default'           => 'grid',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'product_view',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Archive product style.', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'grid' => esc_html__('Grid', 'eidmart'),
                'list' => esc_html__('List ( Only for software demos )', 'eidmart'),
            ),
        )
    );

    // Select archive type
    $wp_customize->add_setting(
        'archive_type',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'archive_type',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Archive For ( Software/Photography/Graphics/Audio/Video )', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('SoftWare', 'eidmart'),
                '2' => esc_html__('Photography', 'eidmart'),
                '3' => esc_html__('Graphics', 'eidmart'),
                '4' => esc_html__('Audio', 'eidmart'),
                '5' => esc_html__('Video', 'eidmart'),
            ),
        )
    );

    /***
    Separator
    **/
    $wp_customize->add_setting('product_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'product_separator', array(
                'settings'	  => 'product_separator',
                'label'       => esc_html__('Archive/Author Profile product settings ', 'eidmart'),
                'section'  	  => 'course_archive',
                'priority'    => '20',
            )
        )
    );

    // Archive course grid
    $wp_customize->add_setting(
        'course_grid',
        array(
            'default'           => 'col-md-4',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'course_grid',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Product Grid', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'col-md-2' => esc_html__('6 Column', 'eidmart'),
                'col-md-3' => esc_html__('4 Column', 'eidmart'),
                'col-md-4' => esc_html__('3 Column', 'eidmart'),
                'col-md-6' => esc_html__('2 Column', 'eidmart'),
            ),
        )
    );

    // Title length for grid style
    $wp_customize->add_setting('max_char', array(

        'default'   => '30',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('max_char', array(

        'section' => 'course_archive',
        'priority' => '20',
        'label'   => esc_html__('Archive grid product title limit in letter.', 'eidmart'),
        'type'    => 'text',

    ));

    // Title length for list style
    $wp_customize->add_setting('max_char_list', array(

        'default'   => '60',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('max_char_list', array(

        'section' => 'course_archive',
        'priority' => '20',
        'label'   => esc_html__('Archive list product title limit in letter.', 'eidmart'),
        'type'    => 'text',

    ));

    // Show hide product author
    $wp_customize->add_setting(
        'author',
        array(
            'default'           => 'Off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'author',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide author name from archive product.', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'Off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide product category
    $wp_customize->add_setting(
        'category',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'category',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide category name from archive product.', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide course excerpt
    $wp_customize->add_setting(
        'product_para',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'product_para',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide item excerpt.', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide course sale
    $wp_customize->add_setting(
        'sale',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'sale',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide product rating, sale, love.', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );    

    // Show hide only ratings
    $wp_customize->add_setting(
        'eid_ratings',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'eid_ratings',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide only ratings', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide only love
    $wp_customize->add_setting(
        'eid_love',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'eid_love',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide only love icon', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide course sale
    $wp_customize->add_setting(
        'eid_sales',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'eid_sales',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide only sales', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Show hide product price
    $wp_customize->add_setting(
        'eid_price_con',
        array(
            'default'           => 'off',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'eid_price_con',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Show/Hide price', 'eidmart'),
            'section'  => 'course_archive',
            'priority' => '20',
            'choices'  => array(
                'on'  => esc_html__('Show', 'eidmart'),
                'off' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    /**
     * Special for Photography ad
     */

    /***
    Separator
    **/
    $wp_customize->add_setting('photography_ad_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'photography_ad_separator', array(
                'settings'	  => 'photography_ad_separator',
                'label'       => esc_html__('Photography Archive Advertise', 'eidmart'),
                'section'  	  => 'course_archive',
                'priority'    => '20',
            )
        )
    );

    // Advertise 1
    $wp_customize->add_setting('ad_position_1', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('ad_position_1', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Set Ad Position 1.', 'eidmart'),
        'description'   => esc_html__('Photography archive page ad position.', 'eidmart'),
        'priority' => '21',
        'type'    => 'number',

    ));

    $wp_customize->add_setting('ad_code_1', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ad_code_1', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Ad 1 Code.', 'eidmart'),
        'priority' => '21',
        'type'    => 'textarea',

    ));

    // Advertise 2
    $wp_customize->add_setting('ad_position_2', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('ad_position_2', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Set Ad Position 2.', 'eidmart'),
        'description'   => esc_html__('Photography archive page ad position.', 'eidmart'),
        'priority' => '22',
        'type'    => 'number',

    ));

    $wp_customize->add_setting('ad_code_2', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ad_code_2', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Ad 2 Code.', 'eidmart'),
        'priority' => '22',
        'type'    => 'textarea',

    ));

    // Advertise 3
    $wp_customize->add_setting('ad_position_3', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('ad_position_3', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Set Ad Position 3.', 'eidmart'),
        'description'   => esc_html__('Photography archive page ad position.', 'eidmart'),
        'priority' => '23',
        'type'    => 'number',

    ));

    $wp_customize->add_setting('ad_code_3', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ad_code_3', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Ad 3 Code.', 'eidmart'),
        'priority' => '23',
        'type'    => 'textarea',

    ));

    // Advertise 4
    $wp_customize->add_setting('ad_position_4', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('ad_position_4', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Set Ad Position 4.', 'eidmart'),
        'description'   => esc_html__('Photography archive page ad position.', 'eidmart'),
        'priority' => '24',
        'type'    => 'number',

    ));

    $wp_customize->add_setting('ad_code_4', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ad_code_4', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Ad 4 Code.', 'eidmart'),
        'priority' => '24',
        'type'    => 'textarea',

    ));

    // Advertise 5
    $wp_customize->add_setting('ad_position_5', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'

    ));
    $wp_customize->add_control('ad_position_5', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Set Ad Position 5.', 'eidmart'),
        'description'   => esc_html__('Photography archive page ad position.', 'eidmart'),
        'priority' => '25',
        'type'    => 'number',

    ));

    $wp_customize->add_setting('ad_code_5', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('ad_code_5', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Ad 5 Code.', 'eidmart'),
        'priority' => '25',
        'type'    => 'textarea',

    ));
    
    $wp_customize->add_setting('arc_seo_desc', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('arc_seo_desc', array(

        'section' => 'course_archive',
        'label'   => esc_html__('Archive Description for SEO.', 'eidmart'),
        'priority' => '25',
        'type'    => 'textarea',

    ));

    // Product Single ***********************************************************************************
    $wp_customize->add_section('product_single', array(

        'title'    => esc_html__('Product Single', 'eidmart'),
        'priority' => '20',
        'panel'    => 'cproduct',

    ));

    // Show hid video preview from single page
    $wp_customize->add_setting(
        'pro_feature',
        array(
            'default'           => '0',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'pro_feature',
        array(
            'type'        => 'radio',
            'label'       => esc_html__( 'Show/Hide Product Feature', 'eidmart' ),
            'description' => esc_html__( 'This feature option means product specification section for a single product sidebar or others.', 'eidmart' ),
            'section'     => 'product_single',
            'priority'    => '20',
            'choices'     => array(
                '1' => esc_html__( 'Admin Capability', 'eidmart' ),
                '2' => esc_html__( 'Vendor Capability', 'eidmart' ),
                '0' => esc_html__( 'Hide Feature Section', 'eidmart' ),
            ),
        )
    );

    // Change single product "Add to Favorites"
    $wp_customize->add_setting('add_to_favourite', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('add_to_favourite', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Change single product "Add to Favorites" text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Change single product "Person Liked it"
    $wp_customize->add_setting('person_liked_it', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('person_liked_it', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Change single product "Person Liked it" text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Price box show/hide
    $wp_customize->add_setting(
        'price_box',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'price_box',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Price box show/hide', 'eidmart'),
            'section'  => 'product_single',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Purchase & Comment Universally show/hide
    $wp_customize->add_setting(
        'purchase_comment',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'purchase_comment',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Purchase & Comment Universally show/hide', 'eidmart'),
            'section'  => 'product_single',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // User Profile show/hide
    $wp_customize->add_setting(
        'user_profile',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'user_profile',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('User Profile show/hide', 'eidmart'),
            'section'  => 'product_single',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Sticky menu show/hide
    $wp_customize->add_setting(
        'sticky_price',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'sticky_price',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Stiky Price show/hide', 'eidmart'),
            'section'  => 'product_single',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Show', 'eidmart'),
                '2' => esc_html__('Hide', 'eidmart'),
            ),
        )
    );

    // Photography mouse right button enable/desable
    $wp_customize->add_setting(
        'mouse_key',
        array(
            'default'           => '2',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'mouse_key',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Single Product Page Mouse Right Button Enable/Disable ( Specially Photography )', 'eidmart'),
            'section'  => 'product_single',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Enable', 'eidmart'),
                '2' => esc_html__('Disable', 'eidmart'),
            ),
        )
    );

    /***
    Separator
    **/
    $wp_customize->add_setting('price_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'price_separator', array(
                'settings' => 'price_separator',
                'label'    => esc_html__( 'Price Box Additional Information', 'eidmart' ),
                'section'  => 'product_single',
                'priority' => '20',
            )
        )
    );

    // Info 1
    $wp_customize->add_setting('info_1', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_1', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 1 text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 1 details
    $wp_customize->add_setting('info_1_details', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_1_details', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 1 Details text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 2
    $wp_customize->add_setting('info_2', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_2', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 2 text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 2 details
    $wp_customize->add_setting('info_2_details', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_2_details', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 2 Details text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 3
    $wp_customize->add_setting('info_3', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_3', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 3 text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 3 details
    $wp_customize->add_setting('info_3_details', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_3_details', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 3 Details text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 4
    $wp_customize->add_setting('info_4', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_4', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 4 text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 4 details
    $wp_customize->add_setting('info_4_details', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_4_details', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 4 Details text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 5
    $wp_customize->add_setting('info_5', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_5', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 5 text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Info 5 details
    $wp_customize->add_setting('info_5_details', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('info_5_details', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Information 5 Details text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Secured Text
    $wp_customize->add_setting('secured_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('secured_text', array(

        'section' => 'product_single',
        'priority'    => '20',
        'label'   => esc_html__('Secured text.', 'eidmart'),
        'type'    => 'text',

    ));

    // Secured image
    $wp_customize->add_setting('secured_img',

        array(
            'default' => '' . get_template_directory_uri() . '/images/credit-card-certificate.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'secured_img',
            array(
                'label'    => esc_html__('Secured Image', 'eidmart'),
                'section'  => 'product_single',
                'priority' => '20',
                'settings' => 'secured_img',
            )
        )
    );

    // Google map panels ***********************************************************************************
    $wp_customize->add_section('mg_mp', array(

        'title'    => esc_html__('Google Map API', 'eidmart'),
        'priority' => '20',
        'panel'    => 'cproduct',

    ));

    // Map key
    $wp_customize->add_setting('map_key', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('map_key', array(

        'section' => 'mg_mp',
        'label'   => esc_html__('Google map API key', 'eidmart'),
        'type'    => 'text',

    ));

    /**************************************************************************************************
    Others
    ***************************************************************************************************/
    // Others Panel
    $wp_customize->add_panel('efothers', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Others', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // 404 Page ***********************************************************************************
    $wp_customize->add_section('404_Page', array(

        'title'    => esc_html__('404 Page', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efothers',

    ));

    // Background image
    $wp_customize->add_setting('error_bg',

        array(
            'default' => '' . get_template_directory_uri() . '/images/404.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'error_bg',
            array(
                'label'    => esc_html__('404 Page background image', 'eidmart'),
                'section'  => '404_Page',
                'settings' => 'error_bg',
            )
        )
    );

    // Main title
    $wp_customize->add_setting('title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('title', array(

        'section' => '404_Page',
        'label'   => esc_html__('Title Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Sub title
    $wp_customize->add_setting('sub_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('sub_title', array(

        'section' => '404_Page',
        'label'   => esc_html__('Sub Title Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Button text
    $wp_customize->add_setting('404_btn_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('404_btn_text', array(

        'section' => '404_Page',
        'label'   => esc_html__('Button Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Button url
    $wp_customize->add_setting('404_btn_url', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('404_btn_url', array(

        'section' => '404_Page',
        'label'   => esc_html__('Button url', 'eidmart'),
        'type'    => 'text',

    ));

    // Call to Action ***********************************************************************************
    $wp_customize->add_section('cta', array(

        'title'    => esc_html__('Page Call To Action', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efothers',

    ));

    // Background image
    $wp_customize->add_setting('cta_bg',

        array(
            'default' => '' . get_template_directory_uri() . '/images/counter-bg.jpg',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'cta_bg',
            array(
                'label'    => esc_html__('CTA background image', 'eidmart'),
                'section'  => 'cta',
                'settings' => 'cta_bg',
            )
        )
    );

    // Gradient RGB color one
    $wp_customize->add_setting('grad_one', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('grad_one', array(

        'section' => 'cta',
        'label'   => esc_html__('Gradient Color One', 'eidmart'),
        'type'    => 'text',

    ));

    // Gradient RGB color two
    $wp_customize->add_setting('grad_two', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('grad_two', array(

        'section' => 'cta',
        'label'   => esc_html__('Gradient Color Two', 'eidmart'),
        'type'    => 'text',

    ));

    // Main title
    $wp_customize->add_setting('cta_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('cta_title', array(

        'section' => 'cta',
        'label'   => esc_html__('Title Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Sub title
    $wp_customize->add_setting('desc', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('desc', array(

        'section' => 'cta',
        'label'   => esc_html__('Description', 'eidmart'),
        'type'    => 'textarea',

    ));

    // Button text 1
    $wp_customize->add_setting('btn_text1', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('btn_text1', array(

        'section' => 'cta',
        'label'   => esc_html__('Button Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Button url 1
    $wp_customize->add_setting('btn_url1', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('btn_url1', array(

        'section' => 'cta',
        'label'   => esc_html__('Button url', 'eidmart'),
        'type'    => 'text',

    ));

    // CTA width
    $wp_customize->add_setting(
        'cta_width',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'cta_width',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('CTA Width ( Container or Container Fluid )', 'eidmart'),
            'section'  => 'cta',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Container', 'eidmart'),
                '2' => esc_html__('Container Fluid', 'eidmart'),
            ),
        )
    );

    // CTA button style
    $wp_customize->add_setting(
        'button_style',
        array(
            'default'           => 'color-primary',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'button_style',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Call to action button style', 'eidmart'),
            'section'  => 'cta',
            'priority' => '20',
            'choices'  => array(                
                'color-1'  => esc_html__('Style one', 'eidmart'),
                'color-2'  => esc_html__('Style two', 'eidmart'),
                'color-3'  => esc_html__('Style three', 'eidmart'),
                'color-4'  => esc_html__('Style four', 'eidmart'),
                'color-5'  => esc_html__('Style five', 'eidmart'),
                'color-6'  => esc_html__('Style six', 'eidmart'),
                'color-7'  => esc_html__('Style seven', 'eidmart'),
                'color-8'  => esc_html__('Style eight', 'eidmart'),
                'color-9'  => esc_html__('Style nine', 'eidmart'),
                'color-10' => esc_html__('Style ten', 'eidmart'),
                'color-11' => esc_html__('Style eleven', 'eidmart'),
                'color-primary' => esc_html__('Style Primary', 'eidmart'),
                'color-secondary' => esc_html__('Style Secondary', 'eidmart'),
                'color-default' => esc_html__('Style Default', 'eidmart'),
                ''         => esc_html__('None', 'eidmart'),
            ),
        )
    );

    // Checkout page ***********************************************************************************
    $wp_customize->add_section('checkout', array(

        'title'    => esc_html__('Checkout Page Settings', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efothers',

    ));

    // Logo image
    $wp_customize->add_setting('checkout_logo',

        array(
            'default' => '' . get_template_directory_uri() . '/images/logo-dark.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'checkout_logo',
            array(
                'label'    => esc_html__('Checkout Page Logo', 'eidmart'),
                'section'  => 'checkout',
                'settings' => 'checkout_logo',
            )
        )
    );

    // Checkout banner image
    $wp_customize->add_setting('checkout_banner',

        array(
            'default' => '' . get_template_directory_uri() . '/images/checkout-banner.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'checkout_banner',
            array(
                'label'    => esc_html__('Checkout Banner', 'eidmart'),
                'section'  => 'checkout',
                'settings' => 'checkout_banner',
            )
        )
    );

    /***
    Separator Guarantee
    **/
    $wp_customize->add_setting('guarantee_separator', array(
        'default'           => '',
        'sanitize_callback' => 'esc_html',
    ));
    $wp_customize->add_control(
        new Separator_Custom_control(
            $wp_customize, 'guarantee_separator', array(
                'settings'		=> 'guarantee_separator',
                'label'       => esc_html__('Guarantee Sections', 'eidmart'),
                'section'  		=> 'checkout',
            )
        )
    );

    // Main title
    $wp_customize->add_setting('gurantee_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('gurantee_title', array(

        'section' => 'checkout',
        'label'   => esc_html__('Title Text', 'eidmart'),
        'type'    => 'text',

    ));

    // Description
    $wp_customize->add_setting('gurantee_desc', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('gurantee_desc', array(

        'section' => 'checkout',
        'label'   => esc_html__('Description Text', 'eidmart'),
        'type'    => 'textarea',

    ));

    // Gurantee image
    $wp_customize->add_setting('gurantee_image',

        array(
            'default' => '' . get_template_directory_uri() . '/images/moneyback.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'gurantee_image',
            array(
                'label'    => esc_html__('Gurantee Image', 'eidmart'),
                'section'  => 'checkout',
                'settings' => 'gurantee_image',
            )
        )
    );

    // Secured image
    $wp_customize->add_setting('secured_image',

        array(
            'default' => '' . get_template_directory_uri() . '/images/payment-security.svg',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'secured_image',
            array(
                'label'    => esc_html__('Secured Image', 'eidmart'),
                'section'  => 'checkout',
                'settings' => 'secured_image',
            )
        )
    );

    // Commitment
    /************************************************************************************/
    $wp_customize->add_section('commitment', array(

        'title'    => esc_html__('Our Commitment', 'eidmart'),
        'priority' => '20',
        'panel'    => 'efothers',

    ));

    // Commitment width
    $wp_customize->add_setting(
        'commitment_width',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'commitment_width',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Commitment Width ( Container or Container Fluid )', 'eidmart'),
            'section'  => 'commitment',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Container', 'eidmart'),
                '2' => esc_html__('Container Fluid', 'eidmart'),
            ),
        )
    );

    // Online payment image
    $wp_customize->add_setting('online_payment',

        array(
            'default' => '' . get_template_directory_uri() . '/images/feature-1.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'online_payment',
            array(
                'label'    => esc_html__('Upload payment image', 'eidmart'),
                'section'  => 'commitment',
                'settings' => 'online_payment',
            )
        )
    );

    // Online payment title
    $wp_customize->add_setting('payment_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('payment_title', array(

        'section' => 'commitment',
        'label'   => esc_html__('Title', 'eidmart'),
        'type'    => 'text',

    ));

    // Money back image
    $wp_customize->add_setting('money_back',

        array(
            'default' => '' . get_template_directory_uri() . '/images/feature-2.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'money_back',
            array(
                'label'    => esc_html__('Upload money back image', 'eidmart'),
                'section'  => 'commitment',
                'settings' => 'money_back',
            )
        )
    );

    // Money back title
    $wp_customize->add_setting('money_back_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('money_back_title', array(

        'section' => 'commitment',
        'label'   => esc_html__('Title', 'eidmart'),
        'type'    => 'text',

    ));

    // Money support image
    $wp_customize->add_setting('support',

        array(
            'default' => '' . get_template_directory_uri() . '/images/feature-3.png',
            'sanitize_callback' => 'eidmart_sanitize_image'
        )

    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'support',
            array(
                'label'    => esc_html__('Upload support image', 'eidmart'),
                'section'  => 'commitment',
                'settings' => 'support',
            )
        )
    );

    // Support title
    $wp_customize->add_setting('support_title', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('support_title', array(

        'section' => 'commitment',
        'label'   => esc_html__('Title', 'eidmart'),
        'type'    => 'text',

    ));

    /**************************************************************************************************
    Footer Section
     ***************************************************************************************************/

    // Footer Panel
    $wp_customize->add_panel('effooter', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Eidmart Footer', 'eidmart'),
        'description'    => esc_html__('Several settings pertaining eidmart theme', 'eidmart'),
    ));

    // Footer information ***********************************************************************************
    $wp_customize->add_section('footer', array(

        'title'    => esc_html__('Footer information', 'eidmart'),
        'priority' => '20',
        'panel'    => 'effooter',

    ));

    // Copyright text
    $wp_customize->add_setting('copy_text', array(

        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'

    ));
    $wp_customize->add_control('copy_text', array(

        'section' => 'footer',
        'label'   => esc_html__('Copyright text', 'eidmart'),
        'type'    => 'textarea',

    ));

    // Footer width
    $wp_customize->add_setting(
        'footer_width',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'footer_width',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Footer Width ( Container or Container Fluid )', 'eidmart'),
            'section'  => 'footer',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('Container', 'eidmart'),
                '2' => esc_html__('Container Fluid', 'eidmart'),
            ),
        )
    );

    // Footer style
    $wp_customize->add_setting(
        'footer_type',
        array(
            'default'           => '1',
            'sanitize_callback' => 'eidmart_header_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'footer_type',
        array(
            'type'     => 'radio',
            'label'    => esc_html__('Footer General/Animate Background', 'eidmart'),
            'section'  => 'footer',
            'priority' => '20',
            'choices'  => array(
                '1' => esc_html__('General', 'eidmart'),
                '2' => esc_html__('Background Animation', 'eidmart'),
                '3' => esc_html__('Dark', 'eidmart'),
            ),
        )
    );

    // Color Sanitization
    function color_sanitize_hex_color($hex_color, $setting) {
        // Sanitize $input as a hex value.
        $hex_color = sanitize_hex_color($hex_color);
        // If $input is a valid hex value, return it; otherwise, return the default.
        return (!is_null($hex_color) ? $hex_color : $setting->default);
    }

    // Radio options sanitizations
    function eidmart_header_sanitize_radio($input, $setting) {
        // Ensure input is a slug.
        $input = sanitize_key($input);
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control($setting->id)->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    // File input sanitization function
    function eidmart_sanitize_image( $input, $setting ) {

        $input = esc_url( $input );    
        $attrs = $setting->manager->get_control( $setting->id )->input_attrs;
        
        $extension = pathinfo( $input , PATHINFO_EXTENSION );
        
        if ( $input != $setting->default ) {
        
            if ( $extension == 'jpg' ) {
                return wp_get_attachment_image_src( attachment_url_to_postid( $input ) , $attrs['img_size'] )[0];
            } elseif ( $extension == 'jpeg' ) {
                return wp_get_attachment_image_src( attachment_url_to_postid( $input ) , $attrs['img_size'] )[0];
            } elseif ( $extension == 'png' ) {
                return wp_get_attachment_image_src( attachment_url_to_postid( $input ) , $attrs['img_size'] )[0];
            } elseif ( $extension == 'gif' ) {
                return $input;
            } elseif ( $extension == 'svg' && current_user_can('editor') || current_user_can('administrator') ) {
                return $input;
            }
            
        } else {            
            return esc_url( $setting->default );        
        }
        
    }

    // Date sanitization function
    function eidmart_sanitize_date( $input ) {
        $date = new DateTime( $input );
        return $date->format('Y-m-d');
    }

    // Remove default sections
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('nav');
    $wp_customize->remove_section('static_front_page');

}
add_action('customize_register', 'eidmart_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function eidmart_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function eidmart_customize_partial_blogdescription() {
    bloginfo('description');
}
