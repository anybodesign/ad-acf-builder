<?php
/**
 * Plugin Name: AD ACF Builder
 * Plugin URI: https://github.com/anybodesign/ad-acf-builder
 * Description: Add a Page Builder to your pages and posts, based on ACF flexible fields.
 * Version: 1.0
 * Requires at least: 4.0
 * Tested up to: 4.8
 * License: GNU/GPL 2
 * Author: anybodesign
 * Author URI: https://anybodesign.com/
 * Text Domain: ad-acfb
 * Domain Path: /languages/
 * Network: True
 * GitHub Plugin URI: https://github.com/anybodesign/ad-acf-builder
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die(); 


/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define('ACFB_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('ACFB_NAME', 'AD ACF Builder');
define('ACFB_VERSION', '1.0');


// i18n

load_plugin_textdomain( 'ad-acfb', false, basename( dirname( __FILE__ ) ) . '/languages/' );


/* ------------------------------------------
// Activation Alert -------------------------
--------------------------------------------- */

register_activation_hook( __FILE__, 'acfb_admin_notice_activation_hook' );

function acfb_admin_notice_activation_hook() {
	set_transient( 'acfb-admin-notice-transient', true, 5 );
}

function acfb_admin_notice(){

	if( get_transient( 'acfb-admin-notice-transient' ) ){
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php _e( 'Remember, AD ACF Builder need ACF Pro 5.6 or greater to be installed and activated!', 'ad-acfb' ); ?></p>
		</div>
		<?php
		delete_transient( 'acfb-admin-notice-transient' );
	}
}
add_action( 'admin_notices', 'acfb_admin_notice' );


/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function acfb_css() {
 	
	wp_enqueue_style(
		'builder', 
	    plugins_url( '/css/builder.css' , __FILE__ ),
		array(), 
		'1.0', 
	    'all'
	);

}    
add_action('wp_enqueue_scripts', 'acfb_css');


/* ------------------------------------------
// ACF Fields & Ouput -----------------------
--------------------------------------------- */

require_once('acf/acfb-fields.php');
require_once('acf/acfb-output.php');


/* ------------------------------------------
// Filter the_content -----------------------
--------------------------------------------- */


add_filter( 'the_content', 'acfb_fields' );
 
function acfb_fields( $content ) {

    if ( is_single() || is_page() && in_the_loop() && is_main_query() ) {
		
		ob_start();
	    acfb_ouput();
		
		$acf = ob_get_clean();
		
		return $content . $acf;	

    }
    return $content;
}
