<?php
/**
 * The style "default" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = empty($args['no_links']) ? get_permalink() : '';
$post_title = get_the_title();
$boats_arg = get_post_meta(get_the_ID(), 'trx_addons_options', true);

$meta_parts = !empty($args['meta_parts'])
				? (is_array($args['meta_parts'])
					? $args['meta_parts']
					: explode(',', $args['meta_parts'])
					)
				: array();

$args['image_width'] = max(20, min(80, (int) $args['image_width'])) . '%';
$args['text_width'] = 'calc(100% - ' . $args['image_width'] . ')';

// Prepare parts of template
$templates = trx_addons_components_get_allowed_templates('sc', 'blogger');
if (isset($templates[$args['type']][$args['template_'.$args['type']]])) {
	$template  = $templates[$args['type']][$args['template_'.$args['type']]];
	$template_parts = trx_addons_array_get_values($template['layout']);
	usort($template_parts, function($a, $b) {
		return substr($a, 0, 4) == 'meta' || $a < $b
					? -1
					: (
						substr($b, 0, 4) == 'meta' || $a > $b
							? 1
							: 0
					);
	});
	$template_parts = array_flip($template_parts);
	foreach( $template_parts as $k=>$v ) {
		$template_parts[$k] = '';
		if ( substr( $k, 0, 4 ) == 'meta') {
			$meta_key = substr( $k, 0, 5 ) == 'meta_' ? substr($k, 5) : '';
			if ( !empty($meta_key) && !in_array($meta_key, $meta_parts) ) continue;
			$template_parts[$k] = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_post_meta_args', array(
				'components' => !empty($meta_key) ? $meta_key : join(',', $meta_parts),
				'date_format' => $args['date_format'],
				'theme_specific' => false,
				'class' => "sc_blogger_item_meta post_{$k}",
				'echo' => false
				), 'sc_blogger_'.$args['type'], $args['columns'])
			);
			if (empty($post_link)) {
				$template_parts[$k] = trx_addons_links_to_span($template_parts[$k]);
			}
			if ( !empty($meta_key) ) {
				$meta_parts = array_flip($meta_parts);
				unset($meta_parts[$meta_key]);
				$meta_parts = array_flip($meta_parts);
			}
		} else if ( $k == 'title' ) {
			ob_start();
			the_title( '<h5 class="sc_blogger_item_title entry-title"'
						. ' data-item-number="' . esc_attr($args['item_number']) . '"'
						. '>'
							. (!empty($post_link)
								? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
								: ''),
						(!empty($post_link) ? '</a>' : '') . '</h5>' );
			$template_parts[$k] = ob_get_contents();
			ob_end_clean();
		} else if ( $k == 'excerpt' ) {
			if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) {
				ob_start();
				trx_addons_show_post_content( $args, '<div class="sc_blogger_item_excerpt">', '</div>' );
				$template_parts[$k] = ob_get_contents();
				ob_end_clean();
			}
		} else if ( $k == 'readmore' ) {
			if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) && !empty($post_link) && !empty($args['more_text']) ) {
				$template_parts[$k] = '<div class="sc_blogger_item_button sc_item_button">'
										. '<a href="' . esc_url($post_link) . '"'
											. ' class="' . esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple', 'sc_blogger', $args)) . '">'
											. esc_html($args['more_text'])
										. '</a>'
									. '</div>';
			}
		} else if ( $k == 'price' ) {
			$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			if (!is_array($meta)) $meta = array();
			$meta['price'] = apply_filters( 'trx_addons_filter_custom_meta_value', !empty($meta['price']) ? $meta['price'] : '', 'price' );
			if (!empty($meta['price'])) {
				$template_parts[$k] = '<div class="sc_blogger_item_price sc_item_price">' . esc_html($meta['price']) . '</div>';
			}
		} else {
			$val = apply_filters( 'trx_addons_filter_custom_meta_value', '', $k );
			if (!empty($val)) {
				$template_parts[$k] = '<div class="sc_blogger_item_'.esc_attr($k).' sc_item_'.esc_attr($k).'">' . esc_html($val) . '</div>';
			}
		}
	}

	if (empty($args['grid'])) {
		if ($args['slider']) {
			?><div class="slider-slide swiper-slide"><?php
		} else if ($args['columns'] > 1) {
			if ($args['image_ratio'] == 'masonry') {
				?><div class="masonry_item masonry_item-1_<?php echo esc_attr($args['columns']); ?>"><?php
			} else {
				?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
			}
		}
	}

	?><div data-post-id="<?php the_ID(); ?>" <?php
		post_class(
			'sc_blogger_item'
			. ' sc_blogger_item_'.esc_attr($args['type'])
			. ' sc_blogger_item_'.esc_attr($args['type']).'_'.esc_attr($args['template_'.$args['type']])
			. ' sc_blogger_item_'.esc_attr($args['item_number'] % 2 == 0 ? 'even' : 'odd')
			. ' sc_blogger_item_align_'.esc_attr($args['text_align'])
			. ' post_format_'.esc_attr($post_format)
			. (empty($post_link) ? ' no_links' : '')
			. (isset($template['layout']['featured']) ? ' sc_blogger_item_with_image' : '')
			. (! empty($args['numbers'] ) ? ' sc_blogger_item_with_numbers' : '')
			. ( (int) $args['on_plate'] > 0 ? ' sc_blogger_item_on_plate' : '' )
			. ' sc_blogger_item_image_position_' . esc_attr($args['image_position'])
		);
		?> data-item-number="<?php echo esc_attr($args['item_number']); ?>"
	><?php

		// Post info inside featured image
		$post_info = '';
		if ( !empty($template['layout']['featured']) && is_array($template['layout']['featured']) ) {
			foreach($template['layout']['featured'] as $pos => $elements) {
				$html = '';
                $post_type = get_post_type();
				foreach($elements as $element) {
					if (!empty($template_parts[$element])) {
						$html .= apply_filters( 'trx_addons_action_sc_blogger_item_element', trim($template_parts[$element]), $element, 'featured-'.$pos, $args );
					}
				}
				if (!empty($html) && ($post_type != 'cpt_tours') && ($post_type != 'cpt_boats')) {
					$post_info .= '<div class="' . apply_filters( 'trx_addons_filter_sc_featured_post_info', 'post_info_' . esc_attr($pos), 'blogger-'.$args['type'], $args ) . '">'
									. trim($html)
								. '</div>';
				}

				if( $post_type == 'cpt_tours' ){
                    $post_info .= '<div class="' . apply_filters( 'trx_addons_filter_sc_featured_post_info', 'post_info_' . esc_attr($pos), 'blogger-'.$args['type'], $args ) . '">'
                         . trx_addons_get_post_terms(' ', get_the_ID(), BASEKIT_ADDONS_CPT_TOURS_TAXONOMY)
                        .'</div>';
                }
                if( $post_type == 'cpt_boats' ){
                    $post_info .= '<div class="' . apply_filters( 'trx_addons_filter_sc_featured_post_info', 'post_info_' . esc_attr($pos), 'blogger-'.$args['type'], $args ) . '">'
                        . trx_addons_get_post_terms(' ', get_the_ID(), TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_TYPE)
                        . '</div>';
                }
			}
		}

		do_action( 'trx_addons_action_sc_blogger_item_start', $args );

		// Header
		if ( !empty($template['layout']['header']) ) {
			do_action( 'trx_addons_action_sc_blogger_item_before_header', $args );
			?><div class="sc_blogger_item_header entry-header"><?php
				do_action( 'trx_addons_action_sc_blogger_item_header_start', $args );
				foreach ($template['layout']['header'] as $element) {
					if (!empty($template_parts[$element])) {
						trx_addons_show_layout( apply_filters( 'trx_addons_action_sc_blogger_item_element', $template_parts[$element], $element, 'header', $args ) );
					}
				}		
				do_action( 'trx_addons_action_sc_blogger_item_header_end', $args );
			?></div><!-- .entry-header --><?php
			do_action( 'trx_addons_action_sc_blogger_item_after_header', $args );
		}

		?><div class="sc_blogger_item_body"><?php

			do_action( 'trx_addons_action_sc_blogger_item_body_start', $args );

			// Featured image
			if ( isset($template['layout']['featured']) ) {
				do_action( 'trx_addons_action_sc_blogger_item_before_featured', $args );
				trx_addons_get_template_part('templates/tpl.featured.php',
											'trx_addons_args_featured',
											apply_filters('trx_addons_filter_args_featured', array(
																'class' => 'sc_item_featured sc_blogger_item_featured'
																			. ( in_array( $args['image_position'], array('left', 'right', 'alter') ) && !empty($template['layout']['content'])
																				? ' ' . esc_attr( trx_addons_add_inline_css_class( 'width:' . $args['image_width'] . ' !important;' ) )
																				: ''
																				),
																
																'no_links' => empty($post_link),
																'post_info' => $post_info,
																'thumb_bg' => ! in_array( $args['image_ratio'], array('', 'none', 'masonry') ),
																'thumb_ratio' => $args['image_ratio'],
																'thumb_size' => apply_filters('trx_addons_filter_thumb_size',
																					trx_addons_get_thumb_size(
																						! in_array( $args['image_ratio'], array('', 'none') )
																							? ( $args['columns'] > 2
																								? 'masonry-big'	// Use -big because when image is square 'masonry' is blur!
																								: 'masonry-big'
																								)
																							: ( $args['columns'] > 2 
																								? 'medium' 
																								: 'big'
																								)
																					),
																					'blogger-'.$args['type']
																				),
																), 'blogger-'.$args['type'])
										);
				do_action( 'trx_addons_action_sc_blogger_item_after_featured', $args );
			}

			// Content
			if ( !empty($template['layout']['content']) ) {
				do_action( 'trx_addons_action_sc_blogger_item_before_content', $args );
				?><div class="sc_blogger_item_content entry-content<?php
					echo isset( $template['layout']['featured'] ) && in_array( $args['image_position'], array( 'left', 'right', 'alter' ) )
						? ' '.esc_attr( trx_addons_add_inline_css_class( 'width:' . $args['text_width'] . ' !important;' ) )
						: '';
				?>"><?php
					do_action( 'trx_addons_action_sc_blogger_item_content_start', $args );
					foreach ($template['layout']['content'] as $element) {
						if (!empty($template_parts[$element])) {
							trx_addons_show_layout( apply_filters( 'trx_addons_action_sc_blogger_item_element', $template_parts[$element], $element, 'content', $args ) );
						}
					}		
					do_action( 'trx_addons_action_sc_blogger_item_content_end', $args );
				?></div><!-- .entry-content --><?php
				do_action( 'trx_addons_action_sc_blogger_item_after_content', $args );

                if(($args['template_default'] == 'classic_2') && ($args['post_type'] == 'cpt_boats')) {
                $boat_location = trx_addons_get_post_terms('', get_the_ID(), TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_LOCATION);
                    ?>
                    <div class="boats_page_title_address icon-placeholder">
                                     <?php if (!empty($boat_location)) {
                                         trx_addons_show_layout($boat_location);
                                     }
                                     ?>
                                </div><?php
                   ?>
                    <div class="boats_page_meta_wrap">
                        <?php
                        if (!empty($boats_arg['length'])) {
                            ?><span class="boats_page_section_item">
                              <span class="boats_page_label icon-ruler"></span>
                              <span class="boats_page_data"><?php
                               trx_addons_show_layout($boats_arg['length']
                                . ($boats_arg['length_prefix']
                                    ? ' ' . trx_addons_prepare_macros($boats_arg['length_prefix'])
                                    : ''
                                )
                            );
                            ?></span>
                            </span><?php
                        }
                        $boat_crew = strip_tags(trx_addons_get_post_terms('', get_the_ID(), TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_CREW));
                        if (!empty( $boat_crew)) {
                            ?><span class="boats_page_section_item">
                            <span class="boats_page_label icon-profile"></span>
                             <span class="boats_page_data"><?php
                            briny_show_layout($boat_crew);
                        ?></span>
                            </span><?php
                        }
                        if (!empty($boats_arg['cabins'])) {
                            ?><span class="boats_page_section_item ">
                            <span class="boats_page_label icon-bed"></span>
                            <span class="boats_page_data"><?php echo esc_html($boats_arg['cabins']); ?></span>
                            </span><?php
                        }
                        ?>
                    </div>
                    <?php
                    }
                }

			do_action( 'trx_addons_action_sc_blogger_item_body_end', $args );

		?></div><!-- .sc_blogger_item_body --><?php

		// Footer
		if ( !empty($template['layout']['footer']) ) {
			do_action( 'trx_addons_action_sc_blogger_item_before_footer', $args );
			?><div class="sc_blogger_item_footer entry-footer"><?php
				do_action( 'trx_addons_action_sc_blogger_item_footer_start', $args );
				foreach ($template['layout']['footer'] as $element) {
					if (!empty($template_parts[$element])) {
						trx_addons_show_layout( apply_filters( 'trx_addons_action_sc_blogger_item_element', $template_parts[$element], $element, 'footer', $args ) );
					}
				}		
				do_action( 'trx_addons_action_sc_blogger_item_footer_end', $args );
			?></div><!-- .entry-footer --><?php
			do_action( 'trx_addons_action_sc_blogger_item_after_footer', $args );
		}

		do_action( 'trx_addons_action_sc_blogger_item_end', $args );

	?></div><!-- .sc_blogger_item --><?php

	if (empty($args['grid']) && ($args['slider'] || $args['columns'] > 1)) {
		?></div><?php
	}
}