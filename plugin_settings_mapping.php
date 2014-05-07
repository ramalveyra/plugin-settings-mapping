<?php
/**
 * Plugin Name: Plugin Settings Mapping
 * Plugin URI: https://github.com/Link7/plugin-settings-mapping
 * Description: A plugin that handles configuration and settings mapping for network activated plugins
 * Version: 0.1
 * Author: Link7
 * Author URI: https://github.com/Link7
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl.html
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

class L7_Plugin_Settings
{
	public $plugin_dir;

	public $plugin_json_files;

	public function __construct() {	
		//supports only multisite for now
		if (is_multisite()) {
			add_action('network_admin_menu', array($this, 'network_admin_menu'));
			
			$this->plugin_dir = plugin_dir_path( __FILE__ );

			//load the json files
			$this->plugin_json_files = glob($this->plugin_dir . "data/*.json");
		}
	}

	function network_admin_menu() {
		$setting_slug = add_submenu_page('settings.php', 'Plugin Settings Map', 'Plugin Settings Map', 'manage_options', 'l7_plugin_settings_db', array($this, 'plugin_settings_db_form'));
		//add_action('load-'.$setting_slug, array($this,'l7_plugin_copy_post'));
	}

	function plugin_settings_db_form(){
		//var_dump($this->plugin_json_files);

		include_once('include/plugin_settings_page.php');

	}

	function get_plugin_info($json){
		//load the json file
		if(file_exists($json)){
			$json_file = file_get_contents($json);	
		}else{
			$json_file = glob($this->plugin_dir . "data/".$json.".json");

			if(empty($json_file)){
				return null;
			}else{
				$json_file = array_shift($json_file);
				if(file_exists($json_file)){
					$json_file = file_get_contents($json_file);	
				}else{
					return null;
				}
			}
		}
		$plugin_info = json_decode($json_file, true);
		return $plugin_info;
	}

	/**
	 * Fetches the plugin mapping by name
	 */

}

new L7_Plugin_Settings;