<?php
/**
 * Z Platform Theme Customizer
 *
 * @package Z_Platform
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function z_platform_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    // $wp_customize->get_setting( 'header_background_color' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'z_platform_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'z_platform_customize_partial_blogdescription',
            )
        );
    }

    // Z! Platform Header
    $wp_customize->add_section("theme_general", array(
        "title" => __("Z! Platform General", "z-platform"),
        "priority" => 30,
    ));

    $wp_customize->add_setting("theme_general_container_size", array(
        "default" => "1320",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_general_container_size', array(
            'label'      => esc_html__( 'General container size max width.', 'z-platform' ),
            'description'=> esc_html__('You can use pixels, rems, ems, percentages. for example 1400px, this will have effect only on resolutiosn 1280pixels and higher. for smaller resolutions it will default to Bootstraps default layout for optimal results on website responsive performance.', 'z-platform'),
            'settings'   => 'theme_general_container_size',
            'priority'   => 10,
            'section'    => 'theme_general',
            'type'    => 'text',
            'input_attrs' => array(
                'placeholder' => __( 'Ex: 1rem' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("theme_general_font_size", array(
        "default" => "1rem",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_general_font_size', array(
            'label'      => esc_html__( 'Body Font Size', 'z-platform' ),
            'settings'   => 'theme_general_font_size',
            'priority'   => 10,
            'section'    => 'theme_general',
            'type'    => 'text',
            'input_attrs' => array(
                'placeholder' => __( 'Ex: 1rem' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("general_text_color", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_text_color', array(
        'label' => esc_html__('Body Text Color', 'z-platform'),
        'section' => 'theme_general',
        'settings' => 'general_text_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("general_bg_color", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_bg_color', array(
        'label' => esc_html__('Body Background Color', 'z-platform'),
        'section' => 'theme_general',
        'settings' => 'general_bg_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("general_link_color", array(
        "default" => "#383838",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_link_color', array(
        'label' => esc_html__('Link Color', 'z-platform'),
        'section' => 'theme_general',
        'settings' => 'general_link_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("general_link_color_hover", array(
        "default" => "#383838",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_link_color_hover', array(
        'label' => esc_html__('Link Color Hover', 'z-platform'),
        'section' => 'theme_general',
        'settings' => 'general_link_color_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("general_links_underline", array(
        "default" => "underline",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'general_links_underline', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Remove underline from links?', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__('This will remove the underline from all links in content area, comments etc via CSS.' , 'z-platform'),
            'settings'   => 'general_links_underline',
            'priority'   => 10, 
            'section'    => 'theme_general',
            'type'    => 'select',
            'choices' => array(
                'none' => 'Yes',
                'underline' => 'No',
            ),
        )
    ) );

    // Z! Platform Header
    $wp_customize->add_section("theme_header", array(
        "title" => esc_html__("Z! Platform Header", "z-platform"),
        "priority" => 30,
    ));

    // Z! Platform Header Navigation
    $wp_customize->add_panel("theme_header_navigation", array(
        "title" => esc_html__("Navigation Menu", "z-platform"),
        "priority" => 1,
        "section" => 'theme_header'
    ));

    // Z! Platform Header General
    $wp_customize->add_section("theme_header_general", array(
        "title" => esc_html__("General", "z-platform"),
        "priority" => 1,
        "panel" => 'theme_header_navigation'
    ));

    $wp_customize->add_setting("header_logo_width", array(
        "default" => "220",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_kses_post',
        "panel" => 'theme_header'
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_logo_width', array(
            'label'      => esc_html__( 'Logo max width', 'z-platform' ),
            'settings'   => 'header_logo_width',
            'priority'   => 10,
            'section'    => 'title_tagline',
            'type'    => 'text',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: 220' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("header_logo_width_mobile", array(
        "default" => "140",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_logo_width_mobile', array(
            'label'      => esc_html__( 'Logo max width on mobile', 'z-platform' ),
            'settings'   => 'header_logo_width_mobile',
            'priority'   => 10,
            'section'    => 'title_tagline',
            'type'    => 'text',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: 140' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("header_top_container", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'header_top_container', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Display Top Header', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__('This will add another section on top of header, To display content in this area, create widgets in the top header left and / or top header right sidebar / widget areas.' , 'z-platform'),
            'settings'   => 'header_top_container', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'yes' => 'Yes',
                'no' => 'No',
            ),
        )
    ) );

    $wp_customize->add_setting("header_top_front_page", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'header_top_front_page', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Display Top Header On Front Page', 'z-platform' ), //Admin-visible name of the control
            'settings'   => 'header_top_front_page', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'active_callback' => 'header_top_enable_callback',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("header_top_container_mode", array(
        "default" => "container-fluid",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'header_top_container_mode', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Top Header Content Width', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Stretch header content to full width or display in centered container' , 'z-platform' ),
            'settings'   => 'header_top_container_mode', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'active_callback' => 'header_top_enable_callback',
            'choices' => array(
                'container' => 'Container',
                'container-fluid' => 'Full Width',
            ),
        )
    ) );

    $wp_customize->add_setting("header_top_background_color", array(
        "default" => "#21242e",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_background_color', array(
        'label' => esc_html__('Choose Top Header Background Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_top_background_color',
        'type' => 'color',
        'active_callback' => 'header_top_enable_callback',
    )));

    $wp_customize->add_setting("header_top_text_color", array(
        "default" => "#8d94a8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_text_color', array(
        'label' => esc_html__('Choose Top Header Text Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_top_text_color',
        'type' => 'color',
        'active_callback' => 'header_top_enable_callback',
    )));

    $wp_customize->add_setting("header_top_url_color", array(
        "default" => "#8d94a8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_url_color', array(
        'label' => esc_html__('Choose Top Header Url Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_top_url_color',
        'type' => 'color',
        'active_callback' => 'header_top_enable_callback',
    )));

    $wp_customize->add_setting("header_top_url_color_hover", array(
        "default" => "#8d94a8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_url_color_hover', array(
        'label' => esc_html__('Choose Top Header Url Color Hover', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_top_url_color_hover',
        'type' => 'color',
        'active_callback' => 'header_top_enable_callback',
    )));

    $wp_customize->add_setting("header_container_mode", array(
        "default" => "container",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'header_container_mode', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Header Container Mode', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Stretch header content to full width or display in centered container' , 'z-platform' ),
            'settings'   => 'header_container_mode', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_header', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'container' => 'Container',
                'container-fluid' => 'Full Width',
            ),
        )
    ) );

    $wp_customize->add_setting("enable_sticky_header", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_sticky_header', array(
            'label'      => esc_html__( 'Enable Sticky Header', 'z-platform' ),
            'settings'   => 'enable_sticky_header',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                '' => 'No',
                'sticky-top' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("enable_offcanvas_menu", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_offcanvas_menu', array(
            'label'      => esc_html__( 'Enable Off-Canvas Menu', 'z-platform' ),
            'settings'   => 'enable_offcanvas_menu',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("header_background_color", array(
        "default" => "#f8f9fa",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
        'label' => esc_html__('Choose Header Background Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_background_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("header_border_bottom_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_border_bottom_color', array(
        'label' => esc_html__('Choose Header Border Bottom Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'header_border_bottom_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_link_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_link_color', array(
        'label' => esc_html__('Menu Item Link Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_link_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_link_hover_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_link_hover_color', array(
        'label' => esc_html__('Menu Item Link Hover Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_link_hover_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_link_active", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_link_active', array(
        'label' => esc_html__('Menu Item Link Active', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_link_active',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_link_bg_active", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_link_bg_active', array(
        'label' => esc_html__('Menu Item Link Active Background', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_link_bg_active',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_background_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_background_color', array(
        'label' => esc_html__('Menu Item Background Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_background_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("menu_item_hover_background_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_hover_background_color', array(
        'label' => esc_html__('Menu Item Hover Background Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'menu_item_hover_background_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("submenu_background_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_background_color', array(
        'label' => esc_html__('Submenu Background Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'submenu_background_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("submenu_text_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_text_color', array(
        'label' => esc_html__('Submenu Text Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'submenu_text_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("bootstrap_navbar_alignment", array(
        "default" => "ms-auto",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bootstrap_navbar_alignment', array(
            'label'      => esc_html__( 'Menu Alignment', 'z-platform' ),
            'settings'   => 'bootstrap_navbar_alignment',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                'ms-auto' => 'Right',
                'me-auto' => 'Left',
                'mx-auto' => 'Center',
            ),
            'active_callback' => function() {
                $checkbox_value = get_theme_mod( 'enable_offcanvas_menu' );
                // $radio_value    = get_theme_mod( 'my_radio', 'option-1' );

                if ( $checkbox_value === 'no' ) {
                    return true;
                }
                return false;
            },
        )
    ) );



    $wp_customize->add_setting("bootstrap_navbar_gap", array(
        "default" => "gap-0",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bootstrap_navbar_gap', array(
            'label'      => esc_html__( 'Margin Between Menu Items', 'z-platform' ),
            'settings'   => 'bootstrap_navbar_gap',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                'gap-0' => '0',
                'gap-1' => '1',
                'gap-2' => '2',
                'gap-3' => '3',
                'gap-4' => '4',
                'gap-5' => '5',
            ),
            'active_callback' => function() {
                $checkbox_value = get_theme_mod( 'enable_offcanvas_menu' );
                // $radio_value    = get_theme_mod( 'my_radio', 'option-1' );

                if ( $checkbox_value === 'no' ) {
                    return true;
                }
                return false;
            },
        )
    ) );

    $wp_customize->add_setting("bootstrap_navbar_alignment_canvas", array(
        "default" => "text-auto",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bootstrap_navbar_alignment_canvas', array(
            'label'      => esc_html__( 'Menu Alignment', 'z-platform' ),
            'settings'   => 'bootstrap_navbar_alignment_canvas',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                'text-auto' => 'Left',
                'text-center' => 'Center',
            ),
            'active_callback' => function() {
                $checkbox_value = get_theme_mod( 'enable_offcanvas_menu' );
                // $radio_value    = get_theme_mod( 'my_radio', 'option-1' );
                if ( $checkbox_value === 'yes' ) {
                    return true;
                }
                return false;
            },
        )
    ) );

    $wp_customize->add_setting("enable_navbar_cta", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_navbar_cta', array(
            'label'      => esc_html__( 'Enable CTA in Navbar?', 'z-platform' ),
            'settings'   => 'enable_navbar_cta',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'radio',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("header_cta_text", array(
        "default" => "CTA",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_cta_text', array(
            'label'      => esc_html__( 'CTA Text', 'z-platform' ),
            'settings'   => 'header_cta_text',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'text',
            'active_callback' => 'header_cta_enable_callback',
            'input_attrs' => array(
                'placeholder' => __( 'Ex: Buy Now' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting( 'header_cta_url', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'header_cta_url', array(
        'type' => 'url',
        'section' => 'theme_header',
        'label' => __( 'CTA URL' , 'z-platform' ),
        'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.domain.com', 'z-platform' ),
        ),
        'active_callback' => 'header_cta_enable_callback',
    ) );

    $wp_customize->add_setting("header_cta_button_class", array(
        "default" => "btn-primary",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_cta_button_class', array(
            'label'      => esc_html__( 'CTA Color & Style', 'z-platform' ),
            'settings'   => 'header_cta_button_class',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'choices' => array(
                'btn-primary' => esc_html__('Primary Blue', 'z-platform'),
                'btn-secondary' => esc_html__('Secondary Grey', 'z-platform'),
                'btn-success' => esc_html__('Green', 'z-platform'),
                'btn-danger' => esc_html__('Red', 'z-platform'),
                'btn-warning'   => esc_html__('Yellow', 'z-platform'),
                'btn-info'  =>  esc_html__('Light Blue', 'z-platform'),
                'btn-light' =>  esc_html__('Silver Grey', 'z-platform'),
                'btn-dark'  =>  esc_html__('Black', 'z-platform'),
                'btn-outline-primary' => esc_html__('Outline Primary Blue', 'z-platform'),
                'btn-outline-secondary' => esc_html__('Outline Secondary Grey', 'z-platform'),
                'btn-outline-success' => esc_html__('Outline Green', 'z-platform'),
                'btn-outline-danger' => esc_html__('Outline Red', 'z-platform'),
                'btn-outline-warning'   => esc_html__('Outline Yellow', 'z-platform'),
                'btn-outline-info'  =>  esc_html__('Outline Light Blue', 'z-platform'),
                'btn-outline-light' =>  esc_html__('Outline Silver Grey', 'z-platform'),
                'btn-outline-dark'  =>  esc_html__('Outline Black', 'z-platform'),
            ),
            'active_callback' => 'header_cta_enable_callback',
        )
    ) );

    $wp_customize->add_setting("cta_size", array(
        "default" => "btn",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cta_size', array(
            'label'      => esc_html__( 'CTA Size', 'z-platform' ),
            'settings'   => 'cta_size',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'active_callback' => 'header_cta_enable_callback',
            'choices' => array(
                'btn-sm' => 'Small',
                'btn' => 'Medium',
                'btn-lg' => 'Large',
            ),
        )
    ) );


    $wp_customize->add_setting("cta_border_radius", array(
        "default" => "1rem",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cta_border_radius', array(
            'label'      => esc_html__( 'CTA Border Radius', 'z-platform' ),
            'settings'   => 'cta_border_radius',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'text',
            'active_callback' => 'header_cta_enable_callback',
            'input_attrs' => array(
                'placeholder' => __( 'Ex: 1rem' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("cta_mobile_display", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cta_mobile_display', array(
            'label'      => esc_html__( 'Display CTA on Mobile ?', 'z-platform' ),
            'description'      => __( 'If you want to display CTA text in the mobile screen, just leave it in " Yes ".', 'z-platform' ),
            'settings'   => 'cta_mobile_display',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'active_callback' => 'header_cta_enable_callback',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("cta_size_mobile", array(
        "default" => "btn",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cta_size_mobile', array(
            'label'      => esc_html__( 'CTA Size for Mobile Version', 'z-platform' ),
            'settings'   => 'cta_size_mobile',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'select',
            'active_callback' => 'header_cta_mobile_enable_callback',
            'choices' => array(
                'btn-sm' => 'Small',
                'btn' => 'Medium',
                'btn-lg' => 'Large',
            ),
        )
    ) );

    $wp_customize->add_setting("cta_text_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_text_color', array(
        'label' => esc_html__('CTA Text Custom Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'cta_text_color',
        'type' => 'color',
        'active_callback' => 'header_cta_enable_callback',
    )));

    $wp_customize->add_setting("cta_text_color_hover", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_text_color_hover', array(
        'label' => esc_html__('CTA Text Custom Hover Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'cta_text_color_hover',
        'type' => 'color',
        'active_callback' => 'header_cta_enable_callback',
    )));

    $wp_customize->add_setting("cta_bg_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bg_color', array(
        'label' => esc_html__('CTA Background Custom Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'cta_bg_color',
        'type' => 'color',
        'active_callback' => 'header_cta_enable_callback',
    )));

    $wp_customize->add_setting("cta_bg_color_hover", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bg_color_hover', array(
        'label' => esc_html__('CTA Background Custom Hover Color', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'cta_bg_color_hover',
        'type' => 'color',
        'active_callback' => 'header_cta_enable_callback',
    )));

    $wp_customize->add_setting("cta_bg_border", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bg_border', array(
        'label' => esc_html__('CTA Background Custom Border', 'z-platform'),
        'section' => 'theme_header',
        'settings' => 'cta_bg_border',
        'type' => 'color',
        'active_callback' => 'header_cta_enable_callback',
    )));

    $wp_customize->add_setting("enable_navbar_search", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_navbar_search', array(
            'label'      => esc_html__( 'Enable Search In Navbar?', 'z-platform' ),
            'settings'   => 'enable_navbar_search',
            'priority'   => 10,
            'section'    => 'theme_header',
            'type'    => 'radio',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );
    if ( class_exists( 'WooCommerce', 'z-platform' ) ) {
        $wp_customize->add_setting("enable_header_cart", array(
            "default" => "no",
            "transport" => "refresh",
            'sanitize_callback' => 'z_platform_sanitize_radio',
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'enable_header_cart', array(
                'label' => esc_html__('Enable Cart in Navbar?', 'z-platform'),
                'settings' => 'enable_header_cart',
                'priority' => 10,
                'section' => 'theme_header',
                'type' => 'radio',
                'choices' => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ),
            )
        ));
    }


    // Z! Platform Footer
    $wp_customize->add_section("theme_footer", array(
        "title" => esc_html__("Z! Platform Footer", "z-platform"),
        "priority" => 30,
    ));

    $wp_customize->add_setting("footer_container_mode", array(
        "default" => "container",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_setting("theme_top_footer", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_top_footer', array(
            'label'      => esc_html__( 'Display Top Footer', 'z-platform' ),
            'description'   => esc_html__('This will add another section on top of footer, but it will only be displayed if there is content available in footer 1, 2, 3, 4 widget areas. If the widgets have no content, this section will not show up.' , 'z-platform'),
            'settings'   => 'theme_top_footer',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'select',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'footer_container_mode', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Top Footer Layout', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Stretch footer content to full width or display in boxed container' , 'z-platform' ),
            'settings'   => 'footer_container_mode', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_footer', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'container' => 'Container',
                'container-fluid' => 'Full Width',
            ),
            'active_callback'   => 'theme_top_footer_enable_callback',
        )
    ) );

    $wp_customize->add_setting("footer_border", array(
        "default" => "1px",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_border', array(
            'label'      => esc_html__( 'Footer Top Border Pixels', 'z-platform' ),
            'settings'   => 'footer_border',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'text',
            'active_callback' => 'header_cta_enable_callback',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: 1px' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_top_footer_enable_callback',
        )
    ) );

    $wp_customize->add_setting("footer_border", array(
        "default" => "#efefef",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border', array(
        'label' => esc_html__('Top Footer Border Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_border',
        'type' => 'color',
        'active_callback'   => 'theme_top_footer_enable_callback',
    )));

    $wp_customize->add_setting("footer_background_top", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_top', array(
        'label' => esc_html__('Footer Top Background Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_background_top',
        'type' => 'color',
        'active_callback'   => 'theme_top_footer_enable_callback',
    )));

    $wp_customize->add_setting("footer_text_color_top", array(
        "default" => "#8d94a8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color_top', array(
        'label' => esc_html__('Footer Top Text Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_text_color_top',
        'type' => 'color',
        'active_callback'   => 'theme_top_footer_enable_callback',
    )));

    $wp_customize->add_setting("theme_footer_fixed_section", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_fixed_section', array(
            'label'      => esc_html__( 'Display Fixed Section', 'z-platform' ),
            'description'   => esc_html__('This will display your custom html code or shortcode fixed in footer, you can choose to display it in a mobile, desktop or both of them and choose the side also, left or right.', 'z-platform'),
            'settings'   => 'theme_footer_fixed_section',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'select',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
        )
    ) );

    $wp_customize->add_setting("theme_footer_fixed_section_screen", array(
        "default" => "both",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'theme_footer_fixed_section_screen', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Fixed Section - Select Screen', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Select the screen in where do you want to show the fixed section, mobile, desktop or in both of them.' , 'z-platform' ),
            'settings'   => 'theme_footer_fixed_section_screen', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_footer', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'mobile' => 'Mobile',
                'desktop' => 'Desktop',
                'both' => 'Mobile & Desktop',
            ),
            'active_callback'   => 'theme_fixed_footer_section_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_fixed_section_alignment", array(
        "default" => "text-start",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'theme_footer_fixed_section_alignment', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Fixed Section - Select Alignment', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Choose where do you want to display, on the left side, right or center.' , 'z-platform' ),
            'settings'   => 'theme_footer_fixed_section_alignment', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_footer', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'text-start' => 'Left Side',
                'text-end' => 'Right Side',
                'text-center' => 'Midle',
            ),
            'active_callback'   => 'theme_fixed_footer_section_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_fixed_section_code", array(
        "default" => "All rights are reserved",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_fixed_section_code', array(
            'label'      => esc_html__( 'Fixed Section - Your shortcode or HTML', 'z-platform' ),
            'description' => esc_html__( 'Insert your shortcode in here, for example : [your-shortcode-name] or insert your custom HTML code.' , 'z-platform' ),
            'settings'   => 'theme_footer_fixed_section_code',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex : [your-shortcode-name]' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_fixed_footer_section_enable_callback',
        )
    ) );

    $wp_customize->add_setting("footer_container_mode_bottom", array(
        "default" => "container",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'footer_container_mode_bottom', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Bottom Footer Layout', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Stretch footer content to full width or display in boxed container' , 'z-platform' ),
            'settings'   => 'footer_container_mode_bottom', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_footer', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'container' => 'Container',
                'container-fluid' => 'Full Width',
            ),
        )
    ) );

    $wp_customize->add_setting("footer_background_bottom", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_setting("footer_bottom_border", array(
        "default" => "1px",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_bottom_border', array(
            'label'      => esc_html__( 'Footer Bottom Border in Pixels', 'z-platform' ),
            'settings'   => 'footer_bottom_border',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'text',
            'active_callback' => 'header_cta_enable_callback',
            'input_attrs' => array(
                'placeholder' => __( 'Ex: 1' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("footer_border_bottom", array(
        "default" => "#efefef",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border_bottom', array(
        'label' => esc_html__('Bottom Footer Border Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_border_bottom',
        'type' => 'color'
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_bottom', array(
        'label' => esc_html__('Footer Bottom Background Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_background_bottom',
        'type' => 'color'
    )));

    $wp_customize->add_setting("footer_text_color_bottom", array(
        "default" => "#8d94a8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color_bottom', array(
        'label' => esc_html__('Footer Bottom Text Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'footer_text_color_bottom',
        'type' => 'color'
    )));

    $wp_customize->add_setting("footer_copyright_text", array(
        "default" => "All rights are reserved",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_copyright_text', array(
            'label'      => esc_html__( 'Copyright Text', 'z-platform' ),
            'settings'   => 'footer_copyright_text',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: All rights are reserved' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("theme_footer_style", array(
        "default" => "style_1",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_style', array(
            'label'      => esc_html__( 'Bottom Footer Style', 'z-platform' ),
            'settings'   => 'theme_footer_style',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'select',
            'choices' => array(
                'style_1' => esc_html__('Style 1', 'z-platform'),
                'style_2' => esc_html__('Style 2', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting( 'footer_logo', array(
        // 'default' => get_theme_file_uri('assets/image/logo.jpg'), // Add Default Image URL
        'sanitize_callback' => 'z_platform_sanitize_file',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label' => esc_html__('Upload Logo For Footer', 'z-platform'),
        'description' => esc_html__('If you dont want to use an image in the Footer part, leave it blank.', 'z-platform'),
        'priority' => 10,
        'section' => 'theme_footer',
        'settings' => 'footer_logo',
        'button_labels' => array(// All These labels are optional
            'select' => esc_html__('Select Logo', 'z-platform'),
            'remove' => esc_html__('Remove Logo', 'z-platform'),
            'change' => esc_html__('Change Logo', 'z-platform'),
        ),
        'active_callback'   => 'theme_footer_style_enable_callback',
    )));

    $wp_customize->add_setting("theme_footer_social_facebook", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_social_facebook', array(
            'label'      => esc_html__( 'Facebook URL', 'z-platform' ),
            'settings'   => 'theme_footer_social_facebook',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'url',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Paste URL Here' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_footer_style_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_social_twitter", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_social_twitter', array(
            'label'      => esc_html__( 'Twitter URL', 'z-platform' ),
            'settings'   => 'theme_footer_social_twitter',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'url',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Paste URL Here' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_footer_style_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_social_telegram", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_social_telegram', array(
            'label'      => esc_html__( 'Telegram URL', 'z-platform' ),
            'settings'   => 'theme_footer_social_telegram',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'url',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Paste URL Here' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_footer_style_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_social_pinterest", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_social_pinterest', array(
            'label'      => esc_html__( 'Pinterest URL', 'z-platform' ),
            'settings'   => 'theme_footer_social_pinterest',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'url',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Paste URL Here' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_footer_style_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_social_linkedin", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_footer_social_linkedin', array(
            'label'      => esc_html__( 'Linkedin URL', 'z-platform' ),
            'settings'   => 'theme_footer_social_linkedin',
            'priority'   => 10,
            'section'    => 'theme_footer',
            'type'    => 'url',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Paste URL Here' , 'z-platform' ),
            ),
            'active_callback'   => 'theme_footer_style_enable_callback',
        )
    ) );

    $wp_customize->add_setting("theme_footer_social_url", array(
        "default" => "#8D94A8",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_social_url', array(
        'label' => esc_html__('Footer Social Icons Color', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'theme_footer_social_url',
        'type' => 'color',
        'active_callback'   => 'theme_footer_style_enable_callback',
    )));

    $wp_customize->add_setting("theme_footer_social_url_hover", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_social_url_hover', array(
        'label' => esc_html__('Footer Social Icons Color Hover', 'z-platform'),
        'section' => 'theme_footer',
        'settings' => 'theme_footer_social_url_hover',
        'type' => 'color',
        'active_callback'   => 'theme_footer_style_enable_callback',
    )));

    // Z! Platform Blog
    $wp_customize->add_panel("theme_blog", array(
        "title" => esc_html__("Z! Platform Blog", "z-platform"),
        "priority" => 50,
    ));

    // Z! Platform Blog Main Page
    $wp_customize->add_section("theme_blog_main", array(
        "title" => esc_html__("Z! Platform Blog Main Page", "z-platform"),
        "priority" => 1,
        "panel" => 'theme_blog'
    ));

    $wp_customize->add_setting("theme_blog_main_breadcrumbs", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_blog_main_breadcrumbs', array(
            'label'      => esc_html__( 'Enable Breadcrumbs', 'z-platform' ),
            'description'   => esc_html__('Enable breadcrumbs and paste your shortcode to show it in a Blog pages' , 'z-platform'),
            'settings'   => 'theme_blog_main_breadcrumbs',
            'priority'   => 10,
            'section'    => 'theme_blog_main',
            'type'    => 'radio',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting( 'theme_blog_main_breadcrumbs_shortcode', array(
        'default' => 'Insert Shortcode Here',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'theme_blog_main_breadcrumbs_shortcode', array(
        'type' => 'textarea',
        'section' => 'theme_blog_main',
        'label' => esc_html__( 'Insert Breadcrumbs Shortcode' , 'z-platform' ),
        'description' => esc_html__( 'Enable breadcrumbs and paste your shortcode to show it in a Blog pages' , 'z-platform' ),
        'active_callback'   => 'theme_blog_main_breadcrumbs_enable_callback',
    ) );

    $wp_customize->add_setting("display_blog_title", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_blog_title', array(
            'label'      => esc_html__( 'Display Blog Title', 'z-platform' ),
            'settings'   => 'display_blog_title',
            'priority'   => 10,
            'section'    => 'theme_blog_main',
            'type'    => 'radio',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    // Z! Platform Posts Loop
    $wp_customize->add_section("theme_archive", array(
        "title" => esc_html__("Z! Platform Archive Settings", "z-platform"),
        "priority" => 1,
        "panel" => 'theme_blog'
    ));

    $wp_customize->add_setting('theme_archive_sidebar', array(
        'default'    => '1',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'theme_archive_sidebar',
            array(
                'label'     => esc_html__('Display Sidebar', 'z-platform'),
                'description' => esc_html__('Please beware, when activated, it will show empty space, if there are not widget content defined for sidebar.', 'z-platform'),
                'section'   => 'theme_archive',
                'settings'  => 'theme_archive_sidebar',
                'type'      => 'checkbox',
            )
        ));

    $wp_customize->add_setting("theme_archive_style", array(
        "default" => "archive_1",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'theme_archive_style', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Posts List Style', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Select the layout you want for the category page' , 'z-platform' ),
            'settings'   => 'theme_archive_style', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_archive', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'archive_1' => 'Style 1',
                'archive_2' => 'Style 2',
                'archive_3' => 'Style 3',
            ))    ) );

    $wp_customize->add_setting("archive_container_mode", array(
        "default" => "container",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'archive_container_mode', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Main Layout', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Stretch layout content to full width or display in boxed container' , 'z-platform' ),
            'settings'   => 'archive_container_mode', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_archive', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'container' => esc_html__('Container', 'z-platform'),
                'container-fluid' => esc_html__('Full Width', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_blog_columns", array(
        "default" => "6",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_blog_columns', array(
            'label'      => esc_html__( 'Blog Post Columns', 'z-platform' ),
            'settings'   => 'display_single_blog_columns',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'select',
            'choices' => array(
                '12' => '1',
                '6' => '2',
                '4' => '3',
                '3' => '4',
            ),
        )
    ) );

    $wp_customize->add_setting("display_archive_desc", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_archive_desc', array(
            'label'      => esc_html__( 'Display Archive Description', 'z-platform' ),
            'settings'   => 'display_archive_desc',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("post_blog_style_1_meta", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_blog_style_1_meta', array(
            'label'      => esc_html__( 'Display Meta Info', 'z-platform' ),
            'settings'   => 'post_blog_style_1_meta',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("post_blog_style_1_title", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_blog_style_1_title', array(
            'label'      => esc_html__( 'Display Title Post', 'z-platform' ),
            'settings'   => 'post_blog_style_1_title',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("post_blog_style_1_content", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_blog_style_1_content', array(
            'label'      => esc_html__( 'Display Excerpt', 'z-platform' ),
            'settings'   => 'post_blog_style_1_content',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("theme_archive_excerpt", array(
        "default" => "25",
        "transport" => "refresh",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_archive_excerpt', array(
            'label'      => esc_html__( 'Excerpt Limit To Amount Of X Words', 'z-platform' ),
            'settings'   => 'theme_archive_excerpt',
            'priority'   => 10,
            'section'    => 'theme_archive',
            'type'    => 'text',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: 25' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("archive_title_color", array(
        "default" => "#282828",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archive_title_color', array(
        'label' => esc_html__('Category Title Color', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'archive_title_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("article_title_color", array(
        "default" => "#282828",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_title_color', array(
        'label' => esc_html__('Title Color', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'article_title_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("article_title_color_hover", array(
        "default" => "#dd3333",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_title_color_hover', array(
        'label' => esc_html__('Title Color On Hover', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'article_title_color_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("article_content_color", array(
        "default" => "#6d6d6d",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_content_color', array(
        'label' => esc_html__('Excerpt Color', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'article_content_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("read_more_button_background", array(
        "default" => "#ffc107",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'read_more_button_background', array(
        'label' => esc_html__('Read More Button Background Color', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'read_more_button_background',
        'type' => 'color'
    )));

    $wp_customize->add_setting("read_more_button_background_hover", array(
        "default" => "#6d6d6d",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'read_more_button_background_hover', array(
        'label' => esc_html__('Read More Button Background Color Hover', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'read_more_button_background_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("read_more_button_text", array(
        "default" => "#000",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'read_more_button_text', array(
        'label' => esc_html__('Read More Button Text Color', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'read_more_button_text',
        'type' => 'color'
    )));

    $wp_customize->add_setting("read_more_button_text_hover", array(
        "default" => "#6d6d6d",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'read_more_button_text_hover', array(
        'label' => esc_html__('Read More Button Text Color Hover', 'z-platform'),
        'section' => 'theme_archive',
        'settings' => 'read_more_button_text_hover',
        'type' => 'color'
    )));

    // Z! Platform Posts Loop
    $wp_customize->add_section("theme_single_post", array(
        "title" => __("Z! Platform Single Post", "z-platform"),
        "priority" => 1,
        "panel" => 'theme_blog'
    ));

    $wp_customize->add_setting('theme_single_post_sidebar', array(
        'default'    => '1',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'theme_single_post_sidebar',
            array(
                'label'     => esc_html__('Display Sidebar', 'z-platform'),
                'description' => esc_html__('Please beware, when activated, it will show empty space, if there are not widget content defined for sidebar.', 'z-platform'),
                'section'   => 'theme_single_post',
                'settings'  => 'theme_single_post_sidebar',
                'type'      => 'checkbox',
            )
        ));

    $wp_customize->add_setting("theme_single_style", array(
        "default" => "style_2",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'theme_single_style', //Set a unique ID for the control
        array(
            'label'      => esc_html__( 'Select Posts List Style', 'z-platform' ), //Admin-visible name of the control
            'description' => esc_html__( 'Select the layout you want for the category page' , 'z-platform' ),
            'settings'   => 'theme_single_style', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'theme_single_post', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'    => 'select',
            'choices' => array(
                'style_1' => esc_html__('Style 1', 'z-platform'),
                'style_2' => esc_html__('Style 2', 'z-platform'),
            ))
    ));

    $wp_customize->add_setting("display_single_img", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_img', array(
            'label'      => esc_html__( 'Display Featured Image', 'z-platform' ),
            'settings'   => 'display_single_img',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_author", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_author', array(
            'label'      => esc_html__( 'Display Author', 'z-platform' ),
            'settings'   => 'display_single_author',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_comments", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_comments', array(
            'label'      => esc_html__( 'Display Comments', 'z-platform' ),
            'settings'   => 'display_single_comments',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_category", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_category', array(
            'label'      => esc_html__( 'Display Categories Of Post', 'z-platform' ),
            'settings'   => 'display_single_category',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_tag", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_tag', array(
            'label'      => esc_html__( 'Display Tags Of Post', 'z-platform' ),
            'settings'   => 'display_single_tag',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_related", array(
        "default" => "yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_related', array(
            'label'      => esc_html__( 'Display Related Posts', 'z-platform' ),
            'settings'   => 'display_single_related',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_related_columns", array(
        "default" => "6",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_related_columns', array(
            'label'      => esc_html__( 'Number Of Columns For Related Posts', 'z-platform' ),
            'settings'   => 'display_single_related_columns',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'active_callback'   => 'z_platform_related_posts_enable_callback',
            'type'    => 'select',
            'choices' => array(
                '3' => '4',
                '4' => '3',
                '6' => '2',
            ),
        )
    ) );

    $wp_customize->add_setting("display_single_related_posts_number", array(
        "default" => "6",
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_single_related_posts_number', array(
            'label'      => esc_html__( 'Number Of Related Posts', 'z-platform' ),
            'settings'   => 'display_single_related_posts_number',
            'priority'   => 10,
            'section'    => 'theme_single_post',
            'active_callback'   => 'z_platform_related_posts_enable_callback',
            'type'    => 'text',
            'active_callback' => 'z_platform_related_posts_enable_callback',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Ex: 6' , 'z-platform' ),
            ),
        )
    ) );

    $wp_customize->add_setting("single_post_content_color", array(
        "default" => "#313131",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_color', array(
        'label' => esc_html__('Article Body Text Color', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("single_post_content_category_color", array(
        "default" => "#767676",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_category_color', array(
        'label' => esc_html__('Category / Tag Text Color', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_category_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("single_post_content_category_color_hover", array(
        "default" => "#383838",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_category_color_hover', array(
        'label' => esc_html__('Category / Tag Text Color Hover', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_category_color_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("single_post_content_category_bg_color", array(
        "default" => "#efefef",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_category_bg_color', array(
        'label' => esc_html__('Category / Tag Background Color', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_category_bg_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("single_post_content_category_bg_color_hover", array(
        "default" => "#efefef",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_category_bg_color_hover', array(
        'label' => esc_html__('Category / Tag Background Color Hover', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_category_bg_color_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("single_post_content_heading", array(
        "default" => "#282828",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
        // "transport" => "postMessage",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'single_post_content_heading', array(
        'label' => esc_html__('Heading Color', 'z-platform'),
        'section' => 'theme_single_post',
        'settings' => 'single_post_content_heading',
        'type' => 'color'
    )));

    // Z! Platform Integrations
    $wp_customize->add_section("theme_integrations", array(
        "title" => esc_html__("Z! Platform Integrations", "z-platform"),
        "priority" => 60,
    ));

    $wp_customize->add_setting("theme_integrations_header_script", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_html',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_integrations_header_script', array(
            'label'      => esc_html__( 'Header Script', 'z-platform' ),
            'description' => esc_html__( 'Insert your script here which one will load on header.' , 'z-platform' ),
            'settings'   => 'theme_integrations_header_script',
            'priority'   => 10,
            'section'    => 'theme_integrations',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Insert code here.' , 'z-platform' ),
            )
        )
    ) );

    $wp_customize->add_setting("theme_integrations_body_script", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_html',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_integrations_body_script', array(
            'label'      => esc_html__( 'Body Script', 'z-platform' ),
            'description' => esc_html__( 'Insert your script here which one will load inside body.' , 'z-platform' ),
            'settings'   => 'theme_integrations_body_script',
            'priority'   => 10,
            'section'    => 'theme_integrations',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Insert code here.' , 'z-platform' ),
            )
        )
    ) );

    $wp_customize->add_setting("theme_integrations_footer_script", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_html',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_integrations_footer_script', array(
            'label'      => esc_html__( 'Footer Script', 'z-platform' ),
            'description' => esc_html__( 'Insert your script here which one will load inside footer.' , 'z-platform' ),
            'settings'   => 'theme_integrations_footer_script',
            'priority'   => 10,
            'section'    => 'theme_integrations',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Insert code here.' , 'z-platform' ),
            )
        )
    ) );

    $wp_customize->add_setting("theme_integrations_woo_thank_you_page", array(
        "default" => "",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_html',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_integrations_woo_thank_you_page', array(
            'label'      => esc_html__( 'Woo Thank You Page', 'z-platform' ),
            'description' => esc_html__( 'Insert your script here which one will load when user is redirected to the thank you page of Woocommerce.' , 'z-platform' ),
            'settings'   => 'theme_integrations_woo_thank_you_page',
            'priority'   => 10,
            'section'    => 'theme_integrations',
            'type'    => 'textarea',
            'input_attrs' => array(
                'placeholder' => esc_html__( 'Insert code here.' , 'z-platform' ),
            )
        )
    ) );

    // Z! Platform Homepage
    $wp_customize->add_section("z_platform_homepage", array(
        "title" => esc_html__("Z! Platform Homepage", "z-platform"),
        "priority" => 30,
    ));

    $wp_customize->add_setting("z_transparent_header", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_transparent_header', array(
            'label'      => esc_html__( 'Enable Transparent Header', 'z-platform' ),
            'description'   => esc_html__( 'Makes the header transparent on Homepage, so you can overlay header on top of a background image / hero section' , 'z-platform'),
            'settings'   => 'z_transparent_header',
            'priority'   => 10,
            'section'    => 'z_platform_homepage',
            'type'    => 'radio',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ),
        )
    ) );
    $wp_customize->add_setting( 'z_transparent_header_logo', array(
        // 'default' => get_theme_file_uri('assets/image/logo.jpg'), // Add Default Image URL
        'default'   => '',
        'sanitize_callback' => 'z_platform_sanitize_file',
        "transport" => "refresh",
    ));

    $wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'z_transparent_header_logo',
        array(
            'label'      => esc_html__('Upload Logo For Transparent Header Section', 'z-platform'),
            'section' => 'z_platform_homepage',
            'settings' => 'z_transparent_header_logo',
            'extensions' => array( 'jpg', 'jpeg', 'gif', 'png', 'svg' ),
            'active_callback'   => 'transparent_header_enable_callback',
        )
    ));

    $wp_customize->add_setting("z_transparent_header_sticky_header", array(
        "default" => "home_sticky_header_yes",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_radio',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_transparent_header_sticky_header', array(
            'label'      => esc_html__( 'Enable Sticky Header', 'z-platform' ),
            'description'   => esc_html__( 'Sticky header just for homepage, if you want to enable it just leave it in " Yes ".' , 'z-platform'),
            'settings'   => 'z_transparent_header_sticky_header',
            'priority'   => 10,
            'section'    => 'z_platform_homepage',
            'type'    => 'select',
            'choices' => array(
                'home_sticky_header_no' => esc_html__('No', 'z-platform'),
                'home_sticky_header_yes' => esc_html__('Yes', 'z-platform'),
            ),
            'active_callback'   => 'transparent_header_enable_callback',
        )
    ) );

    $wp_customize->add_setting( 'z_transparent_header_desktop_margin_top', array(
        'default' => '3rem',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( 'z_transparent_header_desktop_margin_top', array(
        'type' => 'text',
        'section' => 'z_platform_homepage',
        'label' => esc_html__( 'Margin top on desktop view' , 'z-platform' ),
        'active_callback'   => 'transparent_header_enable_callback',
    ) );

    $wp_customize->add_setting( 'z_transparent_header_mobile_margin_top', array(
        'default' => '1rem',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( 'z_transparent_header_mobile_margin_top', array(
        'type' => 'text',
        'section' => 'z_platform_homepage',
        'label' => esc_html__( 'Margin top on mobile view' , 'z-platform' ),
        'active_callback'   => 'transparent_header_enable_callback',
    ) );

    $wp_customize->add_setting( 'z_transparent_header_top_margin', array(
        'default' => '20vh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( 'z_transparent_header_top_margin', array(
        'type' => 'text',
        'section' => 'z_platform_homepage',
        'label' => esc_html__( 'Scroll Value for Main Menu To Return to Default View (Desktop).' , 'z-platform' ),
        'active_callback'   => 'transparent_header_enable_callback',
    ) );

    $wp_customize->add_setting( 'z_transparent_header_top_margin_mobile', array(
        'default' => '10vh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( 'z_transparent_header_top_margin_mobile', array(
        'type' => 'text',
        'section' => 'z_platform_homepage',
        'label' => esc_html__( 'Scroll Value for Main Menu To Return to Default View (Phone)' , 'z-platform' ),
        'active_callback'   => 'transparent_header_enable_callback',
    ) );

    $wp_customize->add_control( 'z_scroll_for_transparent_header_to_default_state', array(
        'type' => 'text',
        'section' => 'z_platform_homepage',
        'label' => esc_html__( 'Scroll.' , 'z-platform' ),
        'description' => esc_html__( 'After how many pixels of scroll should return the default header.' , 'z-platform' ),
    ) );
    //we are getting the value for scroll in functions.php file, since we are passing it to js in assets/js/app.js file
    //end of scroll

    $wp_customize->add_setting("z_transparent_header_nav_link_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_nav_link_color', array(
        'label' => esc_html__('Menu Item Link Color', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_nav_link_color',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));

    $wp_customize->add_setting("z_transparent_header_nav_link_hover_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_nav_link_hover_color', array(
        'label' => esc_html__('Menu Item Link Hover Color', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_nav_link_hover_color',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));

    $wp_customize->add_setting("z_transparent_header_nav_link_active_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_nav_link_active_color', array(
        'label' => esc_html__('Menu Item Link Active Color', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_nav_link_active_color',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));


    $wp_customize->add_setting("z_transparent_header_main_bg", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_main_bg', array(
        'label' => esc_html__('Transparent Header Background', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_main_bg',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));

    $wp_customize->add_setting("z_transparent_header_nav_bg_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_nav_bg_color', array(
        'label' => esc_html__('Submenu Item Background Color', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_nav_bg_color',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));

    $wp_customize->add_setting("z_transparent_header_nav_bg_hover_color", array(
        "default" => "",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        // "transport" => "refresh",
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_transparent_header_nav_bg_hover_color', array(
        'label' => esc_html__('Submenu Item Background Hover Color', 'z-platform'),
        'section' => 'z_platform_homepage',
        'settings' => 'z_transparent_header_nav_bg_hover_color',
        'type' => 'color',
        'active_callback'   => 'transparent_header_enable_callback',
    )));

    // WOOCOMMERCE BEGIN : WooCommerce customizer settings begin here.
    // General Section
    $wp_customize->add_section( 'z_woo_general_settings',
        array(
            'title'      => esc_html__( 'General', 'z-platform'),
            'panel'      => 'woocommerce',
            'capability' => '',
            'priority'   => 5,
        )
    );

    $wp_customize->add_setting("z_woo_general_add_to_cart", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_general_add_to_cart', array(
        'label' => esc_html__('Add To Cart Button Background Color', 'z-platform'),
        'section' => 'z_woo_general_settings',
        'settings' => 'z_woo_general_add_to_cart',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_general_add_to_cart_hover", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_general_add_to_cart_hover', array(
        'label' => esc_html__('Add To Cart Button Background Hover Color', 'z-platform'),
        'section' => 'z_woo_general_settings',
        'settings' => 'z_woo_general_add_to_cart_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_general_add_to_cart_text", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_general_add_to_cart_text', array(
        'label' => esc_html__('Add To Cart Button Text Color', 'z-platform'),
        'section' => 'z_woo_general_settings',
        'settings' => 'z_woo_general_add_to_cart_text',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_general_add_to_cart_text_hover", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_general_add_to_cart_text_hover', array(
        'label' => esc_html__('Add To Cart Button Text Hover Color', 'z-platform'),
        'section' => 'z_woo_general_settings',
        'settings' => 'z_woo_general_add_to_cart_text_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_general_rating_color", array(
        "default" => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_general_rating_color', array(
        'label' => esc_html__('Rating Stars Color', 'z-platform'),
        'section' => 'z_woo_general_settings',
        'settings' => 'z_woo_general_rating_color',
        'type' => 'color'
    )));

    // Product Catalog Section
    $wp_customize->add_setting("z_woo_cat_show_breadcrumbs", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_cat_show_breadcrumbs',
        array(
            'label'      => esc_html__( 'Hide Breadcrumbs?', 'z-platform' ),
            'settings'   => 'z_woo_cat_show_breadcrumbs',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_cat_show_results", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_cat_show_results',
        array(
            'label'      => esc_html__( 'Hide Number of results ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_show_results',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_cat_show_sorting", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_cat_show_sorting',
        array(
            'label'      => esc_html__( 'Hide Sorting ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_show_sorting',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_cat_show_layout", array(
        "default" => "no-sidebar",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_cat_show_layout',
        array(
            'label'      => esc_html__( 'Layout ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_show_layout',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'no-sidebar' => esc_html__('No Sidebar, Full width Content', 'z-platform'),
                'sidebar-left' => esc_html__('Sidebar Left', 'z-platform'),
                'sidebar-right' => esc_html__('Sidebar Right', 'z-platform'),
            ))
    ) );

    /*
    $wp_customize->add_panel( 'z_woo_category_product_items', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => '',
        'description'    => '',
    ) );

    $wp_customize->add_section( 'z_woo_category_product_items_inner', array(
        'title' => __( 'Donate Now', 'z-platform' ),
        'priority' => 10,
        'panel' => 'z_woo_category_product_items',
    ) );
    */

    $wp_customize->add_setting("z_woo_cat_show_style", array(
        "default" => "style_1",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_cat_show_style',
        array(
            'label'      => esc_html__( 'Style ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_show_style',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'style_1' => esc_html__('Style 1', 'z-platform'),
                'style_2' => esc_html__('Style 2', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_cat_rounded_card", array(
        "default" => "no",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_woo_cat_rounded_card', array(
            'label'      => esc_html__( 'Rounded Item Box / Card ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_rounded_card',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("z_woo_cat_card_shadow", array(
        "default" => "shadow-none",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_woo_cat_card_shadow', array(
            'label'      => esc_html__( 'Add Shadow ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_card_shadow',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'shadow-none' => esc_html__('No Shadow', 'z-platform'),
                'shadow-sm' => esc_html__('Small Shadow', 'z-platform'),
                'shadow' => esc_html__('Regular Shadow', 'z-platform'),
                'shadow-lg' => esc_html__('Large Shadow', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("z_woo_cat_add_border", array(
        "default" => "border",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_woo_cat_add_border', array(
            'label'      => esc_html__( 'Add Border ?', 'z-platform' ),
            'settings'   => 'z_woo_cat_add_border',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'border' => esc_html__('Yes', 'z-platform'),
                'border-0' => esc_html__('No', 'z-platform'),
            ),
        )
    ) );

    $wp_customize->add_setting("z_woo_catalog_border_color", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_border_color', array(
        'label' => esc_html__('Product Border Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_border_color',
        'type' => 'color',
        'active_callback'   => 'z_woo_catalog_border_enable_callback',
    )));

    $wp_customize->add_setting("z_woo_catalog_border_hover_color", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_border_hover_color', array(
        'label' => esc_html__('Product Hover Border Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_border_hover_color',
        'type' => 'color',
        'active_callback'   => 'z_woo_catalog_border_enable_callback',
    )));

    $wp_customize->add_setting("z_woo_cat_text_alignment", array(
        "default" => "text-center",
        "transport" => "refresh",
        'sanitize_callback' => 'z_platform_sanitize_select',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'z_woo_cat_text_alignment', array(
            'label'      => esc_html__( 'Text Alignment', 'z-platform' ),
            'settings'   => 'z_woo_cat_text_alignment',
            'priority'   => 10,
            'section'    => 'woocommerce_product_catalog',
            'type'    => 'select',
            'choices' => array(
                'text-start' => esc_html__('Left', 'z-platform'),
                'text-center' => esc_html__('Center', 'z-platform'),
                'text-end' => esc_html__('Right', 'z-platform'),
            ),
        )
    ) );

    if ( class_exists( 'WooCommerce', 'z-platform' ) ) {
        $wp_customize->add_setting("z_woo_cat_wishlist_icon_color", array(
            "default" => "#222",
            'sanitize_callback' => 'sanitize_hex_color',
            'sanitize_js_callback' => 'sanitize_hex_color',
            "transport" => "refresh",
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_cat_wishlist_icon_color', array(
            'label' => esc_html__('Wishlist Icon Color', 'z-platform'),
            'section' => 'woocommerce_product_catalog',
            'settings' => 'z_woo_cat_wishlist_icon_color',
            'type' => 'color',
        )));
    }

    $wp_customize->add_setting("z_woo_catalog_title", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_title', array(
        'label' => esc_html__('Title Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_title',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_catalog_title_hover", array(
        "default" => "#dd3333",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_title_hover', array(
        'label' => esc_html__('Title Hover Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_title_hover',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_catalog_price_color", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_price_color', array(
        'label' => esc_html__('Price Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_price_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_catalog_price_color_discount", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_price_color_discount', array(
        'label' => esc_html__('Price Discount Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_price_color_discount',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_catalog_color_onsale", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_color_onsale', array(
        'label' => esc_html__('On Sale Badge Text Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_color_onsale',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_catalog_color_onsale_background", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_catalog_color_onsale_background', array(
        'label' => esc_html__('On Sale Badge Background Color', 'z-platform'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'z_woo_catalog_color_onsale_background',
        'type' => 'color'
    )));

    // Single Product Section
    $wp_customize->add_section( 'z_woo_single_product',
        array(
            'title'      => esc_html__( 'Single Product', 'z-platform'),
            'panel'      => 'woocommerce',
            'capability' => '',
            'priority'   => 15,
        )
    );

    $wp_customize->add_setting("z_woo_single_show_breadcrumbs", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_breadcrumbs',
        array(
            'label'      => esc_html__( 'Hide Breadcrumbs ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_breadcrumbs',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_layout", array(
        "default" => "no-sidebar",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_layout',
        array(
            'label'      => __( 'Layout ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_layout',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'no-sidebar' => esc_html__('No Sidebar, Full width Content', 'z-platform'),
                'sidebar-left' => esc_html__('Sidebar Left', 'z-platform'),
                'sidebar-right' => esc_html__('Sidebar Right', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_style", array(
        "default" => "style_1",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_style',
        array(
            'label'      => esc_html__( 'Style ?', 'z-platform' ),
            'settings'   => 'z_woo_single_style',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'style_1' => esc_html__('Style 1', 'z-platform'),
                'style_2' => esc_html__('Style 2', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_gallery_style", array(
        "default" => "style_2",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_gallery_style',
        array(
            'label'      => __( 'Product Gallery Style ?', 'z-platform' ),
            'settings'   => 'z_woo_single_gallery_style',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'style_1' => esc_html__('Style 1', 'z-platform'),
                'style_2' => esc_html__('Style 2', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_tab_description", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_tab_description',
        array(
            'label'      => esc_html__( 'Display Description ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_tab_description',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_tab_additional_info", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_tab_additional_info',
        array(
            'label'      => esc_html__( 'Display Additional Information ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_tab_additional_info',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_tab_reviews", array(
        "default" => "yes",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_tab_reviews',
        array(
            'label'      => esc_html__( 'Display Reviews ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_tab_reviews',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_category", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_category',
        array(
            'label'      => esc_html__( 'Hide Category ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_category',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_sku", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_sku',
        array(
            'label'      => esc_html__( 'Hide SKU ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_sku',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_show_related", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_single_show_related',
        array(
            'label'      => esc_html__( 'Hide Related Products ?', 'z-platform' ),
            'settings'   => 'z_woo_single_show_related',
            'priority'   => 10,
            'section'    => 'z_woo_single_product',
            'type'    => 'select',
            'choices' => array(
                'yes' => esc_html__('Yes', 'z-platform'),
                'no' => esc_html__('No', 'z-platform'),
            ))
    ) );

    $wp_customize->add_setting("z_woo_single_title_color", array(
        "default" => "#222",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_single_title_color', array(
        'label' => esc_html__('Title Color', 'z-platform'),
        'section' => 'z_woo_single_product',
        'settings' => 'z_woo_single_title_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_single_price_color", array(
        "default" => "#cc1818",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_single_price_color', array(
        'label' => esc_html__('Sale Price Color', 'z-platform'),
        'section' => 'z_woo_single_product',
        'settings' => 'z_woo_single_price_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_single_old_price_color", array(
        "default" => "#cc1818",
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'z_woo_single_old_price_color', array(
        'label' => esc_html__('Regular Price Color', 'z-platform'),
        'section' => 'z_woo_single_product',
        'settings' => 'z_woo_single_old_price_color',
        'type' => 'color'
    )));

    $wp_customize->add_setting("z_woo_checkout_coupon", array(
        "default" => "no",
        'sanitize_callback' => 'z_platform_sanitize_select',
        "transport" => "refresh",
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'z_woo_checkout_coupon',
        array(
            'label'      => esc_html__( 'Hide Coupons ?', 'z-platform' ),
            'settings'   => 'z_woo_checkout_coupon',
            'priority'   => 10,
            'section'    => 'woocommerce_checkout',
            'type'    => 'select',
            'choices' => array(
                'no' => esc_html__('No', 'z-platform'),
                'yes' => esc_html__('Yes', 'z-platform'),
            ))
    ) );
 


    // WOOCOMMERCE END : WooCoomerce customizer settings end here.


    // Contextual Callbacks
    function header_cta_enable_callback( $control ) {
        if ( $control->manager->get_setting('enable_navbar_cta')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function header_cta_mobile_enable_callback( $control ) {
        if ( $control->manager->get_setting('cta_mobile_display')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function header_cart_enable_callback( $control ) {
        if ( $control->manager->get_setting('enable_header_cart')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function z_platform_related_posts_enable_callback( $control ) {
        if ( $control->manager->get_setting('display_single_related')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function header_top_enable_callback( $control ) {
        if ( $control->manager->get_setting('header_top_container')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function transparent_header_enable_callback( $control ) {
        if ( $control->manager->get_setting('z_transparent_header')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function footer_logo_enable_callback( $control ) {
        if ( $control->manager->get_setting('footer_logo')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function theme_blog_main_breadcrumbs_enable_callback( $control ) {
        if ( $control->manager->get_setting('theme_blog_main_breadcrumbs')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function theme_fixed_footer_section_enable_callback( $control ) {
        if ( $control->manager->get_setting('theme_footer_fixed_section')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function theme_top_footer_enable_callback( $control ) {
        if ( $control->manager->get_setting('theme_top_footer')->value() == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    function z_woo_catalog_border_enable_callback( $control ) {
        if ( $control->manager->get_setting('z_woo_cat_add_border')->value() == 'border' ) {
            return true;
        } else {
            return false;
        }
    }

    function theme_footer_style_enable_callback( $control ) {
        if ( $control->manager->get_setting('theme_footer_style')->value() == 'style_2' ) {
            return true;
        } else {
            return false;
        }
    }

    //select sanitization function
    function z_platform_sanitize_select( $input, $setting ){
          
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);
  
        //get the list of possible select options 
        $choices = $setting->manager->get_control( $setting->id )->choices;
                              
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
              
    }

    //radio box sanitization function
    function z_platform_sanitize_radio( $input, $setting ){
          
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);
  
        //get the list of possible radio box options 
        $choices = $setting->manager->get_control( $setting->id )->choices;
                              
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
              
    }

    //checkbox sanitization function
    function z_platform_sanitize_checkbox( $input ){
                  
        //returns true if checkbox is checked
        return ( isset( $input ) ? true : false );
    }

    function z_platform_sanitize_file( $file, $setting ) {
          
        //allowed file types
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'svg'          => 'image/svg'
        );
              
        //check file type from file name
        $file_ext = wp_check_filetype( $file, $mimes );
              
        //if file has a valid mime type return it, otherwise return default
        return ( $file_ext['ext'] ? $file : $setting->default );
    }
    function z_platform_sanitize_html($html_sanitized){
        return $html_sanitized;
    }

}
add_action( 'customize_register', 'z_platform_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function z_platform_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function z_platform_customize_partial_blogdescription() {
    bloginfo( 'description' );
}
