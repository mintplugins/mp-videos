<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_videos_links_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_videos_links_add_meta_box = array(
		'metabox_id' => 'mp_videos_links', 
		'metabox_title' => __( 'Video', 'mp_videos'), 
		'metabox_posttype' => 'mp_video', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_videos_links_items_array = array(
		array(
			'field_id'			=> 'video_code',
			'field_title' 	=> __( 'Video URL or Embed Code', 'mp_videos'),
			'field_description' 	=> 'Paste the URL or Embed code of your video',
			'field_type' 	=> 'textarea',
			'field_value' => '',
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_videos_links_add_meta_box = has_filter('mp_videos_links_meta_box_array') ? apply_filters( 'mp_videos_links_meta_box_array', $mp_videos_links_add_meta_box) : $mp_videos_links_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_videos_links_items_array = has_filter('mp_videos_links_items_array') ? apply_filters( 'mp_videos_links_items_array', $mp_videos_links_items_array) : $mp_videos_links_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_videos_links_meta_box;
	$mp_videos_links_meta_box = new MP_CORE_Metabox($mp_videos_links_add_meta_box, $mp_videos_links_items_array);
}
add_action('plugins_loaded', 'mp_videos_links_create_meta_box');