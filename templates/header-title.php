<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

// Page (category, tag, archive, author) title

if ( briny_need_page_title() ) {
	briny_sc_layouts_showed( 'title', true );
	briny_sc_layouts_showed( 'postmeta', false );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if (  false && is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								briny_show_post_meta(
									apply_filters(
										'briny_filter_post_meta_args', array(
											'components' => briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) ),
											'counters'   => briny_array_get_keys_by_value( briny_get_theme_option( 'counters' ) ),
											'seo'        => briny_is_on( briny_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$briny_blog_title           = briny_get_blog_title();
							$briny_blog_title_text      = '';
							$briny_blog_title_class     = '';
							$briny_blog_title_link      = '';
							$briny_blog_title_link_text = '';
							if ( is_array( $briny_blog_title ) ) {
								$briny_blog_title_text      = $briny_blog_title['text'];
								$briny_blog_title_class     = ! empty( $briny_blog_title['class'] ) ? ' ' . $briny_blog_title['class'] : '';
								$briny_blog_title_link      = ! empty( $briny_blog_title['link'] ) ? $briny_blog_title['link'] : '';
								$briny_blog_title_link_text = ! empty( $briny_blog_title['link_text'] ) ? $briny_blog_title['link_text'] : '';
							} else {
								$briny_blog_title_text = $briny_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $briny_blog_title_class ); ?>">
								<?php
								$briny_top_icon = briny_get_term_image_small();
								if ( ! empty( $briny_top_icon ) ) {
									$briny_attr = briny_getimagesize( $briny_top_icon );
									?>
									<img src="<?php echo esc_url( $briny_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'briny' ); ?>"
										<?php
										if ( ! empty( $briny_attr[3] ) ) {
											briny_show_layout( $briny_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses( $briny_blog_title_text, 'briny_kses_content');
								?>
							</h1>
							<?php
							if ( ! empty( $briny_blog_title_link ) && ! empty( $briny_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $briny_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $briny_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php
                        if ( briny_exists_trx_addons() ) { // Breadcrumbs ?>
                            <div class="sc_layouts_title_breadcrumbs">
                                <?php
                                do_action( 'briny_action_breadcrumbs' );
                                ?>
                            </div>
                            <?php
                        }
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
