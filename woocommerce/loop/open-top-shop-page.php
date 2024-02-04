<?php

/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.1
 */

if (!defined('ABSPATH')) {
    exit;
}

?>

<div id="top-shop-loop">
    <div class="row align-items-center">
        <div class="center-top-shop-loop col col-12 col-sm-3">
        <?php if( get_theme_mod( 'z_woo_cat_show_results', 'no' ) == 'no') { ?>
            <?php
            /**
             * Add result count
             * @hooked woocommerce_result_count - 10
             */
            do_action('zoo_woocommerce_result_count');
            ?>
        <?php } // end if ?>
        </div>
        <?php if( get_theme_mod( 'z_woo_cat_show_sorting', 'no') == 'no') { ?>
            <div class="right-top-shop-loop top-page-pagination col col-12 col-sm-9 text-end d-block d-md-flex justify-content-start justify-content-md-end mt-4 mt-md-0">
                <?php
                    /**
                     * Add ordering select box.
                     * @hooked woocommerce_catalog_ordering - 10
                     */
                    do_action('zoo_woocommerce_catalog_ordering');
                ?>
            </div>
        <?php } // end if ?>
    </div>
</div>