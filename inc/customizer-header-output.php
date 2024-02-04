<?php
/**
 * Z Platform Theme Customizer Header Output
 *
 * @package Z_Platform
 */

function z_platform_customizer_header_output() {
    ?>
    <style type="text/css" id="customized-theme-css">

        <?php if( get_theme_mod('z_transparent_header_sticky_header') == 'home_sticky_header_yes' ) : ?>
            #desktop_sticky_after {
                height: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_top_margin', '20vh' ) ) ;?>;
                position: absolute;
                z-index: 0;
            }
            #mobile_sticky_after {
                height: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_top_margin_mobile', '10vh' ) ) ;?>;
                position: absolute;
                z-index: 0;
            }
        <?php endif; ?>
        
        #site-navigation .navbar-brand {max-width: <?php echo esc_attr( get_theme_mod( 'header_logo_width', '220' ) ) ;?>px !important;}
        .zplatform-single-content a, #comments .comment-list .comment-content a, #comments .comment-metadata, #respond a, .z-card a, a {
            text-decoration: <?php echo esc_attr( get_theme_mod( 'general_links_underline', 'underline' ) ); ?>;
        }
        .header-logo-navbar.sticky-top.z-transparent-header.site-header nav#site-navigation, .site-header, nav#site-navigation, .offcanvas-end { background-color: <?php echo esc_attr( get_theme_mod( 'header_background_color', '#f8f9fa' ) ); ?> !important; }
        .top_header { color: <?php echo esc_attr( get_theme_mod( 'header_top_text_color', '#8d94a8' ) ) ;?>; background-color: <?php echo esc_attr( get_theme_mod( 'header_top_background_color', '#21242e' ) ); ?>; }
        .top_header a { color: <?php echo esc_attr( get_theme_mod( 'header_top_url_color', '#8d94a8' ) ) ;?>; }
        .z-transparent-header .navbar-collapse-mobile.show { background: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_bg_color', '#fff' ) ) ;?> }
        .z-transparent-header.site-header .navbar-collapse-mobile.show { background: <?php echo esc_attr( get_theme_mod( 'header_background_color', '#fff' ) ) ;?> }
        .navbar-collapse-mobile.show { background: <?php echo esc_attr( get_theme_mod( 'header_background_color', '#fff' ) ) ;?> }
        <?php if( get_theme_mod( 'header_border_bottom_color' ) ) : ?>
            #masthead { border-bottom: 1px solid <?php echo esc_attr( get_theme_mod( 'header_border_bottom_color', '#e5e5e5' ) ) ;?> }
            #masthead.z-transparent-header { border-bottom: none; }
            #masthead.z-transparent-header.site-header { border-bottom: 1px solid <?php echo esc_attr( get_theme_mod( 'header_border_bottom_color', '#e5e5e5' ) ) ;?> }
        <?php endif; ?>        
        .top_header a:hover { color: <?php echo esc_attr( get_theme_mod( 'header_top_url_color_hover', '#8d94a8' ) ) ;?>; }
        body { color: <?php echo esc_attr( get_theme_mod( 'general_text_color', '#222' ) ) ;?>; background: <?php echo esc_attr( get_theme_mod( 'general_bg_color', '#fff' ) ) ;?>; font-size: <?php echo esc_attr( get_theme_mod( 'theme_general_font_size', '1rem' ) ) ;?>; }
        a, .z-woo-product-remove:before { color: <?php echo esc_attr( get_theme_mod( 'general_link_color', '#383838' ) ) ;?>; }
        a:hover, .z-woo-product-remove:hover::before { color: <?php echo esc_attr( get_theme_mod( 'general_link_color_hover', '#383838' ) ) ;?>; }
        .top_header a { color: <?php echo esc_attr( get_theme_mod( 'header_top_url_color', '#8d94a8' ) ) ;?>; }
        .z-card { border-color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_border_color', '#222' ) ) ;?> !important; }
        .z-card:hover { border-color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_border_hover_color', '#222' ) ) ;?> !important; }
        .z-card .woocommerce-loop-product__title { color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_title', '#222' ) ) ;?> !important; }
        .z-card:hover .woocommerce-loop-product__title { color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_title_hover', '#dd3333' ) ) ;?> !important; }
        .z-card .price { color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_price_color', '#222' ) ) ;?> !important; }
        .z-card .price ins { color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_price_color_discount', '#222' ) ) ;?> !important; }
        .z-card .onsale, .single-product .onsale { color: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_color_onsale', '#222' ) ) ;?> !important; background: <?php echo esc_attr( get_theme_mod( 'z_woo_catalog_color_onsale_background', '#222' ) ) ;?> !important; }
        .z-card .yith-wcwl-add-to-wishlist i { color: <?php echo esc_attr( get_theme_mod( 'z_woo_cat_wishlist_icon_color', '#222' ) ) ;?> !important; }
        .z-product-atc-btn, .z-woo-account-nav .list-group .is-active a, .z-woo-account-nav .list-group a:hover { background: <?php echo esc_attr( get_theme_mod( 'z_woo_general_add_to_cart', '#fff' ) ) ;?> !important; color: <?php echo esc_attr( get_theme_mod( 'z_woo_general_add_to_cart_text', '#fff' ) ) ;?>; }
        .z-transparent-header { background: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_main_bg', '' ) ) ;?>; z-index: 999; }
        .z-product-atc-btn:hover { background: <?php echo esc_attr( get_theme_mod( 'z_woo_general_add_to_cart_hover', '#fff' ) ) ;?> !important; color: <?php echo esc_attr( get_theme_mod( 'z_woo_general_add_to_cart_text_hover', '#fff' ) ) ;?> }
        .product .product_title { color: <?php echo esc_attr( get_theme_mod( 'z_woo_single_title_color', '#222' ) ) ;?> !important; }
        .product .price del { color: <?php echo esc_attr( get_theme_mod( 'z_woo_single_old_price_color', '#cc1818' ) ) ;?> !important; }
        .product .price { color: <?php echo esc_attr( get_theme_mod( 'z_woo_single_price_color', '#cc1818' ) ) ;?> !important; }
        .single-product #reviews .star-rating span:before, #comments .comment-text .star-rating span, .product-items .z-card .z-woo-ratings-wrapper .star-rating span, .product .summary .z-woo-ratings-wrapper .star-rating span, #comments .comment-text .star-rating:before, p.stars:hover a:before, p.stars.selected a:not(.active):before, .woocommerce p.stars a { color: <?php echo esc_attr( get_theme_mod( 'z_woo_general_rating_color', '#fff' ) ) ;?> !important; }
        .top_header a:hover { color: <?php echo esc_attr( get_theme_mod( 'header_top_url_color_hover', '#8d94a8' ) ) ;?>; }
        .header-logo-navbar.sticky-top.z-transparent-header.site-header nav#site-navigation a { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#595959' ) ); ?>;}
        #masthead.z-transparent-header nav#site-navigation ul li .active { color: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_active_color', '#dd3333' ) ); ?>;}
        #masthead.z-transparent-header nav#site-navigation .offcanvas ul li .active { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_active', '#dd3333' ) ); ?>;}
        #masthead.z-transparent-header nav#site-navigation .offcanvas ul li a { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#dd3333' ) ); ?>;}
        #masthead.z-transparent-header nav#site-navigation .offcanvas ul li a:hover { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#dd3333' ) ); ?>;}
        #masthead.z-transparent-header.site-header nav#site-navigation ul li .active { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_active', '#dd3333' ) ); ?>;}
        #masthead nav#site-navigation ul li .active { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_active', '#dd3333' ) ); ?>;}
        .footer_top { background-color: <?php echo esc_attr( get_theme_mod( 'footer_background_top', '#fff' ) ); ?>; color: <?php echo esc_attr( get_theme_mod( 'footer_text_color_top', '' ) ); ?>; }
        .footer_bottom { background-color: <?php echo esc_attr( get_theme_mod( 'footer_background_bottom', '#fff' ) ); ?>; color: <?php echo esc_attr( get_theme_mod( 'footer_text_color_bottom', '' ) ); ?>;}
        .footer_top { border-top: <?php echo esc_attr( get_theme_mod( 'footer_border', '1' ) ); ?> solid <?php echo esc_attr( get_theme_mod( 'footer_border', '#ddd' ) ); ?>;}
        .footer_bottom { border-top: <?php echo esc_attr( get_theme_mod( 'footer_bottom_border', '1px' ) ); ?> solid <?php echo esc_attr( get_theme_mod( 'footer_border_bottom', '#ddd' ) ); ?>;}
        .article .post_blog_style_1_title a { color: <?php echo esc_attr( get_theme_mod( 'article_title_color', '#282828' ) ); ?>; }
        .page_title h1, . { color: <?php echo esc_attr( get_theme_mod( 'archive_title_color', '#282828' ) ); ?>; }
        .single_post p, .single_post { color: <?php echo esc_attr( get_theme_mod( 'single_post_content_color', '#313131' ) ); ?>!important; }
        .single_cat a { color: <?php echo esc_attr( get_theme_mod( 'single_post_content_category_color', '#767676' ) ); ?>!important; background: <?php echo esc_attr( get_theme_mod( 'single_post_content_category_bg_color', '' ) ); ?>!important; }
        .single_cat a:hover { color: <?php echo esc_attr( get_theme_mod( 'single_post_content_category_color_hover', '#383838' ) ); ?>!important;background: <?php echo esc_attr( get_theme_mod( 'single_post_content_category_bg_color_hover', '#efefef' ) ); ?>!important; }
        .single_h2 { color: <?php echo esc_attr( get_theme_mod( 'single_post_content_heading', '#282828' ) ); ?>!important; }
        .article:hover .post_blog_style_1_title a { color: <?php echo esc_attr( get_theme_mod( 'article_title_color_hover', '#dd3333' ) ); ?>; }
        .cst-header-cta { border-radius: <?php echo esc_attr( get_theme_mod( 'cta_border_radius', '1rem' ) ); ?>; border: 1px solid <?php echo esc_attr( get_theme_mod( 'cta_bg_border', '' ) ); ?>; background: <?php echo esc_attr( get_theme_mod( 'cta_bg_color', '' ) ); ?>; color: <?php echo esc_attr( get_theme_mod( 'cta_text_color', '' ) ); ?>; }
        .cst-header-cta:hover { background: <?php echo esc_attr( get_theme_mod( 'cta_bg_color_hover', '' ) ); ?>!important; color: <?php echo esc_attr( get_theme_mod( 'cta_text_color_hover', '' ) ); ?>!important; }
        .post_blog_style_1_content { color: <?php echo esc_attr( get_theme_mod( 'article_content_color', '#6d6d6d' ) ); ?>; }
        .article_read_more_button { color: <?php echo esc_attr( get_theme_mod( 'read_more_button_text', '#000' ) ); ?>; background: <?php echo esc_attr( get_theme_mod( 'read_more_button_background', '#ffc107' ) ); ?>; }
        .article_read_more_button:hover { color: <?php echo esc_attr( get_theme_mod( 'read_more_button_text_hover', '#fff' ) ); ?>; background: <?php echo esc_attr( get_theme_mod( 'read_more_button_background_hover', '#6d6d6d' ) ); ?>; }
        .header-logo-navbar.sticky-top.z-transparent-header.site-header nav#site-navigation #main-menu a:hover, nav#site-navigation #main-menu a:hover, nav#site-navigation #main-menu a:focus, nav#site-navigation #main-menu a.active:hover,nav#site-navigation #main-menu a.active:focus { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#dd3333' ) ); ?>; background-color: <?php echo esc_attr( get_theme_mod( 'menu_item_hover_background_color', '' ) ); ?>;}
        .z-transparent-header nav#site-navigation .header-icons a {
                color: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_color', '#fff' ) ); ?>;
        }
        .z-transparent-header nav#site-navigation .header-icons a:hover {
                color: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_hover_color', '#595959' ) ); ?>;
        }
        .z-transparent-header.site-header nav#site-navigation .header-icons a:hover {
                color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#595959' ) ); ?>;
        }
        .z-transparent-header nav#site-navigation #main-menu a:hover { color: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_hover_color', '#c12828' ) ); ?>;}   
        .navbar-toggler-icon {
            background-image:none ;
        }
        .navbar-togler-icon-color {
            fill: none;
            stroke-width: 2;
        }
        .navbar-toggler-icon .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#fff' ) ) ?>;
        }
        .navbar-toggler-icon:hover .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#595959' ) ) ?>;
        }
        .z-transparent-header .navbar-toggler-icon .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_color', '#fff' ) ) ?>;
        }
        .z-transparent-header .navbar-toggler-icon:hover .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_hover_color', '#595959' ) ) ?>;
        }
        .z-transparent-header.site-header .navbar-toggler-icon .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#595959' ) ) ?>;
        }
        .z-transparent-header.site-header .navbar-toggler-icon:hover .navbar-togler-icon-color {
          stroke: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#000' ) ) ?>;
        }  
        .z-transparent-header.site-header nav#site-navigation #main-menu a:hover { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#c12828' ) ); ?>;}    
        .header-logo-navbar.sticky-top.z-transparent-header.site-header #site-navigation ul li .active { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_active', 'inherit' ) ); ?> }
        .footer_social a {  color: <?php echo esc_attr( get_theme_mod( 'theme_footer_social_url', '' ) ) ?>!important;   }
        .footer_social a:hover {  color: <?php echo esc_attr( get_theme_mod( 'theme_footer_social_url_hover', '' ) ) ?>!important;   }
        nav#site-navigation ul li a:hover { background-color: <?php echo esc_attr( get_theme_mod( 'menu_item_hover_background_color', '' ) ); ?>;}
        .dropdown-menu a, .dropdown-item.active {color: <?php echo esc_attr( get_theme_mod( 'submenu_text_color', '#000' ) ); ?> !important}

        nav#site-navigation ul li .active { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_active', 'inherit' ) ); ?>; background: <?php echo esc_attr( get_theme_mod( 'menu_item_link_bg_active', 'inherit' ) ); ?>  }

        .header-logo-navbar.sticky-top.z-transparent-header #site-navigation #main-menu ul li a { background: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_bg_color', '#fff' ) ); ?> }
        .header-logo-navbar.sticky-top.z-transparent-header.site-header #site-navigation #main-menu ul li .active { background: <?php echo esc_attr( get_theme_mod( 'menu_item_link_bg_active', '#fff' ) ); ?> }
        .header-logo-navbar.sticky-top.z-transparent-header #site-navigation #main-menu ul li a:hover { background: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_bg_hover_color', '#fff' ) ); ?>  }
        .z-transparent-header.site-header nav#site-navigation a { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#595959' ) ); ?>; }    
        .z-transparent-header nav#site-navigation a, .z-transparent-header nav#site-navigation .active { color: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_nav_link_color', '#fff' ) ); ?>;}
        .header-logo-navbar.sticky-top.z-transparent-header.site-header #site-navigation ul li a, nav#site-navigation ul li a { background-color: <?php echo esc_attr( get_theme_mod( 'menu_item_background_color', 'inherit' ) ); ?>; color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#595959' ) ); ?>;}

        nav#site-navigation .header-icons a { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_color', '#595959' ) ); ?>;}
        nav#site-navigation .header-icons a:hover { color: <?php echo esc_attr( get_theme_mod( 'menu_item_link_hover_color', '#595959' ) ); ?>;}
        .navbar-expand-md .navbar-nav .dropdown-menu, .navbar-nav .dropdown-menu { background-color: <?php echo esc_attr( get_theme_mod( 'submenu_background_color', '#f8f9fa' ) ); ?>;}
        <?php
        if( get_theme_mod('z_transparent_header') === 'yes') {
            echo '.header-logo-navbar.sticky-top.z-transparent-header .navbar.navbar-expand-md.navbar-dark.bg-dark  {background-color: #00000000 !important; z-index: 9999; position: fixed; width: 100%;}';
            echo '.header-logo-navbar.sticky-top.z-transparent-header.site-header .navbar.navbar-expand-md.navbar-dark.bg-dark  {background-color: '. esc_attr( get_theme_mod( 'header_background_color', '' ) ) .'!important; z-index: 9999; position: fixed; width: 100%;}';
            if (!empty ( get_theme_mod('z_transparent_header_nav_link_color') ) ) {
                echo '.home nav#site-navigation.cst-bg-transparent a, .home nav#site-navigation.cst-bg-transparent a.active { color: '. esc_attr( get_theme_mod( 'z_transparent_header_nav_link_color', '' ) ) .';}';
            }
            if (!empty(get_theme_mod('z_transparent_header_nav_link_hover_color')) ) {
                echo '.home nav#site-navigation.cst-bg-transparent a:hover, .home nav#site-navigation.cst-bg-transparent a.active:hover { color: '. esc_attr( get_theme_mod( 'z_transparent_header_nav_link_hover_color', '' ) ) .';}';
            }
            if (!empty ('z_transparent_header_top_margin') ) {
                echo '.home header.cst-bg-transparent { margin-top: '. esc_attr( get_theme_mod( 'z_transparent_header_top_margin', '' ) ) .';}';
            }

        }
        ?>
        @media screen and (max-width: 550px) {
            #site-navigation .navbar-brand {max-width: <?php echo esc_attr( get_theme_mod( 'header_logo_width_mobile', '140' ) ) ;?>px !important;
            margin: 0px;
            }
            .z-transparent-header { margin-top: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_mobile_margin_top', '10' ) ); ?> }
        }
        @media screen and (min-width: 1025px) {
            .z-transparent-header { margin-top: <?php echo esc_attr( get_theme_mod( 'z_transparent_header_desktop_margin_top', '10' ) ); ?> }
            .z-transparent-header.site-header { margin-top: 0px }
        }
        @media screen and (min-width: 1280px) and (max-width: 10000px) {
            .container { max-width: <?php echo esc_attr( get_theme_mod( 'theme_general_container_size', '1320px' ) ); ?>; }
        }
    </style>

    <?php
}
add_action( 'wp_head', 'z_platform_customizer_header_output' );

