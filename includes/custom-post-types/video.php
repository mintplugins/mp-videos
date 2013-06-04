<?php
/**
 * Custom Post Types
 *
 * @package mp_videos
 * @since mp_videos 1.0
 */

/**
 * Video Custom Post Type
 */
function mp_videos_post_type() {
	
		$videos_labels =  apply_filters( 'mp_videos_videos_labels', array(
			'name' 				=> 'Video',
			'singular_name' 	=> 'Video',
			'add_new' 			=> __('Add New', 'mp_videos'),
			'add_new_item' 		=> __('Add New Video', 'mp_videos'),
			'edit_item' 		=> __('Edit Video', 'mp_videos'),
			'new_item' 			=> __('New Video', 'mp_videos'),
			'all_items' 		=> __('All Videos', 'mp_videos'),
			'view_item' 		=> __('View Videos', 'mp_videos'),
			'search_items' 		=> __('Search Videos', 'mp_videos'),
			'not_found' 		=>  __('No Videos found', 'mp_videos'),
			'not_found_in_trash'=> __('No Videos found in Trash', 'mp_videos'), 
			'parent_item_colon' => '',
			'menu_name' 		=> __('Video', 'mp_videos')
		) );
		
			
		$videos_args = array(
			'labels' 			=> $videos_labels,
			'public' 			=> true,
			'publicly_queryable'=> true,
			'show_ui' 			=> true, 
			'show_in_nav_menus' => true,
			'show_in_menu' 		=> true, 
			'menu_position'		=> 5,
			'query_var' 		=> true,
			'rewrite' 			=> array( 'slug' => 'video' ),
			'capability_type' 	=> 'post',
			'has_archive' 		=> true, 
			'hierarchical' 		=> false,
			'supports' 			=> apply_filters('mp_videos_people_supports', array( 'title', 'editor', 'thumbnail' ) ),
		); 
		register_post_type( 'mp_video', apply_filters( 'mp_videos_people_post_type_args', $videos_args ) );
}
add_action( 'init', 'mp_videos_post_type', 0 );

/**
 * Playlist Taxonomy
 */
 
function mp_videos_person_group_taxonomy() {  
		
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'                => __( 'Playlists', 'mp_videos' ),
			'singular_name'       => __( 'Playlist', 'mp_videos' ),
			'search_items'        => __( 'Search Playlists', 'mp_videos' ),
			'all_items'           => __( 'All Playlists', 'mp_videos' ),
			'parent_item'         => __( 'Parent Playlist', 'mp_videos' ),
			'parent_item_colon'   => __( 'Parent Playlist:', 'mp_videos' ),
			'edit_item'           => __( 'Edit Playlist', 'mp_videos' ), 
			'update_item'         => __( 'Update Playlist', 'mp_videos' ),
			'add_new_item'        => __( 'Add New Playlist', 'mp_videos' ),
			'new_item_name'       => __( 'New Playlist Name', 'mp_videos' ),
			'menu_name'           => __( 'Playlists', 'mp_videos' ),
		); 	
  
		register_taxonomy(  
			'mp_video_playlist',  
			'mp_video',  
			array(  
				'hierarchical' => true,  
				'label' => 'Playlists',  
				'labels' => $labels,  
				'query_var' => true,  
				'with_front' => false, 
				'rewrite' => array('slug' => 'videos')  
			)  
		);  
}  
add_action( 'init', 'mp_videos_person_group_taxonomy' );  

/**
 * Change default title
 */
function mp_videos_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'mp_video' == $screen->post_type ) {
          $title = __('Enter the Video\'s Name', 'mp_videos');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'mp_videos_change_default_title' );

/**
 * These actions make the mp_brick post type drag and drop re-order-able
 */
add_filter('manage_mp_video_posts_columns', 'mp_core_add_new_post_column');
add_action('manage_mp_video_posts_custom_column','mp_core_show_order_column');