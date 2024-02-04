/**
 * File App-woo.js
 */

// Add to cart without refresh page
(function ($) {
    "use strict";
    jQuery(document).ready(function () {
        if (typeof wc_add_to_cart_params != 'undefined') {

            //Refresh variations_form button added to cart when change option.
            $("form.variations_form").on("woocommerce_variation_select_change", function () {
                $(this).find('.cart-added').removeClass('cart-added');
            });
            $(document).on('click', 'button.single_add_to_cart_button:not(.disabled)', function (e) {
                e.preventDefault();
                var $thisbutton = $(this);
                if( $thisbutton.closest('form').attr('method') == 'get' ) {
                    return;
                }
                var max = parseInt(($thisbutton).closest('form').find('input.qty').attr('max'));
                var qty = parseInt(($thisbutton).closest('form').find('input.qty').val());
                var $form = $thisbutton.closest('form.cart'),
                    id = $thisbutton.val(),
                    product_qty = $form.find('input[name=quantity]').val() || 1,
                    product_id = $form.find('input[name=product_id]').val() || id,
                    variation_id = $form.find('input[name=variation_id]').val() || 0;
                var variations={};
                if(!product_id){
                    return true;
                }
                $form.find('select').each(function () {
                    variations[$(this).attr('name')]=$(this).val();
                });
                if (!!max && (max < qty)) {
                    alert('Value must be less than or equal to '+ max);
                    return;
                }
                if ($thisbutton.hasClass('cart-added')) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return false;
                }
                if($form.find('.woocommerce_gc_giftcard_form')[0]){
                    return true;
                }
                var data = {
                    action: 'woocommerce_ajax_add_to_cart',
                    product_id: product_id,
                    product_sku: '',
                    quantity: product_qty,
                    variation_id: variation_id,
                    variations: variations,
                };

                $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
                $.ajax({
                    type: 'post',
                    url: wc_add_to_cart_params.ajax_url,
                    data: data,
                    beforeSend: function (response) {
                        $thisbutton.removeClass('added').addClass('loading');
                    },
                    complete: function (response) {
                        $thisbutton.addClass('added').removeClass('loading');
                    },
                    success: function (response) {
                        if (response.error & response.product_url) {
                            window.location = response.product_url;
                            return;
                        } else {
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                            if ($thisbutton.hasClass('z-woo-buy-now')) {
                                window.location = $thisbutton.attr('direct_link');
                                return false;
                            }
                        }
                    },
                });
                return false;
            });
        }
        /* End Ajax Add to Cart for Single Product */
        //Function for Add to Cart message
        function zoo_add_to_cart_mess($zoo_mess) {
            if (!!$zoo_mess && $zoo_mess != undefined) {
                if ($('#zoo-add-to-cart-message')[0]) {
                    $('#zoo-add-to-cart-message').replaceWith($zoo_mess);
                } else {
                    $('body').append($zoo_mess);
                }
                setTimeout(function () {
                    $('#zoo-add-to-cart-message').addClass('active');
                }, 100);
                setTimeout(function () {
                    $('#zoo-add-to-cart-message').removeClass('active');
                }, 3500);
            }
        }
    })
})(jQuery);