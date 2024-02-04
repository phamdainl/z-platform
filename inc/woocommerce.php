<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Z_Platform
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function z_platform_woocommerce_setup() {
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 400,
            'single_image_width'    => 640,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 3,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'z_platform_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function z_platform_woocommerce_scripts() {
    // wp_enqueue_style( 'z-platform-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );
    wp_enqueue_style( 'z-platform-woocommerce-style', get_template_directory_uri() . '/assets/css/wc.css', array(), _S_VERSION );

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style( 'z-platform-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'z_platform_woocommerce_scripts' );


/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function z_platform_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'z_platform_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function z_platform_woocommerce_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'z_platform_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'z_platform_woocommerce_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function z_platform_woocommerce_wrapper_before() {
        ?>
            <main id="primary" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col col-12 my-5">

        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'z_platform_woocommerce_wrapper_before' );

if ( ! function_exists( 'z_platform_woocommerce_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function z_platform_woocommerce_wrapper_after() {
        ?>
            </div></div></div>
            </main><!-- #main -->
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'z_platform_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
    <?php
        if ( function_exists( 'z_platform_woocommerce_header_cart' ) ) {
            z_platform_woocommerce_header_cart();
        }
    ?>
 */

if ( ! function_exists( 'z_platform_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function z_platform_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        z_platform_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'z_platform_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'z_platform_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function z_platform_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'z-platform' ); ?>">
            <?php
            $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'z-platform' ),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'z_platform_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function z_platform_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php z_platform_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}

// Remove / Hide / Show breadcrumbs & Other WooCommerce Elements
add_filter( 'woocommerce_before_main_content', 'z_platform_hide_display_settings');
function z_platform_hide_display_settings() {
    // SHOP & CATEGORIES
    if (get_theme_mod('z_woo_cat_show_breadcrumbs', 'no') == 'yes') {
        if (is_shop() || is_product_category() || is_product_tag()) {
            remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
        }
    }
    if (get_theme_mod('z_woo_cat_show_results', 'no') == 'yes') {
        if (is_shop() || is_product_category() || is_product_tag()) {
            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        }
    }
    if (get_theme_mod('z_woo_cat_show_sorting', 'no') == 'yes') {
        // if( is_shop() || is_product_category() || is_product_tag() ) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        // }
    }
    // Single Product Page
    if (get_theme_mod('z_woo_single_show_breadcrumbs', 'no') == 'yes') {
        if (is_product()) {
            remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
        }
    }

    // Single Product Category
    if (get_theme_mod('z_woo_single_show_category', 'no') == 'yes') {
        if (is_product()) {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        }
    }

    // Single Product Sku
    if (get_theme_mod('z_woo_single_show_sku', 'no') == 'yes') {
        if (is_product()) {
            add_filter( 'wc_product_sku_enabled', '__return_false' );
        }
    }

    // Single Product Related
    if (get_theme_mod('z_woo_single_show_related', 'no') == 'yes') {
        if (is_product()) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
        }
    }

    // Single Product Additional Information Tab
    if (get_theme_mod('z_woo_single_show_tab_additional_info', 'yes') == 'no') {
        add_filter( 'woocommerce_product_tabs', 'z_woo_remove_additional_info_tab', 98 );

        function z_woo_remove_additional_info_tab( $tabs ) {
            unset( $tabs['additional_information'] );
            return $tabs;
        }
    }

    // Single Product Reviews Tab
    if (get_theme_mod('z_woo_single_show_tab_reviews', 'yes') == 'no') {
        add_filter( 'woocommerce_product_tabs', 'z_woo_remove_reviews_tab', 98 );
        function z_woo_remove_reviews_tab($tabs) {
            unset($tabs['reviews']);
            return $tabs;
        }
    }

    // Single Product Description Tab
    if (get_theme_mod('z_woo_single_show_tab_description', 'yes') == 'no') {
        add_filter( 'woocommerce_product_tabs', 'sd_remove_product_tabs', 98 );
        function sd_remove_product_tabs( $tabs ) {
            unset( $tabs['description'] );
            return $tabs;
        }
    }
}

// Remove WooCommerce default pagination & use the theme pagination instead
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'z_platform_pagination', 10 );

// Remove woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Adjust Woocommerce loop start
function woocommerce_product_loop_start( $echo = true ) {
    ob_start();
    $columns_set = esc_attr( wc_get_loop_prop( 'columns' ));
    if ( get_theme_mod( 'z_woo_cat_show_layout', 'no-sidebar' ) == 'no-sidebar' ) {
        $content_width = ' row';
    } elseif ( get_theme_mod( 'z_woo_cat_show_layout', 'no-sidebar' ) == 'sidebar-left' ) {
        $content_width = ' col-sm-9 row';
        $sidebar_width = ' order-last order-md-first';
    } elseif ( get_theme_mod( 'z_woo_cat_show_layout', 'no-sidebar' ) == 'sidebar-right' ) {
        $content_width = ' col-sm-9 row';
        $sidebar_width = ' order-last';
    }
    echo '<div class="products columns-'.esc_attr($columns_set).' row px-0 mx-0">';
    if ( get_theme_mod( 'z_woo_cat_show_layout', 'no-sidebar' ) == 'sidebar-left' || get_theme_mod( 'z_woo_cat_show_layout', 'no-sidebar' ) == 'sidebar-right') { ?>
        <aside class="col col-12 col-sm-3 z-sidebar shop-sidebar <?php echo esc_attr($sidebar_width);?>">
            <div class="sidebar-wrap">
                <?php
                if ( is_active_sidebar( 'zplatform_woocommerce_shop_sidebar' ) ) {
                    dynamic_sidebar( 'zplatform_woocommerce_shop_sidebar' );
                }
                ?>
            </div>
        </aside>
    <?php  }
    echo '<div class="product-items col col-12 d-block d-md-flex'.esc_attr($content_width).' px-0 mx-0">';
    if ( $echo )
        echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    else
        return ob_get_clean();
}

// Remove default sidebar from WooCommerce shop & category pages
add_action('woocommerce_before_main_content', 'z_woo_remove_default_sidebar' );
function z_woo_remove_default_sidebar()
{
    if( is_shop() || is_product_category() || is_product_tag() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}

// Call / Echo our main product image.
function z_woo_product_custom_thumbnail() {
    echo esc_url(the_post_thumbnail('single_product_archive_thumbnail_size', array('class' => 'img-fluid img-thumbnail card-img-top')));
}



// Add to cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'z_woo_button_add_to_cart', 10 );
function z_woo_button_add_to_cart() {
    global $product;
    $product_type = $product->get_type();
    // Display the custom button
    echo '<div class="z-atc-btn-wrap my-3"><button type="submit" class="btn z-product-atc-btn '.esc_attr($product_type).'_add_to_cart_btn single_add_to_cart_button button alt wp-element-button" value="' . esc_attr( $product->id ) . '">' . esc_html__('Add to cart', 'z-platform') . '</button></div>';

}

// Shop page, archive product page and etc.. ( Product results & Filter )
if (!function_exists('z_woo_open_top_products_page')) {
    function z_woo_open_top_products_page()
    {
        return get_template_part('/woocommerce/loop/open-top-shop', 'page');
    }
}
add_action('woocommerce_before_shop_loop', 'z_woo_open_top_products_page', 5);

// Remove woocommerce_result_count woocommerce_catalog_ordering from woocommerce_before_shop_loop
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
add_action('zoo_woocommerce_result_count', 'woocommerce_result_count', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('zoo_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering', 10);

// Add to cart message
if (!function_exists("z_woo_add_to_cart_message")) {
    function z_woo_add_to_cart_message($fragments)
    {
        $product_id = sanitize_text_field( wp_unslash( isset($_POST['product_id']) ? $_POST['product_id'] : '' ) );
        $quantity = sanitize_text_field( wp_unslash( isset($_POST['quantity']) ) ) ? 1 : wc_stock_amount(sanitize_text_field( wp_unslash($_POST['quantity']))); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        $fragments['z_woo_add_to_cart_message'] = '<div id="w-zoo-add-to-cart-message">' . wc_add_to_cart_message($product_id, $quantity, true) . '</div>';
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'z_woo_add_to_cart_message');

//Single product Add to cart
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'z_woo_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'z_woo_ajax_add_to_cart');

function z_woo_ajax_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id'])); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
    $quantity = empty(sanitize_text_field( wp_unslash($_POST['quantity']))) ? 1 : wc_stock_amount(sanitize_text_field( wp_unslash($_POST['quantity'])));
    $variation_id = absint(sanitize_text_field( wp_unslash($_POST['variation_id']))); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
    $variations = empty(sanitize_text_field( wp_unslash($_POST['variations'] ) ) );
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id,$variations) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
            wc_add_to_cart_message(array($product_id => $quantity), true);
        WC_AJAX :: get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo esc_html(wp_send_json($data));
    }
    wp_die();
}

// Woocommerce template loop thumbnail
function woocommerce_template_loop_product_thumbnail()
{
    global $product;
    $zoo_img = $product->get_image_id(); ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
       class="wrap-img">
        <?php
        if($zoo_img){
            echo wp_get_attachment_image($zoo_img, 'woocommerce_thumbnail');
        }
        else{
            echo esc_url(wc_placeholder_img('woocommerce_thumbnail') );
        }
        do_action('z_woo_loop_alternative_images');
        ?>
    </a>
    <?php
}
// Alternative images in product gallery category page
function z_woo_alternative_images()
{
    $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
    if (!empty($gallery)) {
        $gallery = explode(',', $gallery);
        $first_image_id = $gallery[0];
        echo wp_get_attachment_image($first_image_id, 'woocommerce_thumbnail', '', array('class' => 'card-img-top sec-img hover-image'));
    } else {
        return false;
    }
}
add_action('z_woo_loop_alternative_images', 'z_woo_alternative_images', 10);

// Wrap product thumbnail in a div
add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo '<div class="wrap-product-image d-flex flex-row">';
}, 9 );
add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo '</div>';
}, 11 );