/*-----------------------------------------------------------
Function to create margins in fron page, for mobile and desktop view.
-----------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'z_platform_homepage_margins');

function z_platform_homepage_margins() {
    // Localize the script with our data.
    $margin_array = array( 'margin_desktop' => get_theme_mod('z_transparent_header_top_margin'), 'margin_mobile' => get_theme_mod('z_transparent_header_top_margin_mobile') );

    wp_localize_script( 'z-platform-theme-app', 'z_platform_home_margin_object', $margin_array );

    // The script can be enqueued now or later.
    wp_enqueue_script( 'z-platform-theme-app' );
}

/*-----------------------------------------------------------
Include the Script Code inside head
-----------------------------------------------------------*/

if ( get_theme_mod('theme_integrations_header_script') ) {
	if ( !function_exists( 'z_platform_header_script' ) ) {
	    add_action( 'wp_head', 'z_platform_header_script' );
	    function z_platform_header_script() {
	    ?>
	        <?php
	            $integration_head = get_theme_mod('theme_integrations_header_script');
	            echo $integration_head;
	        ?>
	    <?php
	    }
	}
}

/*-----------------------------------------------------------
Include the Script Code inside body open
-----------------------------------------------------------*/
if ( get_theme_mod('theme_integrations_header_script') ) {
	if ( !function_exists( 'z_platform_body_script' ) ) {
	    add_action('wp_body_open', 'z_platform_body_script');
	    function z_platform_body_script(){ 
	    ?>
	        <?php
	            $integration_body_script = get_theme_mod('theme_integrations_body_script');
	            echo $integration_body_script;
	        ?>
	    <?php
	    }
	}
}

