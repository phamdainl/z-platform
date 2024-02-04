<?php
/**
* Template search form
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package Z_Platform
*/

$zplatform_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
$zplatform_unique_id = wp_unique_id( 'search-form-' );

?>
<?php
if ( class_exists( 'WooCommerce' ) ) {?>
    <form role="search" <?php echo esc_attr($zplatform_label); ?> id="searchform" method="get" class="w-100 search-form searchform woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label for="<?php echo esc_attr( $zplatform_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search', 'z-platform' ); ?></label> 
        <input type="text" id="<?php echo esc_attr( $zplatform_unique_id ); ?>" placeholder="<?php esc_attr_e( 'Search products...', 'z-platform' ); ?>" class="search-field input_search w-100 p-2 form-control shadow-none text-center" value="<?php echo get_search_query(); ?>" name="s" /><input type="hidden" name="post_type" value="product">
        <button type="submit" value="Search"  id="searchsubmit" class="mt-3 btn btn-primary search-submit"><?php echo esc_attr_x( 'Search', 'submit button', 'z-platform' ); ?></button>
    </form>
<?php } else { ?>
    <form role="search" <?php echo esc_attr($zplatform_label); ?> id="searchform" method="get" class="w-100 search-form searchform woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label for="<?php echo esc_attr( $zplatform_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search', 'z-platform' ); ?></label> 
        <input type="text" id="<?php echo esc_attr( $zplatform_unique_id ); ?>" placeholder="<?php esc_attr_e( 'Search&hellip;', 'z-platform' ); ?>" class="search-field input_search w-100 p-2 form-control shadow-none text-center" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" value="Search"  id="searchsubmit" class="mt-3 btn btn-primary search-submit"><?php echo esc_attr_x( 'Search', 'submit button', 'z-platform' ); ?></button>
    </form>
<?php } ?>