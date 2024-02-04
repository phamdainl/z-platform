<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Z_Platform
 */

$integration_head = get_theme_mod( 'theme_integrations_header_script' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_image = get_theme_mod( 'z_transparent_header_logo' );
$default_logo = get_theme_mod( 'custom-logo' );
$header_container_mode = get_theme_mod( 'header_container_mode', 'container' );
$header_top_container_mode = get_theme_mod( 'header_top_container_mode', 'container' );
$home_sticky_header = get_theme_mod('z_transparent_header_sticky_header', 'home_sticky_header_no');
$header_top_front_page = get_theme_mod( 'header_top_front_page', 'd-none' );
$sticky_header = get_theme_mod('enable_sticky_header', '');
$navbar_color_mode = get_theme_mod( 'bootstrap_navbar_mode', 'navbar-light' );
$menu_aligntment = get_theme_mod('bootstrap_navbar_alignment', 'ms-auto');
$cta_size = get_theme_mod('cta_size', 'btn');
$menu_aligntment_canvas = get_theme_mod('bootstrap_navbar_alignment_canvas', 'text-auto');
$z_transparent_header = '';
if ( is_front_page() ) {
    if( get_theme_mod('z_transparent_header') === 'yes') {
        $z_transparent_header = 'z-transparent-header';
    }
}
$z_transparent_header_class = '';
if ( is_front_page() ) {
    if( get_theme_mod('z_transparent_header') === 'yes') {
        $z_transparent_header_class = 'homepage-trp-header';
    }
    else {
        $z_transparent_header_class = 'homepage-default-header';
    }
}

$Cta_margin = '';
if($menu_aligntment_canvas === 'text-center'){

    $Cta_margin = 'justify-content-center';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'z-platform' ); ?></a>
    <?php if ( !is_home() && !is_front_page() ) : ?> 
        <?php if ( get_theme_mod('header_top_container', 'no') === 'yes' ) : ?>
            <div class="top_header">
                <div class="<?php echo esc_attr($header_top_container_mode); ?> ">
                    <div class="row">
                        <div class="col text-start">
                            <?php dynamic_sidebar( 'z_platform_sidebar_top_1' ); ?>
                        </div>
                        <div class="col text-end">
                            <?php dynamic_sidebar( 'z_platform_sidebar_top_2' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php if ( get_theme_mod('header_top_front_page', 'no') === 'yes' ) : ?>
            <div class="top_header">
                <div class="<?php echo esc_attr($header_top_container_mode); ?>">
                    <div class="row">
                        <?php if ( is_active_sidebar( 'z_platform_sidebar_top_1' ) ) : ?>
                            <div class="col text-start">
                                <?php dynamic_sidebar( 'z_platform_sidebar_top_1' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'z_platform_sidebar_top_2' ) ) : ?>
                            <div class="col text-end">
                                <?php dynamic_sidebar( 'z_platform_sidebar_top_2' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if( $home_sticky_header == 'home_sticky_header_yes' ) : ?>
            <div id="desktop_sticky_after"></div>
            <div id="mobile_sticky_after"></div>
        <?php endif; ?>
    <?php endif; ?>
    <header id="masthead" class="<?php echo esc_attr($z_transparent_header_class); ?> <?php if ( get_theme_mod('header_top_container', 'no') === 'yes' ) { ?>top-header-on<?php   }   ?> header-logo-navbar <?php echo esc_attr($sticky_header) . ' ' . esc_attr($z_transparent_header); ?> <?php echo $home_sticky_header ?> w-100">
        <?php if ( get_theme_mod('enable_offcanvas_menu', 'no') === 'no' ) { ?>
            <nav id="site-navigation" class="navbar navbar-expand-md  <?php echo esc_attr($navbar_color_mode); ?> ">
                <div class="<?php echo esc_attr($header_container_mode); ?> py-2">
                    <a class="navbar-brand site-branding py-0" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php if(get_theme_mod( 'z_transparent_header' ) == 'yes') : ?>
                            <?php if( is_front_page() ) { ?>
                                <img src="<?php if( get_theme_mod('z_transparent_header') === 'yes') {echo esc_attr($logo_image);}else{echo "none";} ?>" class="img-fluid homepage_transparent_logo">
                                <div class="default_fixed_logo">
                                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                                } ?>
                                </div>
                            <?php } else { ?>
                            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                            } ?>
                            <?php } ?>

                        <?php else : ?>
                            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '" width="220px" height="auto">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                            } ?>
                        <?php endif;  ?>
                    </a>

                    <div class="z_platform_mobile_menu w-auto d-flex align-items-center d-block d-md-none">
                        <?php
                        if ( get_theme_mod('cta_mobile_display', 'no') === 'yes' ) { ?>
                            <button id="zplatform_header_cta_phone" onclick="location.href='<?php echo esc_attr(get_theme_mod('header_cta_url')); ?>'" type="button" class="<?php echo esc_attr(get_theme_mod('cta_size_mobile', 'btn')); ?> btn cst-header-cta zplatform_header_cta_phone <?php echo esc_attr(get_theme_mod('header_cta_button_class', 'btn-primary')) ; ?>" role="button">
                                <?php echo esc_attr(get_theme_mod('header_cta_text', 'CTA TEXT')); ?>
                            </button>
                            <?php
                        }
                        if ( get_theme_mod('enable_navbar_search') === 'yes' ) { ?>
                            <a href="#Search" class="d-flex ms-4" data-bs-toggle="modal" data-bs-target="#z-platform-search-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Search" width="21" height="21" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        if ( get_theme_mod('enable_header_cart') === 'yes' ) {
                            ?>
                            <a href="#Cart" class="d-flex ms-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart" aria-controls="offcanvas-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Cart" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        ?>
                        <a href="#Offcanvas" class="ms-4 pe-0" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon d-flex">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'><path class='navbar-togler-icon-color' stroke='rgba(33, 37, 41, 0.75)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>
                            </span><span class="screen-reader-text"><?php esc_html_e('Menu', 'z-platform'); ?></span>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse d-none d-lg-block" id="main-menu">
                        <?php
                        $marginBetween = get_theme_mod('bootstrap_navbar_gap');
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul role="menu" id="%1$s" class="nav navbar-nav my-2 my-lg-0 mb-md-0 '.$marginBetween.'  '.$menu_aligntment.' %2$s">%3$s</ul>',
                            'depth' => 2,
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ));
                        ?>                        
                    </div>
                    <div class="w-auto align-items-center d-none d-md-flex header-icons">
                        <?php                        
                        if ( get_theme_mod('enable_navbar_search', 'no') === 'yes' ) { ?>
                            <a href="#Search" class="ms-4 w-auto" data-bs-toggle="modal" data-bs-target="#z-platform-search-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Search" width="21" height="21" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        if ( get_theme_mod('enable_header_cart', 'no') === 'yes' ) {
                            ?>
                            <a href="#Cart" class="d-flex ms-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart" aria-controls="offcanvas-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Cart" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        if ( get_theme_mod('enable_navbar_cta', 'no') === 'yes' ) { ?>
                            <button id="zplatform_header_cta" onclick="location.href='<?php echo esc_attr(get_theme_mod('header_cta_url')); ?>'" type="button" class="<?php echo esc_attr(get_theme_mod('cta_size', '')); ?> btn cst-header-cta ms-4 zplatform_header_cta <?php echo esc_attr(get_theme_mod('header_cta_button_class', 'btn-primary')) ; ?>" role="button">
                                <?php echo esc_attr(get_theme_mod('header_cta_text', 'CTA TEXT')); ?>
                            </button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="collapse navbar-collapse-mobile d-lg-none w-100" id="main-menu">
                    <?php
                        $marginBetween = get_theme_mod('bootstrap_navbar_gap');
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul role="menu" id="%1$s" class="nav navbar-nav my-2 my-lg-0 mb-md-0 '.$marginBetween.'  '.$menu_aligntment.' %2$s">%3$s</ul>',
                            'depth' => 2,
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ));
                    ?>                        
                </div>
            </nav>
        <?php } else { ?>
            <nav id="site-navigation" class="navbar <?php echo  esc_attr($navbar_color_mode); ?> " role="navigation">
                <div class="<?php echo esc_attr($header_container_mode); ?> py-2">
                    <a class="navbar-brand site-branding py-0" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php if(get_theme_mod( 'z_transparent_header' ) == 'yes') : ?>
                            <?php if( is_front_page() ) { ?>
                                <img src="<?php if( get_theme_mod('z_transparent_header') === 'yes') {echo esc_attr($logo_image);}else{echo "none";} ?>" class="img-fluid homepage_transparent_logo">
                                <div class="default_fixed_logo">
                                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                                } ?>
                                </div>
                            <?php } else { ?>
                            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( esc_attr($logo[0] )) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                            } ?>
                            <?php } ?>

                        <?php else : ?>
                            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
                                } else {
                                    echo '<h1>' . esc_attr(get_bloginfo('name')) . '</h1>';
                            } ?>
                        <?php endif;  ?>
                    </a>
                    <div class="z_platform_mobile_menu w-auto d-flex align-items-center d-block d-md-none">
                        <?php
                        if ( get_theme_mod('cta_mobile_display', 'no') === 'yes' ) { ?>
                            <button id="zplatform_header_cta_phone" onclick="location.href='<?php echo esc_attr(get_theme_mod('header_cta_url')); ?>'" type="button" class="<?php echo esc_attr(get_theme_mod('cta_size_mobile', 'btn')); ?> btn cst-header-cta zplatform_header_cta_phone <?php echo esc_attr(get_theme_mod('header_cta_button_class', 'btn-primary')) ; ?>" role="button">
                                <?php echo esc_attr(get_theme_mod('header_cta_text', 'CTA TEXT')); ?>
                            </button>
                            <?php
                        }
                        if ( get_theme_mod('enable_navbar_search') === 'yes' ) { ?>
                            <a href="#Search" class="d-flex ms-4" data-bs-toggle="modal" data-bs-target="#z-platform-search-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Search" width="21" height="21" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        if ( get_theme_mod('enable_header_cart') === 'yes' ) {
                            ?>
                            <a href="#Cart" class="d-flex ms-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart" aria-controls="offcanvas-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Cart" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        ?>
                        <a href="#Offcanvas" class="ms-4 pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">                        
                            <span class="navbar-toggler-icon d-flex">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'><path class='navbar-togler-icon-color' stroke='rgba(33, 37, 41, 0.75)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>
                            </span><span class="screen-reader-text"><?php esc_html_e('Menu', 'z-platform'); ?></span>
                        </a>
                    </div>
                    <div class="d-none d-md-flex align-items-center header-icons">
                        <?php      
                        if ( get_theme_mod('enable_navbar_cta', 'no') === 'yes' ) { ?>
                            <button id="zplatform_header_cta" onclick="location.href='<?php echo esc_attr(get_theme_mod('header_cta_url')); ?>'" type="button" class="<?php echo esc_attr(get_theme_mod('cta_size', '')); ?> btn cst-header-cta ms-4 zplatform_header_cta <?php echo esc_attr(get_theme_mod('header_cta_button_class', 'btn-primary')) ; ?>" role="button">
                                <?php echo esc_attr(get_theme_mod('header_cta_text', 'CTA TEXT')); ?>
                            </button>
                            <?php
                        }                  
                        if ( get_theme_mod('enable_navbar_search', 'no') === 'yes' ) { ?>
                            <a href="#Search" class="ms-4 w-auto" data-bs-toggle="modal" data-bs-target="#z-platform-search-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        if ( get_theme_mod('enable_header_cart', 'no') === 'yes' ) {
                            ?>
                            <a href="#Cart" class="ms-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart" aria-controls="offcanvas-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" alt="Cart" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                </svg>
                            </a>
                            <?php
                        }
                        ?>
                        <a href="#Offcanvas" class="ms-4 pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon d-flex">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'><path class='navbar-togler-icon-color' stroke='rgba(33, 37, 41, 0.75)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>
                            </span><span class="screen-reader-text"><?php esc_html_e('Menu', 'z-platform'); ?></span>
                        </a>
                    </div>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbar">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel"><?php esc_html_e('Logo', 'z-platform'); ?></h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                          <div class="offcanvas-body">
                            <?php
                                $marginBetween = get_theme_mod('bootstrap_navbar_gap');
                                wp_nav_menu(array(
                                    'theme_location' => 'main-menu',
                                    'container' => false,
                                    'menu_class' => '',
                                    'fallback_cb' => '__return_false',
                                    'items_wrap' => '<ul role="menu" id="%1$s" class="nav navbar-nav mb-2 ms-2 flex-grow-1 pe-3 '. $marginBetween .' '.$menu_aligntment_canvas.' %2$s">%3$s</ul>',
                                    'depth' => 2,
                                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                                ));
                            ?>
                        </div>
                    </div>           
            </nav>
        <?php } ?>
        </header><!-- #masthead -->