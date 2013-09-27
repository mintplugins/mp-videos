<?php
/**
 * This file contains the function keeps the MP Videos plugin up to date.
 *
 * @since 1.0.0
 *
 * @package    MP Videos
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
 * Check for updates for the MP Videos Plugin by creating a new instance of the MP_CORE_Plugin_Updater class.
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
 if (!function_exists('mp_videos_update')){
	function mp_videos_update() {
		$args = array(
			'software_name' => 'MP Videos', //<- The exact name of this Plugin. Make sure it matches the title in your mp_videos, edd, and the WP.org videos
			'software_api_url' => 'http://moveplugins.com',//The URL where EDD and mp_videos are installed and checked
			'software_filename' => 'mp-videos.php',
			'software_licensed' => false, //<-Boolean
		);
		
		//Since this is a plugin, call the Plugin Updater class
		$mp_videos_plugin_updater = new MP_CORE_Plugin_Updater($args);
	}
 }
add_action( 'init', 'mp_videos_update' );
