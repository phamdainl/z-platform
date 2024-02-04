<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Z_Platform
 */

$footer_container_mode = get_theme_mod( 'footer_container_mode', 'container' );
$footer_container_mode_bottom = get_theme_mod( 'footer_container_mode_bottom', 'container' );
$footer_logo = get_theme_mod( 'footer_logo' );
$fixed_section_alignment = get_theme_mod( 'theme_footer_fixed_section_alignment', 'left' );

?>

<?php if ( get_theme_mod('theme_footer_fixed_section', 'no') === 'yes' ) { ?>
	<?php if(get_theme_mod( 'theme_footer_fixed_section_screen' ) == 'mobile') : ?>
		<div id="zplatform_footer_cta_block" class="zplatform_footer_cta_block footer-fixed-panel fixed-bottom d-block d-sm-none mb-5 mx-5 <?php echo  esc_attr($fixed_section_alignment); ?>">
			<?php echo wp_kses_post(do_shortcode(get_theme_mod( 'theme_footer_fixed_section_code'))); ?>
		</div>
	<?php endif; ?>
	<?php if(get_theme_mod( 'theme_footer_fixed_section_screen' ) == 'desktop') : ?>
		<div id="zplatform_footer_cta_block" class="zplatform_footer_cta_block footer-fixed-panel fixed-bottom d-none d-sm-block mb-5 mx-5 <?php echo  esc_attr($fixed_section_alignment); ?>">
			<?php echo wp_kses_post(do_shortcode(get_theme_mod( 'theme_footer_fixed_section_code'))); ?>
		</div>
	<?php endif; ?>
	<?php if(get_theme_mod( 'theme_footer_fixed_section_screen' ) == 'both') : ?>
		<div id="zplatform_footer_cta_block" class="zplatform_footer_cta_block footer-fixed-panel fixed-bottom d-block mb-5 mx-5 <?php echo  esc_attr($fixed_section_alignment); ?>">
			<?php echo wp_kses_post(do_shortcode(get_theme_mod( 'theme_footer_fixed_section_code'))); ?>
		</div>
	<?php endif; ?>
<?php } ?>

<?php if ( get_theme_mod('enable_navbar_search', 'yes') === 'yes' ) { ?>
<!-- Search Modal -->
<div class="modal fade" id="z-platform-search-modal" tabindex="-1" aria-labelledby="z-woo-search-modal-label" aria-hidden="true">
    <div class="modal-header justify-content-end border-0">
        <button type="button" class="btn btn-primary close-search-header me-3" data-bs-dismiss="modal">X Exit Search</button>
    </div>
    <div class="modal-dialog modal-fullscreen-sm-down w-100 position-absolute translate-middle">
        <div class="z-navbar-search w-100 pe-auto">
            <div class="modal-body justify-content-center d-flex vertical-align text-center">
                <?php get_search_form() ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ( get_theme_mod('enable_header_cart', 'no') === 'yes' ) { ?>
<!-- offcanvas cart -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-cart">
    <div class="offcanvas-header bg-light">
        <span class="h5 mb-0"><?php esc_html_e('Cart', 'z-platform'); ?></span>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="cart-list">
            <div class="widget_shopping_cart_content">
            </div>
        </div>
    </div>
</div>
<?php   }   ?>


<footer id="footer">
	<?php if( get_theme_mod( 'theme_top_footer', 'no') == 'yes') { ?>
		<div class="footer_top">
        	<div class="<?php echo esc_attr($footer_container_mode); ?> pt-5 pb-5">
        		<div class="row text-lg-start text-center">
        			<?php if ( is_active_sidebar( 'z_platform_sidebar_footer_1' ) ) : ?>
    					<div class="col-12 col-lg-3">
            				<div class="w-100 line-height-footer"><?php dynamic_sidebar( 'z_platform_sidebar_footer_1' ); ?></div>
    					</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'z_platform_sidebar_footer_2' ) ) : ?>
    					<div class="col-12 col-lg-3">
							<div class="w-100 footer_menu">
								<div class="w-100 line-height-footer"><?php dynamic_sidebar( 'z_platform_sidebar_footer_2' ); ?></div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'z_platform_sidebar_footer_3' ) ) : ?>
    					<div class="col-12 col-lg-3">
							<div class="w-100 footer_menu">
								<div class="w-100 line-height-footer"><?php dynamic_sidebar( 'z_platform_sidebar_footer_3' ); ?></div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'z_platform_sidebar_footer_4' ) ) : ?>
    					<div class="col-12 col-lg-3">
							<div class="w-100"><?php dynamic_sidebar( 'z_platform_sidebar_footer_4' ); ?></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } // end if ?>

	<div class="footer_bottom <?php if(get_theme_mod( 'theme_footer_style' ) == 'style_1') : ?>footer_bottom_style_1<?php else : ?>footer_bottom_style_2<?php endif;  ?>">
		<?php if(get_theme_mod( 'theme_footer_style' ) == 'style_1') : ?>
   			<div class="<?php echo esc_attr($footer_container_mode_bottom); ?> pt-4 pb-4">
				<div class="col-sm-12 text-center">
					<?php echo wp_kses_post(get_theme_mod( 'footer_copyright_text', 'All rights are reserved')); ?>
				</div>
			</div>
		<?php else : ?>
		    <div class="<?php echo esc_attr($footer_container_mode_bottom); ?> pt-4 pb-4">
			<div class="row align-items-center">
				<?php if( get_theme_mod('footer_logo') ){ ?>
					<div class="text-lg-start text-center mb-lg-0 mb-4 col-md-4">
						<a href="<?php echo esc_url(get_home_url()); ?>" title="<?php the_title();?>"><img src="<?php echo esc_attr($footer_logo); ?>" class="logo-custom img-fluid" width="220" height="auto"></a>
					</div>
				<?php } // end if ?>
				<div class="<?php if ( get_theme_mod('footer_logo') ) : ?>text-center col-md-4<?php else: ?>text-center text-md-start col-md-8<?php endif ?> mb-lg-0 mb-4">
					<?php echo wp_kses_post(get_theme_mod( 'footer_copyright_text', 'All rights are reserved')); ?>
				</div>
				<div class="text-lg-end text-center col-md-4 col-md-4">
						<div class="footer_social">
							<a href="<?php echo esc_attr(get_theme_mod('theme_footer_social_facebook')); ?>" class="<?php echo empty(get_theme_mod('theme_footer_social_facebook')) ? 'd-none' : ''; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  									<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
								</svg>
							</a>
							<a href="<?php echo esc_attr(get_theme_mod('theme_footer_social_twitter')); ?>" class="<?php echo empty(get_theme_mod('theme_footer_social_twitter')) ? 'd-none' : ''; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
  									<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
								</svg>
							</a>
							<a href="<?php echo esc_attr(get_theme_mod('theme_footer_social_telegram')); ?>" class="<?php echo empty(get_theme_mod('theme_footer_social_telegram')) ? 'd-none' : ''; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
  									<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
								</svg>
							</a>
							<a href="<?php echo esc_attr(get_theme_mod('theme_footer_social_pinterest')); ?>" class="<?php echo empty(get_theme_mod('theme_footer_social_pinterest')) ? 'd-none' : ''; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16">
  									<path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0z"/>
								</svg>
							</a>
							<a href="<?php echo esc_attr(get_theme_mod('theme_footer_social_linkedin')); ?>" class="<?php echo empty(get_theme_mod('theme_footer_social_linkedin')) ? 'd-none' : ''; ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  									<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
								</svg>
							</a>
						</div>
				</div>
			</div>
		</div>
		<?php endif;  ?>
	</div>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>