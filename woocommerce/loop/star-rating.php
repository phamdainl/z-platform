<?php $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
<?php if ($average = $product->get_average_rating()) : ?>
    <ul class="z-woo-ratings-wrapper">
        <li>
            <?php echo '<div class="star-rating" title="'.sprintf(esc_html__( 'Rated %s out of 5', 'z-platform' ), esc_attr($average)).'"><span style="width:'.( ( esc_attr($average / 5 ) * 100 ) ) . '%"><strong itemprop="ratingValue" class="rating">'.esc_attr($average).'</strong> '.esc_html__( 'out of 5', 'z-platform' ).'</span></div>'; // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment ?>
        </li>
    </ul>
<?php endif; ?>