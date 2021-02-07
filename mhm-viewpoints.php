<?php

/**
 * Plugin Name:     Places
 * Plugin URI:      https://github.com/markhowellsmead/mhm-viewpoints
 * Description:		WordPress Plugin to provide a custom post type and custom taxonomies.
 * Author:          Mark Howells-Mead
 * Author URI:      https://permanenttourist.ch/
 * Text Domain:     mhm-places
 * Domain Path:     /languages
 * Version:         1.0.2
 * Requires PHP: 	7.2
 */

namespace MHM\Places;

register_activation_hook(__FILE__, 'flush_rewrite_rules');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');

add_action('plugins_loaded', function () {
	load_plugin_textdomain('mhm-places', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

add_action('init', function () {
	register_post_type(
		'mhm-place',
		[
			'description' => _x('Places', 'Post type description', 'mhm-place'),
			'menu_icon' => 'dashicons-admin-site-alt',
			'menu_position' => 10,
			'hierarchical' => true,
			'has_archive' => true,
			'public' => true,
			'show_in_rest' => true,
			'rest_base' => 'places',
			'rewrite' => [
				'slug' => 'places'
			],
			'supports' => [
				'title',
				'editor',
				'thumbnail',
				'page-attributes'
			],
			'labels' => [
				'name' => _x('Places', 'CPT name', 'mhm-place'),
				'singular_name' => _x('Place', 'CPT singular name', 'mhm-place'),
				'add_new' => _x('Add new', 'CPT add_new', 'mhm-place'),
				'add_new_item' => _x('Add new Place', 'cpt name', 'mhm-place'),
				'edit_item' => _x('Edit Place', 'cpt name', 'mhm-place'),
				'new_item' => _x('New Place', 'cpt name', 'mhm-place'),
				'view_item' => _x('View Place', 'cpt name', 'mhm-place'),
				'view_items' => _x('View Places', 'cpt name', 'mhm-place'),
				'search_items' => _x('Search Places', 'cpt name', 'mhm-place'),
				'not_found' => _x('No Places', 'cpt name', 'mhm-place'),
				'not_found_in_trash' => _x('No Places in the trash', 'cpt name', 'mhm-place'),
				'all_items' => _x('All Places', 'cpt name', 'mhm-place'),
				'archives' => _x('Place Places', 'cpt name', 'mhm-place'),
				'attributes' => _x('Attributes', 'cpt name', 'mhm-place'),
				'name_admin_bar' => _x('Place', 'Label for name admin bar', 'mhm-place'),
				'insert_into_item' => _x('Insert into Place', 'Label for name admin bar', 'mhm-place'),
				'uploaded_to_this_item' => _x('Uploaded to this Place', 'Label for name admin bar', 'mhm-place'),
				'filter_items_list' => _x('Filter Places', 'Label for name admin bar', 'mhm-place'),
				'items_list_navigation' => _x('Place list navigation', 'Label for name admin bar', 'mhm-place'),
				'items_list' => _x('List of Places', 'Label for name admin bar', 'mhm-place'),
				'item_published' => _x('Place published.', 'Label for name admin bar', 'mhm-place'),
				'item_published_privately' => _x('Place published privately.', 'Label for name admin bar', 'mhm-place'),
				'item_reverted_to_draft' => _x('Place reverted to draft status.', 'Label for name admin bar', 'mhm-place'),
				'item_scheduled' => _x('Place scheduled.', 'Label for name admin bar', 'mhm-place'),
				'item_updated' => _x('Place updated.', 'Label for name admin bar', 'mhm-place'),
				// 'featured_image' => _x('Featured image', 'Custom post type label', 'mhm-place'),
				// 'set_featured_image' => _x('Set featuried image', 'Custom post type label', 'mhm-place'),
				// 'remove_featured_image' => _x('Remove Place image', 'Custom post type label', 'mhm-place'),
				// 'use_featured_image' => _x('Use as Place image', 'Custom post type label', 'mhm-place'),
			]
		]
	);

	add_post_type_support('mhm-place', 'excerpt');
});


add_action('init', function () {
	if (function_exists('acf_add_local_field_group')) :
		acf_add_local_field_group(array(
			'key' => 'group_5e3da9e9a4b23',
			'title' => 'Location',
			'fields' => array(
				array(
					'key' => 'location',
					'label' => 'Position on map',
					'name' => 'location',
					'type' => 'google_map',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'center_lng' => '8.22421',
					'center_lat' => '46.8131873',
					'zoom' => 10,
					'height' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'mhm-place',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'modified' => 1581099561,
		));

		acf_add_local_field_group(array(
			'key' => 'group_related',
			'title' => 'Attributes',
			'fields' => array(
				array(
					'key' => 'related_places',
					'label' => 'Related Places',
					'name' => 'related_places',
					'type' => 'relationship',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'mhm-place',
					),
					'taxonomy' => '',
					'filters' => array(
						0 => 'search',
					),
					'elements' => array(
						0 => 'featured_image',
					),
					'min' => '',
					'max' => '',
					'return_format' => 'object',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'mhm-place',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));
	endif;
});
