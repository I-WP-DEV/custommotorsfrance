<?php
/**
 * The default template to displaying related posts
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.54
 */

$briny_link        = get_permalink();
$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $briny_post_format ) ); ?>>
	<?php
	briny_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'briny_filter_related_thumb_size', briny_get_thumb_size( (int) briny_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => briny_get_no_image() != '',
		)
	);
	?>
	<div class="post_header entry-header">
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $briny_link ); ?>"><?php the_title(); ?></a></h6>
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<span class="post_date"><a href="<?php echo esc_url( $briny_link ); ?>"><?php echo wp_kses_data( briny_get_date() ); ?></a></span>
			<?php
		}
		?>
	</div>
</div>
