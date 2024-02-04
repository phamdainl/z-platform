<?php 
/**
 * Author
 *
 * @link https://jetpack.com/
 *
 * @package Z_Platform
 */

	the_post();
		
	$author_id = get_the_author_meta('ID');
	$zplatform_user = get_user_by('ID', $author_id);
		
	$user_nicename    = $zplatform_user->user_nicename;
	$display_name     = $zplatform_user->display_name;
	$user_description = $zplatform_user->user_description;
	$user_website     = $zplatform_user->website_name;
	$user_twitter     = $zplatform_user->twitter;
    $social_links     = z_platform_get_user_social_links();
		
	rewind_posts();
?>
	<h2 class="single_h2"> <span><?php esc_html_e( 'Author', 'z-platform' ); ?></span> </h2>
	<div class="single_author_box">
		<div class="single_author_img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></div>
		<div class="single_author_name margin-auto mt-3 text-center">
			<a href="<?php echo esc_html(get_author_posts_url($author_id, $user_nicename)); ?>"><?php echo esc_html($display_name); ?></a>
 		</div>
	</div>
	<div class="">
		<div class="single_author_description">
			<?php echo esc_attr($user_description); ?>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="margin-auto single_author_social">
			<?php echo $social_links; ?>
		</div>
	</div>
