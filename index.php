<?php

/**
 * Raevant WP News
 *
 * @package           RaevantWPNews
 * @author            Ali Abdi
 * @copyright         ArcaneTeam
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Raevant WP News
 * Plugin URI:        https://arcaneteam.ir/RaevantWPNews
 * Description:       control Raevant App
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            ali abdi
 * Author URI:        https://arcaneteam.ir
 * Text Domain:       raevant_wordpress_news
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://arcaneteam.ir/RaevantWPNews/
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_action( 'init', 'Rapp_load_textdomain' );

	/**
	 * Load plugin textdomain.
	 */
	function Rapp_load_textdomain() {
		load_plugin_textdomain( 'Rapp', false, dirname( plugin_basename( __FILE__ ) )  . '/lang' );
	}



define( 'Rapp_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'Rapp_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once( Rapp_PLUGIN_PATH . 'admin/function.php');



if ( is_admin() ) {
    require_once Rapp_PLUGIN_PATH . 'admin/menu.php';
    function Rapp_set_admin_style() {
			wp_register_style( 'Rapp_style_admin', 'https://arcaneteam.ir/development/assets/css/admin.css');			
		}
    add_action( 'admin_enqueue_scripts', 'Rapp_set_admin_style' );
  }



?>