// Remove default rating & add custom one
remove_action ('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action('woocommerce_after_shop_loop_item_title', 'z_woo_star_rating', 5 );

if (!function_exists('z_woo_star_rating')) {
    function z_woo_star_rating()
    {
        return get_template_part('/woocommerce/loop/star-rating', 'page');
    }
} 

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'z_woo_product_title', 10 );
function z_woo_product_title() {
    echo '<h2 class="woocommerce-loop-product_title mt-3"><a href="'.esc_url(get_the_permalink() ).'">' . esc_html(get_the_title() ) . '</a></h2>';
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'z_woo_star_rating', 3 );

//WooCommerce add url to titles
function z_woo_change_products_title() {
    echo '<a class="woocommerce-loop-product__title trn500ms" href="' . esc_url(get_the_permalink() ) .' "><h3 class="woocommerce-loop-product__title trn500ms">' . esc_html(get_the_title() ) . '</h3></a>';
}

// Style to gallery product images

add_filter( 'woocommerce_single_product_image_gallery_classes', function( $classes ) {
    if ( get_theme_mod( 'z_woo_single_gallery_style', 'style_1' ) == 'style_1' ) {
        $classes = array_merge(['col-12', 'col-lg-6', 'z-woo-gallery-1','z-woo-gallery', 'position-relative',' p-0 '], $classes);
    } elseif ( get_theme_mod( 'z_woo_single_gallery_style', 'style_1' ) == 'style_2' ) {
        $classes = array_merge(['col-12', 'col-lg-6', 'z-woo-gallery-2','z-woo-gallery', 'position-relative',' p-0 '], $classes);
    }
    return $classes;
} );

// Close </a> tag just after it opens before product item
remove_action('woocommerce_before_shop_loop_item' , 'woocommerce_template_loop_product_link_open' , 10);

// Checkout coupon hider or show
if (get_theme_mod('z_woo_checkout_coupon', 'no') == 'yes') {
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}

// Remove default sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Move the product title on the first line
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 1 );

// Woocommerce single product dropdown with bootstrap class
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', static function( $args ) {
    $args['class'] = 'form-control';
    return $args;
}, 2 );

