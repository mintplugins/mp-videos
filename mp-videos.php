<?php
/*
Plugin Name: MP Videos
Plugin URI: http://moveplugins.com
Description: Post Videos from YouTube, Vimeo, and more
Version: 1.0.0.1
Author: Move Plugins
Author URI: http://moveplugins.com
Text Domain: mp_videos
Domain Path: languages
License: GPL2
*/

/*  Copyright 2012  Phil Johnston  (email : phil@moveplugins.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Move Plugins Core.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Move Plugins Core, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// Plugin version
if( !defined( 'MP_VIDEOS_VERSION' ) )
	define( 'MP_VIDEOS_VERSION', '1.0.0.0' );

// Plugin Folder URL
if( !defined( 'MP_VIDEOS_PLUGIN_URL' ) )
	define( 'MP_VIDEOS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Plugin Folder Path
if( !defined( 'MP_VIDEOS_PLUGIN_DIR' ) )
	define( 'MP_VIDEOS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Root File
if( !defined( 'MP_VIDEOS_PLUGIN_FILE' ) )
	define( 'MP_VIDEOS_PLUGIN_FILE', __FILE__ );

/*
|--------------------------------------------------------------------------
| GLOBALS
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function mp_videos_textdomain() {

	// Set filter for plugin's languages directory
	$mp_videos_lang_dir = dirname( plugin_basename( MP_VIDEOS_PLUGIN_FILE ) ) . '/languages/';
	$mp_videos_lang_dir = apply_filters( 'mp_videos_languages_directory', $mp_videos_lang_dir );


	// Traditional WordPress plugin locale filter
	$locale        = apply_filters( 'plugin_locale',  get_locale(), 'mp-videos' );
	$mofile        = sprintf( '%1$s-%2$s.mo', 'mp-docs', $locale );

	// Setup paths to current locale file
	$mofile_local  = $mp_videos_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/mp-videos/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/mp_videos folder
		load_textdomain( 'mp_videos', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/message_bar/languages/ folder
		load_textdomain( 'mp_videos', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'mp_videos', false, $mp_videos_lang_dir );
	}

}
add_action( 'init', 'mp_videos_textdomain', 1 );

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/
function mp_videos_include_files(){
	/**
	 * If mp_core isn't active, stop and install it now
	 */
	if (!function_exists('mp_core_textdomain')){
		
		/**
		 * Include Plugin Checker
		 */
		require( MP_VIDEOS_PLUGIN_DIR . 'includes/plugin-checker/class-plugin-checker.php' );
		
		/**
		 * Check if wp_core in installed
		 */
		require( MP_VIDEOS_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-core-check.php' );
		
	}
	/**
	 * Otherwise, if mp_core is active, carry out the plugin's functions
	 */
	else{
		
		/**
		 * Update script - keeps this plugin up to date
		 */
		//require( MP_VIDEOS_PLUGIN_DIR . 'includes/updater/mp-video-update.php' );
				
		/**
		 * Video Custom Post Type
		 */
		require( MP_VIDEOS_PLUGIN_DIR . 'includes/custom-post-types/video.php' );
		
		/**
		 * Video Custom Post Type
		 */
		require( MP_VIDEOS_PLUGIN_DIR . 'includes/metaboxes/mp-videos/mp-videos.php' );
					
	}
}
add_action('plugins_loaded', 'mp_videos_include_files', 9);