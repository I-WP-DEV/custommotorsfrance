<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_link        = get_permalink();
$briny_post_format = get_post_format();
$briny_template_args = get_query_var( 'briny_template_args' );
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
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<div class="post_meta">
				<a href="<?php echo esc_url( $briny_link ); ?>" class="post_meta_item post_date"><?php echo wp_kses_data( briny_get_date() ); ?></a>
			</div>
			<?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $briny_link ); ?>"><?php the_title(); ?></a></h6>
        <?php
        // More button
        if ( empty( $briny_template_args['no_links'] )  ) {
            briny_show_post_more_link( $briny_template_args, '<p>', '</p>' );
        }
        ?>
	</div>
</div>