/*-----------------------------------------------------------
Include the Script Code inside footer
-----------------------------------------------------------*/
if ( get_theme_mod('theme_integrations_header_script') ) {
	if ( !function_exists( 'z_platform_footer_script' ) ) {
	    add_action('wp_footer', 'z_platform_footer_script');
	    function z_platform_footer_script(){
		    ?>
		        <!-- Get Footer Script -->
		        <?php
		            $integration_footer_script = get_theme_mod('theme_integrations_footer_script');
		            echo $integration_footer_script;
		        ?>
		        <!-- Close offcanvas menu after click, if there dosn't exist's dropdown-toggle class -->
		        <?php if ( get_theme_mod('enable_offcanvas_menu', 'no') === 'yes' ) { ?>
		            <script>
		                jQuery( document ).ready(function($) {
		                    $(".offcanvas-body a:not(.dropdown-toggle)").click(function(){
		                        $('.offcanvas').offcanvas('hide');
		                    });
		                });
		            </script>
		        <?php } ?>
		    <?php
		}
	}
}
/*-----------------------------------------------------------
Include the Script Code inside Woocommerce thank you page
-----------------------------------------------------------*/
if ( class_exists( 'WooCommerce' ) ) {
	if ( get_theme_mod('theme_integrations_header_script') ) {
	    add_action( 'woocommerce_thankyou', 'z_platform_woo_thank_you_page' );
	    function z_platform_woo_thank_you_page() {
	    ?>
	        <?php
	            $integration_thank_you_page = get_theme_mod('theme_integrations_woo_thank_you_page');
	            echo $integration_thank_you_page;
	        ?>
	    <?php
	    }
	}
}
